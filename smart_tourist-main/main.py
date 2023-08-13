import pymongo
import pandas as pd
import numpy as np
from numpy import dot
from datetime import datetime
from numpy.linalg import norm
from flask import Flask
from flask import request
import json
from cunghoangdao1 import hoang_dao
# from get_imotion import get_imotion
from thoitiet import getWeather
from flask_cors import CORS 
from detect import detect_face_base64_mask
start_col = 7
import time
myclient = pymongo.MongoClient("mongodb+srv://root:eZcu9qthj7GgmNMY@smartourist.foiibut.mongodb.net/")
mydb = myclient['Smartourist']
print(myclient.list_database_names())
mycol = mydb["dataDestination"]
list_dict = []
for x in mycol.find():
    list_dict.append(x)
data = pd.DataFrame.from_dict(list_dict)
data.head()
print(myclient.list_database_names())
collist = mydb.list_collection_names()
print(collist)
input_api = {
    "image": "",  # picture
    "color": "",  # RED, YELLOW, SKYBLUE, GREEN, PINK, PURPLE,BROWN, ORANGE
    "weather": "",# ["clear sky","shower rain", "rain","thunder storm","few clouds","snow","scattered cloud","broken cloud"]
    "temperature":"",#nhiet do
    "day_or_night": "",  # MORNING, NIGHT, MORNING_A_NIGHT
    "day_of_birth": ""  # 24/3
}
def get_Morning_Night():
    now = datetime.now()
    current_time = now.strftime("%H:%M:%S")
    print("Gio hien tai =", current_time)
    time = current_time.split(":")
    print(time)
    Ms = "MORNING"
    hour = int(time[0])
    if(hour>=16 or hour < 3):
        return "NIGHT"
    else:
        return"MORNING"
# data = pd.DataFrame()
# mycol = mydb["dataDestination"]
# index = 0
# for x in mycol.find(): # ko query điều kiện nào và lấy tất cả các field
#     # xs = x
#     m = pd.DataFrame(x,index=[index])
#     index+=1
#     data = pd.concat([data,m], axis=0)

data.dropna(inplace=True)
data['contemp'] = 0
for col in data.columns[start_col:]:
    data[col] = data[col].astype(float)
    print(col)
print("col")

api_string = [0, 1, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 0,
        1, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 0, 1, 1, 0, 1]


def get_cosin(x):
    cos_sim = dot(api_string, x)/(norm(api_string)*norm(x))
    
    return cos_sim

def get_lat(x):
    lst = x.split("/")
    lat_long = [x for x in lst if "@" in x ]
    lat_long = lat_long[0].split(",")
    lat_long[0] = lat_long[0].replace("@","")
    lat = lat_long[0]
    return lat

def get_long(x):
    lst = x.split("/")
    lat_long = [x for x in lst if "@" in x ]
    lat_long = lat_long[0].split(",")
    long= lat_long[1].replace("@","")
    return long

def get_top_sim(top: int, api_string_get):
    
    global api_string
    api_string = api_string_get

    data[data.columns[start_col:]].shape
    data["result"] = data[data.columns[start_col:36]].apply(get_cosin, axis=1)
    out = data.sort_values("result", ascending=False).head(top)[['ID', 'Name', 'ADDRESS', 'ADDRESS_LINK','IMG2']]
    out["lat"] = out["ADDRESS_LINK"].apply(get_lat)
    out["long"] = out["ADDRESS_LINK"].apply(get_long)
    
    return out


# get_top_sim(10,api_string)
app = Flask(__name__)

CORS(app)
@app.route('/predict', methods=['POST'])
def make_prediction():
    program_starts = time.time()
    if request.method == 'POST':
        body = json.loads(request.data)
        # print(body)
        # print(type(body))

        dict = {}
        for col in data.columns[start_col:36]:
            # print(col)
            dict[col] = 0
        list_emotion = []
        day_night = get_Morning_Night()
        dict[day_night] = 1
        try:
            list_emotion = detect_face_base64_mask(body["image"])
        except:
            pass
        for emo in list_emotion:
            dict[emo] = 0
        
        thoitiet = getWeather(body["weather"],body["temperature"])
        for tt in thoitiet:
            dict[tt] = 1
        # dict[body["day_or_night"]] = 1
        date_of_birth = body["day_of_birth"].split("/")
        print(date_of_birth)
        chd = hoang_dao(int(date_of_birth[0]),int(date_of_birth[1]))
        dict[chd]= 1
        print(chd)
        print(dict)
        # emote = get_imotion(body["image"])
        dict["ANY_TIME"] = 1
        # dict[emote] = 1
        dict["MORNING_A_NIGHT"] = 1
        print(list(dict.values()))
        lst_binary = list(dict.values())
        output = get_top_sim(30,lst_binary)
        output["emotion"] = str(list_emotion)
        now = time.time()
        print("Tixxxxxxxxxxxxme:",now - program_starts)
        return output.to_json(orient = "records",force_ascii = False)
@app.route('/ping', methods=['GET'])
def ping():
    return "Xin chào"   
if __name__ == '__main__':
    app.run(host = "0.0.0.0",debug=True, port = 4999)

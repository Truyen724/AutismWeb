
import pandas as pd
import numpy as np
from datetime import datetime
from numpy.linalg import norm

from flask_cors import CORS
import cv2
from flask import Flask, request
import time
from flask_wtf.csrf import CSRFError
from flask_wtf.csrf import CSRFProtect
import json
import os
from PIL import Image
import io
from detect_autism import AutismDetect
detect_autism = AutismDetect()

app = Flask(__name__)
csrf = CSRFProtect(app)
CORS(app)
@app.route('/predict', methods=['POST', 'GET'])
@csrf.exempt
def make_prediction():
    program_starts = time.time()
    if request.method == 'POST':
        gender = request.form.get('gender')
        age = request.form.get('age')
        states_agent = request.form.get('states_agent')
        f = request.files['photo']
        image = f.read()
        image_np = np.frombuffer(image, np.uint8)
        image = cv2.imdecode(image_np, cv2.IMREAD_COLOR)
        out_put = -1
        out_put = detect_autism.atism_detect_without_image(image, gender, age, states_agent)
        cv2.imshow("x",image)
        cv2.waitKey(0)
        cv2.destroyAllWindows()
        out = {}
        if(out_put==-1):
            out = {
                "code":"-1",
                "percent":"-1",
                "state":"không nhận diện được gương mặt trong hình"
                }
        else:
            if(out_put<0.5):
                out = {
                    "code":"0",
                    "percent":str(out_put),
                    "state": "Có khả năng thấp"
                }
            elif(out_put>0.5):
                out = {
                "code":"1",
                "percent":str(out_put),
                "state": "Có khả năng cao"
            }
        return json.dumps(out)
if __name__ == '__main__':
    app.run(host = "0.0.0.0",debug=True, port = 4999)

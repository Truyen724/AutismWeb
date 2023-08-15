
import pandas as pd
import numpy as np
from datetime import datetime
from numpy.linalg import norm
# from get_imotion import get_imotion
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

# get_top_sim(10,api_string)
app = Flask(__name__)
csrf = CSRFProtect(app)
CORS(app)
@app.route('/predict', methods=['POST', 'GET'])
@csrf.exempt
def make_prediction():
    program_starts = time.time()
    if request.method == 'POST':

        gender = request.form.get('gender')
        print(request.form.get('gender'))
        f = request.files['photo']
        image = f.read()
        image_np = np.frombuffer(image, dtype=np.uint8)
        image = cv2.imdecode(image_np, cv2.IMREAD_UNCHANGED)


        cv2.imshow("x",image)
        cv2.waitKey(0)
        cv2.destroyAllWindows()
        return "xin chao"


if __name__ == '__main__':
    app.run(host = "0.0.0.0",debug=True, port = 4999)

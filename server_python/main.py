
import pandas as pd
import numpy as np
from numpy import dot
from datetime import datetime
from numpy.linalg import norm
# from get_imotion import get_imotion
from flask_cors import CORS
from detect import detect_face_base64_mask
from flask import Flask, request
import time


# get_top_sim(10,api_string)
app = Flask(__name__)

CORS(app)
@app.route('/predict', methods=['POST'])
def make_prediction():
    program_starts = time.time()
    if request.method == 'POST':
        dict = {}

        return 5


if __name__ == '__main__':
    app.run(host = "0.0.0.0",debug=True, port = 4999)

import os
from sys import platform
from align_faces import warp_and_crop_face, get_reference_facial_points
from mtcnn.detector import MtcnnDetector
import time
import numpy as np
import cv2
if platform == "linux" or platform == "linux2":
    import tflite_runtime.interpreter as tflite
else:
    import tensorflow as tf
class AutismDetect():
    def __init__(self):
        self.get_model()
        self.detector = MtcnnDetector()
        self.model_file = "./model/modeltflite.tflite"
        self.img = None
        self.list_category = ["None Autism","Autism"]
        self.size_of_face = (224,224)
    def get_model(self):
        if platform == "linux" or platform == "linux2":
            print(platform)
            print("______loadin model" + self.model_file)
            self.model_tflite = tflite.Interpreter(model_path=self.model_file)
            self.model_tflite.allocate_tensors()
            self.input_details = self.model_tflite.get_input_details()
            self.output_details = self.model_tflite.get_output_details()

        else:
            print(platform)
            print("______loadin model" + self.model_file)
            interpreter = tf.lite.Interpreter(model_path=self.model_file)
            interpreter.allocate_tensors()
            self.input_details = interpreter.get_input_details()
            self.output_details = interpreter.get_output_details()
            return interpreter
    def detect_aut(self):
        self.program_starts = time.time()


        self.model_tflite.set_tensor(self.input_details[0]['index'],np.array([self.img],dtype="float32"))

        self.model_tflite.invoke()

        self.pred = self.model_tflite.get_tensor(self.output_details[0]['index'])

        self.now = time.time()
        print("Time:",self.now - self.program_starts)
        return self.list_category[np.argmax(self.pred[0])], max(self.pred[0])
    def mask_detect(self, image, rectangle = False):
        self.img = image.copy()
        (self.h,self.w) = self.img.shape[:2]
        self.boxes, self.facial5points = self.detector.detect_faces(self.img)

        for box in self.boxes:
            (startX,startY,endX,endY)=box[:4].astype('int')

            #ensure the bounding boxes fall within the dimensions of the frame
            (startX,startY)=(max(0,startX),max(0,startY))
            (endX,endY)=(min(w-1,endX), min(h-1,endY))

            self.face=self.img[startY:endY, startX:endX]

            self.face=cv2.resize(self.face,self.size_of_face)

            self.label, self.percent = self.detect_aut(self.face)

            

            if(rectangle):
                cv2.putText(self.img,self.label+" "+self.percent,(startX,startY-10),cv2.FONT_HERSHEY_SIMPLEX,0.45,color,2)
                cv2.rectangle(img,(startX,startY),(endX,endY),color,2)




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

        self.detector = MtcnnDetector()
        self.model_file = "./model/modeltflite.tflite"
        self.get_model()
        self.img = None
        self.list_category = ["None Autism","Autism"]
        self.size_of_face = (224,224)
        self.retangle = True

    def get_model(self):
        if platform == "linux" or platform == "linux2":
            print(platform)
            print("______loadin model " + self.model_file)
            self.model_tflite = tflite.Interpreter(model_path=self.model_file)
            self.model_tflite.allocate_tensors()
            self.input_details = self.model_tflite.get_input_details()
            self.output_details = self.model_tflite.get_output_details()

        else:
            print(platform)
            print("______loadin model " + self.model_file)
            self.model_tflite = tf.lite.Interpreter(model_path=self.model_file)
            self.model_tflite.allocate_tensors()
            self.input_details = self.model_tflite.get_input_details()
            self.output_details = self.model_tflite.get_output_details()
    def detect_aut(self):
        self.program_starts = time.time()
        self.model_tflite.set_tensor(self.input_details[0]['index'],np.array([self.face],dtype="float32"))
        self.model_tflite.invoke()
        pred = self.model_tflite.get_tensor(self.output_details[0]['index'])
        self.now = time.time()
        print("Time:",self.now - self.program_starts)
        return pred
    def atism_detect(self, image, rectangle = True):
        self.img = image.copy()
        (self.h,self.w) = self.img.shape[:2]
        self.boxes, self.facial5points = self.detector.detect_faces(self.img)
        for box in self.boxes:
            (startX,startY,endX,endY)=box[:4].astype('int')
            (startX,startY)=(max(0,startX),max(0,startY))
            (endX,endY)=(min(self.w-1,endX), min(self.h-1,endY))
            self.face=self.img[startY:endY, startX:endX]
            self.face=cv2.resize(self.face,self.size_of_face)
            self.pred = self.detect_aut()
            color = (0,255,0)
            if(self.pred[0][0]>0.5):
                self.label = self.list_category[1]
            else:
                self.label = self.list_category[0]
            if(rectangle):
                cv2.putText(self.img,self.label + str(self.pred[0][0]),(startX,startY-10),cv2.FONT_HERSHEY_SIMPLEX,0.45,color,2)
                cv2.rectangle(self.img,(startX,startY),(endX,endY),color,2)
        return self.img,self.pred
    def atism_detect_without_image(self, image):
        self.img = image.copy()
        (self.h,self.w) = self.img.shape[:2]
        self.boxes, self.facial5points = self.detector.detect_faces(self.img)
        self.pred = -1
        if(len(self.boxes)>0):
            for box in self.boxes:
                (startX,startY,endX,endY)=box[:4].astype('int')
                (startX,startY)=(max(0,startX),max(0,startY))
                (endX,endY)=(min(self.w-1,endX), min(self.h-1,endY))
                self.face=self.img[startY:endY, startX:endX]
                self.face=cv2.resize(self.face,self.size_of_face)
                self.pred = self.detect_aut()
        else:
            return self.pred
        return self.pred[0][0]
    def runcam(self):
        self.cap = cv2.VideoCapture(0)
        if not  self.cap.isOpened():
            print("Cannot open camera")
            exit()
        while True:
            ret, frame =  self.cap.read()
            if not ret:
                print("Can't receive frame (stream end?). Exiting ...")
                break
            arr = None
            try:
                frame, arr = self.atism_detect(frame, rectangle=True)
                print(arr)
            except:
                pass
            cv2.imshow('frame', frame)
            if cv2.waitKey(1) == ord('q'):
                break
        self.release()
        cv2.destroyAllWindows()


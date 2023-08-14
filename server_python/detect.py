from re import X
import threading
from unittest import result
import cv2
import time
import numpy as np
from align_faces import warp_and_crop_face, get_reference_facial_points
from mtcnn.detector import MtcnnDetector
from sys import platform
import os
if platform == "linux" or platform == "linux2":
    import tflite_runtime.interpreter as tflite

model_file = "./model/modeltflite.tflite"

size_of_face = (224,224)
# tensorflow thường trên window

# tflite_interpreter = tf.lite.Interpreter(model_path="../Resnet_Emotion_weights_final.best.tflite")

tflite_interpreter = tflite.Interpreter(model_path=model_file)
tflite_interpreter.allocate_tensors()

input_details = tflite_interpreter.get_input_details()
output_details = tflite_interpreter.get_output_details()

detector = MtcnnDetector()

def detect_face(img):
    program_starts = time.time()
    x = np.array([img],dtype="float32")

    tflite_interpreter.set_tensor(input_details[0]['index'],x)

    tflite_interpreter.invoke()

    pred = tflite_interpreter.get_tensor(output_details[0]['index'])
    list_category = ["None Autism","Autism"]
    now = time.time()
    print("Time:",now - program_starts)
    return list_category[np.argmax(pred[0])], max(pred[0])


def mask_detect(image, rectangle = False):

    img = image.copy()
    (h,w) = img.shape[:2]
    boxes, facial5points = detector.detect_faces(img)
    arr_emotion = []
    for box in boxes:
        (startX,startY,endX,endY)=box[:4].astype('int')

        #ensure the bounding boxes fall within the dimensions of the frame
        (startX,startY)=(max(0,startX),max(0,startY))
        (endX,endY)=(min(w-1,endX), min(h-1,endY))

        face=img[startY:endY, startX:endX]

        face=cv2.resize(face,size_of_face)

        label, percent = detect_face(face)

        color=(0,255,0)

        if(rectangle):
            cv2.putText(img,label+" "+percent,(startX,startY-10),cv2.FONT_HERSHEY_SIMPLEX,0.45,color,2)
            cv2.rectangle(img,(startX,startY),(endX,endY),color,2)

    return img, arr_emotion

def main():
    cap = cv2.VideoCapture(0)
    if not cap.isOpened():
        print("Cannot open camera")
        exit()
    while True:
        # Capture frame-by-frame
        ret, frame = cap.read()
        # if frame is read correctly ret is True
        if not ret:
            print("Can't receive frame (stream end?). Exiting ...")
            break
        # Our operations on the frame come here
        # frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        arr=[]
        try:
            frame, arr = mask_detect(frame, rectangle=True)
        except:
            pass
        print(arr)
        # Display the resulting frame
        cv2.imshow('frame', frame)
        if cv2.waitKey(1) == ord('q'):
            break
    # When everything done, release the capture

    cap.release()
    cv2.destroyAllWindows()

if __name__ == "__main__":
    main()
    # detect_face_base64_mask(img_base64_3)

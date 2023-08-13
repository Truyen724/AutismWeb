
import cv2
import time
import numpy as np

# import tensorflow as tf
import tflite_runtime.interpreter as tflite

model_file = "./model/model_vgg16_89.tflite"

size_of_face = (224,224)

try:
    tflite_interpreter = tflite.Interpreter(model_path=model_file)
    tflite_interpreter.allocate_tensors()
    input_details = tflite_interpreter.get_input_details()
    output_details = tflite_interpreter.get_output_details()
    print("Mô hình đã được tải thành công.")
except Exception as e:
    print("Có lỗi khi tải mô hình:", e)

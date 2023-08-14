# Save the model.
model_file = "./modeltflite.tflite"

size_of_face = (224,224)
load_model = False
import tflite_runtime.interpreter as tflite
try:
    tflite_interpreter = tflite.Interpreter(model_path=model_file)
    tflite_interpreter.allocate_tensors()
    input_details = tflite_interpreter.get_input_details()
    output_details = tflite_interpreter.get_output_details()
    print("Mô hình đã được tải thành công.")
except Exception as e:
    print("Có lỗi khi tải mô hình:", e)

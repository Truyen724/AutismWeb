<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js?" async defer></script>
    {{--    lịch--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    {{----}}
    <title>Thông tin cá nhân</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .link-accept {
            color: #007bff;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            justify-content: center;
        }

        #captureBtn {
            color: #007bff;
            font-size: 20px;
        }

        #btn_exit {
            margin-left: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .photo-container {
            text-align: left;
        }

        #preview {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .modal_cam {
            display: flex;
            flex-direction: column;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #modal_contents {
            display: none;
            justify-content: center;
        }

        .modal-content {
            position: relative;

            background-color: #fff;

            border-radius: 5px;
        }

    </style>
</head>
<body>
<div class="container">
    <h1>Hệ thống hỗ trợ phát hiện sớm</h1>
    <form action="" id =form_main>
        <label for="age">Tuổi:</label>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker3'>
                <input type='text' class="form-control" id ="datetime"/>
                <span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
               </span>
            </div>
        </div>
        <label for="gender">Giới tính:</label>
        <select id="gender" name="gender">
            <option value="male">Nam</option>
            <option value="female">Nữ</option>
            <option value="other">Khác</option>
        </select>
        <label for="statement_of_child">Chẩn đoán của nhà chuyên môn</label>
        <select id="statement_of_child" name="statement_of_child">
            <option value="not_yet">Chưa tham gia chẩn đoán</option>
            <option value="soft_autistic">Trẻ bị tự kỷ mức độ nhẹ</option>
            <option value="autistic">Trẻ bị tự kỷ mức độ nặng</option>
            <option value="normal">Trẻ bình thường</option>
        </select>
        <div class="photo-container">
            <label for="photo">Ảnh cá nhân:</label>
            <input type="file" id="photo" name="photo" accept=".jpg, .jpeg">
            <br>
            <button class="btn" id="cameraBtn" type="button">Mở camera</button>
            <img id="preview" src="" alt="Ảnh cá nhân">
        </div>
        <br>
        <div class="modal_cam">
            <div id="cameraModal" class="modal_cam"></div>
            <div class="modal-content" id="modal_contents">
                <button id="captureBtn" type="button">Chụp</button>
                <button id="btn_exit">X</button>
            </div>
        </div>
        <div>

            <input type="checkbox" id="accept" name="accept">
            <label for="vehicle1"> Tôi đã động ý với <a class="link-accept" href="https://www.facebook.com/"> điểu khoản
                    và chính sách</a> </label>
            <br>
        </div>
        {{--        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>--}}
        {{--        @if ($errors->has('g-recaptcha-response'))--}}
        {{--            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>--}}
        {{--        @endif--}}
        <button class="btn" id="button-submit" type="submit">Gửi yêu cầu</button>
    </form>
</div>
<script>
    const cameraBtn = document.getElementById('cameraBtn');
    const preview = document.getElementById('preview');
    const photoInput = document.getElementById('photo');
    let stream = null;
    let videoStream = null;
    const modal = document.getElementById('cameraModal');
    const closeModalBtn = document.getElementById('btn_exit');
    let ismodalopened = false;
    const modal_contents = document.getElementById('modal_contents');
    cameraBtn.addEventListener('click', async () => {
        if (ismodalopened) {
            alert('Không thể truy cập camera. Vui lòng kiểm tra lại.');
        } else {
            photoInput.value = '';
            try {
                stream = await navigator.mediaDevices.getUserMedia({video: true});
                if (stream) {
                    const video = document.createElement('video');
                    videoStream = video;
                    videoStream.srcObject = stream;
                    videoStream.autoplay = true;
                    modal.style.display = 'block';
                    modal.appendChild(video);
                    modal_contents.style.display = 'flex'
                }
                ismodalopened = true;
            } catch (error) {
                console.error('Error accessing camera:', error);
                alert('Không thể truy cập camera. Vui lòng kiểm tra lại.');
            }
        }
    });
    $(function () {
        $('#datetimepicker3').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    });
    photoInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    let formData = new FormData();


    const captureBtn = document.getElementById('captureBtn');
    captureBtn.addEventListener('click', () => {
        const canvas = document.createElement('canvas');
        canvas.width = videoStream.videoWidth;
        canvas.height = videoStream.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(videoStream, 0, 0, canvas.width, canvas.height);
        preview.src = canvas.toDataURL('image/jpeg');
        canvas.toBlob((blob) => {
            formData.append('photo', blob);
        }, 'image/jpeg');
        closeModal();
    });

    function closeModalOutside(event) {
        if (event.target === modal) {
            closeModal();
        }
    }
    function closeModal() {
        if (stream) {
            const tracks = stream.getTracks();
            tracks.forEach(track => track.stop());
            stream = null;
        }
        modal_contents.style.display = 'none';
        modal.removeChild(videoStream);
        modal.style.display = 'none';
        ismodalopened = false;
    }

    closeModalBtn.addEventListener('click', () => {
        closeModal();
    });
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });
    // Xử lý khi form được gửi

    const form = document.querySelector('form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Lấy dữ liệu từ các trường input

        const photo = photoInput.files[photoInput.files.length-1];
        const age = document.getElementById('datetime').value;
        const gender = document.getElementById('gender').value;
        const accept = document.getElementById('accept').checked;

        // const photoDataUrl = "xxx";
        // Gửi dữ liệu lên server hoặc thực hiện các xử lý khác ở đây
        const states_agent = document.getElementById('statement_of_child').value;
        formData.append('age', age);
        formData.append('gender', gender);
        try{
            formData.append('photo', photo);
        }
        catch (err){
        }
        formData.append('accept', accept);
        formData.append('states_agent', states_agent);
        if (accept)
            try {
                const response = await fetch('http://127.0.0.1:4999/predict', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': csrfToken, // Thêm CSRF token vào headers
                    },
                    body: formData,
                });
                if (response.ok) {
                    const data = await response.json();
                    alert(data["state"] + data["percent"]);
                } else {
                    alert('Có lỗi xảy ra khi gửi dữ liệu.');
                    alert(response);
                }
            } catch (error) {
                console.error('Lỗi khi gửi request:', error);
                alert('Có lỗi xảy ra khi gửi dữ liệu.');
            }
        formData = new FormData();
        photoInput.value = '';
    });
</script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            text-align: center;
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
        #btn_getpicture{
            display: inline-block;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Thông tin cá nhân</h1>
    <form>
        <label for="name">Tên:</label>
        <input type="text" id="name" name="name" required>
        <label for="age">Tuổi:</label>
        <input type="text" id="age" name="age" required>
        <label for="gender">Giới tính:</label>
        <select id="gender" name="gender">
            <option value="male">Nam</option>
            <option value="female">Nữ</option>
            <option value="other">Khác</option>
        </select>
        <div class="photo-container">
            <label for="photo">Ảnh cá nhân:</label>
            <input type="file" id="photo" accept="image/*">
            <br>
            <button class="btn" id="cameraBtn" type="button">Mở camera</button>
            <img id="preview" src="" alt="Ảnh cá nhân">
        </div>
        <br>
        <button class="btn" type="submit">Gửi</button>
    </form>
</div>
<div id="cameraModal" class="modal">
    <div class="modal-content">
        <button id="btn_exit" >Thoát</button>
        <button id="captureBtn" >Chụp</button>
        <button id="btn_changecamera" >Dổi camera</button>
    </div>
</div>

<style>
    /* Thêm phần CSS cho modal */
    .modal {
        display: none;
        position: fixed;
        justify-content: center;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
    }
    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
    }
    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
    }
</style>
<script>
    const cameraBtn = document.getElementById('cameraBtn');
    const preview = document.getElementById('preview');
    const photoInput = document.getElementById('photo');
    let stream = null;
    let videoStream = null;

    cameraBtn.addEventListener('click', async () => {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: true });

            if (stream) {
                const video = document.createElement('video');
                videoStream = video;
                video.srcObject = stream;
                video.autoplay = true;

                const modal = document.getElementById('cameraModal');
                modal.style.display = 'block';
                modal.appendChild(video);

                cameraBtn.style.display = 'none';
            }
        } catch (error) {
            console.error('Error accessing camera:', error);
            alert('Không thể truy cập camera. Vui lòng kiểm tra lại.');
        }
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
    const captureBtn = document.getElementById('captureBtn');
    captureBtn.addEventListener('click', () => {
        const canvas = document.createElement('canvas');
        canvas.width = videoStream.videoWidth;
        canvas.height = videoStream.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(videoStream, 0, 0, canvas.width, canvas.height);
        preview.src = canvas.toDataURL('image/jpeg');

        // Đóng video stream
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());

        const modal = document.getElementById('cameraModal');
        modal.style.display = 'none';
    });

    // Xử lý khi form được gửi
    const form = document.querySelector('form');
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        // Lấy dữ liệu từ các trường input
        const name = document.getElementById('name').value;
        const age = document.getElementById('age').value;
        const gender = document.getElementById('gender').value;
        const photoDataUrl = preview.src;

        // Gửi dữ liệu lên server hoặc thực hiện các xử lý khác ở đây
        console.log('Tên:', name);
        console.log('Tuổi:', age);
        console.log('Giới tính:', gender);
        console.log('Ảnh:', photoDataUrl);
    });
</script>
</body>
</html>

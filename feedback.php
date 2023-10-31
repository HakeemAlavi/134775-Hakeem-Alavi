<!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #3deb6c;
        }

        .form-container {
            width: 400px;
            height: auto;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 2px 2px 5px #888888;
            padding: 20px;
            background-color: #ffffff;
            z-index: 9999;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            margin-bottom: 10px;
        }

        .radio-div {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #3deb6c;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }

        button {
            width: 100%;
            background-color: #3498db;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <script>
        function closeWindow() {
            window.close();
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h3>We'd love your feedback!</h3>
        <form method="post" action="insert-feedback.php">
            <p>What was your <strong>final</strong> cholera diagnosis?</p>
            <div class="radio-div">
                <div>
                    <input type="radio" name="diagnosis" value="yes">
                    <label>Yes</label>
                </div>
                <div>
                    <input type="radio" name="diagnosis" value="no">
                    <label>No</label>
                </div>
            </div>
            <textarea name="feedback" placeholder="Please provide your feedback here"></textarea>
            <input type="submit" value="Submit">
            <button type="button" onclick="closeWindow()">No Thanks</button>
        </form>
    </div>
</body>
</html>

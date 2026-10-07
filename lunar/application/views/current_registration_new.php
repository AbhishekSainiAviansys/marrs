<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaRRS Registration 2024-25</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        h1 {
            color: #ff6600; /* Saffron color */
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group button {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
        }

        .form-group button:hover {
            background-color: #0a58ca;
        }

        .message {
            margin-bottom: 15px;
            color: green;
        }

        .error {
            color: red;
        }

        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleSubmitButton(show) {
            document.getElementById('submitButton').style.display = show ? 'block' : 'none';
            document.getElementById('sendOtpButton').style.display = show ? 'none' : 'block';
            document.getElementById('otp').classList.toggle('hidden', !show);
        }

        function handleFormSubmit(event) {
            event.preventDefault();
            const email = document.getElementById('email').value;
            const otp = document.getElementById('otp').value;

            if (email && !otp) {
                toggleSubmitButton(true);
                document.getElementById('form').submit();
            } else if (email && otp) {
                document.getElementById('form').submit();
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>MaRRS Registration 2024-25</h1>

        <?php if (!empty($message)) { echo '<p class="message">' . $message . '</p>'; } ?>
        <?php if ($this->session->flashdata('otperror')) { echo '<p class="error">' . $this->session->flashdata('otperror') . '</p>'; } ?>

        <form id="form" method="post" action="<?php echo site_url('welcome/current_registration_new'); ?>" onsubmit="handleFormSubmit(event)">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group hidden" id="otpContainer">
                <label for="otp">OTP:</label>
                <input type="text" name="otp" id="otp">
            </div>

            <div class="form-group">
                <button type="submit" id="sendOtpButton">Send OTP</button>
                <button type="submit" id="submitButton" class="hidden">Submit OTP</button>
            </div>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Registration</title>
    <style>body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.banner {
    background-color: #4CAF50;
    color: white;
    padding: 20px;
    text-align: center;
}

.registration-form {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.registration-form label {
    display: block;
    margin-bottom: 10px;
    font-size: 16px;
}

.registration-form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.registration-form button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.registration-form button:hover {
    background-color: #45a049;
}

#message {
    margin-top: 20px;
    font-size: 16px;
    color: green;
}
</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body style="background-image: url('http://marrswordchase.com/public/assets/img/content/img14.jpg');background-repeat: no-repeat;
  background-size: cover;">
    <div class="banner" >
        <h1>Welcome to MaRRS Word Chase Registration </h1>
    </div>
    <div class="registration-form" >
        <form id="registrationForm" method='POST' action=''>
            <label for="name">School Code:</label>
            <input type="text" id="name" name="school_code" Placeholder="Enter School Code" required>
            <button type="submit" name='submit'>Submit</button>
        </form>
        <div id="message"></div>
    </div>
    <script src="script.js"></script>
</body>
</html>

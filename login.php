<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg'); /* Replace 'background-image.jpg' with the path to your background image */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            color: #333;
            transition: transform 0.3s ease;
        }
        .container:hover {
            transform: translateY(-5px);
        }
        h1 {
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        img {
            width: 100px; /* Adjust the width of the logo as per your preference */
            height: auto;
            margin-bottom: 20px;
        }
        h2 {
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 24px);
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(135deg, #00e5ff, #00b3e6);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background: linear-gradient(135deg, #00b3e6, #008bb3);
        }
        .error {
            color: #ff3333;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="pa.png" alt="PA College of Engineering Logo">
        <h1>PA College of Engineering</h1>
        <br>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Login" name="login">
        </form>
        <?php
        if(isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Connect to MySQL database
            $db = mysqli_connect("localhost", $username, $password, "college_faculty");

            if($db === false) {
                echo "<p class='error'>Login Failed: " . mysqli_connect_error() . "</p>";
            } else {
                // Close the current window
                echo "<script>window.close();</script>";

                // Redirect to the database dashboard page
                header("Location: database_dashboard.php");
            }
        }
        ?>
    </div>
</body>
</html>

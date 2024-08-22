<?php 

    session_start();
    require("evergreen.php"); //include the database connection

    $feedback0 = "";
    $feedback1 = "";
    $feedbackresult = "";


    $feedback = array_fill(0, 5, '');
    //Initialize variables

    $name = "";
    $class = "";

    //check iF the Form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $class = trim($_POST["class"]);
        

        if (empty($name)) {
            $feedback0 = "Student's name is required";
        }
    
        if (empty($class)) {
            $feedback1 = "Your Class is required";
        }
    
        

        if (!array_filter($feedback)) {
            // Escape user inputs to prevent SQL injection
            $name = mysqli_real_escape_string($conn, $name);
            $class = mysqli_real_escape_string($conn, $class);

        $sql = "INSERT INTO tblrequest (studentName, studentClass) 
            VALUES ('$name', '$class')";

        if (mysqli_query($conn, $sql)) {
            $feedbackresult = "Information inserted successfully!";
        } else {
            $feedbackresult = "Failed to insert your data!";
        }
    }
    
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request - Evergreen Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #008080;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        footer {
            background-color: #000;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        header img {
            height: 80px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        nav ul li {
            margin: 0 1em;
            position: relative;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        nav ul li a:hover {
            background-color: #008080;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            min-width: 160px;
            z-index: 1;
            top: 100%;
            left: 0;
        }

        .dropdown-content a {
            text-align: left;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
        #form-container {
            width: 100%;
            max-width: 600px; /* Limits the form width */
            margin: 40px auto; /* Centers the form */
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: -350px;
        }

        #form-container form {
            display: flex;
            flex-direction: column;
        }

        #form-container label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        #form-container input[type="text"] {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 100%; /* Full width for inputs */
            box-sizing: border-box;
        }

        #form-container input[type="submit"] {
            padding: 12px 20px;
            border: none;
            border-radius: 15px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            width: 200px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        #dashboard {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: relative;
        }
        .header button {
            position: absolute;
            right: 20px;
            top: 10px;
            padding: 10px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        #nav-bar {
            background-color: #444;
            padding: 10px;
            display: flex;
            justify-content: center;
        }
        #nav-bar ul {
            list-style-type: none;
            padding: 0;
        }

        #nav-bar ul li {
            display: inline;
            margin: 0 15px;
        }

        #nav-bar ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            flex: 1;
            padding: 20px;
            text-align: center;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <!-- school logo -->
        <img src="logo-img.png" alt="School Logo">
        <nav>
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="facilities.html">FACILITIES</a></li>
                <li class="dropdown">
                    <a href="#">REGISTRATION</a>
                    <div class="dropdown-content">
                        <a href="studentregister.php">New Students</a>
                        <a href="login.php">Old Students</a>
                    </div>
                </li>
                <li><a href="contact.php">CONTACT US</a></li>
            </ul>
        </nav>
    </header>
    <!-- Dashboard Page -->
    <div id="dashboard">
        <header class="header">
            <h1>Dashboard</h1>
            <button id="logout">Logout</button>
        </header>
        <nav id="nav-bar">
            <ul>
                <li><a href="request.php">Request report Card</a></li>
                <li><a href="complain.php">Complain</a></li>
                <li><a href="teacher.html">Your Teacher</a></li>
                <li><a href="teacher.html">Create Teacher</a></li>
                <li><a href="register.php">Register Student</a></li>
            </ul>
        </nav>
        <main>
            <p>Welcome to Evergreen Learning Academy Dashboard. Select an option from the menu.</p>
        </main>
    </div>
    <!-- Request Page -->
    <div id="form-container">
        <center><h1><b>Request a Report Card</b></h1></center>
        <form id="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Student's Name:</label>
            <input type="text" id="name" name="name" required>
            <span class="error"><?php echo $feedback0; ?></span>

            <label for="class">Student's Class:</label>
            <input type="text" id="class" name="class" required>
            <span class="error" style="display: none;"><?php echo $feedback1; ?></span>
            <br/>
            <span style="color: red;"><?php echo $feedbackresult; ?></span>
            <br/>

            <center><input type="submit" value="Request Report Card"></center>
        </form>
    </div>

    <footer>
        <nav>
            <ul>
            <li><a href="index.html">HOME</a></li>
            <li><a href="facilities.html">FACILITIES</a></li>
            <li><a href="#">REGISTRATION</a></li>
            <li><a href="contact.html">CONTACT US</a></li>
            </ul>
        </nav>
        <br />
        &copy; <b>2024 Evergreen College Website. All rights reserved.</b>
    </footer>

    <script>
        document.getElementById('logout').addEventListener('click', function() {
            // Optionally, you can add logout logic here, like clearing session data

            // Redirect to the login page
            window.location.href = 'login.php'; // Replace 'login.html' with the actual login page URL
        });
    </script>
</body>
</html>

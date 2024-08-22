<?php 

    session_start();
    require("evergreen.php"); //include the database connection

    $feedback0 = "";
    $feedback1 = "";
    $feedback2 = "";
    $feedback3 = "";
    $feedback4 = "";
    $feedbackresult = "";


    $feedback = array_fill(0, 5, '');
    //Initialize variables

    $name = "";
    $phone = "";
    $email = "";
    $password = "";
    $message = "";

    //check iF the Form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $phone = trim($_POST["phone"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $message = trim($_POST["message"]);
        

        if (empty($name)) {
            $feedback0 = "User name is required";
        }
    
        if (empty($phone)) {
            $feedback1 = "Phone Number is required";
        }

        if (empty($email)) {
            $feedback2 = "Your email is required";
        }

        if (empty($password)) {
            $feedback3 = "Your password is required";
        }

        if (empty($message)) {
            $feedback4 = "Your message is required";
        }
    
        

        if (!array_filter($feedback)) {
            // Escape user inputs to prevent SQL injection
            $name = mysqli_real_escape_string($conn, $name);
            $phone = mysqli_real_escape_string($conn, $phone);
            $email = mysqli_real_escape_string($conn, $email);
            $password = mysqli_real_escape_string($conn, $password);
            $message = mysqli_real_escape_string($conn, $message);


        $sql = "INSERT INTO tblcontact (contactName, phoneNo, email, password, message) 
            VALUES ('$name', '$phone', '$email', '$password', '$message')";

        if (mysqli_query($conn, $sql)) {
            $feedbackresult = "We will get back to you shortly!";
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
    <title>School Registration Website.</title>
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
        header img {
            height: 80px;
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
        .image-container {
            margin-bottom: 20px;
        }
        .image-container img {
            width: 100%;
            height: auto;
            display: block;
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

        .contact-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .contact-form, .contact-image {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-image {
            text-align: center;
        }

        .contact-image .image {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .form-div form {
            display: flex;
            flex-direction: column;
        }

        .form-div label {
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
        }

            .form-div input[type="text"],
            .form-div input[type="email"],
            .form-div input[type="tel"],
            .form-div input[type="password"] {
                margin-bottom: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
                width: 100%;
                box-sizing: border-box;
            }
            #message {
                margin-bottom: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
                width: 100%;
                box-sizing: border-box;
            }
            .form-div button {
                padding: 12px 20px;
                background-color: #007BFF;
                color: white;
                border: none;
                border-radius: 15px;
                cursor: pointer;
                font-size: 16px;
                width: 100px;
                transition: background-color 0.3s;
            }

            .form-div button:hover {
                background-color: #0056b3;
            }
            div a {
                text-align: center;
                color: black;
                text-decoration: none;
                cursor: pointer;
                word-spacing: 2px;
            }
            /* Laptops and desktops (between 992px and 1200px) */
@media (max-width: 1200px) {
    nav, content, footer {
        padding: 10px;
        /* Adjustments for containers */
    }
    .contact-container {
        padding: 15px;
    }

    .contact-left,
    .contact-right {
        width: 48%;
    }

    .contact-form input,
    .contact-form textarea {
        font-size: 15px;
        padding: 8px;
    }
}

/* Tablets (between 768px and 992px) */
@media (max-width: 992px) {
    body {
        font-size: 15px;
        /* Adjust font size for better readability */

        nav, content, footer {
            padding: 8px;
            /* Adjust padding for smaller screens */
        }
    }

    .nav ul {
        display: flex;
        flex-direction: column;
        /* Stack navigation links vertically */
    }

    .logo {
        width: 80%;
        /* Adjust logo size */
    }
    .contact-container {
        flex-direction: column;
        padding: 10px;
    }

    .contact-left,
    .contact-right {
        width: 100%;
    }

    .contact-left {
        margin-bottom: 20px;
    }

    .contact-form input,
    .contact-form textarea {
        font-size: 14px;
        padding: 8px;
    }
}

/* Mobile phones (below 768px) */
@media (max-width: 768px) {
    body {
        font-size: 12px;
        /* Smaller font size for mobile */

        nav, content, footer {
            padding: 5px;
            /* Further reduce padding for mobile */
        }
    }
    .nav ul {
        flex-direction: column;
        /* Ensure navigation is stacked vertically */
    }

    .logo {
        width: 70%;
        /* Further adjust logo size for mobile */
    }

    .content div {
        flex-direction: column;
        align-items: center;
        /* Center content for better mobile experience */
    }
    .contact-container {
        padding: 5px;
    }

    .contact-left,
    .contact-right {
        width: 100%;
    }

    .contact-left img {
        width: 100%;
        margin-bottom: 15px;
    }

    .contact-form input,
    .contact-form textarea {
        font-size: 14px;
        padding: 6px;
    }
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
    <br><br><br>
    <main>
        <section id="contact-us">
            <center><h1>Contact Us</h1></center>
            <p></p>
            <div class="contact-container">
                <div class="contact-image">
                    <img src="student-reading.jpg" alt="" class="image">
                </div>
                <div class="contact-form">
                    <form class="form-div" id="contactForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
                        <span class="error"><?php echo $feedback0; ?></span>

                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required>
                        <span class="error"><?php echo $feedback1; ?></span>

                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                        <span class="error"><?php echo $feedback2; ?></span>

                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
                        <span class="error"><?php echo $feedback3; ?></span>

                        <label for="message">Message</label>
                        <textarea  id="message" name="message" rows="4" value="<?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?>" required></textarea>
                        <span class="error"><?php echo $feedback4; ?></span>
                        <br/>
                        <span style="color: red;"><?php echo $feedbackresult; ?></span>
                        <br/>
                        
                        <center><button id="send-btn" type="submit">Send</button></center>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <!-- <center><h3>For more Equiries. Visit us on our social medias</h3></center>
    <center><div>
        <a href="www.facebook.com">Facebook</a>
        <a href="www.google.com">Google</a>
        <a href="www.instagram.com">Instagram</a>
        <a href="www.whatsapp.com">WhatsApp</a>
        <a href="www.twitter.com">Twitter</a>
    </div>

    </center> -->
<br><br><br><br><br><br>
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
</script>


</body>
</html>
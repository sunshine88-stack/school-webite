<?php 

    session_start();
    require("evergreen.php"); //include the database connection

    $feedback0 = "";
    $feedback1 = "";
    $feedback2 = "";
    $feedback3 = "";
    $feedback4 = "";
    $feedback5 = "";
    $feedback6 = "";
    $feedback7 = "";
    $feedbackresult = "";


    $feedback = array_fill(0, 5, '');
    //Initialize variables

    $fullname = "";
    $address = "";
    $gender = "";
    $gradeLevel = "";
    $phoneNo = "";
    $age = "";
    $state = "";
    $country = "";

    //check iF the Form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = trim($_POST["fullname"]);
        $address = trim($_POST["address"]);
        $gender = trim($_POST["gender"]);
        $gradeLevel = trim($_POST["gradeLevel"]);
        $phoneNo = trim($_POST["phoneNo"]);
        $age = trim($_POST["age"]);
        $state = trim($_POST["state"]);
        $country = trim($_POST["country"]);

        if (empty($fullname)) {
            $feedback0 = "Full name is required";
        }
    
        if (empty($address)) {
            $feedback1 = "Address is required";
        }
    
        if (empty($gender)) {
            $feedback2 = "Sex is required";
        }
    
        if (empty($gradeLevel)) {
            $feedback3 = "Level is required";
        }
    
        if (empty($phoneNo)) {
            $feedback4 = "Phone Number is required";
        }

        if (empty($age)) {
            $feedback5 = "Your Age is required";
        }

        if (empty($state)) {
            $feedback6 = "Your state  is required";
        }

        if (empty($country)) {
            $feedback7 = "Your Country is required";
        }

        if (!array_filter($feedback)) {
            // Escape user inputs to prevent SQL injection
            $fullname = mysqli_real_escape_string($conn, $fullname);
            $address = mysqli_real_escape_string($conn, $address);
            $gender = mysqli_real_escape_string($conn, $gender);
            $gradeLevel = mysqli_real_escape_string($conn, $gradeLevel);
            $phoneNo = mysqli_real_escape_string($conn, $phoneNo);
            $age = mysqli_real_escape_string($conn, $age);
            $state = mysqli_real_escape_string($conn, $state);
            $country = mysqli_real_escape_string($conn, $country);

        $sql = "INSERT INTO tblstudentregister (fullName, address, sex, level, phoneNumber, age, state, country) 
            VALUES ('$fullname', '$address', '$gender', '$gradeLevel', '$phoneNo', '$age', '$state', '$country')";

        if (mysqli_query($conn, $sql)) {
            $feedbackresult = "Registration  successfully!";
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
        .formDiv {
            width: 100%;
            max-width: 600px; /* Limits the form width */
            margin: 40px auto; /* Centers the form */
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .formDiv form {
            display: flex;
            flex-direction: column;
        }

        .formDiv label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        .formDiv input[type="text"],
        .formDiv input[type="number"],
        .formDiv input[type="tel"],
        .formDiv select {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 100%; /* Full width for inputs */
            box-sizing: border-box;
        }

        .formDiv input[type="submit"] {
            padding: 12px 20px;
            border: none;
            border-radius: 15px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            width: 150px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .formDiv input[type="submit"]:hover {
            background-color: #0056b3;
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
        <div class="formDiv"><br>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" placeholder="enter your full name here">
                <span class="error"><?php echo $feedback0; ?></span>
                
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="enter your home address here">
                <span class="error"><?php echo $feedback1; ?></span>
                
                <label for="gender">Sex:</label>
                <select name="gender" id="gender">
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                    <option value="Other">Other</option>
                </select>
                <span class="error"><?php echo $feedback2; ?></span>
                
                <label for="gradeLevel">Level:</label>
                <select type="text" name="gradeLevel" id="gradeLevel">
                    <option value="select one" disabled>Select one</option>
                    <option value="">JSS1</option>
                    <option value="">JSS2</option>
                    <option value="">JSS3</option>
                    <option value="">SS1</option>
                    <option value="">SS2</option>
                    <option value="">SS3</option>
                </select>
                
                <label for="phoneNo">Phone Number:</label>
                <input type="tel" id="phoneNo" name="phoneNo" placeholder="enter your number here">
                <span class="error"><?php echo $feedback4; ?></span>

                <label for="age">Age:</label>
                <input type="text" id="age" name="age" min="10" max="20" placeholder="enter your age">
                <span class="error"><?php echo $feedback5; ?></span>

                <label for="state">State of Origin:</label>
                <select type="text" name="state" id="state">
                    <option value="select-one" disabled>select one</option>
                    <option value="Abia">Abia</option>
                        <option value="Adamawa">Adamawa</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                        <option value="Anambra">Anambra</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Bayelsa">Bayelsa</option>
                        <option value="Benue">Benue</option>
                        <option value="Borno">Borno</option>
                        <option value="Cross River">Cross River</option>
                        <option value="Delta">Delta</option>
                        <option value="Ebonyi">Ebonyi</option>
                        <option value="Edo">Edo</option>
                        <option value="Ekiti">Ekiti</option>
                        <option value="Enugu">Enugu</option>
                        <option value="FCT">Federal Capital Territory</option>
                        <option value="Gombe">Gombe</option>
                        <option value="Imo">Imo</option>
                        <option value="Jigawa">Jigawa</option>
                        <option value="Kaduna">Kaduna</option>
                        <option value="Kano">Kano</option>
                        <option value="Katsina">Katsina</option>
                        <option value="Kebbi">Kebbi</option>
                        <option value="Kogi">Kogi</option>
                        <option value="Kwara">Kwara</option>
                        <option value="Lagos">Lagos</option>
                        <option value="Nasarawa">Nasarawa</option>
                        <option value="Niger">Niger</option>
                        <option value="Ogun">Ogun</option>
                        <option value="Ondo">Ondo</option>
                        <option value="Osun">Osun</option>
                        <option value="Oyo">Oyo</option>
                        <option value="Plateau">Plateau</option>
                        <option value="Rivers">Rivers</option>
                        <option value="Sokoto">Sokoto</option>
                        <option value="Taraba">Taraba</option>
                        <option value="Yobe">Yobe</option>
                        <option value="Zamfara">Zamfara</option>
                </select>
                <span class="error"><?php echo $feedback6; ?></span>
                
                <label for="country">Country:</label>
                <select type="text" name="country" id="country">
                    <option value="select-one" disabled>select one</option>
                    <option value="">Nigeria</option>
                    <option value="">Togo</option>
                    <option value="">Ghana</option>
                    <option value="">Jamaica</option>
                    <option value="">Kenya</option>
                    <option value="">Liberia</option>
                    <option value="">South Africa</option>
                    <option value="">Cameroon</option>
                    <option value="">Algeria</option>
                    <option value="">Botswana</option>
                </select>
                <br/>
                <br/>
                <span style="color: red;"><?php echo $feedbackresult; ?></span>
                <br/>

            <!-- submit button -->
                <center><input type="submit" value="Submit Request"></center>
            </form>
        </div>
        <br><br><br><br>
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
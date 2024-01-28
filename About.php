<?php
  include "Components/Header.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

    <link href="css/About_us.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />


</head>
<body>
    <!-- header section  -->
  <?php
    $obj = new Header;
    $obj->Header("Logo/Get Attend Logo ( Transparent ).png", "Home.php", "About.php");
   ?>

   <!-- main contenet section  -->
   <div id="main_container">
      <h1>About</h1>
      <div id="about_content">
        <div id="about_text">
            <!-- <p>First of all, we are heartly thank you to you for using this platform. GetAttend is a very simple and very efficient <strong>student attendance system</strong>. Using this attendance system, teachers can get the attendance of students in very easy and effective method. </p> -->
            <p>Attendance tracking is a fundamental aspect of various institutions, schools, and colleges. Traditionally attendance was recorded manually using paper-based methods and now a days attendance system are predominantly digital and often web-based.<strong> Get Attend </strong>is a modern web-based attendance system designed to simplify the registration and attendance tracking process for both teacher and students.</p>
            <p>Get Attend is designed to streamline attendance tracking for teachers and students. This project offers an efficient, user friendly interface for user registration and data storage. Teachers can easily record attendane, which students can access their attendace records. <Strong>Get Attend</Strong> aims to reduce administrative overhead, save time, and faster a paperless educational environment.</p>

            <!-- <h3>Objective</h3>
            <p>The object of this web application (Student Attendance System) is reduce little bit stress of teachers on taking attendance. It provides very easiest and effortless way to get attendance,  give attendance and attendance Tracking.</p> -->

        </div>

        <div id="about_img">
            <img src="images/Startup life-pana.png" alt="Image for about us page" width="450" height="450">
        </div>
      </div>

      <h2><i class="fa-solid fa-arrow-down"></i></h2>

      <h3>Project Parteners</h3>
      <div id="developer_container">
        <!-- developer 1 profile  -->
        <div id="developer_1">
          <div id="profile" class="p1">
            <img src="images/profile-pic 1.png" alt="developer 1">
          </div>
          <h4>Chetan Bedakihale</h4>
          <p>UI/UX Designer, Developer</p>
        </div>

        <!-- developer 2 profile  -->
        <div id="developer_2" class="p2">
          <div id="profile">
            <img src="images/profile-pic 2.jpg" alt="developer 2">
          </div>
          <h4>Shrikant Huchhannavar</h4>
          <p>Developer</p>
        </div>
        
      </div>
   
   </div>
</body>
</html>
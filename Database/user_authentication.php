<?php
session_start();
include "../Components/NoLogged.php";

$is_logged = false;

// connecting database
$connection = mysqli_connect('localhost', 'root', '', 'getattend');

$r_button = $_POST['login_as'];


if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // on login time user selected teacher radio button then 
  if ($r_button === "Teacher") {

    $user_id = $_POST['user'];
    $password = $_POST['password'];

    $query = "SELECT Teacher_ID, Email_ID, Mobile_no, Passwords FROM teacher_login WHERE Teacher_ID = '$user_id' || Email_ID = '$user_id' || Mobile_no = '$user_id'";
    $result = $connection->query($query);

    $hashed_password = '';
    $row = $result->fetch_assoc();
    if (isset($row['Passwords']) && isset($row['Teacher_ID']) && isset($row['Email_ID']) && isset($row['Mobile_no'])) {
      $hashed_password = $row['Passwords'];
      $teacher_id = $row['Teacher_ID'];
      $email_id = $row['Email_ID'];
      $mobile_no = $row['Mobile_no'];
    }


    if ($hashed_password === $password && ($user_id === $teacher_id || $user_id === $email_id || $user_id === $mobile_no)) {
      $is_logged = true;
      $_SESSION['is_logged'] = $is_logged;
      $_SESSION['teacher'] = $teacher_id;

      header("Location: ../Teacher Pages/Dashboard/dashboard.php"); // Redirect to teacher dashboard
    } else {
      $obj = new NoLoggedMessage;
      $obj->warningBox();
    }
  }
}

// on login time user selected student radio button then 
if ($r_button === "Student") {

  $user_id = $_POST['user'];
  $password = $_POST['password'];

  $query = "SELECT Register_no, Email_ID, Mobile_no, Passwords FROM student_login WHERE Register_no = '$user_id' || Email_ID = '$user_id' || Mobile_no = '$user_id'";
  $result = $connection->query($query);

  $hashed_password = '';
  $row = $result->fetch_assoc();
  if (isset($row['Passwords']) && isset($row['Register_no']) && isset($row['Email_ID']) && isset($row['Mobile_no'])) {

    $hashed_password = $row['Passwords'];
    $register_no = $row['Register_no'];
    $email_id = $row['Email_ID'];
    $mobile_no = $row['Mobile_no'];
  }


  if ($hashed_password === $password && ($user_id === $register_no || $user_id === $email_id || $user_id === $mobile_no)) {
    $is_logged = true;
    $_SESSION['is_logged'] = $is_logged;
    $_SESSION['register_no'] = $register_no;
    header("Location: ../Student Pages/Dashboard.php"); // Redirect to student dashboard

  } else {
    $obj = new NoLoggedMessage;
    $obj->warningBox();
  }
}
$connection->close();

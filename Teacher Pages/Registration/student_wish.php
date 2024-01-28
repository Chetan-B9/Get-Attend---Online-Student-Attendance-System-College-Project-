<?php
session_start();
$register_no = $_SESSION['register_no'];

$connection = mysqli_connect('localhost', 'root', '', 'getattend');

// retriving profile pic of student from database
$query = "SELECT Profile_pic FROM student WHERE Register_no= '$register_no'";

$data = $connection->query($query);
$result = $data->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Congratulation!</title>
  <link rel="stylesheet" href="../../css/Registration page style/wish_page.css" />
</head>

<body>
  <div class="container" id="main_container">
    <!-- logo  -->
    <a href="../../Home.php">
      <img src="../../Logo/Get Attend Logo ( Transparent ).png" alt="logo" />
    </a>

    <!-- student profile pic  -->
    <div class="profile_container" id="profile">
    <img id="img" src="<?php echo "../".$result['Profile_pic'] ?>" alt="Profile_pic"/>

      <?php
      // echo '<img src= "data:image/png;base64,' . base64_encode($result['Profile_pic']) . '" alt= "logo"/>';
      ?>

    </div>

    <!-- Congratulation message  -->
    <h1>Congratulations <span><?php echo $_SESSION['student_name'] . "!"; ?> </span> You have registered <span>successfully!</span></h1>
    <p>Now, You are ready to manage the attendance. So, simply Login your page. <span>Have a good day!</span> </p>
    <div class="button_box"><button onclick="window.location.href = '../Login_page.php'">Login</button></div>
    <?php
    $connection->close();
    ?>
  </div>
</body>

</html>
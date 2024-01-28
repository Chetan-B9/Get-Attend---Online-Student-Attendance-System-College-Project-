<?php
session_start();
include "../Components/Header.php";
include "../Components/MenuBox.php";

$is_logged = $_SESSION['is_logged'];
$register_no = $_SESSION['register_no'];


// if student is logged
if ($is_logged === true) {

  if(isset($_GET['logout'])){
    session_destroy();
    header("Location: ../Home.php");
  }
  // connecting database
  $connection = mysqli_connect('localhost', 'root', '', 'getattend');

  // creating class for pin generation
  class generatePin
  {
    // creating function which generate the pin code
    public function Generate()
    {
      $pinCode = rand(1000, 9999);
      return $pinCode;
    }
  }

  $object = new generatePin;
  $pinCode = $object->Generate();
  $_SESSION['pincode'] = $pinCode;

  // joining student and student_login table to get data
  $query = "SELECT student.Register_no, student.First_name, student.Last_name, student.Mobile_no, student.Email_ID, student.Profile_pic, student_college_info.College_name, student_college_info.Class FROM student INNER JOIN student_college_info ON student.Register_no = student_college_info.Register_no WHERE student.Register_no = '$register_no'";

  $result = $connection->query($query);
  if (!$result) {
    die("query failed: " . $connection->error);
  }
  $row = $result->fetch_assoc();
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- font awesome style -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../css/responsive.css" rel="stylesheet" />

    <link href="../css/Students Styles/dashboard.css" rel="stylesheet" />

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

      #contentContainer {
        width: 100%;
        height: 91.2vh;
        display: grid;
        grid-template-columns: 20% 75% 5%;

      }

      #subContainer_1 {
        height: 96%;
        box-shadow: 5px 5px 5px #d9d9d9,
          -0.5px -0.5px 5px #ffffff;

      }

      #subContainer_2 {
        padding: 1rem 2rem;

      }


      #menu_name_container {
        margin: 0rem 0rem 0rem 1.25rem;
        padding: 1rem 0rem 1rem 0rem;
      }

      #menu_name_container h5 {
        font-weight: bolder;
        height: 2.5rem;
        margin-top: 0.8rem;
        text-align: center;

      }

      #menu_box_container {

        margin-top: 1rem;
        padding: 0rem 0rem 0rem 1.25rem;

      }
    </style>
  </head>

  <body>
    <!-- including header section -->
    <?php
    $obj = new Header;
    $obj->Header("../Logo/Get Attend Logo ( Transparent ).png", "../Home.php", "../About.php");
    ?>

    <!-- creating menu bar -->
    <div id="menu_bar">
      <a href="Dashboard.php">Dashboard</a>
      <a href="giveAttendance.php">Give Attendance</a>
      <a href="viewAttendance.php">View Attendance</a>
      <a href="Student_profile.php">Profile</a>
      <a href="Dashboard.php?logout=1">Logout</a>


    </div>

    <!-- creating main content section -->
    <div id="dashboard_content">
      <div id="student_profile">
        <div id="profile_pic">
        <img id = "img" src="<?php echo $row['Profile_pic'] ?>" alt="Profile_pic"/>

          <?php
          // echo '<img  id = "img" src= "data:image/png;base64,' . base64_encode($row['Profile_pic']) . '" alt= "logo">';
          ?>
        </div>

        <!--  creating table to display information of student -->
        <table>
          <tbody>
            <tr>
              <td>Name :</td>
              <td><?php echo $row['First_name'] . " " . $row['Last_name'] ?></td>
            </tr>
            <tr>
              <td>Register no :</td>
              <td><?php echo $row['Register_no'] ?></td>
            </tr>
            <tr>
              <td>Class :</td>
              <td><?php echo $row['Class'] ?></td>
            </tr>
            <tr>
              <td>Mobile no :</td>
              <td><?php echo $row['Mobile_no'] ?></td>
            </tr>
            <tr>
              <td>Email ID :</td>
              <td><?php echo $row['Email_ID'] ?></td>
            </tr>
            <tr>
              <td>College :</td>
              <td><?php echo $row['College_name'] ?></td>
            </tr>
          </tbody>
        </table>

        <button onclick="window.location.href = 'viewAttendance.php'">View Attendance</button>
      </div>

    </div>

  </body>

  </html>

<?php
}
?>
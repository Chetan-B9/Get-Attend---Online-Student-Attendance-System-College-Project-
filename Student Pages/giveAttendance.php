<?php
session_start();
include "../Components/Header.php";
include "../Components/MenuBox.php";

// connecting database
$connection = mysqli_connect('localhost', 'root', '', 'getattend');
$trans_batch = '';
$trans_subject = '';
$trans_year = '';
$trans_class = '';


// if transferd batch, year, subject, class, attendance_code value is not null then transfer those value to empty varaibles which are difined above
if (isset($_SESSION['batch']) && isset($_SESSION['year']) && isset($_SESSION['subject'])  && isset($_SESSION['class']) && isset($_SESSION['pincode'])) {
  $trans_batch = $_SESSION['batch'];
  $trans_year = $_SESSION['year'];
  $trans_subject = $_SESSION['subject'];
  $trans_class = $_SESSION['class'];
  $generated_attendance_code = $_SESSION['pincode'];
}

if (isset($_SESSION['teacher'])) {
  $teacher_id = $_SESSION['teacher'];
}

$register_no = $_SESSION['register_no'];

$batch = '';
$year = '';
$subject = '';

// geting value of form when it is submited
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $batch = $_POST['Batch'];
  $year = $_POST['year'];
  $subject = $_POST['subject'];
}

// retriving teacher and student information from database to store it in attendance database when a student is given attendance
$teacher_info = "SELECT teacher.Teacher_ID, teacher.First_name, teacher.Last_name, teacher_college_info.College_name, teacher_college_info.Class, teacher_college_info.Subjects FROM teacher INNER JOIN teacher_college_info ON teacher.Teacher_ID = teacher_college_info.Teacher_ID WHERE teacher.Teacher_ID = '$teacher_id'";

$student_info = "SELECT College_name, Class FROM student_college_info WHERE Register_no = '$register_no'";

$result = $connection->query($teacher_info);
$result2 = $connection->query($student_info);


if (!$result) {
  die("query failed: " . $connection->error);
}
if (!$result2) {
  die("query failed: " . $connection->error);
}
$row = $result->fetch_assoc();
$row2 = $result2->fetch_assoc();

// storing retrived data in variables
$Attendance_taker = $row['First_name'] . " " . $row['Last_name'];
$Attendance_taker_ID = $row['Teacher_ID'];
$A_Subject = $row['Subjects'];



// when a student fill the form and hit register attendance button then below operation will happen
if (isset($_POST['submit'])) {


  // checking both teacher and student are belongs to same college and class, if not then it display else part
  if ($row['College_name'] === $row2['College_name'] && $trans_class === $row2['Class']) {


    $Student_entered_code = (int)$_POST['attendance_code'];

    // checking teacher generated the attendace code or not. If they generated then if condtion will execute otherwise execute else part 
    if (($trans_batch != '') && ($trans_year != '') && ($trans_subject != '')) {
      // if generated attendace code the checking transferd form data and studnet filled form data is same or not. if same then enter if conditon.
      if ($trans_batch === $batch && $trans_year === $year && $trans_subject === $subject && $generated_attendance_code === $Student_entered_code) {
        $Attendance_date = date("Y-m-d");
        $Attendance_time = date("h:i:s");

        // sending attendance data in attendance database 
        $attendanceMarkingQuery = "INSERT INTO attendance (Register_no, Attendance_type, Attendance_status, Attendance_taker, Atten_Taker_ID, A_Subject, Attendance_date, Attendance_time, Attendance_code, Batch, A_Year) VALUES ('$register_no', 'Attendance Code', 'Present', '$Attendance_taker', '$Attendance_taker_ID', '$subject', '$Attendance_date', '$Attendance_time', '$Student_entered_code', '$batch', '$year')";

        $varification_query = "SELECT Attendance_date, Batch, A_Year, A_Subject, Atten_Taker_ID, Attendance_status FROM attendance WHERE Register_no = '$register_no'";
        $varification_result = $connection->query($varification_query);

        $verification = false;
        while($varification_row= mysqli_fetch_array($varification_result)){

          if(($varification_row['Attendance_date'] === $Attendance_date) && ($varification_row['Batch'] === $batch) && ($varification_row['A_Year'] === $year) && ($varification_row['A_Subject'] === $subject) && ($varification_row['Atten_Taker_ID'] === $teacher_id) && ($varification_row['Attendance_status'] === 'Present')){
            $verification = true;
            break;

          }

        }

        if($verification === false){

                    // if attendance data stored successfully in database
                    if ($connection->query($attendanceMarkingQuery)) {
                      ?>
                        <Script>
                          alert("✅ Attendance Registered!");
                        </Script>
                      <?php
                      }
        }else{
          ?>
          <Script>
            alert("😐 Attendance Already Registered!");
          </Script>
        <?php
        }

      } else {

        // if sutdent entered wrong attendance code
        ?>
        <Script>
          alert("🙅 Attendance Code not match");
        </Script>
      <?php
      }
    } else {

      // if teacher not generated attendance code yet
      ?>
      <Script>
        alert("🙅 Sorry! The attendance code by the teacher has not generated!");
      </Script>
    <?php
    }
  } else {

    // if both student and teacher are form different college or class 
    ?>
    <Script>
      alert("🙅 Sorry! College name not match or code not generated by teacher");
    </Script>
<?php
  }


}

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
  <link href="../css/Students Styles/give_attendance2.css" rel="stylesheet" />


  <!-- <link href="../css/css for components/menubox.css" rel="stylesheet"/> -->
  <!-- <link href = "../../css/css for components/dashboard.css" rel = "stylesheet"/> -->
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


  </div>

  <!-- creating main content section -->
  <div id="code_section">
    <div class="notice">
      <p><span>Note : </span>Use this feature when teachers are using <span>Attendance code</span> method to take your attendance</p>
    </div>

    <!-- form to give attendance  -->
    <form action="giveAttendance.php" method="post">
    <!-- placeholder="Enter Batch (Ex: 2023-24)" -->
      <input type="text" name="Batch"  value = '<?php echo $trans_batch?>'  />
      <input type="text" name="year"  value = '<?php echo $trans_year?>' />

      <!-- <select name="year">
            <option value="Select Year">Select Year</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>

          </select> -->
      <!-- <input type="text" name="year" placeholder="Enter Year (Ex: 1,2,3)" /> -->
      <input type="text" name="subject" placeholder="Enter subject" value = '<?php echo $trans_subject?>' />
      <input type="text" name="attendance_code" placeholder="Enter Attendance Code" />
      <button type="submit" name="submit">Register Attendance</button>
    </form>
  </div>


</body>

</html>

<?php

?>
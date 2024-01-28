<?php
session_start();
include "../Components/Header.php";
include "../Components/MenuBox.php";

// connecting database
$connection = mysqli_connect('localhost', 'root', '', 'getattend');
$BATCH = '';
$YEAR = '';
$SUBJECT = '';

$register_no = $_SESSION['register_no'];

if (isset($_POST['submit'])) {
  $BATCH = $_POST['Batch'];
  $YEAR = $_POST['year'];
  $SUBJECT = $_POST['subject'];

  // creating query to count attendance which is given by a student 
  $given_atten_count_query = "SELECT COUNT(*) FROM attendance WHERE Register_no = '$register_no' && Batch = '$BATCH' && A_Year = '$YEAR' && A_Subject = '$SUBJECT' && Attendance_status = 'Present'";

  $given_atten_count_result = $connection->query($given_atten_count_query);
  $given_atten_count = $given_atten_count_result->fetch_assoc();

  // storing total given attendance in a variable
  $Total_given_attendance = $given_atten_count['COUNT(*)'];
}


$attendance_taker_id_query = "SELECT Atten_Taker_ID FROM attendance WHERE Register_no = '$register_no'";
$attendance_taker_id_result = $connection->query($attendance_taker_id_query);
$attendance_taker_id_row = $attendance_taker_id_result->fetch_assoc();

$student_class_query = "SELECT Class FROM student_college_info WHERE Register_no = '$register_no'";
$student_class_result = $connection->query($student_class_query);
$student_class_row = $student_class_result->fetch_assoc();

// Total attendance
$t = '';
if(isset($attendance_taker_id_row['Atten_Taker_ID'])){
  $t = $attendance_taker_id_row['Atten_Taker_ID'];
}
$c = $student_class_row['Class'];
$b = $BATCH;
$y = $YEAR;
$s = $SUBJECT;

// counting total attendance which is taken by a teacher
$total_attendance_query = "SELECT Total_attendance FROM total_attendance_record WHERE Teacher_ID = '$t' && Class = '$c' && Batch = '$b' && Std_year = '$y' && Subjects = '$s'";
$total_attendance_result = $connection->query($total_attendance_query);

if ($BATCH != '') {
  if (mysqli_num_rows($total_attendance_result) === 0) {
?>
    <script>
      alert(" 😕 Ooops! there is no attendance record!");
    </script>
<?php
  } else {
    $total_attendance_row = $total_attendance_result->fetch_assoc();

    $TotalAttendance = $total_attendance_row['Total_attendance'];
  }
}


$connection->close();

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
  <link href="../css/Students Styles/view_attendance.css" rel="stylesheet" />

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


    form select {
      width: 20rem;
      text-align: center;
      padding: 0.8rem;
      border: 0.1rem solid #c7c7c7;
      border-radius: 0.3rem;
      font-size: small;
      font-weight: bold;

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
  <div id="record_section">

    <form action="viewAttendance.php" method="post">
      <div>
        <input type="text" placeholder="Enter Batch (Ex: 2023-24)" name="Batch">
      </div>

      <div>
      <select name="year" style="font-weight: normal;">
            <option value="Select Year">Select Year</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>

          </select>
        <!-- <input type="text" placeholder="Enter Year (Ex: 1,2,3)" name="year"> -->
      </div>

      <div>
        <input type="text" placeholder="Enter Subject" name="subject">

      </div>

      <button type="submit" name="submit">View Record</button>
    </form>

    <!-- creating score board  -->
    <div id="score_board">
      <div id="box">
        <div id="taken_atten">
          <h4>Taken attendance</h4>
          <span>0</span>

        </div>
      </div>


      <div id="p_circle_holder">
        <div id="circular_progress">

          <div id="score_text">
            <h4>Attendance</h4>
            <h4>Score</h4>
            <span>0%</span>
          </div>
        </div>
      </div>


      <div id="box">
        <div id="give_atten">
          <h4>Given attendance</h4>
          <span>0</span>

        </div>
      </div>

    </div>
  </div>


  <!-- script to handle score board  -->
  <script>
    let progress_bar = document.getElementById('circular_progress');
    let value_holder = document.querySelector('#score_text span');
    let taken_atten = document.querySelector('#taken_atten span');
    let given_atten = document.querySelector('#give_atten span');

    let progressValue = takenAttenValue = givenAttenValue = 0;
    let takenAttenEndValue = <?php echo $TotalAttendance ?>;
    let givenAttenEndValue = <?php echo $Total_given_attendance ?>;
    let progressEndValue = 0;

    let speed = 0;
    if ((takenAttenEndValue < 30) && (givenAttenEndValue < 30)) {
      speed = 50;
    } else {
      speed = 5;
    }

    let totalAttenCount = setInterval(() => {
      takenAttenValue++;
      taken_atten.textContent = `${takenAttenValue}`;

      if (takenAttenValue === takenAttenEndValue) {
        clearInterval(totalAttenCount);
      }
    }, speed);

    let totalGivenAttenCount = setInterval(() => {
      if (givenAttenValue === givenAttenEndValue) {
        clearInterval(totalGivenAttenCount);
      }else{
      givenAttenValue++;
      given_atten.textContent = `${givenAttenValue}`;
      }
      
      if (givenAttenValue === givenAttenEndValue) {
        clearInterval(totalGivenAttenCount);
      }
    }, speed);
  
    if(givenAttenEndValue > takenAttenEndValue){
      alert("Invalid given attendance value");
      progressEndValue = 0;
    }
    else{
      let attendance_score = Math.trunc((givenAttenEndValue / takenAttenEndValue) * 100);
      progressEndValue = attendance_score;

    

    let progress = setInterval(() => {
      if (progressValue === progressEndValue) {
        clearInterval(progress);
      }else{
      progressValue++;
      value_holder.textContent = `${progressValue}%`;
      if (progressValue < 50) {
        progress_bar.style.background = `conic-gradient(
          red ${progressValue * 3.6}deg,
           rgb(243, 243, 243)  ${progressValue * 3.6}deg

        )`;
      } else {
        progress_bar.style.background = `conic-gradient(
          #2D54FF ${progressValue * 3.6}deg,
           rgb(243, 243, 243)  ${progressValue * 3.6}deg

        )`;
      }
    }

      if (progressValue === progressEndValue) {
        clearInterval(progress);
      }
    }, 10);
  }
  </script>

</body>

</html>
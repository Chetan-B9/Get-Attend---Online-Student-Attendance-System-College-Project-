<?php
session_start();
include "../../../Components/Header.php";
include "../../../Components/MenuBox.php";
$connection = mysqli_connect('localhost', 'root', '', 'getattend');
$BATCH = '';
$YEAR = '';
$SUBJECT = '';

$REGISTER_NO = '';


if (isset($_POST['submit'])) {
  $BATCH = $_POST['Batch'];
  $YEAR = $_POST['year'];
  $SUBJECT = $_POST['subject'];
  $REGISTER_NO = $_POST['Register_no'];



  $given_atten_count_query = "SELECT COUNT(*) FROM attendance WHERE Register_no = '$REGISTER_NO' && Batch = '$BATCH' && A_Year = '$YEAR' && A_Subject = '$SUBJECT' && Attendance_status = 'Present'";

  $given_atten_count_result = $connection->query($given_atten_count_query);
  $given_atten_count = $given_atten_count_result->fetch_assoc();
  $Total_given_attendance = $given_atten_count['COUNT(*)'];
}

if (isset($_SESSION['teacher'])) {
  $teacher_id = $_SESSION['teacher'];
}

// retriving information of student from database
$query = "SELECT student.Register_no, student.First_name, student.Last_name, student.Mobile_no, student.Email_ID, student.Profile_pic, student_college_info.College_name, student_college_info.Class FROM student INNER JOIN student_college_info ON student.Register_no = student_college_info.Register_no WHERE student.Register_no = '$REGISTER_NO'";

$result = $connection->query($query);
if (!$result) {
  die("query failed: " . $connection->error);
}
$row = $result->fetch_assoc();

$student_class_query = "SELECT Class FROM student_college_info WHERE Register_no = '$REGISTER_NO'";
$student_class_result = $connection->query($student_class_query);
$student_class_row = $student_class_result->fetch_assoc();


// Total attendance
if (isset($student_class_row['Class'])) {
  $c = $student_class_row['Class'];
} else {
  $c = "";
}

$b = $BATCH;
$y = $YEAR;
$s = $SUBJECT;

// counting total attendance which is taken by a teacher
$total_attendance_query = "SELECT Total_attendance FROM total_attendance_record WHERE Teacher_ID = '$teacher_id' && Class = '$c' && Batch = '$b' && Std_year = '$y' && Subjects = '$s'";
$total_attendance_result = $connection->query($total_attendance_query);

if ($REGISTER_NO != '') {
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
  <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- font awesome style -->
  <link href="../../../css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="../../../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../../../css/responsive.css" rel="stylesheet" />
  <link href="../../../css/Students Styles/view_attendance.css" rel="stylesheet" />
  <link href="../../../\css\Students Styles\teacher_view_attendance.css" rel="stylesheet" />

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

    #dashboard_content {
      width: 90%;
      background: #f4f3f3;
      box-shadow: 5px 5px 5px #d9d9d9,
        -0.5px -0.5px 5px #ffffff;
    }

    #student_profile {
      width: 60%;
      background: none;
      box-shadow: none;
    }



    #form2 {
      margin-top: -1rem;
      display: flex;
      flex-direction: column;
    }

    #teacher_side_input {
      width: 100%;
    }

    #teacher_side_input select {
      width: 15rem;
    }

    form input, form select{
      width: 14rem;
      text-align: center;
      padding: 0.8rem;
      border: 0.1rem solid #c7c7c7;
      border-radius: 0.3rem;
      font-size: small;

    }

    form button {
      margin: 1rem 0rem;
      width: 100%;
    }

    #score_board {
      width: 50%;
      display: none;
      grid-template-columns: none;
      display: flex;
      flex-direction: column;
      row-gap: 1rem;
    }

    #profile_pic{
    width: 9rem;
    height: 9rem;
    border: 0.1rem solid rgb(194, 194, 194);
    border-radius: 50%;
    /* padding: 1rem; */
    overflow: hidden;
}

#profile_pic #img{
    width:100%;
    height:100%;
    object-fit:cover;
  }
  </style>
</head>

<body>
  <?php
  $obj = new Header;
  $obj->Header("../../../Logo/Get Attend Logo ( Transparent ).png", "../../../Home.php", "../../../About.php");
  ?>
  <div id="contentContainer">
    <div id="subContainer_1">
      <div id="menu_name_container">
        <h3 id="menu_name">View Attendance</h3>
      </div>

      <div id="menu_box_container">
        <?php
        $dashB = new MenuBox;
        $dashB->menubox("fa-solid fa-house", "Dashboard", "../dashboard.php");
        $dashB->menubox("fa-solid fa-users", "Get Attendance", "../Get Attendance/attendance_type.php",);
        $dashB->menubox("fa-solid fa-eye", "Veiw Attendance", "teacherViewAttendance.php");
        ?>

      </div>

    </div>
    <div id="subContainer_2">


      <div id="record_section">

        <form action="teacherViewAttendance.php" method="post" id="form2">

          <div id="teacher_side_input">
            <input type="text" placeholder="Enter Register" name="Register_no">
            <input type="text" placeholder="Enter Batch" name="Batch">
            <select name="year">
            <option value="Select Year">Select Year</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>

          </select>
            <!-- <input type="text" placeholder="Enter Year" name="year"> -->
            <input type="text" placeholder="Enter Subject" name="subject">
          </div>

          <button type="submit" name="submit">View Record</button>
        </form>

        <!-- attendance record  -->
        <div id="dashboard_content">
          <div id="student_profile">
            <div id="profile_pic">
              <img id = "img" src="<?php echo "../../".$row['Profile_pic']?>" alt="student profile">
              
            </div>

            <table>
              <tbody>
                <tr>
                  <td>Name :</td>
                  <td><?php

                      if (isset($row['First_name']) && isset($row['Last_name'])) {
                        echo $row['First_name'] . " " . $row['Last_name'];
                      } else {
                        echo "________________";
                      } ?></td>
                </tr>
                <tr>
                  <td>Register no :</td>
                  <td><?php
                      if (isset($row['Register_no'])) {
                        echo $row['Register_no'];
                      } else {
                        echo "________________";
                      }
                      ?></td>
                </tr>
                <tr>
                  <td>Class :</td>
                  <td><?php if (isset($row['Class'])) {
                        echo $row['Class'];
                      } else {
                        echo "________________";
                      } ?></td>
                </tr>
                <tr>
                  <td>Mobile no :</td>
                  <td><?php if (isset($row['Mobile_no'])) {
                        echo $row['Mobile_no'];
                      } else {
                        echo "________________";
                      } ?></td>
                </tr>
                <tr>
                  <td>Email ID :</td>
                  <td><?php if (isset($row['Email_ID'])) {
                        echo $row['Email_ID'];
                      } else {
                        echo "________________";
                      } ?></td>
                </tr>
                <tr>
                  <td>College :</td>
                  <td><?php if (isset($row['College_name'])) {
                        echo $row['College_name'];
                      } else {
                        echo "________________";
                      } ?></td>
                </tr>
              </tbody>
            </table>

          </div>

          <!-- score board  -->
          <div id="score_board">
            <div id="box">
              <div id="taken_atten">
                <h4>Taken attendance</h4>
                <span>0</span>

              </div>
            </div>

            <div id="box">
              <div id="give_atten">
                <h4>Present</h4>
                <span style="color:#00c853;">0</span>
              </div>
            </div>

            <div id="box">
              <div id="give_atten">
                <h4>Absent</h4>
                <span id="absent" style="color:red;">0</span>
              </div>
            </div>


            <div id="procress_circle_container">
              <div id="p_circle_holder">
                <div id="circular_progress">

                  <div id="score_text">
                    <h4>Attendance</h4>
                    <h4>Score</h4>
                    <span>0%</span>
                  </div>
                </div>
              </div>
            </div>

          </div>

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
    let absents = document.querySelector('#give_atten #absent');


    let progressValue = takenAttenValue = givenAttenValue = absentValue = 0;
    let takenAttenEndValue = <?php echo $TotalAttendance ?>;
    let givenAttenEndValue = <?php echo $Total_given_attendance ?>;
    let totalAbsentValue = takenAttenEndValue - givenAttenEndValue;
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

    let totalAbsentCount = setInterval(() => {
      if (absentValue === totalAbsentValue) {
        clearInterval(totalAbsentCount);
      }else{
        absentValue++;
        absents.textContent = `${absentValue}`;
      }


      if (absentValue === totalAbsentValue) {
        clearInterval(totalAbsentCount);
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

<?php


?>
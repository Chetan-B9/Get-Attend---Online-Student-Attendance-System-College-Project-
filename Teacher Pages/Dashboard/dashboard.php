<?php

session_start();
include "../../Components/Header.php";
include "../../Components/MenuBox.php";


$is_logged = $_SESSION['is_logged'];
$teacher_id = $_SESSION['teacher'];


// echo $teacher_id;
$connection = mysqli_connect('localhost', 'root', '', 'getattend');

// $query1 = "SELECT First_name FROM teacher WHERE Teacher_ID = '$teacher_id'";
// $result = $connection->query($query1);


// $row = $result->fetch_assoc();

// $teacher_name = $row['First_name'];


// getting info of teacher from database
$query2 = "SELECT teacher.First_name, teacher.Last_name, teacher.Profile_pic, teacher_college_info.College_name, teacher_college_info.Class, teacher_college_info.Std_year, teacher_college_info.Semister FROM teacher_college_info INNER JOIN teacher ON teacher.Teacher_ID = teacher_college_info.Teacher_ID WHERE teacher.Teacher_ID = '$teacher_id'";
$result2 = $connection->query($query2);
if (!$result2) {
  die("query failed: " . $connection->error);
}

$teacher_info_row = $result2->fetch_assoc();

// getting all courses of teacher 
$course_query = "SELECT Courses FROM teacher_courses WHERE Teacher_ID = '$teacher_id'";
$course_result = $connection->query($course_query);

$course = '';
if(isset($_POST['courseSubmit'])){
    $course = $_POST['courses'];
}
// echo $course;

// getting info of student from database 
$query3 = "SELECT student.Register_no, student.First_name, student.Last_name, student.Profile_pic,student_college_info.College_name, student_college_info.Class, student_college_info.Std_year, student_college_info.Semister FROM student INNER JOIN student_college_info ON student.Register_no = student_college_info.Register_no INNER JOIN teacher_college_info ON student_college_info.College_name = teacher_college_info.College_name WHERE teacher_college_info.Teacher_ID = '$teacher_id' AND teacher_college_info.College_name = student_college_info.College_name AND student_college_info.Class = '$course'";

$result3 = $connection->query($query3);
if (!$result3) {
  die("query failed: " . $connection->error);
}

$total_students = mysqli_num_rows($result3);




$connection->close();


// if teacher logged with correct username and password 
if ($is_logged === true) {
  if(isset($_GET['logout'])){
    session_destroy();
    header("Location: ../../Home.php");
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        padding: 0rem 1rem;

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

      .container {
        width: 95%;
        height: 2.875rem;
        margin-top: 0.8rem;
        display: flex;
        border-radius: 0.3rem;
        box-shadow: 5px 5px 5px #d9d9d9,
          -0.5px -0.5px 5px #ffffff;
      }

      .container input {
        width: 94%;
        height: 2.875rem;

        background: #eef3f3;
        outline: none;
        border: none;
        border-radius: 0.2rem;
        padding-left: 2rem;
        font-family: 'Poppins', sans-serif;
        font-size: smaller;
      }

      .search_button {
        width: 6%;
        height: 2.875rem;
        background: #FFFFFF;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 0.2rem;
      }

      .search_button i {
        font-size: 1.3rem;
      }

      .search_button:hover {
        color: white;
        cursor: pointer;
        background: #2D54FF;
      }

      /* css for main content */
      #welcom_msg {
        margin: 2rem 1rem;
        padding: 0.5rem 0rem;
        background: #f5f5f5;
        display: flex;
        column-gap: 1rem;
        box-shadow: 5px 5px 5px #d9d9d9,
          -0.5px -0.5px 5px #ffffff;
      }

      #welcom_msg #teacher_profile {
        width: 6rem;
        height: 6rem;
        border: 0.1rem solid rgb(194, 194, 194);
        border-radius: 50%;
        overflow: hidden;
      }

      #welcom_msg #teacher_profile #img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      #welcom_msg #teacher_data {
        width: 60%;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }

      #welcom_msg p {
        margin-bottom: 0rem;
      }

      #welcom_msg p:nth-child(1) {
        font-weight: bolder;
        font-size: 1.1rem;
      }

      #welcom_msg p:nth-child(2),
      p:nth-child(3) {
        font-size: smaller;
      }

      #edit_prof{

        /* background: red; */
        width: 20%;
        height: 100%;
        padding: 2rem;
        display: flex;
        justify-content: right;
      }

      h4 {
        margin: 1rem;
        text-align: center;

      }

      h4 span {
        color: #2D54FF;
        font-weight: bolder;
      }

      #students_container {
        margin-top: 2rem;
        width: 100%;
        padding: 0.5rem 0.5rem;
        box-shadow: 5px 5px 5px #d9d9d9,
          -0.5px -0.5px 5px #ffffff;
      }

      #students {
        width: 100%;
        background: #f5f5f5;
        padding: 0.1rem 1rem;
        margin-bottom: 0.8rem;
        border-radius: 0.3rem;
        display: flex;
        column-gap: 0.8rem;
        box-shadow: 5px 5px 5px #d9d9d9,
          -0.5px -0.5px 5px #ffffff;
      }

      /* #students .profile_container{
    display: flex;
    justify-content: center;
    align-items: center;
} */

      #students #profile {
        width: 4rem;
        height: 4rem;
        border: 0.1rem solid rgb(194, 194, 194);
        border-radius: 50%;
        overflow: hidden;


      }

      #students #profile #img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      #students #student_info p {
        margin-bottom: 0rem;
      }

      #students #student_info p:nth-child(1) {
        font-weight: bold;
      }

      #students #student_info p:nth-child(2) {
        color: #2D54FF;
        font-size: smaller;

      }

      #coursePart{
        width: 98.5%;
        padding: 1rem;
        margin-bottom: 4rem;
        box-shadow: 5px 5px 5px #d9d9d9,
               -0.5px -0.5px 5px #ffffff;
      }

      #coursePart select{
      
    width: 20rem;
    /* text-align: center; */
    padding: 0.8rem;
    border: 0.1rem solid #c7c7c7;
    border-radius: 0.3rem;
    font-size: small;
    
}

#coursePart button{
  width: 20rem;
    height: 3.5rem;
    border-radius: 0.4rem;
    background: #2D54FF;
    border: 0.25rem solid #D5DDFE;
    font-size: small;
    margin-left: 1rem;
    /* border: 0.25rem solid #f5f5f5; */  
    color: white;
   cursor: pointer;
}
      
#coursePart button:hover{
  transition: all .3s;
    background-color: transparent;
  color: #2D54FF;
}
    </style>
  </head>

  <body>
    <?php
    $obj = new Header;
    $obj->Header("../../Logo/Get Attend Logo ( Transparent ).png", "../../Home.php", "../../About.php");
    ?>
    <div id="contentContainer">
      <div id="subContainer_1">
        <div id="menu_name_container">
          <h3 id="menu_name">Dashboard</h3>
        </div>

        <div id="menu_box_container">
          <?php
          $dashB = new MenuBox;
          $dashB->menubox("fa-solid fa-house", "Dashboard", "dashboard.php");
          $dashB->menubox("fa-solid fa-users", "Get Attendance", "Get Attendance/attendance_type.php",);
          $dashB->menubox("fa-solid fa-eye", "Veiw Attendance", "View Attendance/teacherViewAttendance.php");
          $dashB->menubox("fa-solid fa-right-from-bracket", "Logout", "dashboard.php?logout=1");

          ?>

        </div>

      </div>
      <div id="subContainer_2">

        <!-- <SearchBox /> -->
        <!-- <div class="container">
          <input type='text' placeholder='Search Students' />
          <div class="search_button">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>

        </div> -->
        <!-- <div id="welcomeText" style="text-align: center; margin: 2rem 0rem;">
          <h1 style="font-weight: bolder;">Welcome <span style="font-weight: bolder; color: #2D54FF;"></span></h1>
        </div> -->

        <div id="welcom_msg">
          <div class="profile_container" id="teacher_profile">
            <img id = "img" src="<?php echo "../".$teacher_info_row['Profile_pic'] ?>" alt="Profile_pic" srcset=""/>
            <?php
            // echo '<img  id = "img" src= "data:image/png;base64,' . base64_encode($teacher_info_row['Profile_pic']) . '" alt= "logo">';
            ?>

          </div>

          <!-- showing teacher data  -->
          <div id="teacher_data">
            <p>Pf.<?php echo $teacher_info_row['First_name'] . " " . $teacher_info_row['Last_name'] ?></p>
            <p>ID: <?php echo $teacher_id ?></p>
            <p><?php echo $teacher_info_row['College_name'] ?></p>

          </div>

          <div id="edit_prof"><a href="../teacher_prof.php">Edit profile</a></div>

         
        </div>

        <div id="rules_container">
          <div id="steps_title" style="display: flex; align-items:left; margin-bottom: 4rem;">
            <h4 style="font-weight: bolder; margin-top: 1.5rem">Steps to get attendance</h4>
          </div>
          <div id="rules" style="display: flex; justify-content:center; align-items:center; flex-direction: column">
            <div id="rule1" style="display: flex; justify-content:center; align-items:center; column-gap: 2rem;"><h1 style="color:  rgb(225, 225, 225); font-weight: bolder;">1. </h1><h6>First click on <span style="color: #2D54FF;">Get Attendance</span> button</h6></div>
            <div id="rule2" style="display: flex; justify-content:center; align-items:center; column-gap: 2rem;"><h1 style="color:  rgb(225, 225, 225); font-weight: bolder;">2. </h1><h6>Fill Required details to <span style="color: #2D54FF;">generate code</span> </h6></div>
            <div id="rule3" style="display: flex; justify-content:center; align-items:center; column-gap: 2rem;"><h1 style="color:  rgb(225, 225, 225); font-weight: bolder;">3. </h1><h6>Now, click on <span style="color: #2D54FF;" >generate code</span> button</h6></div>

          </div>
        </div>
      </div>
    </div>
  </body>

  </html>

<?php

} else {

?>

  <script>
    alert("Invalid Email or Password");
  </script>
<?php
}
?>
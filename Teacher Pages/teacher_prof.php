<?php

session_start();
include "../Components/Header.php";
include "../Components/MenuBox.php";


$connection = mysqli_connect('localhost', 'root', '', 'getattend');
$teacher_id = $_SESSION['teacher'];

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])){

  // update data
  $firstName = $_POST['f_name'];
  $lastName = $_POST['l_name'];
  $Teacher_id = $_POST['teacher_id'];
  $mobileNo = $_POST['mobile_no'];
  // $class = $_POST['class'];
  $emailID = $_POST['email_id'];
  $college = $_POST['college'];
  // echo $firstName;

  $update_query1 = "UPDATE teacher SET Teacher_ID = '$Teacher_id', First_name = '$firstName', Last_name = '$lastName', Mobile_no = '$mobileNo', Email_ID = '$emailID' WHERE Teacher_ID = '$teacher_id'";
  $update_query2 = "UPDATE teacher_college_info SET Teacher_ID = '$Teacher_id', College_name = '$college' WHERE  Teacher_ID = '$teacher_id'";

  $update_query3 = "UPDATE teacher_login SET Teacher_ID = '$Teacher_id', Email_ID = '$emailID', Mobile_no = '$mobileNo' WHERE Teacher_ID = '$teacher_id'";
  
  $update_query4 = "UPDATE attendance SET Atten_Taker_ID = '$Teacher_id' WHERE Atten_Taker_ID = '$teacher_id'";
  // $update_query5 = "UPDATE Atten_Taker_ID = '$Teacher_id' WHERE Atten_Taker_ID = '$teacher_id'";
  $update_query5 = "UPDATE total_attendance_record SET Teacher_ID = '$Teacher_id' WHERE Teacher_ID = '$teacher_id'";

  if($connection->query($update_query1)){
    if($connection->query($update_query2)){
      if($connection->query($update_query3)){
        if($connection->query($update_query4)){
          if($connection->query($update_query5)){
            echo "<script>";
            echo "alert('✅ Profile updated successfully');";
            echo "</script>";

            if($teacher_id != $Teacher_id){
              echo "<script>";
              echo "window.location.href = 'Login_page.php'";
              echo "</script>";
            }
          }else{
            echo "<script>";
            echo "alert('😔 Sorry! Profile not updated');";
            echo "</script>";
      
          }
          }
        }
      }

  }else{
    echo "<script>";
    echo "alert('😔 Sorry! Profile not updated');";
    echo "</script>";
  }

  // reset values 
  // $firstName = $lastName = $Reg_no = $mobileNo = $emailID = $college = '';
}


// joining student and student_login table to get data
$query = "SELECT teacher.Teacher_ID, teacher.First_name, teacher.Last_name, teacher.Mobile_no, teacher.Email_ID, teacher.Profile_pic, teacher_college_info.College_name FROM teacher INNER JOIN teacher_college_info ON teacher.Teacher_ID = teacher_college_info.Teacher_ID WHERE teacher.Teacher_ID = '$teacher_id'";

$result = $connection->query($query);
if (!$result) {
  die("query failed: " . $connection->error);
}
$row = $result->fetch_assoc();

// update password query
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['pass_submit'])){

  if(strlen($_POST['new_password']) > 0){
    $new_password = $_POST['new_password'];

    $update_pass_query = "UPDATE teacher_login SET Passwords = '$new_password' WHERE Teacher_ID = '$teacher_id'";

    if($connection->query($update_pass_query)){
    echo "<script>";
    echo "alert('✅ Password updated successfully!');";
    echo "</script>";
    }
    else{
    echo "<script>";
    echo "alert('😔 Password not updated');";
    echo "</script>";
  }
}else{
  echo "<script>";
  echo "alert('😐 Please enter new password');";
  echo "</script>";
}
}

//codes for get password
$password_query = "SELECT Passwords FROM teacher_login WHERE Teacher_ID = '$teacher_id'";
$password_query_result = $connection->query($password_query);
$password = $password_query_result->fetch_assoc();

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

<!-- fonts style -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

<!-- font awesome style -->
<link href="../css/font-awesome.min.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="../css/style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="../css/responsive.css" rel="stylesheet" />
    <link href="../css/Students Styles/student_profile.css" rel="stylesheet" />
    <link href="../css/Teacher_page_styles/teacher_profile.css" rel="stylesheet" />


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
    </style>
  </head>

  <body>
    <?php
    $obj = new Header;
    $obj->Header("../Logo/Get Attend Logo ( Transparent ).png", "../Home.php", "../About.php");
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

          ?>

        </div>

      </div>
      <div id="subContainer_2">

      <div id="main_container">
    <div class="profile">
        <div id="heading1"><h4>Profile</h4></div>
        <div id="pro_info">
        <div id="profile_pic">
          <img id="img" src ="<?php echo $row['Profile_pic'] ?>" alt="Profile_pic" srcset="">
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
              <td><?php echo $row['Teacher_ID'] ?></td>
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
        </div>
       

        <!-- <button onclick="window.location.href = 'viewAttendance.php'">View Attendance</button> -->
      </div>
        <div id="updates">
            <div id="update_profile">
                <div id="heading2"><h4>Update Profile</h4></div>
                <div id="update_prof">
                    <form action="teacher_prof.php" method="post">
                    <div class="row">
                        <input class="short_field" type="text" value="<?php echo $row['First_name']?>" name = "f_name" placeholder="First name">
                        <input class="short_field" type="text" value="<?php echo $row['Last_name']?>" name = "l_name" placeholder="Last name">
                    </div>

                    <div class="row">
                        <input class="short_field" type="text" value="<?php echo $row['Teacher_ID']?>" name = "teacher_id" placeholder="Teacher ID">
                        <input class = "short_field" type="text" value="<?php echo $row['Mobile_no']?>" name = "mobile_no" placeholder="Mobile no">
                    </div>

                    <div class="row">
                       <input class = "long_field" type="email" value="<?php echo $row['Email_ID']?>" name = "email_id" placeholder="Email ID">
                    </div>

                    <div class="row">
                       <input class = "long_field" type="text" value="<?php echo $row['College_name']?>" name = "college" placeholder="College">
                    </div>

                    <div id="update_button">
                        <button type="submit" name = "submit">Update Profile</button>
                    </div>
                    </form>
                </div>

             </div>
           <div id="change_password">
                <div id="heading3"><h4>Change Passoward</h4></div>
                <div id="pass_info">
                    <form action="teacher_prof.php" method="post">
                    <div class="row">
                        <input  id= "old_pass" class="short_field" type="password" name= "old_password" placeholder="Enter old password">
                        <input id="new_pass" class="short_field" type="password" name= "new_password" minlength="8" placeholder="Enter new password" disabled>
                    </div>
                    <div id="change_button">
                        <button  id="sub_btn" type="submit" name = "pass_submit" disabled>Can't Change Password</button>
                    </div>
                    </form>
                </div>
           </div>
        </div>    
    </div>
      </div>
    </div>

    <script>
    let student_password = "<?php echo $password['Passwords']?>";
    let old_password = document.getElementById('old_pass');
    let new_password = document.getElementById('new_pass');
    let submit_button = document.getElementById('sub_btn');

    let old_pass_input = '';

    old_password.addEventListener('input', () => {
       old_pass_input = old_password.value;

       if(old_pass_input != student_password){
         old_password.style.border = "0.1rem solid red";
         new_password.disabled = true;
         submit_button.disabled = true;
        submit_button.textContent = "Can't Change Password";

       }
       else{
        old_password.style.border = "0.1rem solid green";
        new_password.disabled = false;
        submit_button.disabled = false;
        submit_button.textContent = "Change Password";
       }
    });

    new_password.addEventListener('input', () => {
      if(new_password.value.length < 8){
          new_password.style.border = "0.1rem solid red";

      }else{
         new_password.style.border = "0.1rem solid green";

      }
    })
  </script>
  </body>

  </html>

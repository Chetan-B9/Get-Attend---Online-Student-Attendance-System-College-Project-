<?php
  session_start();
  include "../Components/Header.php";

  $connection = mysqli_connect('localhost', 'root', '', 'getattend');
  $register_no = $_SESSION['register_no'];

  if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])){

    // update data
    $firstName = $_POST['f_name'];
    $lastName = $_POST['l_name'];
    $Reg_no = $_POST['reg_no'];
    $mobileNo = $_POST['mobile_no'];
    $class = $_POST['class'];
    $emailID = $_POST['email_id'];
    $college = $_POST['college'];
    // echo $firstName;

    $update_query1 = "UPDATE student SET Register_no = '$Reg_no', First_name = '$firstName', Last_name = '$lastName', Mobile_no = '$mobileNo', Email_ID = '$emailID' WHERE Register_no = '$register_no'";
    $update_query2 = "UPDATE student_college_info SET  Register_no = '$Reg_no', College_name = '$college', Class = '$class' WHERE Register_no = '$register_no'";
    $update_query3 = "UPDATE student_login SET Register_no = '$Reg_no', Email_ID = '$emailID', Mobile_no = '$mobileNo' WHERE Register_no = '$register_no'";
    $update_query4 = "UPDATE attendance SET Register_no = '$Reg_no' WHERE Register_no = '$register_no'";

    if($connection->query($update_query1)){
      if($connection->query($update_query2)){
        if($connection->query($update_query3)){
          if($connection->query($update_query4)){
            echo "<script>";
            echo "alert('✅ Profile updated successfully');";
            echo "</script>";
            
            if($register_no != $Reg_no){
              echo "<script>";
              echo "window.location.href = '../Teacher Pages/Login_page.php'";
              echo "</script>";
            }
          }else{
          echo "<script>";
          echo "alert('😔 Sorry! Profile not updated');";
          echo "</script>";
  
        }
        
      }
    }
    }else{
      echo "<script>";
      echo "alert('😔 Sorry! Profile not updated');";
      echo "</script>";
    }

    // reset values 
    $firstName = $lastName = $Reg_no = $mobileNo = $class = $emailID = $college = '';
  }


  // joining student and student_login table to get data
  $query = "SELECT student.Register_no, student.First_name, student.Last_name, student.Mobile_no, student.Email_ID, student.Profile_pic, student_college_info.College_name, student_college_info.Class FROM student INNER JOIN student_college_info ON student.Register_no = student_college_info.Register_no WHERE student.Register_no = '$register_no'";

  $result = $connection->query($query);
  if (!$result) {
    die("query failed: " . $connection->error);
  }
  $row = $result->fetch_assoc();

  // update password query
  if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['pass_submit'])){

    if(isset($_POST['new_password'])){
      $new_password = $_POST['new_password'];

      $update_pass_query = "UPDATE student_login SET Passwords = '$new_password' WHERE Register_no = '$register_no'";

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
  $password_query = "SELECT Passwords FROM student_login WHERE Register_no = '$register_no'";
  $password_query_result = $connection->query($password_query);
  $password = $password_query_result->fetch_assoc();
  



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
    <link href="../css/Students Styles/student_profile.css" rel="stylesheet" />


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

    <div id="main_container">
    <div class="profile">
        <div id="heading1"><h4>Profile</h4></div>
        <div id="pro_info">
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
        </div>
       

        <!-- <button onclick="window.location.href = 'viewAttendance.php'">View Attendance</button> -->
      </div>
        <div id="updates">
            <div id="update_profile">
                <div id="heading2"><h4>Update Profile</h4></div>
                <div id="update_prof">
                    <form action="Student_profile.php" method="post">
                    <div class="row">
                        <input class="short_field" type="text" value="<?php echo $row['First_name']?>" name = "f_name" placeholder="First name">
                        <input class="short_field" type="text" value="<?php echo $row['Last_name']?>" name = "l_name" placeholder="Last name">
                    </div>

                    <div class="row">
                        <input class="short_field" type="text" value="<?php echo $row['Register_no']?>" name = "reg_no" placeholder="Register no">
                        <input class="short_field" type="text" value="<?php echo $row['Class']?>" name = "class" placeholder="Class">
                    </div>

                    <div class="row">
                       <input class = "long_field" type="text" value="<?php echo $row['Mobile_no']?>" name = "mobile_no" placeholder="Mobile no">
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
                    <form action="Student_profile.php" method="post">
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

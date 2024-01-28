<?php

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);
//connecting to database
$connection = mysqli_connect('localhost', 'root', '', 'getattend');

// getting data from teacher registration form when a teacher filled  the registration form and submited
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["form1_first_name"])){

    $first_name = $_POST['form1_first_name'];
    $last_name = $_POST['last_name'];
    $teacher_id = $_POST['teacher_id'];
    $gender = $_POST['gender'];
    $DOB = $_POST['dob'];
    $email_id = $_POST['email_id'];
    $password = $_POST['password'];
    $confirm_password = $_POST['con_password'];
    $mobile_no = $_POST['m_number'];
    $college_name = $_POST['college_name'];
    

    // courses 

    $course_array = array();

    if(isset($_POST['course_1'])) array_push($course_array, $_POST['course_1'])  ;
    if(isset($_POST['course_2'])) array_push($course_array, $_POST['course_2']) ;
    if(isset($_POST['course_3'])) array_push($course_array, $_POST['course_3']) ;
    if(isset($_POST['course_4'])) array_push($course_array, $_POST['course_4']); 
    if(isset($_POST['course_5'])) array_push($course_array, $_POST['course_5']) ;


    
    // }
    // $profile_pic = ;
    // $image = file_get_contents($profile);
    $profile_image_path = '';
    if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0){

        $uploadDirectory = "../Uploads/Teacher_uploads/";
 
        // creating uniqui file name
        $imageName = uniqid()."_".$_FILES['profile_pic']['name'];
        $imagePath = $uploadDirectory.$imageName;
 
        if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $imagePath)){
            $profile_image_path = $imagePath;
        }
     }else{
         echo "error";
     }

// storing filled data in database 
$sql1 = "INSERT INTO teacher (Teacher_ID, First_name, Last_name, Gender, DOB, Email_ID, Mobile_no, Profile_pic) VALUES ('$teacher_id', '$first_name', '$last_name', '$gender', '$DOB', '$email_id', '$mobile_no', '$profile_image_path')";
$sql2 = "INSERT INTO teacher_college_info ( Teacher_ID, College_name) VALUES ( '$teacher_id', '$college_name')";
$sql3 = "INSERT INTO teacher_login ( Teacher_ID, Email_ID, Mobile_no, Passwords) VALUES ( '$teacher_id', '$email_id', '$mobile_no', '$password')";

if($connection->query($sql1)){


    if($connection->query($sql2)){

          foreach($course_array as $course){
              $sql4 = "INSERT INTO teacher_courses ( Teacher_ID, Courses) VALUES ('$teacher_id','$course')";
              $connection->query($sql4);
          }
        
         if($connection->query($sql3)){

            // if all 3 querys are successfully executed
            $_SESSION['name'] = $first_name;
            $_SESSION['teacher_id'] = $teacher_id;
            $pic =  $_SESSION['teacher_id'];
     
            ?>

            <!-- // redirecting to wish page when a teacher successfully registered  -->
            <script>
               window.location.href = "../Teacher Pages/Registration/teacher_wish.php";
            </script>
            <?php
           
       }
    }
}
else{
    echo $connection->error;
}

}

// getting data from student registration form when a student filled  the registration form and submited

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["form2_first_name"])){

    $first_name = $_POST['form2_first_name'];
    $last_name = $_POST['last_name'];
    $register_no = $_POST['register_no'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $DOB = $_POST['dob'];
    $email_id = $_POST['email_id'];
    $password = $_POST['password'];
    $confirm_password = $_POST['con_password'];
    $mobile_no = $_POST['m_number'];
    $college_name = $_POST['college_name'];
    $class = $_POST['class'];
    // $year = $_POST['year'];
    // $semister = $_POST['semister'];
    // $profile_pic = $_POST['profile_pic'];
    $profile_image_path2 = '';
    if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0){

        $uploadDirectory2 = "../Uploads/Student_uploads/";
 
        // creating uniqui file name
        $imageName2 = uniqid()."_".$_FILES['profile_pic']['name'];
        $imagePath2 = $uploadDirectory2.$imageName2;
 
        if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $imagePath2)){
            $profile_image_path2 = $imagePath2;
        }
     }else{
         echo "error";
     }

    // storing data into the student database 
    $sql1 = "INSERT INTO student ( Register_no, First_name, Last_name,  S_Address, Gender, DOB, Email_ID, Mobile_no, Profile_pic) VALUES ( '$register_no', '$first_name', '$last_name', '$address', '$gender', '$DOB', '$email_id', '$mobile_no', '$profile_image_path2')";

    $sql2 = "INSERT INTO student_college_info ( Register_no, College_name, Class) VALUES ( '$register_no', '$college_name', '$class')";

    $sql3 = "INSERT INTO student_login ( Register_no, Email_ID, Mobile_no, Passwords) VALUES ( '$register_no', '$email_id', '$mobile_no', '$password')";

    
    if($connection->query($sql1)){
        if($connection->query($sql2)){
            //  echo "Registered successfully!";
             if($connection->query($sql3)){

                // if all 3 querys are successfully executed
            $_SESSION['student_name'] = $first_name;
            $_SESSION['register_no'] = $register_no;
            // $_SESSION['student_profile'] = $profile_pic;
                ?>

            <!-- // redirecting to wish page when a student successfully registered  -->
            <script>
               window.location.href = "../Teacher Pages/Registration/student_wish.php";
            </script>
            <?php
           }
        }
        
    }
    else{
        echo "failed to execute query";
    }
    
    $connection->close();
    }

?>
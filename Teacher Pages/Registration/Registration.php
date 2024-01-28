<?php
    $connection = mysqli_connect("localhost", "root", "", "getattend");

    $teacher_query = "SELECT Teacher_ID, Email_ID FROM teacher";
    $student_query = "SELECT Register_no, Email_ID FROM student";

    $teacher_result = $connection->query($teacher_query);
    if (!$teacher_result) {
      die("query failed: " . $connection->error);
    }
?>


<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Teacher Registration Page</title>
  <link href="../../css/Registration page style/Registration_form2.css" rel="stylesheet" />
</head>

<body>
  <div id="main_container">
    <a href="../../Home.php">
      <img src="../../Logo/Get Attend Logo ( Transparent ).png" alt="logo" />
    </a>
    <!-- <a href="#">
        <img
          src="../Logo/Get Attend Logo ( Transparent ).png"
          alt="logo"
          
        />
      </a> -->
    <h3 id="heading">Register As</h3>
    <div id="sub_container">

      <div id="btn_container">
        <button class="teacher_panel_btn" id="Tbutton" onclick="showForm('form1')">Teacher</button>
        <button class="student_panel_btn" id="Sbutton" onclick="showForm('form2')">Student</button>

      </div>
    </div>

    <!-- creating form  -->
    <form id="form1" method="POST" action="../../Database/database.php" onsubmit="return validate()" style="display:block" name="form11" enctype="multipart/form-data">
    <h3>Teacher <span>Registration</span> Form</h3>

<div>
  <div id="input_Fields_container">
    <!-- first and last name fields  -->
    <div class="row">
      <div id="test">
        <input id="normal_fields" class = "first_name, f1" type="text" placeholder="First name" name="form1_first_name" required/>
        <p id="T_first_name_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;"></p>
      </div>
      <div id="test">
        <input id="normal_fields" class = "last_name, f2" type="text" placeholder="Last name" name="last_name" required/>
        <p id="T_last_name_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;"></p>
      </div>
    </div>

    <!-- address field  -->
    <div>
      <input id="large_fields" class = "f3" type="text" placeholder="Create Teacher ID" name="teacher_id" style="margin-top: 1rem;" required/>
      <p id="teacher_id_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; margin-top: -2%; margin-bottom:1%; font-size: 0.7rem; display: none;"></p>
      <p id="teacher_id_verification" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; margin-top: -2%; margin-bottom:1%; font-size: 0.7rem; display: none;">This teacher id already exist!</p>

    </div>

    <!-- gender and dob fields  -->
    <div class="row">
      <div id="test">
        <select id="normal_fields"  class = "f4" name="gender">
           <option value="Select Gender">Select Gender</option>
           <option value="Male">Male</option>
           <option value="Female">Female</option>
        </select>
        <!-- <input id="normal_fields" type="text" placeholder="Gender" name="gender"/> -->
        <p id="T_gender_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;">Select your gender</p>

      </div>

      <div id="test">
        <input id="normal_fields" class = "f5" type="text" placeholder="Date of birth" name="dob" onfocus="(this.type = 'date')" required/>
        <p id="T_dob_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;">Enter valid date</p>

      </div>
    </div>

    <!-- email-id field  -->
    <div>
      <div id="test">
        <input id="large_fields" class = "f6" type="email" placeholder="Email Id" name="email_id" style="margin-top: 1rem;" required/>
        <p id="T_email_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;">Enter valid email</p>

      </div>
    </div>

    <!-- password fields  -->
    <div class="row" id="password_fld">
      <div id="test">
        <input id="normal_fields" class="password_field, f7" type="password" placeholder="Password" minlength="8" onfocus="changefocuscolor(true)" onblur="changefocuscolor(false)" name="password" required/>
        <p id="password_message"><span style="color : red;">*</span> Please enter atleast 8 characters of password</p>
      </div>
      <div id="test">
        <input id="normal_fields"  class = "f8" type="password" placeholder="Confirm Password" minlength="8" name="con_password" required/>
        <p id="con_password_message"></p>

      </div>
    </div>

    <!-- Mobile no field  -->
    <div>
      <div id="test">
        <input id="large_fields" class = "f9" type="text" placeholder="Mobile no" name="m_number" minlength="10" maxlength="10" style="margin-top: 1rem;" required/>
        <p id="T_mobile_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; margin-top: -2%; margin-bottom:1%; font-size: 0.7rem; display: none;">enter only 10 digits</p>

      </div>
    </div>

    <!-- college field  -->
    <div id="test">
    <select id="large_fields" class = "f10" name="college_name" style="margin-top: 1rem;">
      <option>Select Your College</option>
      <option>VSM BBA AND BCA DEGREE COLLEGE, NIPPANI</option>
      <option>SJPN BCA COLLEGE, NIDASOSHI</option>
      <option>KLE DEGREE COLLEGE, NIPPANI</option>
      <option>KLE'S BK DEGREE COLLEGE, CHIKKODI</option>
    </select>
      <p id="T_college_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; margin-top: -2%; margin-bottom:1%; font-size: 0.7rem;display: none;">select college</p>

    </div>

    <div id="test" class="course">
            <div id="coursetitle">Select your teaching course</div>
            <div id="check1">
              <input id = "course1" type="checkbox" value="BCA" name = "course_1"/>
              <label for="#course1">BCA</label>
            </div>

            <div id="check2">
              <input id = "course2" type="checkbox" value="BBA" name = "course_2"/>
              <label for="#course2">BBA</label>
            </div>

            <div id="check3">
              <input id = "course3" type="checkbox" value="B.COM" name = "course_3"/>
              <label for="#course3">B.COM</label>
            </div>

            <div id="check4">
              <input id = "course4" type="checkbox" value="BE" name = "course_4"/>
              <label for="#course4">BE</label>
            </div>

            <div id="check5">
              <input id = "course5" type="checkbox" value="BSC" name = "course_5"/>
              <label for="#course5">BSC</label>
            </div>
            <p id="T_course_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; margin-top: -2%; margin-bottom:1%; font-size: 0.7rem;display: none;">choose atleast one course</p>

          </div>


    <!-- class, year, and semister field -->
    <!-- <div class="row">
        <input
          id="short_fields"
          type="text"
          placeholder="Class"
          name="class"
        />
        <input
          id="short_fields"
          type="text"
          placeholder="Year"
          name="year"
        />
        <input
          id="short_fields"
          type="text"
          placeholder="Semister"
          name="semister"
        />
      </div> -->

    <!-- subject field -->
    <!-- <div>
        <input
          id="large_fields"
          type="text"
          placeholder="Enter Your Subject"
          name="subject"
        />
      </div> -->

    <!-- profile pic field  -->
    <div class="profile_pic_container">
      <input id="short_fields" type="file" name="profile_pic" accept="image/*"/>
      <p>Choose your profile pic</p>
    </div>


    <!-- submit button  -->
    <div class="button_container">
      <button id="submit_button" type="submit">Register</button>
    </div>

    <div id="seperator"></div>

    <div id="link">
      <p>If you already registered then <a href="../Login_page.php">Login</a> here</p>
    </div>
  </div>
</div>
    </form>


    <!-- creating student form  -->
    <form id="form2" method="POST" action="../../Database/database.php" onsubmit = "return validateStudent()" style="display : none" enctype="multipart/form-data">
    <h3>Student <span>Registration</span> Form</h3>

<div>
  <div id="input_Fields_container">
    <!-- first and last name fields  -->
    <div class="row" style="margin-bottom: 1rem">
      <div id="test">
        <input id="normal_fields" class = "S_f1" type="text" placeholder="First name" name="form2_first_name" />
        <p id="S_first_name_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;"></p>

      </div>
      <div id="test">
         <input id="normal_fields" class = "S_f2" type="text" placeholder="Last name" name="last_name"/>
         <p id="S_last_name_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;"></p>

      </div>
    </div>

    <!-- register no and address field  -->
    <div class="row"style="margin-bottom: 1rem">
      <div id="test">
        <input id="normal_fields" class = "S_f3" type="text" placeholder="Register no" name="register_no" />
        <p id="S_id_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;"></p>

      </div>
      <div id="test">
         <input id="normal_fields" class = "S_f4"type="text" placeholder="Address" name="address" />
         <p id="S_address_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;"></p>

      </div>
    </div>

    <!-- gender and dob fields  -->
    <div class="row" style="margin-bottom: 1rem">
      <div id="test">
        <select id="normal_fields" class = "S_f5" name="gender" >
           <option value="Select Gender">Select Gender</option>
           <option value="Male">Male</option>
           <option value="Female">Female</option>
        </select>
        <!-- <input id="normal_fields" class = "S_f5" type="text" placeholder="Gender" name="gender" required/> -->
        <p id="S_gender_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;">Select your gender</p>

      </div>
      <div id="test">
        <input id="normal_fields" class = "S_f6"type="text" placeholder="Date of birth" name="dob" onfocus="(this.type = 'date')" />
        <p id="S_dob_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;"></p>

      </div>
    </div>

    <!-- email-id field  -->
    <div>
      <div id="test">
         <input id="large_fields" class = "S_f7"type="email" placeholder="Email Id" name="email_id" />
         <p id="S_email_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;"></p>

      </div>
    </div>

    <!-- password fields  -->
    <div class="row">
      <div id="test">
        <input id="normal_fields" class="password_field2, S_f8" type="password" minlength="8" onfocus="changefocuscolor2(true)" onblur="changefocuscolor2(false)" placeholder="Password" name="password" />
        <p id="password_message"><span style="color : red;">*</span> Please enter atleast 8 characters of password</p>
      </div>
      <div id="test">
        <input id="normal_fields" class = "S_f9"type="password" placeholder="Confirm Password" name="con_password" />
        <p id="S_con_pass_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; display: none;"></p>

      </div>
    </div>

    <!-- Mobile no field  -->
    <div>
      <div id="test">
         <input id="large_fields" class = "S_f10" type="text" placeholder="Mobile no" name="m_number" minlength="10" maxlength="10" />
         <p id="S_mobile_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; margin-top: -2%; margin-bottom:1%; font-size: 0.7rem; display: none;">Enter 10 digits</p>

      </div>
    </div>

    <!-- college field  -->
    <div id="test" >
     <select id="large_fields" class = "S_f11" name="college_name">
      <option>Select Your College</option>
      <option>VSM BBA AND BCA DEGREE COLLEGE, NIPPANI</option>
      <option>SJPN BCA COLLEGE, NIDASOSHI</option>
      <option>KLE DEGREE COLLEGE, NIPPANI</option>
      <option>KLE'S BK DEGREE COLLEGE, CHIKKODI</option>


     </select>
     <p id="S_college_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; margin-top: -2%; margin-bottom:1%; font-size: 0.7rem; display: none;">Select your college</p>

    </div>


    <!-- class, year, and semister field  -->
    <div className="row">
      <div id="test">
        <select id="large_fields" class = "S_f12" name="class" >
           <option value="Select Your Course">Select Your Course</option>
           <option value="BCA">BCA</option>
           <option value="BBA">BBA</option>
           <option value="B.COM">B.COM</option>
           <option value="BE">BE</option>
           <option value="BSC">BSC</option>


        </select>
        <!-- <input id="large_fields"  class = "S_f12" type="text" placeholder="Class" name="class" required/> -->
        <p id="S_class_message" style="color : red; background: rgb(255, 214, 214); padding: 0.1rem 0rem; margin-top: -2%; margin-bottom:1%; font-size: 0.7rem; display: none;">Select your course</p>

      </div>
      <!-- <input id = "short_fields"type="text" placeholder="Year" name = "year"/>
           <input id = "short_fields" type="text" placeholder="Semister" name = "semister"/> -->
    </div>

    <!-- subject field  -->
    <!-- <div>
           <input id = "large_fields" type="text" placeholder="Enter Your Subject" name = "subject"/>
          </div> -->

    <!-- profile pic field  -->
    <div class="profile_pic_container">
      <input id="short_fields" type="file" name="profile_pic" />
      <p>Choose your profile pic</p>
    </div>

    <!-- submit button  -->
    <div class="button_container">
      <button id="submit_button" type="submit">Register</button>
    </div>

    <div id="seperator"></div>

    <div id="link">
      <p>If you already registered then <a href="../Login_page.php">Login</a> here</p>
    </div>
  </div>
</div>


    </form>
  </div>
</body>


// js script for form switch
<script>
  const forms = document.querySelectorAll('form');
  const Tbutton = document.getElementById("Tbutton");
  const Sbutton = document.getElementById("Sbutton");

  forms.forEach((form) => {
    if ((form.style.display === "block") && (form.id === "form1")) {
      Tbutton.style.background = "white";
      Tbutton.style.color = "#2D54FF";
    }
  });

  function showForm(formId) {
    forms.forEach((form) => {
      form.style.display = form.id === formId ? "block" : "none";

      if ((form.style.display === "block") && (form.id === "form1")) {
        Tbutton.style.background = "white";
        Tbutton.style.color = "#2D54FF";

        Sbutton.style.background = "#2D54FF";
        Sbutton.style.color = "white";

      } else if ((form.style.display === "block") && (form.id === "form2")) {
        Sbutton.style.background = "white";
        Sbutton.style.color = "#2D54FF";

        Tbutton.style.background = "#2D54FF";
        Tbutton.style.color = "white";

      }
    });
  }
</script>

<script src="../../js/form_validation.js"></script>

<script>
      const teacher_id_field = document.querySelector('.f3');
      
      teacher_id_field.addEventListener('input', (e)=>{
        let teacher_verification_msg = document.getElementById('teacher_id_verification');

              let stored_teacher_id = '';
          
        <?php
          $present = '';
          while($teacher_row = mysqli_fetch_array($teacher_result)){
             $teacher_id = $teacher_row['Teacher_ID'];
             
             $jsonData = json_encode($teacher_id);

             ?>
        stored_teacher_id = '<?php echo $teacher_id?>';
        // console.log(stored_teacher_id);
              //  stored_teacher_id = ;
              //  console.log(stored_teacher_id);
               if(e.target.value === stored_teacher_id){
                // console.log("matched");
                teacher_verification_msg.style.display = 'block';
                setTimeout(()=> {
                  teacher_verification_msg.style.display = 'none';

                }, 5000)
               }
              //  else{
              //   console.log("not matched");
              //   teacher_verification_msg.style.display = 'none';

              //  }
             <?php

          }

          
        ?>
      });
    </script>

</html>

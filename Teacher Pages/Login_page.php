<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link href = "../css/Login page style/login_style.css" rel="stylesheet"/>
</head>
<body>
<div id="main_container" >
<a href="../Home.php">
              <img src="../Logo/Get Attend Logo ( Transparent ).png" alt="logo" />
</a>

            <!-- creating left box which hold login form  -->
           <div id="sub_container">
              <form id="left_side_box" method = "POST" action = "../Database/user_authentication.php">
                <h3>Login</h3>
                <input type="text" id = "id_field"  name = "user" placeholder = "Enter Teacher Id/Email Id/Mobile number" required/>
                <input type="password" name = "password" placeholder="Enter password" required/>
                <div id="login_as">
                  <div id="teacher">
                  <input id = "r1" type="radio" value = "Teacher" name ="login_as"  onclick = "modify_placeholder('r_btn1')" checked/>
                  <label for="r1">Teacher</label>
                  </div>
                  <div id="student">
                  <input id = "r2" type="radio" value = "Student" name ="login_as"  onclick = "modify_placeholder('r_btn2')"/>
                  <label for="r1">Student</label>
                  </div>
                </div>
                <div class="button_box"><button type = "submit">Login</button></div>  
                
                <div class="seperator"></div>
                <div class="links">
                  <p>If you not resister then <a href="Registration/Registration.php">Register</a> here</p>
                </div>
              </form>

               <!-- creating righ box which holds svg image  -->
              <div id="right_side_box">
                 <img src="../images/Login.svg" alt="Login svg" width={450} height={450}/>
              </div>
           </div>
         </div>

         <script>
          const place = document.getElementById('id_field');

          function modify_placeholder(r_button){
            if (r_button === 'r_btn1'){
              place.placeholder = "Enter Teacher Id/Email Id/Mobile number";

            }
            else{
              place.placeholder = "Enter Register no/Email Id/Mobile number";

            }
          }

         </script>
</body>
</html>
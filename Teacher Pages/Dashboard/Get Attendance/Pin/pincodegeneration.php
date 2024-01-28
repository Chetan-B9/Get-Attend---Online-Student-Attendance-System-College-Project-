<?php
  session_start();
  include "../../../../Components/Header.php";
  include "../../../../Components/MenuBox.php";

  // creating class for pin generation
  class generatePin{
    // creating function which generate the pin code
    public function Generate(){
        $pinCode = rand(1000, 9999);
        return $pinCode;
    }
  }

  $object = new generatePin;
  $pinCode = $object->Generate();
  $_SESSION['pincode'] = $pinCode;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../../../../css/bootstrap.css" />

<!-- fonts style -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

<!-- font awesome style -->
<link href="../../../../css/font-awesome.min.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="../../../../css/style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="../../../../css/responsive.css" rel="stylesheet" />

<link href="../../../../css/get attendance/qrCode.css" rel="stylesheet" />

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

#subContainer_1{
  height: 96%;
  box-shadow: 5px 5px 5px #d9d9d9,
              -0.5px -0.5px 5px #ffffff;
      
}

#subContainer_2{
  padding: 1rem 2rem;
  
}


#menu_name_container{
    margin: 0rem 0rem 0rem 1.25rem;
    padding: 1rem 0rem 1rem 0rem;
}

#menu_name_container h5{
    font-weight: bolder;
    height: 2.5rem;
    margin-top: 0.8rem;
    text-align: center;
    
}

#menu_box_container{
   
    margin-top: 1rem;
    padding: 0rem 0rem 0rem 1.25rem;
 
}

form button{
  width: 18rem;
    height: 3.5rem;
    margin-top: 1.5rem;
    border-radius: 0.4rem;
    background: #2D54FF;
    border: 0.25rem solid #D5DDFE;
    font-size: small;
    margin-left: 1rem;
    /* border: 0.25rem solid #f5f5f5; */  
    color: white;
   cursor: pointer;
}
      
form button:hover{
  transition: all .3s;
    background-color: transparent;
  color: #2D54FF;


}
    </style>
</head>
<body>
    <?php
      $obj = new Header;
      $obj -> Header("../../../../Logo/Get Attend Logo ( Transparent ).png", "../../../../Home.php", "../../../../About.php");
    ?>
    <div id="contentContainer">
              <div id="subContainer_1">
                <div id="menu_name_container">
                  <h3 id="menu_name">Get Attendance</h3>
                </div>

                <div id="menu_box_container">
                    <?php
                       $dashB = new MenuBox;
                       $dashB -> menubox("fa-solid fa-house", "Dashboard", "../../dashboard.php");
                       $dashB -> menubox("fa-solid fa-users", "Get Attendance", "teacher_qr_code.php", );
                       $dashB -> menubox("fa-solid fa-eye", "Veiw Attendance", "../../View Attendance/teacherViewAttendance.php");
                    ?>
                 
               </div>
               
              </div>
            <div id="subContainer_2">
                <div class="notice" style="text-align: center;">
                    <p>This attendance taking method is very easy way to get attendance of students in less time.</p>
                    <!-- <p id="timer">0 : <span id="sec">30</span></p> -->
                </div>

                <div class="qr_code_container">
                  <h2>Students must enter this generated Attendance Code</h2>
                  <div id="pincode">
                    <h1 id="pincode" font-weight: bold; font-size: 4rem;"><?php echo $pinCode?></h1>
                  </div>

                  <form action="" method="post">
                  <button type="submit" name="submit">Regenerate Code</button>

                  </form>

                  
                </div>
    
          </div>
            </div>
           </div>

    <!-- <script> -->
      <!-- //setting the countdown duration -->
      <!-- let countdownTime = 30; -->

      <!-- //function to update the timer display -->
      <!-- function updateTimer(){ -->
        <!-- let timerDisplay = document.getElementById('sec'); -->
        <!-- timerDisplay.innerHTML = countdownTime; -->
      <!-- } -->

      <!-- // function to start the countdown timer  -->
      <!-- function startTimer(){ -->
        <!-- updateTimer(); -->
        <!-- let countdownInterval = setInterval(function(){ -->
          <!-- countdownTime--; -->
          <!-- updateTimer(); -->

          <!-- // check if the countdown reaches the 0 -->
          <!-- if(countdownTime <= 0){ -->
            <!-- clearInterval(countdownInterval); -->
            
            <!-- let Pincode = document.getElementById('pincode'); -->
            

          <!-- } -->
          
        <!-- }, 1000); -->
      <!-- } -->

      <!-- // start timer when page loads -->
      <!-- window.onload = startTimer; -->
    <!-- </script> -->
           
</body>
</html>

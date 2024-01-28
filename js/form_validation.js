
const password_fields = document.querySelector(".password_field");
const password_fields2 = document.querySelector(".password_field2");  

// handling password validation
function changefocuscolor(isFocused){
    

    if( password_fields.value.length > 0 && password_fields.value.length < 8){
        password_fields.style.color = "red";
    }
    else if (password_fields.value.length >= 8){
        password_fields.style.color = "green";
    }

    if(isFocused){
    password_fields.addEventListener('input', () => {
        if (password_fields.value.length < 8 ) {
            // console.log(password_fields.value)
            
            password_fields.style.borderColor = "red";
            password_fields.style.color = "red";
        }
        else{
            password_fields.style.borderColor = "green";
            password_fields.style.color = "green";    

        }
        
    })
}
else {
    password_fields.style.color = "";

}
}

// student password

function changefocuscolor2(isFocused){
    

    if( password_fields2.value.length > 0 && password_fields2.value.length < 8){
        password_fields2.style.color = "red";
    }
    else if (password_fields2.value.length >= 8){
        password_fields2.style.color = "green";
    }

    if(isFocused){
        password_fields2.addEventListener('input', () => {
        if (password_fields2.value.length < 8 ) {
            // console.log(password_fields.value)
            
            password_fields2.style.borderColor = "red";
            password_fields2.style.color = "red";
        }
        else{
            password_fields2.style.borderColor = "green";
            password_fields2.style.color = "green";    

        }
        
    })
}
else {
    password_fields2.style.color = "";

}
}


// Teacher Registration form validation

// teacher and student first and last name validation script
const tFirstName = document.querySelector(".f1");
const tLastName = document.querySelector(".f2");

const sFirstName = document.querySelector(".S_f1");
const sLastName = document.querySelector('.S_f2');

let f_msg = document.getElementById("T_first_name_message");
let l_msg = document.getElementById("T_last_name_message");
let s_f_msg = document.getElementById("S_first_name_message");
let s_l_msg = document.getElementById("S_last_name_message");

const only_string = (Class, message) => {
   Class.addEventListener("input", (e) => {
    let name_regex = /^[(A-Z)?(a-z)?\s*]+$/;

    if (!name_regex.test(e.target.value)) {
      message.style.display = "block";
      message.innerHTML = "Sorry! only letters are allowed";
    } else {
      message.style.display = "none";
    }

    if (Class.value.length === 0) {
      message.style.display = "none";
    }
  });

};

only_string(tFirstName, f_msg);
only_string(tLastName, l_msg);
only_string(sFirstName, s_f_msg);
only_string(sLastName, s_l_msg);


// Teacher and Student id validation
const t_id = document.querySelector(".f3");
let t_msg = document.getElementById("teacher_id_message");

const s_id = document.querySelector(".S_f3");
let s_msg = document.getElementById("S_id_message");

const id_validation = (Class, message) => {
  Class.addEventListener("input", (e) => {
    let id_regex = /^[(A-Z)?(a-z)?(0-9)\s]+$/;

    if (!id_regex.test(e.target.value)) {
      message.style.display = "block";
      message.innerHTML = "Sorry! special charecters are not allowed";
    } else {
      message.style.display = "none";

      console.log("entered name");
    }

    if (Class.value.length === 0) {
      message.style.display = "none";

      // msg.innerHTML = "Enter your first name here!";
    }
  });
};

id_validation(t_id, t_msg);
id_validation(s_id, s_msg);


// teacher and student password validation
const t_password = document.querySelector(".f7");
const t_con_password = document.querySelector(".f8");
let t_con_pass_msg = document.getElementById("con_password_message");

const s_password = document.querySelector(".S_f8");
const s_con_password = document.querySelector(".S_f9");
let s_con_pass_msg = document.getElementById("S_con_pass_message");

// /^[(A-Z)?(a-z)?(0-9?!?@?#?-?_?%?)]+$/
const password_varification = (Class1, Class2, message) => {
  Class2.addEventListener("input", (e) => {
    const main_password = Class1.value;
    if (main_password === e.target.value) {
      message.style.display = "block";
      message.style.background = "rgb(198, 255, 198)";
      message.innerHTML = "Password matched";
    } else {
      message.style.display = "block";
      message.style.background = "rgb(255, 214, 214)";
      message.innerHTML = "Password not matched";

      // console.log('entered name');
    }

    if (Class2.value.length === 0) {
      message.style.display = "none";

      // msg.innerHTML = "Enter your first name here!";
    }
  });
};

password_varification(t_password, t_con_password, t_con_pass_msg);
password_varification(s_password, s_con_password, s_con_pass_msg);


// teacher and student mobile no validation
const t_mobile = document.querySelector(".f9");
// const t_con_password = document.querySelector('.f8');
let t_mobile_msg = document.getElementById("T_mobile_message");

const s_mobile = document.querySelector(".S_f10");
// const t_con_password = document.querySelector('.f8');
let s_mobile_msg = document.getElementById("S_mobile_message");

const mobile_validation = (Class, message) => {
  Class.addEventListener("input", (e) => {
    let mobile_regex = /^[(0-9)\s*]+$/;

    if (!mobile_regex.test(e.target.value)) {
      message.style.display = "block";
      message.style.background = "rgb(255, 214, 214)";
      message.innerHTML = "Only numbers are allowed";
    } else {
      message.style.display = "none";
    }

    if (Class.value.length === 0) {
      message.style.display = "none";

      // msg.innerHTML = "Enter your first name here!";
    }
  });
};

mobile_validation(t_mobile, t_mobile_msg);
mobile_validation(s_mobile, s_mobile_msg);



// teacher form submition

const name_regex = /^[(A-Z)?(a-z)?\s*]+$/;
let id_regex = /^[(A-Z)?(a-z)?(0-9)\s*]+$/;
let mobile_regex = /^[(0-9)\s*]+$/;
let email_regex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
let password_regex = /^[(A-Z)?(a-z)?(0-9)?!?@?#?-?_?%?]+$/;

const t_gender = document.querySelector(".f4");
let t_gender_msg = document.getElementById("T_gender_message");

const t_college = document.querySelector(".f10");
let t_college_msg = document.getElementById("T_college_message");

const t_course1 = document.getElementById("course1");
const t_course2 = document.getElementById("course2");
const t_course3 = document.getElementById("course3");
const t_course4 = document.getElementById("course4");
const t_course5 = document.getElementById("course5");

let t_course_msg = document.getElementById("T_course_message");

const validate = () => {

  let T_firstName_validation = null;
  let T_lastName_validation = null;
  let T_id_validation = null;
  let T_gender_validation = null;
  let T_email_validation = null;
  let T_mobile_validation = null;
  let T_dob_validation = null;
  let T_collegeName_validation = null;
  let T_password_validation = null;
  let T_course_validation = null;

  let Return = true;
  
  // first name validation 
  if(!name_regex.test(tFirstName.value)){
     T_firstName_validation = false;
  }

  //last name validation 
  if(!name_regex.test(tLastName.value)){
    T_lastName_validation = false;
 }

 // teacher id validation 
 if (!id_regex.test(t_id.value)) {
  T_id_validation = false;
} 

// password vaidation 
if(t_password.value !== t_con_password.value){
  T_password_validation = false;
}

// gender validation 
if(t_gender.value === "Select Gender"){
  T_gender_validation = false;
  t_gender_msg.style.display = "block";
}else{
  t_gender_msg.style.display = "none";
}

// mobile no validation 
if(!mobile_regex.test(t_mobile.value)){
  T_mobile_validation = false;
}

// college validation 
if(t_college.value === "Select Your College"){
  T_collegeName_validation = false;
  t_college_msg.style.display = "block";
}else{
  t_college_msg.style.display = "none";
}

if(t_course1.value === null && t_course2.value === null){
  t_course_msg.style.display = "none";
}

  if((T_firstName_validation === false) || (T_lastName_validation === false) || (T_id_validation === false) || (T_gender_validation === false) || (T_email_validation === false) || (T_mobile_validation === false) || (T_dob_validation === false) || (T_collegeName_validation === false) || (T_password_validation === false)){
    Return = false;
  }


  return Return;
}


// student form submition

const s_gender = document.querySelector(".S_f5");
let s_gender_msg = document.getElementById("S_gender_message");

const s_college = document.querySelector(".S_f11");
let s_college_msg = document.getElementById("S_college_message");

const s_class = document.querySelector(".S_f12");
let s_class_msg = document.getElementById("S_class_message");

const validateStudent = () => {

  let S_firstName_validation = null;
  let S_lastName_validation = null;
  let S_id_validation = null;
  let S_gender_validation = null;
  let S_email_validation = null;
  let S_mobile_validation = null;
  let S_dob_validation = null;
  let S_collegeName_validation = null;
  let S_password_validation = null;
  // let S_address_validation = null;
  let S_class_validation = null;

  let Return = true;
  
  // first name validation 
  if(!name_regex.test(sFirstName.value)){
     S_firstName_validation = false;
  }

  //last name validation 
  if(!name_regex.test(sLastName.value)){
    S_lastName_validation = false;
 }

 // teacher id validation 
 if (!id_regex.test(s_id.value)) {
  S_id_validation = false;
} 

// password vaidation 
if(s_password.value !== s_con_password.value){
  S_password_validation = false;
}

// gender validation 
if(s_gender.value === "Select Gender"){
  S_gender_validation = false;
  s_gender_msg.style.display = "block";
}else{
  s_gender_msg.style.display = "none";
}

// class validation 
if(s_class.value === "Select Your Course"){
  S_class_validation = false;
  s_class_msg.style.display = "block";
}else{
  s_class_msg.style.display = "none";
}

// mobile no validation 
if(!mobile_regex.test(s_mobile.value)){
  S_mobile_validation = false;
}

// college validation 
if(s_college.value === "Select Your College"){
  S_collegeName_validation = false;
  s_college_msg.style.display = "block";
}else{
  s_college_msg.style.display = "none";
}


  if((S_firstName_validation === false) || (S_lastName_validation === false) || (S_id_validation === false) || (S_gender_validation === false) || (S_email_validation === false) || (S_mobile_validation === false) || (S_dob_validation === false) || (S_collegeName_validation === false) || (S_password_validation === false) || (S_class_validation === false)){
    Return = false;
  }


  return Return;
}


let form_name = document.getElementById("name_field");
let error_name = document.getElementById("name_error");
let form_email = document.getElementById("email_field");
let error_email = document.getElementById("email_error");
let message = document.getElementById("message");
let error_message = document.getElementById("message_error");
let submit_message = document.getElementById("submit_message");
let nav_button = document.getElementById("navButton");
let navBar = false;

const form = document.getElementById("contactForm");
form.addEventListener("submit", function(e) {
    e.preventDefault();
    
    error_name.style.display = "none";
    error_name.innerText = "";
    error_email.style.display = "none";
    error_email.innerText = "";
    error_message.style.display = "none";
    error_message.innerText = "";
    submit_message.style.display = "none";
    submit_message.innerText = "";

    if (form_name.value == "") {
        error_name.style.display = "block";
        error_name.innerText = "Please enter your name.";
    }
    else if (form_email.value == "") {
        error_email.style.display = "block";
        error_email.innerText = "Please enter your email address.";
    }
    else if (message.value == "") {
        error_message.style.display = "block";
        error_message.innerText = "Please enter something.";
        error_message.style.display = "block";
    }
    else {
        submit_message.style.display = "block";
        submit_message.innerText = "Form Submitted!";
    }
})

function toggleNavBar () {
    navBar = !navBar;

    if (navBar) {
        document.querySelector(".navMobBar").style.display = "block";
    }
    else {
        document.querySelector(".navMobBar").style.display = "none";
    }
}

window.addEventListener('scroll', function() {
  const scroll = window.scrollY;
  const Height = document.documentElement.scrollHeight - window.innerHeight;
  const progress = (scroll / Height) * 100;

  document.getElementById('progressBar').style.width = progress + "%";
});

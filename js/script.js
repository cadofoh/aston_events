//Hamburger Button Onclick Action
const toggle = document.querySelector('.toggle');
const navigation = document.querySelector('.navigation');

toggle.addEventListener('click', function () {
    toggle.classList.toggle('active')
    navigation.classList.toggle('active')


})


function validateForm() {
    var fname = document.getElementById("first_name").value;
    if (fname == "") {
        alert("Please Enter a First name");
        return false;
    }
    var lname = document.getElementById("last_name").value;
    if (lname == "") {
        alert("Please Enter a Last name");
        return false;
    }
}
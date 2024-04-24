// validation form
var nameError = document.getElementById('name-error');
var emailError = document.getElementById('email-error');
var passwordError = document.getElementById('password-error');
var confirmPasswordError = document.getElementById('confirmPassword-error');
var sendError = document.getElementById('send-error');

function validateName(){
    var name = document.getElementById('name').value;
    if(name.length == 0){
        nameError.innerHTML = 'Name is required' 
        return false;
    } 
    if(!name.trim().match(/^[A-Za-z]/)){
        nameError.innerHTML ='Form name is invalid'
        return false;
    }
    if(name.trim().length > 30) {
        nameError.innerHTML = 'name form is invalid'
        return false;
    }   
    nameError.innerHTML = '<i class="fa-solid fa-check" style="color: green;"></i>'
    return true; 
}
function validateEmail(){
    var Email = document.getElementById('email').value;
    if(Email.length == 0){
        emailError.innerHTML ='Email is required'
        return false;
    }
    if(!Email.trim().match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)){
        emailError.innerHTML ='Email form is invalid'
        return false;
    }
    emailError.innerHTML = '<i class="fa-solid fa-check" style="color: green;"></i>'
    return true;
}
function validatePassword(){
    var password = document.getElementById('password').value;
    
    if (password.length === 0) {
        passwordError.innerHTML = 'Password is required';
        return false;
    }

  
    if (password.length < 8) {
        passwordError.innerHTML = 'Password should be at least 8 characters';
        return false;
    }


    passwordError.innerHTML = '<i class="fa-solid fa-check" style="color: green;"></i>';
    return true;
}
function validateConfirmPassword(){
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    if (confirmPassword.length === 0) {
        confirmPasswordError.innerHTML = 'Confirm Password is required';
        return false;
    }

    if (confirmPassword !== password) {
        confirmPasswordError.innerHTML = 'Passwords do not match';
        return false;
    }

    confirmPasswordError.innerHTML = '<i class="fa-solid fa-check" style="color: green;"></i>';
    return true;
}

// end validatin form
window.onload = function () {   

    const check = document.querySelector('input[type="checkbox"]');

    const eye = document.querySelector('#basic-addon1');
    
    function showPassword() {
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
        
    }

    eye.addEventListener("click",function(){
        showPassword();
    })

}
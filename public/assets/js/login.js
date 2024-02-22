window.onload = function () {
    const passwordField = document.querySelector('input[type="password"]');

    const check = document.querySelector('input[type="checkbox"]');

    
    function showPassword() {
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
        
    }
    
    check.addEventListener("click",function(){

        showPassword();
    })

}
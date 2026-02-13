const registerForm = document.getElementById('registerForm');

registerForm.addEventListener('submit',register);

function register(e){
    e.preventDefault();
    const myForm = new FormData(registerForm);

}
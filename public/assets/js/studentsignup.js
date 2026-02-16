async function register(e){
    e.preventDefault();
    const myForm = new FormData(registerForm);
    const response = await fetch( "index.php?page=do-student-signup",{
        method : "POST" ,
        body : myForm
    });
    const data= await response.json();
    alert(data.message) ;
    if(data.status == "success") {
        window.location.href = data.redirect ;
    }
}

const registerForm= document.getElementById('registerForm');
registerForm.addEventListener('submit',register);

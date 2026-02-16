async function login(e){
    e.preventDefault();
    const myForm = new FormData(loginForm);
    const response = await fetch( "index.php?page=do-canteen-login",{
        method : "POST" ,
        body : myForm
    });
    const data= await response.json();
    alert(data.message) ;
    if(data.status == "success") {
        window.location.href = data.redirect ;
    }
}

const loginForm= document.getElementById('loginForm');
loginForm.addEventListener('submit',login);

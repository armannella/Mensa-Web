const changepasswordForm = document.getElementById('changepasswordForm');
const changeimageForm = document.getElementById('changeimageForm');




getProfile();


changepasswordForm.addEventListener('submit',changePass);
changeimageForm.addEventListener('submit',changeImage);


async function changeImage(e) {
    e.preventDefault();
    const myForm = new FormData(changeimageForm);

    const response = await fetch("index.php?page=student-change-img",{
        method: "POST" ,
        body: myForm
    });
    const data = await response.json();

    alert(data.message);
    if(data.status == 'success') {
        window.location.href = data.redirect ;
    }
}

async function changePass(e) {
    e.preventDefault();
    const myForm = new FormData(changepasswordForm);

    const response = await fetch("index.php?page=student-change-pass",{
        method: "POST" ,
        body: myForm
    });
    const data = await response.json();

    alert(data.message);
    if(data.status == 'success') {
        window.location.href = data.redirect ;
    }
}


async function getProfile() {
    const tableelement = document.getElementById('profilelist');
    const response = await fetch("index.php?page=student-get-info");
    const data = await response.json();

    tableelement.innerHTML = `<table>
                                <tr>
                                    <td colspan="2" class="image-profile-section"><img src="assets/uploads/profiles/${data.image}" alt="profilepic"></td>
                                </tr>
                                <tr>
                                    <th>Name :</th>
                                    <td>${data.name}</td>
                                </tr>
                                <tr>
                                    <th>matricola :</th>
                                    <td>${data.matricola}</td>
                                </tr>

                                <tr>
                                    <th>username :</th>
                                    <td>${data.username}</td>
                                </tr>
                                
                            </table>

    `;
}

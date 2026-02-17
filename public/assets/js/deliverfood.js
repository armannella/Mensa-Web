const main = document.getElementById('contents');
const checkForm = document.getElementById('checkForm');
const codeinput = document.getElementById('reserveID');



checkForm.addEventListener('submit',check);


async function check(e){

    e.preventDefault();
    const myForm = new FormData(checkForm);
    const response = await fetch( "index.php?page=check-delivere",{
        method : "POST" ,
        body : myForm
    });
    const data= await response.json();
    alert(data.message) ;
    
    if(data.status == "success") {
        updateRightPart(codeinput.value);
    }
    else {
        main.innerHTML='Waiting For another Code ...';
    }
    codeinput.value = "";
}


async function updateRightPart(reserveID){

    let response = await fetch("index.php?page=get-student-reserve-info",{
        method:"POST" ,
        headers: {"Content-Type" : "application/json"},
        body: JSON.stringify({reserveID:reserveID})
    });
    let data = await response.json();
    main.innerHTML='';
    finaloutput = `<table>
                        <tr my-3>
                            <td colspan="2" class="image-profile-section"><img src="assets/uploads/profiles/${data.image}" alt="profilepic"></td>
                        </tr>
                                <tr>
                                    <th>Name :</th>
                                    <td>${data.name}</td>
                                </tr>
                                
                            </table>
                        
    `;

    /// part 2 for foods


    let alltypes = await getTypes();

    response = await fetch("index.php?page=get-reserve-details",{
        method:"POST" ,
        headers: {"Content-Type" : "application/json"},
        body: JSON.stringify({reserveID:reserveID})
    });
    data = await response.json();

    for(let type of alltypes ){
        finaloutput  += `
        <div class="type-name my-4">
                        <h1>${type.name}</h1>
                    </div>
                    <div class="row foodscards my-3" data-id=${type.id}>`;
        for(let food of data) {
            if(food.typeID == type.id) {
                finaloutput +=`
                <div class="col-md-6 my-3">
                    <div class="foodcard" data-id=${food.foodID}>
                            <div class="foodimage"> 
                                <img src="assets/uploads/foods/${food.image}" alt="food">
                            </div>
                            <div class="foodname my-2">${food.name}</div>
    
                    </div>
                </div>
                
                `;
            }
        }
        finaloutput += `</div>`;
    }


    main.innerHTML = finaloutput;




}



async function getTypes() {
    const response = await fetch("index.php?page=get-types");
    const data = await response.json();
    return data ;
}

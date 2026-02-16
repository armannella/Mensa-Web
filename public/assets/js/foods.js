const selectbox = document.getElementById('typeID');
const addForm = document.getElementById('addnewfoodForm');
const foodslist = document.getElementById('foodslist');


getTypes();
getFoods();


addForm.addEventListener('submit' , addFood);
foodslist.addEventListener('click',deletefood) ;

async function deletefood(e) {
    if (e.target.classList.contains('dokme')) {
        const rowelement = e.target.closest('tr');
    let fid = rowelement.dataset.id;

    const response = await fetch("index.php?page=delete-food" , {
        method: "POST" ,
        headers: {"Content-Type" : "application/json"},
        body: JSON.stringify({id : fid})
    });

    const data= await response.json();
    alert(data.message) ;
    getFoods();  
    }
      
}


async function addFood(e){
    e.preventDefault();
    const myForm = new FormData(addForm);
    const response = await fetch( "index.php?page=add-food",{
        method : "POST" ,
        body : myForm
    });
    const data= await response.json();
    alert(data.message) ;
    if(data.status == "success") {
        window.location.href = data.redirect ;
    }

}

async function getFoods(){
    const response = await fetch( "index.php?page=get-foods");
    const data= await response.json();
    foodslist.innerHTML = '';
    for (let food of data){
        let id = food.fid;
        let name = food.fname;
        let details = food.details;
        let type = food.type ;
        foodslist.innerHTML += `
        <tr data-id ="${id}">
        <td>${name}</td>
        <td>${details}</td>
        <td>${type}</td>
        <td><button class="dokme bgc-red">Delete</button></td>
        </tr>`;
    }

}



async function getTypes() {
    const response = await fetch("index.php?page=get-types");
    const data = await response.json();
    for(let food of data) {
        let name = food.name ;
        let id = food.id ;

        selectbox.innerHTML+= `<option value="${id}">${name}</option>`;
    }
}



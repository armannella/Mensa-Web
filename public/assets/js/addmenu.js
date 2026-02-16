const foodssection  = document.getElementById('foodssection');
const saveMenuBtn = document.getElementById('saveMenuBtn');


readyPage();
foodssection.addEventListener('input',addToSelected);
saveMenuBtn.addEventListener('click',saveMenu);


async function saveMenu(){
    const selectedfoods = document.querySelectorAll('.is-selected');
    const meal_date = document.getElementById('menu-date').value;
    const meal = document.getElementById('meal').value;

    let foods = [];

    if (!meal_date) {
        alert("select a date idiot");
        return;
    }

    if(selectedfoods.length === 0){
        alert("choose food idiot");
        return ;
    }


    for (let food of selectedfoods) {
        let fid = food.dataset.id;
        let fquantity = food.querySelector('input[name="quantity"]').value ;
        foods.push({id:fid , quantity : fquantity});
    }

    const response = await fetch("index.php?page=add-menu" , {
        method: "post",
        headers : {"Content-Type" : "application/json"},
        body: JSON.stringify({menu_date : meal_date , meal : meal , foods : foods})
    });

    const data = await response.json();

    alert(data.message);
    window.location.href = data.redirect;




}




function addToSelected(e){
    if(e.target.classList.contains('form-control')){
        if(e.target.value> 0) {
            e.target.closest('.foodcard').classList.add('is-selected');
        }
        else {
            e.target.closest('.foodcard').classList.remove('is-selected');
        }
    }


}




async function readyPage(){
    let types = await getTypes();
    let foods = await getFoods();
    let finalpage = '' ;
    for(let type of types ){
        finalpage  += `
        <div class="type-name my-4">
                        <h1>${type.name}</h1>
                    </div>
                    <div class="row foodscards my-3">`;
        for(let food of foods) {
            if(food.type == type.name) {
                finalpage +=`
                <div class="col-md-4 my-3">
                    <div class="foodcard" data-id="${food.fid}">
                            <div class="foodimage"> 
                                <img src="assets/uploads/foods/${food.image}" alt="food">
                            </div>
                            <div class="foodname my-2">${food.fname}</div>
                            <div class="fooddetails">${food.details}</div>
                            <div class="foodfooter mt-3">
                                <input type="number" min="0" name="quantity" class="form-control" placeholder="quantity">
                            </div>
                    </div>
                </div>
                
                `;
            }
        }
        finalpage += `</div>`;
    }
    foodssection.innerHTML = finalpage ;
}



async function getFoods(){
    const response = await fetch( "index.php?page=get-foods");
    const data= await response.json();
    return data;

}



async function getTypes() {
    const response = await fetch("index.php?page=get-types");
    const data = await response.json();
    return data ;
}

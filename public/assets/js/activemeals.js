const pagetitle = document.getElementById('pagetitle');
const main = document.getElementById('contents');



step1_ShowMeals();

async function step1_ShowMeals(){
    pagetitle.innerText = "All Active Meals";

    const response = await fetch("index.php?page=get-active-meals");
    const data = await response.json();

    main.innerHTML = '' ;
    let finaloutput = `<div class="col-md-7">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Meal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>`;

    for(let mealmenu of data){
        let id = mealmenu.id;
        let menu_date = mealmenu.menu_date;
        let meal = mealmenu.meal;

        finaloutput += `<tr data-id ="${id}">
        <td>${menu_date}</td>
        <td>${meal}</td>
        <td><button class="dokme bgc-orange meal-select">Get Info</button></td>
        </tr>`;

    }
    finaloutput+=`</tbody>
                        </table>  
                    </div>`;
    
    main.innerHTML = finaloutput;

}

main.addEventListener('click' , (e) =>{
    if(e.target.classList.contains('meal-select')){
        let menuID  = e.target.closest('tr').dataset.id ;
        step2_menuDetails(menuID);
    }
});


async function step2_menuDetails(menuID){
    pagetitle.innerText = "Menu Foods";
    let allfoods = await getFoods(menuID);
    let alltypes = await getTypes();
    main.innerHTML = '' ;
    let finalpage = '' ;
    for(let type of alltypes ){
        finalpage  += `<hr>
        <div class="type-name my-4">
                        <h1>${type.name}</h1>
                    </div>
                    <div class="row foodscards my-3" data-id=${type.id}>`;
        for(let food of allfoods) {
            if(food.typeID == type.id) {
                finalpage +=`
                <div class="col-md-4 my-3">
                    <div class="foodcard" data-id=${food.foodID}>
                            <div class="foodimage"> 
                                <img src="assets/uploads/foods/${food.image}" alt="food">
                            </div>
                            <div class="foodname my-2">${food.name}</div>
                            <div class="fooddetails">${food.details}</div>
                            <div class="foodfooter mt-3 d-flex column-gap-2">
                                <button class = "dokme bgc-purple px-3">${food.capacity - food.quantity} Reserved</button>
                                <button class = "dokme bgc-green px-3">${food.quantity} Remained</button>
                            </div>
                    </div>
                </div>
                
                `;
            }
        }
        
    }
    finalpage += `</div>`;
    main.innerHTML = finalpage ;

}



async function getFoods(menuID){
    const response = await fetch("index.php?page=get-menu-details",{
        method:"POST" ,
        headers: {"Content-Type" : "application/json"},
        body: JSON.stringify({menuID:menuID})
    });
    const data = await response.json();
    return data;

}



async function getTypes() {
    const response = await fetch("index.php?page=get-types");
    const data = await response.json();
    return data ;
}
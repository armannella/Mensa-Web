const pagetitle = document.getElementById('pagetitle');
const main = document.getElementById('contents');

let reservationState = {
    canteenID: null,
    menuID: null,
    selectedFoods: []
};

step1_ShowMensa();

async function step1_ShowMensa(){
    pagetitle.innerText = "Select Mensa";

    const response = await fetch("index.php?page=get-canteens");
    const data = await response.json();

    main.innerHTML = '' ;
    let finaloutput = `<div class="col-md-7">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tbody>`;

    for(let canteen of data){
        let id = canteen.id;
        let name = canteen.name ;
        let address = canteen.address;

        finaloutput += `<tr data-id ="${id}">
        <td>${name}</td>
        <td>${address}</td>
        <td><button class="dokme bgc-green mensa-select">See Menus</button></td>
        </tr>`;

    }
    finaloutput+=`</tbody>
                        </table>  
                    </div>`;
    
    main.innerHTML = finaloutput;

}

main.addEventListener('click' , (e) =>{
    if(e.target.classList.contains('mensa-select')){
        let canteenID  = e.target.closest('tr').dataset.id ;
        reservationState.canteenID = canteenID ;
        step2_ShowMenus();
    }
});


async function step2_ShowMenus(){
    pagetitle.innerText = "Select Menu";

    const response = await fetch("index.php?page=get-available-menus",{
        method:"POST" ,
        headers: {"Content-Type" : "application/json"},
        body: JSON.stringify({canteenID:reservationState.canteenID})
    });
    const data = await response.json();

    main.innerHTML = '' ;
    let finaloutput = `<div class="col-md-7">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Meal</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tbody>`;

    for(let menu of data){
        let id = menu.id;
        let menu_date = menu.menu_date ;
        let meal = menu.meal;

        finaloutput += `<tr data-id ="${id}">
        <td>${menu_date}</td>
        <td>${meal}</td>
        <td><button class="dokme bgc-green menu-select">See Foods</button></td>
        </tr>`;

    }
    finaloutput+=`</tbody>
                        </table>  
                    </div>`;
    
    main.innerHTML = finaloutput;


}


main.addEventListener('click' , (e) =>{
    if(e.target.classList.contains('menu-select')){
        let menuID  = e.target.closest('tr').dataset.id ;
        reservationState.menuID = menuID ;
        step3_ShowFoods();
    }
});



async function step3_ShowFoods(){
    pagetitle.innerText = "Select Foods";
    let allfoods = await getFoods();
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
                if(food.quantity == 0) {
                    continue ;
                }
                finalpage +=`
                <div class="col-md-4 my-3">
                    <div class="foodcard" data-id=${food.foodID}>
                            <div class="foodimage"> 
                                <img src="assets/uploads/foods/${food.image}" alt="food">
                            </div>
                            <div class="foodname my-2">${food.name}</div>
                            <div class="fooddetails">${food.details}</div>
                            <div class="foodfooter mt-3 d-flex column-gap-2">
                                <span class = "bgc-purple px-3">${food.quantity} Remained</span>
                                <button class = "dokme bgc-orange select-food">Select</button>
                            </div>
                    </div>
                </div>
                
                `;
            }
        }
        
    }
    finalpage += `</div>`;
        finalpage += `<hr><div class="row my-4">
                        <div class="col-md-4">
                            <button id="summary" class="dokme bgc-red">Total Price is : 0</button>
                        </div>
                        <div class="col-md-4">
                            <button id="saveMenuBtn" class="dokme bgc-green">Publish Menu</button>
                        </div>
                    </div>`;
    main.innerHTML = finalpage ;
    loadSaveReserve();

}

let selectedFoods = {1: null , 2: null ,3: null ,4: null ,5: null}


main.addEventListener('click',addToSelected);

function addToSelected(e){
    if(e.target.classList.contains('select-food')){
        if(e.target.closest('.foodcard').classList.contains('is-selected')) {
            let typeID = e.target.closest('.foodscards').dataset.id;
            selectedFoods[typeID] = null ;
            e.target.closest('.foodcard').classList.remove('is-selected');
        }
        else {
            let typeID = e.target.closest('.foodscards').dataset.id;
            if(selectedFoods[typeID] == null ) {
                selectedFoods[typeID] = e.target.closest('.foodcard').dataset.id;
                e.target.closest('.foodcard').classList.add('is-selected');
            }
            else {
                alert("One per each category hungry ") ;
                return
            }
            
        }

        updatePrice();
    }
}

async function updatePrice() {
    let foods = [];
    for(let i in selectedFoods) {
        if(selectedFoods[i] != null ) {
            foods.push(selectedFoods[i]);
        }
    }
    reservationState.selectedFoods = foods;

    if (foods.length === 0) {
        document.getElementById('summary').innerText = `Total Price is 0 Euro`;
        return;
    }

    const response = await fetch("index.php?page=get-live-price",{
        method:"POST" ,
        headers: {"Content-Type" : "application/json"},
        body: JSON.stringify({ foods : reservationState.selectedFoods})
    });
    const data = await response.json();

    document.getElementById('summary').innerText = `Total Price is ${data.total} Euro `;
}




async function getFoods(){
    const response = await fetch("index.php?page=get-menu-details",{
        method:"POST" ,
        headers: {"Content-Type" : "application/json"},
        body: JSON.stringify({menuID:reservationState.menuID})
    });
    const data = await response.json();
    return data;

}



async function getTypes() {
    const response = await fetch("index.php?page=get-types");
    const data = await response.json();
    return data ;
}









function loadSaveReserve(){
document.getElementById('saveMenuBtn').addEventListener('click',step4_AddReserve);
}


async function step4_AddReserve(){
    if (reservationState.selectedFoods.length == 0) {
        alert("select at least one food! rich Boy");
        return;
    }

    const response = await fetch("index.php?page=add-reserve", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            menuID: reservationState.menuID,
            foods: reservationState.selectedFoods
        })
    });
    const data = await response.json();
    alert(data.message);

        window.location.href = data.redirect; 
}


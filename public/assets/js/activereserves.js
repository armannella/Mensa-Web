const pagetitle = document.getElementById('pagetitle');
const main = document.getElementById('contents');



step1_ShowReserves();

async function step1_ShowReserves(){
    pagetitle.innerText = "All your Reserves";

    const response = await fetch("index.php?page=get-active-reserves");
    const data = await response.json();

    main.innerHTML = '' ;
    let finaloutput = `<div class="col-md-7">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Meal</th>
                                    <th>Canteen</th>
                                    <th>Reserve Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>`;

    for(let reserve of data){
        let id = reserve.reserveID;
        let canteen = reserve.canteen ;
        let menu_date = reserve.menu_date;
        let created_date = reserve.created_date;
        let meal = reserve.meal;

        finaloutput += `<tr data-id ="${id}">
        <td>${menu_date}</td>
        <td>${meal}</td>
        <td>${canteen}</td>
        <td>${created_date}</td>
        <td><button class="dokme bgc-orange reserve-select">Get Foods</button></td>
        </tr>`;

    }
    finaloutput+=`</tbody>
                        </table>  
                    </div>`;
    
    main.innerHTML = finaloutput;

}

main.addEventListener('click' , (e) =>{
    if(e.target.classList.contains('reserve-select')){
        let reserveID  = e.target.closest('tr').dataset.id ;
        step2_reserveDetails(reserveID);;
    }
});


async function step2_reserveDetails(reserveID){
    pagetitle.innerText = "";
    let alltypes = await getTypes();

    const response = await fetch("index.php?page=get-reserve-details",{
        method:"POST" ,
        headers: {"Content-Type" : "application/json"},
        body: JSON.stringify({reserveID:reserveID})
    });
    const data = await response.json();

    main.innerHTML = '' ;
    let finaloutput = `<div class="col-md-5">
                            <div class="my-4">
                                <h3>Show This Code to Operator</h3>
                            </div>
                            <hr>
                            <div class="tile bgc-orange mb-4">
                                <h1> Code : </h1>
                                <h1 id="reserveID">${reserveID}</h1>
                            </div>
                            <hr>
                            
                        </div>
                            
                            `;

                            
    finaloutput += `<div class="col-md-6">
                            <div class=" my-4">
                                <h3>Foods in your Reserve</h3>
                            </div>
                        `;

    for(let type of alltypes ){
        finaloutput  += `<hr>
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
    
        
    main.innerHTML = finaloutput ;

}





async function getTypes() {
    const response = await fetch("index.php?page=get-types");
    const data = await response.json();
    return data ;
}
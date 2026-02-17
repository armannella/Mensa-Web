const addmoneyForm = document.getElementById('addmoneyForm');
const transactionslist = document.getElementById('transactionslist');



getWalletInfo();


addmoneyForm.addEventListener('submit',addPayment);


async function addPayment(e) {
    e.preventDefault();
    const myForm = new FormData(addmoneyForm);

    const response = await fetch("index.php?page=add-payment",{
        method: "POST" ,
        body: myForm
    });
    const data = await response.json();

    alert(data.message);
    if(data.status == 'success') {
        window.location.href = data.redirect ;
    }
}

async function getWalletInfo(){
    const response = await fetch( "index.php?page=get-payments");
    const data= await response.json();
    document.getElementById('balance').innerText = `${data.balance}  Euros`;
    paymentslist= '';
    for (let payment of data.transactions){
        let created_date = payment.created_date;
        let amount = payment.amount;
        let type = payment.type;
        let cls = "" ;
        if (type == "charge"){
            cls = "payment-charge";
        }
        if (type == "reservation"){
            cls = "payment-reserve";
        }
        paymentslist += `
        <tr class = ${cls}>
        <td>${created_date}</td>
        <td>"${type}"</td>
        <td>${amount}</td>
        </tr>`;
    }

    transactionslist.innerHTML = paymentslist ;
}
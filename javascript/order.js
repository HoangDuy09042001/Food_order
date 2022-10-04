const bill = [];
const foodNames = document.querySelectorAll('.foodname');
const foodPrices = document.querySelectorAll('.foodprice');
const foodQuantys = document.querySelectorAll('.foodquanty');
const total = +document.querySelector('.total').innerText.replace('$','');
const foods = [];
const length = foodPrices.length;
for(let i = 0; i < length; i++) {
    const foodname = foodNames[i].innerText;
    const price = +foodPrices[i].innerText;
    const quantity = +foodQuantys[i].innerText;
    const food = {
        foodname,
        price,
        quantity
    }
    foods.push(food);       
}
document.querySelector('.submit-btn').addEventListener('click',()=>{
    const phone = document.querySelector('.phone').value;
    const payment = $("input[name='paymethod']:checked").val();
    bill.push(foods,total,payment,phone);
    console.log(bill);
    $.ajax({
        url:"process.php",
        method:"post",
        data: {bill: JSON.stringify(bill)},
        success:function(res){
            if(res.includes('Add successfully created')){
                alert('Add successfully created');
            }
          
        }
    })
})

    const quantityminusBtns = document.querySelectorAll('.minus');
    for(const quantityminusBtn of quantityminusBtns){
        quantityminusBtn.addEventListener("click", ()=>{
        let value = quantityminusBtn.nextElementSibling.innerText;
        if(value>=1) value--;
        quantityminusBtn.nextElementSibling.innerText=value;
    });
    
    }
    const quantityplusBtns = document.querySelectorAll('.plus');
    for(const quantityplusBtn of quantityplusBtns){
        quantityplusBtn.addEventListener("click", ()=>{
           let value = quantityplusBtn.previousElementSibling.innerText;
           value++;
           quantityplusBtn.previousElementSibling.innerText=value;
    });
    
    
    }
    const orderList = [];
    const orderBtns = document.querySelectorAll('.order-quantity');
    for(const orderBtn of orderBtns){
        orderBtn.addEventListener("click", ()=>{
           const foodName = orderBtn.closest('.food-menu-box').querySelector('.food-name').innerText;
           const foodPrice =  +orderBtn.closest('.food-menu-box').querySelector('.food-price').innerText.replace("$", "");
           const foodQuanty =  +orderBtn.closest('.food-menu-box').querySelector('.quantity-product').innerText;
           if(foodQuanty > 0){
               const order = {
                foodName,
                foodPrice,
                foodQuanty
               }
               orderList.push(order);
               alert("You've add this food successfully!")
           }else{
            alert('Please select number of product');
           }
        });
    }
    document.querySelector('.submit-order').addEventListener('click',()=>{
        if(orderList.length > 0){
            $.ajax({
                url:"process.php",
                method:"post",
                data: {list: JSON.stringify(orderList)},
                success:function(res){
                    console.log(res);
                }
            })
            while (orderList.length > 0) {
                orderList.pop();
              }
            setTimeout(()=>{
                document.querySelector('.submit-order a').setAttribute("href", "http://localhost/food-order/retrieve.html");
                document.querySelector('.submit-order a').click();
            },3000);
        }
    
    })

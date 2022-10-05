<?php
require_once 'dbConfig.php'; 
$result = $db->query("SELECT * FROM images ORDER BY id DESC"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="historyorder.php">HistoryOrder</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <!-- Thu Nghiem Start  -->
            <?php
            $i=0;
            $sum=0;
            while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="food-menu-box" style="background-image:url('data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>');">

                <div class="food-menu-desc">
                    <h4 class="food-name"><?php echo $row['foodName']; ?></h4>
                    <p class="food-price"><?php echo "$".$row['foodPrice']; ?></p>
                    <p class="food-detail">
                       <?php echo $row['foodDes']; ?>
                    </p>
                    <br>
                   <div class="quantity">
                        <div class="order-quantity btn btn-primary"><a href="#" class="btn btn-primary">Order Now</a></div>
                        <div class="quantity-number">
                            <span class="minus"><i class="fa-solid fa-chevron-left"></i></span>
                            <span class="quantity-product">0</span>
                            <span class="plus"><i class="fa-solid fa-chevron-right"></i></span>
                        </div>
                   </div>
                </div>
            </div>
            <?php
            $i++;
            }
            ?>

            <!-- Thu Nghiem End  -->
            
            
            <div class="clearfix"></div>
            
            
            
        </div>
        <div class="submit-order" >          
                <a href=""> Submit</a>
        </div>
        
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->
    <div class="scroll" style="">
        <div class="icon-scroll">
           <span class="minus"><i class="fa-solid fa-chevron-up"></i>
           <a href="#"></a>
           </span>
        </div>
    </div>
    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Hoàng Duy</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
<script src="./javascript/foods.js"></script>
<script>
    window.addEventListener('scroll', ()=>{
        if(window.scrollY > 200){
            document.querySelector('.scroll').style.display = "flex";
        }else{   
            document.querySelector('.scroll').style.display = "none";
        }
    })
    document.querySelector('.scroll').addEventListener('click', ()=>{
        document.querySelector('.scroll a').click();
    })
</script>
</html>
<?php
require_once 'database.php'; 
$result = mysqli_query($conn, "SELECT 
foodname,
price,
quantity,
total,
created
FROM bill 
WHERE orderfood = ( SELECT MAX(orderfood) FROM bill )");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
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
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <!-- <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section> -->
    <!-- fOOD sEARCH Section Ends Here -->
    <div class="latest">
        <div class="latest-form">
            <?php
                $i=0;
                $total=0;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                 <div class="item">
                    <div class="name"><?php echo $row['foodname'];?></div>
                    <div class="price"><?php echo $row['price'];?></div>
                    <div class="quantity"><?php echo $row['quantity'];?></div>
                 </div>
                <?php
                $i++;
                $total = $row['total'];
            }
            ?>
                <div class="total"><?php echo '$'.$total;?></div>
    
        </div>
    </div>
   
</body>
</html
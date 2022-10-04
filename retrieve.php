<?php
include_once 'database.php';
$result = mysqli_query($conn,"SELECT * FROM orderfoodform");
$res=mysqli_query($conn,"SELECT SUM(foodPrice) AS `total` FROM orderfoodform");
$data=mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" href="style.css">   
 <title> Retrive data</title>
 <link rel="stylesheet" href="css/style.css">
 <link rel="stylesheet" href="css/form/order.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="categories.html">Categories</a>
                    </li>
                    <li>
                        <a href="foods.html">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
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
<div class="content">
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
      <table class="responsive-table">
          <caption style="color:white;"> Order Table</caption>
    <thead>
          <tr>
            <th scope="col" style="text-align:center;"><span><i class="fa-light fa-burger-soda"></i></span>Food Name</th>
            <th scope="col">Food Price</th>
            <th scope="col">Food Quantity</th>
          </tr>
    </thead>
    <tbody>
    <?php
    $i=0;
    $sum=0;
    while($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td data-title="FoodName"><?php echo $row["foodName"]; ?></td>
        <td data-title="FoodPrice"><?php echo $row["foodPrice"]; ?></td>
        <td data-title="FoodQuanty" data-type="currency" style="text-align:center;"><?php echo $row["foodQuanty"]; ?></td>
        <?php
        $pricepro = $row["foodPrice"]*$row["foodQuanty"];
        $sum+=$pricepro;
        ?>
    </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
    </table>
     <?php
    }
    else{
        echo "No result found";
    }
    ?>
    <table style="height:25vh;width:100%">
        <tr>
            <th style="width:25%;border:1px solid green;background-color:green;">Total</th>
            <th style="width:75%;border:1px solid green;background-color:green;">Payment</th>
        </tr>
        <tr>
            <td style="text-align:center;border:1px solid green;font-size:50px;color:green"><?php echo "$".$sum;?></td>
            <td style="display:block;border:1px solid green;height:100%">
                <div style="height:50%; margin-left:20%;"><input type="radio" value="card" name="paymethod">   credit card</input></div>
                <div style="height:50%; margin-left:20%;"><input  type="radio" value="cash" name="paymethod">    cash</input></div>
            </td>
        </tr>
    </table>
    <button class="submit-btn">Order</button>
</div>
 </body>
</html>
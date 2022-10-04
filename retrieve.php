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
 <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="css/style.css">
 <link rel="stylesheet" href="css/form/order.css">
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
    <div style="background-color:rgba(0,0,0,0);">
        <?php
        if (mysqli_num_rows($result) > 0) {
        ?>
          <table class="responsive-table">
              <caption style="color:white;"> Order Table</caption>
        <thead>
              <tr>
                <th scope="col" style="text-align:center;">Food Name</th>
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
            <td class="foodname" data-title="FoodName"><?php echo $row["foodName"]; ?></td>
            <td class="foodprice" data-title="FoodPrice"><?php echo $row["foodPrice"]; ?></td>
            <td class="foodquanty" data-title="FoodQuanty" data-type="currency" ><?php echo $row["foodQuanty"]; ?></td>
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
                <th scope="col" style="">Total</th>
                <th scope="col" style="">Payment</th>
                <th scope="col" style="">Your phone</th>
            </tr>
            <tr>
                <td style="text-align:center;font-size:50px;color:white;" class="total"><?php echo "$".$sum;?></td>
                <td style="display:block;height:100%;">
                    <div style="height:50%; margin-left:20%;"><input type="radio" value="card" name="paymethod">   credit card</input></div>
                    <div style="height:50%; margin-left:20%;"><input  type="radio" value="cash" name="paymethod">    cash</input></div>
                </td>
                <td style="position:relative;"><input class="phone" type="text" name="phone" id="phone"></td>
            </tr>
        </table>
        <button class="submit-btn">Order</button>
    </div>
</div>
 </body>
 <script src="./javascript/order.js"></script>
</html>
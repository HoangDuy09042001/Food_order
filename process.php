<?php
    include_once 'database.php';
    require_once 'dbConfig.php'; 
  
if (isset($_POST['list']))
 {
  $del = "TRUNCATE orderfoodform";
  if ($conn->query($del) === TRUE){
    echo "Delete successfully";
  } else {
    echo "Error: " . $del . "<br>" . $conn->error;
  }
    $orders = json_decode($_POST['list'], true);
    foreach ($orders as $order) {
        $foodName = $order['foodName'];
        $foodPrice = $order['foodPrice'];
        $foodQuanty = $order['foodQuanty'];
        $sql = "INSERT INTO orderfoodform (foodName, foodPrice, foodQuanty)
        VALUES ('$foodName', '$foodPrice', '$foodQuanty')";
        if ($conn->query($sql) === TRUE) {
           echo "Add succefully created";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
       
}
$conn->close();
}
if(isset($_POST['foodpage'])){
  $it = json_decode($_POST['foodpage'], true);
  $result = $db->query("SELECT * FROM images "); 
  while ($row = mysqli_fetch_array($result)) {
    echo '<div class="food-menu-box" style="background-image:url(\'data:image/jpg;charset=utf8;base64,' .base64_encode($row['image']). '\');">

    <div class="food-menu-desc">
        <h4 class="food-name">' .$row['foodName']. '</h4>
        <p class="food-price">$' .$row['foodPrice']. '</p>
        <p class="food-detail">' .$row['foodDes']. '</p>
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
</div>';
  }
 }
 if(isset($_POST['retrievepage'])){
  $result = mysqli_query($conn, "SELECT * FROM orderfoodform");
  $res=mysqli_query($conn, "SELECT SUM(foodPrice) AS `total` FROM orderfoodform");
  $data=mysqli_fetch_array($res);
    $it = json_decode($_POST['retrievepage'], true);
    if (mysqli_num_rows($result) > 0) {
        $sum=0;
        while($row = mysqli_fetch_array($result)) {
        echo '
        <tr>
            <td class="foodname" data-title="FoodName">' .$row["foodName"]. '</td>
            <td class="foodprice" data-title="FoodPrice">$' .$row["foodPrice"]. '</td>
            <td class="foodquanty" data-title="FoodQuanty" data-type="currency" >' .$row["foodQuanty"]. '</td>
            </tr>';
            $pricepro = $row["foodPrice"]*$row["foodQuanty"];
            $sum+=$pricepro;

        
           }
        }

}
if (isset($_POST['bill'])){
  $res=mysqli_query($conn, "SELECT MAX(orderfood) AS maxorderfood FROM bill");
  $i=0;
  while ($row = mysqli_fetch_array($res)) {
      $maxorderfood = $row['maxorderfood'];
    $i++;
  }
  $maxorderfood++;
  $billorder = json_decode($_POST['bill'], true);
  $arrlength = count($billorder[0]);
  $total = $billorder[1];
  $payment = $billorder[2];
  $phone = $billorder[3];
  for ($x = 0; $x < $arrlength; $x++) {
    $foodname = $billorder[0][$x]['foodname'];
    $price = $billorder[0][$x]['price'];
    $quantity = $billorder[0][$x]['quantity'];
    $bill = "INSERT INTO bill (foodname, price, quantity, total, payment, phone, orderfood, created)
        VALUES ('$foodname', '$price', '$quantity', '$total', '$payment', '$phone', '$maxorderfood', NOW())";
        if ($conn->query($bill) === TRUE) {
           print_r("Add successfully created");
          } else {
            echo "Error: " . $bill . "<br>" . $conn->error;
          }
  }
  $conn->close();
}
if (isset($_POST['item']))
 {
  $it = json_decode($_POST['item'], true);
  $result = $db->query("SELECT * FROM images WHERE typeFood='$it'"); 
  while ($row = mysqli_fetch_array($result)) {
    echo '<div class="food-menu-box" style="background-image:url(\'data:image/jpg;charset=utf8;base64,'.base64_encode($row["image"]).'\');">

    <div class="food-menu-desc">
        <h4 class="food-name">'. $row['foodName'] . '</h4>
        <p class="food-price">$'.$row['foodPrice'] . '</p>
        <p class="food-detail">' . $row['foodDes'] . '</p>
        <br>
    </div>
</div>';
  }
 }
 if(isset($_POST['loadpage'])){
  $it = json_decode($_POST['loadpage'], true);
  $result = $db->query("SELECT * FROM images "); 
  while ($row = mysqli_fetch_array($result)) {
    echo '<div class="food-menu-box" style="background-image:url(\'data:image/jpg;charset=utf8;base64,'.base64_encode($row["image"]).'\');">

    <div class="food-menu-desc">
        <h4 class="food-name">'. $row['foodName'] . '</h4>
        <p class="food-price">$'.$row['foodPrice'] . '</p>
        <p class="food-detail">' . $row['foodDes'] . '</p>
        <br>
    </div>
</div>';
  }
 }
 
?>


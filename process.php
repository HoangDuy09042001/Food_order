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
?>


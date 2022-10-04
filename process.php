<?php
    include_once 'database.php';
  
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
  $del = "TRUNCATE bill";
  if ($conn->query($del) === TRUE){
    echo "Delete successfully";
  } else {
    echo "Error: " . $del . "<br>" . $conn->error;
  }
  $billorder = json_decode($_POST['bill'], true);
  $arrlength = count($billorder[0]);
  $total = $billorder[1];
  $payment = $billorder[2];
  $phone = $billorder[3];
  for ($x = 0; $x < $arrlength; $x++) {
    $foodname = $billorder[0][$x]['foodname'];
    $price = $billorder[0][$x]['price'];
    $quantity = $billorder[0][$x]['quantity'];
    $bill = "INSERT INTO bill (foodname, price, quantity, total, payment, phone)
        VALUES ('$foodname', '$price', '$quantity', '$total', '$payment', '$phone')";
        if ($conn->query($bill) === TRUE) {
           echo "Add succefully created";
          } else {
            echo "Error: " . $bill . "<br>" . $conn->error;
          }
  }
  $conn->close();
}
?>


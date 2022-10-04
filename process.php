<?php 
    include_once 'database.php';
    $del = "TRUNCATE orderfoodform";
    if ($conn->query($del) === TRUE){
      echo "Delete successfully";
    }else{
      echo "Error: " . $del . "<br>" . $conn->error;
    }
  
if(isset($_POST['list']))
{
    $orders = json_decode($_POST['list'], true);
    foreach($orders as $order){
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
?>

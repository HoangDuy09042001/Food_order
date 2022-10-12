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
if(isset($_POST['foodpage'])){
  $it = json_decode($_POST['foodpage'], true);
  $result = $conn->query("SELECT * FROM images "); 
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
  $conn->close();
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
  $result = $db->query("SELECT * FROM images WHERE typeFood='$it' "); 
  while ($row = mysqli_fetch_array($result) ) {
      echo '<div class="food-menu-box" style="background-image:url(\'data:image/jpg;charset=utf8;base64,'.base64_encode($row["image"]).'\');">
  
      <div class="food-menu-desc">
          <h4 class="food-name">'. $row['foodName'] . '</h4>
          <p class="food-price">$'.$row['foodPrice'] .'</p>
          <p class="food-detail">' . $row['foodDes'] .'</p>
          <br>
      </div>
  </div>';
  }
  $conn->close();
 }
 if(isset($_POST['loadpage'])){
  $it = json_decode($_POST['loadpage'], true);
  $result = $db->query("SELECT * FROM images ORDER BY foodPrice ASC"); 
  $i=0;
  while ($row = mysqli_fetch_array($result)) {
    if($i<10){
      echo '<div class="food-menu-box" style="background-image:url(\'data:image/jpg;charset=utf8;base64,'.base64_encode($row["image"]).'\');">
  
                <div class="food-menu-desc">
                    <h4 class="food-name">'. $row['foodName'] . '</h4>
                    <p class="food-price">$'.$row['foodPrice'] . '</p>
                    <p class="food-detail">' . $row['foodDes'] . '</p>
                    <br>
                </div>
            </div>';
    }
    $i++;
  }
  $conn->close();
 }

 if(isset($_POST['search'])){
  function convert_name ($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
    $str = preg_replace("/( )/", '-', $str);
    return $str;
  }
  $search = json_decode($_POST['search'], true);
  $result = $db->query("SELECT * FROM images ORDER BY foodPrice ASC"); 
  $i=0;
  while ($row = mysqli_fetch_array($result)) {
      $name = $row['foodName'];
      if($name ===''){
        print_r($name);
      }else{
        if($i<5){
          if (str_contains(strtolower(convert_name($name)), strtolower(convert_name($search)))) {
            echo '<div class="search-content-item">'.$name.'</div>';
            $i++;
          }
  
        }

      }
  }
  $conn->close();
 }
 if(isset($_POST['valueItemSearch'])){
  $valueItemSearch = json_decode($_POST['valueItemSearch'], true);
  $resultTypeFood = $db->query("SELECT * FROM images WHERE foodName = '$valueItemSearch'");
  while ($row = mysqli_fetch_array($resultTypeFood)) {
    $type = $row['typeFood'];
    echo '<div class="food-menu-box" style="background-image:url(\'data:image/jpg;charset=utf8;base64,'.base64_encode($row["image"]).'\');">
  
    <div class="food-menu-desc" id="food-menu-desc' .$row['id']. ' " typefood=" '.$row['typeFood'].' ">
        <h4 class="food-name">'. $row['foodName'] . '</h4>
        <p class="food-price">$'.$row['foodPrice'] . '</p>
        <p class="food-detail">' . $row['foodDes'] . '</p>
        <br>
    </div>
    </div>';
  }
  $result = $db->query("SELECT * FROM images WHERE typeFood = '$type'");
  $i=0;
  while ($row = mysqli_fetch_array($result)) {
    if( $row['foodName']!==$valueItemSearch){
      echo '<div class="food-menu-box" style="background-image:url(\'data:image/jpg;charset=utf8;base64,'.base64_encode($row["image"]).'\');">
    
                  <div class="food-menu-desc" id="food-menu-desc' .$row['id']. ' " typefood=" '.$row['typeFood'].' ">
                      <h4 class="food-name">'. $row['foodName'] . '</h4>
                      <p class="food-price">$'.$row['foodPrice'] . '</p>
                      <p class="food-detail">' . $row['foodDes'] . '</p>
                      <br>
                  </div>
              </div>';
     }
     $i++;

    }
 }
 if(isset($_POST['history'])){
  $maxresult = mysqli_query($conn, "SELECT 
  orderfood
  FROM bill 
  WHERE orderfood = ( SELECT MAX(orderfood) FROM bill )
  ORDER BY id ASC
  LIMIT 1");
  while ($row = mysqli_fetch_array($maxresult)) {
     $maxorder = $row['orderfood'];
  }   
  $result = mysqli_query($conn, " SELECT bill.foodname,
  bill.price,
  bill.quantity,
  bill.total,
  bill.orderfood,
  bill.created,
  images.image 
  FROM bill 
  INNER JOIN images ON bill.foodname = images.foodName ORDER BY bill.orderfood DESC
  ");

$prev=$maxorder;
while ($row = mysqli_fetch_array($result)) {
  $noworder = $row['orderfood'];
  if ($noworder != $prev){
     if ($prev==$maxorder){
        echo '<tr style="">
        <td colspan="3" class="total" style="font-weight:bold;color:red;">Lastest total: $'.$total.'</td>
        <td colspan="1" class="date" style="font-weight:bold;color:red;">'.$date.'</td>
        </tr>'; 
     }else{
     echo '<tr style="">
     <td colspan="3" class="total" style="font-weight:bold;">Total: $'.$total.'</td>
     <td colspan="1" class="date" style="font-weight:bold;">'.$date.'</td>
     </tr>';
     }
     $prev = $noworder;
   }


echo '<tr>
    <td><img src="data:image/jpg;charset=utf8;base64,' .base64_encode($row['image']). '" alt="" /></td>
    <td>' .$row['foodname']. '</td>
    <td>$' .$row['price']. '</td>
    <td>'. $row['quantity']. '</td>
</tr>';
$total = $row['total'];
$date = $row['created'];

}

echo '<tr>
<td colspan="3" class="total" style="font-weight:bold;">Total: $' .$total. '</td>
<td colspan="1" class="date" style="font-weight:bold;">' .$date. '</td>
</tr>';
$conn->close();
 }
?>


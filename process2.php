<?php
include_once 'database.php';
$result = mysqli_query($conn, "SELECT * FROM orderfoodform");
$res=mysqli_query($conn, "SELECT SUM(foodPrice) AS `total` FROM orderfoodform");
$data=mysqli_fetch_array($res);
if(isset($_POST['retrievepage'])){
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
?>

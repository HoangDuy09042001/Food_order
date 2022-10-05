<?php
require_once 'database.php'; 
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/form/history.css">
</head>
<body>
<div class="table-users">
   <div class="header">Order list</div>
   
   <table cellspacing="0">
      <tr>
         <th>Picture</th>
         <th>Name</th>
         <th>Price</th>
         <th>Quanty</th>
      </tr>
      <?php
                $prev=$maxorder;
                while ($row = mysqli_fetch_array($result)) {
                  $noworder = $row['orderfood'];
                  if ($noworder != $prev){
                     if ($prev==$maxorder){
                        echo '<tr style="">
                        <td colspan="3" class="total" style="font-weight:bold;">Lastest total: $'.$total.'</td>
                        <td colspan="1" class="date" style="font-weight:bold;">'.$date.'</td>
                        </tr>'; 
                     }else{
                     echo '<tr style="">
                     <td colspan="3" class="total" style="font-weight:bold;">Total: $'.$total.'</td>
                     <td colspan="1" class="date" style="font-weight:bold;">'.$date.'</td>
                     </tr>';
                     }
                     $prev = $noworder;
                   }
                ?>
                 <tr>
                    <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="" /></td>
                    <td><?php echo $row['foodname'];?></td>
                    <td><?php echo "$".$row['price'];?></td>
                    <td><?php echo $row['quantity'];?></td>
                </tr>
                <?php
                $total = $row['total'];
                $date = $row['created'];

                }
                ?>
   
   <tr>
      <td colspan="3" class="total" style="font-weight:bold;"><?php echo "Total: $".$total;?></td>
      <td colspan="1" class="date" style="font-weight:bold;"><?php echo $date;?></td>
   </tr>
   <?php
   
   ?>
   </table>
</div>
</body>
</html>
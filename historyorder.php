<?php
require_once 'database.php'; 
// $result = mysqli_query($conn, "SELECT 
// foodname,
// price,
// quantity,
// total,
// created
// FROM bill 
// WHERE orderfood = ( SELECT MAX(orderfood) FROM bill )");
$result = mysqli_query($conn, " SELECT historyorder.foodname,
historyorder.price,
historyorder.quantity,
historyorder.total,
historyorder.created,
images.image 
FROM
(SELECT 
foodname,
price,
quantity,
total,
created
FROM bill 
WHERE orderfood = ( SELECT MAX(orderfood) FROM bill )) AS historyorder
INNER JOIN images ON historyorder.foodname = images.foodName
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
   <div class="header">Users</div>
   
   <table cellspacing="0">
      <tr>
         <th>Picture</th>
         <th>Name</th>
         <th>Price</th>
         <th>Quanty</th>
      </tr>
      <?php
                $i=0;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                 <tr>
                    <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="" /></td>
                    <td><?php echo $row['foodname'];?></td>
                    <td><?php echo "$".$row['price'];?></td>
                    <td><?php echo $row['quantity'];?></td>
                </tr>
                <?php
                $i++;
                $total = $row['total'];
                $date = $row['created'];
            }
            ?>
   <tfoot><tr>
      <td colspan="3" class="total" style=""><?php echo "Total :$".$total;?></td>
      <td colspan="1" class="date" style=""><?php echo $date;?></td>
   </tr></tfoot>
   </table>
</div>
</body>
</html>
<?php

require_once('../Database/connectToDatabase.php');

$sql_chart1="SELECT (COUNT(id)/2)*100 AS Number,`applied_date` FROM Med WHERE `product_name`='DIACARE 2MG CAPSULES * 8' GROUP By `applied_date`  
ORDER BY `Med`.`applied_date`  ASC";
$result = $conn->query($sql_chart1);


               if (($result->num_rows > 0)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $emparray[] = $row;
                    }
                    echo json_encode($emparray);
                }
?>

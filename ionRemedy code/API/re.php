<?php

require_once('../Database/connectToDatabase.php');

$sql_chart1="SELECT COUNT(reason.id) as id,reson_type.name FROM reason INNER JOIN reson_type WHERE reason_id = reson_type.id  GROUP BY reason.reason_id";
$result = $conn->query($sql_chart1);


               if (($result->num_rows > 0)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $emparray[] = $row;
                    }
                    echo json_encode($emparray);
                }
?>

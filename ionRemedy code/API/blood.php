<?php

require_once('../Database/connectToDatabase.php');

$sql_chart1="SELECT `bp_systolic`, `bp_diastolic`, `read_ndate` FROM `Vitals` WHERE 1 ORDER BY `Vitals`.`read_ndate` ASC";
$result = $conn->query($sql_chart1);


               if (($result->num_rows > 0)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $emparray[] = $row;
                    }
                    echo json_encode($emparray);
                }
?>

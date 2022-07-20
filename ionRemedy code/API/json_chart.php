<?php

require_once('../Database/connectToDatabase.php');
$id = $_GET['id'];
$sql_chart1="";
if($id==1){
    $sql_chart1="SELECT `temp`,`read_ndate` FROM `Vitals` ORDER BY `Vitals`.`read_ndate` ASC";
}else if($id==2){
    $sql_chart1="SELECT `pulse`,`read_ndate` FROM `Vitals`  ORDER BY `Vitals`.`read_ndate`  ASC";
}else if($id==3){
    $sql_chart1="SELECT `respiratory_rate`,`read_ndate` FROM `Vitals`  ORDER BY `Vitals`.`read_ndate`  ASC";
}
$result = $conn->query($sql_chart1);
               if (($result->num_rows > 0)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $emparray[] = $row;
                    }
                    echo json_encode($emparray);
                }
?>

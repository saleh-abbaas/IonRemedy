<?php
require './Database/connectToDatabase.php';

$product_name = $_POST['product_name'];

$sql = "SELECT * FROM Lab WHERE Lab.product_name="."'".$product_name."'";
$result = $conn->query($sql);

$response = "<table class='table text-center'>";
$response .= "<thead class='thead-light'>";
$response .= "<tr>";
$response .= "<th>Product Name</th><th>Result Name</th><th>Result Note</th><th>Unit</th><th>Result Date</th><th>Result Time</th>";
$response .= "</tr>";
$response .= "</thead>";
$response .= "<tbody>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {

    $response .= "<tr>";
    $response .= "<td>".$row['product_name']."</td><td>".$row['result_name']."</td><td>".$row['result_notes']."</td><td>".$row['unit']."</td><td>".$row['result_date']."</td><td>".$row['result_time']."</td>";
    $response .= "</tr>";
    $response .= "</tbody>";

}}
$response .= "</table>";
echo $response;
exit;
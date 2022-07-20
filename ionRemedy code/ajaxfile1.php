<?php
require './Database/connectToDatabase.php';

$med_id = $_POST['med_id'];

$sql = "SELECT * FROM Med WHERE Med.id="."'".$med_id."'";
$result = $conn->query($sql);

$response = "<table class='table text-center'>";

$response .= "<tbody>";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    $response .= "<tr>";
    $response .= $row['instructions'];
    $response .= "</tr>";
    $response .= "</tbody>";

}}
$response .= "</table>";
echo $response;
exit;
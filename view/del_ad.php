<?php
include('config.php');

$query = "DELETE FROM advertisings WHERE ad_id='$ad_id'";
$result = $conn->query($query); 
if($result)
    header("Location: ../report");
?>
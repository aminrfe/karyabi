<?php
include('config.php');

$query = "DELETE FROM advertising_sources WHERE as_id='$as_id'";
$result = $conn->query($query); 
if($result)
    header("Location: ../sources");
?>
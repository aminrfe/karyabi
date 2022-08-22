<?php
include('config.php');

$query = "DELETE FROM users WHERE u_id='$u_id'";
$result = $conn->query($query); 
if($result)
    header("Location: ../users");
?>
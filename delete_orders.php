<?php
include("connection/connect.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM users_orders WHERE OID = '".$_GET['order_del']."'"); // Suppresion des commandes sélectionnées selon l'ID
header("location: your_orders.php");

?>

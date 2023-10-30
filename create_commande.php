<?php
session_start();
$clientId = $_SESSION['id_client']; 
$currentDateTime = date('Y-m-d H:i:s');
$insertCommandQuery = $db->prepare("INSERT INTO commandes (id_client, date_heure) VALUES (:clientId, :currentDateTime)");
$insertCommandQuery->bindParam(':clientId', $clientId);
$insertCommandQuery->bindParam(':currentDateTime', $currentDateTime);
?>
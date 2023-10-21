<?php

require 'core/db.php';
$conn = new Connection();

$username = $_POST['username'];

$sql = "insert into users (username) value ('$username')";

$stmt = $conn->conn->prepare($sql);
$stmt->execute();

<?php
$servername = "localhost";
$username = "root";
$password = "";


$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS notesapp_data";

if ($conn->query($sql) === FALSE) {
  echo "Error creating database: " . $conn->error;
}

$conn -> select_db("notesapp_data");


$sql = "CREATE TABLE IF NOT EXISTS users (
email VARCHAR(50) NOT NULL PRIMARY KEY,
first_name VARCHAR(50) NOT NULL,
last_name VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === FALSE) {
  echo "Error creating table: " . $conn->error;
}



$sql1 = "CREATE TABLE IF NOT EXISTS notesapp (
        ID      INTEGER PRIMARY KEY AUTO_INCREMENT,
        userid VARCHAR(50) NOT NULL,
        title   TEXT NOT NULL,
        content TEXT NOT NULL,
        created DATETIME NOT NULL
        );";

if ($conn->query($sql1) === FALSE) {
  echo "Error creating table2: " . $conn->error;
}



?>
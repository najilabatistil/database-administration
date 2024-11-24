<?php
include('connect.php');

session_start();

if (!isset($_SESSION['userID'])) {
  header("Location: login.php");
}

// Create post
if (isset($_POST['btnPost'])) {
  $content = $_POST['content'];
  $privacy = $_POST['privacy'];
  $addressID = $_POST['address'];

  $insertQuery = "INSERT INTO posts (userID, content, privacy, isDeleted, addressID) VALUES ('{$_SESSION['userID']}', '$content', '$privacy', 'no', '$addressID')";
  executeQuery($insertQuery);
}

// Delete post
if(isset($_POST['btnDelete'])){
  $postID = $_POST['postID'];

  $deleteQuery = "UPDATE posts SET isDeleted = 'yes' WHERE postID = '$postID'";
  executeQuery($deleteQuery);
}

// Edit post
if(isset($_POST['btnEdit'])){
  $postID = $_POST['postID'];
  $content = $_POST['content'];
  $privacy = $_POST['privacy'];
  $addressID = $_POST['address'];

  $editPostQuery = "UPDATE posts SET content = '$content', privacy = '$privacy', addressID = '$addressID' WHERE postID = '$postID'";
  executeQuery($editPostQuery);
}

// Query for getting addresses
$addressQuery = "SELECT addressID, cities.name AS cityName, provinces.name AS provinceName FROM addresses LEFT JOIN cities ON addresses.cityID = cities.cityID LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID";
$addressResult = executeQuery($addressQuery);

// Query for displaying post info
$postQuery = "SELECT posts.postID, posts.content, posts.dateTime, posts.privacy, posts.addressID, cities.name AS cityName, provinces.name AS provinceName FROM posts LEFT JOIN addresses on posts.addressID = addresses.addressID LEFT JOIN cities ON addresses.cityID = cities.cityID LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID WHERE userID = '{$_SESSION['userID']}' AND isDeleted = 'no' ORDER BY postID DESC" ;
$postResult = executeQuery($postQuery);

?>
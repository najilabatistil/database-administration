<?php
include('connect.php');

session_start();

if (!isset($_SESSION['userID'])) {
  header("Location: login.php");
}

// Delete Account
if (isset($_POST['btnDeleteAccount'])) {
  $deleteQuery = "DELETE FROM users WHERE userID = '{$_SESSION['userID']}'";
  executeQuery($deleteQuery);

  header("Location: login.php");
}

// Edit Information
if (isset($_POST["btnEditInfo"])) {
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $username = $_POST["username"];
  $phoneNumber = $_POST["phoneNumber"];
  $email = $_POST["email"];
  $userAddress = $_POST["address"];
  $birthday = $_POST["birthDay"];

  $editInfoQuery = "UPDATE users INNER JOIN userInfo ON users.userID = userInfo.userID SET userInfo.firstName = '$firstName', userInfo.lastName = '$lastName', users.username = '$username', users.phoneNumber = '$phoneNumber', users.email = '$email', userInfo.addressID = '$userAddress', userInfo.birthDay = '$birthday' WHERE users.userID = '{$_SESSION['userID']}' AND userInfo.userID = '{$_SESSION['userID']}'";
  executeQuery($editInfoQuery);

  // Update session variables
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $email;
  $_SESSION['phoneNumber'] = $phoneNumber;
  $_SESSION['name'] = $firstName . " " . $lastName;

  // Refresh page
  header('Location: settings.php');
}

// Query for getting addresses
$addressQuery = "SELECT addressID, cities.name AS cityName, provinces.name AS provinceName FROM addresses LEFT JOIN cities ON addresses.cityID = cities.cityID LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID";
$addressResult = executeQuery($addressQuery);
?>
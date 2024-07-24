<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "appuser", "waltzerW@312#", "waltzer");

if ($conn->connect_error) {
    die(json_encode(["result" => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);
$userId = $data['userId'];
$productId = $data['productId'];

$sql = "INSERT INTO wishlist (UserId, ProductId) VALUES ('$userId', '$productId')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["result" => "Product added to Wishlist successfully"]);
} else {
    echo json_encode(["result" => "Error: " . $conn->error]);
}

$conn->close();
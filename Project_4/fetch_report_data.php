<?php
// Author: Guy Charles
// Written on: 08-16-2024
// Project Name: Bug Report Web Page
// Description: PHP script to handle AJAX requests for fetching specific bug report data based on report ID.

require_once 'utilities.php';

$db = new Database();
$conn = $db->getConnection();

$id = $db->sanitizeInput($_POST['id']);

$stmt = $conn->prepare("SELECT * FROM reports WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $report = $result->fetch_assoc();
    echo json_encode($report);
} else {
    echo json_encode(["error" => "No data found for the selected ID"]);
}

$stmt->close();
$db->closeConnection();

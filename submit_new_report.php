<!--
 * Author: Guy Charles
 * Written on: 08-16-2024
 * Project Name: Bug Report Web Page
 * Description: PHP script to handle the submission of a new bug report using an object-oriented approach.
-->
<?php
// Include the utility class
require_once 'utilities.php';

// Create a new Database object
$db = new Database();

// Establish the database connection
$conn = $db->getConnection();

// Initialize variables for error handling
$message = "";
$resetButtonClass = "valid";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form data
    $product_name = $db->sanitizeInput($_POST['product_name'] ?? '');
    $version = $db->sanitizeInput($_POST['version'] ?? '');
    $hardware = $db->sanitizeInput($_POST['hardware'] ?? '');
    $operating_system = $db->sanitizeInput($_POST['operating_system'] ?? '');
    $frequency = $db->sanitizeInput($_POST['frequency'] ?? '');
    $proposed_solution = $db->sanitizeInput($_POST['proposed_solution'] ?? '');

    // Check that all fields are filled
    if ($product_name && $version && $hardware && $operating_system && $frequency && $proposed_solution) {
        // Prepare and bind the SQL statement to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO reports (product_name, version, hardware, operating_system, frequency, proposed_solution) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssssss", $product_name, $version, $hardware, $operating_system, $frequency, $proposed_solution);
            
            // Execute the query
            if ($stmt->execute()) {
                $message = "New record created successfully";
            } else {
                $message = "Error: " . $stmt->error;
                $resetButtonClass = "invalid";
            }
            $stmt->close(); // Close the statement
        } else {
            $message = "Database query failed: " . $conn->error;
            $resetButtonClass = "invalid";
        }
    } else {
        $message = "All fields are required.";
        $resetButtonClass = "invalid";
    }
} else {
    $message = "Invalid request method.";
    $resetButtonClass = "invalid";
}

// Close the database connection
$db->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Report Submission</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .message {
            color: #000;
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .button, .reset-btn {
            padding: 7px 16px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 12px;
            font-size: 17px;
        }
        .button {
            background-color: #007BFF;
            text-decoration: none;
            display: block;
            margin: 12px auto 0 auto; /* Centers the button horizontally and adds margin from the top */
        }
        .reset-btn {
            display: block;
            margin: 15px auto 0 auto; /* Centers the button horizontally and adds margin from the top */
            padding: 7px 16px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 17px;
        }
        button:hover {
            background-color: #0056b3;
        }
        /* Blue color for valid input */
        .reset-btn.valid {
            background-color: #007BFF;
        }
        .reset-btn:hover {
            background-color: #0056b3;
        }
        /* Red color for invalid input */
        .reset-btn.invalid {
            background-color: #ff4500;
        }
    </style>
</head>
<body>
    <div class="container">
        <p class="message"><?php echo $message; ?></p>
        <form action="display_reports.php" method="get">
            <button type="submit" class="button">View Bug Reports</button>
        </form>
        <form action="main_page.php" method="get">
            <button type="submit" class="reset-btn <?php echo $resetButtonClass; ?>">
                <i class="fa-sharp fa-solid fa-arrow-rotate-left"></i>
            </button>
        </form>
    </div>
</body>
</html>

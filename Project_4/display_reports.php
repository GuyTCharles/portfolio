<!--
 * Author: Guy Charles
 * Written on: 08-16-2024
 * Project Name: Bug Report Web Page
 * Description: PHP script to display all bug reports from the database in a table format using an object-oriented approach.
-->
<?php
// Include the utility class
require_once 'utilities.php';

// Create a new Database object
$db = new Database();

// Establish the database connection
$conn = $db->getConnection();

// Query to fetch all bug reports
$query = "SELECT id, product_name, version, hardware, operating_system, frequency, proposed_solution, created_at FROM reports";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            width: 100%;
        }
        h2 {
            margin-top: 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bug Reports</h2>
        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Version</th>
                        <th>Hardware</th>
                        <th>Operating System</th>
                        <th>Frequency</th>
                        <th>Proposed Solution</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['version']); ?></td>
                            <td><?php echo htmlspecialchars($row['hardware']); ?></td>
                            <td><?php echo htmlspecialchars($row['operating_system']); ?></td>
                            <td><?php echo htmlspecialchars($row['frequency']); ?></td>
                            <td><?php echo htmlspecialchars($row['proposed_solution']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No bug reports found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Free result set and close the database connection
if ($result) {
    $result->free();
}
$db->closeConnection();
?>
<!--
 * Author: Guy Charles
 * Written on: 08-16-2024
 * Project Name: Bug Report Web Page
 * Description: Form to update an existing bug report with error handling using an object-oriented approach.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Bug Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            padding: 20px;
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
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #000;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: 600;
        }
        input, textarea, select, button {
            padding: 10px;
            margin: 5px 0;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            margin-top: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
    <!-- Include jQuery for simplicity in AJAX calls -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    // JavaScript function to fetch and populate the form fields based on selected ID
    function fetchReportData(reportId) {
        if (reportId) {
            $.ajax({
                url: 'fetch_report_data.php',
                type: 'POST',
                data: { id: reportId },
                success: function(data) {
                    try {
                        const report = JSON.parse(data);
                        if (report.error) {
                            // Show the error message if there's an error
                            $('.error').text("Error fetching report data: " + report.error).show();
                            // Clear the form fields
                            $('#product_name').val('');
                            $('#version').val('');
                            $('#hardware').val('');
                            $('#operating_system').val('');
                            $('#frequency').val('');
                            $('#proposed_solution').val('');
                        } else {
                            // Populate the form fields with the fetched data
                            $('#product_name').val(report.product_name);
                            $('#version').val(report.version);
                            $('#hardware').val(report.hardware);
                            $('#operating_system').val(report.operating_system);
                            $('#frequency').val(report.frequency);
                            $('#proposed_solution').val(report.proposed_solution);
                            // Hide the error message if data is found
                            $('.error').hide();
                        }
                    } catch (error) {
                        // Handle JSON parsing errors
                        $('.error').text("Error fetching report data: " + error.message).show();
                    }
                },
                error: function() {
                    // Handle server errors
                    $('.error').text("Server error: Unable to fetch report data.").show();
                }
            });
        }
    }
</script>
</head>
<body>
    <div class="container">
        <h1>Update an Existing Bug Report</h1>

        <!-- Error message area -->
        <div class="error"></div>

        <!-- Form to update the selected bug report -->
        <form action="submit_update_report.php" method="post">
            <select id="id" name="id" required onchange="fetchReportData(this.value)">
                <option value="" disabled selected>Select a Report ID</option>
                <?php
                // Include the utility class
                require_once 'utilities.php';

                // Create a new Database object
                $db = new Database();

                // Get the database connection
                $conn = $db->getConnection();

                // Fetch all bug reports
                $sql = "SELECT id FROM reports";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['id'] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No Reports Available</option>";
                }

                // Close the database connection
                $db->closeConnection();
                ?>
            </select>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="version">Version:</label>
            <input type="text" id="version" name="version" required>

            <label for="hardware">Hardware:</label>
            <input type="text" id="hardware" name="hardware" required>

            <label for="operating_system">Operating System:</label>
            <input type="text" id="operating_system" name="operating_system" required>

            <label for="frequency">Frequency of Occurrence:</label>
            <input type="text" id="frequency" name="frequency" required>

            <label for="proposed_solution">Proposed Solution:</label>
            <textarea id="proposed_solution" name="proposed_solution" rows="4" required></textarea>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

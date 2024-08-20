<!--
 * Author: Guy Charles
 * Written on: 08-16-2024
 * Project Name: Bug Report Web Page
 * Description: Form to create a new bug report using an object-oriented approach.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Bug Report</title>
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
        input, textarea, button {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Create a New Bug Report</h1>
        <form action="submit_new_report.php" method="post">
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

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

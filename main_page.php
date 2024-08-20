<!--
 * Author: Guy Charles
 * Written on: 08-16-2024
 * Project Name: Bug Report Web Page
 * Description: Main page with links to create and update bug reports.
-->
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
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #000;
        }
        a {
            display: block;
            margin: 15px 0;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            padding: 10px;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bug Reports</h1>
        <a href="new_report.php">Create a New Bug Report</a>
        <a href="update_report.php">Update an Existing Bug Report</a>
    </div>
</body>
</html>

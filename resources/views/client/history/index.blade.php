<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Order History</h2>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Items</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example order row, replace with dynamic data -->
            <tr>
                <td>1</td>
                <td>Item 1, Item 2</td>
                <td>$25.99</td>
                <td>2023-11-12 14:30:00</td>
            </tr>
            <!-- Repeat rows for each order -->
        </tbody>
    </table>
</div>

</body>
</html>

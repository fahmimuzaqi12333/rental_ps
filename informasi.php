<?php
session_start();

// Include the MongoDB PHP library
require 'vendor/autoload.php';

// Create a MongoDB client
$client = new MongoDB\Client("mongodb://localhost:27017");

// Select the database
$database = $client->selectDatabase('rental_ps');

// Select the collections
$sewaCollection = $database->selectCollection('sewa');
$produkCollection = $database->selectCollection('produk');

// Initialize a variable to check if form is submitted
$dataRetrieved = false;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];

    // Fetch data using aggregation
    $pipeline = [
        [
            '$match' => [
                'Id_produk' => $productId,
            ],
        ],
        [
            '$lookup' => [
                'from' => 'produk',
                'localField' => 'Id_produk',
                'foreignField' => '_id',
                'as' => 'produk_data',
            ],
        ],
        [
            '$unwind' => '$produk_data',
        ],
        [
            '$project' => [
                'Nama' => 1,
                'Alamat' => 1,
                'Telepon' => 1,
                'Lama_sewa' => 1,
                'Harga' => 1,
                'Produk_ID' => '$produk_data._id',
                'Jenis_ps' => '$produk_data.jenis_ps',
                'Warna' => '$produk_data.warna',
            ],
        ],
    ];

    $cursor = $sewaCollection->aggregate($pipeline);

    // Set the flag to true indicating that data has been retrieved
    $dataRetrieved = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Data by Product ID</title>
   <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        a.btn {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            background-color: #5cb85c;
            color: #fff;
            border-radius: 4px;
            margin-top: 10px;
            font-family: Arial, sans-serif;
        }

        a.btn:hover {
            background-color: #4cae4c;
        }

        hr {
            border: 0;
            height: 1px;
            background: #ccc;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 10%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #97B4D6;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>informasi sewa</h2>
    <form method="POST">
        <label for="product_id">Product ID:</label>
        <input type="text" name="product_id" required>
        <button type="submit">CARI</button>
        <a href="navbar.php" class="btn btn-primary bi bi-door-closed" style="font-family: Tekton Pro"> kembali </a>
    </form>

    <?php
    // Display the results if data has been retrieved
    if ($dataRetrieved) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Produk ID</th>';
        echo '<th>Nama</th>';
        echo '<th>Alamat</th>';
        echo '<th>Telepon</th>';
        echo '<th>Lama Sewa</th>';
        echo '<th>Harga</th>';
        echo '<th>Jenis_ps</th>';
        echo '<th>Warna</th>';
        echo '</tr>';

        // Display the results
        foreach ($cursor as $document) {
            echo '<tr>';
            echo '<td>' . $document->Produk_ID . '</td>';
            echo '<td>' . $document->Nama . '</td>';
            echo '<td>' . $document->Alamat . '</td>';
            echo '<td>' . $document->Telepon . '</td>';
            echo '<td>' . $document->Lama_sewa . '</td>';
            echo '<td>' . $document->Harga . '</td>';
            echo '<td>' . $document->Jenis_ps . '</td>';
            echo '<td>' . $document->Warna . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }
    ?>
    
</body>
</html>

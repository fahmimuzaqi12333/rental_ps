<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Produk</title>
    <style>
    body {
    font-family: 'Helvetica', sans-serif;
    margin: 20px;
    background-color: #f5f5f5;
}

h2 {
    color: #333;
    text-align: center;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin-bottom: 15px;
    padding: 15px;
    border: 1px solid #ddd;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
}

li:hover {
    background-color: #f0f0f0;
}

.product-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.product-info {
    flex: 1;
}

.product-id {
    font-weight: bold;
    color: #3498db; /* Blue color for ID */
}

.product-warna {
    color: #2ecc71; /* Green color for warna */
}

    </style>
</head>
<body>

<h2>Menu Produk</h2>

<?php
require 'vendor/autoload.php'; // Load driver MongoDB PHP

// Buat koneksi ke MongoDB
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");

// Pilih database dan koleksi
$database = $mongoClient->rental_ps; // Ganti dengan nama database Anda
$collection = $database->produk; // Ganti dengan nama koleksi Anda

// Ambil data produk dari koleksi MongoDB
$produkList = $collection->find();

// Menampilkan daftar produk
echo "<ul>";
foreach ($produkList as $produk) {
    echo "<li class='product-item'>
            <div class='product-info'>
                <span class='product-id'>ID: {$produk['_id']}</span><br>
                jenis_ps: {$produk['jenis_ps']}<br>
                warna: <span class='product-warna'>{$produk['warna']}</span>
            </div>
          </li>";
}
echo "</ul>";
?>

</body>
</html>

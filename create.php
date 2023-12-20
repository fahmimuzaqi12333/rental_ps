<?php
session_start();
if (isset($_POST['submit'])) {
    require 'config.php';

// Create a MongoDB client
$client = new MongoDB\Client("mongodb://localhost:27017");

// Select the database and collection for sewa
$database = $client->selectDatabase('rental_ps');
$collection = $database->selectCollection('sewa');

// Select the database and collection for produk
$produkCollection = $database->selectCollection('produk');

// Fetch product IDs from the produk collection
$produkIDs = [];
$produkCursor = $produkCollection->find([], ['projection' => ['_id' => 1]]);
foreach ($produkCursor as $produk) {
    $produkIDs[] = $produk->_id;
}

    $lama_sewa = $_POST['Lama_sewa'];
    $harga_per_jam = 4000;

    // Hitung total harga
    $total_harga = $lama_sewa * $harga_per_jam;

    // Assuming you have a MongoDB query to retrieve the product ID
    $productID = $_POST['Id_produk']; // Change this based on your actual implementation

    $insertOneResult = $collection->insertOne([
        'Id_produk' => $productID, // Store the product ID
        'Nama' => $_POST['Nama'],
        'Alamat' => $_POST['Alamat'],
        'Telepon' => $_POST['Telepon'],
        'Lama_sewa' => $lama_sewa,
        'Harga' => $total_harga,
    ]);

    echo "<script> 
          alert('Data Pesanan berhasil ditambahkan!');
          document.location.href = 'navbar.php';
        </script>";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>sewa_ps</title>
    <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<!-- Style -->
<style> 
    <style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .container2 {
        margin-top: 20px;
    }

    table {
        width: 100%;
    }

    td {
        padding: 8px;
    }

    .btn {
        margin-right: 10px;
    }

    /* Add additional styling as needed */
</style>
<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .container {
        margin-top: 20px;
    }

    .col {
        text-align: center;
    }

    h3 {
        margin-bottom: 20px;
    }

    h5 {
        margin-bottom: 40px;
    }

    .form-group {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .btn {
        margin-right: 10px;
    }

    /* Add additional styling as needed */
</style>

</style>
<body>
    <div class="container col-md-8">
        <div class="row justify-content-center">
            <div class="col">
                <h3 class="text-center mb-4">Create Data</h3>
                <form method="POST">
                    <table class="table table-hover">
                        <div class="container2">
                            <!-- Add a new input field for product ID -->
                            <tr>
                                <td for="Id_produk">ID Produk</td>
                                <td><input type="text" class="form-control" name="Id_produk" required="required"></td>
                            </tr>
                            <tr>
                                <td for="Nama">Nama</td>
                                <td><input type="text" class="form-control" name="Nama" required="required"></td>
                            </tr>
                            <tr>
                                <td for="Alamat">Alamat</td>
                                <td><input type="text" class="form-control" name="Alamat" required="required"></td>
                            </tr>
                            <tr>
                                <td for="Telepon">Telepon</td>
                                <td><input type="text" class="form-control" name="Telepon" required="required"></td>
                            </tr>
                            <tr>
                                <td for="Lama_sewa">Lama_sewa</td>
                                <td><input type="text" class="form-control" name="Lama_sewa" required="required"></td>
                            </tr>
                            <tr>
                                <td for="Harga">Harga</td>
                                <td><input type="text" class="form-control" name="Harga" value="<?php echo isset($total_harga) ? number_format($total_harga, 0, ',', '.') : ''; ?>" readonly></td>
                            </tr>
                        </div>
                    </table> 
                    <div align="left">
                        <button type="submit" name="submit" class="btn btn-primary bi bi-check-circle" style="font-family: Tekton Pro"> Submit </button>
                        <a href="navbar.php" class="btn btn-danger bi bi-arrow-right-circle" style="font-family: Tekton Pro"> Cancel </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

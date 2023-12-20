<?php
session_start();

// Include the MongoDB PHP library
require 'vendor/autoload.php';

// Create a MongoDB client
$client = new MongoDB\Client("mongodb://localhost:27017");

// Select the database and collection
$database = $client->selectDatabase('rental_ps'); // Replace 'your_database_name' with your actual database name
$collection = $database->selectCollection('sewa'); // Replace 'your_collection_name' with your actual collection name
?>

<!DOCTYPE html>
<html>
<head>
    <title>rental_ps</title>
    <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<!-- Style -->
<style> 
    .bl{
        padding: 10px;
    }
    .container{
        width: 90%;
        margin-top: 2%;
        box-shadow: 0 3px 10px rgba(0,0,0,0.7);
        padding: 5%;

        text-align:center;
    }
    table {
        width: 100%;
        height: 200%;
    }
    tr, th{
        border: 1px solid #ddd;
        padding: 8px; 
        text-align: left;
        text-align:center;
    } 
    h3 {
        font-family: Cheeky Rabbit;
        font-weight: bold;
        font-size: 40px;
        text-align:center;
    }
</style>
<body>
    <div class="container col-md-8">
    <div class="row justify-content-center">
        <div class="col">
            <img class="text-center" src="d76b2675-79b5-471b-95d3-789defdba32f.ti.jpg" width="200" height="100%" class="mb-5">
            <h3 class="text-center">Data penyewaan</h3>
            <br/>

            <div class="table-responsive" >
                <table border="2" style="border: 2px solid #000; padding: 10px;">
                    <thead>
                        <tr class="text-center" style="background-color: #97B4D6">
                            <th>ID Produk</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Lama_sewa</th>
                            <th>Harga</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <?php
                    require 'config.php';
                    $harga_per_jam = 4000;

                    $sewa = $collection->find();
                   foreach ($sewa as $sw) {
                        // Make sure $sw->Lama_sewa is a numeric value
                        $lama_sewa = is_numeric($sw->Lama_sewa) ? $sw->Lama_sewa : 0;

                        // Hitung total harga
                        $total_harga = $lama_sewa * $harga_per_jam;

                        echo "<tr class='text-center' style='background-color: #D7D4CD'>";
                        echo "<td>".$sw->Id_produk."</td>";
                        echo "<th>".$sw->Nama."</th>";
                        echo "<td>".$sw->Alamat."</td>";
                        echo "<td>".$sw->Telepon."</td>";
                        echo "<td>".$lama_sewa."</td>";
                        echo "<td>Rp ".number_format($total_harga, 0, ',', '.')."</td>";
                        echo "<td>";
                        echo "<a href ='edit.php?id=".$sw->_id."'class='btn btn-warning bi bi-pen' onclick = 'return confirm('Yakin Data Akan Diedit ?');''> Edit </a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href ='delete.php?id=".$sw->_id."'class='btn btn-danger bi bi-eraser' onclick = 'return confirm('Yakin Data Akan Dihapus ?');''> Hapus </a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href ='print.php?id=".$sw->_id."'class='btn btn-success bi bi-printer' target='_blank'> Print </a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <a href="create.php" class="btn btn-primary bi bi-patch-plus" style="font-family: Tekton Pro"> tambah database  </a>
                <a href="navbar.php" class="btn btn-primary bi bi-door-closed" style="font-family: Tekton Pro"> kembali </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

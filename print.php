<?php
require 'config.php';

if (isset($_GET['id'])) {
    $sw = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
}

// Ensure the data is available
if (!$sw) {
    echo 'Data not found.';
    exit;
}

$harga_per_jam = 4000; // Define $harga_per_jam here or retrieve it from a configuration
$lama_sewa = is_numeric($sw->Lama_sewa) ? $sw->Lama_sewa : 0;
$total_harga = $lama_sewa * $harga_per_jam;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Penyewaan</h2>
        <table>
            <tr>
                <th>Nama</th>
                <td><?php echo $sw->Nama; ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?php echo $sw->Alamat; ?></td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td><?php echo $sw->Telepon; ?></td>
            </tr>
            <tr>
                <th>Lama Sewa</th>
                <td><?php echo $lama_sewa; ?></td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></td>
            </tr>
        </table>
    </div>
    <script>
        // Automatically trigger the print dialog when the page loads
        window.onload = function () {
            window.print();
        };
    </script>
    <div align="center">
        <a href="index.php" class="btn btn-primary" style="font-family: Tekton Pro"><i class="bi bi-arrow-left-circle"></i> >--Kembali--< </a>
    </div>
</body>
</html>

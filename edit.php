<?php
session_start();
require 'config.php';

if (isset($_GET['id'])) {
    $sw = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
}

// Menentukan harga per jam
$harga_per_jam = 4000;

// Menghitung total harga berdasarkan lama sewa
$total_harga = $harga_per_jam * $sw->Lama_sewa;

if (isset($_POST['submit'])) {
    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
        [
            '$set' => [
                'Nama' => $_POST['Nama'],
                'Alamat' => $_POST['Alamat'],
                'Telepon' => $_POST['Telepon'],
                'Lama_sewa' => $_POST['Lama_sewa'],
                'Harga' => $total_harga, // Simpan total harga ke database
            ]
        ]
    );

    echo  "<script> 
            alert('Data Pesanan berhasil diupdate!');
            document.location.href = 'index.php';
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
   .bl{
    padding: 10px;
  }
  .container{
    width: 95%;
    margin-top: 2%;
    box-shadow: 0 3px 10px rgba(0,0,0,0.7);
    padding: 5%;
    $gradient: linear-gradient(150deg, rgba($white, .12), rgba($white, 0));
  }
  h3 {
    font-family: Cheeky Rabbit;
    font-weight: bold;
    font-size: 40px;
  }
  table{
    background-color: #97B4D6;
    font-family: Tekton Pro;
    text-align:center;
  }
  input{
    width:500px;
    font-size: 30px;
    text-align:center;
  }
</style>
<body>
  <div class="container">
  <div class="row justify-content-center">
    <div class="col">
      <h3 class="text-center">Edit Data</h3>
      <form method="POST">
        <table class="table table-hover">
          <div class="container2">
            <tr>
              <td for="Nama">Nama</td>
              <td><input type="text" class="form-control" name="Nama" value="<?php echo "$sw->Nama"; ?>"></td>
            </tr>
             
            <tr>
              <td>Alamat</td>
              <td><input type="text" class="form-control" name="Alamat" value="<?php echo "$sw->Alamat"; ?>"></td>
            </tr>
             
             <tr>
              <td>Telepon</td>
              <td><input type="text" class="form-control" name="Telepon" value="<?php echo "$sw->Telepon"; ?>"></td>
            </tr>
             
            <tr>
              <td>Lama_sewa</td>
              <td><input type="text" class="form-control" name="Lama_sewa" value="<?php echo "$sw->Lama_sewa"; ?>"></td>
            </tr>
            <tr>
              <td>Harga</td>
              <td><input type="text" class="form-control" name="Harga" value="<?php echo number_format($total_harga, 0, ',', '.'); ?>" readonly></td>
            </tr>
          </div>
        </table> 
        <div align="left">
            <button type="submit" name="submit" class="btn btn-primary bi bi-check-circle"> Submit </button>
            <a href="index.php" class="btn btn-danger bi bi-arrow-right-circle"> Cancel </a>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>

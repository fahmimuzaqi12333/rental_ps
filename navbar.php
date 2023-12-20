<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('playstation-black-logo-video-games-wallpaper-preview.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            background-color: #111;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            position: relative;
        }

        .sidebar h2 img {
            position: absolute;
            left: -30px; /* Adjust the position as needed */
            top: 50%;
            transform: translateY(-50%);
            width: 24px; /* Adjust the width as needed */
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            padding: 8px;
            text-align: left;
            width: 90%;
            border-bottom: 1px solid #333; /* Add a border to create a separator */
        }

        .sidebar a {
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            padding: 10px;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

       .content {
            text-align: center;
            padding: 20%;
            color: white;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2> Dashboard</h2>
    <ul>
        <li><a href="create.php"><i class="fas fa-plus"></i> tambah sewa</a></li>
        <li><a href="index.php"><i class="fas fa-list"></i> Data Penyewa</a></li>
        <li><a href="produk.php"><i class="fas fa-list"></i> Data PS</a></li>
        <li><a href="informasi.php"><i class="fas fa-list"></i> Data Sewa</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
    </ul>
</div>

<div class="content">
    <h2>Hai....<br>
         <span class="efek-ngetik"></span></h2>
</div>
 <script src="js/script.js"></script>

</body>
</html>

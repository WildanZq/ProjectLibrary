<!DOCTYPE html>
<html>
    <head>
        <title>Perpustakaan SMK Telkom Malang</title>
        <link rel="icon" type="image/png" href="../assets/images/logo.png"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/font-awesome.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/table.css">
        <link rel="stylesheet" href="../assets/css/admin_style.css">
    </head>
    <body>
        <div class="popup set-popup">
            <div class="dark" onclick="closeSet()"></div>
            <div class="set-form">
                <form action="">
                    <h1><i class="fa fa-wrench" aria-hidden="true"></i> Harga Poin</h1>
                    <div class="i-wrapper"><label>Print:</label><input type="number" placeholder="Print" min="1"></div>
                    <input type="submit">
                </form>
            </div>
        </div>
        <div class="container">
            <div class="nav">
                <img src="../assets/images/logo.png" onclick="location.href='../';">
                <a href="peminjaman">Peminjaman</a>
                <a href="point">Points Exchange</a>
                <a href="buku">Buku</a>
                <a href="event">Event</a>
                <a href="organisasi">Organisasi</a>
                <a class="active">Laporan</a>
                <div class="logout">
                    <h1><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</h1>
                </div>
            </div>
            <div class="wrapper">
                
            </div>
        </div>
        <script src="../assets/script/jquery.min.js"></script>
        <script src="../assets/script/loading.js"></script>
        <script src="../assets/script/admin_setting.js"></script>
    </body>
</html>

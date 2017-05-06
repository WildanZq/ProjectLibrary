<!DOCTYPE html>
<html>
    <head>
        <title>Perpustakaan SMK Telkom Malang</title>
        <link rel="icon" type="image/png" href="assets/images/logo.png"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/table.css">
        <link rel="stylesheet" href="assets/css/dashboard_style.css">
    </head>
    <body>
        <div class="header">
            <img class="logo" src="assets/images/logo-s.png" onclick="location.href='../';">
            <div class="img-parent" style="background:none;overflow:visible">
                <img src="assets/images/blank.jpg" class="pp">
                <div class="dropdown-wrapper" onmouseleave="closeP()" onmouseover="showP()">
                    <a href="dashboard"><span>Dashboard</span></a>
                    <a href="dashboard/logout"><span>Logout</span></a>
                </div>
                <span onclick="showP()" onmouseleave="closeP()">Wildan Z</span>
            </div>
            <i class="fa fa-bars" aria-hidden="true"></i>
            <div class="popup sidebar-wrapper">
                <div onclick="closeNav()" class="dark dark-nav"></div>
                <div class="sidebar">
                    <i class="fa fa-times close-nav" aria-hidden="true" onclick="closeNav()"></i>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="img-parent pp"><img src="assets/images/blank.jpg" class="img"></div>
            <div class="p-desc">
                <h1>wildan ziaulhaq</h1>
                <span><i class="fa fa-id-card-o" aria-hidden="true"></i> 9174981686</span>
                <span><i class="fa fa-users" aria-hidden="true"></i> Angkatan 24</span>
                <span><i class="fa fa-home" aria-hidden="true"></i> XI RPL 2</span>
                <span><i class="fa fa-envelope-o" aria-hidden="true"></i> wildan2wildan@gmail.com</span>
            </div>
            <div class="poin-wrapper">
                <h1>Point</h1>
                <span><i class="fa fa-star" aria-hidden="true"></i> 35</span>
            </div>
        </div>
        <div class="h-wrapper">
            <table>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Deadline / Denda</th>
                <tr>
                    <td>1</td>
                    <td>Judul buku</td>
                    <td>20-04-2017</td>
                    <td class="red"><i class="fa fa-circle" aria-hidden="true"></i> 5000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Judul buku</td>
                    <td>20-04-2017</td>
                    <td class="green"><i class="fa fa-circle" aria-hidden="true"></i> 2 Hari</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Judul buku</td>
                    <td>20-04-2017</td>
                    <td class="blue"><i class="fa fa-circle" aria-hidden="true"></i> Selesai</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Judul buku</td>
                    <td>20-04-2017</td>
                    <td class="blue"><i class="fa fa-circle" aria-hidden="true"></i> Selesai</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Judul buku</td>
                    <td>20-04-2017</td>
                    <td class="blue"><i class="fa fa-circle" aria-hidden="true"></i> Selesai</td>
                </tr>
            </table>
        </div>
        <script src="assets/script/jquery.min.js"></script>
        <script src="assets/script/img.js"></script>
        <script src="assets/script/navbar.js"></script>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <title>Perpustakaan SMK Telkom Malang</title>
        <link rel="icon" type="image/png" href="../assets/images/logo.png"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/font-awesome.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/table.css">
        <link rel="stylesheet" href="../assets/css/dashboard_style.css">
    </head>
    <body>
        <div class="header">
            <img class="logo" src="../assets/images/logo-s.png" onclick="location.href='../../';">
            <div class="img-parent" style="background:none;overflow:visible">
                <img src="../assets/images/blank.jpg" class="pp">
                <div class="dropdown-wrapper" onmouseleave="closeP()" onmouseover="showP()">
                    <a href="../dashboard"><span>Dashboard</span></a>
                    <a href="./setting"><span>Setting</span></a>
                    <a href="./logout"><span>Logout</span></a>
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
        <form action="">
        <div class="wrapper">
            <div class="img-parent pp"><img src="../assets/images/blank.jpg" class="img"><label for="gbrE" class="label-file"><i class="fa fa-upload" aria-hidden="true"></i> Pilih gambar</label></div>
            <input id="gbrE" type="file" onchange="readURL(this,0)" class="hidden">
            <div class="p-desc desc-form">
                <div class="input-wrapper">
                    <div>
                        <input type="text" placeholder="Nama Lengkap" value="Wildan Ziaulhaq">
                        <input type="text" placeholder="NIS" value="9174981686">
                        <div class="kelas" style="padding:0">
                            <input type="number" placeholder="Angkatan" min="1" value="24">
                            <select>
                                <option value="x rpl ">X RPL</option>
                                <option value="x tkj ">X TKJ</option>
                                <option value="xi rpl " selected>XI RPL</option>
                                <option value="xi tkj ">XI TKJ</option>
                                <option value="xII rpl ">XII RPL</option>
                                <option value="xII tkj ">XII TKJ</option>
                            </select>
                            <input type="number" placeholder="1" min="1" value="2">
                        </div>
                    </div>
                    <div>
                        <input type="email" value="wildan2wildan@gmail.com">
                        <input type="text" placeholder="Username" value="WildanZq">
                        <input type="password" placeholder="Password">
                    </div>
                    <input type="submit">
                </div>
            </div>
        </div>
        </form>
        <script src="../assets/script/jquery.min.js"></script>
        <script src="../assets/script/img.js"></script>
        <script src="../assets/script/img_input.js"></script>
        <script src="../assets/script/navbar.js"></script>
    </body>
</html>

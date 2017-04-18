<!DOCTYPE html>
<html>
    <head>
        <title>Perpustakaan SMK Telkom Malang</title>
        <link rel="icon" type="image/png" href="assets/images/logo.png"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/index_style.css">
    </head>
    <body>
        <div class="header">
            <img class="logo" src="assets/images/logo-s.png">
            <span class="show-login">Login</span>
            <i class="fa fa-bars" aria-hidden="true"></i>
            <div class="popup login-wrapper">
                <div class="dark dark-login closelogin"></div>
                <div class="login">
                    <div class="form-wrapper">
                        <form action="" class="form-login">
                            <h1><i class="fa fa-sign-in" aria-hidden="true"></i> Login</h1>
                            <input type="text" placeholder="Username">
                            <input type="password" placeholder="Password">
                            <input type="submit">
                        </form>
                        <div class="login-tab">
                            <span class="s1">Create Account</span>
                            <span class="s2">Login</span>
                            <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                        </div>
                        <form action="">
                            <h1><i class="fa fa-user-plus" aria-hidden="true"></i> Signup</h1>
                        </form>
                    </div>
                </div>
            </div>
            <div class="popup sidebar-wrapper">
                <div class="dark dark-nav closenav"></div>
                <div class="sidebar">
                    <i class="fa fa-times closenav close-nav" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="top">
            <div class="bg"></div>
            <div class="ts">
                <img src="assets/images/ts.jpg">
                <img src="assets/images/iso9001.png">
            </div>
            <div class="wrapper">
                <img src="assets/images/logo.png">
                <div class="title">
                    <h1>Perpustakaan SMK Telkom Malang</h1>
                    <p>Lorem Ipsum Dolor Sit Amet</p>
                </div>
            </div>
            <a href="#go"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
        </div>
        <div class="wrapper" style="height: 100vh" id="go">
            <div class="search-book">
                <form action="">
                    <select>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="ilmu">Ilmu Komputer, Informasi, &amp; Karya Umum</option>
                        <option value="filsafat">Filsafat &amp; Psikologi</option>
                        <option value="agama">Agama</option>
                        <option value="ips">Ilmu Pengetahuan Sosial</option>
                        <option value="bahasa">Bahasa</option>
                        <option value="sains">Sains</option>
                        <option value="teknologi">Teknologi</option>
                        <option value="kesenian">Kesenian &amp; Rekreasi</option>
                        <option value="sastra">Sastra</option>
                        <option value="sejarah">Sejarah &amp; Geografi</option>
                    </select>
                    <div class="s-wrapper">
                        <input type="text" placeholder="Judul buku"><i class="s-icon fa fa-search" aria-hidden="true"></i>
                    </div>
                </form>
            </div>
            <div class="book-list">

            </div>
        </div>
        <script src="assets/cript/jquery.min.js"></script>
        <script src="assets/cript/header.js"></script>
        <script src="assets/cript/navbar.js"></script>
    </body>
</html>

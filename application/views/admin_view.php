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
                    <h1><i class="fa fa-wrench" aria-hidden="true"></i> Harga Denda</h1>
                    <div class="i-wrapper"><label>Terlambat:</label><input type="number" placeholder="Terlambat" min="1"></div>
                    <div class="i-wrapper"><label>Hilang:</label><input type="number" placeholder="Hilang" min="1"></div>
                    <input type="submit">
                </form>
            </div>
        </div>
        <div class="container">
            <div class="nav">
                <img src="../assets/images/logo.png" onclick="location.href='../';">
                <a class="active">Peminjaman</a>
                <a href="point">Points Exchange</a>
                <a href="buku">Buku</a>
                <a href="event">Event</a>
                <a href="organisasi">Organisasi</a>
                <a href="laporan">Laporan</a>
                <div class="logout">
                    <h1><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</h1>
                </div>
            </div>
            <div class="wrapper">
                <div class="form-wrapper">
                    <div class="set-wrapper"><span><i class="fa fa-cog" aria-hidden="true"></i>Setting</span></div>
                    <form action="">
                        <input type="text" placeholder="Nama">
                        <div class="kelas">
                            <select>
                                <option value="x rpl">X RPL</option>
                                <option value="x tkj">X TKJ</option>
                                <option value="xi rpl">XI RPL</option>
                                <option value="xi tkj">XI TKJ</option>
                                <option value="xii rpl">XII RPL</option>
                                <option value="xii tkj">XII TKJ</option>
                            </select>
                            <input type="number" placeholder="1" min="1">
                        </div>
                        <input type="text" placeholder="Barcode">
                        <input type="submit">
                    </form>
                    <div class="search-book">
                        <form action="">
                            <label>Search By:</label>
                            <select onchange="searchOption()" class="selectS">
                                <option value="Barcode">Barcode</option>
                                <option value="Nama">Nama</option>
                                <option value="Kelas">Kelas</option>
                                <option value="Judul">Judul Buku</option>
                            </select>
                            <div class="s-wrapper">
                                <input class="searchT" type="text" placeholder="Barcode" oninput="loadin()"><i class="s-icon fa fa-search" aria-hidden="true"></i>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="h-wrapper">
                    <div class="load-wrapper"><i class="fa fa-circle-o-notch"></i></div>
                    <table>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Barcode</th>
                            <th>Judul Buku</th>
                            <th>Status</th>
                            <th><i class="fa fa-handshake-o" aria-hidden="true"></i></th>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td>9481/141/134</td>
                            <td>Judul Buku</td>
                            <td class="red"><i class="fa fa-circle" aria-hidden="true"></i> 5000</td>
                            <td><span class="return">Kembali</span><span class="return">Hilang</span></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td>9481/141/134</td>
                            <td>Judul Buku</td>
                            <td class="red"><i class="fa fa-circle" aria-hidden="true"></i> 5000</td>
                            <td><span class="return">Kembali</span><span class="return">Hilang</span></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td>9481/141/134</td>
                            <td>Judul Buku</td>
                            <td class="red"><i class="fa fa-circle" aria-hidden="true"></i> 5000</td>
                            <td><span class="return">Kembali</span><span class="return">Hilang</span></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td>9481/141/134</td>
                            <td>Judul Buku</td>
                            <td class="red"><i class="fa fa-circle" aria-hidden="true"></i> 5000</td>
                            <td><span class="return">Kembali</span><span class="return">Hilang</span></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td>9481/141/134</td>
                            <td>Judul Buku</td>
                            <td class="red"><i class="fa fa-circle" aria-hidden="true"></i> 5000</td>
                            <td><span class="return">Kembali</span><span class="return">Hilang</span></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td>9481/141/134</td>
                            <td>Judul Buku</td>
                            <td class="red"><i class="fa fa-circle" aria-hidden="true"></i> 5000</td>
                            <td><span class="return">Kembali</span><span class="return">Hilang</span></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td>9481/141/134</td>
                            <td>Judul Buku</td>
                            <td class="green"><i class="fa fa-circle" aria-hidden="true"></i> 2 Hari</td>
                            <td><span class="return">Kembali</span><span class="return">Hilang</span></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td>9481/141/134</td>
                            <td>Judul Buku</td>
                            <td class="green"><i class="fa fa-circle" aria-hidden="true"></i> 2 Hari</td>
                            <td><span class="return">Kembali</span><span class="return">Hilang</span></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td>9481/141/134</td>
                            <td>Judul Buku</td>
                            <td class="green"><i class="fa fa-circle" aria-hidden="true"></i> 2 Hari</td>
                            <td><span class="return">Kembali</span><span class="return">Hilang</span></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td>9481/141/134</td>
                            <td>Judul Buku</td>
                            <td class="green"><i class="fa fa-circle" aria-hidden="true"></i> 2 Hari</td>
                            <td><span class="return">Kembali</span><span class="return">Hilang</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <script src="../assets/script/jquery.min.js"></script>
        <script src="../assets/script/loading.js"></script>
        <script src="../assets/script/change_option.js"></script>
        <script src="../assets/script/admin_setting.js"></script>
    </body>
</html>

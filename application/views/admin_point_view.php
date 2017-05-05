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
                <a class="active">Points Exchange</a>
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
                        <div class="kelas">
                            <select>
                                <option value="x rpl ">X RPL</option>
                                <option value="x tkj ">X TKJ</option>
                                <option value="xi rpl ">XI RPL</option>
                                <option value="xi tkj ">XI TKJ</option>
                                <option value="xII rpl ">XII RPL</option>
                                <option value="xII tkj ">XII TKJ</option>
                            </select>
                            <input type="number" placeholder="1" min="1">
                        </div>
                        <input type="text" placeholder="Nama">
                        <select>
                            <option value="print">Print</option>
                        </select>
                        <input type="submit">
                    </form>
                    <div class="search-book">
                        <form action="">
                            <label>Search From:</label>
                            <input type="date" oninput="loadin()" onreset="loadout()">
                            <label>To:</label>
                            <div class="s-wrapper" style="width: auto">
                                <input type="date" oninput="loadin()" onreset="loadout()"><i class="s-icon fa fa-search" aria-hidden="true" style="top: 5px"></i>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="h-wrapper">
                    <div class="load-wrapper"><i class="fa fa-circle-o-notch"></i></div>
                    <table>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Poin</th>
                            <th><i class="fa fa-handshake-o" aria-hidden="true"></i></th>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>Print</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>Print</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>Print</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>Print</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>Print</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>Print</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>Print</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>Print</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>Print</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>Print</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <script src="../assets/script/jquery.min.js"></script>
        <script src="../assets/script/loading.js"></script>
        <script src="../assets/script/admin_setting.js"></script>
    </body>
</html>

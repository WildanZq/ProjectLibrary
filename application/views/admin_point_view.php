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
        <div class="container">
            <div class="nav">
                <img src="../assets/images/logo.png" onclick="location.href='../';">
                <a href="peminjaman">Peminjaman</a>
                <a class="active">Points Exchange</a>
                <a>Buku</a>
                <a>Organisasi</a>
                <a>Event</a>
                <a>Statistik</a>
                <div class="logout">
                    <h1><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</h1>
                </div>
            </div>
            <div class="wrapper">
                <div class="form-wrapper">
                    <form action="">
                        <input type="text" placeholder="Nama">
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
                        <select>
                            <option value="print">Print</option>
                        </select>
                        <input type="submit">
                    </form>
                    <div class="search-book">
                        <form action="">
                            <label>Search From:</label>
                            <input type="date">
                            <label>To:</label>
                            <div class="s-wrapper" style="width: auto">
                                <input type="date"><i class="s-icon fa fa-search" aria-hidden="true" style="top: 5px"></i>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="h-wrapper">
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
    </body>
</html>

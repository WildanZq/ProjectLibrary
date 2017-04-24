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
                <a href="point">Points Exchange</a>
                <a href="buku">Buku</a>
                <a class="active" href="event">Event</a>
                <a href="organisasi">Organisasi</a>
                <a href="laporan">Laporan</a>
                <div class="logout">
                    <h1><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</h1>
                </div>
            </div>
            <div class="wrapper">
                <div class="form-wrapper">
                    <form action="" style="flex-direction:column" enctype="multipart/form-data">
                        <div class="img-wrapper">
                            <img class="img" src="../assets/images/blank.png" style="height:auto;width:100%">
                            <label for="gbrE" class="label-file"><i class="fa fa-upload" aria-hidden="true"></i> Pilih gambar</label>
                        </div>
                        <div>
                            <input id="gbrE" type="file" onchange="readURL(this,0)" class="hidden">
                            <input type="text" placeholder="Judul">
                            <label>Mulai Dari:</label>
                            <input type="date">
                            <label>Sampai:</label>
                            <input type="date">
                        </div>
                        <textarea name="konten" class="ckeditor" required></textarea>
                        <div>
                            <label>Pemenang:</label>
                            <select>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <input type="number" placeholder="Reward (Points)" style="width:140px" min="0">
                            <input type="submit">
                        </div>
                    </form>
                    <div class="search-book">
                        <form action="">
                            <label>Search:</label>
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
                            <th>Dari</th>
                            <th>Sampai</th>
                            <th>Judul</th>
                            <th>Reward</th>
                            <th>Edit</th>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>20/03/2017</td>
                            <td>Judul Event</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> 1000</td>
                            <td><i class="fa fa-pencil-square return" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>20/03/2017</td>
                            <td>Judul Event</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> 1000</td>
                            <td><i class="fa fa-pencil-square return" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>20/03/2017</td>
                            <td>Judul Event</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> 1000</td>
                            <td><i class="fa fa-pencil-square return" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>20/03/2017</td>
                            <td>Judul Event</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> 1000</td>
                            <td><i class="fa fa-pencil-square return" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>20/03/2017</td>
                            <td>Judul Event</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> 1000</td>
                            <td><i class="fa fa-pencil-square return" aria-hidden="true"></i></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <script src="../assets/script/jquery.min.js"></script>
        <script src="../assets/ckeditor/ckeditor.js"></script>
        <script src="../assets/script/loading.js"></script>
        <script src="../assets/script/img_input.js"></script>
    </body>
</html>

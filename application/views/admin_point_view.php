<!DOCTYPE html>
<html>
    <head>
        <title>Perpustakaan SMK Telkom Malang</title>
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/logo.png"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/table.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin_style.css">
    </head>
    <body>
        <div class="popup set-popup">
            <div class="dark" onclick="closeSet()"></div>
            <div class="set-form">
                <form action="<?php echo base_url('Admin/changeSetting'); ?>" method="post">
                    <h1><i class="fa fa-wrench" aria-hidden="true"></i> Harga Poin</h1>
                    <input type="hidden" name="from" value="<?php echo base_url('Admin/point'); ?>">
                    <div class="i-wrapper"><label>Print:</label>
                        <input type="number" placeholder="Print" min="1" name="print">
                    </div>
                    <div class="i-wrapper"><label>Reward:</label>
                        <input type="number" placeholder="Reward" min="1" name="reward">
                    </div>
                    <input type="submit" name="saveSetting">
                </form>
            </div>
        </div>
        <div class="container">
            <div class="nav">
                <img src="<?php echo base_url(); ?>assets/images/logo.png" onclick="location.href='<?php echo base_url(); ?>';">
                <a href="<?php echo base_url(); ?>admin/peminjaman">Peminjaman</a>
                <a class="active">Points Exchange</a>
                <a href="<?php echo base_url(); ?>admin/buku">Buku</a>
                <a href="<?php echo base_url(); ?>admin/event">Event</a>
                <a href="<?php echo base_url(); ?>admin/siswa">Siswa</a>
                <a href="<?php echo base_url(); ?>admin/organisasi">Organisasi</a>
                <a href="<?php echo base_url(); ?>admin/laporan">Laporan</a>
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
                        <label>Print:</label>
                        <input type="number" name="lembar" placeholder="1" min="1">
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
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>Nama Lengkap</td>
                            <td>XI RPL 2</td>
                            <td class="gold"><i class="fa fa-star" aria-hidden="true"></i> -10</td>
                            <td>1</td>
                        </tr>
                    </table>
                </div>
                <div class="pagination-wrapper">
                  <div class="pagination">
                    <div class="main">
                      <div class="page"><i class="fa fa-angle-double-left" aria-hidden="true"></i></div>
                      <div class="page active">1</div>
                      <div class="page">2</div>
                      <div class="page">3</div>
                      <div class="page">...</div>
                      <div class="page">27</div>
                      <div class="page"><i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/script/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/loading.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/admin_setting.js"></script>
    </body>
</html>

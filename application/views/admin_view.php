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
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css">
    </head>
    <body>
        <div class="popup set-popup">
            <div class="dark" onclick="closeSet()"></div>
            <div class="set-form">
                <form action="<?php echo base_url('Admin/changeSetting'); ?>" method="post">
                    <h1><i class="fa fa-wrench" aria-hidden="true"></i> Harga Denda</h1>
                    <input type="hidden" name="from" value="<?php echo base_url('Admin/peminjaman'); ?>">
                    <div class="i-wrapper"><label>Terlambat:</label>
                        <input type="number" placeholder="Terlambat" min="1" id="terlambat" name="terlambat">
                    </div>
                    <div class="i-wrapper"><label>Hilang:</label>
                        <input type="number" placeholder="Hilang" min="1" id="hilang" name="hilang">
                    </div>
                    <input type="submit" name="saveSetting">
                </form>
            </div>
        </div>
        <div class="container">
            <div class="nav">
                <img src="<?php echo base_url(); ?>assets/images/logo.png" onclick="location.href='<?php echo base_url(); ?>';">
                <a class="active">Peminjaman</a>
                <a href="<?php echo base_url(); ?>admin/point">Points Exchange</a>
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
                    <form action="<?php echo base_url('Admin/addPeminjaman'); ?>" method="post">
                        <div class="kelas">
                            <select id="kelas" name="kelas">
                                <option value="x rpl">X RPL</option>
                                <option value="x tkj">X TKJ</option>
                                <option value="xi rpl">XI RPL</option>
                                <option value="xi tkj">XI TKJ</option>
                                <option value="xii rpl">XII RPL</option>
                                <option value="xii tkj">XII TKJ</option>
                            </select>
                            <input type="number" placeholder="1" min="1" id="nkelas" name="nkelas" required>
                        </div>
                        <input type="text" placeholder="Nama" id="nama" name="nama" required>
                        <input type="text" placeholder="Barcode" id="barcode" name="barcode" required>
                        <input type="submit" name="submit">
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
                                <input class="searchT" type="text" placeholder="Barcode" oninput="loadin()">
                                <i class="s-icon fa fa-search" aria-hidden="true" onclick="cariPinjam()"></i>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="h-wrapper">
                    <div class="load-wrapper"><i class="fa fa-circle-o-notch"></i></div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Barcode</th>
                                <th>Judul Buku</th>
                                <th>Status</th>
                                <th><i class="fa fa-handshake-o" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody id="list"></tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                  <div class="pagination">
                    <div class="main">
                      <div class="page" id="btn_prev"><i class="fa fa-angle-double-left" aria-hidden="true"></i></div>
                      <!-- <div class="page active">1</div>
                      <div class="page">2</div>
                      <div class="page">3</div>
                      <div class="page">...</div>
                      <div class="page">27</div> -->
                      <div class="page" id="btn_next"><i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/script/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/loading.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/change_option.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/admin_setting.js"></script>
        <!-- ATTENTION >> delete = error  -->
        <script type="text/javascript">
            function getDendaTerlambat () {
                return <?php echo $denda->terlambat; ?>;
            }
            function getDendaHilang () {
                return <?php echo $denda->hilang; ?>;
            }
        </script>
        <!-- / ATTENTION -->
        <script src="<?php echo base_url(); ?>assets/script/peminjaman.js" charset="utf-8"></script>
    </body>
</html>

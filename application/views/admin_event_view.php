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
        <div class="container">
            <div class="nav">
                <img src="<?php echo base_url(); ?>assets/images/logo.png" onclick="location.href='<?php echo base_url(); ?>';">
                <a href="<?php echo base_url(); ?>admin/peminjaman">Peminjaman</a>
                <a href="<?php echo base_url(); ?>admin/point">Points Exchange</a>
                <a href="<?php echo base_url(); ?>admin/buku">Buku</a>
                <a class="active">Event</a>
                <a href="<?php echo base_url(); ?>admin/siswa">Siswa</a>
                <a href="<?php echo base_url(); ?>admin/organisasi">Organisasi</a>
                <a href="<?php echo base_url(); ?>admin/laporan">Laporan</a>
                <div class="logout">
                    <h1><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</h1>
                </div>
            </div>
            <div class="wrapper">
                <div class="form-wrapper">
                    <input type="button" value="Show Form" onclick="showForm()" id="bForm">
                    <form action="" style="flex-direction:column;display:none" enctype="multipart/form-data" id="form">
                        <div class="img-wrapper">
                            <img class="img" src="<?php echo base_url(); ?>assets/images/blank.png" style="height:auto;width:100%">
                            <label for="gbrE" class="label-file"><i class="fa fa-upload" aria-hidden="true"></i> Pilih gambar</label>
                        </div>
                        <div style="min-width:200px;width: 95%">
                            <input type="text" placeholder="Judul" style="width: calc(100% - 40px);text-align:center;">
                        </div>
                        <div>
                            <input id="gbrE" type="file" onchange="readURL(this,0)" class="hidden">
                            <label>Mulai Dari:</label>
                            <input type="date">
                            <label>Sampai:</label>
                            <input type="date">
                        </div>
                        <textarea name="konten" class="ckeditor" required></textarea>
                        <div>
                            <input type="submit">
                        </div>
                    </form>
                </div>
                <div class="form-wrapper">
                    <div class="search-book">
                        <form action="">
                            <label>Search:</label>
                            <div>
                                <input type="date" oninput="loadin()" onreset="loadout()">
                            </div>
                            <div class="s-wrapper">
                                <input class="searchT" type="text" placeholder="Judul" oninput="loadin()">
                                <i class="s-icon fa fa-search" aria-hidden="true"></i>
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
                            <th>Views</th>
                            <th><i class="fa fa-pencil-square-o" aria-hidden="true"></i></th>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>20/03/2017</td>
                            <td>Judul Event</td>
                            <td class="gold">1000</td>
                            <td><span class="return" onclick="location.href='./edit_event';">Edit</span><span class="return">Hapus</span></td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>20/03/2017</td>
                            <td>Judul Event</td>
                            <td class="gold">1000</td>
                            <td><span class="return" onclick="location.href='./edit_event';">Edit</span><span class="return">Hapus</span></td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>20/03/2017</td>
                            <td>Judul Event</td>
                            <td class="gold">1000</td>
                            <td><span class="return" onclick="location.href='./edit_event';">Edit</span><span class="return">Hapus</span></td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>20/03/2017</td>
                            <td>Judul Event</td>
                            <td class="gold">1000</td>
                            <td><span class="return" onclick="location.href='./edit_event';">Edit</span><span class="return">Hapus</span></td>
                        </tr>
                        <tr>
                            <td>20/03/2017</td>
                            <td>20/03/2017</td>
                            <td>Judul Event</td>
                            <td class="gold">1000</td>
                            <td><span class="return" onclick="location.href='./edit_event';">Edit</span><span class="return">Hapus</span></td>
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
        <script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/loading.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/img_input.js"></script>
        <script>
        var formC = 0;
        function showForm() {
          if (formC == 0) {
            $('#bForm').val("Close Form");
            $('#form').css('display','flex');
            formC = 1;
          } else {
            $('#bForm').val("Show Form");
            $('#form').css('display','none');
            formC = 0;
          }
        }
        </script>
    </body>
</html>

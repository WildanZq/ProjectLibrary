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
                <a class="active">Buku</a>
                <a href="<?php echo base_url(); ?>admin/event">Event</a>
                <a href="<?php echo base_url(); ?>admin/siswa">Siswa</a>
                <a href="<?php echo base_url(); ?>admin/organisasi">Organisasi</a>
                <a href="<?php echo base_url(); ?>admin/laporan">Laporan</a>
                <div class="logout">
                    <h1><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</h1>
                </div>
            </div>
            <div class="nav-admin">
                <span class="nav-item-admin" onclick="changePage(0)">List</span>
                <span class="nav-item-admin" onclick="addBuku()">Tambah Buku</span>
                <span class="nav-item-admin" onclick="changePage(2)">Cetak Barcode</span>
            </div>
            <div class="wrapper" id="list">
                <div class="notif notif-danger">Tambah Buku Gagal</div>
                <div class="notif notif-success">Tambah Buku Berhasil</div>
                <div class="form-wrapper">
                    <form action="">
                        <label>Search:</label>
                        <div class="s-wrapper">
                            <input class="searchT" type="text" oninput="loadin()">
                            <i class="s-icon fa fa-search" aria-hidden="true"></i>
                        </div>
                    </form>
                </div>
                <div class="h-wrapper">
                    <div class="load-wrapper"><i class="fa fa-circle-o-notch"></i></div>
                    <table>
                        <tr>
                            <th>Register</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th><i class="fa fa-handshake-o" aria-hidden="true"></i></th>
                        </tr>
                        <tr>
                            <td>153.4 BUZ B</td>
                            <td>Buku Pintar Mindmap</td>
                            <td>Tony Buzan</td>
                            <td>PT Gramedia Pustaka Utama</td>
                            <td>2015</td>
                            <td><span class="return" onclick="editBuku()">Edit</span><span class="return">Hapus</span></td>
                        </tr>
                        <tr>
                            <td>153.4 BUZ B</td>
                            <td>Buku Pintar Mindmap</td>
                            <td>Tony Buzan</td>
                            <td>PT Gramedia Pustaka Utama</td>
                            <td>2015</td>
                            <td><span class="return" onclick="editBuku()">Edit</span><span class="return">Hapus</span></td>
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
            <div class="popup set-popup edit-popup">
                <div class="dark" onclick="closeBuku()"></div>
                <div class="set-form edit-form">
                    <!-- INFO: Ganti action #form-buku lewat function getAction() pada <script> di bawah -->
                    <form method="post" id="form-buku">
                        <h1 id="h1-form-buku">Edit Buku</h1>
                        <div class="form">
                          <div>
                            <div class="i-wrapper"><label>Register:</label>
                                <input type="text" placeholder="Register" id="register" name="register" required>
                            </div>
                            <div class="i-wrapper"><label>Judul:</label>
                                <input type="text" placeholder="Judul" id="judul" name="judul" required>
                            </div>
                            <div class="i-wrapper"><label>Pengarang:</label>
                                <input type="text" placeholder="Pengarang" id="pengarang" name="pengarang" required>
                            </div>
                            <div class="i-wrapper"><label>Penerbit:</label>
                                <input type="text" placeholder="Penerbit" id="penerbit" name="penerbit" required>
                            </div>
                            <div class="i-wrapper"><label>Tahun Terbit:</label>
                                <input type="number" placeholder="Tahun" id="tahun" name="tahun" min="1" required>
                            </div>
                            <div class="i-wrapper"><label>Available:</label>
                                <input type="number" placeholder="Available" id="jumlah" name="jumlah" min="1" required>
                            </div>
                          </div>
                          <div class="scroll-down" style="max-height:280px;">
                            <div class="i-wrapper">
                              <input type="text" placeholder="Barcode 1" id="barcode1" name="barcode1" value="b1" required><span class="plus min" onclick="delBarcode(1)" id="minB1"><i class="fa fa-trash" aria-hidden="true"></i></span>
                            </div>
                            <div id="barcode">
                              <div class="i-wrapper"><input type="text" placeholder="Barcode 2" id="barcode2" name="barcode2" value="b2" required><span class="plus min" onclick="delBarcode(2)"><i class="fa fa-trash" aria-hidden="true"></i></span></div>
                              <div class="i-wrapper"><input type="text" placeholder="Barcode 3" id="barcode3" name="barcode3" value="b3" required><span class="plus min" onclick="delBarcode(3)"><i class="fa fa-trash" aria-hidden="true"></i></span></div>
                            </div>
                            <div class="i-wrapper" style="margin-top:5px;">
                              <span class="plus" onclick="addBarcode()">+</span>
                            </div>
                          </div>
                        </div>
                        <div class="button-wrapper">
                          <input class="cancel" type="button" value="Cancel" onclick="closeBuku()">
                          <input class="save" type="submit" value="Save" name="saveBuku">
                        </div>
                    </form>
                </div>
            </div>
            <div class="wrapper" style="display:none" id="tambah">
              Tambah
            </div>
            <div class="wrapper" style="display:none" id="cetak">
              Barcode
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/script/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/loading.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/admin_table.js"></script>
        <script>
        function addBuku() {
          editBuku(true);
        }
        bVal = [];bCounter = 1;barcode = "";
        function updateBVal() {
          bVal = [];
          for (var i = 1; i <= bCounter; i++) {
            bVal.push($('#barcode'+i).val());
          }
        }
        function addBarcode() {
          updateBVal();bVal.push("");bCounter++;refreshBarcode();
          if (bCounter > 1) {$('#minB1').css('display','flex');}
        }
        function delBarcode(n) {
          if (bVal.length == 1) {return;}
          updateBVal();bVal.splice(n-1,1);bCounter--;refreshBarcode();
          if (bCounter == 1) {$('#minB1').css('display','none');}
        }
        function refreshBarcode() {
          $('#barcode1').val(bVal[0]);barcode = "";
          for (var i = 2; i <= bVal.length; i++) {
            barcode += '<div class="i-wrapper"><input type="text" placeholder="Barcode '+i+'" id="barcode'+i+'" name="barcode'+i+'" value="'+bVal[i-1]+'" required><span class="plus min" onclick="delBarcode('+i+')"><i class="fa fa-trash" aria-hidden="true"></i></span></div>';
          }
          $('#barcode').html(barcode);
        }
        function editBuku(baru) {
          $(".edit-popup").css({"display":"flex"});
          $(".dark").css({"animation":"fadein .5s","opacity":"1"});
          $(".set-form").css({"animation":"scalein .5s ease"});
          $(document).keyup(function(e) {if (e.keyCode == 27) {closeBuku();}});

          if (baru == true) {
            /* INFO >> Ganti action #form-buku untuk tambah buku */
            $('#form-buku').submit(function() {
              getAction(this,true);
            });
            /* / INFO */
            document.getElementById('form-buku').reset();
            bCounter = 1; $('#barcode1').val("");
            updateBVal();
            refreshBarcode();
            if (bCounter == 1) {$('#minB1').css('display','none');}
            $('#h1-form-buku').html('Tambah Buku');
            return;
          }

          /* INFO >> Ganti action #form-buku untuk edit buku */
          $('#form-buku').submit(function() {
            getAction(this,false);
          });
          /* / INFO */
          setTimeout(function() {
            bCounter = $('#barcode .i-wrapper').length + 1;
            updateBVal();
            refreshBarcode();
            if (bCounter == 1) {$('#minB1').css('display','none');}
          },200);
          $('#h1-form-buku').html('Edit Buku');
        };
        function getAction(form,baru) {
          if (baru == true) {
            form.action = "addBuku";
          } else {
            form.action = "edit.php";
          }
        }
        function closeBuku() {
          $(".dark").css({"animation":"fadeout .5s","opacity":"0"});
          $(".set-form").css({"animation":"scaleout .5s ease"});
          setTimeout(function() {
            $(".set-popup").css({"display":"none"});
          },480);
        }
        function changePage(n) {
          var all = $('.wrapper');
          if (n==0) {
            all.css('display','none');
            $('#list').css('display','flex');
          } else if (n==1) {
            all.css('display','none');
            $('#tambah').css('display','flex');
          } else if (n==2) {
            all.css('display','none');
            $('#cetak').css('display','flex');
          }
        }
        </script>
    </body>
</html>

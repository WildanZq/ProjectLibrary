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
                <a href="<?php echo base_url(); ?>admin/event">Event</a>
                <a class="active">Siswa</a>
                <a href="<?php echo base_url(); ?>admin/organisasi">Organisasi</a>
                <a href="<?php echo base_url(); ?>admin/laporan">Laporan</a>
                <div class="logout">
                    <h1><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</h1>
                </div>
            </div>
            <div class="nav-admin">
              <span class="nav-item-admin" onclick="addSiswa()">Tambah Siswa</span>
            </div>
            <div class="wrapper" id="list">
                <div class="form-wrapper">
                    <form action="">
                        <div class="s-wrapper">
                            <input class="searchT" type="text" oninput="loadin()" placeholder="Search">
                            <i class="s-icon fa fa-search" aria-hidden="true"></i>
                        </div>
                    </form>
                </div>
                <div class="h-wrapper">
                    <div class="load-wrapper"><i class="fa fa-circle-o-notch"></i></div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Angkatan</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Poin</th>
                                <th><i class="fa fa-handshake-o" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($siswa as $siswa): ?>
                            <tr>
                                <td><?php echo $siswa->nama_lengkap; ?></td>
                                <td><?php echo $siswa->angkatan; ?></td>
                                <td><?php echo $siswa->jurusan; ?></td>
                                <td><?php echo $siswa->nomor_kelas; ?></td>
                                <td><?php echo $siswa->poin; ?></td>
                                <td>
                                    <span class="return" onclick="editSiswa()">Edit</span>
                                    <span class="return">Hapus</span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
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
                <div class="dark" onclick="closeSiswa()"></div>
                <div class="set-form edit-form">
                    <!-- INFO: Ganti action #form-siswa lewat function getAction() pada <script> di bawah -->
                    <form method="post" id="form-siswa">
                        <h1 id="h1-form-siswa">Edit Siswa</h1>
                        <div class="form">
                          <div>
                            <div class="i-wrapper"><label>Nama Lengkap:</label>
                                <input type="text" placeholder="Nama Lengkap" id="nama" name="nama" required>
                            </div>
                            <div class="i-wrapper"><label>Kelas:</label>
                              <div class="kelas">
                                <input type="number" placeholder="Angkatan" min="1" required>
                                <select required>
                                  <option value="RPL">RPL</option>
                                  <option value="TKJ">TKJ</option>
                                </select>
                                <input type="number" placeholder="1" min="1" required>
                              </div>
                            </div>
                            <hr class="siswa-lama">
                            <div class="i-wrapper siswa-lama-flex"><label>Username:</label>
                                <input type="text" placeholder="Username" id="username" name="username" required>
                            </div>
                            <div class="i-wrapper"><label>Poin:</label>
                                <input type="number" placeholder="Poin" id="poin" name="poin" required min="0">
                            </div>
                            <div class="i-wrapper"><label>Role:</label>
                              <select>
                                <option value="anggota">anggota</option>
                                <option value="pengurus">pengurus</option>
                              </select>
                            </div>
                          </div>
                          <div style="margin-left:20px;flex-shrink:10;" class="siswa-lama">
                            <div class="img-wrapper img-parent" style="width:200px;height:200px;margin:auto" onclick="hapusGambar()">
                              <img class="img" id="gbrP" src="<?php echo base_url(); ?>assets/images/logo.png">
                              <label class="label-file"><i class="fa fa-trash" aria-hidden="true"></i> Hapus gambar</label>
                              <!-- Input #foto di set value ne yo! Sesuai db -->
                              <input type="text" id="foto" name="foto" class="hidden">
                            </div>
                            <input type="button" name="passReset" value="Reset Password" style="padding:10px 0;width:100%;margin-top:10px;" onclick="closeSiswa()">
                          </div>
                        </div>
                        <div class="button-wrapper">
                          <input class="cancel" type="button" value="Cancel" onclick="closeSiswa()">
                          <input class="save" type="submit" value="Save" name="saveSiswa">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/script/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/loading.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/admin_table.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/img_input.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/img.js"></script>
        <script>
        function hapusGambar() {
          $('#foto').val("");
          $('#gbrP').attr('src', '<?php echo base_url(); ?>assets/images/blank.jpg');
        }
        function addSiswa() {
          editSiswa(true);
        }
        function editSiswa(baru) {
          setTimeout(function() {
            resizeImg();
          },400);
          resizeImg();
          $(".edit-popup").css({"display":"flex"});
          $(".dark").css({"animation":"fadein .5s","opacity":"1"});
          $(".set-form").css({"animation":"scalein .5s ease"});
          $(document).keyup(function(e) {if (e.keyCode == 27) {closeSiswa();}});

          if (baru == true) {
            /* INFO >> Ganti action #form-siswa untuk tambah buku */
            $('#form-siswa').submit(function() {
              getAction(this,true);
            });
            /* / INFO */
            hapusGambar();
            document.getElementById('form-siswa').reset();
            $('#h1-form-siswa').html('Tambah Siswa');
            $('.siswa-lama, .siswa-lama-flex').css('display','none');
            $('.edit-form').css('max-width','500px');
            $('#username').prop('required',false);
            return;
          }

          /* INFO >> Ganti action #form-siswa untuk edit siswa */
          $('#form-siswa').submit(function() {
            getAction(this,false);
          });
          /* / INFO */
          $('#h1-form-siswa').html('Edit Siswa');
          $('.siswa-lama').css('display','block');
          $('.siswa-lama-flex').css('display','flex');
          $('.edit-form').css('max-width','800px');
          $('#username').prop('required',true);
        };
        function getAction(form,baru) {
          if (baru == true) {
            form.action = "baru.php";
          } else {
            form.action = "edit.php";
          }
        }
        function closeSiswa() {
          $(".dark").css({"animation":"fadeout .5s","opacity":"0"});
          $(".set-form").css({"animation":"scaleout .5s ease"});
          setTimeout(function() {
            $(".set-popup").css({"display":"none"});
          },480);
        }
        </script>
    </body>
</html>

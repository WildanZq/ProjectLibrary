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
                <?php if (!empty($this->session->flashdata('notif')) && !empty($this->session->flashdata('classNotif'))): ?>
                    <div class="notif <?= $this->session->flashdata('classNotif'); ?>"><?= $this->session->flashdata('notif'); ?></div>
                <?php endif; ?>
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
                        <tbody id="list_siswa">
                            <?php if(!empty($siswa)): foreach($siswa as $siswa): ?>
                            <tr>
                                <td><?php echo $siswa->nama_lengkap; ?></td>
                                <td><?php echo $siswa->angkatan; ?></td>
                                <td><?php echo $siswa->jurusan; ?></td>
                                <td><?php echo $siswa->nomor_kelas; ?></td>
                                <td><?php echo $siswa->poin; ?></td>
                                <td>
                                    <span class="return" onclick="editSiswa(<?= $siswa->id_anggota; ?>)">Edit</span>
                                    <span class="return" onclick="hapusSiswa(<?= $siswa->id_anggota; ?>)">Hapus</span>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <p>Member(s) not available.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                  <div class="pagination">
                    <div class="main">
                      <?php echo $this->ajax_pagination->create_links(); ?>
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
                            <input type="hidden" name="id" value="" id="idSiswa">
                            <div class="i-wrapper"><label>Nama Lengkap:</label>
                                <input type="text" placeholder="Nama Lengkap" id="nama" name="nama" required>
                            </div>
                            <div class="i-wrapper"><label>Kelas:</label>
                              <div class="kelas">
                                <input type="number" placeholder="Angkatan" id="angkatan"  name="angkatan" min="1" required>
                                <select id="jurusan" name="jurusan" required>
                                  <option value="RPL">RPL</option>
                                  <option value="TKJ">TKJ</option>
                                </select>
                                <input type="number" id="nomor_kelas" name="nomor_kelas" placeholder="1" min="1" required>
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
                              <select id="role" name="role" required>
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

          if (baru === true) {
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
          $.ajax({
              url: '<?= base_url(); ?>/admin/getInfoSiswa',
              type: 'POST',
              dataType: 'json',
              data: {param: baru}
          }).done(function(e) {
              $('#idSiswa').val(e.id_anggota);
              $('#nama').val(e.nama_lengkap);
              $('#angkatan').val(e.angkatan);
              $('#jurusan').val(e.jurusan);
              $('#nomor_kelas').val(e.nomor_kelas);
              $('#username').val(e.username);
              $('#poin').val(e.poin);
              $('#role').val(e.role);
          });
        };
        function hapusSiswa(code) {
            window.location = "<?= base_url(); ?>/admin/Delete/siswa/"+code;
        }
        function getAction(form,baru) {
          if (baru == true) {
            form.action = "<?= base_url(); ?>admin/siswa/add";
          } else {
            form.action = "<?= base_url(); ?>admin/siswa/edit";
          }
        }
        function closeSiswa() {
          $(".dark").css({"animation":"fadeout .5s","opacity":"0"});
          $(".set-form").css({"animation":"scaleout .5s ease"});
          setTimeout(function() {
            $(".set-popup").css({"display":"none"});
          },480);
        }
        var search = $('.searchT').val();
        $('.searchT').on('input', function(event) {
            event.preventDefault();
            search = this.value.trim();
            searchFilter(0);
        });
        function searchFilter(page_num) {
            page_num = page_num ? page_num : 0;
            var url = '<?= base_url(); ?>/admin/getSiswaPagination/'+page_num;
            $.ajax({
                type: 'GET',
                url: url,
                data:'page='+page_num+'&data='+search,
                beforeSend: function () {
                    loadin();
                },
                success: function (html) {
                    html = JSON.parse(html);
                    $('#list_siswa').html(html[0]);
                    $('.pagination .main').html(html[1]);
                    loadout();
                }
            });
        }
        </script>
    </body>
</html>

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
                <span class="nav-item-admin" onclick="ChangePage(0)">List</span>
                <span class="nav-item-admin" onclick="addBuku()">Tambah Buku</span>
                <span class="nav-item-admin" onclick="ChangePage(2)">Cetak Barcode</span>
            </div>
            <div class="wrapper" id="list">
                <?php if (!empty($this->session->flashdata('notif')) && !empty($this->session->flashdata('classNotif'))): ?>
                    <div class="notif <?= $this->session->flashdata('classNotif'); ?>"><?= $this->session->flashdata('notif'); ?></div>
                <?php endif; ?>
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
                        <thead>
                            <tr>
                                <th>Register</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th><i class="fa fa-handshake-o" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody id="list_buku">
                            <?php if(!empty($buku)): foreach($buku as $buku): ?>
                            <tr>
                                <td><?php echo $buku->register; ?></td>
                                <td><?php echo $buku->judul; ?></td>
                                <td><?php echo $buku->pengarang; ?></td>
                                <td><?php echo $buku->penerbit; ?></td>
                                <td><?php echo $buku->tahun_terbit; ?></td>
                                <td>
                                    <span class="return" onclick="editBuku(<?= $buku->id_buku; ?>)">Edit</span>
                                    <span class="return">Hapus</span>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <p>Book(s) not available.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                  <div class="pagination">
                    <div class="main">
                        <?php echo $pagination; ?>
                        <!-- <div class="page" id="btn_prev"><i class="fa fa-angle-double-left" aria-hidden="true"></i></div> -->
                        <!-- <div class="page active">1</div>
                        <div class="page">2</div>
                        <div class="page">3</div>
                        <div class="page">...</div>
                        <div class="page">27</div> -->
                        <!-- <div class="page" id="btn_next"><i class="fa fa-angle-double-right" aria-hidden="true"></i></div> -->
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
                            <input type="hidden" name="id" value="" id="idBook">
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
        <!-- <script src="<?php echo base_url(); ?>assets/script/buku.js"></script> -->
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

          if (baru === true) {
            /* INFO >> Ganti action #form-buku untuk tambah buku */
            $('#form-buku').submit(function() {
              getAction(this,true);
            });
            /* / INFO */
            document.getElementById('form-buku').reset();
            $('.form > div > .i-wrapper:eq(5)').hide();
            bCounter = 1; $('#barcode1').val("");
            updateBVal();
            refreshBarcode();
            if (bCounter == 1) {$('#minB1').css('display','none');}
            $('#h1-form-buku').html('Tambah Buku');
            return;
          }
          $('.form > div > .i-wrapper:eq(5)').show();

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
          $.ajax({
              url: 'getInfoBuku',
              type: 'post',
              data: {param: baru}
          }).done(function(e) {
              e = e.split("|");
              var book = JSON.parse(e[0]);
              var bar = JSON.parse(e[1]);
              $('#idBook').val(book.id_buku);
              $('#register').val(book.register);
              $('#judul').val(book.judul);
              $('#pengarang').val(book.pengarang);
              $('#penerbit').val(book.penerbit);
              $('#tahun').val(book.tahun_terbit);
              $('#jumlah').val(book.jumlah);
              bVal = []; bCounter = bar.length;
              for (var i = 1; i <= bCounter; i++) {
                bVal.push(bar[i-1].barcode);
              }
              refreshBarcode();
              if (bCounter > 1) {$('#minB1').css('display','flex');}
          });
        }
        function getAction(form,baru) {
          if (baru == true) {
            form.action = "buku/add";
          } else {
            form.action = "buku/edit";
          }
        }
        function closeBuku() {
          $(".dark").css({"animation":"fadeout .5s","opacity":"0"});
          $(".set-form").css({"animation":"scaleout .5s ease"});
          setTimeout(function() {
            $(".set-popup").css({"display":"none"});
          },480);
        }
        function ChangePage(n) {
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
        var search = $('.searchT').val();
        $('.searchT').on('input', function(event) {
            event.preventDefault();
            search = this.value.trim();
            searchFilter(1);

            console.log("<?php echo $this->session->userdata('q'); ?>");
        });
        function searchFilter(page_num) {
            page_num = page_num ? page_num : 0;
            $.ajax({
                type: 'POST',
                url: 'getBookPagination/'+page_num,
                data:'page='+page_num+'&data='+search,
                beforeSend: function () {
                    loadin();
                },
                success: function (html) {
                    $('#list_buku').html(html);
                    loadout();
                }
            });
        }
        </script>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <title>Perpustakaan SMK Telkom Malang</title>
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/logo.png"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.theme.default.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/index_style.css">
    </head>
    <body>
        <div class="header">
            <img class="logo" src="<?php echo base_url(); ?>assets/images/logo-s.png">
            <span class="show-login">Login</span>
            <i class="fa fa-bars" aria-hidden="true"></i>
            <div class="popup login-wrapper">
                <div class="dark dark-login" onclick="logInClose()"></div>
                <div class="login">
                    <div class="form-wrapper">
                        <form action="" class="form-login" method="post">
                            <h1><i class="fa fa-sign-in" aria-hidden="true"></i> Login</h1>
                            <div class="input-wrapper">
                              <input type="text" placeholder="Username" required>
                              <i class="fa fa-exclamation-circle error" aria-hidden="true"></i>
                              <span class="error error-msg">Username tidak ada</span>
                            </div>
                            <input type="password" placeholder="Password" required>
                            <input type="submit">
                        </form>
                        <div class="login-tab">
                            <span class="s1">Create Account</span>
                            <span class="s2">Login</span>
                            <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                        </div>
                        <form action="" method="post">
                            <h1><i class="fa fa-user-plus" aria-hidden="true"></i> Signup</h1>
                            <div class="signup-wrapper">
                                <div>
                                    <input type="text" placeholder="Username">
                                    <input type="password" placeholder="Password">
                                    <input type="email" placeholder="Email">
                                </div>
                                <div>
                                    <input type="text" placeholder="NIS">
                                    <input type="text" placeholder="Nama Lengkap">
                                    <div class="kelas">
                                        <input type="number" placeholder="Angkatan" min="1">
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
                                </div>
                            </div>
                            <input type="submit">
                        </form>
                    </div>
                </div>
            </div>
            <div class="popup sidebar-wrapper">
                <div onclick="closeNav()" class="dark dark-nav"></div>
                <div class="sidebar">
                    <i onclick="closeNav()" class="fa fa-times close-nav" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="top">
            <div class="bg"></div>
            <div class="ts">
                <img src="<?php echo base_url(); ?>assets/images/ts.jpg">
                <img src="<?php echo base_url(); ?>assets/images/iso9001.png">
            </div>
            <div class="wrapper">
                <img src="<?php echo base_url(); ?>assets/images/logo.png">
                <div class="title">
                    <h1>Perpustakaan SMK Telkom Malang</h1>
                    <p>Lorem Ipsum Dolor Sit Amet</p>
                </div>
            </div>
            <a href="#go"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
        </div>
        <div class="wrapper" id="go">
          <div class="news-wrapper">
            <div class="posterList owl-carousel owl-theme">
              <?php foreach ($list_event as $le): ?>
                  <div class="posterItem img-parent">
                    <img src="<?php echo base_url().'assets/images/event/'.$le->foto_event; ?>" class="img" style="width:100%;height:auto">
                    <div class="detil">
                      <h1><?php echo $le->judul_event; ?></h1>
                      <?php
                      $dayF = date('d', strtotime($le->tgl_mulai));
                      $monthF = date('M', strtotime($le->tgl_mulai));
                      $yearF = date('Y', strtotime($le->tgl_mulai));
                      $dateF = $dayF." ".$monthF." ".$yearF;
                      $dayL = date('d', strtotime($le->tgl_akhir));
                      $monthL = date('m', strtotime($le->tgl_akhir));
                      $yearL = date('Y', strtotime($le->tgl_akhir));
                      $dateL = $dayL." ".$monthL." ".$yearL; ?>
                      <span><?php echo $dateF ." - ". $dateL; ?></span>
                    </div>
                    <div class="read">
                      <a href="#">Read More &#x226B;</a>
                    </div>
                  </div>
              <?php endforeach; ?>
              <div class="posterItem img-parent">
                <img src="<?php echo base_url(); ?>assets/uploads/event/1.jpg" class="img" style="width:100%;height:auto">
                <div class="detil">
                  <h1>Judul Event/Pengumuman</h1>
                  <span>10 May 2017 - 10 May 2017</span>
                </div>
                <div class="read">
                  <a href="#">Read More &#x226B;</a>
                </div>
              </div>
            </div>
          </div>
            <div class="search-book">
                <form action="">
                    <select class="kategori">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="ilmu">Ilmu Komputer, Informasi, &amp; Karya Umum</option>
                        <option value="filsafat">Filsafat &amp; Psikologi</option>
                        <option value="agama">Agama</option>
                        <option value="ips">Ilmu Pengetahuan Sosial</option>
                        <option value="bahasa">Bahasa</option>
                        <option value="sains">Sains</option>
                        <option value="teknologi">Teknologi</option>
                        <option value="kesenian">Kesenian &amp; Rekreasi</option>
                        <option value="sastra">Sastra</option>
                        <option value="sejarah">Sejarah &amp; Geografi</option>
                    </select>
                    <div class="s-wrapper">
                        <input type="text" class="judul" oninput="loadin()" placeholder="Judul buku"><i class="s-icon fa fa-search" aria-hidden="true"></i>
                    </div>
                </form>
            </div>
            <div class="popup detail-wrapper">
              <div class="dark" onclick="detailBukuClose()"></div>
              <div class="book-detail">
                <h1>Aljabar Linear Dasar</h1>
                <span>512.5 GUN A</span>
                <hr>
                <span>Pengarang:&ensp;R. GUNAWAN</span><br>
                <span>Penerbit:&ensp;ANDI Yogyakarta</span><br>
                <span>Tahun Terbit:&ensp;2009</span>
                <div class="av-wrapper">
                  <span>Available</span>
                  <span>2</span>
                </div>
              </div>
            </div>
            <div class="book-list">
              <div class="load-wrapper"><i class="fa fa-circle-o-notch"></i></div>
              <div class="book-item" onclick="showDetailBuku()" title="Click to view more">
                <div><span class="judul">Judul Buku Sangat Panjang Sekali Judul Buku Sangat Panjang Sekali</span></div>
                <div>7</div>
                <div class="av"><span>Available</span></div>
              </div>
              <div class="book-item" onclick="showDetailBuku()" title="Click to view more">
                <div><span class="judul">Judul Buku Panjang Sekali</span></div>
                <div>7</div>
                <div class="av"><span>Available</span></div>
              </div>
              <div class="book-item" onclick="showDetailBuku()" title="Click to view more">
                <div><span class="judul">Judul Buku Panjang Sekali</span></div>
                <div>7</div>
                <div class="av"><span>Available</span></div>
              </div>
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
        <footer>
          <div class="wrapper">
            <span>SMK Telkom Malang &copy; <?php $now = new DateTime; echo $now->format('Y');  ?></span>
            <span class="f-right">Contact</span>
          </div>
        </footer>
        <script src="<?php echo base_url(); ?>assets/script/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery-migrate-3.0.0.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.mobile.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/owl.carousel.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/owl.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/img.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/loading.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/header.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/navbar.js"></script>
        <script>
          function showDetailBuku() {
            $(".detail-wrapper").css("display","flex");
            $(".dark").css({"animation":"fadein .5s","opacity":"1"});
            $(".detail-wrapper .book-detail").css("animation","scalein .5s cubic-bezier(.17, .47, .19, 1.16)");
            $(document).keyup(function(e) {
                if (e.keyCode == 27)
                    detailBukuClose();
            });
          }
          function detailBukuClose() {
            $(".dark").css({"animation":"fadeout .5s","opacity":"0"});
            $(".detail-wrapper .book-detail").css("animation","scaleout .5s cubic-bezier(.45, -0.34, .54, .2)");
            setTimeout(function() {
                $(".detail-wrapper").css("display","none");
            },480);
          }
        </script>
        <script>
          var kategori = "";
          var judul = "";
          $('.kategori').change(function(){
            kategori = this.value;
            cariBuku();
          });

          $('.judul').on('input',function(e){
            judul = this.value.trim();
            cariBuku();
          })

          function cariBuku(){
            if(kategori != "" && judul != ""){
              console.log("Searching for %s with Category %s",judul,kategori);
              var svrAjax = $.ajax({
                url: "api/getBukuSimple",
                method: "POST",
                data:{
                  kategori: kategori,
                  judul: judul
                }
              });

              svrAjax.done(function(response){
                var jsonParsed = JSON.parse(response);
                var dataString = "Found Book : ";
                for(var f = 0 ; f < jsonParsed.length; f++){
                  dataString = dataString + " " + jsonParsed[f].judul + ", ";
                }
                console.log(dataString);
              });
            }
          }


        </script>
    </body>
</html>

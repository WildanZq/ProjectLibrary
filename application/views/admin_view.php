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
                <form action="">
                    <h1><i class="fa fa-wrench" aria-hidden="true"></i> Harga Denda</h1>
                    <div class="i-wrapper"><label>Terlambat:</label><input type="number" placeholder="Terlambat" min="1"></div>
                    <div class="i-wrapper"><label>Hilang:</label><input type="number" placeholder="Hilang" min="1"></div>
                    <input type="submit">
                </form>
            </div>
        </div>
        <div class="container">
            <div class="nav">
                <img src="<?php echo base_url(); ?>assets/images/logo.png" onclick="location.href='<?php echo base_url(); ?>';">
                <a class="active">Peminjaman</a>
                <a href="point">Points Exchange</a>
                <a href="buku">Buku</a>
                <a href="event">Event</a>
                <a href="organisasi">Organisasi</a>
                <a href="laporan">Laporan</a>
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
                                <option value="x rpl">X RPL</option>
                                <option value="x tkj">X TKJ</option>
                                <option value="xi rpl">XI RPL</option>
                                <option value="xi tkj">XI TKJ</option>
                                <option value="xii rpl">XII RPL</option>
                                <option value="xii tkj">XII TKJ</option>
                            </select>
                            <input type="number" placeholder="1" min="1">
                        </div>
                        <input type="text" placeholder="Nama">
                        <input type="text" placeholder="Barcode">
                        <input type="submit">
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
                                <input class="searchT" type="text" placeholder="Barcode" oninput="loadin()"><i class="s-icon fa fa-search" aria-hidden="true"></i>
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
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/script/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/loading.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/change_option.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/admin_setting.js"></script>
        <script type="text/javascript">
            var search = $('.searchT').val();
            var kategori = $('.selectS').val();
            cariPinjam();
            $('.searchT').on('input', function(event) {
                event.preventDefault();
                search = this.value.trim();
                cariPinjam();
            });
            $('.selectS').change(function(event) {
                kategori = $(this).val();
                loadin();
                cariPinjam();
            });
            function cariPinjam() {
                if (kategori != "" || search != "") {
                    var data = [kategori, search];
                    $.ajax({
                        url: 'getPeminjam',
                        type: 'post',
                        data: {data: data}
                    }).done(function(data) {
                        setTimeout(function(){
                            var response = JSON.parse(data);
                            var row = "";
                            var kelas = "";
                            for (var i = 0; i < response.length; i++) {
                                var nama = "<td>"+response[i].nama_lengkap+"</td>";
                                var now = new Date().getFullYear();
                                if (now - 1992 == response[i].angkatan)
                                    kelas = "X "+response[i].jurusan+" "+response[i].nomor_kelas;
                                if ((now - 1992) - 1 == response[i].angkatan)
                                    kelas = "XI "+response[i].jurusan+" "+response[i].nomor_kelas;
                                if ((now - 1992) - 2 == response[i].angkatan)
                                    kelas = "XII "+response[i].jurusan+" "+response[i].nomor_kelas;
                                kelas = "<td>"+kelas+"</td>";
                                var barcode = "<td>"+response[i].barcode+"</td>";
                                var judul = "<td>"+response[i].judul+"</td>";
                                var status = getStatus(response[i].tanggal);
                                status = "<td class='"+status[0]+"'><i class='fa fa-circle' aria-hidden='true'></i> "+status[1]+"</td>";
                                var aksi = '<td><span class="return">Kembali</span><span class="return">Hilang</span></td>';
                                row += "<tr>" + nama + kelas + barcode + judul + status + aksi + "<tr>";
                            }
                            $('#list').html(row);
                            loadout();
                            console.log("success = "+data);
                        }, 500);
                    }).fail(function() {
                        console.log("error");
                    }).always(function() {
                        console.log("complete");
                    });
                } else {
                    alert('kategoridan input kosong');
                }
            }
            function getStatus(tgl) {
                var result = 0;
                var denda = <?php echo $terlambat; ?>;
                var date = new Date(tgl);
                date.setDate(date.getDate() + 7);
                var now = new Date();
                while (date < now) {
                    var week = date.getDay();
                    if (week != 0 && week != 6) result++;
                    date.setDate(date.getDate() + 1);
                }
                var timeDiff = Math.abs(date.getTime() - now.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                result = result != 0 ? ['red', result * denda] : ['green', diffDays+' Hari'];
                return result;
            }
        </script>
    </body>
</html>

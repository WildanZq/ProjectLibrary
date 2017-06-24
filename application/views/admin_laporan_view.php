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
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/print.css">
    </head>
    <body>
        <div class="popup set-popup">
            <div class="dark" onclick="closeSet()"></div>
            <div class="set-form">
                <form action="">
                    <h1><i class="fa fa-wrench" aria-hidden="true"></i> Harga Poin</h1>
                    <div class="i-wrapper"><label>Print:</label><input type="number" placeholder="Print" min="1"></div>
                    <input type="submit">
                </form>
            </div>
        </div>
        <div class="container">
            <div class="nav">
                <img src="<?php echo base_url(); ?>assets/images/logo.png" onclick="location.href='<?php echo base_url(); ?>';">
                <a href="<?php echo base_url(); ?>admin/peminjaman">Peminjaman</a>
                <a href="<?php echo base_url(); ?>admin/point">Points Exchange</a>
                <a href="<?php echo base_url(); ?>admin/buku">Buku</a>
                <a href="<?php echo base_url(); ?>admin/event">Event</a>
                <a href="<?php echo base_url(); ?>admin/siswa">Siswa</a>
                <a href="<?php echo base_url(); ?>admin/organisasi">Organisasi</a>
                <a class="active">Laporan</a>
                <div class="logout" onclick="window.location='<?php echo base_url(); ?>admin/logout'">
                    <h1><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</h1>
                </div>
            </div>
            <div class="nav-laporan">
                <span class="nav-item-laporan">PP</span>
                <span class="nav-item-laporan">Buku</span>
                <span class="nav-item-laporan">Pengunjung</span>
                <span class="nav-item-laporan print"><i class="fa fa-print" aria-hidden="true"></i> Print</span>
            </div>
            <div class="wrapper" id="print">
                <h1>2017</h1>
                <canvas class="chart" id="all" height="70px"></canvas>
                <canvas class="chart" id="denda" height="70px"></canvas>
                <h2>Peminjaman</h2>
                <canvas class="chart" id="pinjam" height="70px"></canvas>
                <h2>Pengembalian</h2>
                <canvas class="chart" id="kembali" height="70px"></canvas>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/script/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/loading.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/Chart.js"></script>
        <script>
            $(".print").on('click',function(){
                window.print();
            });
            var all_peminjaman = "<?php echo $all[0]; ?>";
            all_peminjaman = all_peminjaman.split("|");
            var all_pengembalian = "<?php echo $all[1]; ?>";
            all_pengembalian = all_pengembalian.split("|");
            var list_denda = "<?php echo $denda; ?>";
            list_denda = list_denda.split("|");
            var peminjamanx = "<?php echo $peminjaman[0]; ?>";
            peminjamanx = peminjamanx.split("|");
            var peminjamanxi = "<?php echo $peminjaman[1]; ?>";
            peminjamanxi = peminjamanxi.split("|");
            var peminjamanxii = "<?php echo $peminjaman[2]; ?>";
            peminjamanxii = peminjamanxii.split("|");
            var pengembalianx = "<?php echo $pengembalian[0]; ?>";
            pengembalianx = pengembalianx.split("|");
            var pengembalianxi = "<?php echo $pengembalian[1]; ?>";
            pengembalianxi = pengembalianxi.split("|");
            var pengembalianxii = "<?php echo $pengembalian[2]; ?>";
            pengembalianxii = pengembalianxii.split("|");
        </script>
        <script>
            var all = document.getElementById("all");
            var aChart = new Chart(all, {
                type: 'line',
                data: {
                    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    datasets: [{
                        label: 'Peminjaman',
                        data: all_peminjaman,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255,99,132,1)',
                        borderWidth: 2
                    },{
                        label: 'Pengembalian',
                        data: all_pengembalian,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            var denda = document.getElementById("denda");
            var dChart = new Chart(denda, {
                type: 'bar',
                data: {
                    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    datasets: [{
                        label: 'Denda (Rp)',
                        data: list_denda,
                        backgroundColor: 'rgba(5, 232, 153, 0.2)',
                        borderColor: 'rgb(5, 232, 153)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            var pinjam = document.getElementById("pinjam");
            var pChart = new Chart(pinjam, {
                type: 'line',
                data: {
                    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    datasets: [{
                        label: 'X',
                        data: peminjamanx,
                        backgroundColor: 'rgba(29, 41, 185, 0.1)',
                        borderColor: 'rgb(29, 41, 185)',
                        borderWidth: 2
                    },{
                        label: 'XI',
                        data: peminjamanxi,
                        backgroundColor: 'rgba(28, 190, 35, 0.1)',
                        borderColor: 'rgb(28, 190, 35)',
                        borderWidth: 2
                    },{
                        label: 'XII',
                        data: peminjamanxii,
                        backgroundColor: 'rgba(222, 77, 0, 0.1)',
                        borderColor: 'rgb(222, 77, 0)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            var kembali = document.getElementById("kembali");
            var kChart = new Chart(kembali, {
                type: 'line',
                data: {
                    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    datasets: [{
                        label: 'X',
                        data: pengembalianx,
                        backgroundColor: 'rgba(29, 41, 185, 0.1)',
                        borderColor: 'rgb(29, 41, 185)',
                        borderWidth: 2
                    },{
                        label: 'XI',
                        data: pengembalianxi,
                        backgroundColor: 'rgba(28, 190, 35, 0.1)',
                        borderColor: 'rgb(28, 190, 35)',
                        borderWidth: 2
                    },{
                        label: 'XII',
                        data: pengembalianxii,
                        backgroundColor: 'rgba(222, 77, 0, 0.1)',
                        borderColor: 'rgb(222, 77, 0)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        </script>
    </body>
</html>

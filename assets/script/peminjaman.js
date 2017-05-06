// -------------------- menampilkan peminjaman --------------------
var search = $('.searchT').val();
var kategori = $('.selectS').val();
loadin();
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
            }, 500);
        }).fail(function() {
            console.log("error");
        });
    } else {
        alert('kategori dan input kosong');
    }
}
function getStatus(tgl) {
    var result = 0;
    var denda = getDenda();
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

// -------------------- tambah peminjaman --------------------
var kelas = $('#kelas');
var nkelas = $('#nkelas');
function getName() {
    var availableName = [];
    var kls = kelas.val();
    var nkls = nkelas.val();
    $.ajax({
        url: '../API/getSiswa',
        type: 'post',
        data: {data : [kls, nkls]}
    })
    .done(function(e) {
        var response = JSON.parse(e);
        for (var i = 0; i < response.length; i++) {
            availableName.push(response[i].nama_lengkap);
        }
        return availableName;
    })
    .fail(function() {
        console.log("error");
        availableName = "";
    });
    return availableName;
}
var availableName = getName();
kelas.change(function(event) {
    availableName = getName();
    autocomplete();
});
nkelas.on('input', function(event) {
    availableName = getName();
    autocomplete();
});
function autocomplete() {
    $( "#nama" ).autocomplete({
        minLength:0,
        delay:0,
        source: availableName,
        select: function(event, ui) {
            $('#nama').val(ui.item.nama);
        }
    });
}

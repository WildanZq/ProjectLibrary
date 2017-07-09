// -------------------- menampilkan peminjaman --------------------
var search = $('.searchT').val();
var kategori = $('.selectS').val();
var current_page = 1;
var records_per_page = 2;
var total_row = 0;
var total_page = 0;
var pagination = false;
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
            async: false,
            data: {data: data}
        }).done(function(data) {
            setTimeout(function(){
                var response = JSON.parse(data);
                var row = "";
                var kelas = "";
                var temp = 0;
                var tmp = [];
                for (var i = 0; i < response.length; i++) {
                    temp = i;
                    var istatus = getStatus(response[i].deadline);
                    for (var j = i + 1; j < response.length; j++) {
                        var jstatus = getStatus(response[j].deadline);
                        if (istatus[0] == jstatus[0]) {
                            if (istatus[0] == 'red') {
                                if (jstatus[1] > istatus[1]) {
                                    temp = j;
                                }
                            } else {
                                if (jstatus[1] < istatus[1]) {
                                    temp = j;
                                }
                            }
                        } else if (istatus[0] == 'green' && jstatus[0] == 'red') {
                            temp = j;
                            for (var k = j + 1; k < response.length; k++) {
                                var kstatus = getStatus(response[k].deadline);
                                if (kstatus[0] == 'red') {
                                    if (kstatus[1] > jstatus[1]) {
                                        temp = k;
                                    }
                                }
                            }
                            break;
                        }
                    }
                    tmp = response[i];
                    response[i] = response[temp];
                    response[temp] = tmp;
                }
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
                    var status = getStatus(response[i].deadline);
                    status[1] = status[0] == "green" ? status[1] + ' Hari' : status[1];
                    status = "<td class='"+status[0]+"'><i class='fa fa-circle' aria-hidden='true'></i> "+status[1]+"</td>";
                    // var code = setCode(response[i].id_peminjaman);
                    var kembali = '<span class="return" onclick="kembalikan('+response[i].id_peminjaman+')">Kembali</span>';
                    var hilang = '<span class="return" onclick="hilang('+response[i].id_peminjaman+')">Hilang</span>';
                    var aksi = '<td>' + kembali + hilang + '</td>';
                    row += "<tr>" + nama + kelas + barcode + judul + status + aksi + "</tr>";
                }
                $('#list').html(row);
                current_page = 1;
                changePage(current_page, records_per_page, total_row);
                loadout();
            }, 500);
        }).fail(function() {
            console.log("error");
        });
    } else {
        alert('kategori dan input kosong');
    }
}

setTimeout(function (){
    pagination = true;
    total_row = $("#list").find('tr').length;
    total_page = Math.ceil(total_row / records_per_page);
    for (var i = 0; i < total_page; i++) {
        $('#btn_next').before('<div class="page" data-target="'+(i+1)+'">'+(i+1)+'</div>');
    }
    changePage(current_page, records_per_page, total_row);
    $('.page').click(function(event) {
        var attr = $(this).attr('id');
        if ( typeof attr !== typeof undefined && attr !== false) {
            if (attr === "btn_next") {
                nextPage();
            } else {
                prevPage();
            }
        } else {
            current_page = $(this).attr('data-target');
            changePage(current_page, records_per_page, total_row);
        }
        event.preventDefault;
    });
}, 500);

function changePage(c, r, t) {
    current_page = c;
    var start_row = (r * (current_page - 1));
    var last_row = r * current_page;
    var total_row = t;
    for (var i = 0; i < total_row; i++) {
        if (i < last_row && i >= start_row) {
            $('#list tr:eq('+i+')').show(0);
        } else {
            $('#list tr:eq('+i+')').hide(0);
        }
    }
    $('.page').each(function() {
        var attr = $(this).attr('data-target');
        if ( typeof attr !== typeof undefined && attr !== false) {
            if (attr == current_page) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        }
    });
    if (current_page == 1 && current_page == total_page) {
        $('#btn_next').hide(0);
        $('#btn_prev').hide(0);
    } else if (current_page == 1) {
        $('#btn_prev').hide(0);
        $('#btn_next').show(0);
    } else if (current_page == total_page) {
        $('#btn_next').hide(0);
        $('#btn_prev').show(0);
    } else if (current_page > 1 && current_page < total_page) {
        $('#btn_next').show(0);
        $('#btn_prev').show(0);
    }
}

function prevPage()
{
    if (current_page > 1) {
        current_page--;
        changePage(current_page, records_per_page, total_row);
    }
}

function nextPage()
{
    if (current_page < total_page) {
        current_page++;
        changePage(current_page, records_per_page, total_row);
    }
}

function getStatus(tgl) {
    var result = new Array();
    $.ajax({
        url: 'getStatusPeminjam',
        type: 'POST',
        data: {tgl: tgl},
        async: false,
        success: function(e) {
            var response = JSON.parse(e);
            result[0] = response.status;
            result[1] = parseInt(response.sisa);
        }
    });
    return result;
}

function setCode(hx) {
    hx = parseInt(hx);
    var h = hx / 16;
    var x = hx % 16;
    h = Math.floor(h);
    if (x == 10) x = "A";
    else if (x == 11) x = "B";
    else if (x == 12) x = "C";
    else if (x == 13) x = "D";
    else if (x == 14) x = "E";
    else if (x == 15) x = "F";
    else if (x == 16) x = "0";
    else x = x;
    hx = h+""+x;
    console.log(hx);
    return hx;
}

function kembalikan(code) {
    loadin();
    $.ajax({
        url: 'getDataPeminjam',
        type: 'post',
        data: {data: code}
    }).done(function(e) {
        var response = JSON.parse(e);
        var status = getStatus(response[0].deadline);
        var denda = status[0] == 'red' ? status[1] : 0;

        $.ajax({
            url: 'kembalikan',
            type: 'post',
            data: {data: [code, denda]}
        })
        .done(function(e) {
            if (e == true) cariPinjam();
            else console.log('failed : ' + e);
        })
        .fail(function() {
            console.log("error");
        });
    }).fail(function() {
        console.log("error");
    });
}

function hilang(code) {
    loadin();
    var denda = getDendaHilang();

    $.ajax({
        url: 'hilang',
        type: 'post',
        data: {data: [code, denda]}
    })
    .done(function(e) {
        if (e == true) cariPinjam();
        else console.log('failed : ' + e);
    })
    .fail(function() {
        console.log("error");
    });
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
        source: availableName
    });
}

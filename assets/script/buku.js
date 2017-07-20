// -------------------- menampilkan event --------------------
var search = $('.searchT').val();
var current_page = 1;
var records_per_page = 10;
var total_row = 0;
var total_page = 0;
loadin();
cariBuku();
$('.searchT').on('input', function(event) {
    event.preventDefault();
    search = this.value.trim();
    cariBuku();
});
function cariBuku() {
    $.ajax({
        url: 'getBuku',
        type: 'post',
        async: false,
        data: {data: search}
    }).done(function(data) {
        setTimeout(function(){
            var response = JSON.parse(data);
            var row = "";
            for (var i = 0; i < response.length; i++) {
                var register = "<td>" + response[i].register + "</td>";
                var judul = "<td>" + response[i].judul + "</td>";
                var pengarang = "<td>" + response[i].pengarang + "</td>";
                var penerbit = "<td>" + response[i].penerbit + "</td>";
                var tahun = "<td>" + response[i].tahun_terbit + "</td>";
                var edit = '<span class="return" onclick="editBuku()">Edit</span>';
                var hapus = '<span class="return">Hapus</span>';
                var aksi = '<td>' + edit + hapus + '</td>';
                row += "<tr>" + register + judul + pengarang + penerbit + tahun + aksi + "</tr>";
            }
            $('#list_buku').html(row);
            current_page = 1;
            changePage(current_page);
            loadout();
        }, 100);
    }).fail(function() {
        console.log("error");
    });
}

setTimeout(function (){
    changePage(current_page);
    $(document).on('click', '.page', function(event) {
        event.preventDefault();
        var attr = $(this).attr('id');
        if ( typeof attr !== typeof undefined && attr !== false) {
            if (attr === "btn_next") {
                nextPage();
            } else {
                prevPage();
            }
        } else {
            current_page = $(this).attr('data-target');
            changePage(current_page);
        }
    });
}, 100);

function refreshButton() {
    $('.page').each(function() {
        var attr = $(this).attr('data-target');
        if ( typeof attr !== typeof undefined && attr !== false) {
            $(this).remove();
        }
    });
    total_row = $("#list_buku").find('tr').length;
    total_page = Math.ceil(total_row / records_per_page);
    for (var i = 0; i < total_page; i++) {
        $('#btn_next').before('<div class="page" data-target="'+(i+1)+'">'+(i+1)+'</div>');
    }
}

function changePage(c) {
    current_page = c;
    refreshButton();
    var start_row = (records_per_page * (current_page - 1));
    var last_row = records_per_page * current_page;
    for (var i = 0; i < total_row; i++) {
        if (i < last_row && i >= start_row) {
            $('#list_buku tr:eq('+i+')').show(0);
        } else {
            $('#list_buku tr:eq('+i+')').hide(0);
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
    if (total_row > 0) {
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
    } else {
        $('#btn_next').hide(0);
        $('#btn_prev').hide(0);
    }
}

function prevPage()
{
    if (current_page > 1) {
        current_page--;
        changePage(current_page);
    }
}

function nextPage()
{
    if (current_page < total_page) {
        current_page++;
        changePage(current_page);
    }
}

function Delete(code) {
    loadin();
    $.ajax({
        url: 'Delete/event',
        type: 'post',
        data: {data: code}
    }).done(function(e) {
        if (e == "true") cariBuku();
        else console.log('failed : ' + e);
    }).fail(function() {
        console.log("error");
    });
}

// -------------------- autocomplete search event --------------------
// function getBuku() {
//     var availableBuku = [];
//     $.ajax({
//         url: '../API/getEvent',
//         type: 'post',
//         data: {data : date}
//     }).done(function(e) {
//         var response = JSON.parse(e);
//         for (var i = 0; i < response.length; i++) {
//             availableBuku.push(response[i].judul);
//             availableBuku.push(response[i].pengarang);
//             availableBuku.push(response[i].penerbit);
//             availableBuku.push(response[i].tahun_terbit);
//             availableBuku.push(response[i].register);
//         }
//         return availableBuku;
//     }).fail(function() {
//         console.log("error");
//         availableBuku = "";
//     });
//     return availableBuku;
// }
// var availableBuku = getEvent();
// function autocomplete() {
//     $( "#search" ).autocomplete({
//         minLength:0,
//         delay:0,
//         source: availableBuku
//     });
// }

// -------------------- menampilkan event --------------------
var search = $('.searchT').val();
var date = $('.inputD').val();
var current_page = 1;
var records_per_page = 1;
var total_row = 0;
var total_page = 0;
var pagination = false;
loadin();
cariEvent();
$('.searchT').on('input', function(event) {
    event.preventDefault();
    search = this.value.trim();
    cariEvent();
});
$('.inputD').change(function(event) {
    date = $(this).val();
    availableEvent = getEvent();
    autocomplete();
    loadin();
    cariEvent();
});
function cariEvent() {
    var data = [date, search];
    $.ajax({
        url: 'getEvent',
        type: 'post',
        async: false,
        data: {data: data}
    }).done(function(data) {
        setTimeout(function(){
            var response = JSON.parse(data);
            var row = "";
            for (var i = 0; i < response.length; i++) {
                var dari = "<td>" + response[i].tgl_mulai + "</td>";
                var sampai = "<td>" + response[i].tgl_akhir + "</td>";
                var judul = "<td>" + response[i].judul_event + "</td>";
                var views = "<td>" + response[i].view + "</td>";
                var edit = '<span class="return" onclick="location.href="./edit_event";">Edit</span>';
                var hapus = '<span class="return" onclick="Delete('+ response[i].id_event +')">Hapus</span>';
                var aksi = '<td>' + edit + hapus + '</td>';
                row += "<tr>" + dari + sampai + judul + views + aksi + "</tr>";
            }
            $('#list').html(row);
            current_page = 1;
            changePage(current_page, records_per_page, total_row);
            loadout();
        }, 500);
    }).fail(function() {
        console.log("error");
    });
}

setTimeout(function (){
    pagination = true;
    changePage(current_page);
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
            changePage(current_page);
        }
        event.preventDefault;
    });
}, 100);

function changePage(c) {
    current_page = c;
    $('.page').each(function() {
        var attr = $(this).attr('data-target');
        if ( typeof attr !== typeof undefined && attr !== false) {
            $(this).remove();
        }
    });
    total_row = $("#list").find('tr').length;
    total_page = Math.ceil(total_row / records_per_page);
    for (var i = 0; i < total_page; i++) {
        $('#btn_next').before('<div class="page" data-target="'+(i+1)+'">'+(i+1)+'</div>');
    }
    var start_row = (records_per_page * (current_page - 1));
    var last_row = records_per_page * current_page;
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

function Delete(code) {
    loadin();
    $.ajax({
        url: 'Delete/event',
        type: 'post',
        data: {data: code}
    }).done(function(e) {
        if (e == "true") cariEvent();
        else console.log('failed : ' + e);
    }).fail(function() {
        console.log("error");
    });
}

// -------------------- autocomplete search event --------------------
function getEvent() {
    var availableEvent = [];
    $.ajax({
        url: '../API/getEvent',
        type: 'post',
        data: {data : date}
    }).done(function(e) {
        var response = JSON.parse(e);
        for (var i = 0; i < response.length; i++) {
            availableEvent.push(response[i].judul_event);
        }
        return availableEvent;
    }).fail(function() {
        console.log("error");
        availableEvent = "";
    });
    return availableEvent;
}
var availableEvent = getEvent();
function autocomplete() {
    $( "#search" ).autocomplete({
        minLength:0,
        delay:0,
        source: availableEvent
    });
}

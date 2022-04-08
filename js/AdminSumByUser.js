var date = moment(); //Get the current date

var start = date.format("YYYY-MM-DD 00:00");
var end = date.format("YYYY-MM-DD HH:mm");

var nhom = '';
var SumByUser = function () {
    var self = this;    

    $('#datetimepicker2').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD HH:mm'
    });
    $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD HH:mm'
    });
    $("#ctrlsearchtransactionbtn").click(function () {       
        nhom = $("#search").val();
        start = $("#txtStart").val();
        end = $("#txtEnd").val();
        
        self.RefreshTableQuanLyGiaoDich("#grid");
        //self.TotalMoney();
    });

    self.Init = function () {
        var date = moment(); //Get the current date
        
        $("#txtEnd").val(date.format("YYYY-MM-DD HH:mm"));
        $("#txtStart").val(date.format("YYYY-MM-DD HH:mm"))
        $("#search").val('');
        self.QuanLyGiaoDichDataTable();
        //self.TotalMoney();
    }
    self.QuanLyGiaoDichDataTable = function () {
        //Load Template Document: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#grid').DataTable({
            "bDestroy": true,
            "sPaginationType": "full_numbers",
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "oSearch": { "bSmart": true, "bRegex": true },
            "sDom": 'it<pl>',
            "ajax": {
                "url": "/SumByUser/GetAllSummary",
                "type": "GET",
                "datatype": "json",
                'data': function (d) {                 	
                    d.fromDate = $("#txtStart").val(); 
                    d.toDate = $("#txtEnd").val();                    
                    d.findkey=nhom;
                }
            },
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            "columns": [
                { "data": "Name" },
                { "data": "UserName" },
                { "data": "TopupMobile" },
                { "data": "MuaMaTheCao" },
                { "data": "GachThe" },
                {"data":"NapTienVaoTK"},
                { "data": "RutTienVaoTK" },
                { "data": "ChuyenTien" },
                { "data": "NhanTien" },
                {"data":"NapTienQuay"},
                { "data": "TongTien" }
            ],
            "order": [[0, 'asc']],
            "oLanguage": {
                "sProcessing": "Đang xử lý",
                "sLengthMenu": "Hiển thị _MENU_ Bản ghi",
                "sZeroRecords": "Không tìm thấy bản ghi nào !",
                "sInfo": "Hiển thị từ _START_ - _END_ bản ghi ( trong số _TOTAL_ )",
                "sInfoFiltered": "(suodatettu _MAX_ tuloksen joukosta)",
                "oPaginate": {
                    "sFirst": "Đầu",
                    "sPrevious": "Trước",
                    "sNext": "Sau",
                    "sLast": "Cuối"
                }
            }
        });
    }


    // Kiểm tra tính hợp lệ của dữ liệu
    

    // Load lại dữ liệu lên table
    self.RefreshTableQuanLyGiaoDich = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }
    self.TotalMoney = function () {
        $.ajax({
            url: '/SumByUser/GetAllSummary',
            type: 'GET',
            datatype: "json",
            data: {fromDate:start,toDate:end, nhom:nhom },
            success: function (data) {
                $("#idSumMoneyValue").text(data.tongtien);
                $("#idSumPriceValue").text(data.sumprice);
            }
        });
    }
}

function Add() {
    $("#myModalLabel").html("Thêm mới người dùng");
    $("#userId").val("");
    $("#fullname").val("");
    $("#name").val("");
    $("#email").val("");
    $("#password").val("");
    $("#passwordConfirm").val("");
    $("#GroupDropBox").val("");
    $('#GroupDropBox option[value="Bruce Jones"]').attr("selected", "selected");
    $("#playerModal").modal("show");
}

function ResetPass(e){
    console.log(e);
}
function Edit(e) {
    $("#myModalLabel").html("Cập nhật thông tin người dùng");
    $("#userId").val(e.data.record.UserId);
    $("#fullname").val(e.data.record.Name);
    $("#name").val(e.data.record.UserName);
    $("#password").val('');
    $("#passwordConfirm").val('');
    //$("#GroupDropBox").val(e.data.record.GroupId);
    $('#GroupDropBox option[value=' + e.data.record.GroupId  + ']').attr('selected', 'selected');
    $("#playerModal").modal("show");
}

function Save() {
    var _userId = $("#userId").val();
    var _Name = $("#fullname").val();
    var _username = $("#name").val();
    var _pass = $("#password").val();
    var _passComfirm = $("#passwordConfirm").val();
    var _Group = $("#GroupDropBox").val();

    if (_Name == '') {
        $("#fullname").addClass("invalid");
        return false;
    } else {
        $("#fullname").removeClass("invalid");
    }

    if (_username == '') {
        $("#name").addClass("invalid");
        return false;
    } else {
        if (validateEmail(_username)) {
            $("#name").removeClass("invalid");
        } else {
            $("#name").addClass("invalid");
            return false;
        }
    }

    if (_userId == '' || _pass != '') {
        if (_pass == '') {
            $("#password").addClass("invalid");
            return false;
        } else {
            $("#password").removeClass("invalid");
        }

        if (_pass != _passComfirm) {
            $("#passwordConfirm").addClass("invalid");
            return false;
        } else {
            $("#passwordConfirm").removeClass("invalid");
        }
    }

    if (_Group == '') {
        $("#GroupDropBox").addClass("invalid");
        return false;
    } else {
        $("#GroupDropBox").removeClass("invalid");
    }

    var _userEntity = {
        UserId: _userId,
        UserName: _username,
        Password: _pass,
        Name: _Name,
        GroupId: _Group
    };
    var _data = JSON.stringify({ userEntity: _userEntity });
    $.ajax({ url: "Users/Save", type: "POST", data: _data, contentType: "application/json", datatype: "html", })
        .done(function () {
            grid.reload();
            $("#playerModal").modal("hide");
        })
        .fail(function () {
            alert("Unable to save.");
            $("#playerModal").modal("hide");
        });
}
function Remove(e) {
    $.ajax({ url: "Home/Remove", type: "POST", data: { id: e.data.id } })
        .done(function () {
            grid.reload();
        })
        .fail(function () {
            alert("Unable to remove.");
        });
}
function Search() {
    grid.reload({ userString: $("#search").val(), fdate: $("#ctrlfromdatetxt").val(), tdate: $("#ctrltodatetxt").val() });
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
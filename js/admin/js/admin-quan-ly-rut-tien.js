
var findKey = "";
// Quản lý giao dịch rút tiền
var RutTien = function () {
    var self = this;
    // Hàm khởi tạo
    self.initRutTien = function () {
        self.RutTienFunction();
    }

    // Hàm chức năng
    self.RutTienFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            findKey = $("#txtfinKey").val().trim();
            $.ajax({
                url: '/HuyRutTien/GetData',
                data: { findKey: findKey },
                dataType: 'json',
                type: "post",
                beforeSend: function () {
                    Busy.Block();
                },
                success: function (data) {
                    loadData(data);
                    $("#txtfinKey").val("");
                },
                complete: function () {
                    $.unblockUI();
                },
                error: function () {
                    $.gritter.add({ title: "đổi thẻ 66", text: "Lỗi trong quá trình thực hiện truy vấn dữ liệu", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                }
            });

        });
    }
}

function loadData(data) {
    var tab = $("<table id='tblRutTien' class='table table-striped table-bordered' cellspacing='0' width='100%'></table>");
    var thead = $('<tr></tr>');
    thead.append('<th>Người chuyển</th>');
    thead.append('<th>Số tiền</th>');
    thead.append('<th>Thời gian</th>');
    thead.append('<th>Trạng thái</th>');
    thead.append('<th>Chức năng</th>');
    tab.append(thead);
    if (data.length > 0) {
        $.each(data, function (i, val) {
            var trow = $('<tr></tr>');
            trow.append('<td>' + val.Email + '</td>');
            trow.append('<td>' + val.strPrice + '</td>');
            trow.append('<td>' + val.strCreateDate + '</td>');
            trow.append('<td>' + val.strStatus + '</td>');
            if (val.Status != 1) {
                trow.append('<td align="center">' + '<a onclick="huyRutTien(\'' + val.TransId + '\')" data-id="' + val.TransId + '"><i class="fa fa-trash" style="color:red"></i> Hủy rút tiền</a>' + '</td>');
            }
            else {
                trow.append('<td align="center">' + '<i class="fa fa-trash" style="color:red"></i> Không thể hủy rút tiền' + '</td>');
            }
            tab.append(trow);
        });
    }
    else {
        var trow = $('<tr></tr>');
        trow.append('<td colspan="5" align="center">' + "Không có bản ghi !" + '</td>');
        tab.append(trow);
    }
    $("#content").html(tab);
};
var TKRutTien = function () {
    var self = this;
    // Hàm khởi tạo
    self.initTKRutTien = function () {
        self.TKRutTienFunction();
    }

    // Hàm chức năng
    $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD HH:mm:ss'
    });

    $('#datetimepicker2').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD HH:mm:ss'
    });
    self.TKRutTienFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            findKey = $("#txtfinKey").val().trim();

            $.ajax({
                url: '/HuyRutTien/GetDataRutTien',
                data: { findKey: findKey, timeStart1: $("#txtStart1").val().trim(), timeEnd1: $("#txtEnd1").val().trim() },
                dataType: 'json',
                type: "post",
                beforeSend: function () {
                    Busy.Block();
                },
                success: function (data) {
                    loadDataTK(data);
                    $("#txtfinKey").val("");
                },
                complete: function () {
                    $.unblockUI();
                },
                error: function () {
                    $.gritter.add({ title: "đổi thẻ 24/7", text: "Lỗi trong quá trình thực hiện truy vấn dữ liệu", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                }
            });

        });
    }
}
function loadDataTK(obj) {
    var tab = $("<table id='tblRutTien' class='table table-striped table-bordered' cellspacing='0' width='100%'></table>");
    var thead = $('<tr></tr>');
    thead.append('<th>Người rút</th>');
    thead.append('<th>Số tiền</th>');
    thead.append('<th>Thời gian</th>');
    thead.append('<th>Trạng thái</th>');
    thead.append('<th>Mã giao dịch</th>');
    tab.append(thead);
    if (obj.data.length > 0) {
        $.each(obj.data, function (i, val) {
            var trow = $('<tr></tr>');
            trow.append('<td>' + val.UserName + '</td>');
            trow.append('<td>' + val.strAmount + '</td>');
            trow.append('<td>' + val.strCreateDate + '</td>');
            trow.append('<td>' + val.strStatus + '</td>');
            trow.append('<td align="center">' + val.Trace + '</td>');

            tab.append(trow);
        });
    }
    else {
        var trow = $('<tr></tr>');
        trow.append('<td colspan="5" align="center">' + "Không có bản ghi !" + '</td>');
        tab.append(trow);
    }
    $('.tongdachuyet').text(obj.tongduyet);
    $('.tongchuaduyet').text(obj.tongchuaduyet);
    $("#content").html(tab);
};

function huyRutTien(id) {
    bootbox.confirm("Bạn có chắc chắn muốn thực hiện lệnh hủy chuyển tiền vừa chọn?", function (result) {
        if (result == true) {
            $.ajax({
                url: '/HuyRutTien/HuyRutTien',
                data: { id: id },
                dataType: 'json',
                type: "post",
                success: function (data) {
                    $("#content").html("");
                    $.gritter.add({ title: "đổi thẻ 66", text: "Hủy rút tiền thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                },
                error: function () {
                    $.gritter.add({ title: "đổi thẻ 66", text: "Hủy rút tiền thất bại", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                }
            });
        }
    });
}
var QuanLyRutTien = function () {
    var self = this;

    // Hàm khởi tạo
    self.initQuanLyRutTien = function () {
        $("#txtfinKey").val("");
        $("#txtStart").val("");
        $("#txtEnd").val("");
        $("#optTrangThai").val(-1);
        self.QuanLyRutTienTable();
        self.QuanLyRutTienFunction();
        self.TotalAccount();
    }

    // Hàm chức năng
    self.QuanLyRutTienFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'YYYY-MM-DD'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'YYYY-MM-DD'
        });

        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblKhoTheNguoiDung");
            self.TotalAccount();
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.QuanLyRutTienTable = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblKhoTheNguoiDung').DataTable({
            "bDestroy": true,
            //"fnServerParams": function (aoData) {
//                aoData.push(
//                        {
//                            "name": "findKey",
//                            "value": $("#txtfinKey").val().trim()
//                        },
//                        {
//                            "name": "tuNgay",
//                            "value": $("#txtStart").val().trim()
//                        },
//                        {
//                            "name": "denNgay",
//                            "value": $("#txtEnd").val().trim()
//                        },
//                        {
//                            "name": "trangThai",
//                            "value": $("#optTrangThai option").filter(":selected").val()
//                        }
//                    )
//            },
            "ajax": {
                "url": "/HuyRutTien/GetAllRuttien",
                "type": "POST",
                "datatype": "json",
                timeout: 60000,                
                'data': function (d) {                 	
                    d.tuNgay = $("#txtStart").val().trim(); 
                    d.denNgay = $("#txtEnd").val().trim();                    
                    d.findKey=$("#txtfinKey").val().trim();
                    d.trangThai=$("#optTrangThai option").filter(":selected").val();
                }
            },
            //"bFilter": false,
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            //"sDom": 'it<pl>',
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            //"sAjaxSource": '/HuyRutTien/GetAllRuttien',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "UserName" },
            { "mData": "StrAmount" },
            { "mData": "StrCreateDate", "class": "dt-center" },
            { "mData": "StrStatus", "class": "dt-center" },
            { "mData": "Trace", className: "dt-body-center" }
            
            ],
            "order": [3, 'desc'],
            "oLanguage": {
                "sProcessing": "Đang xử lý",
                "sLengthMenu": "Hiển thị _MENU_ Bản ghi",
                "sZeroRecords": "Không tìm thấy bản ghi nào !",
                "sInfo": "Hiển thị _START_ tới _END_ của ( _TOTAL_ bản ghi )",
                "sInfoEmpty": "Không tìm thấy bản ghi nào !",
                "oPaginate": {
                    "sFirst": "Đầu",
                    "sPrevious": "Trước",
                    "sNext": "Sau",
                    "sLast": "Cuối"
                }
            }
        });

        // Sự kiện khi click vào kích hoạt tài khoản người dùng
       
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Đếm số tài khoản
    self.TotalAccount = function () {
        $.ajax({
            url: '/HuyRutTien/GetAllRuttien',
            type: 'POST',
            dataType:'json',
            data: {
                findKey: $("#txtfinKey").val().trim(),
                tuNgay: $("#txtStart").val().trim(),
                denNgay: $("#txtEnd").val().trim(),
                trangThai: $("#optTrangThai option").filter(":selected").val()
            },
            success: function (data) {
                $(".tongdachuyet").text(data.tongdaduyet);
                $(".tongchuaduyet").text(data.tongTaiKhoan);
            }
        });
    }

}


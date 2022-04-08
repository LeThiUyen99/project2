

var findKey = "";
// Quản lý chuyển tiền
var ChuyenTien = function () {
    var self = this;
    // Hàm khởi tạo
    self.initChuyenTien = function () {
        self.ChuyenTienFunction();
    }

    // Hàm chức năng
    self.ChuyenTienFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            findKey = $("#txtfinKey").val().trim();
            if(findKey != ""){
            $.ajax({
                url: '/HuyChuyenTien/GetData',
                data: { findKey: findKey },
                dataType: 'json',
                type: "post",
                beforeSend: function () {
                    Busy.Block();
                },
                success: function (data) {
                    loadData(data);
                    //$("#txtfinKey").val("");
                },
                complete: function () {
                    $.unblockUI();
                },
                error: function () {
                    $.gritter.add({ title: "đổi thẻ 66", text: "Lỗi trong quá trình thực hiện truy vấn dữ liệu", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                }
            });
            }
        });
    }
}

// Load dữ liệu
function loadData(data) {
    var tab = $("<table id='tblChuyenTien' class='table table-striped table-bordered' cellspacing='0' width='100%'></table>");
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
            trow.append('<td>' + val.UserName + '</td>');
            trow.append('<td>' + val.StrPrice + '</td>');
            trow.append('<td>' + val.StrCreateDate + '</td>');
            trow.append('<td>' + val.StrStatus + '</td>');
            if (val.Status!=1) {
                trow.append('<td align="center">' + '<a onclick="huyChuyenTien(\'' + val.TransId + '\')" data-id="' + val.TransId + '" class="btn-xs btn-danger"><i class="fa fa-trash-o" style="color:red"></i> Hủy chuyển tiền</a>' + '</td>');
            }
            else {
                trow.append('<td align="center">' + '<i class="fa fa-trash" style="color:red"></i> Không thể hủy chuyển tiền' + '</td>');
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

function huyChuyenTien(id) {
    bootbox.confirm("Bạn có chắc chắn muốn thực hiện lệnh hủy chuyển tiền vừa chọn?", function (result) {
        if (result == true) {
            $.ajax({
                url: '/HuyChuyenTien/HuyChuyenTien',
                data: { id: id },
                dataType: 'json',
                type: "post",
                success: function (data) {
                    if(data.success == true){
                        $("#content").html("");
                    $.gritter.add({ title: "đổi thẻ 66", text: "Hủy chuyển tiền thành công !", image: "/upload/success.png", class_name: "clean", time: "1500" });
                
                    }else{
                         $("#content").html("");
                    }
                    },
                error: function () {
                    $.gritter.add({ title: "đổi thẻ 66", text: "Hủy chuyển tiền thất bại", image: "/upload/success.png", class_name: "clean", time: "1000" });
                }
            });
        }
    });
}




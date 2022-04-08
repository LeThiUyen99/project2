

var findKey = "";

// Quản lý hủy top up
var HuyTopUp = function () {
    var self = this;

    // Hàm khởi tạo hủy top up
    self.initHuyTopUp = function () {
        self.HuyTopUpFunction();
    }

    // Hàm chức năng hủy top up
    self.HuyTopUpFunction = function () {

        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            findKey = $("#txtfinKey").val().trim();
            $.ajax({
                url: Config.AppUrl + 'HuyTopUp24h/_DanhSachTheHuyTopUp',
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
                    $.gritter.add({ title: "Bán thẻ 24h", text: "Lỗi trong quá trình thực hiện truy vấn dữ liệu", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                }
            });
        });

        // Thực hiện hủy TopUp
        $("#btnHuyTopUp").click(function () {
            var idTopUp = $("#lblIdTopUp").text();
            HuyTopUp24h(idTopUp);
        });
    }
}

// Load dữ liệu lên table
function loadData(data) {
    var tab = $("<table id='tblThemGiaoDich' class='table table-striped table-bordered' cellspacing='0' width='100%'></table>");
    var thead = $('<tr></tr>');
    thead.append('<th>Số điện thoại</th>');
    thead.append('<th>Mệnh giá</th>');
    thead.append('<th>Kênh</th>');
    thead.append('<th>Trạng thái</th>');
    thead.append('<th>Thời gian</th>');
    thead.append('<th>Chức năng</th>');
    tab.append(thead);
    if (data.length > 0) {
        $.each(data, function (i, val) {
            var trow = $('<tr></tr>');
            trow.append('<td>' + val.MobileNo + '</td>');
            trow.append('<td>' + val._Amount + '</td>');
            trow.append('<td style="text-align: center">' + val.VnPayDateTime + '</td>');
            if (val.VnPayDateTime == "TOPUP") {
                trow.append('<td style="text-align: center">' + "<label class='btn-success btn-xs'>Có thể hủy</label>" + '</td>');
            }
            else {
                trow.append('<td style="text-align: center">' + "<label class='btn-danger btn-xs'>Không thể hủy</label>" + '</td>');
            }
            trow.append('<td style="text-align: center">' + val.strCreateDate + '</td>');
            trow.append('<td align="center">' +
            "<a onclick='ChiTietBangCharlogTable(\"" + val.Id + "\")' title='Cập nhật lịch sử' data-id='" + val.Id + "' class='_capNhatLichSu btn-success btn-xs' data-title='Cập nhật lịch sử'><i class='fa fa-diamond' aria-hidden='true'></i> Hủy topup</a>" +
            '</td>');
            tab.append(trow);
        });
    }
    else {
        var trow = $('<tr></tr>');
        trow.append('<td colspan="6" align="center">' + "Không có bản ghi !" + '</td>');
        tab.append(trow);
    }
    $("#tbl_DanhSachTheLoi").html(tab);
};

// Chi tiết TopUp
function ChiTietBangCharlogTable(id) {
    ////bootbox.confirm("Bạn có chắc chắc muốn hủy lệnh topup vừa chọn?", function (result) {
    ////    if (result == true) {
    ////        $.ajax({
    ////            url: Config.AppUrl + 'HuyTopUp24h/_HuyTopUp',
    ////            async: false,
    ////            data: { id: id },
    ////            type: "get",
    ////            success: function (data) {
    ////                if (data == "success") {
    ////                    $("#tbl_DanhSachTheLoi").html("");
    ////                    $.gritter.add({ title: "Bán thẻ 24h", text: "Hủy top up thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
    ////                }
    ////                else {
    ////                    $("#tbl_DanhSachTheLoi").html("");
    ////                    $.gritter.add({ title: "Bán thẻ 24h", text: "Hủy top up thất bại !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
    ////                }
    ////            }
    ////        });
    ////    }
    ////});
    $.ajax({
        url: Config.AppUrl + 'HuyTopUp24h/ChiTietTopUp',
        data: { id: id },
        type: "get",
        success: function (data) {
            if(data.Amount > data._DaNap){
                $("#btnHuyTopUp").show();
                $("#btnKHongTheHuyTopUp").hide();
            }
            else {
                $("#btnHuyTopUp").hide();
                $("#btnKHongTheHuyTopUp").show();
            }
            $("#lblIdTopUp").text(id);
            $("#lblSoDienThoai").text(data.MobileNo);
            $("#lblSoTienNap").text(data._Amount);
            $("#lblSoTienDaNap").text(data.DaNap);
            $("#lblThoiGian").text(data.strCreateDate);
            $("#modalChiTietTopUp").modal("show");
        }
    });
}

// Hủy top up
function HuyTopUp24h(id) {
    bootbox.confirm("Bạn có chắc chắc muốn hủy lệnh topup vừa chọn?", function (result) {
        if (result == true) {
            $.ajax({
                url: Config.AppUrl + 'HuyTopUp24h/_HuyTopUp',
                async: false,
                data: { id: id },
                type: "get",
                success: function (data) {
                    if (data == "success") {
                        $("#modalChiTietTopUp").modal("hide");
                        $("#tbl_DanhSachTheLoi").html("");
                        $.gritter.add({ title: "Bán thẻ 24h", text: "Hủy top up thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                    }
                    else {
                        $("#tbl_DanhSachTheLoi").html("");
                        $.gritter.add({ title: "Bán thẻ 24h", text: "Hủy top up thất bại !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                    }
                }
            });
        }
    });
}
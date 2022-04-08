
var findKey = "";

// Quản lý cộng tiền banthe247
var CongTienKhachHang = function () {
    var self = this;

    // Hàm khởi tạo hủy top up
    self.initCongTienKhachHang = function () {
        $("#khachHang").hide();
        RemoveToolTip();
        self.CongTienKhachHangFunction();
    }

    // Hàm chức năng hủy top up
    self.CongTienKhachHangFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            findKey = $("#txtfinKey").val().trim();
            $.ajax({
                url: '/CongTienKhachHang/GetData',
                data: { findKey: findKey },
                dataType: 'json',
                type: "post",
                beforeSend: function () {
                    Busy.Block();
                },
                success: function (data) {
                    loadData(data);
                    
                },
                complete: function () {
                    $.unblockUI();
                },
                error: function () {
                    $.gritter.add({ title: "Bán thẻ 24h", text: "Lỗi trong quá trình thực hiện truy vấn dữ liệu", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                }
            });
        });

        // sự kiện khi người dùng nhập số tiền
        $("#txtSoTien").keyup(function (e) {
            if (this.value.trim().length > 10) {
                return this.value = this.value.substring(0, 10);
            }
            this.value = this.value.replace(/[^\-0-9]/g, '');
            if (this.value != "") {
                var n = parseInt($(this).val());
                $(this).val(n.toLocaleString('en-US', { minimumFractionDigits: 0 }));
            }
        });

        // sự kiện khi người dùng click vào cộng tiền khách hàng
        $("#btnCongTienKhachHang").click(function () {
            if (ValidateData() == true) {
                bootbox.confirm("Bạn có chắc chắn muốn thực hiện lệnh cộng tiền?", function (result) {
                    if (result == true) {
                        $.ajax({
                            url: '/CongTienKhachHang/CongTienKhachHang',
                            data: {
                                idKhachHang: $("#lblUserIdKhachHang").text(),
                                tenKhachHang: $("#lblHoTenKH").text(),
                                email: $("#lblTenDangNhap").text(),
                                soDienThoai: $("#lblSoDienThoai").text(),
                                nganHang: $("#optNganHang option").filter(":selected").val(),
                                soTien: $("#txtSoTien").val().replace(/,/g, ''),
                                noiDung: $("#txaNoiDung").val()
                            },
                            type: "post",
                            dataType:'json',
                            success: function (data) {
                                if (data.success == true) {
                                    $("#optNganHang").val(0);
                                    $("#txtSoTien").val("");
                                    $("#txaNoiDung").val("");
                                    DanhSachLenh($("#lblUserIdKhachHang").text());
                                    $.gritter.add({ title: "banthe247", text: "Cộng tiền khách hàng thành công", image: "/upload/success.png", class_name: "clean", time: "1000" });
                                }
                                else {
                                    $.gritter.add({ title: "banthe247", text: "Cộng tiền khách hàng thất bại", image: "/upload/success.png", class_name: "clean", time: "1000" });
                                }
                            }
                        });
                    }
                });
            }
        });
    }
}

// Load dữ liệu lên table
function loadData(data) {
    var tab = $("<table id='tblThemGiaoDich' class='table table-striped table-bordered' cellspacing='0' width='100%'></table>");
    var thead = $('<tr></tr>');
    thead.append('<th>Họ và tên</th>');
    thead.append('<th>Tên đăng nhập</th>');
    thead.append('<th>Số điện thoại</th>');
    thead.append('<th>Thời gian</th>');
    thead.append('<th>Trạng thái</th>');
    thead.append('<th style="width:120px">Chức năng</th>');
    tab.append(thead);
    if (data.length > 0) {
        $.each(data, function (i, val) {
            var trow = $('<tr></tr>');
            trow.append('<td>' + val.Name + '</td>');
            trow.append('<td>' + val.UserName + '</td>');
            trow.append('<td style="text-align: center">' + val.Phone + '</td>');
            trow.append('<td style="text-align: center">' + val.StrCreateDate + '</td>');
            trow.append('<td style="text-align: center">' + val.StrStatus + '</td>');
            trow.append('<td align="center">' +
               "<a onclick='CongTienKH(\"" + val.UserId + "\")' title='Cập nhật lịch sử' data-id='" + val.UserId + "' class='_congTienKhachHang btn-warning btn-xs' data-title='Cập nhật lịch sử'><i class='fa fa-plus' aria-hidden='true'></i> Cộng tiền</a>" +
               '</td>');
            tab.append(trow);
        });
    }
    else {
        var trow = $('<tr></tr>');
        trow.append('<td colspan="6" align="center">' + "Không có bản ghi !" + '</td>');
        tab.append(trow);
    }
    $("#tbl_DanhSachKH").html(tab);
    $("#khachHang").show();
};

// Load dữ liệu lên table bảng danh sách lệnh cộng tiền
function loadDataLenh(data) {
    var tab = $("<table id='DanhSachLenh' class='table table-striped table-bordered' cellspacing='0' width='100%' style='width:98%; margin-left:5px'></table>");
    var thead = $('<tr></tr>');
    thead.append('<th>Ngân hàng</th>');
    thead.append('<th>Số tiền</th>');
    thead.append('<th>Thời gian</th>');
    thead.append('<th>Trạng thái</th>');
    tab.append(thead);
    if (data.length > 0) {
        $.each(data, function (i, val) {
            var trow = $('<tr></tr>');
            trow.append('<td>' + val.MaNganHang + '</td>');
            trow.append('<td>' + val.strSoTien + '</td>');
            trow.append('<td style="text-align: center">' + val.strThoiGianCapNhat + '</td>');
            trow.append('<td style="text-align: center">' + val.trangThai + '</td>');
            tab.append(trow);
        });
    }
    else {
        var trow = $('<tr></tr>');
        trow.append('<td colspan="4" align="center">' + "Không có bản ghi !" + '</td>');
        tab.append(trow);
    }
    $("#tbl_DanhSachLenh").html(tab);
};

// Hủy top up
function CongTienKH(id) {
    $.ajax({
        url: '/CongTienKhachHang/ChiTietKhachHang',
        data: { UserId: id },
        type: "post",
        dataType:"json",
        success: function (data) {
            DanhSachNganHang();
            RemoveToolTip();
            DanhSachLenh(data.UserId);
            $("#lblUserIdKhachHang").text(data.UserId);
            $("#optNganHang").val(0);
            $("#txtSoTien").val("");
            $("#lblHoTenKH").text(data.Name);
            $("#lblTenDangNhap").text(data.UserName);
            $("#lblSoDienThoai").text(data.Phone);
            $("#modalCongTienTK").modal("show");
        }
    });
}


// gọi danh sách ngâng hàng lên drop-down list
function DanhSachNganHang() {
    $.ajax({
        url: '/CongTienKhachHang/GetListBank',
        async: false,
        data: {},
        type: "post",
        dataType:"json",
        success: function (data) {
            var cbboxlgt = $('#optNganHang');
            $(cbboxlgt).empty();
            $(cbboxlgt).append('<option value=\"0\">Vui lòng chọn ngân hàng</option>');
            if (data != "false") {
                $.each(data, function (key, val) {
                    opt = $('<option></option>');
                    $(cbboxlgt).append(opt);
                    $(opt).val(val.ID);
                    $(opt).text(val.Description);
                });
            }
        }
    });
}

// Validate data: Kiểm tra tính hợp lệ của dũ liệu
function ValidateData() {
    var flag = true;

    // Validate ngân hàng
    var nganHang = $("#optNganHang option").filter(":selected").val()
    if ($.trim(nganHang) == 0) {
        $($('#optNganHang')).tooltip('hide').attr('data-original-title', 'Vui lòng nhập chọn ngân hàng').tooltip('fixTitle').addClass('errorClass');
        flag = false;
    } else {
        $('#optNganHang').data("title", "").removeClass("errorClass").tooltip("destroy");
        //flag = true;
    }

    // Validate số tiền
    var sotien = $('#txtSoTien').val().replace(/,/g, '');
    if ($.trim(sotien) == '') {
        $($('#txtSoTien')).tooltip('hide').attr('data-original-title', 'Vui lòng nhập vào số tiền').tooltip('fixTitle').addClass('errorClass');
        flag = false;
    } else {
        //sotien % 1000 == 0 && 
        if (sotien > 1000 && sotien <= 100000000) {
            $('#txtSoTien').data("title", "").removeClass("errorClass").tooltip("destroy");
            //flag = true;
        }
        else {
            $($('#txtSoTien')).tooltip('hide').attr('data-original-title', 'Số tiền bạn nhập vào không hợp lệ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }
    }

    // Validate nội dung
    var noiDung = $("#txaNoiDung").val()
    if ($.trim(noiDung) == "") {
        $($('#txaNoiDung')).tooltip('hide').attr('data-original-title', 'Vui lòng nhập nội dung').tooltip('fixTitle').addClass('errorClass');
        flag = false;
    } else {
        $('#txaNoiDung').data("title", "").removeClass("errorClass").tooltip("destroy");
        //flag = true;
    }

    
    return flag;
}

// Remove Tooltip: loại bỏ tooltip
function RemoveToolTip() {
    $('#optNganHang').data("title", "").removeClass("errorClass").tooltip("destroy");
    $('#txtSoTien').data("title", "").removeClass("errorClass").tooltip("destroy");
}


// Lấy ra danh sách lệnh
function DanhSachLenh(userId) {
    $.ajax({
        url: '/CongTienKhachHang/DanhSachLenh',
        data: { userId: userId },
        dataType: 'json',
        type: "post",
        success: function (data) {
            loadDataLenh(data);
        }
    });
}
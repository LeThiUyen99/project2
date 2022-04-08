
// Quản lý tài khoản admin
var Sanluongtaikhoan = function () {
    var self = this;

    // Hàm khởi tạo
   
        // Sự kiện khi nhận nhiều lệnh
        $("#btnTimKiem").click(function () {
            Busy.Block();
            $.ajax(
              {
                  type: "POST",
                  url: "/AdminFun/GetData",
                  data: { email: $('#txtfinKey').val().trim()},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.success == true) {
                          $('.sotienkhadung').text(reponse.khadung);
                          $('.sotiendongbang').text(reponse.dongbang);
                          $('.tongthe').text(reponse.gachthe);
                          $('.tongapi').text(reponse.gachtheapi);
                      }
                      
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
            $.unblockUI();
        });


    

}
var QuanLyTaiKhoan = function () {
    var self = this;

    // Hàm khởi tạo
    self.initQuanLyTaiKhoan = function () {
        $("#txtfinKey").val("");
      
        self.QuanLyTaiKhoanTable();
        self.QuanLyTaiKhoanFunction();
      
    }

    // Hàm chức năng
    self.QuanLyTaiKhoanFunction = function () {

       

        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblKichHoatTaiKhoanNguoiDung");
           
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.QuanLyTaiKhoanTable = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblKichHoatTaiKhoanNguoiDung').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                        {
                            "name": "findKey",
                            "value": $("#txtfinKey").val().trim()
                        }
                       
                    )
            },
            //"bFilter": false,
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            //"sDom": 'it<pl>',
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": Config.AppUrl + 'AdminFun/GetAllUser',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Name" },
            { "mData": "UserName" },
            { "mData": "Phone", "class": "dt-center" },
            { "mData": "strCreateDate", "class": "dt-center" },
            { "mData": "strStatus", className: "dt-body-center" },
            {
                mData: "UserId",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a title='Hủy kích hoạt tài khoản' data-id='" + o + "' class='_HuyKichHoatTaiKhoan btn-warning btn-xs' data-title='Hủy kích hoạt tài khoản'><i style='color:red' class='fa fa-recycle'></i></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Kích hoạt tài khoản' data-id='" + o + "' class='_KichHoatTaiKhoan btn-success btn-xs' data-title='Kích hoạt tài khoản'><i class='fa fa-check-square-o'></i></i></a>" +
                        "</span>";
                }
            }
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
        $('#tblKichHoatTaiKhoanNguoiDung').on('click', 'a._HuyKichHoatTaiKhoan', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn hủy kích hoạt người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'AdminFun/mokhoanguoidung',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "huy" },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblKichHoatTaiKhoanNguoiDung');
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Cập nhật trạng thái người dùng thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                            else {
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });

        // Sự kiện khi click vào hủy kích hoạt tài khoản người dùng
        $('#tblKichHoatTaiKhoanNguoiDung').on('click', 'a._KichHoatTaiKhoan', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn kích hoạt tài khoản người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'AdminFun/mokhoanguoidung',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "khoa" },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblKichHoatTaiKhoanNguoiDung');
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Cập nhật trạng thái người dùng thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                            else if (data == "error") {
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });

    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Đếm số tài khoản
  
}
var QuanLyTaiKhoanAPI = function () {
    var self = this;

    // Hàm khởi tạo
    self.initQuanLyTaiKhoanAPI = function () {
        $("#txtfinKeyapi").val("");

        self.QuanLyTaiKhoanTableapi();
        self.QuanLyTaiKhoanFunctionapi();

    }

    // Hàm chức năng
    self.QuanLyTaiKhoanFunctionapi = function () {



        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiemapi").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblKichHoatTaiKhoanNguoiDungapi");

            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.QuanLyTaiKhoanTableapi = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblKichHoatTaiKhoanNguoiDungapi').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                        {
                            "name": "findKey",
                            "value": $("#txtfinKeyapi").val().trim()
                        }

                    )
            },
            //"bFilter": false,
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            //"sDom": 'it<pl>',
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": Config.AppUrl + 'AdminFun/GetAllUserapi',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Name" },
            { "mData": "Address" },
            { "mData": "UserName", "class": "dt-center" },
            
            { "mData": "strStatus", className: "dt-body-center" },
            {
                mData: "UserId",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a title='Hủy kích hoạt tài khoản' data-id='" + o + "' class='_huykichhoatapi btn-warning btn-xs' data-title='Hủy kích hoạt tài khoản'><i style='color:red' class='fa fa-recycle'></i></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Kích hoạt tài khoản' data-id='" + o + "' class='_kichhoatapi btn-success btn-xs' data-title='Kích hoạt tài khoản'><i class='fa fa-check-square-o'></i></i></a>" +
                        "</span>";
                }
            }
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
        $('#tblKichHoatTaiKhoanNguoiDungapi').on('click', 'a._huykichhoatapi', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn hủy kích hoạt người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'AdminFun/mokhoanguoidungapi',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "huy" },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblKichHoatTaiKhoanNguoiDungapi');
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Cập nhật trạng thái người dùng thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                            else {
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });

        // Sự kiện khi click vào hủy kích hoạt tài khoản người dùng
        $('#tblKichHoatTaiKhoanNguoiDungapi').on('click', 'a._kichhoatapi', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn kích hoạt tài khoản người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'AdminFun/mokhoanguoidungapi',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "khoa" },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblKichHoatTaiKhoanNguoiDungapi');
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Cập nhật trạng thái người dùng thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                            else if (data == "error") {
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });

    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Đếm số tài khoản

}
var QuanLyMuaBank = function () {
    var self = this;

    // Hàm khởi tạo
    self.initQuanLyMuaBank = function () {
        $("#txtfinKeyapi").val("");

        self.QuanLyMuaBankTable();
        self.QuanLyMuaBankFunction();

    }

    // Hàm chức năng
    self.QuanLyMuaBankFunction = function () {



        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiemapi").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblKichHoatTaiKhoanNguoiDungapi");

            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.QuanLyMuaBankTable = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblKichHoatTaiKhoanNguoiDungapi').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                        {
                            "name": "findKey",
                            "value": $("#txtfinKeyapi").val().trim()
                        }

                    )
            },
            //"bFilter": false,
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            //"sDom": 'it<pl>',
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": Config.AppUrl + 'AdminFun/GetAllVnpayment',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "RspCode" },
            { "mData": "Amount" },
            { "mData": "CreateMail", "class": "dt-center" },
            { "mData": "IsComfirm", className: "dt-body-center" },
            { "mData": "AdditionalInfo", className: "dt-body-center" },
            { "mData": "Signature", className: "dt-body-center" }
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

      
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Đếm số tài khoản

}
var QuanLyTaiDichVu = function () {
    var self = this;

    // Hàm khởi tạo
    self.initQuanLyTaiDichVu = function () {
        $("#txtfinKeyapi").val("");

        self.QuanLyDichvu();
        self.QuanLydichvufun();

    }

    // Hàm chức năng
    self.QuanLydichvufun = function () {



        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiemapi").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblkhoadichvu");

            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.QuanLyDichvu = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblkhoadichvu').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                        {
                            "name": "findKey",
                            "value": $("#txtfinKeyapi").val().trim()
                        }

                    )
            },
            //"bFilter": false,
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            //"sDom": 'it<pl>',
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": Config.AppUrl + 'AdminFun/GetAllDichVu',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Name" },
            { "mData": "Code" },
            { "mData": "strStatus", "class": "dt-center" },
            { "mData": "strStartDate", className: "dt-body-center" },
            { "mData": "strEndDate", className: "dt-body-center" },
            {
                mData: "Id",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a title='Hủy kích hoạt tài khoản' data-id='" + o + "' class='_huykichhoatdv btn-warning btn-xs' data-title='Hủy kích hoạt tài khoản'><i style='color:red' class='fa fa-recycle'></i></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Kích hoạt tài khoản' data-id='" + o + "' class='_kichhoatdv btn-success btn-xs' data-title='Kích hoạt tài khoản'><i class='fa fa-check-square-o'></i></i></a>" +
                        "</span>";
                }
            }
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
        $('#tblkhoadichvu').on('click', 'a._huykichhoatdv', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn hủy kích hoạt người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'AdminFun/mokhoadichvu',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "huy" },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblkhoadichvu');
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Cập nhật trạng thái người dùng thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                            else {
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });

        // Sự kiện khi click vào hủy kích hoạt tài khoản người dùng
        $('#tblkhoadichvu').on('click', 'a._kichhoatdv', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn kích hoạt tài khoản người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'AdminFun/mokhoadichvu',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "khoa" },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblkhoadichvu');
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Cập nhật trạng thái người dùng thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                            else if (data == "error") {
                                $.gritter.add({ title: "đổi thẻ 24/7", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });

    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Đếm số tài khoản

}



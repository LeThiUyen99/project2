

// Quản lý tài khoản người dùng
var QuanLyTaiKhoanNguoiDung = function () {
    var self = this;

    // Hàm khởi tạo
    self.initQuanLyTaiKhoanNguoiDung = function () {
        $("#txtfinKey").val("");
        $("#txtStart").val("");
        $("#txtEnd").val("");
        $("#optTrangThai").val(-1);
        self.QuanLyTaiKhoanNguoiDungTable();
        self.QuanLyTaiKhoanNguoiDungFunction();
        self.TotalAccount();
    }

    // Hàm chức năng
    self.QuanLyTaiKhoanNguoiDungFunction = function () {

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
            self.RefreshTableUser("#tblKichHoatTaiKhoanNguoiDung");
            self.TotalAccount();
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.QuanLyTaiKhoanNguoiDungTable = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblKichHoatTaiKhoanNguoiDung').DataTable({
            "bDestroy": true,
            //"fnServerParams": function (aoData) {
               // aoData.push(
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
            //"bFilter": false,
            "ajax": {
                "url": "/QuanLyTaiKhoan/GetData",
                "type": "GET",
                "datatype": "json",
                'data': function (d) {                 	
                    d.findKey = $("#txtfinKey").val().trim(); 
                    d.tuNgay = $("#txtStart").val().trim();   
                    d.denNgay = $("#txtEnd").val().trim();                  
                    d.trangThai=$("#optTrangThai option").filter(":selected").val();
                }
            },
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            //"sAjaxSource": '/QuanLyTaiKhoan/GetData',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Name" },
            { "mData": "UserName" },
            { "mData": "NameGroup" },
            { "mData": "Phone", "class": "dt-center" },
            { "mData": "StrCreateDate", "class": "dt-center" },
            { "mData": "StrStatus", className: "dt-body-center" },
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
                        url: '/QuanLyTaiKhoan/CapNhatTrangThaiTaiKhoanNguoiDung',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "huy" },
                        dataType: 'json',
                        type: "GET",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblKichHoatTaiKhoanNguoiDung');
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Cập nhật trạng thái người dùng thành công !", image: "/upload/success.png", class_name: "clean", time: "1500" });
                            }
                            else {
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/upload/success.png", class_name: "clean", time: "1500" });
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
                        url: '/QuanLyTaiKhoan/CapNhatTrangThaiTaiKhoanNguoiDung',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "kichHoat" },
                        dataType: 'json',
                        type: "GET",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblKichHoatTaiKhoanNguoiDung');
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Cập nhật trạng thái người dùng thành công !", image: "/upload/success.png", class_name: "clean", time: "1500" });
                            }
                            else if (data == "error") {
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/upload/success.png", class_name: "clean", time: "1500" });
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
    self.TotalAccount = function () {
        $.ajax({
            url: '/QuanLyTaiKhoan/GetData',
            type: 'GET',
            dataType:'json',
            data: {
                findKey : $("#txtfinKey").val().trim(),
                tuNgay : $("#txtStart").val().trim(), 
                denNgay : $("#txtEnd").val().trim(),                 
                trangThai:$("#optTrangThai option").filter(":selected").val()
            },
            success: function (data) {
                $("#totalAccount").text(data.tongTaiKhoan);
            }
        });
    }

}


// Quản lý tài khoản admin
var QuanLyTaiKhoanAdmin = function () {
    var self = this;

    // Hàm khởi tạo
    self.initQuanLyTaiKhoanAdmin = function () {
        self.QuanLyTaiKhoanAdminTable();
        self.QuanLyTaiKhoanAdminFunction();
    }

    // Hàm chức năng
    self.QuanLyTaiKhoanAdminFunction = function () {
        // Sự kiện khi nhận nhiều lệnh
        $("#btnThemTaiKhoan").click(function () {
            $("#lblUserId").text("0");
            $("#txtMa").val("");
            $("#txtTenDangNhap").val("");
            $("#txtMatKhau").val("");
            $("#lblMatKhau").text("");
            $("#txtHoVaTen").val("");
            $("#optNhom").val(0);
            $("#txtGhiChu").val("");
            $("#chkTrangThai").prop('checked', 1);
            $("#modalChuyenLenh").modal('show');
        });

        // Sự kiện khi click button lưu
        $("#btnSave").click(function () {
            var _id = $("#lblUserId").text();
            var _ma = $("#txtMa").val();
            var _tenDangNhap = $("#txtTenDangNhap").val();
            var _matKhau = $("#txtMatKhau").val();
            var _lblMatKhau = $("#lblMatKhau").text();
            var _hoVaTen = $("#txtHoVaTen").val();
            var _nhom = $("#optNhom option").filter(":selected").val();
            var _status = $("#chkTrangThai").is(":checked") ? 1 : 0;
            var _ghiChu = $("#txtGhiChu").val();
            $.ajax({
                url: Config.AppUrl + 'QuanLyTaiKhoanAdmin/CapNhatTaiKhoan',
                type: "post",
                dataType: 'json',
                data: {
                    id: _id, ma: _ma, tenDangNhap: _tenDangNhap,
                    matKhau: _matKhau, lblMatKhau: _lblMatKhau,
                    hoVaTen: _hoVaTen, nhom: _nhom, status: _status,
                    ghiChu: _ghiChu
                },
                success: function (data) {
                    $.gritter.add({ title: "Bán thẻ 24h", text: "Cập nhật tài khoản thành viên thành công!", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                    $("#modalChuyenLenh").modal('hide');
                    self.RefreshTableUser("#tblAccountAdmin");
                }
            });
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.QuanLyTaiKhoanAdminTable = function () {
        //Load Email: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblAccountAdmin').DataTable({
            "bDestroy": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 50,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": Config.AppUrl + 'QuanLyTaiKhoanAdmin/GetData',
            "lengthMenu": [50, 100, 200, 500, 1000],
            "aoColumns": [
            { "mData": "UserNameCode" },
            { "mData": "UserName" },
            { "mData": "FullName" },
            { "mData": "strGroupId", "class": "dt-center" },
            { "mData": "Note" },
            { "mData": "strStatus", "class": "dt-center" },
            {
                mData: "UserId",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a style='padding:5px' title='Chi tiết lịch sử thao tác' data-id='" + o + "' class='_capNhat btn-success' data-title='Chi tiết lịch sử thao tác'><i class='fa fa-eye-slash'></i></a>" +
                        "</span>";
                }
            }
            ],
            "order": [0, 'desc'],
            "rowCallback": function (row, data, dataIndex) {
            },
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

        // Sự kiện khi click vào cập nhật trạng thái
        $('#tblAccountAdmin').on('click', 'a._capNhat', function (e) {
            e.preventDefault();
            var id_trans = $(this).attr("data-id");
            $.ajax({
                url: Config.AppUrl + 'QuanLyTaiKhoanAdmin/ChiTietTaiKhoan',
                async: false,
                data: { id: id_trans },
                dataType: 'json',
                type: "post",
                success: function (data) {
                    $("#lblUserId").text(id_trans);
                    $("#txtMa").val(data.UserNameCode);
                    $("#txtTenDangNhap").val(data.UserName);
                    $("#txtMatKhau").val(data.Password);
                    $("#lblMatKhau").text(data.Password);
                    $("#txtHoVaTen").val(data.FullName);
                    $("#optNhom").val(data.GroupId);
                    $("#txtGhiChu").val(data.Note);
                    $("#chkTrangThai").prop("checked", data.Status);
                    $("#modalChuyenLenh").modal('show');
                },
                error: function () {
                    console.log("error");
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
}

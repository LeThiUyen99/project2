
var nganHang = 0;
var trangThai = -1;

// Quản lý duyệt cộng tiền
var QuanLyDuyetCongTienAdmin = function () {
    var self = this;
    DanhSachNganHang();
    $("#optNganHang").val(0);

    // Hàm khởi tạo
    self.initQuanLyDuyetCongTienAdmin = function () {
        $("#txtfinKey").val("");
        $("#txtStart").val("");
        $("#txtEnd").val("");
        $("#optTrangThai").val(-1);
        self.QuanLyDuyetCongTienAdminTable();
        self.QuanLyDuyetCongTienAdminFunction();
        self.TinhTien();
    }

    // Hàm chức năng
    self.QuanLyDuyetCongTienAdminFunction = function () {

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
            nganHang = $("#optNganHang option").filter(":selected").val();
            trangThai = $("#optTrangThai option").filter(":selected").val();
            self.RefreshTableUser("#tblQuanLyLenh");
            self.TinhTien();
            $.unblockUI();
        });

        // Xác nhận cộng tiền khách hàng
        $("#btnXacNhanCongTienKhachHang").click(function () {
            self.XacNhanCongTien();
        });

        // Xác nhận hủy cộng tiền
        $("#btnXacNhanHuyCongTienKhachHang").click(function () {
            if (ValidateData() == true) {
                self.XacNhanHuyCongTien();
            }
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.QuanLyDuyetCongTienAdminTable = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblQuanLyLenh').DataTable({
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
//                            "value": trangThai
//                        },
//                        {
//                            "name": "nganHang",
//                            "value": nganHang
//                        }
//                    )
//            },
             "ajax": {
                "url": "/QuanLyCongTienAdmin/QuanLyCongTien",
                "type": "POST",
                "datatype": "json",
                'data': function (d) {                 	
                    d.findKey = $("#txtfinKey").val().trim() ;
                    d.tuNgay =$("#txtStart").val().trim();    
                    d.denNgay=  $("#txtEnd").val().trim();         
                    d.trangThai=trangThai;
                    d.nganHang=nganHang
                }
            },
            //"bFilter": false,
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 50,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            //"sAjaxSource": '/QuanLyCongTienAdmin/QuanLyCongTien',
            "lengthMenu": [50, 100, 200, 500, 1000],
            "aoColumns": [
            { "mData": "Email" },
            { "mData": "TenNganHang" },
            { "mData": "strSoTien", "class": "dt-center" },
            { "mData": "NoiDung" },
            { "mData": "strThoiGianCapNhat", "class": "dt-center" },
            { "mData": "TenNguoiCapNhat" },
            { "mData": "strThoiGianDuyet", "class": "dt-center" },
            { "mData": "TenNguoiDuyet" },
            { "mData": "trangThai", className: "dt-body-center" },
            {
                mData: "CongTienId",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a title='Duyệt cộng tiền' data-id='" + o + "' class='_Duyet btn-success btn-xs' data-title='Duyệt cộng tiền'><i class='fa fa-check-square-o'></i> Duyệt</a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Hủy cộng tiền' data-id='" + o + "' class='_HuyDuyet btn-warning btn-xs' data-title='Hủy cộng tiền'><i style='color:red' class='fa fa-recycle'></i>Hủy</a>" +
                        "</span>";
                }
            }
            ],
            "order": [4, 'desc'],
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

        // Sự kiện khi click vào hủy duyệt
        $('#tblQuanLyLenh').on('click', 'a._HuyDuyet', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            $("#lblHuyCongTienId").text(id_TaiKhoan);
            $.ajax({
                url: '/QuanLyCongTienAdmin/ChiTietLenhCongTien',
                async: false,
                data: { idCongTien: id_TaiKhoan },
                dataType: 'json',
                type: "post",
                success: function (data) {
                    $("#txaHuyNoiDungCongTien").val("");
                    $("#txtHuyTkCongTien").val(data.TenNguoiCapNhat);
                    $("#txtHuyNganHang").val(data.TenNganHang);
                    $("#txtEmailHuyCongTien").val(data.Email);
                    $("#txtSoDienThoaiHuyCongTien").val(data.SoDienThoai);
                    $("#txtThoiGianHuyCongTien").val(data.strThoiGianCapNhat);
                    $("#txtSoTienHuyCongTien").val(data.SoTien.toLocaleString('en-US', { minimumFractionDigits: 0 }));
                    if (data.TrangThaiDuyet == 0) {
                        $("#btnXacNhanHuyCongTienKhachHang").prop('disabled', false);
                    }
                    else {
                        $("#btnXacNhanHuyCongTienKhachHang").prop('disabled', true);
                    }
                    $("#modalXacNhanHuyCongTienTK").modal("show");
                }
            });

        });

        // Sự kiện khi click vào duyệt chuyển tiền
        $('#tblQuanLyLenh').on('click', 'a._Duyet', function (e) {
            e.preventDefault();
            var id_Lenh = $(this).attr("data-id");
            $.ajax({
                url: '/QuanLyCongTienAdmin/ChiTietLenhCongTien',
                async: false,
                data: { idCongTien: id_Lenh },
                dataType: 'json',
                type: "post",
                success: function (data) {
                    $("#lblCongTienId").text(data.CongTienId);
                    $("#lblHoTenKH").text(data.HoTen);
                    $("#lblUserIdKhachHang").text();
                    $("#lblTenDangNhap").text(data.Email);
                    $("#lblSoDienThoai").text(data.SoDienThoai);
                    $("#txtNganHang").val(data.TenNganHang);
                    $("#txtSoTien").val(data.SoTien.toLocaleString('en-US', { minimumFractionDigits: 0 }));
                    $("#txaNoiDung").val(data.NoiDung);
                    $("#txtTkCongTien").val(data.TenNguoiCapNhat);
                    $("#txtThoiGian").val(data.strThoiGianCapNhat);
                    if (data.TrangThaiDuyet == 0) {
                        $("#btnXacNhanCongTienKhachHang").prop('disabled', false);
                    }
                    else {
                        $("#btnXacNhanCongTienKhachHang").prop('disabled', true);
                    }
                    $("#modalXacNhanCongTienTK").modal("show");
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
    self.TinhTien = function () {
        $.ajax({
            url: '/QuanLyCongTienAdmin/SumQuanLyCongTien',
            type: 'POST',
            dataType:'json',
            data: {
                findKey: $("#txtfinKey").val().trim(),
                tuNgay: $("#txtStart").val().trim(),
                denNgay: $("#txtEnd").val().trim(),
                trangThai: trangThai,
                nganHang: nganHang
            },
            success: function (data) {
                $("#tongTien").text(data.tongTien);
                $("#tienDaDuyet").text(data.daDuyet);
                $("#tienChuaDuyet").text(data.chuaDuyet);
                $("#tienDaHuy").text(data.daHuy);
            }
        });
    }

    // Xác nhận cộng tiền
    self.XacNhanCongTien = function () {
        bootbox.confirm("Bạn có chắc chắn muốn duyệt lệnh cộng tiền này?", function (result) {
            if (result == true) {
                $.ajax({
                    url: '/QuanLyCongTienAdmin/CapNhatTrangThai',
                    async: false,
                    data: { id: $("#lblCongTienId").text() },
                    dataType: 'json',
                    type: "post",
                    success: function (data) {
                        if (data.success == true) {
                            $("#modalXacNhanCongTienTK").modal("hide");
                            self.RefreshTableUser('#tblQuanLyLenh');
                            self.TinhTien();
                            $.gritter.add({ title: "Doi The 66", text: "Xác nhận cộng tiền thành công !", image: "/upload/success.png", class_name: "clean", time: "1500" });
                        }else{
                             $("#modalXacNhanCongTienTK").modal("hide");
                            self.RefreshTableUser('#tblQuanLyLenh');
                        }
                    }
                });
            }
        });
    }

    // Xác nhận hủy cộng tiền
    self.XacNhanHuyCongTien = function () {
        bootbox.confirm("Bạn có chắc chắn muốn hủy duyệt lệnh vừa chọn?", function (result) {
            if (result == true) {
                $.ajax({
                    url: '/QuanLyCongTienAdmin/HuyCongTien',
                    async: false,
                    data: { id: $("#lblHuyCongTienId").text(), noiDung: $("#txaHuyNoiDungCongTien").val() },
                    dataType: 'json',
                    type: "post",
                    success: function (data) {
                        if (data.success == true) {
                            $("#modalXacNhanHuyCongTienTK").modal("hide");
                            self.RefreshTableUser('#tblQuanLyLenh');
                            self.TinhTien();
                            $.gritter.add({ title: "Doi the 66", text: "Xác nhận hủy cộng tiền thành công !", image: "/upload/success.png", class_name: "clean", time: "1500" });
                        }else{
                             $("#modalXacNhanHuyCongTienTK").modal("hide");
                            self.RefreshTableUser('#tblQuanLyLenh');
                            self.TinhTien();
                        }
                    }
                });
            }
        });
    }
}

// gọi danh sách ngâng hàng lên drop-down list
function DanhSachNganHang() {
    $.ajax({
        url: '/CongTienKhachHang/GetListBank',
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

    // Validate nội dung
    var noiDung = $("#txaHuyNoiDungCongTien").val()
    if ($.trim(noiDung) == "") {
        $($('#txaHuyNoiDungCongTien')).tooltip('hide').attr('data-original-title', 'Vui lòng nhập nội dung').tooltip('fixTitle').addClass('errorClass');
        flag = false;
    } else {
        $('#txaHuyNoiDungCongTien').data("title", "").removeClass("errorClass").tooltip("destroy");
        flag = true;
    }

    if (flag == false) {
        return;
    }
    return flag;
}
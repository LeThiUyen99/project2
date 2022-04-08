

var rows_selected = [];
var trangThai = 0;
var tuNgay = "";
var denNgay = "";
var nganHang = "";
var findKey = "";
var nguonVao = 0;
var nguoiChuyen = 0;
var sotien = 0;
// Quản lý đội chuyển tiền
var QuanLyDoiChuyenTien = function () {
    var self = this;
    //$('#btnHoanTatNhieuLenh').attr("disabled", "disabled");

    // Hàm khởi tạo
    self.initDoiChuyenTien = function () {

        $("#optTrangThai").val(0);
        $("#txtTuNgay").val("");
        $("#txtDenNgay").val("");
        $("#optNganHang").val("");
        $("#txtFindKey").val("");
        $("#optNguoiChuyenTien").val(0);
        $("#optNguonVao").val(0);
        $("#optsotien").val(0);
        self.DanhSachNganHang();
        self.DanhSachNguoiChuyenTien();
        self.TotalMoney();
        self.DoiChuyenTienTable();
        self.DoiChuyenTienFunction();
        // Sự kiện lấy lịch
        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'YYYY-MM-DD HH:mm'
        });

        // Sự kiện khi người dùng nhập vào số tiền
        //$('#txtSoTien').keyup(function (e) {
        //    this.value = this.value.replace(/[^\-0-9]/g, '');
        //    if (this.value != "") {
        //        var n = parseInt($(this).val());
        //        $(this).val(n.toLocaleString('en-US', { minimumFractionDigits: 0 }));
        //    }
        //});

        // Sự kiện khi người dùng nhập vào textbox mã lệnh cần chuyển
        $('#txtMaLenh').keyup(function (e) {
            this.value = this.value.replace(/[^\-0-9]/g, '');
            if (this.value != "") {
                var n = parseInt($(this).val());
            }
        });

    }

    // Hàm chức năng
    self.DoiChuyenTienFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            trangThai = $("#optTrangThai option").filter(":selected").val();
            tuNgay = $("#txtTuNgay").val().trim();
            denNgay = $("#txtDenNgay").val().trim();
            nganHang = $("#optNganHang option").filter(":selected").val();
            findKey = $("#txtFindKey").val().trim();
            nguoiChuyen = $("#optNguoiChuyenTien option").filter(":selected").val();
            nguonVao = $("#optNguonVao option").filter(":selected").val();
            sotien = $("#optsotien option").filter(":selected").val();
            self.TotalMoney();
            self.RefreshTableUser("#tblDoiChuyenTien");
            $.unblockUI();
        });

        // sự kiện khi click xuất excel
        $("#btnXuatExcel").click(function () {
            bootbox.confirm("Bạn có chắc chắn muốn xuất excel?", function (result) {
                if (result == true) {
                    Busy.Block();
                    $.ajax({
                        url: '/KeToanChuyenTien/XuatExcel',
                        beforeSend: function () {
                            Busy.Block();
                        },
                        async: false,
                        data: {
                            trangThai: $("#optTrangThai option").filter(":selected").val(),
                            tuNgay: $("#txtTuNgay").val().trim(),
                            denNgay: $("#txtDenNgay").val().trim(),
                            nganHang: $("#optNganHang option").filter(":selected").val(),
                            findKey: $("#txtFindKey").val().trim(),
                            nguoiChuyen: $("#optNguoiChuyenTien option").filter(":selected").val(),
                            nguonVao: $("#optNguonVao option").filter(":selected").val()
                        },
                        type: "get",
                        success: function (data) {
                            $.gritter.add({ title: "Kế toán Hưng hà", text: "Xuất excel thành công", image: "/upload/success.png", class_name: "clean", time: "1500" });
                        },
                        error: function (obj) {
                            alert("Có lỗi xảy ra trong quá trình thực hiện xuất excel");
                        },
                        complete: function () {
                            $.unblockUI();
                        }
                    });
                }
            });
        });

        // Sự kiện khi nhận nhiều lệnh
        $("#btnNhanNhieuLenh").click(function () {
            if (rows_selected.length > 0) {
                self.NhanNhieuLenh();
            }
            else {
                $.gritter.add({ title: "Kế toán Hưng hà", text: "Vui lòng chọn lệnh cần nhận", image: "/upload/success.png", class_name: "clean", time: "1500" });
            }
        });
        $("#btnCancelCashout").click(function () {
            if (rows_selected.length > 0) {
                self.CancelCashOutLog();
            }
            else {
                $.gritter.add({ title: "Kế toán Hưng hà", text: "Vui lòng chọn lệnh cần hủy", image: "/upload/success.png", class_name: "clean", time: "1500" });
            }
        });
        // Sự kiện khi hoàn thành nhiều lệnh
        $("#btnHoanTatNhieuLenh").click(function () {
            if (rows_selected.length > 0) {
                self.HoanThanhNhieuLenh();
            }
            else {
                $.gritter.add({ title: "Kế toán Hưng hà", text: "Vui lòng chọn lệnh cần hoàn thành", image: "/upload/success.png", class_name: "clean", time: "1500" });
            }
        });

        // Sự kiện chuyển người nhận lệnh
        $("#btnChuyenLenh").click(function () {
            $("#txtMaLenh").val("");
            self.DanhSachNguoiNhanLenh();
            $("#optNguoiNhanLenh").val(0);
            $("#thongBaoChuyenNguoiNhanLenh").text("");
            $("#thongBaoChuyenNguoiNhanLenh").hide();
            $("#modalChuyenLenh").modal("show");
        });

        // Sự kiện khi người dùng xác nhận chuyển người nhận lệnh
        $("#btnXacNhanChuyenLenh").click(function () {
            self.ChuyenNguoiNhanLenh();
        });

    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.DoiChuyenTienTable = function () {
        //Load Email: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblDoiChuyenTien').DataTable({
            "bDestroy": true,
            "autoWidth": false,
            //"fnServerParams": function (aoData) {
//                aoData.push(
//                    {
//                        "name": "trangThai",
//                        "value": trangThai
//                    },
//                    {
//                        "name": "tuNgay",
//                        "value": tuNgay
//                    },
//                    {
//                        "name": "denNgay",
//                        "value": denNgay
//                    },
//                    {
//                        "name": "nganHang",
//                        "value": nganHang
//                    },
//                    {
//                        "name": "findKey",
//                        "value": findKey
//                    },
//                    {
//                        "name": "nguoiChuyen",
//                        "value": nguoiChuyen
//                    },
//                    {
//                            "name": "sotien",
//                            "value": sotien
//                     }
//                )
//            },
            "ajax": {
                "url": "/KeToanChuyenTien/GetListCashOutLog",
                "type": "POST",
                "datatype": "json",
                'data': function (d) {                 	
                    d.trangThai = trangThai;                                     
                    d.tuNgay=tuNgay;
                    d.denNgay = denNgay;                                     
                    d.nganHang=nganHang;
                    d.findKey = findKey;                                     
                    d.nguoiChuyen=nguoiChuyen;
                    d.sotien=sotien;
                }
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 100,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            //"sAjaxSource": '/KeToanChuyenTien/GetListCashOutLog',
            "lengthMenu": [100, 200, 500, 1000, 2000],
            "aoColumns": [
            {
                mData: "Id",
                //targets: 0,
                'width': '10px',
                searchable: false,
                orderable: false,
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<input type="checkbox" class="editor-active">';
                    }
                    return data;
                },
                className: "dt-body-center"
            },
            { "mData": "strId", className: "dt-center" },
            { "mData": "UserName" },
            { "mData": "Phone" },
            { "mData": "BankAccount" },
            { "mData": "BankNumber", "class": "dt-center" },
            { "mData": "BankCode" },
            { "mData": "BankBrand" },
            { "mData": "StrAmount", "class": "dt-center" },
            { "mData": "BankingFee", "class": "dt-center" },
            { "mData": "StrCreateDate" },
            { "mData": "StrUpdateDate", "class": "dt-center" },
            { "mData": "chucNang", "class": "dt-center" },
            { "mData": "UpdateUserName" }
            ],
            "order": [10, 'desc'],
            "rowCallback": function (row, data, dataIndex) {
                var rowStatus = data["Status"];
                var rowIsDelete = data["IsDelete"];
                if (rowStatus == 1) {
                    $('td', row).css('background-color', '#c7edfc');
                }
                else if (rowStatus == 2) {
                    $('td', row).css('background-color', '#ffffff');
                }
                else if (rowStatus == 3) {
                    $('td', row).css('background-color', '#f0f4f8');
                }
                if (rowIsDelete > 1) {
                    $('td', row).css('background-color', '#E9D460');
                }
                // Get row ID
                var rowId = data["Id"];
                // If row ID is in the list of selected row IDs
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
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

        // Khi người dùng click checkbox Select_all_user trên thead
        //$('#tblDoiChuyenTien input[name="luaChonNhieuEmail"]').on('click', function (e) {
        //    if (this.checked) {
        //        $('#tblDoiChuyenTien tbody input[type="checkbox"]:not(:checked)').trigger('click');
        //    } else {
        //        $('#tblDoiChuyenTien tbody input[type="checkbox"]:checked').trigger('click');
        //    }
        //    e.stopPropagation();
        //});

        //// Handle click on checkbox: khi người dùng click vào checkbox trên tbody
        $('#tblDoiChuyenTien tbody').on('click', 'input[type="checkbox"]', function (e) {
            var $row = $(this).closest('tr');
            // Get row data: lấy dữ liệu trên row
            var data = dTable.row($row).data();
            // Get row ID: lấy Id của bản ghi lựa chọn
            var rowId = data["Id"];

            // Determine whether row ID is in the list of selected row IDs: xác định vị trí của bản ghi trong mảng
            var index = $.inArray(rowId, rows_selected);

            // If checkbox is checked and row ID is not in list of selected row IDs: Kiểm tra checkbox có được tích hay không
            // Nếu tích thì đẩy vào mảng
            if (this.checked && index === -1) {
                rows_selected.push(rowId);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                // Nếu không tích thì loại bỏ khỏi mảng
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            // Add class selected for row selected: thêm class selected cho dòng được lựa chọn
            // opposite discard: Ngược lại loại bỏ
            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            // Check length array: Kiểm tra mảng lưu trữ bản ghi lựa chọn để được xóa
            //if (rows_selected.length > 0) {
            //    $('#btnXoa').removeAttr("disabled");
            //} else {
            //    $('#btnXoa').attr("disabled", "disabled");
            //}
            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Sự kiện khi click vào cập nhật trạng thái
        $('#tblDoiChuyenTien').on('click', 'a._capNhatTrangThai', function (e) {
            e.preventDefault();
            var id_trans = $(this).attr("data-id");
            trangThai = $("#optTrangThai option").filter(":selected").val();
            tuNgay = $("#txtTuNgay").val().trim();
            denNgay = $("#txtDenNgay").val().trim();
            nganHang = $("#optNganHang option").filter(":selected").val();
            findKey = $("#txtFindKey").val().trim();
            nguoiChuyen = $("#optNguoiChuyenTien option").filter(":selected").val();
            nguonVao: $("#optNguonVao option").filter(":selected").val();
            bootbox.confirm("Bạn có chắc chắn muốn cập nhật giao dịch vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: '/KeToanChuyenTien/UpdateTrans',
                        async: false,
                        data: { id: id_trans },
                        dataType: 'json',
                        type: "post",
                        beforeSend: function () {
                            Busy.Block();
                        },
                        success: function (data) {
                            if (data.Status == "success") {
                                //$.gritter.add({ title: "Kế toán Hưng hà", text: data.message, image: "/uploads/success.png", class_name: "clean", time: "1500" });
                                self.RefreshTableUser('#tblDoiChuyenTien');
                                self.TotalMoney();
                            }
                            else {
                                //$.gritter.add({ title: "Kế toán Hưng hà", text: data.message, image: "/uploads/success.png", class_name: "clean", time: "1500" });
                                self.RefreshTableUser('#tblDoiChuyenTien');
                                self.TotalMoney();
                            }
                        },
                        complete: function () {
                            $.unblockUI();
                        },
                        error: function () {
                            //$.gritter.add({ title: "Kế toán Hưng hà", text: data.message, image: "/uploads/success.png", class_name: "clean", time: "1500" });
                            self.RefreshTableUser('#tblDoiChuyenTien');
                            self.TotalMoney();
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

    // gọi danh sách ngâng hàng lên drop-down list
    self.DanhSachNganHang = function () {
        $.ajax({
            url: '/CongTienKhachHang/GetListBank',
            async: false,
            data: {},
            type: "post",
            dataType:"json",
            success: function (data) {
                var cbboxlgt = $('#optNganHang');
                $(cbboxlgt).empty();
                $(cbboxlgt).append('<option value=\"\">Vui lòng chọn ngân hàng</option>');
                if (data != "false") {
                    $.each(data, function (key, val) {
                        opt = $('<option></option>');
                        $(cbboxlgt).append(opt);
                        $(opt).val(val.Name);
                        $(opt).text(val.Description);
                    });
                }
            }
        });
    }

    // Gọi ra danh sách đội chuyển tiền
    self.DanhSachNguoiChuyenTien = function () {
        $.ajax({
            url: '/KeToanChuyenTien/GetListTranfMoney',
            async: false,
            data: {},
            type: "post",
            dataType:'json',
            success: function (data) {
                var cbboxlgt = $('#optNguoiChuyenTien');
                $(cbboxlgt).empty();
                $(cbboxlgt).append('<option value=\"0\">Vui lòng chọn người chuyển tiền</option>');
                if (data != "false") {
                    $.each(data, function (key, val) {
                        opt = $('<option></option>');
                        $(cbboxlgt).append(opt);
                        $(opt).val(val.UserId);
                        $(opt).text(val.FullName);
                    });
                }
            }
        });
    }

    // Gọi ra danh sách người nhận lệnh chuyển tiền
    self.DanhSachNguoiNhanLenh = function () {
        $.ajax({
            url: '/KeToanChuyenTien/GetListTranfMoney',
            async: false,
            data: {},
            type: "get",
            success: function (data) {
                var cbboxlgt = $('#optNguoiNhanLenh');
                $(cbboxlgt).empty();
                $(cbboxlgt).append('<option value=\"0\">Vui lòng chọn người nhận lệnh</option>');
                if (data != "false") {
                    $.each(data, function (key, val) {
                        opt = $('<option></option>');
                        $(cbboxlgt).append(opt);
                        $(opt).val(val.UserId);
                        $(opt).text(val.FullName);
                    });
                }
            }
        });
    }

    // Tính tổng số tiền
    self.TotalMoney = function () {
        $.ajax({
            url: '/KeToanChuyenTien/GetListCashOutLog',
            type: 'POST',
            dataType:'json',
            data: {
                trangThai: $("#optTrangThai option").filter(":selected").val(),
                tuNgay: $("#txtTuNgay").val().trim(),
                denNgay: $("#txtDenNgay").val().trim(),
                nganHang: $("#optNganHang option").filter(":selected").val(),
                findKey: $("#txtFindKey").val().trim(),
                nguoiChuyen: $("#optNguoiChuyenTien option").filter(":selected").val(),
                nguonVao: $("#optNguonVao option").filter(":selected").val(),
                sotien:  $("#optsotien option").filter(":selected").val()
            },
            success: function (data) {
                $("#totalMoney").text(data.tongTien);
                $("#cashMoney").text(data.tongTienDaChuyen);
                $("#cashOutMoney").text(data.tongTienChuaChuyen);
                $("#lblTongLenh").text(data.tongLenh);
                $("#lblTongLenhDaChuyen").text(data.lenhDaChuyen);
                $("#lblTongLenhChuaChuyen").text(data.lenhChuaChuyen);
            }
        });
    }

    // Phương thức nhận nhiều lệnh
    self.NhanNhieuLenh = function () {
        trangThai = $("#optTrangThai option").filter(":selected").val();
        tuNgay = $("#txtTuNgay").val().trim();
        denNgay = $("#txtDenNgay").val().trim();
        nganHang = $("#optNganHang option").filter(":selected").val();
        findKey = $("#txtFindKey").val().trim();
        nguoiChuyen = $("#optNguoiChuyenTien option").filter(":selected").val();
        nguonVao = $("#optNguonVao option").filter(":selected").val();
        bootbox.confirm("Bạn có chắc chắn muốn nhận những lệnh vừa chọn ?", function (result) {
            if (result == true) {
                $.ajax({
                    url: '/KeToanChuyenTien/NhanNhieuLenh',
                    data: { id: rows_selected.toString() },
                    type: "POST",
                    dataType:'json',
                    beforeSend: function () {
                        Busy.Block();
                    },
                    success: function (data) {
                        
                        rows_selected = [];
                        $('#luaChonNhieuLenh').prop('checked', false);
                        $('#tblDoiChuyenTien tbody input[type="checkbox"]').prop('checked', false);
                        if(data.Status=='success'){
                        
                        self.RefreshTableUser('#tblDoiChuyenTien');
                        self.TotalMoney();
                        $.gritter.add({ title: "Doithe66", text: data.msg, image: "/upload/success.png", class_name: "clean", time: "1000" });
                        }else{
                            $.gritter.add({ title: "Doithe66", text: data.msg, image: "/upload/success.png", class_name: "clean", time: "1000" });
                        }
                        // $.gritter.add({ title: "Kế toán Hưng hà", text: "Nhận nhiều lệnh thành công", image: "/uploads/success.png", class_name: "clean", time: "1000" });
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                    error: function () {
                        $.gritter.add({ title: "Kế toán Hưng hà", text: "Nhận nhiều lệnh thất bại", image: "/upload/success.png", class_name: "clean", time: "1000" });
                    }
                });
            }
        });
    }

    // Phương thức hoàn thành nhiều lệnh
    self.HoanThanhNhieuLenh = function () {
        trangThai = $("#optTrangThai option").filter(":selected").val();
        tuNgay = $("#txtTuNgay").val().trim();
        denNgay = $("#txtDenNgay").val().trim();
        nganHang = $("#optNganHang option").filter(":selected").val();
        findKey = $("#txtFindKey").val();
        nguoiChuyen = $("#optNguoiChuyenTien option").filter(":selected").val();
        nguonVao = $("#optNguonVao option").filter(":selected").val();
        bootbox.confirm("Bạn có chắc chắn muốn hoàn thành những lệnh vừa chọn?", function (result) {
            if (result == true) {
                $.ajax({
                    url: '/KeToanChuyenTien/HoanThanhNhieuLenh',
                    data: { id: rows_selected.toString() },
                    type: "POST",
                    dataType:'json',
                    beforeSend: function () {
                        Busy.Block();
                    },
                    success: function (data) {
                        rows_selected = [];
                        $('#luaChonNhieuLenh').prop('checked', false);
                        $('#tblDoiChuyenTien tbody input[type="checkbox"]').prop('checked', false);
                        if(data.Status=='success'){
                        self.RefreshTableUser('#tblDoiChuyenTien');
                        self.TotalMoney();
                            $.gritter.add({ title: "Kế toán Hưng hà", text: data.msg, image: "/uploads/success.png", class_name: "clean", time: "1000" });
                        }else{
                            $.gritter.add({ title: "Kế toán Hưng hà", text: data.msg, image: "/uploads/success.png", class_name: "clean", time: "1000" });
                        }
                        //$.gritter.add({ title: "Kế toán Hưng hà", text: "Hoàn thành nhiều lệnh thành công", image: "/uploads/success.png", class_name: "clean", time: "1000" });
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                    error: function () {
                        //$.gritter.add({ title: "Kế toán Hưng hà", text: "Hoàn thành nhiều lệnh thất bại", image: "/uploads/success.png", class_name: "clean", time: "1000" });
                    }
                });
            }
        });
    }
        self.CancelCashOutLog=function()
        {
             trangThai = $("#optTrangThai option").filter(":selected").val();
            tuNgay = $("#txtTuNgay").val().trim();
            denNgay = $("#txtDenNgay").val().trim();
            nganHang = $("#optNganHang option").filter(":selected").val();
            findKey = $("#txtFindKey").val();
            nguoiChuyen = $("#optNguoiChuyenTien option").filter(":selected").val();
            nguonVao = $("#optNguonVao option").filter(":selected").val();
            bootbox.confirm("Bạn có chắc chắn muốn hủy lệnh đã chọn ?", function (result) {
            if (result == true) {
                 $.ajax({
                    url: '/KeToanChuyenTien/HuyLenhRutTien',
                    data: { id: rows_selected.toString() },
                    type: "POST",
                    dataType:'json',
                    beforeSend: function () {
                        Busy.Block();
                    },
                    success: function (data) {
                        rows_selected = [];
                        $('#luaChonNhieuLenh').prop('checked', false);
                        $('#tblDoiChuyenTien tbody input[type="checkbox"]').prop('checked', false);
                        if(data.Status=='success'){
                        self.RefreshTableUser('#tblDoiChuyenTien');
                        self.TotalMoney();
                            $.gritter.add({ title: "Kế toán Hưng hà", text: data.msg, image: "/upload/success.png", class_name: "clean", time: "1000" });
                        }else{
                            $.gritter.add({ title: "Kế toán Hưng hà", text: data.msg, image: "/upload/success.png", class_name: "clean", time: "1000" });
                        }
                        //$.gritter.add({ title: "Kế toán Hưng hà", text: "Hoàn thành nhiều lệnh thành công", image: "/uploads/success.png", class_name: "clean", time: "1000" });
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                    error: function () {
                        //$.gritter.add({ title: "Kế toán Hưng hà", text: "Hoàn thành nhiều lệnh thất bại", image: "/uploads/success.png", class_name: "clean", time: "1000" });
                    }
                });
                }
            });
        }
    // Phương thức chuyển người nhận lệnh
    self.ChuyenNguoiNhanLenh = function () {
        trangThai = $("#optTrangThai option").filter(":selected").val();
        tuNgay = $("#txtTuNgay").val().trim();
        denNgay = $("#txtDenNgay").val().trim();
        nganHang = $("#optNganHang option").filter(":selected").val();
        findKey = $("#txtFindKey").val().trim();
        nguoiChuyen = $("#optNguoiChuyenTien option").filter(":selected").val();
        idMaLenh = $("#txtMaLenh").val();
        nguonVao = $("#optNguonVao option").filter(":selected").val();
        //nguoiNhanLenh = $("#optNguoiNhanLenh option").filter(":selected").val();
        bootbox.confirm("Bạn có chắc chắn muốn chuyển người nhận lệnh vừa chọn ?", function (result) {
            if (result == true) {
                $.ajax({
                    url: '/KeToanChuyenTien/ChuyenNguoiNhanLenh',
                    //data: { id: idMaLenh, nguoiNhanLenh: nguoiNhanLenh },
                    data: { id: idMaLenh },
                    type: "POST",
                    dataType:'json',
                    beforeSend: function () {
                        Busy.Block();
                    },
                    success: function (data) {
                        if(data.Status=='success'){
                            self.RefreshTableUser('#tblDoiChuyenTien');
                            self.TotalMoney();
                            $("#modalChuyenLenh").modal("hide");
                            $.gritter.add({ title: "Kế toán doithe66", text: "Chuyển người nhận lệnh thành công", image: "/upload/success.png", class_name: "clean", time: "1000" });
                              
                        }
                        //$("#thongBaoChuyenNguoiNhanLenh").show();
                        //$("#thongBaoChuyenNguoiNhanLenh").text("Chuyển người nhận lệnh thành công !");
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                    error: function () {
                        $("#thongBaoChuyenNguoiNhanLenh").show();
                        $("#thongBaoChuyenNguoiNhanLenh").text("Chuyển người nhận lệnh thất bại !");
                    }
                });
            }
        });
    }

}

function XemChiTiet(id) {
    $.ajax({
        url: '/KeToanChuyenTien/GetInforTranfMoney',
        data: { id: id },
        type: "POST",
        success: function (data) {
            console.log(data);
            $("#txtMaLenhCu").val(data.LenhCu.Id);
            $("#txtThoiGianCu").val(data.LenhCu.strCreateDate);
            $("#txtEmailCu").val(data.LenhCu.UserName);
            $("#txtSoDienThoaiCu").val(data.LenhCu.Phone);
            $("#txtHoTenCu").val(data.LenhCu.BankAccount);
            $("#txtSoTKCu").val(data.LenhCu.BankNumber);
            $("#txtNganHangCu").val(data.LenhCu.BankCode);
            $("#txtChiNhanhCu").val(data.LenhCu.BankBrand);
            $("#txtSoTienCu").val(data.LenhCu.strAmount);
            $("#txtMaLenhMoi").val(data.LenhHienTai.Id);
            $("#txtThoiGianMoi").val(data.LenhHienTai.strCreateDate);
            $("#txtEmailMoi").val(data.LenhHienTai.UserName);
            $("#txtSoDienThoaiMoi").val(data.LenhHienTai.Phone);
            $("#txtHoTenMoi").val(data.LenhHienTai.BankAccount);
            $("#txtSoTKMoi").val(data.LenhHienTai.BankNumber);
            $("#txtNganHangMoi").val(data.LenhHienTai.BankCode);
            $("#txtChiNhanhMoi").val(data.LenhHienTai.BankBrand);
            $("#txtSoTienMoi").val(data.LenhHienTai.strAmount);
            $("#modalDetailCashOut").modal("show");
        },
    });
}

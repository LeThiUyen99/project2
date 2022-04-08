

var tuNgay = "";
var denNgay = "";
var findKey = "";

// Quản lý giao dịch
var TopUpMobile = function () {
    var self = this;

    // Hàm khởi tạo
    self.initTopUpMobile = function () {
        self.TopUpMobileTable();
        self.TopUpMobileFunction();
    }

    // Hàm chức năng
    self.TopUpMobileFunction = function () {

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
            findKey = $("#txtfinKey").val().trim();
            tuNgay = $("#txtStart").val();
            denNgay = $("#txtEnd").val();
            self.RefreshTableUser("#tblTopUpMobile");
            
            $.unblockUI();
        });

    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.TopUpMobileTable = function () {
        //Load danh sách thêm giao dịch: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblTopUpMobile').DataTable({
            "bDestroy": true,
            //"fnServerParams": function (aoData) {
//                aoData.push(
//                        {
//                            "name": "findKey",
//                            "value": findKey
//                        },
//                        {
//                            "name": "tuNgay",
//                            "value": tuNgay
//                        },
//                        {
//                            "name": "denNgay",
//                            "value": denNgay
//                        }
//                    )
//            },
            "ajax": {
                "url": "/QuanLyVnPayTopUpMobile/DanhSachVNPayTopUpMobile",
                "type": "POST",
                "datatype": "json",
                'data': function (d) {                 	
                    d.findkey = $("#txtfinKey").val().trim();                                     
                    d.tuNgay=$("#txtStart").val();
                    d.denNgay=$("#txtEnd").val();
                }
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "sDom": 'it<pl>',
            //"sAjaxSource": '/QuanLyVnPayTopUpMobile/DanhSachVNPayTopUpMobile',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "MobileNo" },
            { "mData": "StrAmount" },
            { "mData": "RespCode", 'class': 'dt-body-center' },
            { "mData": "StrTelcoStatus", 'class': 'dt-body-center' },
            { "mData": "StrCreateDate" },
            {
              "mData":"HoanTien"
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
        $('#tblTopUpMobile').on('click', 'a._capNhatTin', function (e) {
            e.preventDefault();
            var charlogTable_id = $(this).attr("data-id");
            bootbox.confirm("Bạn muốn cập nhật giao dịch vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url:'/QuanLyVnPayTopUpMobile/Hoantientopup',
                        async: false,
                        data: { idtopup: charlogTable_id },
                        dataType: 'json',
                        type: "get",
                        success: function (data) {
                            if (data.success == true) {
                                self.RefreshTableUser('#tblTopUpMobile');
                                $.gritter.add({ title: "Doithe66", text: "Hoàn Tiền Thành Công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });
        // Sự kiện khi click vào trường hợp 1
        $('#tblThemGiaoDich').on('click', 'a._truongHop1', function (e) {
            var id_The = $(this).attr("data-id");
            self.DanhSachNhaCungCap();
            self.RemoveToolTip1();
            self.SetDefaultValue();
            $("#myModalThemGiaoDich").modal("show");
        });
        $('#tblTopUpMobile').on('click', 'button._Updatetopup', function (e) {
            var id_The = $(this).attr("data-id");
            e.preventDefault();
            var charlogTable_id = $(this).attr("data-id");
            bootbox.confirm("Bạn muốn cập nhật giao dịch vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: '/QuanLyVnPayTopUpMobile/TopupReturn',
                        async: false,
                        data: { idtopup: charlogTable_id },
                        dataType: 'json',
                        type: "get",
                        success: function (data) {
                            if (data.Success == true) {
                                self.RefreshTableUser('#tblTopUpMobile');
                                $.gritter.add({ title: "Hưng hà paycard", text: "Cập nhật giao dịch thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });
        // Sự kiện khi click vào trường hợp 2
        $('#tblThemGiaoDich').on('click', 'a._truongHop2', function (e) {
            var id_The = $(this).attr("data-id");
            self.DanhSachNhaCungCap();
            self.RemoveToolTip1();
            $("#myModalThemGiaoDich").modal("show");
        });

        // Sự kiện khi click vào trường hợp 3
        $('#tblThemGiaoDich').on('click', 'a._truongHop3', function (e) {
            var id_The = $(this).attr("data-id");
            self.DanhSachNhaCungCap();
            self.RemoveToolTip1();
            $("#myModalThemGiaoDich").modal("show");
        });

        // Sự kiện khi click vào trường hợp 4
        $('#tblThemGiaoDich').on('click', 'a._truongHop4', function (e) {
            var id_The = $(this).attr("data-id");
            self.DanhSachNhaCungCap();
            self.RemoveToolTip1();
            $("#myModalThemGiaoDich").modal("show");
        });

    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }
}




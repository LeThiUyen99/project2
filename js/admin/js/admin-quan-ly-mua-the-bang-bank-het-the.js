

// Quản lý mua thẻ, nạp tiền điện thoại hết thẻ
var MuaTheBank = function () {
    var self = this;

    // Hàm khởi tạo
    self.initMuaTheBank = function () {
        self.MuaTheBankTable();
        self.QuanLyTaiKhoanNguoiDungFunction();
        self.TotalAmount();
    }

    // Hàm chức năng
    self.QuanLyTaiKhoanNguoiDungFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY HH:mm'
        });

        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblMuaTheBank");
            self.TotalAmount();
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.MuaTheBankTable = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblMuaTheBank').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
            aoData.push(
                    {
                        "name": "thoiGian",
                        "value": $("#txtStart").val().trim()
                    }
                )
            },
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": Config.AppUrl + 'MuaTheTopUpBankHetThe/MuaTheBangBankHetThe',
            "lengthMenu": [20, 50],
            "aoColumns": [
            { "mData": "CreateMail" },
            { "mData": "Data" },
            { "mData": "AdditionalInfo" },
            { "mData": "CreateUserId", "class": "dt-center" },
            { "mData": "strCreateDate" },
            { "mData": "VnpTranid" },
            { "mData": "Signature" }
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
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Đếm tổng tiền
    self.TotalAmount = function () {
        $.ajax({
            url: Config.AppUrl + 'MuaTheTopUpBankHetThe/MuaTheBangBankHetThe',
            type: 'POST',
            data: {
                thoiGian: $("#txtStart").val().trim()
            },
            success: function (data) {
                $("#totalAmount").text(data.tongTien);
            }
        });
    }

}
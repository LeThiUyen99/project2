// Khai báo biến
var date = moment(); //Get the current date
var start = date.format("DD/MM/YYYY");
var end = date.format("DD/MM/YYYY");
var taiKhoan = -1;
var nhom = 0;

var TyLeBankNet = function () {
    var self = this;

    $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD/MM/YYYY'
    });

    $('#datetimepicker2').datetimepicker({
        locale: 'vi',
        format: 'DD/MM/YYYY'
    });

    // Sự kiện khi click vào button tìm kiếm
    $("#btnTimKiem").click(function () {
        taiKhoan = $("#optTaiKhoan option").filter(":selected").val();
        nhom = $("#optNhom option").filter(":selected").val();
        start = $("#txtStart").val();
        end = $("#txtEnd").val();
        self.RefreshTableQuanLyGiaoDich("#tblStoreView");
        self.TotalSoLuong();
    });

    self.Init = function () {
        var date = moment(); //Get the current date
        $("#txtStart").val(date.format("DD/MM/YYYY"));
        $("#txtEnd").val(date.format("DD/MM/YYYY"));
        self.StoreView();
        self.TotalSoLuong();
    }

    // Tải dữ liệu lên table
    self.StoreView = function () {

        //Load Template Document: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblStoreView').DataTable({
            "bDestroy": true,
            "sPaginationType": "full_numbers",
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "fnServerParams": function (aoData) {
                aoData.push(
                        {
                            "name": "findKey",
                            "value": $("#txtfinKey").val().trim()
                        },
                        {
                            "name": "tuNgay",
                            "value": $("#txtStart").val().trim()
                        },
                        {
                            "name": "denNgay",
                            "value": $("#txtEnd").val().trim()
                        },
                        {
                            "name": "giaoDich",
                            "value": $("#optNhom option").filter(":selected").val()
                        }
                    )
            },
            "bProcessing": true,
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": Config.AppUrl + 'QuanLyTheNapSoDienThoai/GetData',
            "iDisplayLength": 50,
            "lengthMenu": [50, 100, 200, 500, 1000],
            "aoColumns": [
            { "mData": "email" },
            { "mData": "Serial", 'className': 'dt-body-center' },
            { "mData": "strTrace", 'className': 'dt-body-center' },
            { "mData": "ProviderCode", 'className': 'dt-body-center' },
            { "mData": "MobileNo", 'className': 'dt-body-center' },
            { "mData": "strRspCode", 'className': 'dt-body-center' },
            { "mData": "TransacsionID", 'className': 'dt-body-center' }
            ],
            "order": [0, 'asc'],
            "oLanguage": {
                "sProcessing": "Đang xử lý",
                "sLengthMenu": "Hiển thị _MENU_ Bản ghi",
                "sZeroRecords": "Không tìm thấy bản ghi nào !",
                "sInfo": "Hiển thị từ _START_ - _END_ bản ghi ( trong số _TOTAL_ )",
                "sInfoFiltered": "(suodatettu _MAX_ tuloksen joukosta)",
                "oPaginate": {
                    "sFirst": "Đầu",
                    "sPrevious": "Trước",
                    "sNext": "Sau",
                    "sLast": "Cuối"
                }
            }
        });
    }

    // Load lại dữ liệu lên table
    self.RefreshTableQuanLyGiaoDich = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Đếm số tài khoản
    self.TotalSoLuong = function () {
        $.ajax({
            url: Config.AppUrl + 'QuanLyTheNapSoDienThoai/GetData',
            type: 'POST',
            data: {
                status: taiKhoan,
                fromDate: start,
                toDate: end,
                type: nhom
            },
            success: function (data) {
                $("#totalSoLuong").text(data.tong);
                $("#totalSoTien").text(data.soTien);
            }
        });
    }
}
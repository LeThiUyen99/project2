// Khai báo biến
var date = moment(); //Get the current date
var start = date.format("DD/MM/YYYY HH:mm");
var end = date.format("DD/MM/YYYY HH:mm");
var taiKhoan = -1;
var nhom = 0;

var TyLeBankNet = function () {
    var self = this;

    $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD/MM/YYYY HH:mm'
    });

    $('#datetimepicker2').datetimepicker({
        locale: 'vi',
        format: 'DD/MM/YYYY HH:mm'
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
        $("#txtStart").val(date.format("DD/MM/YYYY HH:mm"));
        $("#txtEnd").val(date.format("DD/MM/YYYY HH:mm"));
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
                        "name": "status",
                        "value": taiKhoan
                    },
                    {
                        "name": "fromDate",
                        "value": start
                    },
                    {
                        "name": "toDate",
                        "value": end
                    },
                    {
                        "name": "type",
                        "value": nhom
                    }
                    )
            },
            "bProcessing": true,
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": Config.AppUrl + 'ThongKeGiaoDichBankNet/GetAllStoreViewByDate',
            "iDisplayLength": 50,
            "lengthMenu": [50, 100, 200, 500, 1000],
            "aoColumns": [
            { "mData": "0" },
            { "mData": "1", 'className': 'dt-body-center' },
            { "mData": "2", 'className': 'dt-body-center' },
            { "mData": "3", 'className': 'dt-body-center' },
            { "mData": "4", 'className': 'dt-body-center'},
            { "mData": "5", 'className': 'dt-body-center' },
            { "mData": "6", 'className': 'dt-body-center' },
            { "mData": "7", 'className': 'dt-body-center' }
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
            url: Config.AppUrl + 'ThongKeGiaoDichBankNet/GetAllStoreViewByDate',
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
                $("#totalsothe").text(data.sothebanra);
                $("#totalsotopup").text(data.soluongtopup);
                $("#totalmenhgiathe").text(data.menhgiatheban);
                $("#totalmenhgiatopup").text(data.menhgiatopup);
                $("#totalall").text(data.totalall);
            }
        });
    }
}
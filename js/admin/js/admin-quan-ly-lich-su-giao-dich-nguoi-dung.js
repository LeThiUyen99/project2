
// Quản lý lịch sử giao dịch người dùng
var LichSuGiaoDichNguoiDung = function () {
    var self = this;
$('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'YYYY-MM-DD'
        });
    // Hàm khởi tạo
    self.initLichSuGiaoDichNguoiDung = function () {
        $("#txtTuNgay").val("");
        $("#txtDenNgay").val("");
        $("#txtfinKey").val("");
        self.LichSuGiaoDichNguoiDungTable();
        self.LichSuGiaoDichNguoiDungFunction();
    }

    // Hàm chức năng
    self.LichSuGiaoDichNguoiDungFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuGiaoDichNguoiDung");
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.LichSuGiaoDichNguoiDungTable = function () {
        //Load Email: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblLichSuGiaoDichNguoiDung').DataTable({
            "bDestroy": true,
            //"fnServerParams": function (aoData) {
//                aoData.push(
//                    {
//                        "name": "findKey",
//                        "value": $("#txtfinKey").val().trim()
//                    }
//                )
//            },
            "ajax": {
                "url": "/QuanLyLichSuGiaoDichNguoiDung/GetData",
                "type": "POST",
                "datatype": "json",
                'data': function (d) {                                          
                    d.tuNgay=$("#txtTuNgay").val().trim();
                    d.denNgay = $("#txtDenNgay").val().trim();
                    d.findKey = $("#txtfinKey").val().trim();                                     
                    
                }
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 50,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            //"sAjaxSource": Config.AppUrl + 'QuanLyLichSuGiaoDichNguoiDung/GetData',
            "lengthMenu": [50, 100],
            "aoColumns": [
            { "mData": "StrType" },
            { "mData": "StrAmount", "class": "dt-center" },
            { "mData": "StrPrice", "class": "dt-center" },
            { "mData": "StrCreateDate", "class": "dt-center" }
            ],
            "order": [3, 'desc'],
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
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }
}

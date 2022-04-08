// Người viết: Vũ Duy Khánh
// Số điện thoại: 0913095997 or 0961102890
// Email: vuduykhanh@hotmail.com.vn
// Jquery datatable quản lý thống kê sản lượng

// Quản lý thống kê sản lượng
var ThongKeSanLuong = function () {
    var self = this;

    // Hàm khởi tạo thống kê sản lượng
    self.initThongKeSanLuong = function () {
        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY HH:mm:ss'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY HH:mm:ss'
        });

        self.ThongKeSanLuongTable();
        self.ThongKeSanLuongFunction();
    }

    // Hàm chức năng kho thẻ người dùng
    self.ThongKeSanLuongFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            self.RefreshTableUser("#tblThongKeTheGachAPI");
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.ThongKeSanLuongTable = function () {
        //Load Danh sách thẻ treo: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblThongKeTheGachAPI').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                      {
                          "name": "timeStart",
                          "value": $("#txtStart").val().trim()
                      },
                      {
                          "name": "timeEnd",
                          "value": $("#txtEnd").val().trim()
                      },
                      {
                          "name": "nhaMang",
                          "value": $("#optNhaMang option").filter(":selected").val()
                      }
                )
            },
            //"bFilter": false,
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": '/administrator/ThongKeTheGachAPI/ThongKe',
            "lengthMenu": [20, 50, 100, 200, 500],
            "aoColumns": [
            { "mData": "strTelcoCode", "class": "dt-center" },
            { "mData": "strAmount", "class": "dt-center" },
            { "mData": "strPrice", "class": "dt-center" },
            { "mData": "strSoLuong", "class": "dt-center" }
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
}

// Người viết: Vũ Duy Khánh
// Số điện thoại: 0913095997 or 0961102890
// Email: vuduykhanh@hotmail.com.vn
// Jquery datatable quản lý thống kê sản lượng

// Quản lý thống kê api
var ThongKe = function () {
    var self = this;

    // Hàm khởi tạo thống kê
    self.initThongKe = function () {
        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY HH:mm:ss'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY HH:mm:ss'
        });

        self.ThongKeTable();
        self.ThongKeFunction();
    }

    // Hàm chức năng kho thẻ người dùng
    self.ThongKeFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            self.RefreshTableUser("#tblThongKeTheGachAPI");
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.ThongKeTable = function () {
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
                          "name": "email",
                          "value": $("#txtEmail").val().trim()
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
            "sAjaxSource": '/administrator/ThongKeAPI/ThongKe',
            "lengthMenu": [20, 50, 100, 200, 500],
            "aoColumns": [
            { "mData": "UserId", "class": "dt-center" },
            { "mData": "Email", "class": "dt-center" },
            { "mData": "VTT", "class": "dt-center" },
            { "mData": "VMS", "class": "dt-center" },
            { "mData": "VNP", "class": "dt-center" },
            { "mData": "FPT", "class": "dt-center" },
            { "mData": "VNM", "class": "dt-center" },
            { "mData": "ONC", "class": "dt-center" },
            { "mData": "MGC", "class": "dt-center" },
            { "mData": "ZING", "class": "dt-center" },
            { "mData": "VTC", "class": "dt-center" },
            { "mData": "BIT", "class": "dt-center" },
            { "mData": "TOTAL", "class": "dt-center" }
            ],
            "order": [12, 'desc'],
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


// Quản lý lịch sử mua mã thẻ
var LichSuGiaoDich = function () {
    var self = this;

    // Hàm khởi tạo kho thẻ người dùng
    self.initLichSuGiaoDich = function () {
        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });
        self.LichSuGiaoDichTable();
        self.LichSuGiaoDichFunction();
    }

    // Hàm chức năng kho thẻ người dùng
    self.LichSuGiaoDichFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuMuaMaThe");
            $("#txtfinKey").val("");
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.LichSuGiaoDichTable = function () {
        //Load Danh sách thẻ treo: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblLichSuMuaMaThe').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                      {
                          "name": "tuNgay",
                          "value": $("#txtStart").val().trim()
                      },
                      {
                          "name": "denNgay",
                          "value": $("#txtEnd").val().trim()
                      },
                      {
                         "name": "findKey",
                         "value": $("#txtfinKey").val().trim()
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
            "sAjaxSource": Config.AppUrl + 'LichSuGiaoDich/GetData',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Email" },
            { "mData": "TransId" },
            { "mData": "strAmount" },
            { "mData": "strPrice" },
            { "mData": "Type", "class": "dt-center" },
            { "mData": "Status", "class": "dt-center" },
            { "mData": "strCreateDate" }
            ],
            "order": [5, 'desc'],
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

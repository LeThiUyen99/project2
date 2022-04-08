
// Quản lý lịch sử mua mã thẻ
var LichSuMuaMaThe = function () {
    var self = this;

    // Hàm khởi tạo kho thẻ người dùng
    self.initLichSuMuaMaThe = function () {
        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'YYYY-MM-DD'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'YYYY-MM-DD'
        });
        self.LichSuMuaMaTheTable();
        self.LichSuMuaMaTheFunction();
    }

    // Hàm chức năng kho thẻ người dùng
    self.LichSuMuaMaTheFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuMuaMaThe");
           // $("#txtfinKey").val("");
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.LichSuMuaMaTheTable = function () {
        //Load Danh sách thẻ treo: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblLichSuMuaMaThe').DataTable({
            "bDestroy": true,
            //"fnServerParams": function (aoData) {
//                aoData.push(
//                      {
//                          "name": "tuNgay",
//                          "value": $("#txtStart").val().trim()
//                      },
//                      {
//                          "name": "denNgay",
//                          "value": $("#txtEnd").val().trim()
//                      },
//                      {
//                         "name": "findKey",
//                         "value": $("#txtfinKey").val().trim()
//                      }
//                )
//            },
            "ajax": {
                "url": "/LichSuMuaMaTheGiaiMa/GetData",
                "type": "POST",
                "datatype": "json",
                timeout: 60000,                
                'data': function (d) {                 	
                    d.tuNgay = $("#txtStart").val().trim(); 
                    d.denNgay = $("#txtEnd").val().trim();                    
                    d.findKey=$("#txtfinKey").val().trim();
                }
            },
            //"bFilter": false,
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            //"sAjaxSource": '/LichSuMuaMaTheGiaiMa/GetData',
            
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "UserName" },
            { "mData": "ProviderCode" },
            { "mData": "CardCode" },
            { "mData": "Serial" },
            { "mData": "StrAmount", "class": "dt-center" },
            { "mData": "StrCreateDate" }
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

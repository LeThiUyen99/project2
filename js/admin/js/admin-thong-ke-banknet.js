// Người viết: Vũ Duy Khánh
// Số điện thoại: 0913095997 or 0961102890
// Email: vuduykhanh@hotmail.com.vn
// Jquery datatable quản lý tài khoản người dùng

// Quản lý tài khoản người dùng
var ThongKebankNet = function () {
    var self = this;

    // Hàm khởi tạo
    self.initThongKebankNet = function () {
        $("#txtfinKey").val("");
        self.ThongKebankNetTable();
        //self.ThongKeTranbankNetTable();
        self.tinhtong();
        self.ThongKebankNetFunction();
        
    }

    // Hàm chức năng
    self.ThongKebankNetFunction = function () {

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
            Busy.Block();
            self.RefreshTableUser("#tblThongKeBankNet");
            self.tinhtong();
            $.unblockUI();
        });
        $("#btnTimKiem1").click(function () {
            Busy.Block();
            self.RefreshTranTableUser("#tblThongKeTranBankNet");
            $.unblockUI();
        });
    }
self.tinhtong=function(){
    $.ajax({
                        url: '/ThongKeBankNet/TongTien',
                        
                        data: { 
                            findKey : $("#txtfinKey").val().trim() ,
                            tuNgay :$("#txtStart").val().trim(),    
                            denNgay:  $("#txtEnd").val().trim(),         
                            giaoDich:$("#optGiaoDich option").filter(":selected").val(),    
                            trangthai:$("#opttrangthai option").filter(":selected").val() 
                     },
                        dataType: 'json',
                        type: "POST",
                        success: function (data) {
                            $('#tongtien').text(data.tongtien);
                            $('#tonggiaodich').text(data.tonggiaodich);
                        }
                    });
}
    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.ThongKebankNetTable = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblThongKeBankNet').DataTable({
            "bDestroy": true,
            //"fnServerParams": function (aoData) {
//                aoData.push(
//                        {
//                            "name": "findKey",
//                            "value": $("#txtfinKey").val().trim()
//                        },
//                        {
//                            "name": "tuNgay",
//                            "value": $("#txtStart").val().trim()
//                        },
//                        {
//                            "name": "denNgay",
//                            "value": $("#txtEnd").val().trim()
//                        },
//                        {
//                            "name": "giaoDich",
//                            "value": $("#optGiaoDich option").filter(":selected").val()
//                        }
//                    )
//            },
            "ajax": {
                "url": "/ThongKeBankNet/GetData",
                "type": "POST",
                "datatype": "json",
                'data': function (d) {                 	
                    d.findKey = $("#txtfinKey").val().trim() ;
                    d.tuNgay =$("#txtStart").val().trim();    
                    d.denNgay=  $("#txtEnd").val().trim();         
                    d.giaoDich=$("#optGiaoDich option").filter(":selected").val();    
                    d.trangthai=$("#opttrangthai option").filter(":selected").val();                
                }
            },
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 50,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            //"sAjaxSource": Config.AppUrl + 'ThongKeBankNet/GetData',
            "lengthMenu": [50, 100, 200, 500, 1000],
            "aoColumns": [
            { "mData": "CreateMail" },
            { "mData": "strTransacsionType" },
            { "mData": "NhaMang", "class": "dt-center" },
            { "mData": "StrPrice", "class": "dt-center" },
            { "mData": "strCreateDate" },
            { "mData": "RspCode", "class": "dt-center" },
            { "mData":"CreateUserId"},
            { "mData": "Signature", "class": "dt-center" }
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

    self.ThongKeTranbankNetTable = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblThongKeTranBankNet').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                        {
                            "name": "findKey",
                            "value": $("#txtfinKey1").val().trim()
                        }
                    )
            },
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 50,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": Config.AppUrl + 'ThongKeBankNet/GetDataTran',
            "lengthMenu": [50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "UserID" },
            { "mData": "Trace" },
            { "mData": "strCreateDate", "class": "dt-center" },
            {"mData":"strAmount"},
            { "mData": "Type" },
            { "mData": "ReferentId", "class": "dt-center" }
            
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
    self.RefreshTranTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }
}
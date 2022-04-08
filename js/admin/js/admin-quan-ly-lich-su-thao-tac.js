
var findKey = "";
var tuNgay = "";
var denNgay = "";
var status = 0

// Quản lý lịch sử thao tác database
var LichSuThaoTacDB = function () {

    var self = this;

    // Hàm khởi tạo
    self.initThaoTacDB = function () {
        self.ThaoTacDBTable();
        self.ThaoTacDBFunction();
        //self.TongLenh();
    }

    // Hàm chức năng
    self.ThaoTacDBFunction = function () {

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
            tuNgay = $("#txtStart").val().trim();
            denNgay = $("#txtEnd").val().trim();
            findKey = $("#txtfinKey").val().trim();
            status = $("#optThaoTac option").filter(":selected").val();
            self.RefreshTableUser("#tblThaoTacDB");
            //self.TongLenh();
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.ThaoTacDBTable = function () {

        //Load lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblThaoTacDB').DataTable({
            "bDestroy": true,
           // "fnServerParams": function (aoData) {
//                aoData.push(
//                    {
//                        "name": "findKey",
//                        "value": findKey
//                    },
//                    {
//                        "name": "tuNgay",
//                        "value": tuNgay
//                    },
//                    {
//                        "name": "denNgay",
//                        "value": denNgay
//                    },
//                    {
//                        "name": "status",
//                        "value": status
//                    }
//                )
//            },
            "ajax": {
                "url": "/LichSuThaoTac/DanhSachThaoTacDB",
                "type": "POST",
                "datatype": "json",
                'data': function (d) {                 	
                    d.findkey = $("#txtfinKey").val().trim();                                     
                    d.tuNgay=$("#txtStart").val();
                    d.denNgay=$("#txtEnd").val();
                    d.status=$("#optThaoTac option").filter(":selected").val();
                }
            },
            //"bFilter": false,
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            //"sAjaxSource": Config.AppUrl + 'LichSuThaoTac/DanhSachThaoTacDB',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "FullName" },
            { "mData": "Action" },
            { "mData": "Serial" },
            { "mData": "StrAmount" },
            { "mData": "StrCreateDate" },
            {
                mData: "Id",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a style='padding:5px' title='Chi tiết lịch sử thao tác' data-id='" + o + "' class='_chiTietThaoTac btn-success' data-title='Chi tiết lịch sử thao tác'><i class='fa fa-eye-slash'></i></a>" +
                        "</span>";
                }
            }
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

        // Sự kiện khi click vào xem chi tiết lịch sử thao tác
        $('#tblThaoTacDB').on('click', 'a._chiTietThaoTac', function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            $.ajax({
                url: Config.AppUrl + 'LichSuThaoTac/ChiTietRecorDB',
                async: false,
                data: { id: id },
                dataType: 'json',
                type: "post",
                success: function (data) {
                    $("#modalChiTietThaoTacDB").modal("show");
                    $("#txaMoTaChiTiet").text(data.Message);
                }
            });
        });
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Tính tổng số thao tác
    self.TongLenh = function () {
        $.ajax({
            url: Config.AppUrl + 'LichSuThaoTac/DanhSachThaoTacDB',
            type: 'POST',
            data: {
                tuNgay: $("#txtStart").val().trim(),
                denNgay: $("#txtEnd").val().trim(),
                findKey: $("#txtfinKey").val().trim(),
                status: $("#optThaoTac option").filter(":selected").val()
            },
            success: function (data) {
                $("#lblTongThaoTac").text(data.tongLenh);
                if (data.tongTien == null) {
                    $("#lbltongTien").text("0");
                }
                else {
                    $("#lbltongTien").text(data.tongTien.toLocaleString('en-US', { minimumFractionDigits: 0 }));
                }
            }
        });
    }
}


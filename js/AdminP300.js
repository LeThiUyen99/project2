
// Javascript Quản lý giao dịch

// Khai báo biến
var date = moment(); //Get the current date

var end = date.format("YYYY-MM-DD HH:mm");

var nhom = -1;

var P300 = function () {
    var self = this;

    

    $('#datetimepicker2').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD HH:mm'
    });

    // Sự kiện khi click vào button tìm kiếm
    $("#btnTimKiem").click(function () {       
        nhom = $("#optNhom option").filter(":selected").val();
        end = $("#txtEnd").val();
        self.RefreshTableQuanLyGiaoDich("#tblP300");
        self.TotalMoney();
    });

    self.Init = function () {
        var date = moment(); //Get the current date
        
        $("#txtEnd").val(date.format("YYYY-MM-DD HH:mm"));
        //$("#money").val('');
        self.QuanLyGiaoDichDataTable();
        self.TotalMoney();
    }

    // Tải dữ liệu lên table
    self.QuanLyGiaoDichDataTable = function () {
        //Load Template Document: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblP300').DataTable({
            "bDestroy": true,
            "sPaginationType": "full_numbers",
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            //"fnServerParams": function (aoData) {
//                aoData.push(                    
//                    {
//                        "name": "toDate",
//                        "value": end
//                    },                    
//                    {
//                        "name": "nhom",
//                        "value": nhom
//                    }
//                    )
//            },
            "bProcessing": true,
            "oSearch": { "bSmart": true, "bRegex": true },
            "sDom": 'it<pl>',
            //"sAjaxSource": '/P300/LoadAllGiaoDich',
            "ajax": {
                "url": "/P300/LoadAllGiaoDich",
                "type": "GET",
                "datatype": "json",
                'data': function (d) {                 	
                    d.toDate = $("#txtEnd").val();                    
                    d.nhom=nhom;
                }
            },
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
//            "aoColumns": [
//            { "mData": "0" },
//            { "mData": "1" },
//            { "mData": "2" },
//            { "mData": "3", 'className': 'dt-body-right' },
//            { "mData": "4", 'className': 'dt-body-right' }
//            ],
            "columns": [
                { "data": "Name" },
                { "data": "UserName" },
                { "data": "StrType" },
                { "data": "StrAmount" },
                { "data": "StrPrice" }
            ],
            "order": [[0, 'asc']],
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


    // Kiểm tra tính hợp lệ của dữ liệu
    //self.ValidateData = function () {
    //    var flag = true;

    //    var txtStart = $("#txtStart").val();
    //    if ($.trim(txtStart) == 0) {
    //        $($('#txtStart')).tooltip('hide').attr('data-original-title', 'Vui lòng nhập vào bắt đầu').tooltip('fixTitle').addClass('errorClass');
    //        flag = false;
    //    } else {
    //        $('#txtStart').data("title", "").removeClass("errorClass").tooltip("destroy");
    //    }

    //    var txtEnd = $("#txtEnd").val();
    //    if ($.trim(txtEnd) == 0) {
    //        $($('#txtEnd')).tooltip('hide').attr('data-original-title', 'Vui lòng nhập kết thúc').tooltip('fixTitle').addClass('errorClass');
    //        flag = false;
    //    } else {
    //        $('#txtEnd').data("title", "").removeClass("errorClass").tooltip("destroy");
    //    }

    //    if (flag == false) {
    //        $('#thongbao span').text('* Dữ liệu trên form thiếu hoặc là không hợp lệ');
    //        $('#thongbao').show();
    //    }
    //    if (flag == true) {
    //        $('#thongbao').hide();
    //    }
    //    return flag;
    //}

    // Remove Tooltip: 
    //self.RemoveToolTip = function () {
    //    $('#txtStart').data("title", "").removeClass("errorClass").tooltip("destroy");
    //    $('#txtEnd').data("title", "").removeClass("errorClass").tooltip("destroy");
    //    $('#optTaiKhoan').data("title", "").removeClass("errorClass").tooltip("destroy");
    //    $('#optNhom').data("title", "").removeClass("errorClass").tooltip("destroy");
    //}

    // Load lại dữ liệu lên table
    self.RefreshTableQuanLyGiaoDich = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Tính tổng số tiền
    self.TotalMoney = function () {
        $.ajax({
            url: '/P300/LoadAllGiaoDich',
            type: 'GET',
            dataType:'json',
            data: { nhom: nhom, toDate: end },
            success: function (data) {
                $("#money").val(data.tongtien);
                $("#moneyinaccount").val(data.sumprice);
            }
        });
    }

}






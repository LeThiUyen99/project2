
// Quản lý tài khoản người dùng
var QuanLyComment = function () {
    var self = this;

    // Hàm khởi tạo
    self.initQuanLyComment = function () {
        $("#txtfinKey").val("");
        $("#txtStart").val("");
        $("#txtEnd").val("");
        $("#optTrangThai").val(-1);
        self.QuanLyCommentTable();
        self.QuanLyCommentFunction();
        self.TotalAccount();
    }

    // Hàm chức năng
    self.QuanLyCommentFunction = function () {

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
            self.RefreshTableUser("#tblKichHoatTaiKhoanNguoiDung");
            self.TotalAccount();
            $.unblockUI();
        });
        $("#btnCapNhatTin").click(function () {
            var comment=$('#txtTieuDe').val();
            if (comment!='') {               
                $.ajax({
                    url: Config.AppUrl + 'QuanLyComment/AddCommentFeed',
                    async: false,
                    type: "post",
                    data: {id:$("#txtIdTin").text(),content:comment},
                    success: function (data) {
                        $('#myModalTinTuc').modal('hide');
                        $.gritter.add({ title: "Thêm mới thành công", text: "Cập nhật tin thành công", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                    },
                    error: function (data) {
                       
                        $('#myModalTinTuc').modal('hide');
                        $.gritter.add({ title: "Đổi thẻ 24/7", text: "Cập nhật tin thất bại", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                    }
                });
            }
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.QuanLyCommentTable = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblKichHoatTaiKhoanNguoiDung').DataTable({
            "bDestroy": true,
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
                            "name": "trangThai",
                            "value": $("#optTrangThai option").filter(":selected").val()
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
            "sAjaxSource": Config.AppUrl + 'QuanLyComment/GetData',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "CommentID" },
            { "mData": "Content" },
            { "mData": "CreateBy" },
            { "mData": "Status", "class": "dt-center" },           
            {
                mData: "CommentID",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a title='Hủy kích hoạt tài khoản' data-id='" + o + "' class='_HuyKichHoatTaiKhoan btn-warning btn-xs' data-title='Hủy kích hoạt tài khoản'><i style='color:red' class='fa fa-recycle'></i></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Kích hoạt tài khoản' data-id='" + o + "' class='_KichHoatTaiKhoan btn-success btn-xs' data-title='Kích hoạt tài khoản'><i class='fa fa-check-square-o'></i></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Add Reply' data-id='" + o + "' class='_AddReply btn-info btn-xs' data-title='Add Reply'><i class='fa fa-check-square-o'></i></i></a>" + "&nbsp;&nbsp;&nbsp;&nbsp;" +
                        "<a title='Remove Comment' data-id='" + o + "' class='_RemoveComment btn-warning btn-xs' data-title='Remove Comment'><i class='fa fa-remove'></i></i></a>"+
                        "</span>";
                }
            }
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

        // Sự kiện khi click vào kích hoạt tài khoản người dùng
        $('#tblKichHoatTaiKhoanNguoiDung').on('click', 'a._HuyKichHoatTaiKhoan', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn hủy kích hoạt người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'QuanLyComment/CapNhatTrangThaiComment',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "huy" },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblKichHoatTaiKhoanNguoiDung');
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Cập nhật trạng thái người dùng thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                            else {
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });

        // Sự kiện khi click vào hủy kích hoạt tài khoản người dùng
        $('#tblKichHoatTaiKhoanNguoiDung').on('click', 'a._KichHoatTaiKhoan', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn kích hoạt tài khoản người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'QuanLyComment/CapNhatTrangThaiComment',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "kichHoat" },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblKichHoatTaiKhoanNguoiDung');
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Cập nhật trạng thái người dùng thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                            else if (data == "error") {
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });
        $('#tblKichHoatTaiKhoanNguoiDung').on('click', 'a._AddReply', function (e) {
            e.preventDefault();

            var idTin = $(this).attr("data-id");
            $("#txtIdTin").text(idTin);
            $('#txtTieuDe').data("title", "").removeClass("errorClass").tooltip("destroy");
            $.ajax({
                url: Config.AppUrl + 'QuanLyComment/DetailComment',
                async: false,
                data: { id: idTin },
                dataType: 'json',
                type: "post",
                success: function (obj) {
                    if (obj.Success = true) {
                        var strhtml = "";
                        //var list = jQuery.parseJSON(obj.data);
                        strhtml += "<h3> <span style='color:#ff0000'>Nội dung Comment:</span>" + obj.data.Content + "</h3>";
                        strhtml += "<p><b>Nội dung đã trả lời:</b></p>";
                        for (var i = 0; i < obj.data1.length; i++) {
                            strhtml += "<div><span>" + obj.data1[i].Content + "</span>&nbsp;&nbsp;&nbsp;<a class='btnDelete'  data-id='" + obj.data1[i].CommentFeedbackID + "'><span class='xoarow'>Xóa</span></a>" + "</div>";
                            
                        }                        
                        //var list = jQuery.parseJSON(obj.data);
                        $('#txtnoidungcomment').html(strhtml);
                        $('#txtTieuDe').val('');
                    }
                    $("#title").text("Thêm trả lời");
                    $("#myModalTinTuc").modal("show");
                }
            });
        });
        $('#tblKichHoatTaiKhoanNguoiDung').on('click', 'a._RemoveComment', function (e) {
            e.preventDefault();
            var idTin = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn hủy kích hoạt người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'QuanLyComment/RemoveComment',
                        async: false,
                        data: { id: idTin },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblKichHoatTaiKhoanNguoiDung');
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Xóa comment thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                            else {
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Xóa comment thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });
        $('#txtnoidungcomment').on('click', 'a.btnDelete', function (e) {
            var par = $(this).parent();
            var idTin = $(this).attr("data-id");
            e.preventDefault();
            bootbox.confirm("Bạn có chắc chắn muốn xóa tin vừa chọn?", function (result) {
                $.ajax({
                    url: Config.AppUrl + 'QuanLyComment/RemoveCommentFeed',
                    async: false,
                    data: { id: idTin },
                    dataType: 'json',
                    type: "post",
                    success: function (data) {
                        if (data == "success") {

                            $.gritter.add({ title: "Xoa comment", text: "Xóa tin thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                        }
                    },
                    error: function (data) {

                        $.gritter.add({ title: "Xoa comment", text: "Xóa tin lỗi !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                    }
                })
            })
            par.remove();
        });
    }
   
    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Đếm số tài khoản
    self.TotalAccount = function () {
        $.ajax({
            url: Config.AppUrl + 'QuanLyComment/GetData',
            type: 'POST',
            data: {
                findKey: $("#txtfinKey").val().trim(),
                tuNgay: $("#txtStart").val().trim(),
                denNgay: $("#txtEnd").val().trim(),
                trangThai: $("#optTrangThai option").filter(":selected").val()
            },
            success: function (data) {
                $("#totalAccount").text(data.tongTaiKhoan);
            }
        });
    }

}
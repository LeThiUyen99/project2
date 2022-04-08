
var findKey = "";

// Quản lý danh mục tin tức
var QuanLyDanhMucTinTuc = function () {
    var self = this;

    // Hàm khởi tạo tin tức
    self.initDanhMucTinTuc = function () {
        self.DanhMucTinTucTable();
        self.DanhMucTinTucFunction();
    }

    // Hàm chức năng tin tức
    self.DanhMucTinTucFunction = function () {

        // Cấu hình ckeditor thay textarea bằng trình soạn thảo ckeditor
        var editor = CKEDITOR.replace('txtContent', {
            customConfig: Config.AppUrl + 'Scripts/ckeditor/config.js',
        });

        // Sự kiện khi click vào button thêm tin tức
        $("#btnThemDanhMucTinTuc").click(function () {
            $("#txtIdDanhMucTinTuc").val("0");
            $("#modalDanhMucTinTuc").modal("show");
            $("#title").text("Thêm danh mục tin tức");
            self.SetDefault();
        });

        // Sự kiện khi click vào button cập nhật tin
        $("#btnCapNhatDanhMucTinTuc").click(function () {
            var b = CKEDITOR.instances['txtContent'].getData();
            var status = $("#chkHienThi").is(":checked") ? true : false;
            $.ajax({
                url: Config.AppUrl + 'QuanLyDanhMucTinTuc/CapNhatDanhMucTinTuc',
                async: false,
                type: "post",
                data: {
                    CategoryID: $("#txtIdDanhMucTinTuc").text(), CategoryName: $("#txtTenDanhMuc").val(), Code: $("#txtMa").val(),
                    Description: b, Status: status
                },
                success: function (data) {
                    self.SetDefault();
                    self.RefreshTableUser('#tblDanhMucTinTuc');
                    $('#modalDanhMucTinTuc').modal('hide');
                    $.gritter.add({ title: "Bán thẻ 24h", text: "Cập nhật danh mục tin tức thành công", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                },
                error: function (data) {
                    self.RefreshTableUser('#tblDanhMucTinTuc');
                    $('#modalDanhMucTinTuc').modal('hide');
                    $.gritter.add({ title: "Bán thẻ 24h", text: "Cập nhật danh mục tin tức thất bại", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                }
            });
            //}
        });

        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            findKey = $("#txtfinKey").val().trim();
            self.RefreshTableUser("#tblDanhMucTinTuc");
            $("#txtfinKey").val("");
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.DanhMucTinTucTable = function () {
        //Load Danh sách thẻ treo: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblDanhMucTinTuc').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                        {
                            "name": "findKey",
                            "value": findKey
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
            "sAjaxSource": Config.AppUrl + 'QuanLyDanhMucTinTuc/DanhMucTinTuc',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "CategoryID", "class": "dt-center" },
            { "mData": "CategoryName" },
            { "mData": "Code", "class": "dt-center" },
            { "mData": "strStatus", "class": "dt-center" },
            {
                mData: "CategoryID",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a title='Sửa danh mục tin tức' data-id='" + o + "' class='suaDanhMucTinTuc btn-warning btn-xs' data-title='Sửa danh mục tin tức'><i class='fa fa-pencil-square-o'></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Xóa danh mục tin tức' data-id='" + o + "' class='xoaDanhMucTinTuc btn-danger btn-xs' data-title='Xóa danh mục tin tức'><i class='fa fa-trash'></i></a>" +
                        "</span>";
                }
            }
            ],
            "order": [0, 'desc'],
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

        // Sự kiện khi click vào sửa tin tức
        $('#tblDanhMucTinTuc').on('click', 'a.suaDanhMucTinTuc', function (e) {
            e.preventDefault();
            var idTin = $(this).attr("data-id");
            //self.RemoveToolTip();
            $.ajax({
                url: Config.AppUrl + 'QuanLyDanhMucTinTuc/ChiTietDanhMucTinTuc',
                async: false,
                data: { id: idTin },
                dataType: 'json',
                type: "post",
                success: function (data) {
                    $("#txtIdDanhMucTinTuc").text(data.CategoryID);
                    $("#txtTenDanhMuc").val(data.CategoryName);
                    $("#txtMa").val(data.Code);
                    CKEDITOR.instances['txtContent'].setData(data.Description);
                    $("#chkHienThi").prop("checked", data.Status);
                    $("#title").text("Sửa danh mục tin tức");
                    $("#modalDanhMucTinTuc").modal("show");
                }
            });
        });

        // Sự kiện khi click vào xóa tin tức
        $('#tblDanhMucTinTuc').on('click', 'a.xoaDanhMucTinTuc', function (e) {
            e.preventDefault();
            var id_Tin = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn xóa danh mục tin tức vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'QuanLyDanhMucTinTuc/XoaDanhMucTinTuc',
                        async: false,
                        data: { id: id_Tin },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblDanhMucTinTuc');
                                $.gritter.add({ title: "Bán thẻ 24h", text: "Xóa danh mục tin tức thành công.", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                            }
                        },
                        error: function (data) {
                            self.RefreshTableUser('#tblDanhMucTinTuc');
                            $.gritter.add({ title: "Bán thẻ 24h", text: "Xóa danh mục tin tức lỗi.", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                        }
                    })
                }
            })
        });

        // Phương thức tải lại dữ liệu lên table
        self.RefreshTableUser = function (tableId) {
            table = $(tableId).dataTable();
            oSettings = table.fnSettings();
            table.fnDraw();
        }

        // Thiết lập các giá trị về mặc định
        self.SetDefault = function () {
            $("#txtIdDanhMucTinTuc").text("");
            $("#txtTieuDe").val("");
            $("#txtCauHoi").val("");
            CKEDITOR.instances['txtContent'].setData("");
        }
    }
}

var findKey = "";

// Quản lý câu hỏi thường gặp
var QuanLyCauHoiThuongGap = function () {
    var self = this;

    // Hàm khởi tạo tin tức
    self.initCauHoiThuongGap = function () {
        self.CauHoiThuongGapTable();
        self.CauHoiThuongGapFunction();
    }

    // Hàm chức năng tin tức
    self.CauHoiThuongGapFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'MM/DD/YYYY HH:mm:ss'
        });

        $('#txtShortOrder').keyup(function (e) {
            if (this.value.trim().length > 3) {
                return this.value = this.value.substring(0, 3);
            }
            //remove all chars, except dash and digits
            this.value = this.value.replace(/[^\-0-9]/g, '');
        });

        // Cấu hình ckeditor thay textarea bằng trình soạn thảo ckeditor
        var editor = CKEDITOR.replace('txtContent', {
            customConfig: Config.AppUrl + 'Scripts/ckeditor/config.js',
        });

        // Cấu hình ckfinder lấy ảnh
        $("#btnAnh").click(function () {
            var finder = new CKFinder();
            finder.selectActionFunction = function (url) {
                //$("#txtImage").val(url.substring(1));
                $("#txtImage").val(url);
            };
            finder.popup();
        });

        // Cấu hình ckeditor thay textarea bằng trình soạn thảo ckeditor
        var editor = CKEDITOR.replace('txtGioiThieu', {
            customConfig: Config.AppUrl + 'Scripts/ckeditor/config.js',
        });

        // Sự kiện khi click vào button thêm tin tức
        $("#btnThemCauHoiThuongGap").click(function () {
            $("#txtIdTin").val("0")
            $("#modalCauHoiThuongGap").modal("show");
            $("#title").text("Thêm câu hỏi thường gặp");
            self.SetDefault();
        });

        // Sự kiện khi click vào button cập nhật tin
        $("#btnCapNhatCauHoiThuongGap").click(function () {
            if (true) {
                var dateTime = $('#txtThoiGianTao').val();
                var a = CKEDITOR.instances['txtGioiThieu'].getData();
                var b = CKEDITOR.instances['txtContent'].getData();
                $.ajax({
                    url: Config.AppUrl + 'QuanLyCauHoiThuongGap/CapNhatCauHoiThuongGap',
                    async: false,
                    type: "post",
                    data: {
                        FaqID: $("#txtIdCauHoiThuongGap").text(), Title: $("#txtTieuDe").val(), Question: $("#txtCauHoi").val(), CreateDate: $("#txtThoiGianTao").val(),
                        Answer: a, FullAnswer: b
                    },
                    success: function (data) {
                        self.SetDefault();
                        self.RefreshTableUser('#tblCauHoiThuongGap');
                        $('#modalCauHoiThuongGap').modal('hide');
                        $.gritter.add({ title: "Bán thẻ 24h", text: "Cập nhật câu hỏi thường gặp thành công", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                    },
                    error: function (data) {
                        self.RefreshTableUser('#tblCauHoiThuongGap');
                        $('#modalCauHoiThuongGap').modal('hide');
                        $.gritter.add({ title: "Bán thẻ 24h", text: "Cập nhật câu hỏi thường gặp thất bại", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                    }
                });
            }
        });

        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            findKey = $("#txtfinKey").val().trim();
            self.RefreshTableUser("#tblCauHoiThuongGap");
            $("#txtfinKey").val("");
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.CauHoiThuongGapTable = function () {
        //Load Danh sách thẻ treo: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblCauHoiThuongGap').DataTable({
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
            "sAjaxSource": Config.AppUrl + 'QuanLyCauHoiThuongGap/DanhSachCauHoiThuongGap',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "FaqID", "class": "dt-center" },
            { "mData": "Title" },
            { "mData": "strCreateDate" },
            {
                mData: "FaqID",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a title='Sửa câu hỏi thường gặp' data-id='" + o + "' class='suaCauHoiThuongGap btn-warning btn-xs' data-title='Sửa câu hỏi thường gặp'><i class='fa fa-pencil-square-o'></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Xóa câu hỏi thường gặp' data-id='" + o + "' class='xoaCauHoiThuongGap btn-danger btn-xs' data-title='Xóa câu hỏi thường gặp'><i class='fa fa-trash'></i></a>" +
                        "</span>";
                }
            }
            ],
            "order": [2, 'desc'],
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
        $('#tblCauHoiThuongGap').on('click', 'a.suaCauHoiThuongGap', function (e) {
            e.preventDefault();
            var idTin = $(this).attr("data-id");
            //self.RemoveToolTip();
            $.ajax({
                url: Config.AppUrl + 'QuanLyCauHoiThuongGap/ChiTietCauHoiThuongGap',
                async: false,
                data: { id: idTin },
                dataType: 'json',
                type: "post",
                success: function (data) {
                    $("#txtIdCauHoiThuongGap").text(data.FaqID);
                    $("#txtTieuDe").val(data.Title);
                    $("#txtCauHoi").val(data.Question);
                    CKEDITOR.instances['txtGioiThieu'].setData(data.Answer);
                    CKEDITOR.instances['txtContent'].setData(data.FullAnswer);
                    $("#title").text("Sửa câu hỏi thường gặp");
                    $("#modalCauHoiThuongGap").modal("show");
                }
            });
        });

        // Sự kiện khi click vào xóa tin tức
        $('#tblCauHoiThuongGap').on('click', 'a.xoaCauHoiThuongGap', function (e) {
            e.preventDefault();
            var id_Tin = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn xóa câu hỏi thường gặp vừa chọn?", function (result) {
                $.ajax({
                    url: Config.AppUrl + 'QuanLyCauHoiThuongGap/XoaCauHoiThuongGap',
                    async: false,
                    data: { id: id_Tin },
                    dataType: 'json',
                    type: "post",
                    success: function (data) {
                        if (data == "success") {
                            self.RefreshTableUser('#tblCauHoiThuongGap');
                            $.gritter.add({ title: "Bán thẻ 24h", text: "Xóa câu hỏi thường gặp thành công.", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                        }
                    },
                    error: function (data) {
                        self.RefreshTableUser('#tblCauHoiThuongGap');
                        $.gritter.add({ title: "Bán thẻ 24h", text: "Xóa câu hỏi thường gặp lỗi.", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                    }
                })
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
            $("#txtIdCauHoiThuongGap").text("");
            $("#txtTieuDe").val("");
            $("#txtCauHoi").val("");
            CKEDITOR.instances['txtGioiThieu'].setData("");
            CKEDITOR.instances['txtContent'].setData("");
        }


        // Validate data: Kiểm tra tính hợp lệ của dũ liệu
        //self.ValidateData = function () {
        //    var flag = true;

        //    // Validate data txtTitle: Kiểm tra tính hợp lệ textboxt Tiêu đề
        //    var title = $('#txtTieuDe').val();
        //    if ($.trim(title) == '') {
        //        $($('#txtTieuDe')).tooltip('hide').attr('data-original-title', 'Vui lòng nhập tiêu đề tin').tooltip('fixTitle').addClass('errorClass');
        //        flag = false;
        //    } else {
        //        $('#txtTieuDe').data("title", "").removeClass("errorClass").tooltip("destroy");
        //    }

        //    var categoryId = $("#slDanhMuc option").filter(":selected").val();
        //    if (categoryId == 0) {
        //        $($('#slDanhMuc')).tooltip('hide').attr('data-original-title', 'Vui lòng lựa chọn nhóm tin').tooltip('fixTitle').addClass('errorClass');
        //        flag = false;
        //    } else {
        //        $('#slDanhMuc').data("title", "").removeClass("errorClass").tooltip("destroy");
        //    }

        //    return flag;
        //}

        // Remove Tooltip: loại bỏ tooltip
        //self.RemoveToolTip = function () {
        //    $('#txtTieuDe').data("title", "").removeClass("errorClass").tooltip("destroy");
        //    $("#txtTieuDeNgan").data("title", "").removeClass("errorClass").tooltip("destroy");
        //    $("#txtCodeCat").data("title", "").removeClass("errorClass").tooltip("destroy");
        //    $("#slDanhMuc").data("title", "").removeClass("errorClass").tooltip("destroy");
        //    $("#txtImage").data("title", "").removeClass("errorClass").tooltip("destroy");
        //    $("#txaMetaDesc").data("title", "").removeClass("errorClass").tooltip("destroy");
        //    $("#txtMeta").data("title", "").removeClass("errorClass").tooltip("destroy");
        //    $("#txtShortOrder").data("title", "").removeClass("errorClass").tooltip("destroy");
        //}

    }
}
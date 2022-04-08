

var findKey = "";

// Quản lý tin tức
var QuanLyTinTuc = function () {
    var self = this;

    // Hàm khởi tạo tin tức
    self.initTinTuc = function () {
        self.TinTucTable();
        self.TinTucFunction();
    }

    // Hàm chức năng tin tức
    self.TinTucFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'MM/DD/YYYY HH:mm:ss'
        });
        $('#txtTieuDe').keyup(function (e) {
            $('.titlecount').text(this.value.trim().length);
            if (this.value.trim().length > 56) {
                $('.titlecount').attr("style", "color:#ff0000");
            } else {
                $('.titlecount').attr("style", "color:#444");
            }            
        });
        $('#txaMetaDesc').keyup(function (e) {
            $('.metadesccount').text(this.value.trim().length);
            if (this.value.trim().length > 156) {
                $('.metadesccount').attr("style", "color:#ff0000");
            } else {
                $('.metadesccount').attr("style", "color:#444");
            }
        });
        $('#txtMeta').keyup(function (e) {
            $('.metacount').text(this.value.trim().length);
            if (this.value.trim().length > 156) {
                $('.metacount').attr("style", "color:#ff0000");
            } else {
                $('.metacount').attr("style", "color:#444");
            }
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
        $("#btnThemTinTuc").click(function () {
            $("#txtIdTin").text("0");
            $("#myModalTinTuc").modal("show");
            $("#title").text("Thêm tin tức");
            self.SetDefault();
            DanhSachNhomTin();
        });

        // Sự kiện khi click vào button cập nhật tin
        $("#btnCapNhatTin").click(function () {
            if (self.ValidateData() == true) {
                var dateTime = $('#txtNgayTao').val();
                var categoryId = $("#slDanhMuc option").filter(":selected").val();
                var a = CKEDITOR.instances['txtGioiThieu'].getData();
                var b = CKEDITOR.instances['txtContent'].getData();
                var status = $("#chkHienThi").is(":checked") ? true : false;
                $.ajax({
                    url: Config.AppUrl + 'QuanLyTinSeo/CapNhatTinTuc',
                    async: false,
                    type: "post",
                    data: {
                        Id: $("#txtIdTin").text(), categoryid: categoryId, Title: $("#txtTieuDe").val(), Description: b, PublicDate: dateTime, SortOder: $("#txtShortOrder").val(), IsActive: status,
                        CreateDate: dateTime, CreateUser: 1, ImageUrl: $("#txtImage").val(), Intro: a,
                        CodeCat: $("#txtCodeCat").val(), ShortTitle: $("#txtTieuDeNgan").val(), MetaDesc: $("#txaMetaDesc").val(), Meta: $("#txtMeta").val()
                    },
                    success: function (data) {
                        self.RefreshTableUser('#tblTinTuc');
                        $('#myModalTinTuc').modal('hide');
                        $.gritter.add({ title: "Đổi thẻ 24/7", text: "Cập nhật tin thành công", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                    },
                    error: function (data) {
                        self.RefreshTableUser('#tblTinTuc');
                        $('#myModalTinTuc').modal('hide');
                        $.gritter.add({ title: "Đổi thẻ 24/7", text: "Cập nhật tin thất bại", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1500" });
                    }
                });
            }
        });

        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            findKey = $("#txtfinKey").val().trim();
            self.RefreshTableUser("#tblTinTuc");
            $("#txtfinKey").val("");
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.TinTucTable = function () {
        //Load Danh sách thẻ treo: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblTinTuc').DataTable({
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
            "sAjaxSource": Config.AppUrl + 'QuanLyTinSeo/DanhSachTinTuc',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Id" },
            { "mData": "Title" },
            { "mData": "CodeCat" },
            { "mData": "strCreateDate" },
            {
                mData: "Id",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a title='Sửa tin tức' data-id='" + o + "' class='_suaTinTuc btn-warning btn-xs' data-title='Sửa tin tức'><i class='fa fa-pencil-square-o'></i></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Xóa tin tức' data-id='" + o + "' class='_xoaTinTuc btn-danger btn-xs' data-title='Xóa tin tức'><i class='fa fa-trash'></i></i></a>" +
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

        // Sự kiện khi click vào sửa tin tức
        $('#tblTinTuc').on('click', 'a._suaTinTuc', function (e) {
            e.preventDefault();
            DanhSachNhomTin();
            var idTin = $(this).attr("data-id");
            self.RemoveToolTip();
            $.ajax({
                url: Config.AppUrl + 'QuanLyTinSeo/ChiTietTin',
                async: false,
                data: { id: idTin },
                dataType: 'json',
                type: "post",
                success: function (data) {
                    $("#txtIdTin").text(data.Id);
                    $("#txtTieuDe").val(data.Title);
                    $("#txtTieuDeNgan").val(data.ShortTitle);
                    $("#txtCodeCat").val(data.CodeCat);
                    $("#slDanhMuc").val(data.categoryid);
                    $("#txtImage").val(data.ImageUrl);
                    CKEDITOR.instances['txtGioiThieu'].setData(data.Intro);
                    CKEDITOR.instances['txtContent'].setData(data.Description);
                    $("#txaMetaDesc").val(data.MetaDesc);
                    $("#txtMeta").val(data.Meta);
                    $("#chkHienThi").prop("checked", data.IsActive);
                    $("#txtShortOrder").val(data.SortOder);
                    $("#title").text("Cập nhật tin");
                    $("#myModalTinTuc").modal("show");
                }
            });
        });

        // Sự kiện khi click vào xóa tin tức
        $('#tblTinTuc').on('click', 'a._xoaTinTuc', function (e) {
            e.preventDefault();
            var id_Tin = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn xóa tin vừa chọn?", function (result) {
                $.ajax({
                    url: Config.AppUrl + 'QuanLyTinSeo/XoaTinTuc',
                    async: false,
                    data: { id: id_Tin },
                    dataType: 'json',
                    type: "post",
                    success: function (data) {
                        if (data == "success") {
                            self.RefreshTableUser('#tblTinTuc');
                            $.gritter.add({ title: "Đổi thẻ 24/7", text: "Xóa tin thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                        }
                    },
                    error: function (data) {
                        self.RefreshTableUser('#tblTinTuc');
                        $.gritter.add({ title: "Đổi thẻ 24/7", text: "Xóa tin lỗi !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
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
            $("#txtIdTin").text("0");
            $("#txtTieuDe").val("");
            $("#txtTieuDeNgan").val("");
            $("#txtCodeCat").val("");
            $("#slDanhMuc").val("");
            $("#txtImage").val("");
            CKEDITOR.instances['txtGioiThieu'].setData("");
            CKEDITOR.instances['txtContent'].setData("");
            $("#txaMetaDesc").val("");
            $("#txtMeta").val("");
            $("#chkHienThi").prop("checked", false);
            $("#txtShortOrder").val("");
        }


        // Validate data: Kiểm tra tính hợp lệ của dũ liệu
        self.ValidateData = function () {
            var flag = true;

            // Validate data txtTitle: Kiểm tra tính hợp lệ textboxt Tiêu đề
            var title = $('#txtTieuDe').val();
            if ($.trim(title) == '') {
                $($('#txtTieuDe')).tooltip('hide').attr('data-original-title', 'Vui lòng nhập tiêu đề tin').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#txtTieuDe').data("title", "").removeClass("errorClass").tooltip("destroy");
            }

            var categoryId = $("#slDanhMuc option").filter(":selected").val();
            if (categoryId == 0) {
                $($('#slDanhMuc')).tooltip('hide').attr('data-original-title', 'Vui lòng lựa chọn nhóm tin').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#slDanhMuc').data("title", "").removeClass("errorClass").tooltip("destroy");
            }

            return flag;
        }

        // Remove Tooltip: loại bỏ tooltip
        self.RemoveToolTip = function () {
            $('#txtTieuDe').data("title", "").removeClass("errorClass").tooltip("destroy");
            $("#txtTieuDeNgan").data("title", "").removeClass("errorClass").tooltip("destroy");
            $("#txtCodeCat").data("title", "").removeClass("errorClass").tooltip("destroy");
            $("#slDanhMuc").data("title", "").removeClass("errorClass").tooltip("destroy");
            $("#txtImage").data("title", "").removeClass("errorClass").tooltip("destroy");
            $("#txaMetaDesc").data("title", "").removeClass("errorClass").tooltip("destroy");
            $("#txtMeta").data("title", "").removeClass("errorClass").tooltip("destroy");
            $("#txtShortOrder").data("title", "").removeClass("errorClass").tooltip("destroy");
        }

    }
}

// gọi danh sách nhà cung cấp lên drop-down list
function DanhSachNhomTin() {
    $.ajax({
        url: Config.AppUrl + 'QuanLyTinSeo/DanhSachNhomTin',
        async: false,
        data: {},
        type: "get",
        success: function (data) {
            var cbboxlgt = $('#slDanhMuc');
            $(cbboxlgt).empty();
            $(cbboxlgt).append('<option value="0">----- Lựa chọn nhóm tin -----</option>');
            if (data != "false") {
                $.each(data, function (key, val) {
                    opt = $('<option></option>');
                    $(cbboxlgt).append(opt);
                    $(opt).val(val.CategoryID);
                    $(opt).text(val.CategoryName.trim());
                });
            }
        }
    })
}


var rows_selected = [];
var findKey = "";
var trangThai = -1;

// Quản lý giao dịch
var Email = function () {
    var self = this;
    $('#btnXoa').attr("disabled", "disabled");

    // Hàm khởi tạo
    self.initEmail = function () {
        self.EmailTable();
        self.EmailFunction();
    }

    // Hàm chức năng
    self.EmailFunction = function () {
        // Sự kiện khi click vào button tìm kiếm
        $("#btnTimKiem").click(function () {
            Busy.Block();
            findKey = $("#txtfinKey").val().trim();
            trangThai = $("#optNhom option").filter(":selected").val();
            self.RefreshTableUser("#tblEmail");
            $("#txtfinKey").val("");
            $.unblockUI();
        });

        // Sự kiện khi xóa nhiều email
        $("#btnXoa").click(function () {
            self.XoaNhieuEmail();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.EmailTable = function () {
        //Load Email: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblEmail').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                    {
                        "name": "findKey",
                        "value": findKey
                    },
                    {
                        "name": "trangThai",
                        "value": trangThai
                    }
                )
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            "sAjaxSource": Config.AppUrl + 'QuanLyEmail/GetData',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            {
                mData: "Id",
                //targets: 0,
                'width': '20px',
                searchable: false,
                orderable: false,
                render: function (data, type, row) {
                    if (type === 'display') {
                        return '<input type="checkbox" class="editor-active">';
                    }
                    return data;
                },
                className: "dt-body-center"
            },
            { "mData": "SendTo" },
            { "mData": "Subject" },
            { "mData": "strCreateDate" },
            { "mData": "strStatus", "class": "dt-center" },
            {
                mData: "Id",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a title='Xóa email lỗi' data-id='" + o + "' class='_xoaEmailLoi btn-danger btn-xs' data-title='Xóa email lỗi'><i class='fa fa-trash'></i></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Gửi lại email' data-id='" + o + "' class='_guiLaiEmail btn-warning btn-xs' data-title='Gửi lại Email'><i class='fa fa-envelope-o'></i></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Chi tiết email' data-id='" + o + "' class='_chiTietEmail btn-success btn-xs' data-title='Chi tiết email'><i class='fa fa-umbrella'></i></i></a>" +
                        "</span>";
                }
            }
            ],
            "order": [3, 'desc'],
            "rowCallback": function (row, data, dataIndex) {
                // Get row ID
                var rowId = data["Id"];
                // If row ID is in the list of selected row IDs
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            },
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

        // Khi người dùng click checkbox Select_all_user trên thead
        $('#tblEmail input[name="luaChonNhieuEmail"]').on('click', function (e) {
            if (this.checked) {
                $('#tblEmail tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#tblEmail tbody input[type="checkbox"]:checked').trigger('click');
            }
            e.stopPropagation();
        });

        //// Handle click on checkbox: khi người dùng click vào checkbox trên tbody
        $('#tblEmail tbody').on('click', 'input[type="checkbox"]', function (e) {
            var $row = $(this).closest('tr');
            // Get row data: lấy dữ liệu trên row
            var data = dTable.row($row).data();
            // Get row ID: lấy Id của bản ghi lựa chọn
            var rowId = data["Id"];

            // Determine whether row ID is in the list of selected row IDs: xác định vị trí của bản ghi trong mảng
            var index = $.inArray(rowId, rows_selected);

            // If checkbox is checked and row ID is not in list of selected row IDs: Kiểm tra checkbox có được tích hay không
            // Nếu tích thì đẩy vào mảng
            if (this.checked && index === -1) {
                rows_selected.push(rowId);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                // Nếu không tích thì loại bỏ khỏi mảng
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            // Add class selected for row selected: thêm class selected cho dòng được lựa chọn
            // opposite discard: Ngược lại loại bỏ
            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            // Check length array: Kiểm tra mảng lưu trữ bản ghi lựa chọn để được xóa
            if (rows_selected.length > 0) {
                $('#btnXoa').removeAttr("disabled");
            } else {
                $('#btnXoa').attr("disabled", "disabled");
            }
            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Sự kiện khi click vào xóa email
        $('#tblEmail').on('click', 'a._xoaEmailLoi', function (e) {
            e.preventDefault();
            var id_Email = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn xóa email vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: Config.AppUrl + 'QuanLyEmail/XoaEmail',
                        async: false,
                        data: { id: id_Email },
                        dataType: 'json',
                        type: "post",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblEmail');
                                $.gritter.add({ title: "bán thẻ 24h", text: "Xóa email thành công !", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                            }
                        }
                    });
                }
            });
        });

        // Sự kiện khi click vào gửi lại email
        $('#tblEmail').on('click', 'a._guiLaiEmail', function (e) {
            e.preventDefault();
            var id_Email = $(this).attr("data-id");
            self.GuiLaiEmail(id_Email);
        });

        // Sự kiện khi click xem chi tiết nội dung mail
        $('#tblEmail').on('click', 'a._chiTietEmail', function (e) {
            e.preventDefault();
            var id_Email = $(this).attr("data-id");
            $.ajax({
                url: Config.AppUrl + 'QuanLyEmail/ChiTietEmail',
                data: { id: id_Email },
                type: "POST",
                success: function (data) {
                    $("#txtEmail").val(data.SendTo);
                    $("#txtTieuDeMail").val(data.Subject);
                    $("#txtThoiGian").val(data.strCreateDate);
                    $("#txaContentMail").html(data.MailContent);
                    $("#myModalNoiDungEmail").modal('show');
                },
                error: function () {
                    $.gritter.add({ title: "bán thẻ 24h", text: "Xem chi tiết email lỗi", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
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

    self.GuiLaiEmail = function (idEmail) {
        bootbox.confirm("<label>Vui lòng nhập email muốn gửi lại:</label> <br><br><input type='text' id='txtResendEmail' placeholder='Email muốn gửi lại' class='form-control' />", function (result) {
            if (result == true) {
                $.ajax({
                    url: Config.AppUrl + 'QuanLyEmail/GuiLaiEmail',
                    data: { id: idEmail, resendEmail: $("#txtResendEmail").val().trim() },
                    type: "POST",
                    beforeSend: function () {
                        Busy.Block();
                    },
                    success: function (data) {
                        self.RefreshTableUser('#tblEmail');
                        $.gritter.add({ title: "bán thẻ 24h", text: "Gửi lại email thành công", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                    error: function () {
                        $.gritter.add({ title: "bán thẻ 24h", text: "Gửi lại email thành công", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                    }
                });
            }
        });
    }

    // Phương thức xóa nhiều email
    self.XoaNhieuEmail = function () {
        bootbox.confirm("Bạn có chắc chắn muốn xóa những email vừa chọn?", function (result) {
            if (result == true) {
                $.ajax({
                    url: Config.AppUrl + 'QuanLyEmail/XoaNhieuEmail',
                    data: { id: rows_selected.toString() },
                    type: "POST",
                    beforeSend: function () {
                        Busy.Block();
                    },
                    success: function (data) {
                        rows_selected = [];
                        $('#luaChonNhieuEmail').prop('checked', false);
                        self.RefreshTableUser('#tblEmail');
                        $.gritter.add({ title: "bán thẻ 24h", text: "Xóa nhiều email thành công", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                    error: function () {
                        $.gritter.add({ title: "bán thẻ 24h", text: "Xóa nhiều email lỗi", image: "/uploads/files/admin/success.png", class_name: "clean", time: "1000" });
                    }
                });
            }
        });
    }

}

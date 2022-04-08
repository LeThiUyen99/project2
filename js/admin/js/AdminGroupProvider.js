var QuanLyTaiBangGia = function () {
    var self = this;

    // Hàm khởi tạo
    self.initQuanLyBangGia = function () {
        $("#search").val("");
        
        $("#providertype").val(0);
        self.QuanLyBangGiaTable();
        self.QuanLyBangGiaFunction();
        
    }

    // Hàm chức năng
    self.QuanLyBangGiaFunction = function () {

        // Sự kiện khi click vào button tìm kiếm
        $("#btnSearchGroupP").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblBangGia");
            
            $.unblockUI();
        });
        
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.QuanLyBangGiaTable = function () {
        //Load Người dùng: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblBangGia').DataTable({
            "bDestroy": true,
            //"fnServerParams": function (aoData) {
               // aoData.push(
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
//                            "name": "trangThai",
//                            "value": $("#optTrangThai option").filter(":selected").val()
//                        }
//                    )
//            },
            //"bFilter": false,
            "ajax": {
                "url": "/GroupsProviders/GetAllGroupProviders",
                "type": "GET",
                "datatype": "json",
                'data': function (d) {                 	
                    d.findkey = $("#search").val().trim(); 
                                    
                    d.type=$("#providertype option").filter(":selected").val();
                }
            },
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtip', "buttons": ['excelFlash'],
            //"sAjaxSource": '/QuanLyTaiKhoan/GetData',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Id" },
            { "mData": "GroupName" },
            { "mData": "ProviderName" },
            { "mData": "TypeName", "class": "dt-center" },
            { "mData": "Price", "class": "dt-center" },
            { "mData": "Description", className: "dt-body-center" },
            {"mData":"StrStatus"},
            {
                mData: "Id",
                className: "dt-body-center",
                bSortable: false,
                mRender: function (o) {
                    return "<span style='white-space: nowrap;'>" +
                        "<a title='Hủy kích hoạt' data-id='" + o + "' class='_HuyKichHoatTaiKhoan btn-warning btn-xs' data-title='Hủy kích hoạt '><i style='color:red' class='fa fa-recycle'></i></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Kích hoạt' data-id='" + o + "' class='_KichHoatTaiKhoan btn-success btn-xs' data-title='Kích hoạt'><i class='fa fa-check-square-o'></i></i></a>" + "&nbsp;&nbsp;|&nbsp;&nbsp;" +
                        "<a title='Sửa' data-id='" + o + "' class='_Themmoigroupprovider btn-danger btn-xs' data-title='Sửa'><i class='fab fa-adn'></i></i></a>"+ 
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
        $('#tblBangGia').on('click', 'a._HuyKichHoatTaiKhoan', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn hủy kích hoạt người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: '/GroupsProviders/CapNhatTrangThaiGroupProvider',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "huy" },
                        dataType: 'json',
                        type: "GET",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblBangGia');
                                $.gritter.add({ title: "Doi the 66", text: "Cập nhật trạng thái người dùng thành công !", image: "/upload/success.png", class_name: "clean", time: "1500" });
                            }
                            else {
                                $.gritter.add({ title: "Doi the 66", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/upload/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });

        // Sự kiện khi click vào hủy kích hoạt tài khoản người dùng
        $('#tblBangGia').on('click', 'a._KichHoatTaiKhoan', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn kích hoạt tài khoản người dùng vừa chọn?", function (result) {
                if (result == true) {
                    $.ajax({
                        url: '/GroupsProviders/CapNhatTrangThaiGroupProvider',
                        async: false,
                        data: { id: id_TaiKhoan, trangThai: "kichHoat" },
                        dataType: 'json',
                        type: "GET",
                        success: function (data) {
                            if (data == "success") {
                                self.RefreshTableUser('#tblBangGia');
                                $.gritter.add({ title: "Doi the 66", text: "Cập nhật trạng thái người dùng thành công !", image: "/upload/success.png", class_name: "clean", time: "1500" });
                            }
                            else if (data == "error") {
                                $.gritter.add({ title: "Doi the 66", text: "Trạng thái bạn muốn cập nhật không phù hợp !", image: "/upload/success.png", class_name: "clean", time: "1500" });
                            }
                        }
                    });
                }
            });
        });
        $('#tblBangGia').on('click', 'a._Themmoigroupprovider', function (e) {
            e.preventDefault();
            var id_TaiKhoan = $(this).attr("data-id");
            bootbox.confirm("Bạn có chắc chắn muốn Thêm mới nhóm?", function (result) {
                if (result == true) {
                    
                    $.ajax({
                        url: '/GroupsProviders/GetGroupProviderByID',
                        async: false,
                        data: { Id: id_TaiKhoan },
                        dataType: 'json',
                        type: "GET",
                        success: function (data) {
                            if (data.success == true) {
                                var result=data.data
                                

                                $("#groupModalLabel").html("Sửa bảng giá");
                                $("#Id").val(id_TaiKhoan);
                                $("#typegroupprovider").val(result.Type);
                                $("#groupPrice").val(result.Price);
                                $("#groupDescription").val(result.Description);
                                $("#groupStatus").val(result.Status);
                                $("#grouplistgroup").val(result.GroupId);
                                $("#groupprovider").val(result.ProviderId);
                                $("#txtStart").val(result.ToDate );
                                $("#txtEnd").val(result.FromDate);
                                $("#groupModal").modal("show");
                                //self.RefreshTableUser('#tblBangGia');
                                //$.gritter.add({ title: "Doi the 66", text: "C?p nh?t tr?ng thái ngu?i dùng thành công !", image: "/upload/success.png", class_name: "clean", time: "1500" });
                            }
                            
                        }
                    });
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

    // Đếm số tài khoản
   

}
function AddGroupProvider() {
    $("#groupModalLabel").html("Thêm Group Provider");
    $("#Id").val("");
    $("#typegroupprovider").val("");
    $("#groupPrice").val("");
    $("#groupDescription").val("");
    $("#groupStatus").val("");
    $("#grouplistgroup").val("");
    $("#groupprovider").val("");
    //$("#txtStart").val("");
    //$("#txtEnd").val("");
    $("#groupModal").modal("show");
}

function ResetPass(e) {
    console.log(e);
}
function GroupEdit(e) {
    $("#groupModalLabel").html("Cập nhật thông tin đại lý");
    $("#Id").val(e.data.record.Id);
    $("#typegroupprovider").val(e.data.record.Type);
    $("#groupPrice").val(e.data.record.Price);
    $("#groupDescription").val(e.data.record.Description);
    if (e.data.record.Status == 1) {
        $("#groupStatus").val('1');
    }

    $("#grouplistgroup").val(e.data.record.GroupId);
    $("#groupprovider").val(e.data.record.ProviderId);
    $("#ctrlfromdatetxt").val('');
    //var fromdate = e.data.record.FromDate;
    //$("#ctrltodatetxt").datepicker('setDate', Date.now)
    //$("#txtEnd").val('');

    $("#groupModal").modal("show");

}

function Save() {
    var _Id = $("#Id").val();
    var _Type = $("#typegroupprovider").val();
    var _Price = $("#groupPrice").val();
    var _des = $("#groupDescription").val();
    var _status = $("#groupStatus").val();
    var _groupprovider = $("#groupprovider").val();
    var _grouplistgroup = $("#grouplistgroup").val();
    var _ctrlfromdatetxt = $("#txtStart").val();
    var _ctrltodatetxt = $("#txtEnd").val();
    

    if (_Id == '') {
        _Id = 0;
    }
    if (_Type == '') {
        $("#typegroupprovider").addClass("invalid");
        return false;
    } else {
        $("#typegroupprovider").removeClass("invalid");
    }

    if (_Price == '') {
        $("#groupPrice").addClass("invalid");
        return false;
    } else {
        $("#groupPrice").removeClass("invalid");
    }
    var tgstatus = false;
    if (_status == 1) { tgstatus = true; } else { tgstatus = false; }
    var _groupEntity = {
        Id: _Id,
        Type: _Type,
        Price: _Price,
        Description: _des,
        Status: tgstatus,
        GroupId: _grouplistgroup,
        ProviderId: _groupprovider,
        FromDate: _ctrlfromdatetxt,
        ToDate: _ctrltodatetxt
    };

    var _data = _groupEntity;//JSON.stringify({ GroupProviderEntity: _groupEntity });
    //debugger;
    $.ajax({
        url: "/GroupsProviders/Save",
        type: "GET",
        data: _data,
        //contentType: "application/json",
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (obj1) {
            //debugger;
            //alert(obj1.Success);
            $("#groupModal").modal("hide");
            if(obj1.success==true){
                alert(obj1.msg);
            }else{
                alert('Thực hiện that bai');
            }
            
        },
        error: function (obj1) {
            alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
        },
        complete: function () {

        }
    });
    //.done(function () {

    //    grid.reload();
    //    $("#groupModal").modal("hide");
    //})
    //.fail(function () {

    //    alert("Unable to save.");
    //    $("#groupModal").modal("hide");
    //});
}
function Remove(e) {
    $.ajax({ url: "/GroupsProviders/removeGroupProviders", type: "POST", data: { id: e.data.id } })
        .done(function () {
            grid.reload();
        })
        .fail(function () {
            alert("Unable to remove.");
        });
}
function SearchGroup() {
    grid.reload({ searchString: $("#search").val(), type: $("#providertype").val() });
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
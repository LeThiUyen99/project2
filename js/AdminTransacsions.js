var date = moment(); //Get the current date

var start = date.format("YYYY-MM-DD 00:00");
var end = date.format("YYYY-MM-DD HH:mm");
var mLastClickTime = 0;
var nhom = -1;
var Transaction = function () {
    var self = this;    

    $('#datetimepicker2').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD HH:mm'
    });
    $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD HH:mm'
    });
    $("#ctrlsearchtransactionbtn").click(function () {  
         
        nhom = $("#search option").filter(":selected").val();
        start = $("#txtStart").val();
        end = $("#txtEnd").val();
        setTimeout(function(){self.RefreshTableQuanLyGiaoDich("#grid");}, 3000);
        setTimeout(function(){self.TotalMoney();}, 3000);
        //self.RefreshTableQuanLyGiaoDich("#grid");
        //self.TotalMoney();
    });

    self.Init = function () {
        var date = moment(); //Get the current date
        
        $("#txtEnd").val(date.format("YYYY-MM-DD HH:mm"));
        $("#txtStart").val(date.format("YYYY-MM-DD HH:mm"))
        //$("#money").val('');
        self.QuanLyGiaoDichDataTable();
        self.TotalMoney();
    }
    self.QuanLyGiaoDichDataTable = function () {
        //Load Template Document: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#grid').DataTable({
            "bDestroy": true,
            "sPaginationType": "full_numbers",
            "processing": true, // for show progress bar
            "serverSide": true, // for process server side
            "bProcessing": true,
            "oSearch": { "bSmart": true, "bRegex": true },
            "sDom": 'it<pl>',
            "ajax": {
                "url": "/Transacsions/GetAllTransacsions",
                "type": "GET",
                "datatype": "json",
                timeout: 60000,                
                'data': function (d) {                 	
                    d.fromDate = $("#txtStart").val(); 
                    d.toDate = $("#txtEnd").val();                    
                    d.nhom=nhom;
                }
            },
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            "columns": [
                { "data": "GroupName" },
                { "data": "UserName" },
                { "data": "Email" },
                { "data": "TypeName" },
                { "data": "StrPrice" },
                {"data":"StrCreateDate"}
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
    

    // Load lại dữ liệu lên table
    self.RefreshTableQuanLyGiaoDich = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }
    self.TotalMoney = function () {
        $.ajax({
            url: '/Transacsions/GetAllTransacsions',
            type: 'GET',
            datatype: "json",
            data: {fromDate:start,toDate:end, nhom:nhom },
            success: function (data) {
                $("#idSumMoneyValue").text(data.tongtien);
                $("#idSumPriceValue").text(data.sumprice);
            }
        });
    }
}

function AddPriceAccount() {

    $("#GroupAddPrice").modal("show");

}
function timtaikhoan() {
    if (validate_input_email()) {
        //alert("true");
        var adata = { email: $('#ctrlEmailaddprice').val() };
        $.ajax({
            url: "/administrator/Users/GetUserByEmail",
            type: 'POST',
            data: adata,
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                if (obj.Success == true) {
                   
                    $("#txtHoTen").text(obj.data.Name);
                    $("#txtEmail").text(obj.data.UserName);
                    $("#txtdienthoai").text(obj.data.Phone);
                    $("#BankAccount").text(obj.data.BankAccount);
                    $("#BankNumber").text(obj.data.BankNumber);
                    $("#BankName").text(obj.data.BankName);
                    //$("#txtnguoinhan").val(obj.data.UserId);
                    //$("#ctrlbankinfo").show();
                    //$("#ctrlgroupsotienchuyen").show();
                    //gridtrans.reload();


                } else {
                    alert('Không tìm thấy thông tin tài khoản! ');
                    //location.reload(true);
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                //location.reload(true);
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }
}
function validate_input_email() {
    var flag = true;
    var pinumber = $('#ctrlEmailaddprice').val();
    if ($.trim(pinumber) == '') {
        $($('#ctrlEmailaddprice')).tooltip('hide').attr('title', 'Hãy nhập email').tooltip('fixTitle').addClass('errorClass');
        flag = false;
    } else {
        $('#ctrlEmailaddprice').data("title", "").removeClass("errorClass").tooltip("destroy");
    }
    if ($.trim(pinumber) != '') {
        if (!Common.IsValidEmail(pinumber)) {
            $($('#ctrlEmailaddprice')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlEmailaddprice').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
    }
    return flag;
}
function DuyetGuiTien(e) {
    $.ajax({
        url: "/administrator/ADThongBao/DuyetGuiTien",
        type: 'POST',
        data: { id: e.data.id },
        dataType: 'json',
        success: function (obj) {
            if (obj.Success == true) {
                grid.reload();
            } else {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            }
        },
        error: function (obj) {
            alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
        }
    });
}

function XemChiTietUser(e) {
    e.preventDefault();
    //$('#UserDetailModal').modal('hide');
    $.ajax({
        url: "/administrator/ADThongBao/GetUserInfoById",
        type: 'POST',
        data: { id: e.data.id },
        dataType: 'json',
        success: function (obj) {
            if (obj.Success == true) {
                $('#txtInfoUserName').html(obj.userInfo.UserName);
                $('#txtInfoCash').html(e.data.record.StrAmount );
                $('#txtInfoName').html(obj.userInfo.Name);
                $('#txtInfoPhone').html(obj.userInfo.Phone);
                $('#txtInfoBankNumber').html(obj.userInfo.BankNumber);
                $('#txtInfoBankAccount').html(obj.userInfo.BankAccount);
                $('#txtInfoBankName').html(obj.userInfo.BankName);
                $('#txtInfoBankBranch').html(obj.userInfo.BankBranch);
                //$('#txtInfoStrCash').val(obj.userInfo.StrCash);
                //e.preventDefault();
                //$('#UserDetailModal')
                //     .removeData()
                //     .html('loading....')
                //     .load($(this).attr('href'))
                //     .modal({ show: true, backdrop: 'static' });
                //$('#UserDetailModal').modal({
                //    backdrop: 'static',
                //    keyboard: false
                //});
                $("#UserDetailModal").modal("show");
            } else {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            }
        },
        error: function (obj) {
            alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
        }
    });
     
    
}
function Edit(e) {
    $("#myModalLabel").html("Cập nhật thông tin người dùng");
    $("#userId").val(e.data.record.UserId);
    $("#fullname").val(e.data.record.Name);
    $("#name").val(e.data.record.UserName);
    $("#password").val('');
    $("#passwordConfirm").val('');
    //$("#GroupDropBox").val(e.data.record.GroupId);
    $('#GroupDropBox option[value=' + e.data.record.GroupId  + ']').attr('selected', 'selected');
    $("#playerModal").modal("show");
}

function Save() {
    var c2 = $("#c2").val();
    //alert(c2);
    var _data = { sotienchuyen: c2 }
    $.ajax({
        url: "/administrator/Transacsions/ToupMoneybyHand",
        type: "POST",
        data: _data,
        //contentType: "application/json",
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (obj1) {
            //debugger;
            //alert(obj1.Success);
            if (obj1.Success == true) {
                $("#GroupAddPrice").modal("hide");

                alert('Thực hiện thành công');
                grid.reload();
            } else {
                $("#GroupAddPrice").modal("hide");

                alert('Có lỗi khi cộng tiền');
            }
        },
        error: function (obj1) {
            alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
        },
        complete: function () {

        }
    });
}
function Remove(e) {
    $.ajax({ url: "Home/Remove", type: "POST", data: { id: e.data.id } })
        .done(function () {
            grid.reload();
        })
        .fail(function () {
            alert("Unable to remove.");
        });
}
function Search() {
    $("#boxLoading").show();
     
    $.ajax({
        url: "/administrator/Transacsions/CalAllTransacsions",
        type: 'GET',
        data: { typeString: $("#search").val(), fdate: $("#ctrlfromdatetxt").val(), tdate: $("#ctrltodatetxt").val() },
        dataType: 'json',
        success: function (obj) {
            $("#idSumMoneyValue").html(obj.total);
            $("#boxLoading").hide();
        },
        error: function (obj) {
            alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
        }
    });

    grid.reload({ typeString: $("#search").val(), fdate: $("#ctrlfromdatetxt").val(), tdate: $("#ctrltodatetxt").val() });
}

function SearchRutTien() {
    $("#boxLoading").show();

    //$.ajax({
    //    url: "/administrator/Transacsions/CalAllTransacsions",
    //    type: 'GET',
    //    data: { statusString: $("#ctrltrangthai").val(), typeString: 6, fdate: $("#ctrlfromdatetxt").val(), tdate: $("#ctrltodatetxt").val() },
    //    dataType: 'json',
    //    success: function (obj) {
    //        $("#idSumMoneyValue").html(obj.total);
    //        $("#boxLoading").hide();
    //    },
    //    error: function (obj) {
    //        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
    //    }
    //});

    grid.reload({ statusString: $("#ctrltrangthai").val(), bankString: $("#ctrlbanknamedrp").val(), fdate: $("#ctrlfromdatetxt").val(), tdate: $("#ctrltodatetxt").val() });
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
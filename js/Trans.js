function Ruttien() {
    msgBoxImagePath = "../images/", $("#btnTaoLenhRutTien").click(function() {
        var t = $("#ctrlAmounttxt").val(),
            n = $("#ctrlmatkhaucap2").val();
        $.ajax({
            url: "/trans/taolenhruttien",
            type: "POST",
            data: {
                sotien: t,
                pass2: n,
                ghichu:$("#ctrlghichuruttien").val()
            },
            dataType: "json",
            beforeSend: function() {
                $("#boxLoading").show()
            },
            success: function(t) {
                1 == t.Success ? $.msgBox({
                    title: "Success",
                    content: "Tạo lệnh rút tiền thành công " + t.data.RepCode,
                    type: "alert"
                }) : alert(t.msg)
            },
            error: function() {
                alert("Có lỗi xảy ra. Vui lòng thử lại sau!")
            },
            complete: function() {
                $("#boxLoading").hide()
            }
        })
    })
}
function Summoney() {
    $.ajax({
        url: "/Trans/GetUserBySessionEmail",
        type: "POST",
        data: "",
        dataType: "json",
        beforeSend: function() {
            $("#boxLoading").show()
        },
        success: function(t) {
            1 == t.Success ? $("#txttaikhoan").text(t.data.StrCash) : alert("Không tìm thấy thông tin tài khoản! ")
        },
        error: function() {
            alert("Có lỗi xảy ra. Vui lòng thử lại sau!")
        },
        complete: function() {
            $("#boxLoading").hide()
        }
    })
}
function sodutaikhoan() {
    $.ajax({
        url: "/Trans/SoDuTaiKhoan",
        type: "POST",
        data: "",
        dataType: "json",
        success: function(t) {
            1 == t.Success ? ($("#spansum .lenhrut b").text(Intl.NumberFormat().format(t.data.DongBang)).end(), $("#spansum .tienconlai b").text(Intl.NumberFormat().format(t.data.KhaDung)).end(), $("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(t.data.DongBang)).end(), $("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(t.data.KhaDung)).end(), $("#ctrlPinNumbertxt").val(""), $("#ctrlPinNumbertxt_doithe").val("")) : alert(t.msg)
        },
        error: function() {
            alert("Nhà mạng bảo trì, vui lòng liên hệ với (04)62.919.259!")
        }
    })
}
function NapTienTuDong() {
    $('.boxdrpmega input[name="chargeAutoPaymentMethod"]').each(function() {
        $(this).change(function() {
            radioButtonChecked($(this)), $($("#chargeAutoPaymentMethod")).tooltip("hide").attr("data-original-title", "").removeClass("errorClass")
        })
    }), $("#ctrlnaptientudongbtn").click(function() {
        var t = $("#ctrlsoluongtcoin").val();
        $.ajax({
            url: "/Trans/TaoLenhNapTuDong",
            type: "POST",
            data: {
                bankCode: $("#buyCardPaymentMethod").attr("value"),
                amount: t
            },
            dataType: "json",
            beforeSend: function() {
                $("#boxLoading").show()
            },
            success: function(t) {
                1 == t.Success ? 1 == t.Signature ? window.location.href = t.data.UrlRedirect : ($("#tblcardinfo").hide(), $(".divresult").hide(), $("#notifyresult").addClass("alert-warning"), $("#notifyresult i").addClass("fa-times-circle"), $("#notifyresult strong").text("Lỗi giao dịch: "), $("#notifyresult span").text(t.data.Message + " " + t.data.RspCode)) : ($(".divresult").hide(), $("#notifyresult").addClass("alert-warning"), $("#notifyresult i").addClass("fa-times-circle"), $("#notifyresult strong").text("Error! "), $("#tblcardinfo").hide())
            },
            error: function() {
                alert("Có lỗi xảy ra. Vui lòng thử lại sau!")
            },
            complete: function() {
                $("#boxLoading").hide()
            }
        })
    })
}
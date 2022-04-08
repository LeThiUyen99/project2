$(document).ready(function () { new UserManager; $('input:password').val(''); $(".boxdrpmega input.txt").each(function () { $(this).addClass("blur").val($(this).attr("rel")).focus(function () { $(this).hasClass("blur") && ($(this).removeClass("blur"), $(this).val() == $(this).attr("rel") && $(this).val("")) }).focusout(function () { if ($(this).addClass("blur"), !$(this).hasClass("nochange")) { var t = $(this).val(); null != t && "" != t || $(this).val($(this).attr("rel")) } }).change(function () { if ($(this).hasClass("nochange")) return !1; var t = $(this).attr("rel"), s = $(this).val(); null == s || "" == s ? $(this).addClass("blur").val(t) : $(this).removeClass("blur") }) }), $(".boxdrpmega input.txt").focus(function () { var t = $(this).next(); t.length > 0 && t.hasClass("dropDownListArrow") && arrowClick(t) }), $(".boxdrpmega .dropDownListArrow").click(function () { arrowClick($(this)) }), $("body").click(function (t) { $(t.target).closest(".boxdrpmega").length || ($(".dropDownList").hide(), $(".boxdrpmega .dropDownList").each(function () { $(this).hide(), $(this).prev().removeClass("up").addClass("down") })) }), $(document).on("hidden.bs.modal", ".modal", function (t) { $(this).removeData("bs.modal"), "remoteModal" == t.target.id && $("#remoteModal .modal-content").html(""), $(".modal-content").html("") }), $("#signin").on("hidden.bs.modal", function () { $("#ctrlusername").val(""), $("#ctrlpass").val(""), $("#divnotify span").text(""), $("#divnotify").hide() }) });
function CurrencyFormat(r) { var t = 2, e = ".", n = ","; r = parseFloat(r); var a = 0 > r ? "-" : "", s = new String(r.toFixed(t)); e.length && "." != e && (s = s.replace(/\./, e)); var i = "", u = "", g = new String(s), h = e.length ? g.indexOf(e) : -1; for (h > -1 ? (h && (i = g.substr(0, h)), u = g.substr(h + 1)) : i = g, i && (i = String(Math.abs(i))) ; u.length < t;) u += "0"; for (temparray = new Array; i.length > 3;) temparray.unshift(i.substr(-3)), i = i.substr(0, i.length - 3); return temparray.unshift(i), i = temparray.join(n), a + i + e + u }
function MatKhauCap2() { var t = this; $("#ctrlforgotpassiibtn").on("click", function () { t.validateforgotpass() && $.ajax({ type: "POST", url: "/user/forgotpassii", data: { _emailforgot: $("#ctrlforgotemailtxt").val().trim(), matkhau: $("#ctrlpasstxt").val().trim() }, dataType: "json", beforeSend: function () { $("#boxLoading").show() }, success: function (t) { if ($("#forgotyourpassword").modal("hide"), 1 == t.Success) { $("body").removeAttr("style"), $(".overlay").removeAttr("style"), $(".fibox").removeAttr("style"), $(".overlay").hide(), $(".fibox").hide(); $("#modalinfo").modal({ backdrop: "static", keyboard: !1 }).find(".modal-header > span").text("Quên mật khẩu đăng nhập!").end().find(".modal-body p").text("Thư khởi tạo mật khẩu đã được gửi thành công. Vui lòng kiểm tra hộp thư đến và thư rác để nhận được hướng dẫn tiếp theo.").end() } else { $("body").removeAttr("style"), $(".overlay").removeAttr("style"), $(".fibox").removeAttr("style"), $(".overlay").hide(), $(".fibox").hide(); $("#modalinfo").modal({ backdrop: "static", keyboard: !1 }).find(".modal-header > span").text("Quên mật khẩu đăng nhập!").end().find(".modal-body p").text(t.message).end() } }, error: function () { alert("error") }, complete: function () { $("#boxLoading").hide() } }) }), t.validateforgotpass = function () { var t = !0, o = $("#ctrlpasstxt").val(); "" == $.trim(o) ? ($($("#ctrlpasstxt")).tooltip("hide").attr("data-original-title", "Nhập địa mật khẩu").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ctrlpasstxt").data("title", "").removeClass("errorClass").tooltip("destroy"); var a = $("#ctrlforgotemailtxt").val(); return "" == $.trim(a) ? ($($("#ctrlforgotemailtxt")).tooltip("hide").attr("data-original-title", "Nhập địa chỉ email").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ctrlforgotemailtxt").data("title", "").removeClass("errorClass").tooltip("destroy"), "" != $.trim(a) && (Common.IsValidEmail(a) ? $("#ctrlforgotemailtxt").data("title", "").removeClass("errorClass").tooltip("destroy") : ($($("#ctrlforgotemailtxt")).tooltip("hide").attr("data-original-title", "Email không hợp lệ").tooltip("fixTitle").addClass("errorClass"), t = !1)), t } }
function UserManager() { var t = this; $("#signin").keypress(function (t) { 13 === t.which && (t.preventDefault(), "" == $("#ctrlusername").val() ? $("#ctrlusername").focus() : "" == $("#ctrlpass").val() && "" != $("#ctrlusername").val() ? $("#ctrlpass").focus() : "" != $("#ctrlpass").val() && "" != $("#ctrlusername").val() && ($("#ctrlloginbtn").focus(), $("#ctrlloginbtn").trigger("click"))) }), $("#ctrlusername").keyup(function () { "" != $("#ctrlusername").val() && Common.IsValidEmail($("#ctrlusername").val()) && $($("#ctrlusername")).tooltip("hide").attr("data-original-title", "").removeClass("errorClass") }), $("#ctrlpass").keyup(function () { "" != $("#ctrlpass").val() && $($("#ctrlpass")).tooltip("hide").attr("data-original-title", "").removeClass("errorClass") }), $("#ctrlusername").focus(function () { $("#divnotify").hide() }), $("#ctrlpass").focus(function () { $("#divnotify").hide() }), $("#ctrlloginbtn").on("click", function () { t.validatelogin() && $.ajax({ type: "POST", url: "/user/login", data: { email: $("#ctrlusername").val().trim(), password: $("#ctrlpass").val() }, dataType: "json", beforeSend: function () { $("#boxLoading").show() }, success: function (t) { 1 == t.Success ? window.location = "/" : ($("#divnotify span").text("Nhập sai tên đăng nhập hoặc mật khẩu"), $("#divnotify").show()) }, error: function () { alert("error") }, complete: function () { $("#boxLoading").hide() } }) }), $("#logoutbtn").on("click", function () { $.ajax({ type: "POST", contentType: "application/json; charset=utf-8", url: "/user/logout", success: function (t) { 1 == t.Success && $(location).attr("href", "/") }, error: function () { } }) }), $("#ctrlbtnchangpasstpass").click(function () { if (t.validatechangepass()) { var a = $("#old_possword").val(), o = $("#new_password").val(); $.ajax({ url: "/user/changepassword", type: "POST", data: { _oldpassword: a, _newpassword: o }, dataType: "json", beforeSend: function () { $("#boxLoading").show() }, success: function (t) { 1 == t.Success && 1 == t.status ? alert("Mật khẩu đổi thành công") : 1 == t.Success && 2 == t.status ? ($($("#old_possword")).tooltip("hide").attr("title", "Mật khẩu hiện tại không đúng!").tooltip("fixTitle").addClass("errorClass"), $("#old_possword").focus()) : alert("Lỗi") }, error: function () { alert("Có lỗi xảy ra. Vui lòng thử lại sau!") }, complete: function () { $("#boxLoading").hide() } }) } }), $("#frmTransaction").keypress(function (a) { 13 === a.which && (a.preventDefault(), t.validateregister() && ($("#ctrregisterbtn").focus(), $("#ctrregisterbtn").trigger("click"))) }), $("#ctrregisterbtn").click(function () { if (t.validateregister()) { var a = { UserName: $("#ctrlemailtxt").val(), Password: $("#ctrlpasstxt").val(), Password2: $("#ctrlpasstxt2").val(), Name: $("#ctrlhotentxt").val(), Email: $("#ctrlemailtxt").val(), Phone: $("#ctrlphonetxt").val() }, o = JSON.stringify({ userEntity: a, _captcha: $("#ValidateCode").val() }); $.ajax({ url: "/user/register", type: "POST", data: o, contentType: "application/json", datatype: "html", beforeSend: function () { $("#boxLoading").show() }, success: function (t) { 1 == t.Success ? window.location = "/User/ComfirmRegister" : (alert(t.Message), $("#ValidateCode").focus()) }, error: function () { alert("Có lỗi xảy ra. Vui lòng thử lại sau!") }, complete: function () { $("#boxLoading").hide() } }) } }), $("#ctrcomfirmregisterbtn").click(function () { if ("" != $("#txtComfirmCode").val()) { var t = JSON.stringify({ code: $("#txtComfirmCode").val() }); $.ajax({ url: "/user/comfirmRegister", type: "POST", data: t, contentType: "application/json", datatype: "html", beforeSend: function () { $("#boxLoading").show() }, success: function (t) { 1 == t.Success ? window.location = "/" : (alert(t.Message), $("#txtComfirmCode").focus()) }, error: function () { alert("Có lỗi xảy ra. Vui lòng thử lại sau!") }, complete: function () { $("#boxLoading").hide() } }) } }), $("#ctrcomfirmcodebtn").click(function () { if ("" != $("#txtComfirmCode").val()) { var t = JSON.stringify({ code: $("#txtComfirmCode").val() }); $.ajax({ url: "/user/comfirm", type: "POST", data: t, contentType: "application/json", datatype: "html", beforeSend: function () { $("#boxLoading").show() }, success: function (t) { 1 == t.Success ? window.location = "/" : (alert(t.Message), $("#txtComfirmCode").focus()) }, error: function () { alert("Có lỗi xảy ra. Vui lòng thử lại sau!") }, complete: function () { $("#boxLoading").hide() } }) } }), $("#ctrlforgotpassbtn").on("click", function () { t.validateforgotpass() && $.ajax({ type: "POST", url: "/user/forgotpass", data: { _emailforgot: $("#ctrlforgotemailtxt").val().trim() }, dataType: "json", beforeSend: function () { $("#boxLoading").show() }, success: function (t) { if ($("#forgotyourpassword").modal("hide"), 1 == t.Success) { $("body").removeAttr("style"), $(".overlay").removeAttr("style"), $(".fibox").removeAttr("style"), $(".overlay").hide(), $(".fibox").hide(); $("#modalinfo").modal({ backdrop: "static", keyboard: !1 }).find(".modal-header > span").text("Quên mật khẩu đăng nhập!").end().find(".modal-body p").text("Thư khởi tạo mật khẩu đã được gửi thành công. Vui lòng kiểm tra hộp thư đến và thư rác để nhận được hướng dẫn tiếp theo.").end() } else { $("body").removeAttr("style"), $(".overlay").removeAttr("style"), $(".fibox").removeAttr("style"), $(".overlay").hide(), $(".fibox").hide(); $("#modalinfo").modal({ backdrop: "static", keyboard: !1 }).find(".modal-header > span").text("Quên mật khẩu đăng nhập!").end().find(".modal-body p").text(t.message).end() } }, error: function () { alert("error") }, complete: function () { $("#boxLoading").hide() } }) }), t.validatelogin = function () { var t = !0, a = $("#ctrlusername").val(); "" == $.trim(a) ? ($($("#ctrlusername")).tooltip("hide").attr("data-original-title", "Nhập địa chỉ email").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ctrlusername").data("title", "").removeClass("errorClass").tooltip("destroy"), "" != $.trim(a) && (Common.IsValidEmail(a) ? $("#ctrlusername").data("title", "").removeClass("errorClass").tooltip("destroy") : ($($("#ctrlusername")).tooltip("hide").attr("data-original-title", "Email không hợp lệ").tooltip("fixTitle").addClass("errorClass"), t = !1)); var o = $("#ctrlpass").val(); return "" == $.trim(o) ? ($($("#ctrlpass")).tooltip("hide").attr("title", "Hãy nhập mật khẩu truy cập").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ctrlpass").data("title", "").removeClass("errorClass").tooltip("destroy"), t }, t.validatechangepass = function () { var t = !0, a = $("#old_possword").val(), o = $("#new_password").val(), e = $("#repeat_new_password").val(); return 1 == checkPassword(a, $("#old_possword")) && (t = !1), 1 == checkPassword(o, $("#new_password")) && (t = !1), 1 == checkPassword(e, $("#repeat_new_password")) && (t = !1), 0 == checkPassword(o, $("#new_password")) && 0 == checkPassword(e, $("#repeat_new_password")) && o != e && ($($("#repeat_new_password")).tooltip("hide").attr("title", "Nhập lại mật khẩu không phù hợp").tooltip("fixTitle").addClass("errorClass"), t = !1), t }, t.validateregister = function () { var t = !0, a = $("#ctrlhotentxt").val(), o = $("#ctrlphonetxt").val(), e = $("#ctrlemailtxt").val(), r = $("#ctrlpasstxt").val(), l = $("#ctrlrepasstxt").val(), s = $("#ctrlpasstxt2").val(), i = $("#ctrlpasstxt2confirm").val(), n = $("#ValidateCode").val(); return "" == $.trim(a) ? ($($("#ctrlhotentxt")).tooltip("hide").attr("data-original-title", "Nhập họ tên").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ctrlhotentxt").data("title", "").removeClass("errorClass").tooltip("destroy"), "" == $.trim(o) ? ($($("#ctrlphonetxt")).tooltip("hide").attr("data-original-title", "Nhập số điện thoại").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ctrlphonetxt").data("title", "").removeClass("errorClass").tooltip("destroy"), "" == $.trim(e) ? ($($("#ctrlemailtxt")).tooltip("hide").attr("data-original-title", "Nhập địa chỉ email").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ctrlemailtxt").data("title", "").removeClass("errorClass").tooltip("destroy"), "" != $.trim(e) && (Common.IsValidEmail(e) ? $("#ctrlemailtxt").data("title", "").removeClass("errorClass").tooltip("destroy") : ($($("#ctrlemailtxt")).tooltip("hide").attr("data-original-title", "Email không hợp lệ").tooltip("fixTitle").addClass("errorClass"), t = !1)), 1 == checkPassword(r, $("#ctrlpasstxt")) && (t = !1), 1 == checkPassword(l, $("#ctrlrepasstxt")) && (t = !1), 1 == checkPassword(s, $("#ctrlrepasstxt2")) && (t = !1), 1 == checkPassword(i, $("#ctrlpasstxt2confirm")) && (t = !1), 0 == checkPassword(r, $("#ctrlrepasstxt")) && r != l && ($($("#ctrlpasstxt")).tooltip("hide").attr("title", "Nhập lại mật khẩu không phù hợp").tooltip("fixTitle").addClass("errorClass"), t = !1), 0 == checkPassword(s, $("#ctrlpasstxt2confirm")) && s != i && ($($("#ctrlpasstxt")).tooltip("hide").attr("title", "Nhập lại mật khẩu không phù hợp").tooltip("fixTitle").addClass("errorClass"), t = !1), "" == $.trim(n) ? ($($("#ValidateCode")).tooltip("hide").attr("data-original-title", "Nhập mã kiểm tra").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ValidateCode").data("title", "").removeClass("errorClass").tooltip("destroy"), t }, t.validateforgotpass = function () { var t = !0, a = $("#ctrlforgotemailtxt").val(); return "" == $.trim(a) ? ($($("#ctrlforgotemailtxt")).tooltip("hide").attr("data-original-title", "Nhập địa chỉ email").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ctrlforgotemailtxt").data("title", "").removeClass("errorClass").tooltip("destroy"), "" != $.trim(a) && (Common.IsValidEmail(a) ? $("#ctrlforgotemailtxt").data("title", "").removeClass("errorClass").tooltip("destroy") : ($($("#ctrlforgotemailtxt")).tooltip("hide").attr("data-original-title", "Email không hợp lệ").tooltip("fixTitle").addClass("errorClass"), t = !1)), t } }
function ChangePassII() { var s = this; s.validatechangepassii = function () { var s = !0, i = $("#old_posswordi").val(), o = $("#old_posswordii").val(), t = $("#new_passwordii").val(), a = $("#repeat_new_passwordii").val(); return "" == i && ($($("#old_posswordi")).tooltip("hide").attr("title", "Nhập mật khẩu đăng nhập").tooltip("fixTitle").addClass("errorClass"), s = !1), "" == o && ($($("#old_posswordii")).tooltip("hide").attr("title", "Nhập mật khẩu cấp 2 cũ").tooltip("fixTitle").addClass("errorClass"), s = !1), 1 == checkPassword(i, $("#old_posswordi")) && (s = !1), 1 == checkPassword(t, $("#new_passwordii")) && (s = !1), 1 == checkPassword(a, $("#repeat_new_passwordii")) && (s = !1), 0 == checkPassword(t, $("#new_passwordii")) && 0 == checkPassword(a, $("#repeat_new_passwordii")) && t != a && ($($("#repeat_new_passwordii")).tooltip("hide").attr("title", "Nhập lại mật khẩu không phù hợp").tooltip("fixTitle").addClass("errorClass"), s = !1), s }, $("#ctrlbtnchangpasstpassii").click(function () { if (s.validatechangepassii()) { var i = $("#old_posswordi").val(), o = $("#old_posswordii").val(), t = $("#new_passwordii").val(); $.ajax({ url: "/user/changepasswordii", type: "POST", data: { _oldpassword: i, _oldpasswordii: o, _newpassword: t }, dataType: "json", beforeSend: function () { $("#boxLoading").show() }, success: function (s) { 1 == s.Success && 1 == parseInt(s.status) ? alert("Mật khẩu đổi thành công") : 0 == s.Success && 2 == parseInt(s.status) ? ($($("#old_posswordi")).tooltip("hide").attr("title", "Mật khẩu hiện tại không đúng!").tooltip("fixTitle").addClass("errorClass"), $("#old_posswordi").focus()) : 0 == s.Success && 3 == parseInt(s.status) ? ($($("#old_posswordii")).tooltip("hide").attr("title", "Mật khẩu cấp 2 hiện tại không đúng!").tooltip("fixTitle").addClass("errorClass"), $("#old_posswordii").focus()) : alert("Lỗi") }, error: function () { alert("Có lỗi xảy ra. Vui lòng thử lại sau!") }, complete: function () { $("#boxLoading").hide() } }) } }) }
function MobileNapTheViettel() {
    var self = this;
    self.init_naptheviettelmb = function () {
        $.ajax({
            url: "/user/CheckIfSessionValid",
            type: "POST",
            success: function (result) {
                if (result.Success == true) {
                    $('#mbctrlmatheviettel').attr('readonly', false);
                    $('#mbctrlserialviettel').attr('readonly', false);
                    $('#mbnotifylogin1').hide();
                } else {
                    $('#mbctrlmatheviettel').attr('readonly', true);
                    $('#mbctrlserialviettel').attr('readonly', true);
                    $('#mbnotifylogin1').show();
                }
            }
        });
        //event textbox nhap tai khoan game
        $('#mbctrlmatheviettel').keyup(function () {
            if ($('#mbctrlmatheviettel').val() != '') {
                $($('#mbctrlmatheviettel')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        //event textbox email in nap thien game
        $('#mbctrlserialviettel').keyup(function () {
            if ($('#mbctrlserialviettel').val() != '') {
                $($('#mbctrlserialviettel')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });
        //self.NapGameloadAllCardType($('#ViettelCardTypeSelect').val());
        var strHTML = "<td>";
        strHTML += '<p><input id="mbViettelCardTypeSelect_VTT" name="mbViettelCardTypeSelect" rel="mbViettelCardType" value="1" txt="Viettel 15%" gate="" type="radio" class="left">&nbsp;<label class="left mL5" for="ViettelCardTypeSelect_VTT">Viettel 15%</label><span class="separator"></span></p>';
        strHTML += "</td>";
        $("#trnapviettel_type").html();//strHTML       

        self.mobiviettelloadAllCardType(1);

    }

    $('#mbctrlnapviettelbtn').on("click", function () {
        if (self.validatenaptheviettelmb()) {
            var cardamount = $('#mbViettelAmount').val();
            var amountmb = 10000;
            if ($.trim(cardamount) == '') {
                amountmb = 10000;
            } else {
                amountmb = $('#mbViettelAmount').val();
            }
            $.ajax({
                url: "/CardCharge/CardCharge_gachtheVT",
                type: 'POST',
                data: { providerId: $('#mbViettelCardType').attr('value'), Mathe: $('#mbctrlmatheviettel').val(), Serial: $('#mbctrlserialviettel').val(), amount: amountmb },
                dataType: 'json',
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (obj) {
                    $('#mbnapthevtshowresultmodal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    //$('.divresult').hide();
                    //$('#tblcardinfo').hide();
                    if (obj.Success == true) {
                        if (obj.data.status == 1) {
                            $("#notifyresult").addClass('alert-success');
                            $('#notifyresult i').addClass('fa-check');
                            $('#notifyresult strong').text('Giao dịch chờ xử lý: ');
                            $('#notifyresult span').text(obj.data.message);
                            //if ((obj.data.status == -10) && (obj.data.status == 4)) {
                            //    $('#notifyresult span').text('Thẻ không chính xác' + ' - lỗi: ' + obj.data.status);
                            //} else if (obj.data.status == 50) {
                            //    $('#notifyresult span').text('Thẻ không tồn tại hoặc đã được sử dụng' + ' - lỗi: ' + obj.data.status);
                            //} else if ((obj.data.status == 11) && (obj.data.status == -11)) {
                            //    $('#notifyresult span').text('Nhà mạng bảo trì, vui lòng thực hiện sau' + ' - lỗi: ' + obj.data.status);
                            //} else if (obj.data.status == 59) {
                            //    $('#notifyresult span').text('Thẻ không được kích hoạt' + ' - lỗi: ' + obj.data.status);
                            //} else {
                            //    $('#notifyresult span').text('Có lỗi xảy ra trong quá trình nạp thẻ.' + ' - lỗi: ' + obj.data.status);
                            //}
                        } else {
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Lỗi giao dịch! ');
                            $('#notifyresult span').text(obj.data.message + '- Lỗi: ' + obj.data.status);

                            // $('#tblcardinfo').show(); 
                            //sodutaikhoan();
                            //location.reload(true); cap nhat lại tiền cho khách
                            //$("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                            //$("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                            //$("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                            //$("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                        }
                    } else {
                        //$('.divresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Có lỗi xảy ra! ');
                        $('#notifyresult span').text("");

                    }
                },
                error: function (obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                },
                complete: function () {
                    $("#boxLoading").hide();
                }
            });
        }
    });
    //function load card type follow provider
    self.mobiviettelloadAllCardType = function (PrividerId) {
        $.ajax({
            url: "/user/NapGameListCardTypeByProviderId",
            type: 'get',
            data: { PrividerId: PrividerId },
            dataType: 'json',

            success: function (obj) {
                if (obj.Success == true) {
                    var strHTML = "<table style='width: 100%;' rel=" + PrividerId + "><tbody><tr><td>";
                    for (var i = 0; i < obj.data.length; i++) {
                        strHTML += "<input class='left' name='mbViettelAmountSelect' id='mbViettelAmountSelect_" + obj.data[i].Id + "' rel='mbViettelAmount' value='" + obj.data[i].Amount + "' txt=" + obj.data[i].CardName + " type='radio'>";
                        strHTML += "<label class='left' for='mbViettelAmountSelect_" + obj.data[i].Id + "'>" + obj.data[i].CardName + "</label>";
                        strHTML += "<div style='clear:both;'></div><span class='separator'></span>";
                    }
                    strHTML += "</td></tr></tbody></table>";
                    $("#mbtable_ViettelAmount").html(strHTML);

                    //Select item                   
                    $('.boxdrpmega input[name="mbViettelAmountSelect"]').each(function () {
                        $(this).change(function () {
                            radioButtonChecked($(this));
                            $('#mbViettelAmount').removeClass('errorClass');
                            $($('#mbViettelAmount')).tooltip('hide').attr('data-original-title', '')

                        });
                    });
                }
            },
            error: function (obj) {
                alert('lỗi khi load mệnh giá thẻ!');
            },
            complete: function () {
                //$("#boxLoading").hide();
            }
        });
    }

    self.validatenaptheviettelmb = function () {
        var flag = true;

        var taikhoangame = $('#mbctrlmatheviettel').val();
        if ($.trim(taikhoangame) == '') {
            $($('#mbctrlmatheviettel')).tooltip('hide').attr('title', 'Nhập mã thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#mbctrlmatheviettel').data("title", "").removeClass("errorClass").tooltip("destroy");
        }


        var email = $('#mbctrlserialviettel').val();
        if ($.trim(email) == '') {
            $($('#mbctrlserialviettel')).tooltip('hide').attr('data-original-title', 'Nhập serial').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#mbctrlserialviettel').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }
}
//Mua mã thẻ
function BuyCard() {
    var self = this;
    self.provider = 0;
    //event keypress in confirm preview buycard login
    $('#ctrlemailtxt_log').keyup(function () {
        if ($('#ctrlemailtxt_log').val() != '' && Common.IsValidEmail($('#ctrlemailtxt_log').val())) {
            $($('#ctrlemailtxt_log')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });
    $('#ctrlpasstxt_log').keyup(function () {
        if ($('#ctrlpasstxt_log').val() != '') {
            $($('#ctrlpasstxt_log')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });

    //event textbox email in buycard
    $('#ctrlemailaddress').keyup(function () {
        if ($('#ctrlemailaddress').val() != '' && Common.IsValidEmail($('#ctrlemailaddress').val())) {
            $($('#ctrlemailaddress')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });


    //event chọn phương thức thanh toán
    $('.boxdrpmega input[name="buyCardPaymentMethod"]').each(function () {
        $(this).change(function () {
            radioButtonChecked($(this));
            $($('#buyCardPaymentMethod')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        });
    });
    $("#ctrlsoluongthe").keyup(function (e) {

        this.value = this.value.replace(/[^\-0-9]/g, '');

    });
    //event click mua the
    $('#ctrlmuathebtn_desktop').on("click", function () {
        if (self.validatebuycard()) {

            $("#lblsoluongthe").text($('#ctrlsoluongthe').val());
            $("#lblemail").text($('#ctrlemailaddress').val());

            var telco = parseInt($('#ProviderId').val());
            var _pro_text = $("#ProviderId option:selected").text();
            $("#lblprovider").text($("#ProviderId option:selected").text());
            $("#lblcardtype").text($('#CardAmount').val());
            var sumAmount = parseInt($("#CardAmount").val()) * parseInt($("#ctrlsoluongthe").val());
            var sumPrice = sumAmount;
            switch (telco) {
                case 1:
                    sumPrice = sumAmount * 0.969; // Chiết khấu Viettel
                    break;
                case 2:
                case 3:
                    sumPrice = sumAmount * 0.959; // Chiết khấu Mobile, Vina
                    break;
                case 5:
                    sumPrice = sumAmount * 0.9635; // Chiết khấu GATE
                    break;
                case 7:
                    sumPrice = sumAmount * 0.96; // Chiết khấu VNM
                    break;
            }

            $("#lblsotien").text(CurrencyFormat(sumPrice) + " đ");
            if ($('#buyCardPaymentMethod').attr('value') == 'Paycard') {
            $.ajax({
                url: "/user/CheckIfSessionValid",
                type: "POST",
                success: function (result) {
                    if (result.Success == false) {
                        $("#Confirm_OrderDetail").show();
                    }
                    else
                        $("#Confirm_OrderDetail").hide();
                }
            });
            } else {
                $("#Confirm_OrderDetail").hide();
                $('#lblpttt').text('Ngân hàng thanh toán: ')
            }
            $('#buycardpreviewmodal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#divnotifybc span').text('');
            $('#divnotifybc').hide();
            $('#ctrlemailtxt_log').val('');
            $('#ctrlpasstxt_log').val('');
        }
    });


    //event click mua the
    $('#ctrlmuathebtn').on("click", function () {
        if (self.validatebuycard()) {
            //pass prameter and show modal confirm
            $("#lblprovider").text($('#buyCardProvider').val());
            $("#lblcardtype").text($('#buyCardAmount').val());
            $("#lblsoluongthe").text($('#ctrlsoluongthe').val());
            $("#lblemail").text($('#ctrlemailaddress').val());
            var sumAmount = parseInt($("#buyCardAmount").attr('value')) * parseInt($("#ctrlsoluongthe").val());
            var telco = parseInt($('#buyCardProvider').attr('value'));
            var sumPrice = sumAmount;
            switch (telco) {
                case 1:
                    sumPrice = sumAmount * 0.969; // Chiết khấu Viettel
                    break;
                case 2:
                case 3:
                    sumPrice = sumAmount * 0.959; // Chiết khấu Mobile, Vina
                    break;
                case 5:
                    sumPrice = sumAmount * 0.982; // Chiết khấu GATE
                    break;
                case 7:
                    sumPrice = sumAmount * 0.982; // Chiết khấu VNM
                    break;
            }

            $("#lblsotien").text(CurrencyFormat(sumPrice) + " đ");

            $.ajax({
                url: "/user/CheckIfSessionValid",
                type: "POST",
                success: function (result) {
                    if (result.Success == false) {
                        $("#Confirm_OrderDetail").show();
                    }
                    else
                        $("#Confirm_OrderDetail").hide();
                }
            });

            $('#buycardpreviewmodal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#divnotifybc span').text('');
            $('#divnotifybc').hide();
            $('#ctrlemailtxt_log').val('');
            $('#ctrlpasstxt_log').val('');
        }
    });



    //event btn thanhtoan in modal preview click
    $('#ctrthanhtoanbtn').on("click", function () {
        var isVisible = $('#Confirm_OrderDetail').is(':visible');

        if (isVisible) { //Case not login
            if (self.validateloginbuycard()) {//check valid login
                self.Loginbuycard($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), function () {//login calback
                    self.buycardnotsigin($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), $('#buyCardProvider').attr('value'), $('#buyCardAmount').attr('value'), $('#ctrlemailaddress').val())
                });
            }
        } else {//case has login                
            $('#buycardpreviewmodal').modal('hide');
            $.ajax({
                url: "/user/PaymentBuyCardHasLogin",
                type: 'POST',
                data: { providerId: $('#buyCardProvider').attr('value'), amount: $('#buyCardAmount').attr('value'), quantity: $("#ctrlsoluongthe").val(), emailnhan: $('#ctrlemailaddress').val() },
                dataType: 'json',
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (obj) {
                    $('#buycardshowresultmodal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    if (obj.Success == true) {
                        if (obj.data.errorCode != 00) {
                            $('#tblcardinfo').hide();
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Lỗi giao dịch: ');
                            $('#notifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                        } else {
                            $("#notifyresult").addClass('alert-success');
                            $('#notifyresult i').addClass('fa-check');
                            $('#notifyresult strong').text('Thành công ');
                            $('#notifyresult span').text("Quý khách vui lòng kiểm tra email để lấy thông tin thẻ cào");
                            $('#tblcardinfo').show();
                            //var rsp = obj.data.listCards.split('|');
                            var rspListCard = jQuery.parseJSON(obj.data.listCards);


                            //sodutaikhoan();

                            var currentdate = new Date();
                            var hours = new Date().getHours();
                            var hours = (hours + 24 - 2) % 24;
                            var mid = 'am';
                            if (hours == 0) {
                                hours = 12;
                            }
                            else if (hours > 12) {
                                hours = hours % 12;
                                mid = 'pm';
                            }
                            var datetime = "Now: " + currentdate.getDate() + "/"
                                        + (currentdate.getMonth() + 1) + "/"
                                        + currentdate.getFullYear() + " "
                                        + hours + ":"
                                        + currentdate.getMinutes() + ":"
                                        + currentdate.getSeconds() + " " + mid;

                            $(".datetransaction").text(datetime);
                        }
                    } else {
                        $('.divresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Có lỗi xảy ra! ');
                        $('#tblcardinfo').hide();
                    }
                },
                error: function (obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                },
                complete: function () {
                    $("#boxLoading").hide();
                }
            });
        }
    });



    //event btn thanhtoan in modal preview click
    $('#ctrthanhtoanbtn_desktop').on("click", function () {
        var isVisible = $('#Confirm_OrderDetail').is(':visible');
        // Nếu thanh toán bằng tài khoản paycard
        if ($('#buyCardPaymentMethod').attr('value') == 'Paycard') {
        if (isVisible) { //Case not login
            if (self.validateloginbuycard()) {//check valid login
                self.Loginbuycard($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), function () {//login calback
                    self.buycardnotsigin($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), $('#ProviderId').val(), $('#CardAmount').val(), $('#ctrlghichumuathe').val())
                });
            }
        } else {//case has login                
            $('#buycardpreviewmodal').modal('hide');

            var _amount = $('#CardAmount').val()
            var _arr = _amount.split("-");
            //_amount = _arr[1];

            $.ajax({
                url: "/user/PaymentBuyCardHasLogin",
                type: 'POST',
                data: { providerId: $('#ProviderId').val(), amount: _amount, quantity: $("#ctrlsoluongthe").val(), password2: $('#ctrlghichumuathe').val() },
                dataType: 'json',
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (obj) {
                    $('#buycardshowresultmodal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    if (obj.Success == true) {
                        if (obj.data.errorCode != 00) {
                            $('#buycardtblcardinfo').hide();
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Lỗi giao dịch: ');
                            $('#notifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                        } else {
                            $("#notifyresult").addClass('alert-success');
                            $('#notifyresult i').addClass('fa-check');
                            $('#notifyresult strong').text('Thành công ');
                            $('#notifyresult span').text("Quý khách vui lòng kiểm tra email để lấy thông tin thẻ cào");
                            var rspListCard = jQuery.parseJSON(obj.data.listCards);
                            for (var i = 0; i < rspListCard.length; i++) {
                                $('#buycardtblcardinfo tbody').append('<tr><td class="text-center">' + rspListCard[i].ProviderCode + '</td><td class="text-center">' + rspListCard[i].Amount + '</td><td class="text-center">' + "'" + rspListCard[i].PinCode + '</td><td class="text-center">' + "'" + rspListCard[i].Serial + '</td></tr>');
                            }
                            $('#buycardtblcardinfo').hide();



                            var currentdate = new Date();
                            var hours = new Date().getHours();
                            var hours = (hours + 24 - 2) % 24;
                            var mid = 'am';
                            if (hours == 0) {
                                hours = 12;
                            }
                            else if (hours > 12) {
                                hours = hours % 12;
                                mid = 'pm';
                            }
                            var datetime = "Now: " + currentdate.getDate() + "/"
                                        + (currentdate.getMonth() + 1) + "/"
                                        + currentdate.getFullYear() + " "
                                        + hours + ":"
                                        + currentdate.getMinutes() + ":"
                                        + currentdate.getSeconds() + " " + mid;

                            $(".datetransaction").text(datetime);
                            $('.divresult').show();
                        }
                    } else {
                        $('.divresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Có lỗi xảy ra! ');
                        $('#buycardtblcardinfo').hide();
                    }
                },
                error: function (obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                },
                complete: function () {
                    $("#boxLoading").hide();
                }
            });
        }
        } else { //case select bank   

            self.paymentbuycardusesbank($('#buyCardPaymentMethod').attr('value'), $('#ProviderId').val(), $('#ctrlemailaddress').val(), $('#CardAmount').val(), $('#ctrlsoluongthe').val())
        }
    });
    $('#xuatexel').on("click", function () {
        var str = document.getElementById('buycardtblcardinfo').outerHTML;//$('.buycarddivresult').html();//tableExport({ type: 'excel', escape: 'false' });
        var excelFile = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:" + "excel" + "' xmlns='http://www.w3.org/TR/REC-html40'>";
        excelFile += "<meta http-equiv='content-type' content='application/vnd.ms-excel; charset=UTF-8'>";
        excelFile += "<head>";
        excelFile += "<!--[if gte mso 9]>";
        excelFile += "<xml>";
        excelFile += "<x:ExcelWorkbook>";
        excelFile += "<x:ExcelWorksheets>";
        excelFile += "<x:ExcelWorksheet>";
        excelFile += "<x:Name>";
        excelFile += "{worksheet}";
        excelFile += "</x:Name>";
        excelFile += "<x:WorksheetOptions>";
        excelFile += "<x:DisplayGridlines/>";
        excelFile += "</x:WorksheetOptions>";
        excelFile += "</x:ExcelWorksheet>";
        excelFile += "</x:ExcelWorksheets>";
        excelFile += "</x:ExcelWorkbook>";
        excelFile += "</xml>";
        excelFile += "<![endif]-->";
        excelFile += "</head>";
        excelFile += "<body>";
        excelFile += str;
        excelFile += "</body>";
        excelFile += "</html>";
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(excelFile));
    });



    //Function login buy card
    self.Loginbuycard = function (email, password, callback) {
        $.ajax({
            type: "POST",
            url: "/user/login",
            data: { email: email, password: password },
            dataType: 'json',
            success: function (msg) {
                if (msg.Success == true) {
                    $('#buycardpreviewmodal').modal('hide');
                    if (callback) callback();
                }
                else {
                    $('#divnotifybc span').text('Nhập sai tên đăng nhập hoặc mật khẩu');
                    $('#divnotifybc').show();
                }
            },
            error: function (msg) {
            }
        });
    }

    //function buy card not login
    self.buycardnotsigin = function (email, password, providerid, amount, mailadd) {
        $.ajax({
            url: "/user/PaymentBuyCardNotLogin",
            type: 'POST',
            data: { UserName: email, password: password, providerId: providerid, amount: amount, quantity: $("#ctrlsoluongthe").val(), password2: mailadd },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                if (obj.Success == true) {
                    if (obj.data.errorCode != 00) {
                        $('#tblcardinfo').hide();
                        $('.divresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Lỗi giao dịch: ');
                        $('#notifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                    } else {

                        $("#notifyresult").addClass('alert-success');
                        $('#notifyresult i').addClass('fa-check');
                        $('#notifyresult strong').text('Thành công:  ');
                        $('#notifyresult span').text("Quý khách vui lòng kiểm tra email để lấy thông tin thẻ cào");
                        $('#tblcardinfo').hide();
                        //var rsp = obj.data.listCards.split('|');

                        var rspListCard = jQuery.parseJSON(obj.data.listCards);

                        $("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                        $("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                        $("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                        $("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                        var currentdate = new Date();
                        var hours = new Date().getHours();
                        var hours = (hours + 24 - 2) % 24;
                        var mid = 'am';
                        if (hours == 0) {
                            hours = 12;
                        }
                        else if (hours > 12) {
                            hours = hours % 12;
                            mid = 'pm';
                        }
                        var datetime = "Now: " + currentdate.getDate() + "/"
                                    + (currentdate.getMonth() + 1) + "/"
                                    + currentdate.getFullYear() + " "
                                    + hours + ":"
                                    + currentdate.getMinutes() + ":"
                                    + currentdate.getSeconds() + " " + mid;

                        $(".datetransaction").text(datetime);
                    }
                    //$(location).attr('href', '/');
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Có lỗi xảy ra! ');
                    $('#tblcardinfo').hide();
                    $(location).attr('href', '/');
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }

    //function buy card select bank method
    self.paymentbuycardusesbank = function (bankCode, providerId, email, amount, quantity) {
        $.ajax({
            url: "/user/PaymentBuyCardUsesBankEPay",
            type: 'POST',
            data: { bankCode: bankCode, providerId: providerId, email: email, amount: amount, quantity: quantity },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                $('#buycardshowresultmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                if (obj.Success == true) {
                    if (obj.Signature == true) {
                        window.location.href = obj.data.url;
                    } else {
                        $('#tblcardinfo').hide();
                        $('.divresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Lỗi giao dịch: ');
                        $('#notifyresult span').text(obj.data.Message + ' ' + obj.data.RspCode);
                    }
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Nhà mạng đang bảo trì! ');
                    $('#tblcardinfo').hide();
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }

    //function load all provier<option value="5">FPT Gate(2.1%)</option><option value="12">ZING(1.8%)</option><option value="13">VTC(1.8%)</option><option value="14">Garenal(1.8%)</option>
    self.loadAllProvider_Desktop = function () {
        var strHTML = "<td>";


        strHTML = '<select id="ProviderId"><option>Chọn nhà cung cấp</option><option value="1">Viettel(4.1%)</option><option value="2">Mobifone(4.5%)</option><option value="3">Vinaphone(4.1%)</option><option value="7">Vietnammobile(3.5%)</option></select>';
        strHTML += "</td>";
        $("#trprovider").html(strHTML);


        $("#ProviderId").change(function () {
            var _provider = $("#ProviderId").val();


            self.loadAllCardType_Desktop($(this).val());
            self.provider = $(this).val();
        });

    }

    //function load card type follow provider
    self.loadAllCardType_Desktop = function (PrividerId) {
        $.ajax({
            url: "/user/GetListCardTypeByProviderId",
            type: 'get',
            data: { PrividerId: PrividerId },
            dataType: 'json',
            //beforeSend: function () {
            //    $("#boxLoading").show();
            //},
            success: function (obj) {
                if (obj.Success == true) {

                    var strHTML = "";

                    strHTML = strHTML + "<select id='CardAmount'>";
                    strHTML = strHTML + "<option value='0'>Mệnh giá thẻ nạp</option>";
                    for (var i = 0; i < obj.data.length; i++) {
                        //strHTML = strHTML + "<input class='left' name='buyCardAmountSelect' id='buyCardAmountSelect_" + obj.data[i].Id + "' rel='buyCardAmount' value='" + obj.data[i].Amount + "' txt=" + obj.data[i].CardName + " type='hidden'>";
                        strHTML = strHTML + "<option value='" + obj.data[i].Amount + "'>" + obj.data[i].CardName + "</option>";
                    }
                    strHTML = strHTML + "</select>";
                    //strHTML += "</td></tr></tbody></table>";
                    $("#CardAmount").remove();
                    $("#table_CardAmount").html(strHTML);


                    //Select item                   
                    //$('.boxdrpmega input[name="buyCardAmountSelect"]').each(function () {
                    $("#CardAmount").change(function () {
                        radioButtonChecked($(this));
                        $('#buyCardAmount').removeClass('errorClass');
                        $($('#buyCardAmount')).tooltip('hide').attr('data-original-title', '')
                        self.loadPercent(self.provider, $(this).val());
                    });
                    //});
                }
            },
            error: function (obj) {
                alert('lỗi khi load mệnh giá thẻ!');
            },
            complete: function () {
                //$("#boxLoading").hide();
            }
        });
    }


    self.loadAllProvider = function () {
        var strHTML = "<td>";
        strHTML += '<p><input id="buyCardProviderSelect_Viettel" name="buyCardProviderSelect" rel="buyCardProvider" value="1" txt="Viettel (2%)" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardProviderSelect_Viettel">Viettel (2%)</label><span class="separator"></span></p><p><input id="buyCardProviderSelect_Mobifone" name="buyCardProviderSelect" rel="buyCardProvider" value="2" txt="Mobifone (2.5%)" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardProviderSelect_Mobifone">Mobifone (2.5%)</label><span class="separator"></span></p><p><input id="buyCardProviderSelect_Vinaphone" name="buyCardProviderSelect" rel="buyCardProvider" value="3" txt="Vinaphone (2.8%)" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardProviderSelect_Vinaphone">Vinaphone (2.8%)</label><span class="separator"></span></p><p><input id="buyCardProviderSelect_FPT Gate" name="buyCardProviderSelect" rel="buyCardProvider" value="5" txt="FPT (2.1%)" gate="" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardProviderSelect_FPT Gate">FPT Gate (2.1%)</label><span class="separator"></span></p><p><input id="buyCardProviderSelect_Vietnamobile" name="buyCardProviderSelect" rel="buyCardProvider" value="7" txt="Vietnamobile (4%)" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardProviderSelect_Vietnamobile">Vietnamobile (4%)</label><span class="separator"></span></p><p><input id="buyCardProviderSelect_ZING" name="buyCardProviderSelect" rel="buyCardProvider" value="12" txt="ZING (3.65%)" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardProviderSelect_ZING">ZING (3.65%)</label><span class="separator"></span></p><p><input id="buyCardProviderSelect_VTC" name="buyCardProviderSelect" rel="buyCardProvider" value="13" txt="Vcoin (3.5%)" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardProviderSelect_VTC">Vcoin (3.5%)</label><span class="separator"></span></p><p><input id="buyCardProviderSelect_GAR" name="buyCardProviderSelect" rel="buyCardProvider" value="14" txt="GAR (3%)" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardProviderSelect_GAR">Garena (3.5%)</label><span class="separator"></span></p>';
        strHTML += "</td>";
        $("#trprovider").html(strHTML);

        //Select provider
        $('.boxdrpmega input[name="buyCardProviderSelect"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $('#buyCardProvider').removeClass('errorClass');
                $($('#buyCardProvider')).tooltip('hide').attr('data-original-title', '')
                self.loadAllCardType($(this).val());
                self.provider = $(this).val();
            });
        });

        //$.ajax({
        //    url: "/user/GetListProvider",
        //    type: 'get',
        //    data: {},
        //    dataType: 'json',
        //    //beforeSend: function () {
        //    //    $("#boxLoading").show();
        //    //},
        //    success: function (obj) {
        //        if (obj.Success == true) {
        //            var strHTML = "<td>";
        //            for (var i = 0; i < obj.data.length; i++) {
        //                strHTML += "<p><input id='buyCardProviderSelect_" + obj.data[i].Name + "' name='buyCardProviderSelect' rel='buyCardProvider' value=" + obj.data[i].Id + " txt=" + obj.data[i].Name + " type='radio' class='left'>";
        //                strHTML += "&nbsp;<label class='left mL5' for='buyCardProviderSelect_" + obj.data[i].Name + "'>" + obj.data[i].Name + "</label>";
        //                strHTML += "<span class='separator'></span></p>"
        //            }
        //            strHTML += "</td>";
        //            $("#trprovider").html(strHTML);

        //            //Select provider
        //            $('.boxdrpmega input[name="buyCardProviderSelect"]').each(function () {
        //                $(this).change(function () {
        //                    radioButtonChecked($(this));
        //                    $('#buyCardProvider').removeClass('errorClass');
        //                    $($('#buyCardProvider')).tooltip('hide').attr('data-original-title', '')
        //                    self.loadAllCardType($(this).val());
        //                });
        //            });
        //        }
        //    },
        //    error: function (obj) {
        //        //alert('lỗi khi load nhà cung cấp!');
        //    },
        //    complete: function () {

        //        //$("#boxLoading").hide();
        //    }
        //});
    }
    $('.boxdrpmega input[name="buyCardAmountSelect"]').each(function () {
        $(this).change(function () {
            radioButtonChecked($(this));
            $('#CardAmount').removeClass('errorClass');
            $($('#CardAmount')).tooltip('hide').attr('data-original-title', '')
            self.loadPercent(self.provider, $(this).val());
        });
    });
    //function load card type follow provider
    self.loadAllCardType = function (PrividerId) {
        $.ajax({
            url: "/user/GetListCardTypeByProviderId",
            type: 'get',
            data: { PrividerId: PrividerId },
            dataType: 'json',

            success: function (obj) {
                if (obj.Success == true) {
                    var strHTML = "<table style='width: 100%;' rel=" + PrividerId + "><tbody><tr><td>";
                    for (var i = 0; i < obj.data.length; i++) {
                        strHTML += "<input class='left' name='buyCardAmountSelect' id='buyCardAmountSelect_" + obj.data[i].Id + "' rel='buyCardAmount' value='" + obj.data[i].Amount + "' txt=" + obj.data[i].CardName + " type='radio'>";
                        strHTML += "<label class='left' for='buyCardAmountSelect_" + obj.data[i].Id + "'>" + obj.data[i].CardName + "</label>";
                        strHTML += "<div style='clear:both;'></div><span class='separator'></span>";
                    }
                    strHTML += "</td></tr></tbody></table>";
                    $("#table_CardAmount").html(strHTML);

                    //Select item                   
                    $('.boxdrpmega input[name="buyCardAmountSelect"]').each(function () {
                        $(this).change(function () {
                            radioButtonChecked($(this));
                            $('#buyCardAmount').removeClass('errorClass');
                            $($('#buyCardAmount')).tooltip('hide').attr('data-original-title', '')

                        });
                    });
                }
            },
            error: function (obj) {
                alert('lỗi khi load mệnh giá thẻ!');
            },
            complete: function () {
                //$("#boxLoading").hide();
            }
        });



    }
    // load percent

    self.loadPercent = function (PrividerId, amount) {
        $('.muathepc').hide();
        var n = parseInt(amount);
        $('.muathepc' + PrividerId + ' .chietkhau').html(n.toLocaleString('en-US', { minimumFractionDigits: 0 }) + ' Đ');
        $('.muathepc' + PrividerId).show();
        $(".muathepercen").show();
    }
    //function check valid buy card
    self.validatebuycard = function () {
        var flag = true;
        var thanhtoan = $('#buyCardPaymentMethod').attr('value');
        if ($.trim(thanhtoan) == '') {
            $($('#buyCardPaymentMethod')).tooltip('hide').attr('title', 'Chọn nhà cung cấp').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#buyCardPaymentMethod').data("title", "").removeClass("errorClass").tooltip("destroy");
        }


        var provider = $('#ProviderId').val();
        if ($.trim(provider) == '') {
            $($('#ProviderId')).tooltip('hide').attr('title', 'Chọn nhà cung cấp').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ProviderId').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var cardamount = $('#CardAmount').val();
        if ($('#CardAmount').find(':selected').val() == "0") {
            $($('#CardAmount')).tooltip('hide').attr('title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#CardAmount').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var slthe = $('#ctrlsoluongthe').val();
        if ($.trim(slthe) == '' || $.trim(slthe) == 0) {
            $($('#ctrlsoluongthe')).tooltip('hide').attr('title', 'Nhập số lượng thẻ cần mua').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlsoluongthe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var email = $('#ctrlghichumuathe').val();
        if ($.trim(email) == '' && thanhtoan == 'Paycard') {
            $($('#ctrlghichumuathe')).tooltip('hide').attr('data-original-title', 'Nhập địa mk cấp 2').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlghichumuathe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        var email1 = $('#ctrlemailaddress').val();
        if ($.trim(email1) != '') {
            if (!Common.IsValidEmail(email1)) {
                $($('#ctrlemailaddress')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        return flag;
    }

    //check valid login
    self.validateloginbuycard = function () {
        var flag = true;
        var uemail = $('#ctrlemailtxt_log').val();
        if ($.trim(uemail) == '') {
            $($('#ctrlemailtxt_log')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($.trim(uemail) != '') {
            if (!Common.IsValidEmail(uemail)) {
                $($('#ctrlemailtxt_log')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        var pass = $('#ctrlpasstxt_log').val();
        if ($.trim(pass) == '') {
            $($('#ctrlpasstxt_log')).tooltip('hide').attr('title', 'Hãy nhập mật khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlpasstxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }

}
function BuyCardGame() {
    var self = this;
    //event keypress in confirm preview buycard login
    $('#ctrlgameemailtxt_log').keyup(function () {
        if ($('#ctrlemailtxt_log').val() != '' && Common.IsValidEmail($('#ctrlgameemailtxt_log').val())) {
            $($('#ctrlgameemailtxt_log')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });
    $('#ctrlgamepasstxt_log').keyup(function () {
        if ($('#ctrlgamepasstxt_log').val() != '') {
            $($('#ctrlgamepasstxt_log')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });

    //event textbox email in buycard
    $('#ctrlemailaddressgame').keyup(function () {
        if ($('#ctrlemailaddressgame').val() != '' && Common.IsValidEmail($('#ctrlemailaddressgame').val())) {
            $($('#ctrlemailaddressgame')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });


    //event chọn phương thức thanh toán
    $('.boxdrpmega input[name="buyCardGamePaymentMethod"]').each(function () {
        $(this).change(function () {
            radioButtonChecked($(this));
            $($('#buyCardGamePaymentMethod')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        });
    });

    //event click mua the
    $('#ctrlmuathegamebtn').on("click", function () {
        if (self.validatebuycardgame()) {
            //pass prameter and show modal confirm
            $("#lblgameprovider").text($('#buyCardGameProvider').val());
            $("#lblgamecardtype").text($('#buyCardGameAmount').val());
            $("#lblgamesoluongthe").text($('#ctrlsoluongthegame').val());
            $("#lblgameemail").text($('#ctrlemailaddressgame').val());
            $("#lblgamepaymentmethod").text('tài khoản thành viên');
            /*var totalPay = parseInt($('#ctrlsoluongthe').val()) * parseInt($('#buyCardAmount').val());
            document.getElementById("ctrthanhtoanbtn").disabled = true;
            if (totalPay >= 1000)
              {  refUrlCountDown();}
            else
               { document.getElementById("ctrthanhtoanbtn").disabled = false;}*/
            if ($('#buyCardGamePaymentMethod').attr('value') == 'Paycard') { //case select paycard
            $.ajax({
                url: "/user/CheckIfSessionValid",
                type: "POST",
                success: function (result) {
                    if (result.Success == false) {
                        $("#Confirm_OrderGameDetail").show();
                    }
                    else
                        $("#Confirm_OrderGameDetail").hide();
                }
            });
            } else {
                $("#Confirm_OrderGameDetail").hide();
                $('#lblptttgame').text('Ngân hàng thanh toán: ')
            }

            $('#buycardgamepreviewmodal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#divgamenotifybc span').text('');
            $('#divgamenotifybc').hide();
            $('#ctrlgameemailtxt_log').val('');
            $('#ctrlgamepasstxt_log').val('');
        }
    });

    //event btn thanhtoan in modal preview click
    $('#ctrthanhtoangamebtn').on("click", function () {
        var isVisible = $('#Confirm_OrderGameDetail').is(':visible');
        if ($('#buyCardGamePaymentMethod').attr('value') == 'Paycard') {//case select paycard
        if (isVisible) { //Case not login
            if (self.validateloginbuycardgame()) {//check valid login
                self.LoginbuycardGame($('#ctrlgameemailtxt_log').val(), $('#ctrlgamepasstxt_log').val(), function () {//login calback
                    self.buycardgamenotsigin($('#ctrlgameemailtxt_log').val(), $('#ctrlgamepasstxt_log').val(), $('#buyCardGameProvider').attr('value'), $('#buyCardGameAmount').attr('value'), $('#ctrlgameghichumuathe').val())
                });
            }
        } else {//case has login                
            $('#buycardgamepreviewmodal').modal('hide');
            $.ajax({
                url: "/user/PaymentBuyCardHasLogin",
                type: 'POST',
                data: { providerId: $('#buyCardGameProvider').attr('value'), amount: $('#buyCardGameAmount').attr('value'), quantity: $("#ctrlsoluongthegame").val(), password2: $('#ctrlgameghichumuathe').val() },
                dataType: 'json',
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (obj) {
                    $('#buycardgameshowresultmodal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    if (obj.Success == true) {
                        if (obj.data.errorCode != 00) {
                            //$('#tblcardinfo').hide();
                            $('.divgameresult').hide();
                            $("#gamenotifyresult").addClass('alert-warning');
                            $('#gamenotifyresult i').addClass('fa-times-circle');
                            $('#gamenotifyresult strong').text('Lỗi giao dịch: ');
                            $('#gamenotifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                        } else {
                            $("#gamenotifyresult").addClass('alert-success');
                            $('#gamenotifyresult i').addClass('fa-check');
                            $('#gamenotifyresult strong').text('Success ');
                            $('#gamenotifyresult span').text("Quý khách vui lòng kiểm tra email để lấy thông tin thẻ cào");
                            //$('#buycardtblcardinfo').hide();
                            var rsp = obj.data.listCards.split('|');
                            var rspListCard = jQuery.parseJSON(obj.data.listCards);
                            for (var i = 0; i < rspListCard.length; i++) {
                                $('#tblgamecardinfo tbody').append('<tr><td class="text-center">' + rspListCard[i].ProviderCode + '</td><td class="text-center">' + rspListCard[i].Amount + '</td><td class="text-center">' + "'" + rspListCard[i].PinCode + '</td><td class="text-center">' + "'" + rspListCard[i].Serial + '</td></tr>');
                            }
                            $('.divgameresult').show();

                        }
                    } else {
                        $('.divgameresult').hide();
                        $("#gamenotifyresult").addClass('alert-warning');
                        $('#gamenotifyresult i').addClass('fa-times-circle');
                        $('#gamenotifyresult strong').text('Error! ');
                        $('#tblgamecardinfo').hide();
                    }
                },
                error: function (obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                },
                complete: function () {
                    $("#boxLoading").hide();
                }
            });
        }
        } else { //case select bank            
            self.paymentbuycardgameusesbank($('#buyCardGamePaymentMethod').attr('value'), $('#buyCardGameProvider').attr('value'), $('#ctrlemailaddressgame').val(), $('#buyCardGameAmount').attr('value'), $('#ctrlsoluongthegame').val())
        }
    });
    $('#xuatexelgame').on("click", function () {
        var str = document.getElementById('tblgamecardinfo').outerHTML;//$('.buycarddivresult').html();//tableExport({ type: 'excel', escape: 'false' });
        var excelFile = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:" + "excel" + "' xmlns='http://www.w3.org/TR/REC-html40'>";
        excelFile += "<meta http-equiv='content-type' content='application/vnd.ms-excel; charset=UTF-8'>"
        excelFile += "<head>";
        excelFile += "<!--[if gte mso 9]>";
        excelFile += "<xml>";
        excelFile += "<x:ExcelWorkbook>";
        excelFile += "<x:ExcelWorksheets>";
        excelFile += "<x:ExcelWorksheet>";
        excelFile += "<x:Name>";
        excelFile += "{worksheet}";
        excelFile += "</x:Name>";
        excelFile += "<x:WorksheetOptions>";
        excelFile += "<x:DisplayGridlines/>";
        excelFile += "</x:WorksheetOptions>";
        excelFile += "</x:ExcelWorksheet>";
        excelFile += "</x:ExcelWorksheets>";
        excelFile += "</x:ExcelWorkbook>";
        excelFile += "</xml>";
        excelFile += "<![endif]-->";
        excelFile += "</head>";
        excelFile += "<body>";
        excelFile += str;
        excelFile += "</body>";
        excelFile += "</html>";
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(excelFile));
    })
    //Function login buy card
    self.LoginbuycardGame = function (email, password, callback) {
        $.ajax({
            type: "POST",
            url: "/user/login",
            data: { email: email, password: password },
            dataType: 'json',
            success: function (msg) {
                if (msg.Success == true) {
                    $('#buycardgamepreviewmodal').modal('hide');
                    if (callback) callback();
                }
                else {
                    $('#divgamenotifybc span').text('Nhập sai tên đăng nhập hoặc mật khẩu');
                    $('#divgamenotifybc').show();
                }
            },
            error: function (msg) {
            }
        });
    }

    //function buy card not login
    self.buycardgamenotsigin = function (email, password, providerid, amount, mailadd) {
        $.ajax({
            url: "/user/PaymentBuyCardNotLogin",
            type: 'POST',
            data: { UserName: email, password: password, providerId: $('#buyCardGameProvider').attr('value'), amount: $('#buyCardGameAmount').attr('value'), quantity: $("#ctrlsoluongthegame").val(), password2: mailadd },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                if (obj.Success == true) {
                    if (obj.data.errorCode != 00) {
                        $('#tblgamecardinfo').hide();
                        $('.divgameresult').hide();
                        $("#gamenotifyresult").addClass('alert-warning');
                        $('#gamenotifyresult i').addClass('fa-times-circle');
                        $('#gamenotifyresult strong').text('Lỗi giao dịch: ');
                        $('#gamenotifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                    } else {
                        $("#gamenotifyresult").addClass('alert-success');
                        $('#gamenotifyresult i').addClass('fa-check');
                        $('#gamenotifyresult strong').text('Success ');
                        $('#gamenotifyresult span').text("Quý khách vui lòng kiểm tra email để lấy thông tin thẻ cào");
                        //$('#tblcardinfo').show();
                        //var rsp = obj.data.listCards.split('|');



                        var currentdate = new Date();
                        var hours = new Date().getHours();
                        var hours = (hours + 24 - 2) % 24;
                        var mid = 'am';
                        if (hours == 0) {
                            hours = 12;
                        }
                        else if (hours > 12) {
                            hours = hours % 12;
                            mid = 'pm';
                        }
                        var datetime = "Now: " + currentdate.getDate() + "/"
                                    + (currentdate.getMonth() + 1) + "/"
                                    + currentdate.getFullYear() + " "
                                    + hours + ":"
                                    + currentdate.getMinutes() + ":"
                                    + currentdate.getSeconds() + " " + mid;

                        $(".datetransactiongame").text(datetime);
                    }
                    //$(location).attr('href', '/');
                } else {
                    $('.divgameresult').hide();
                    $("#gamenotifyresult").addClass('alert-warning');
                    $('#gamenotifyresult i').addClass('fa-times-circle');
                    $('#gamenotifyresult strong').text('Error! ');
                    $('#tblgamecardinfo').hide();
                    $(location).attr('href', '/');
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }

    //function buy card select bank method
    self.paymentbuycardgameusesbank = function (bankCode, providerId, email, amount, quantity) {
        $.ajax({
            url: "/user/PaymentBuyCardUsesBankEPay",
            type: 'POST',
            data: { bankCode: bankCode, providerId: providerId, email: email, amount: amount, quantity: quantity },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                $('#buycardgameshowresultmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                if (obj.Success == true) {
                    if (obj.Signature == true) {
                        if (obj.data.responsecode == "00") {
                            window.location.href = obj.data.url;
                        } else {
                            $('.divgameresult').hide();
                            $("#gamenotifyresult").addClass('alert-warning');
                            $('#gamenotifyresult i').addClass('fa-times-circle');
                            $('#gamenotifyresult strong').text('Kết nối với ngân hàng đang bị gián đoạn, mời bạn chọn sử dụng ngân hàng khác! ');
                            $('#tblcardinfo').hide();
                        }

                    } else {
                        $('#tblgamecardinfo').hide();
                        $('.divgameresult').hide();
                        $("#gamenotifyresult").addClass('alert-warning');
                        $('#gamenotifyresult i').addClass('fa-times-circle');
                        $('#gamenotifyresult strong').text('Lỗi giao dịch: ');
                        $('#gamenotifyresult span').text(obj.data.Message + ' ' + obj.data.RspCode);
                    }
                } else {
                    $('.divgameresult').hide();
                    $("#gamenotifyresult").addClass('alert-warning');
                    $('#gamenotifyresult i').addClass('fa-times-circle');
                    $('#gamenotifyresult strong').text('Nhà mạng đang bảo trì! ');
                    $('#tblgamecardinfo').hide();
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }


    self.loadAllProvider = function () {
        $.ajax({
            //url: "/user/GetListProvider",
            url: "/user/GetListGroupProvider",
            type: 'get',
            data: {},
            dataType: 'json',
            //beforeSend: function () {
            //    $("#boxLoading").show();
            //},
            success: function (obj) {
                if (obj.Success == true) {
                    var strHTML = "<td>";
                    for (var i = 0; i < obj.data.length; i++) {
                        //strHTML += "<p><input id='buyCardProviderSelect_" + obj.data[i].Name + "' name='buyCardProviderSelect' rel='buyCardProvider' value=" + obj.data[i].Id + " txt=" + obj.data[i].Name  + " type='radio' class='left'>";
                        //strHTML += "&nbsp;<label class='left mL5' for='buyCardProviderSelect_" + obj.data[i].Name + "'>" + obj.data[i].Name + "</label>";
                        strHTML += "<p><input id='buyCardGameProviderSelect_" + obj.data[i].Description + "' name='buyCardGameProviderSelect' rel='buyCardProvider' value=" + obj.data[i].ProviderId + " txt='" + obj.data[i].Description + "' type='radio' class='left'>";
                        strHTML += "&nbsp;<label class='left mL5' for='buyCardGameProviderSelect_" + obj.data[i].Description + "'>" + obj.data[i].Description + "</label>";
                        strHTML += "<span class='separator'></span></p>"
                    }
                    strHTML += "</td>";
                    $("#trgameprovider").html(strHTML);

                    //Select provider
                    $('.boxdrpmega input[name="buyCardGameProvider"]').each(function () {
                        $(this).change(function () {
                            radioButtonChecked($(this));
                            $('#buyCardGameProvider').removeClass('errorClass');
                            $($('#buyCardGameProvider')).tooltip('hide').attr('data-original-title', '')
                            self.loadAllCardType($(this).val());
                        });
                    });
                }
            },
            error: function (obj) {
                //alert('lỗi khi load nhà cung cấp!');
            },
            complete: function () {

                //$("#boxLoading").hide();
            }
        });
    }
    self.loadAllProvider1 = function () {
        var strHTML = "<td>";
        strHTML += '<p><input id="buyCardGameProviderSelect_Datamobi" name="buyCardGameProviderSelect" rel="buyCardGameProvider" value="16" txt="Datamobi (6.5%)" gate="" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardGameProviderSelect_Datamobi">Datamobi (6.5%)</label><span class="separator"></span></p><p><input id="buyCardGameProviderSelect_FPT Gate" name="buyCardGameProviderSelect" rel="buyCardGameProvider" value="5" txt="FPT (3.5%)" gate="" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardGameProviderSelect_FPT Gate">FPT Gate (3.5%)</label><span class="separator"></span></p><p><input id="buyCardGameProviderSelect_ZING" name="buyCardGameProviderSelect" rel="buyCardGameProvider" value="12" txt="ZING (3.5%)" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardGameProviderSelect_ZING">ZING (3.5%)</label><span class="separator"></span></p><p><input id="buyCardGameProviderSelect_VTC" name="buyCardGameProviderSelect" rel="buyCardGameProvider" value="13" txt="Vcoin (3.5%)" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardGameProviderSelect_VTC">Vcoin (3.5%)</label><span class="separator"></span></p><p><input id="buyCardGameProviderSelect_GAR" name="buyCardGameProviderSelect" rel="buyCardGameProvider" value="14" txt="GAR (3.5%)" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardGameProviderSelect_GAR">Garena (3.5%)</label><span class="separator"></span></p>';
        strHTML += "</td>";

        $("#trgameprovider").html(strHTML);

        //Select provider
        $('.boxdrpmega input[name="buyCardGameProviderSelect"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $('#buyCardGameProvider').removeClass('errorClass');
                $($('#buyCardGameProvider')).tooltip('hide').attr('data-original-title', '')
                self.loadAllCardType($(this).val());
            });
        });

    }
    //function load card type follow provider
    self.loadAllCardType = function (PrividerId) {
        $.ajax({
            url: "/user/GetListCardTypeByProviderId",
            type: 'get',
            data: { PrividerId: PrividerId },
            dataType: 'json',
            //beforeSend: function () {
            //    $("#boxLoading").show();
            //},
            success: function (obj) {
                if (obj.Success == true) {
                    var strHTML = "<table style='width: 100%;' rel=" + PrividerId + "><tbody><tr><td>";
                    for (var i = 0; i < obj.data.length; i++) {
                        strHTML += "<input class='left' name='buyCardGameAmountSelect' id='buyCardGameAmountSelect_" + obj.data[i].Id + "' rel='buyCardGameAmount' value='" + obj.data[i].Amount + "' txt=" + obj.data[i].CardName + " type='radio'>";
                        strHTML += "<label class='left' for='buyCardGameAmountSelect_" + obj.data[i].Id + "'>" + obj.data[i].CardName + "</label>";
                        strHTML += "<div style='clear:both;'></div><span class='separator'></span>";
                    }
                    strHTML += "</td></tr></tbody></table>";
                    $("#game_CardAmount").html(strHTML);

                    //Select item                   
                    $('.boxdrpmega input[name="buyCardGameAmountSelect"]').each(function () {
                        $(this).change(function () {
                            radioButtonChecked($(this));
                            $('#buyCardGameAmount').removeClass('errorClass');
                            $($('#buyCardGameAmount')).tooltip('hide').attr('data-original-title', '')

                        });
                    });
                }
            },
            error: function (obj) {
                alert('lỗi khi load mệnh giá thẻ!');
            },
            complete: function () {
                //$("#boxLoading").hide();
            }
        });
    }

    //function check valid buy card
    self.validatebuycardgame = function () {
        var flag = true;
        var thanhtoan = $('#buyCardGamePaymentMethod').attr('value');
        if ($.trim(thanhtoan) == '') {
            $($('#buyCardGamePaymentMethod')).tooltip('hide').attr('title', 'Chọn nhà cung cấp').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#buyCardGamePaymentMethod').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        var provider = $('#buyCardGameProvider').val();
        if ($.trim(provider) == '') {
            $($('#buyCardGameProvider')).tooltip('hide').attr('title', 'Chọn nhà cung cấp').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#buyCardGameProvider').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var cardamount = $('#buyCardGameAmount').val();
        if ($.trim(cardamount) == '') {
            $($('#buyCardGameAmount')).tooltip('hide').attr('title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#buyCardGameAmount').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var slthe = $('#ctrlsoluongthegame').val();
        if ($.trim(slthe) == '' || $.trim(slthe) == 0) {
            $($('#ctrlsoluongthegame')).tooltip('hide').attr('title', 'Nhập số lượng thẻ cần mua').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlsoluongthegame').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        var email = $('#ctrlemailaddressgame').val();
        if ($.trim(email) == '') {
            $($('#ctrlemailaddressgame')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlemailaddressgame').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim(email) != '') {
            if (!Common.IsValidEmail(email)) {
                $($('#ctrlemailaddressgame')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailaddressgame').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }
        var email1 = $('#ctrlgameghichumuathe').val();
        if ($.trim(email1) == '' && thanhtoan == 'Paycard') {
            $($('#ctrlgameghichumuathe')).tooltip('hide').attr('data-original-title', 'mk').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlgameghichumuathe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }




        return flag;
    }

    //check valid login
    self.validateloginbuycardgame = function () {
        var flag = true;

        var uemail = $('#ctrlgameemailtxt_log').val();
        if ($.trim(uemail) == '') {
            $($('#ctrlgameemailtxt_log')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlgameemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(uemail) != '') {
            if (!Common.IsValidEmail(uemail)) {
                $($('#ctrlgameemailtxt_log')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlgameemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        var pass = $('#ctrlgamepasstxt_log').val();
        if ($.trim(pass) == '') {
            $($('#ctrlgamepasstxt_log')).tooltip('hide').attr('title', 'Hãy nhập mật khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlgamepasstxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }

}
//Nap tiền điện thoại
function TopupMobile() { //nap tiền vào tài khoản qua thẻ điện thoại
    var self = this;
    self.init_naptiendienthoai = function () {
        //event textbox nhap so dien thoai
        $('#ctrlSoDienThoai').keyup(function () {
            if ($('#ctrlSoDienThoai').val() != '') {
                $($('#ctrlSoDienThoai')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        //event textbox email in nap tien dien thoai
        $('#ctrlnapdienthoaiemailaddress').keyup(function () {
            if ($('#ctrlnapdienthoaiemailaddress').val() != '' && Common.IsValidEmail($('#ctrlnapdienthoaiemailaddress').val())) {
                $($('#ctrlnapdienthoaiemailaddress')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        self.loadAllCardType();

        //event chọn phương thức thanh toán
        $('.boxdrpmega input[name="topupPaymentMethod"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $($('#topupPaymentMethod')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');

            });
        });
        $('.boxdrpmega #topupAmount').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $('#topupAmount').removeClass('errorClass');
                $($('#topupAmount')).tooltip('hide').attr('data-original-title', '')
                self.loadPercent($('#ctrlSoDienThoai').val(), $(this).val())
            });
        });
        $('.boxdrpmega input[name="NapGameCardTypeSelect"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $('#NapGameCardType').removeClass('errorClass');
                $($('#NapGameCardType')).tooltip('hide').attr('data-original-title', '');
                //self.NapGameloadAllCardType(1);
            });
        });
        self.loadPercent = function (mobileno, amount) {
            $('.topuppc').hide();
            var n = parseInt(amount);
            if ($.trim(mobileno) == '') {
                $($('#ctrlSoDienThoai')).tooltip('hide').attr('title', 'Nhập số điện thoại').tooltip('fixTitle').addClass('errorClass');
            } else {
                $.ajax({
                    url: "/user/GetProviderbyNumberPhone",
                    type: 'POST',
                    data: { number: mobileno, typenap: "topup" },
                    dataType: 'json',
                    success: function (obj2) {
                        if (obj2.Success == true) {
                            self.sodienthoaitopup = obj2.sodienthoai;
                            self.codeprovidertopup = obj2.codeprovider;
                            self.chietkhautopup = obj2.chietkhaumang;
                            //debugger;
                            if (obj2.codeprovider != 'VNM' || obj2.codeprovider != 'BEE') {
                                $('.topuppc' + obj2.codeprovider + ' .chietkhau').html(n.toLocaleString('en-US', { minimumFractionDigits: 0 }) + ' Đ');
                                $('.topuppc' + obj2.codeprovider).show();
                                $(".topuppercen").show();
                            }
                        }

                        //$("#Confirm_OrderDetail").hide();
                    }
                });
            }


        }
        $('#ctrltopupmobilebtn').on("click", function () {

            if (self.validatenaptiendienthoai()) {
                var sodienthoai = $('#ctrlSoDienThoai').val();
                //Code new
                if (sodienthoai != '') {
                    $("#lblphone").text($('#ctrlSoDienThoai').val());
                    var _amount = $('#topupAmount').val();
                    var n = parseInt(_amount);
                    $("#lblmenhgia").text(n.toLocaleString('en-US', { minimumFractionDigits: 0 }) + " đ");
                    $("#lbltopupemail").text($('#ctrlnapdienthoaiemailaddress').val());

                    if ($('#topupPaymentMethod').attr('value') == 'Paycard') {
                    $.ajax({
                        url: "/user/CheckIfSessionValid",
                        type: "POST",
                        success: function (result) {
                            if (result.Success == false) {
                                $("#Topup_Confirm_OrderDetail").show();
                            }
                            else
                                $("#Topup_Confirm_OrderDetail").hide();
                        }
                    });
                    } else {
                        $("#Topup_Confirm_OrderDetail").hide();
                        $('#lblpttt').text('Ngân hàng thanh toán: ')
                    }

                    $('#naptiendienthoaipreviewmodal').modal({
                        backdrop: 'static',
                        keyboard: false

                    });
                }
                else {
                    alert('Mời nhập số điện thoại!');
                }


            }
        });

        $('#ctrtopupthanhtoanbtn').on("click", function () {
            var isVisible = $('#Topup_Confirm_OrderDetail').is(':visible');


            if (isVisible) { //Case not login
                //XXX
                if (self.validatelogintopup()) {//check valid login
                    self.Logintopup($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), function () {//login calback
                        self.topupnotsigin($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), $('#ctrlSoDienThoai').attr('value'), $('#topupAmount').attr('value'), $('#ctrlnapdienthoaiemailaddress').val())
                    });
                }
            } else {//case has login                
                $('#naptiendienthoaipreviewmodal').modal('hide');
                $.ajax({
                    url: "/user/PaymentTopupMobileHasLogin",
                    type: 'POST',
                    data: { sodienthoai: $('#ctrlSoDienThoai').val(), amount: $('#topupAmount').attr('value'), email: $("#ctrlemailaddress").val(), mailnhan: $("ctrlnapdienthoaiemailaddress").val() },
                    dataType: 'json',
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (obj) {
                        $('#naptiendienthoairesultmodal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        if (obj.Success == true) {
                            $('#tblcardinfo').hide();
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-success');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Nạp thẻ thành công! ');

                            sodutaikhoan();
                        } else {
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Lỗi giao dịch nạp thẻ! ');
                            $('#tblcardinfo').hide();
                        }
                    },
                    error: function (obj) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    },
                    complete: function () {
                        $("#boxLoading").hide();
                    }
                });
            }

        });

        //event btn thanhtoan in modal preview click
        $('#ctrtopupthanhtoanbtn_desktop').on("click", function () {
            var isVisible = $('#Topup_Confirm_OrderDetail').is(':visible');
            if ($('#topupPaymentMethod').attr('value') == 'Paycard') { 

            if (isVisible) { //Case not login
                //XXX
                if (self.validatelogintopup()) {//check valid login
                    self.Logintopup($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), function () {//login calback
                        self.topupnotsigin($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), $('#ctrlSoDienThoai').attr('value'), $('#topupAmount').attr('value'), $("#topupghichumuathe").val())
                    });
                }
            } else {//case has login                
                $('#naptiendienthoaipreviewmodal').modal('hide');
                var _amount_ = $('#topupAmount').val();
                // var _arr = _amount_.split("-");
                //_amount_ = _arr[1];
                var _email = $("#topupghichumuathe").val();
                var _sdt = $('#ctrlSoDienThoai').val();

                $.ajax({
                    url: "/user/PaymentTopupMobileHasLogin",
                    type: 'POST',
                    data: { sodienthoai: _sdt, amount: _amount_, email: _email, password2: _email },
                    dataType: 'json',
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (obj) {
                        $('#naptiendienthoairesultmodal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        if (obj.Success == true) {
                            $('#tblcardinfo').hide();
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-success');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Nạp thẻ thành công! ');

                            sodutaikhoan();
                        } else {
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Lỗi giao dịch nạp thẻ! ' + obj.msg);
                            $('#tblcardinfo').hide();
                        }
                    },
                    error: function (obj) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    },
                    complete: function () {
                        $("#boxLoading").hide();
                    }
                });
            }
            } else { //case select bank            
                self.paymenttopupusesbank($('#topupPaymentMethod').attr('value'), $('#ctrlSoDienThoai').val(), $('#topupAmount').val(), $('#ctrlnapdienthoaiemailaddress').val())
            }
        });
    }

    //Function login buy card
    self.Logintopup = function (email, password, callback) {
        $.ajax({
            type: "POST",
            url: "/user/login",
            data: { email: email, password: password },
            dataType: 'json',
            success: function (msg) {
                if (msg.Success == true) {
                    $('#naptiendienthoaipreviewmodal').modal('hide');
                    if (callback) callback();
                }
                else {
                    $('#divnotifynt span').text('Nhập sai tên đăng nhập hoặc mật khẩu');
                    $('#divnotifynt').show();
                }
            },
            error: function (msg) {
            }
        });
    }
    self.paymenttopupusesbank = function (bankCode, sodienthoai, amount, email) {
        $.ajax({
            url: "/user/PaymentTopupMobileUsesBankEpay",
            type: 'POST',
            data: { bankCode: bankCode, sodienthoai: sodienthoai, amount: amount, email: email },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                $('#naptiendienthoairesultmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                if (obj.Success == true) {
                    if (obj.Signature == true) {
                        window.location.href = obj.data.url;
                    } else {
                        $('#tblcardinfo').hide();
                        $('.divresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Lỗi giao dịch: ');
                        if (obj.data) {
                            $('#notifyresult span').text(obj.data.Message + ' ' + obj.data.RspCode);
                            $('#naptiendienthoaipreviewmodal').modal('toggle');
                        } else {
                            $('#notifyresult span').text(obj.Message);
                            $('#naptiendienthoaipreviewmodal').modal('toggle');
                        }

                    }
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Error! ');
                    $('#tblcardinfo').hide();
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }

    //function buy card not login
    self.topupnotsigin = function (email, password, sodienthoai, amount, mailadd) {
        $.ajax({
            url: "/user/PaymentTopupMobileNotLogin",
            type: 'POST',
            data: { UserName: email, password: password, sodienthoai: sodienthoai, amount: amount, password2: mailadd },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                if (obj.Success == true) {
                    $('#tblcardinfo').hide();
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-success');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Nạp thẻ thành công! ');
                    // cập nhật lại số tiền
                    $("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                    $("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                    $("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                    $("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Lỗi giao dịch nạp thẻ! ' + obj.msg);
                    $('#tblcardinfo').hide();
                    $(location).attr('href', '/');
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }

    self.validatelogintopup = function () {
        var flag = true;

        var uemail = $('#ctrlemailtxt_log').val();
        if ($.trim(uemail) == '') {
            $($('#ctrlemailtxt_log')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($.trim(uemail) != '') {
            if (!Common.IsValidEmail(uemail)) {
                $($('#ctrlemailtxt_log')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        var pass = $('#ctrlpasstxt_log').val();
        if ($.trim(pass) == '') {
            $($('#ctrlpasstxt_log')).tooltip('hide').attr('title', 'Hãy nhập mật khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlpasstxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }

    self.loadAllCardType = function () {
        $.ajax({
            url: "/user/GetListCardTypeByProviderId",
            type: 'get',
            data: { PrividerId: 1 },
            dataType: 'json',
            //beforeSend: function () {
            //    $("#boxLoading").show();
            //},
            success: function (obj) {
                if (obj.Success == true) {
                    //var strHTML = "<table style='width: 100%;' rel=" + 1 + "><tbody><tr><td>";
                    var strHTML = "";
                    strHTML = strHTML + "<select id='topupAmount'>";
                    strHTML = strHTML + "<option value='0'>Mệnh giá thẻ nạp</option>";
                    for (var i = 0; i < obj.data.length; i++) {
                        //strHTML += "<input class='left' name='topupAmountSelect' topupAmountSelect_" + obj.data[i].Id + "' rel='topupAmount' value='" + obj.data[i].Amount + "' txt=" + obj.data[i].CardName + " type='radio'>";
                        //strHTML += "<label class='left' for='topupAmountSelect_" + obj.data[i].Id + "'>" + obj.data[i].CardName + "</label>";
                        //strHTML += "<div style='clear:both;'></div><span class='separator'></span>";
                        strHTML = strHTML + "<option value='" + obj.data[i].Amount + "'>" + obj.data[i].CardName + "</option>";
                    }
                    strHTML = strHTML + "</select>";
                    //strHTML += "</td></tr></tbody></table>";

                    $("#topupAmount").remove();
                    $("#table_topupAmount").html(strHTML);
                    $("#table_topupAmount").show();
                    //Select item                   
                    $("#topupAmount").change(function () {
                        radioButtonChecked($(this));
                        $('#topupAmount').removeClass('errorClass');
                        $($('#topupAmount')).tooltip('hide').attr('data-original-title', '')
                        self.loadPercent($('#ctrlSoDienThoai').val(), $(this).val())
                    });
                }
            },
            error: function (obj) {
                alert('lỗi khi load mệnh giá thẻ!');
            },
            complete: function () {
                //$("#boxLoading").hide();
            }
        });
    }

    self.validatenaptiendienthoai = function () {
        var flag = true;
        var thanhtoan = $('#topupPaymentMethod').attr('value');
        if ($.trim(thanhtoan) == '') {
            $($('#topupPaymentMethod')).tooltip('hide').attr('title', 'Chọn nhà cung cấp').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#topupPaymentMethod').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        var sodienthoai = $('#ctrlSoDienThoai').val();
        if ($.trim(sodienthoai) == '') {
            $($('#ctrlSoDienThoai')).tooltip('hide').attr('title', 'Nhập số điện thoại').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlSoDienThoai').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        var pas2 = $('#topupghichumuathe').val();
        if ($('#topupghichumuathe').val() == '' && thanhtoan == 'Paycard') {
            $($('#topupghichumuathe')).tooltip('hide').attr('title', 'Mật khẩu cấp 2').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#topupghichumuathe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }



        var cardtype = $('#NapGameCardType').val();

        if ($('#NapGameCardType').find(':selected').val() == "0") {
            $($('#NapGameCardType')).tooltip('hide').attr('title', 'Chọn mệnh hình thức thanh toán').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#NapGameCardType').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        var cardamount = $('#topupAmount').val();

        if ($('#topupAmount').find(':selected').val() == "0") {
            $($('#topupAmount')).tooltip('hide').attr('title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#topupAmount').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        var email = $('#ctrlnapdienthoaiemailaddress').val();
        if ($.trim(email) == '') {
            $($('#ctrlnapdienthoaiemailaddress')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlnapdienthoaiemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim(email) != '') {
            if (!Common.IsValidEmail(email)) {
                $($('#ctrlnapdienthoaiemailaddress')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlnapdienthoaiemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        return flag;
    }
}

//Đổi thẻ (Gạch thẻ)
function GachThe() { //nap tiền vào tài khoản qua thẻ điện thoại
    var self = this;

    self.Init_GachThe = function () {

        //Check User Login
        $.ajax({
            url: "/user/CheckIfSessionValid",
            type: "POST",
            success: function (result) {
                if (result.Success == true) {
                    $('#ctrlPinNumbertxt').attr('readonly', false);
                    $('#ctrlSeriNumbertxt').attr('readonly', false);
                    $('#notifylogin').hide();
                } else {
                    $('#ctrlPinNumbertxt').attr('readonly', true);
                    $('#ctrlSeriNumbertxt').attr('readonly', true);
                    $('#notifylogin').show();
                }
            }
        });
        var strHTML = "<td>";
        strHTML += '<p><input id="GachTheCardTypeSelect_Viettel" name="GachTheCardTypeSelect" rel="GachTheCardType" value="1" txt="Viettel (28.5%)" type="radio" class="left">&nbsp;<label class="left mL5" for="GachTheCardTypeSelect_Viettel">Viettel (28.5%)</label><span class="separator"></span></p><p><input id="GachTheCardTypeSelect_Mobifone" name="GachTheCardTypeSelect" rel="GachTheCardType" value="2" txt="Mobifone (28%)" type="radio" class="left">&nbsp;<label class="left mL5" for="GachTheCardTypeSelect_Mobifone">Mobifone (28%)</label><span class="separator"></span></p><p><input id="GachTheCardTypeSelect_Vinaphone" name="GachTheCardTypeSelect" rel="GachTheCardType" value="3" txt="Vinaphone (28%)" type="radio" class="left">&nbsp;<label class="left mL5" for="GachTheCardTypeSelect_Vinaphone">Vinaphone (28%)</label><span class="separator"></span></p><p><input id="GachTheCardTypeSelect_FPT Gate" name="GachTheCardTypeSelect" rel="GachTheCardType" value="5" txt="FPT (21%)" gate="" type="radio" class="left">&nbsp;<label class="left mL5" for="GachTheCardTypeSelect_FPT Gate">FPT Gate (21%)</label><span class="separator"></span></p><p><input id="GachTheCardTypeSelect_Vietnamobile" name="GachTheCardTypeSelect" rel="GachTheCardType" value="7" txt="Vietnamobile (22%)" type="radio" class="left">&nbsp;<label class="left mL5" for="GachTheCardTypeSelect_Vietnamobile">Vietnamobile (22%)</label><span class="separator"></span></p><p><input id="GachTheCardTypeSelect_VTC" name="GachTheCardTypeSelect" rel="GachTheCardType" value="13" txt="VTC (21.75%)" type="radio" class="left">&nbsp;<label class="left mL5" for="GachTheCardTypeSelect_VTC">VTC (21.75%)</label><span class="separator"></span></p><p><input id="GachTheCardTypeSelect_BIT" name="GachTheCardTypeSelect" rel="GachTheCardType" value="15" txt="BIT (19%)" type="radio" class="left">&nbsp;<label class="left mL5" for="GachTheCardTypeSelect_BIT">BIT (19%)</label><span class="separator"></span></p>';
        strHTML += "</td>";
        $("#trgachthe_cardtype").html(strHTML);

        //Select provider<p><input id="GachTheCardTypeSelect_OnGame" name="GachTheCardTypeSelect" rel="GachTheCardType" value="8" txt="OnGame (23.0%)" type="radio" class="left">&nbsp;<label class="left mL5" for="GachTheCardTypeSelect_OnGame">OnGame (23.0%)</label><span class="separator"></span></p><p><input id="GachTheCardTypeSelect_ZING" name="GachTheCardTypeSelect" rel="GachTheCardType" value="12" txt="ZING (22.0%)" type="radio" class="left">&nbsp;<label class="left mL5" for="GachTheCardTypeSelect_ZING">ZING (22.0%)</label><span class="separator"></span></p><p><input id="GachTheCardTypeSelect_MegaCard" name="GachTheCardTypeSelect" rel="GachTheCardType" value="11" txt="MegaCard (14.0%)" type="radio" class="left">&nbsp;<label class="left mL5" for="GachTheCardTypeSelect_MegaCard">MegaCard (14.0%)</label><span class="separator"></span></p>
        $('.boxdrpmega input[name="GachTheCardTypeSelect"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $('#GachTheCardType').removeClass('errorClass');
                $($('#GachTheCardType')).tooltip('hide').attr('data-original-title', '')
                self.loadPercent($(this).val());
            });
        });


    }

    $('#ctrlgachthebtn').on("click", function () {
        if (self.validate_gachthe()) {
            var telco = $('input[name=provider]:checked').val();
            // var telco1 = $('#GachTheCardType').attr('value');//$('#GachTheCardType').val();
            // var telco2 = $('#ctrlPinNumbertxt').val();
            // var telco3 = $('#ctrlSeriNumbertxt').val();
            $("#lblprovider_gachthe").text($('#GachTheCardType').attr('value'));
            $("#lblpinumber").text($('#ctrlPinNumbertxt').val());
            $("#lblserinumber").text($('#ctrlSeriNumbertxt').val());

            $.ajax({
                url: "/CardCharge/CardCharge_gachthe",
                type: 'POST',
                data: { providerId: $('#GachTheCardType').attr('value'), Mathe: $('#ctrlPinNumbertxt').val(), Serial: $('#ctrlSeriNumbertxt').val() },
                dataType: 'json',
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (obj) {
                    if (obj.Success == true) {
                        $('#notifyresult').show();
                        if (obj.data.status != 1) {

                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Lỗi giao dịch: ');
                            if ((obj.data.status == -10) && (obj.data.status == 4)) {
                                $('#notifyresult span').text('Thẻ không chính xác' + ' - lỗi: ' + obj.data.status);
                            } else if (obj.data.status == 50 || obj.data.status == 53) {
                                $('#notifyresult span').text('Thẻ không tồn tại hoặc đã được sử dụng' + ' - lỗi: ' + obj.data.status);
                            } else if ((obj.data.status == 11) && (obj.data.status == -11)) {
                                $('#notifyresult span').text('Nhà mạng bảo trì, vui lòng thực hiện sau' + ' - lỗi: ' + obj.data.status);
                            } else if (obj.data.status == 59) {
                                $('#notifyresult span').text('Thẻ không được kích hoạt' + ' - lỗi: ' + obj.data.status);
                            } else {
                                $('#notifyresult span').text('Có lỗi xảy ra trong quá trình nạp thẻ.' + ' - lỗi: ' + obj.data.status);
                            }
                        } else {
                            $("#notifyresult").addClass('alert-success');
                            $('#notifyresult i').addClass('fa-check');
                            $('#notifyresult strong').text('Thành công! ');
                            $('#notifyresult span').text('Tiền xử lý: ' + obj.data.DRemainAmount + ' VNĐ');
                            // $('#tblcardinfo').show(); 

                        }
                    } else {

                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Có lỗi xảy ra! ');
                        $('#notifyresult span').text(obj.data.message);

                    }
                },
                error: function (obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                },
                complete: function () {
                    $("#boxLoading").hide();
                }
            });
        }
    });


    // load percen
    self.loadPercent = function (PrividerId) {
        $('.naptienpc').hide();
        $('.naptienpc' + PrividerId).show();
        $(".naptienpercen").show();
    }

    //check valid gachthe
    self.validate_gachthe = function () {
        var flag = true;

        var cardtype = $('#GachTheCardType').val();
        if ($.trim(cardtype) == '') {
            $($('#GachTheCardType')).tooltip('hide').attr('title', 'Hãy chọn nhà mạng').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#GachTheCardType').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        var pinumber = $('#ctrlPinNumbertxt').val();
        if ($.trim(pinumber) == '') {
            $($('#ctrlPinNumbertxt')).tooltip('hide').attr('title', 'Hãy nhập mã thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlPinNumbertxt').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var serinumber = $('#ctrlSeriNumbertxt').val();
        if ($.trim(serinumber) == '') {
            $($('#ctrlSeriNumbertxt')).tooltip('hide').attr('title', 'Hãy nhập số serial thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlSeriNumbertxt').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }
}

//Nạp tiền Game
function NapTienGame() {
    var self = this;
    self.init_naptiengame = function () {
        //event textbox nhap tai khoan game
        $('#ctrltaikhoangame').keyup(function () {
            if ($('#ctrltaikhoangame').val() != '') {
                $($('#ctrltaikhoangame')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        //event textbox email in nap thien game
        $('#ctrlnapgameemailaddress').keyup(function () {
            if ($('#ctrlnapgameemailaddress').val() != '' && Common.IsValidEmail($('#ctrlnapgameemailaddress').val())) {
                $($('#ctrlnapgameemailaddress')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });
        var strHTML = "<td>";
        strHTML += '<p><input id="NapGameCardTypeSelect_FPT Gate" name="NapGameCardTypeSelect" rel="NapGameCardType" value="5" txt="FPT (3.65%)" gate="" type="radio" class="left">&nbsp;<label class="left mL5" for="NapGameCardTypeSelect_FPT Gate">FPT Gate (3.65%)</label><span class="separator"></span></p><p><input id="NapGameCardTypeSelect_OnGame" name="NapGameCardTypeSelect" rel="NapGameCardType" value="8" txt="OnGame (4.35%)" type="radio" class="left">&nbsp;<label class="left mL5" for="NapGameCardTypeSelect_OnGame">OnGame (4.35%)</label><span class="separator"></span></p><p><input id="NapGameCardTypeSelect_Megacard" name="NapGameCardTypeSelect" rel="NapGameCardType" value="11" txt="Megacard (4.35%)" type="radio" class="left">&nbsp;<label class="left mL5" for="NapGameCardTypeSelect_Megacard">Megacard (4.35%)</label><span class="separator"></span></p>';
        strHTML += "</td>";
        $("#trnapgame_cardtype").html(strHTML);

        //Select provider
        $('.boxdrpmega input[name="NapGameCardTypeSelect"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $('#NapGameCardType').removeClass('errorClass');
                $($('#NapGameCardType')).tooltip('hide').attr('data-original-title', '');
                self.NapGameloadAllCardType($(this).val());
            });
        });


        //event chọn phương thức thanh toán
        $('.boxdrpmega input[name="NapGamePaymentMethod"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $($('#NapGamePaymentMethod')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            });
        });

        //Event click button nap the game        
        $('#ctrlnaptiengamebtn').on("click", function () {
            if (self.validatenapthegame()) {
                //pass prameter and show modal confirm
                $("#lbltaikhoangame").text($('#ctrltaikhoangame').val());
                $("#lblnapgameprovider").text($('#NapGameCardType').val());
                $("#lblnapgamecardtype").text($('#NapGameAmount').val());
                $("#lblnapgameemail").text($('#ctrlnapgameemailaddress').val());

                $.ajax({
                    url: "/user/CheckIfSessionValid",
                    type: "POST",
                    success: function (result) {
                        if (result.Success == false) {
                            $("#Confirm_OrderNapGameDetail").show();
                        }
                        else
                            $("#Confirm_OrderNapGameDetail").hide();
                    }
                });

                $('#napgamepreviewmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#divnotifybc span').text('');
                $('#divnotifybc').hide();
                $('#ctrlemailtxt_log').val('');
                $('#ctrlpasstxt_log').val('');
            }
        });

        //event btn thanhtoan nap game in modal preview click
        $('#ctrnapgamethanhtoanbtn').on("click", function () {

            var isVisible = $('#Confirm_OrderNapGameDetail').is(':visible');

            if (isVisible) { //Case not login
                //XXX
                if (self.validateloginnapgame()) {//check valid login
                    self.Loginnapgame($('#ctrlnapgameemailtxt_log').val(), $('#ctrlnapthepasstxt_log').val(), function () {//login calback
                        self.napgamenotsigin($('#ctrlnapgameemailtxt_log').val(), $('#ctrlnapthepasstxt_log').val(), $('#ctrltaikhoangame').val(), $('#NapGameCardType').val(), $('#NapGameAmount').attr('value'), $("#ctrlnapgameemailaddress").val())
                    });
                }
            } else {//case has login                
                $('#napgamepreviewmodal').modal('hide');
                $.ajax({
                    url: "/user/PaymentNapGameHasLogin",
                    type: 'POST',
                    data: { account: $('#ctrltaikhoangame').val(), provider: $('#NapGameCardType').val(), amount: $('#NapGameAmount').attr('value'), email: $("#ctrlnapgameemailaddress").val() },
                    dataType: 'json',
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (obj) {
                        $('#napgameshowresultmodal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        if (obj.Success == true) {
                            $('#tblcardinfo').hide();
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-success');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Nạp tiền thành công! ');
                            sodutaikhoan();
                        } else {
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text(obj.msg);
                            $('#tblcardinfo').hide();
                        }
                    },
                    error: function (obj) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    },
                    complete: function () {
                        $("#boxLoading").hide();
                    }
                });
            }


        });
    }

    self.validateloginnapgame = function () {
        var flag = true;

        var uemail = $('#ctrlnapgameemailtxt_log').val();
        if ($.trim(uemail) == '') {
            $($('#ctrlnapgameemailtxt_log')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlnapgameemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($.trim(uemail) != '') {
            if (!Common.IsValidEmail(uemail)) {
                $($('#ctrlnapgameemailtxt_log')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlnapgameemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        var pass = $('#ctrlnapthepasstxt_log').val();
        if ($.trim(pass) == '') {
            $($('#ctrlnapthepasstxt_log')).tooltip('hide').attr('title', 'Hãy nhập mật khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlnapthepasstxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }


    self.Loginnapgame = function (email, password, callback) {
        $.ajax({
            type: "POST",
            url: "/user/login",
            data: { email: email, password: password },
            dataType: 'json',
            success: function (msg) {
                if (msg.Success == true) {
                    $('#napgamepreviewmodal').modal('hide');
                    if (callback) callback();
                }
                else {
                    $('#divnotifyng span').text('Nhập sai tên đăng nhập hoặc mật khẩu');
                    $('#divnotifyng').show();
                }
            },
            error: function (msg) {
            }
        });
    }
    self.paymentnapgameusesbank = function (bankCode, account, providerId, amount, email) {
        $.ajax({
            url: "/user/PaymentNapGameUsesBank",
            type: 'POST',
            data: { bankCode: bankCode, account: account, providerId: providerId, amount: amount, email: email },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                $('#naptiendienthoairesultmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                if (obj.Success == true) {
                    if (obj.Signature == true) {
                        window.location.href = obj.data.UrlRedirect;
                    } else {
                        $('#tblcardinfo').hide();
                        $('.divresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Lỗi giao dịch: ');
                        if (obj.data) {
                            $('#notifyresult span').text(obj.data.Message + ' ' + obj.data.RspCode);
                            $('#naptiendienthoaipreviewmodal').modal('toggle');
                        } else {
                            $('#notifyresult span').text(obj.msg);
                            $('#naptiendienthoaipreviewmodal').modal('toggle');
                        }

                    }
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Error! ');
                    $('#tblcardinfo').hide();
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }

    //function buy card not login
    self.napgamenotsigin = function (email, password, account, provider, amount, email) {
        $.ajax({
            url: "/user/PaymentNapGameNotLogin",
            type: 'POST',
            data: { UserName: email, password: password, account: account, provider: provider, amount: amount, email: email },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                if (obj.Success == true) {
                    $('#tblcardinfo').hide();
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-success');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Nạp thẻ thành công! ');
                    sodutaikhoan();
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text(obj.msg);
                    $('#tblcardinfo').hide();
                    $(location).attr('href', '/');
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
        $('#napgamepreviewmodal').modal('hide');
    }
    //function load card type follow provider
    self.NapGameloadAllCardType = function (PrividerId) {
        $.ajax({
            url: "/user/NapGameListCardTypeByProviderId",
            type: 'get',
            data: { PrividerId: PrividerId },
            dataType: 'json',
            //beforeSend: function () {
            //    $("#boxLoading").show();
            //},
            success: function (obj) {
                if (obj.Success == true) {
                    var strHTML = "<table style='width: 100%;' rel=" + PrividerId + "><tbody><tr><td>";
                    for (var i = 0; i < obj.data.length; i++) {
                        strHTML += "<input class='left' name='NapGameAmountSelect' id='NapGameAmountSelect_" + obj.data[i].Id + "' rel='NapGameAmount' value='" + obj.data[i].Amount + "' txt=" + obj.data[i].CardName + " type='radio'>";
                        strHTML += "<label class='left' for='NapGameAmountSelect_" + obj.data[i].Id + "'>" + obj.data[i].CardName + "</label>";
                        strHTML += "<div style='clear:both;'></div><span class='separator'></span>";
                    }
                    strHTML += "</td></tr></tbody></table>";
                    $("#table_NapGameAmount").html(strHTML);

                    //Select item                   
                    $('.boxdrpmega input[name="NapGameAmountSelect"]').each(function () {
                        $(this).change(function () {
                            radioButtonChecked($(this));
                            $('#NapGameAmount').removeClass('errorClass');
                            $($('#NapGameAmount')).tooltip('hide').attr('data-original-title', '')

                        });
                    });
                }
            },
            error: function (obj) {
                alert('lỗi khi load mệnh giá thẻ!');
            },
            complete: function () {
                //$("#boxLoading").hide();
            }
        });
    }

    self.validatenapthegame = function () {
        var flag = true;

        var taikhoangame = $('#ctrltaikhoangame').val();
        if ($.trim(taikhoangame) == '') {
            $($('#ctrltaikhoangame')).tooltip('hide').attr('title', 'Nhập tài khoản game').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrltaikhoangame').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var provi = $('#NapGameCardType').val();
        if ($.trim(provi) == '') {
            $($('#NapGameCardType')).tooltip('hide').attr('title', 'Chọn nhà cung cấp').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#NapGameCardType').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var cardamount = $('#NapGameAmount').val();
        if ($.trim(cardamount) == '') {
            $($('#NapGameAmount')).tooltip('hide').attr('title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#NapGameAmount').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var email = $('#ctrlnapgameemailaddress').val();
        if ($.trim(email) == '') {
            $($('#ctrlnapgameemailaddress')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlnapgameemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim(email) != '') {
            if (!Common.IsValidEmail(email)) {
                $($('#ctrlnapgameemailaddress')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlnapgameemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        return flag;
    }
}
function NapTheViettel() {
    var self = this;
    self.init_naptheviettel = function () {
        $.ajax({
            url: "/user/CheckIfSessionValid",
            type: "POST",
            success: function (result) {
                if (result.Success == true) {
                    $('#ctrlmatheviettel').attr('readonly', false);
                    $('#ctrlserialviettel').attr('readonly', false);
                    $('#notifylogin1').hide();
                } else {
                    $('#ctrlmatheviettel').attr('readonly', true);
                    $('#ctrlserialviettel').attr('readonly', true);
                    $('#notifylogin1').show();
                }
            }
        });
        //event textbox nhap tai khoan game
        $('#ctrlmatheviettel').keyup(function () {
            if ($('#ctrlmatheviettel').val() != '') {
                $($('#ctrlmatheviettel')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        //event textbox email in nap thien game
        $('#ctrlserialviettel').keyup(function () {
            if ($('#ctrlserialviettel').val() != '') {
                $($('#ctrlserialviettel')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });
        //self.NapGameloadAllCardType($('#ViettelCardTypeSelect').val());
        var strHTML = "<td>";
        strHTML += '<p><input id="ViettelCardTypeSelect_VTT" name="ViettelCardTypeSelect" rel="ViettelCardType" value="1" txt="Viettel 15%" gate="" type="radio" class="left">&nbsp;<label class="left mL5" for="ViettelCardTypeSelect_VTT">Viettel 15%</label><span class="separator"></span></p>';
        strHTML += "</td>";
        $("#trnapviettel_type").html();//strHTML

        //Select provider
        //$('.boxdrpmega input[name="ViettelCardTypeSelect"]').each(function () {
        //    $(this).change(function () {
        //        radioButtonChecked($(this));
        //        $('#ViettelCardType').removeClass('errorClass');
        //        $($('#ViettelCardType')).tooltip('hide').attr('data-original-title', '');
        //        self.NapGameloadAllCardType($(this).val());
        //    });
        //});

        self.NapGameloadAllCardType(1);
        //event chọn phương thức thanh toán
        //$('.boxdrpmega input[name="ViettelAmount"]').each(function () {
        //    $(this).change(function () {
        //        radioButtonChecked($(this));
        //        $($('#ViettelAmount')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        //    });
        //});

        //Event click button nap the game        


        //event btn thanhtoan nap game in modal preview click

    }

    $('#ctrlnapviettelbtn').on("click", function () {
        if (self.validatenaptheviettel()) {
            $("#lblprovider_viettel").text($('#ViettelCardType').val());
            $("#lblpinumberviettel").text($('#ctrlmatheviettel').val());
            $("#lblserinumberviettel").text($('#ctrlserialviettel').val());
            var amount1 = 10000;
            var cardamount = $('#ViettelAmount').val();
            if ($.trim(cardamount) != '') {
                amount1 = $('#ViettelAmount').val();
            }
            $.ajax({
                url: "/CardCharge/CardCharge_gachtheVT",
                type: 'POST',
                data: { providerId: $('#ViettelCardType').attr('value'), Mathe: $('#ctrlmatheviettel').val(), Serial: $('#ctrlserialviettel').val(), amount: amount1 },
                dataType: 'json',
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (obj) {
                    $('#gachtheshowresultmodal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    $('#notifyresultvt').show();
                    if (obj.Success == true) {
                        if (obj.data.status == 1) {
                            $("#notifyresultvt").addClass('alert-success');
                            $('#notifyresultvt i').addClass('fa-check');
                            $('#notifyresultvt strong').text('Giao dịch đang chờ xử lý: ');
                            $('#notifyresultvt span').text(obj.data.message);
                            //if ((obj.data.status == -10) && (obj.data.status == 4)) {
                            //    $('#notifyresult span').text('Thẻ không chính xác' + ' - lỗi: ' + obj.data.status);
                            //} else if (obj.data.status == 50) {
                            //    $('#notifyresult span').text('Thẻ không tồn tại hoặc đã được sử dụng' + ' - lỗi: ' + obj.data.status);
                            //} else if ((obj.data.status == 11) && (obj.data.status == -11)) {
                            //    $('#notifyresult span').text('Nhà mạng bảo trì, vui lòng thực hiện sau' + ' - lỗi: ' + obj.data.status);
                            //} else if (obj.data.status == 59) {
                            //    $('#notifyresult span').text('Thẻ không được kích hoạt' + ' - lỗi: ' + obj.data.status);
                            //} else {
                            //    $('#notifyresult span').text('Có lỗi xảy ra trong quá trình nạp thẻ.' + ' - lỗi: ' + obj.data.status);
                            //}
                        } else {
                            $("#notifyresultvt").addClass('alert-warning');
                            $('#notifyresultvt i').addClass('fa-times-circle');
                            $('#notifyresultvt strong').text('Lỗi giao dịch! ');
                            $('#notifyresultvt span').text(obj.data.message + '- Lỗi: ' + obj.data.status);

                            // $('#tblcardinfo').show(); 
                            //sodutaikhoan();
                            //location.reload(true); cap nhat lại tiền cho khách
                            //$("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                            //$("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                            //$("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                            //$("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                        }
                    } else {

                        $("#notifyresultvt").addClass('alert-warning');
                        $('#notifyresultvt i').addClass('fa-times-circle');
                        $('#notifyresultvt strong').text('Có lỗi xảy ra! ');
                        $('#notifyresultvt span').text("");

                    }
                },
                error: function (obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                },
                complete: function () {
                    $("#boxLoading").hide();
                }
            });
        }
    });
    //function load card type follow provider
    self.NapGameloadAllCardType = function (PrividerId) {
        $.ajax({
            url: "/user/NapGameListCardTypeByProviderId",
            type: 'get',
            data: { PrividerId: PrividerId },
            dataType: 'json',
            //beforeSend: function () {
            //    $("#boxLoading").show();
            //},
            success: function (obj) {
                if (obj.Success == true) {
                    var strHTML = "<table style='width: 100%;' rel=" + PrividerId + "><tbody><tr><td>";
                    for (var i = 0; i < obj.data.length; i++) {
                        strHTML += "<input class='left' name='ViettelAmountSelect' id='ViettelAmountSelect_" + obj.data[i].Id + "' rel='ViettelAmount' value='" + obj.data[i].Amount + "' txt=" + obj.data[i].CardName + " type='radio'>";
                        strHTML += "<label class='left' for='ViettelAmountSelect_" + obj.data[i].Id + "'>" + obj.data[i].CardName + "</label>";
                        strHTML += "<div style='clear:both;'></div><span class='separator'></span>";
                    }
                    strHTML += "</td></tr></tbody></table>";
                    $("#table_ViettelAmount").html(strHTML);

                    //Select item                   
                    $('.boxdrpmega input[name="ViettelAmountSelect"]').each(function () {
                        $(this).change(function () {
                            radioButtonChecked($(this));
                            $('#ViettelAmount').removeClass('errorClass');
                            $($('#ViettelAmount')).tooltip('hide').attr('data-original-title', '')

                        });
                    });
                }
            },
            error: function (obj) {
                alert('lỗi khi load mệnh giá thẻ!');
            },
            complete: function () {
                //$("#boxLoading").hide();
            }
        });
    }

    self.validatenaptheviettel = function () {
        var flag = true;

        var taikhoangame = $('#ctrlmatheviettel').val();
        if ($.trim(taikhoangame) == '') {
            $($('#ctrlmatheviettel')).tooltip('hide').attr('title', 'Nhập mã thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlmatheviettel').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        //var provi = $('#ViettelCardType').val();
        //if ($.trim(provi) == '') {
        //    $($('#ViettelCardType')).tooltip('hide').attr('title', 'Chọn nhà cung cấp').tooltip('fixTitle').addClass('errorClass');
        //    flag = false;
        //} else {
        //    $('#ViettelCardType').data("title", "").removeClass("errorClass").tooltip("destroy");
        //}

        //var cardamount = $('#ViettelAmount').val();
        //if ($.trim(cardamount) == '') {
        //    $($('#ViettelAmount')).tooltip('hide').attr('title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
        //    flag = false;
        //} else {
        //    $('#ViettelAmount').data("title", "").removeClass("errorClass").tooltip("destroy");
        //}

        var email = $('#ctrlserialviettel').val();
        if ($.trim(email) == '') {
            $($('#ctrlserialviettel')).tooltip('hide').attr('data-original-title', 'Nhập serial').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlserialviettel').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }
}



//==============For mobile======================
//==============================================
//Mobile Mua mã thẻ điện thoại
function MobileBuyCard() {
    var self = this;
    self.init = function () {

        //event keypress in confirm preview buycard login
        $('#ctrlemailtxt_log').keyup(function () {
            if ($('#ctrlemailtxt_log').val() != '' && Common.IsValidEmail($('#ctrlemailtxt_log').val())) {
                $($('#ctrlemailtxt_log')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });
        $('#ctrlpasstxt_log').keyup(function () {
            if ($('#ctrlpasstxt_log').val() != '') {
                $($('#ctrlpasstxt_log')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });


        //check evet keyup
        $('#mobileproviderdrp').change(function () {
            if ($('#mobileproviderdrp').find(':selected').val() != "0") {
                $($('#mobileproviderdrp')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            } else
                $($('#mobileproviderdrp')).tooltip('hide').attr('data-original-title', 'Chọn mạng di động').tooltip('fixTitle').addClass('errorClass');
        });
        $('#ctrlmobilemenhgiadrp').change(function () {
            if ($('#ctrlmobilemenhgiadrp').find(':selected').val() != "0") {
                $($('#ctrlmobilemenhgiadrp')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            } else
                $($('#ctrlmobilemenhgiadrp')).tooltip('hide').attr('data-original-title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
        });
        $('#ctrlsoluongthe').keyup(function () {
            if ($('#ctrlsoluongthe').val() != '') {
                $($('#ctrlsoluongthe')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });
        $('#ctrlemailaddress').keyup(function () {
            if ($('#ctrlemailaddress').val() != '' && Common.IsValidEmail($('#ctrlemailaddress').val())) {
                $($('#ctrlemailaddress')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });


        //event click mua the
        $('#ctrlmobilemuathebtn').on("click", function () {
            if (self.validatebuycard()) {
                //pass prameter and show modal confirm
                //$("#lblprovider").text($('#mobileproviderdrp').find(':selected').text());
                //$("#lblcardtype").text($('#ctrlmobilemenhgiadrp').find(':selected').text());
                var _pro = $('#mobileproviderdrp').find(':selected').text();// $("#mobileproviderdrp").text();
                var _card_type = $("#ctrlmobilemenhgiadrp").val();

                $("#lblprovider").text(_pro);
                $("#lblcardtype").text(_card_type);

                $("#lblsoluongthe").text($('#ctrlsoluongthe').val());
                $("#lblemail").text($('#ctrlemailaddress').val());
                $.ajax({
                    url: "/user/CheckIfSessionValid",
                    type: "POST",
                    success: function (result) {
                        if (result.Success == false) {
                            $("#Confirm_OrderDetail").show();
                        }
                        else
                            $("#Confirm_OrderDetail").hide();
                    }
                });

                $('#buycardpreviewmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#divnotifybc span').text('');
                $('#divnotifybc').hide();
                $('#ctrlemailtxt_log').val('');
                $('#ctrlpasstxt_log').val('');
            }
        });


        //event btn thanhtoan in modal preview click
        $('#ctrthanhtoanbtn').on("click", function () {
            var isVisible = $('#Confirm_OrderDetail').is(':visible');

            if (isVisible) { //Case not login
                if (self.validateloginbuycard()) {//check valid login
                    self.Loginbuycard($('#ctrl_popup_mobile_emailtxt_log').val(), $('#ctrlpasstxt_log').val(), function () {//login calback
                        self.buycardnotsigin($('#ctrl_popup_mobile_emailtxt_log').val(), $('#ctrlpasstxt_log').val(), $('#mobileproviderdrp').val(), $("#ctrlmobilemenhgiadrp").val(), $('#ctrlghichumuathe').val())
                    });
                }
            }
            else {//case has login                
                $('#buycardpreviewmodal').modal('hide');

                $.ajax({
                    url: "/user/PaymentBuyCardHasLogin",
                    type: 'POST',
                    data: { providerId: $('#mobileproviderdrp').find(':selected').val(), amount: $('#ctrlmobilemenhgiadrp').find(':selected').val(), quantity: $("#ctrlsoluongthe").val(), password2: $("#ctrlghichumuathe").val() },
                    dataType: 'json',
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (obj) {
                        $('#buycardshowresultmodal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        if (obj.Success == true) {
                            if (obj.data.errorCode != 00) {
                                $('#buycardtblcardinfo').hide();
                                $('.divresult').hide();
                                $("#notifyresult").addClass('alert-warning');
                                $('#notifyresult i').addClass('fa-times-circle');
                                $('#notifyresult strong').text('Lỗi giao dịch: ');
                                $('#notifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                            } else {
                                $("#notifyresult").addClass('alert-success');
                                $('#notifyresult i').addClass('fa-check');
                                $('#notifyresult strong').text('Thành công ');
                                $('#notifyresult span').text("Quý khách vui lòng kiểm tra email để lấy thông tin thẻ cào");
                                var rspListCard = jQuery.parseJSON(obj.data.listCards);
                                for (var i = 0; i < rspListCard.length; i++) {
                                    $('#buycardtblcardinfo tbody').append('<tr><td class="text-center">' + rspListCard[i].ProviderCode + '</td><td class="text-center">' + rspListCard[i].Amount + '</td><td class="text-center">' + "'" + rspListCard[i].PinCode + '</td><td class="text-center">' + "'" + rspListCard[i].Serial + '</td></tr>');
                                }
                                $('#buycardtblcardinfo').hide();
                                var currentdate = new Date();
                                var hours = new Date().getHours();
                                var hours = (hours + 24 - 2) % 24;
                                var mid = 'am';
                                if (hours == 0) {
                                    hours = 12;
                                }
                                else if (hours > 12) {
                                    hours = hours % 12;
                                    mid = 'pm';
                                }
                                var datetime = "Now: " + currentdate.getDate() + "/"
                                            + (currentdate.getMonth() + 1) + "/"
                                            + currentdate.getFullYear() + " "
                                            + hours + ":"
                                            + currentdate.getMinutes() + ":"
                                            + currentdate.getSeconds() + " " + mid;

                                $(".datetransaction").text(datetime);
                                $('.divresult').show();
                            }
                        } else {
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Có lỗi xảy ra! ');
                            $('#buycardtblcardinfo').hide();
                        }
                    },
                    error: function (obj) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    },
                    complete: function () {
                        $("#boxLoading").hide();
                    }
                });
            }


        });
        $('#xuatexel').on("click", function () {
            var str = document.getElementById('buycardtblcardinfo').outerHTML;//$('.buycarddivresult').html();//tableExport({ type: 'excel', escape: 'false' });
            var excelFile = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:" + "excel" + "' xmlns='http://www.w3.org/TR/REC-html40'>";
            excelFile += "<meta http-equiv='content-type' content='application/vnd.ms-excel; charset=UTF-8'>";
            excelFile += "<head>";
            excelFile += "<!--[if gte mso 9]>";
            excelFile += "<xml>";
            excelFile += "<x:ExcelWorkbook>";
            excelFile += "<x:ExcelWorksheets>";
            excelFile += "<x:ExcelWorksheet>";
            excelFile += "<x:Name>";
            excelFile += "{worksheet}";
            excelFile += "</x:Name>";
            excelFile += "<x:WorksheetOptions>";
            excelFile += "<x:DisplayGridlines/>";
            excelFile += "</x:WorksheetOptions>";
            excelFile += "</x:ExcelWorksheet>";
            excelFile += "</x:ExcelWorksheets>";
            excelFile += "</x:ExcelWorkbook>";
            excelFile += "</xml>";
            excelFile += "<![endif]-->";
            excelFile += "</head>";
            excelFile += "<body>";
            excelFile += str;
            excelFile += "</body>";
            excelFile += "</html>";
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(excelFile),'xls');
        });
        /*var ctrhtml = '<option value="0">Chọn mạng di động</option><option value="1">Viettel(2%)</option><option value="2">Mobifone(2.5%)</option><option value="3">Vinaphone(2.8%)</option><option value="5">FPT Gate(1.8%)</option><option value="7">Vietnammobile(3%)</option><option value="12">ZING(1.8%)</option><option value="13">VTC(1.8%)</option><option value="14">Garenal(1.8%)</option>';
        var cbboxmf = $('#mobileproviderdrp');
        $(cbboxmf).empty();
        //var opt = $('<option value="0">Chọn mạng di động</option>');
        $(cbboxmf).append(ctrhtml);*/

        //load  menh giá  event provider change show menh giá        
        $('#mobileproviderdrp').on('change', function () {
            var cbbomenhgia = $('#ctrlmobilemenhgiadrp');
            $(cbbomenhgia).empty();
            var opt = $('<option  value="0">Chọn mệnh giá thẻ</option>');
            $(cbbomenhgia).append(opt);
            $.ajax({
                url: '/user/GetListCardTypeByProviderId',
                data: { PrividerId: this.value },
                type: "get",
                success: function (obj) {
                    if (obj.Success == true) {
                        for (var i = 0; i < obj.data.length; i++) {
                            opt = $('<option></option>');
                            $(cbbomenhgia).append(opt);
                            $(opt).val(obj.data[i].Amount);
                            $(opt).text(obj.data[i].CardName);
                        }
                    }
                }
            });
        });

    };
    self.loadprovider = function () {
        var ctrhtml = '<option value="0">Chọn mạng di động</option><option value="1">Viettel(4.1%)</option><option value="2">Mobifone(4.5%)</option><option value="3">Vinaphone(4.5%)</option><option value="7">Vietnammobile(4%)</option>';
        var cbboxmf = $('#mobileproviderdrp');
        $(cbboxmf).empty();
        //var opt = $('<option value="0">Chọn mạng di động</option>');
        $(cbboxmf).append(ctrhtml);

    };
    self.loadprovider1 = function () {
        var ctrhtml = '<option value="0">Chọn mạng di động</option><option value="5">FPT Gate(4.5%)</option><option value="12">ZING(4.5%)</option><option value="13">VTC(4%)</option><option value="14">Garenal(4%)</option><option value="16">Data Mobi(8.5%)</option>';
        var cbboxmf = $('#mobileproviderdrp');
        $(cbboxmf).empty();
        //var opt = $('<option value="0">Chọn mạng di động</option>');
        $(cbboxmf).append(ctrhtml);

    }

    //Function login buy card
    self.Loginbuycard = function (email, password, callback) {
        $.ajax({
            type: "POST",
            url: "/user/login",
            data: { email: email, password: password },
            dataType: 'json',
            success: function (msg) {
                if (msg.Success == true) {
                    $('#buycardpreviewmodal').modal('hide');
                    if (callback) callback();
                }
                else {
                    $('#divnotifybc span').text('Nhập sai tên đăng nhập hoặc mật khẩu');
                    $('#divnotifybc').show();
                }
            },
            error: function (msg) {
            }
        });
    }

    //function buy card not login
    self.buycardnotsigin = function (email, password, providerid, amount, mailadd) {
        $.ajax({
            url: "/user/PaymentBuyCardNotLogin",
            type: 'POST',
            data: { UserName: email, password: password, providerId: providerid, amount: amount, quantity: $("#ctrlsoluongthe").val(), password2: mailadd },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                if (obj.Success == true) {
                    if (obj.data.errorCode != 00) {
                        $('#tblcardinfo').hide();
                        $('.divresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Lỗi giao dịch: ');
                        $('#notifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                    } else {
                        $("#notifyresult").addClass('alert-success');
                        $('#notifyresult i').addClass('fa-check');
                        $('#notifyresult strong').text('Thành công ');
                        $('#notifyresult span').text("Quý khách vui lòng kiểm tra email để lấy thông tin thẻ cào");
                        $('#tblcardinfo').show();
                        //var rsp = obj.data.listCards.split('|');

                        var rspListCard = jQuery.parseJSON(obj.data.listCards);

                        $("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                        $("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                        $("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                        $("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();

                        var currentdate = new Date();
                        var hours = new Date().getHours();
                        var hours = (hours + 24 - 2) % 24;
                        var mid = 'am';
                        if (hours == 0) {
                            hours = 12;
                        }
                        else if (hours > 12) {
                            hours = hours % 12;
                            mid = 'pm';
                        }
                        var datetime = "Now: " + currentdate.getDate() + "/"
                                    + (currentdate.getMonth() + 1) + "/"
                                    + currentdate.getFullYear() + " "
                                    + hours + ":"
                                    + currentdate.getMinutes() + ":"
                                    + currentdate.getSeconds() + " " + mid;

                        $(".datetransaction").text(datetime);
                    }
                    //$(location).attr('href', '/');
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Có lỗi xảy ra! ');
                    $('#tblcardinfo').hide();
                    $(location).attr('href', '/');
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }

    //function buy card select bank method
    self.paymentbuycardusesbank = function (bankCode, providerId, email, amount, quantity) {
        $.ajax({
            url: "/user/PaymentBuyCardUsesBank",
            type: 'POST',
            data: { bankCode: bankCode, providerId: providerId, email: email, amount: amount, quantity: quantity },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                $('#buycardshowresultmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                if (obj.Success == true) {
                    if (obj.Signature == true) {
                        window.location.href = obj.data.UrlRedirect;
                    } else {
                        $('#tblcardinfo').hide();
                        $('.divresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Lỗi giao dịch: ');
                        $('#notifyresult span').text(obj.data.Message + ' ' + obj.data.RspCode);
                    }
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Có lỗi xảy ra! ');
                    $('#tblcardinfo').hide();
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }

    //function check valid buy card
    self.validatebuycard = function () {
        var flag = true;

        if ($('#mobileproviderdrp').find(':selected').val() == "0") {
            $($('#mobileproviderdrp')).tooltip('hide').attr('data-original-title', 'Chọn mạng di động').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#mobileproviderdrp').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($('#ctrlmobilemenhgiadrp').find(':selected').val() == "0") {
            $($('#ctrlmobilemenhgiadrp')).tooltip('hide').attr('data-original-title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlmobilemenhgiadrp').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($('#ctrlghichumuathe').val() == '') {
            $($('#ctrlghichumuathe')).tooltip('hide').attr('data-original-title', 'Nhập mật khẩu cấp 2').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlghichumuathe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        var slthe = $('#ctrlsoluongthe').val();
        if ($.trim(slthe) == '' || $.trim(slthe) == 0) {
            $($('#ctrlsoluongthe')).tooltip('hide').attr('title', 'Nhập số lượng thẻ cần mua').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlsoluongthe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        //var email = $('#ctrlemailaddress').val();
        //if ($.trim(email) == '') {
        //    $($('#ctrlemailaddress')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
        //    flag = false;
        //} else {
        //    $('#ctrlemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
        //}
        //if ($.trim(email) != '') {
        //    if (!Common.IsValidEmail(email)) {
        //        $($('#ctrlemailaddress')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
        //        flag = false;
        //    } else {
        //        $('#ctrlemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
        //    }
        //}


        return flag;
    }

    //check valid login
    self.validateloginbuycard = function () {
        var flag = true;

        var uemail = $('#ctrlemailtxt_log').val();
        if ($.trim(uemail) == '') {
            $($('#ctrlemailtxt_log')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($.trim(uemail) != '') {
            if (!Common.IsValidEmail(uemail)) {
                $($('#ctrlemailtxt_log')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        var pass = $('#ctrlpasstxt_log').val();
        if ($.trim(pass) == '') {
            $($('#ctrlpasstxt_log')).tooltip('hide').attr('title', 'Hãy nhập mật khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlpasstxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }

}

//Mobile Doi the
function MobileDoiThe() {
    var self = this;
    self.init = function () {
        //check evet keyup
        $('#mobileproviderdrp_doithe').change(function () {
            if ($('#mobileproviderdrp_doithe').find(':selected').val() != "0") {
                $($('#mobileproviderdrp_doithe')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            } else
                $($('#mobileproviderdrp_doithe')).tooltip('hide').attr('data-original-title', 'Chọn mạng di động').tooltip('fixTitle').addClass('errorClass');
        });

        $('#ctrlPinNumbertxt_doithe').keyup(function () {
            if ($('#ctrlPinNumbertxt_doithe').val() != '') {
                $($('#ctrlPinNumbertxt_doithe')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        $('#ctrlSeriNumbertxt_doithe').keyup(function () {
            if ($('#ctrlSeriNumbertxt_doithe').val() != '') {
                $($('#ctrlSeriNumbertxt_doithe')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        //Check User Login
        $.ajax({
            url: "/user/CheckIfSessionValid",
            type: "POST",
            success: function (result) {
                if (result.Success == true) {
                    $('#ctrlPinNumbertxt_doithe').attr('readonly', false);
                    $('#ctrlSeriNumbertxt_doithe').attr('readonly', false);
                    $('#notifylogin').hide();
                } else {
                    $('#ctrlPinNumbertxt_doithe').attr('readonly', true);
                    $('#ctrlSeriNumbertxt_doithe').attr('readonly', true);
                    $('#notifylogin').show();
                }
            }
        });

        //function load all provier
        var ctrhtml = '<option value="0">Chọn mạng di động</option><option value="1">Viettel (28.5%)</option><option value="2">Mobifone (28%)</option><option value="3">Vinaphone (28%)</option><option value="5">FPT Gate (21%)</option><option value="7">Vietnamobile (22%)</option><option value="13">VTC (21.75%)</option><option value="15">BIT (19.0%)</option>';
        var cbboxmf = $('#mobileproviderdrp_doithe');
        $(cbboxmf).empty();
        //var opt = $('<option value="0">Chọn mạng di động</option>');<option value="8">OnGame (23.0%)</option><option value="12">ZING (22.0%)</option><option value="11">Megacard (14.0%)</option>
        $(cbboxmf).append(ctrhtml);
        //$.ajax({
        //    url: "/user/GetListProvider",
        //    type: 'get',
        //    data: {},
        //    dataType: 'json',
        //    success: function (obj) {
        //        if (obj.Success == true) {
        //            var cbboxmf = $('#mobileproviderdrp_doithe');
        //            $(cbboxmf).empty();
        //            var opt = $('<option value="0">Chọn mạng di động</option>');
        //            $(cbboxmf).append(opt);
        //            if (obj.Success == true) {
        //                for (var i = 0; i < obj.data.length; i++) {
        //                    opt = $('<option></option>');
        //                    $(cbboxmf).append(opt);
        //                    $(opt).val(obj.data[i].Id);
        //                    $(opt).text(obj.data[i].Name);
        //                }
        //            }
        //        }
        //    },
        //    error: function (obj) {
        //        alert("Error " + obj)
        //    }
        //});

        $('#ctrldoithebtn').on("click", function () {
            if (self.validate_gachthe_mobile()) {
                $("#lblprovider_gachthe").text($('#mobileproviderdrp_doithe').find(':selected').text());
                $("#lblpinumber").text($('#ctrlPinNumbertxt_doithe').val());
                $("#lblserinumber").text($('#ctrlSeriNumbertxt_doithe').val());

                $.ajax({
                    url: "/CardCharge/CardCharge_gachthe",
                    type: 'POST',
                    data: { providerId: $('#mobileproviderdrp_doithe').find(':selected').val(), Mathe: $('#ctrlPinNumbertxt_doithe').val(), Serial: $('#ctrlSeriNumbertxt_doithe').val() },
                    dataType: 'json',
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (obj) {
                        $('#gachtheshowresultmodal_mobile').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                        if (obj.Success == true) {
                            if (obj.data.status != 1) {
                                $('.divresult').hide();
                                $("#notifyresult").addClass('alert-warning');
                                $('#notifyresult i').addClass('fa-times-circle');
                                $('#notifyresult strong').text('Lỗi giao dịch: ');
                                $('#notifyresult span').text(obj.data.message + ' ' + obj.data.status);
                            } else {
                                $('#tblcardinfo').hide();
                                $('.divresult').hide();
                                $("#notifyresult").addClass('alert-success');
                                $('#notifyresult i').addClass('fa-times-circle');
                                //$('#notifyresult strong').text('Đổi thẻ thành công! bạn đã được cộng: ' + obj.data.DRemainAmount + ' đ vào tài khoản!');
                                $('#notifyresult strong').text('Quý khách đã nạp thành công thẻ có Serial:' + obj.data.SSerialNumber + ', mệnh giá: ' + obj.data.DRemainAmount);
                                //$("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                                //$("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                                //$("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                                //$("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                                sodutaikhoan();
                            }
                        } else {
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Có lỗi xảy ra! ');
                        }
                    },
                    error: function (obj) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    },
                    complete: function () {
                        $("#boxLoading").hide();
                    }
                });
            }
        });
    }

    //check valid gachthe
    self.validate_gachthe_mobile = function () {
        var flag = true;

        if ($('#mobileproviderdrp_doithe').find(':selected').val() == "0") {
            $($('#mobileproviderdrp_doithe')).tooltip('hide').attr('data-original-title', 'Chọn mạng di động').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#mobileproviderdrp_doithe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }


        var pinumber = $('#ctrlPinNumbertxt_doithe').val();
        if ($.trim(pinumber) == '') {
            $($('#ctrlPinNumbertxt_doithe')).tooltip('hide').attr('title', 'Hãy nhập mã thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlPinNumbertxt_doithe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var serinumber = $('#ctrlSeriNumbertxt_doithe').val();
        if ($.trim(serinumber) == '') {
            $($('#ctrlSeriNumbertxt_doithe')).tooltip('hide').attr('title', 'Hãy nhập số serial thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlSeriNumbertxt_doithe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }
}

//Mobile nap tien game
function MobileNapTienGame() {
    var self = this;
    self.init = function () {
        $('#ctrltaikhoangame_napgame').keyup(function () {
            if ($('#ctrltaikhoangame_napgame').val() != '') {
                $($('#ctrltaikhoangame_napgame')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        //check evet keyup
        $('#mobileproviderdrp_napgame').change(function () {
            if ($('#mobileproviderdrp_napgame').find(':selected').val() != "0") {
                $($('#mobileproviderdrp_napgame')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            } else
                $($('#mobileproviderdrp_napgame')).tooltip('hide').attr('data-original-title', 'Chọn mạng di động').tooltip('fixTitle').addClass('errorClass');
        });

        //check evet keyup
        $('#ctrlmobilemenhgiadrp_napgame').change(function () {
            if ($('#ctrlmobilemenhgiadrp_napgame').find(':selected').val() != "0") {
                $($('#ctrlmobilemenhgiadrp_napgame')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            } else
                $($('#ctrlmobilemenhgiadrp_napgame')).tooltip('hide').attr('data-original-title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
        });

        $('#ctrlnapgameemailaddress_napgame').keyup(function () {
            if ($('#ctrlnapgameemailaddress_napgame').val() != '' && Common.IsValidEmail($('#ctrlnapgameemailaddress_napgame').val())) {
                $($('#ctrlnapgameemailaddress_napgame')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        var ctrhtml = '<option value="0">Chọn mạng di động</option><option value="1">Viettel (3.05%)</option><option value="2">Mobifone (3.25%)</option><option value="3">Vinaphone (3.25%)</option><option value="5">FPT Gate (3.65%)</option><option value="7">Vietnamobile (3.5%)</option><option value="8">OnGame (4.35%)</option><option value="11">Megacard (4.35%)</option>';
        var cbboxmf = $('#mobileproviderdrp_napgame');
        $(cbboxmf).empty();
        //var opt = $('<option value="0">Chọn mạng di động</option>');
        $(cbboxmf).append(ctrhtml);
        //function load all provier
        //$.ajax({
        //    url: "/user/GetListProvider",
        //    type: 'get',
        //    data: {},
        //    dataType: 'json',
        //    success: function (obj) {
        //        if (obj.Success == true) {
        //            var cbboxmf = $('#mobileproviderdrp_napgame');
        //            $(cbboxmf).empty();
        //            var opt = $('<option value="0">Chọn mạng di động</option>');
        //            $(cbboxmf).append(opt);
        //            if (obj.Success == true) {
        //                for (var i = 0; i < obj.data.length; i++) {
        //                    opt = $('<option></option>');
        //                    $(cbboxmf).append(opt);
        //                    $(opt).val(obj.data[i].Id);
        //                    $(opt).text(obj.data[i].Name);
        //                }
        //            }
        //        }
        //    },
        //    error: function (obj) {
        //        alert("Error " + obj)
        //    }
        //});

        //load  menh giá  event provider change show menh giá        
        $('#mobileproviderdrp_napgame').on('change', function () {
            var cbbomenhgia = $('#ctrlmobilemenhgiadrp_napgame');
            $(cbbomenhgia).empty();
            var opt = $('<option  value="0">Chọn mệnh giá thẻ</option>');
            $(cbbomenhgia).append(opt);
            $.ajax({
                url: '/user/GetListCardTypeByProviderId',
                data: { PrividerId: this.value },
                type: "get",
                success: function (obj) {
                    if (obj.Success == true) {
                        for (var i = 0; i < obj.data.length; i++) {
                            opt = $('<option></option>');
                            $(cbbomenhgia).append(opt);
                            $(opt).val(obj.data[i].Amount);
                            $(opt).text(obj.data[i].CardName);
                        }
                    }
                }
            });
        });

        //Event click button nap the game        
        $('#ctrlnaptiengamebtn_napgame').on("click", function () {
            if (self.validatenapthegame_mobile()) {
                //pass prameter and show modal confirm
                $("#lbltaikhoangame").text($('#ctrltaikhoangame_napgame').val());
                $("#lblnapgameprovider").text($('#mobileproviderdrp_napgame').find(':selected').text());
                $("#lblnapgamecardtype").text($('#ctrlmobilemenhgiadrp_napgame').find(':selected').text());
                $("#lblnapgameemail").text($('#ctrlnapgameemailaddress_napgame').val());
                $.ajax({
                    url: "/user/CheckIfSessionValid",
                    type: "POST",
                    success: function (result) {
                        if (result.Success == false) {
                            $("#Confirm_OrderNapGameDetail").show();
                        }
                        else
                            $("#Confirm_OrderNapGameDetail").hide();
                    }
                });

                $('#napgamepreviewmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#divnotifybc span').text('');
                $('#divnotifybc').hide();
                $('#ctrlemailtxt_log').val('');
                $('#ctrlpasstxt_log').val('');
            }
        });

        //event btn thanhtoan nap game in modal preview click
        $('#ctrnapgamethanhtoanbtn').on("click", function () {
            var isVisible = $('#Topup_Confirm_OrderDetail').is(':visible');
            if (isVisible) { //Case not login
                //XXX
                if (self.validatelogintopup()) {//check valid login
                    self.Logintopup($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), function () {//login calback
                        self.topupnotsigin($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), $('#ctrlSoDienThoai').attr('value'), $('#topupAmount').attr('value'), $('#ctrlnapdienthoaiemailaddress').val())
                    });
                }
            } else {//case has login                
                $('#naptiendienthoaipreviewmodal').modal('hide');
                $.ajax({
                    url: "/user/PaymentTopupMobileHasLogin",
                    type: 'POST',
                    data: { sodienthoai: $('#ctrlSoDienThoai').val(), amount: $('#topupAmount').attr('value'), email: $("#ctrlemailaddress").val(), mailnhan: $("#ctrlemailaddress").val() },
                    dataType: 'json',
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (obj) {
                        $('#naptiendienthoairesultmodal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        if (obj.Success == true) {
                            $('#tblcardinfo').hide();
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-success');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Giao dịch chờ xử lý! ');
                            //cập nhật tài khoản 
                            sodutaikhoan();
                            //$("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                            //$("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                            //$("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                            //$("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                        } else {
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Lỗi giao dịch nạp thẻ! ');
                            $('#tblcardinfo').hide();
                        }
                    },
                    error: function (obj) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    },
                    complete: function () {
                        $("#boxLoading").hide();
                    }
                });
            }
        });
    }

    self.validatenapthegame_mobile = function () {
        var flag = true;

        var taikhoangame = $('#ctrltaikhoangame_napgame').val();
        if ($.trim(taikhoangame) == '') {
            $($('#ctrltaikhoangame_napgame')).tooltip('hide').attr('title', 'Nhập tài khoản game').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrltaikhoangame_napgame').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($('#mobileproviderdrp_napgame').find(':selected').val() == "0") {
            $($('#mobileproviderdrp_napgame')).tooltip('hide').attr('data-original-title', 'Chọn mạng di động').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#mobileproviderdrp_napgame').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($('#ctrlmobilemenhgiadrp_napgame').find(':selected').val() == "0") {
            $($('#ctrlmobilemenhgiadrp_napgame')).tooltip('hide').attr('data-original-title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlmobilemenhgiadrp_napgame').data("title", "").removeClass("errorClass").tooltip("destroy");
        }


        var email = $('#ctrlnapgameemailaddress_napgame').val();
        if ($.trim(email) == '') {
            $($('#ctrlnapgameemailaddress_napgame')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlnapgameemailaddress_napgame').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim(email) != '') {
            if (!Common.IsValidEmail(email)) {
                $($('#ctrlnapgameemailaddress_napgame')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlnapgameemailaddress_napgame').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        return flag;
    }

}

//Mobile nap tien dien thoai
function MobileNapTienDienThoai() {
    var self = this;
    self.init = function () {
        $('#ctrlSoDienThoai_naptiendt').keyup(function () {
            if ($('#ctrlSoDienThoai_naptiendt').val() != '') {
                $($('#ctrlSoDienThoai_naptiendt')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        //check evet keyup
        $('#mobilemanhgiathe_naptiendt').change(function () {
            if ($('#mobilemanhgiathe_naptiendt').find(':selected').val() != "0") {
                $($('#mobilemanhgiathe_naptiendt')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            } else
                $($('#mobilemanhgiathe_naptiendt')).tooltip('hide').attr('data-original-title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
        });

        $('#ctrlnapdienthoaiemailaddress_naptiendt').keyup(function () {
            if ($('#ctrlnapdienthoaiemailaddress_naptiendt').val() != '' && Common.IsValidEmail($('#ctrlnapdienthoaiemailaddress_naptiendt').val())) {
                $($('#ctrlnapdienthoaiemailaddress_naptiendt')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });



        //load menh giá thẻ nạp
        $.ajax({
            url: '/user/GetListCardTypeByProviderId',
            data: { PrividerId: 1 },
            type: "get",
            success: function (obj) {
                if (obj.Success == true) {
                    var cbboxmf = $('#mobilemanhgiathe_naptiendt');
                    $(cbboxmf).empty();
                    var opt = $('<option value="0">Chọn mệnh giá thẻ nạp</option>');
                    $(cbboxmf).append(opt);
                    if (obj.Success == true) {
                        for (var i = 0; i < obj.data.length; i++) {
                            opt = $('<option></option>');
                            $(cbboxmf).append(opt);
                            $(opt).val(obj.data[i].Amount);
                            $(opt).text(obj.data[i].CardName);
                        }
                    }
                }
            },
            error: function (obj) {
                alert("Error " + obj)
            }
        });

        $('#ctrlnaptiendienthoaibtn_naptiendt').on("click", function () {
            if (self.validatenaptiendienthoai_mobile()) {
                var sodienthoai = $('#ctrlSoDienThoai_naptiendt').val();
                //Code new
                if (sodienthoai != '') {
                    $("#lblphone").text($('#ctrlSoDienThoai_naptiendt').val());

                    $("#lblmenhgia").text($('#mobilemanhgiathe_naptiendt').find(':selected').text());
                    $("#lbltopupemail").text($('#ctrlnapdienthoaiemailaddress_naptiendt').val());
                    $.ajax({
                        url: "/user/CheckIfSessionValid",
                        type: "POST",
                        success: function (result) {
                            if (result.Success == false) {
                                $("#Confirm_OrderDetail").show();
                            }
                            else
                                $("#Confirm_OrderDetail").hide();
                        }
                    });
                    $('#naptiendienthoaipreviewmodal').modal({
                        backdrop: 'static',
                        keyboard: false

                    });
                }
                else {
                    alert('Mời nhập số điện thoại!');
                }


            }
        });

        //event btn thanhtoan in modal preview click
        $('#ctrthanhtoanbtn_mobile').on("click", function () {
            var isVisible = $('#Confirm_OrderDetail').is(':visible');

            if (isVisible) { //Case not login
                //XXX
                if (self.validateloginndt()) {//check valid login
                    self.Logintopup_mobile($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), function () {//login calback
                        self.topupnotsigin($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), $('#ctrlSoDienThoai_naptiendt').val(), $('#mobilemanhgiathe_naptiendt').find(':selected').val(), $('#topupghichumuathe').val())
                    });
                }
            } else {//case has login                
                $('#naptiendienthoaipreviewmodal').modal('hide');
                $.ajax({
                    url: "/user/PaymentTopupMobileHasLogin",
                    type: 'POST',
                    data: { sodienthoai: $('#ctrlSoDienThoai_naptiendt').val(), amount: $('#mobilemanhgiathe_naptiendt').find(':selected').val(), email: $("#ctrlnapdienthoaiemailaddress_naptiendt").val(), password2: $("#topupghichumuathe").val() },
                    dataType: 'json',
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (obj) {
                        $('#naptiendienthoairesultmodal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        if (obj.Success == true) {
                            $('#tblcardinfo').hide();
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-success');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Giao dịch chờ xử lý! ');
                            // cap nhat tai khoan
                            //$("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                            //$("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                            //$("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                            //$("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();

                            sodutaikhoan();
                        } else {
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Lỗi giao dịch nạp thẻ! ');
                            $('#tblcardinfo').hide();
                        }
                    },
                    error: function (obj) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    },
                    complete: function () {
                        $("#boxLoading").hide();
                    }
                });
            }

        });
    }

    //Function login
    self.Logintopup_mobile = function (email, password, callback) {
        $.ajax({
            type: "POST",
            url: "/user/login",
            data: { email: email, password: password },
            dataType: 'json',
            success: function (msg) {
                if (msg.Success == true) {
                    $('#naptiendienthoaipreviewmodal').modal('hide');
                    if (callback) callback();
                }
                else {
                    $('#divnotifybc span').text('Nhập sai tên đăng nhập hoặc mật khẩu');
                    $('#divnotifybc').show();
                }
            },
            error: function (msg) {
            }
        });
    }

    // not login
    self.topupnotsigin = function (email, password, sodienthoai, amount, mailadd) {
        $.ajax({
            url: "/user/PaymentTopupMobileNotLogin",
            type: 'POST',
            data: { UserName: email, password: password, sodienthoai: sodienthoai, amount: amount, mailnhanmathe: mailadd },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                if (obj.Success == true) {
                    $('#tblcardinfo').hide();
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-success');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Nạp thẻ thành công! ');
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Lỗi giao dịch nạp thẻ! ');
                    $('#tblcardinfo').hide();
                    $(location).attr('href', '/');
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }

    self.paymenttopupusesbank = function (bankCode, sodienthoai, amount, email) {
        $.ajax({
            url: "/user/PaymentTopupMobileUsesBank",
            type: 'POST',
            data: { bankCode: bankCode, sodienthoai: sodienthoai, amount: amount, email: email },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                $('#naptiendienthoairesultmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                if (obj.Success == true) {
                    if (obj.Signature == true) {
                        window.location.href = obj.data.UrlRedirect;
                    } else {
                        $('#tblcardinfo').hide();
                        $('.divresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Lỗi giao dịch: ');
                        if (obj.data) {
                            $('#notifyresult span').text(obj.data.Message + ' ' + obj.data.RspCode);
                        } else {
                            $('#notifyresult span').text(obj.Message);
                        }

                    }
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text('Error! ');
                    $('#tblcardinfo').hide();
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }

    self.validatenaptiendienthoai_mobile = function () {
        var flag = true;

        var sodienthoai = $('#ctrlSoDienThoai_naptiendt').val();
        if ($.trim(sodienthoai) == '') {
            $($('#ctrlSoDienThoai_naptiendt')).tooltip('hide').attr('title', 'Nhập số điện thoại').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlSoDienThoai_naptiendt').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($('#mobilemanhgiathe_naptiendt').find(':selected').val() == "0") {
            $($('#mobilemanhgiathe_naptiendt')).tooltip('hide').attr('data-original-title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#mobilemanhgiathe_naptiendt').data("title", "").removeClass("errorClass").tooltip("destroy");
        }


        var email = $('#ctrlnapdienthoaiemailaddress_naptiendt').val();
        if ($.trim(email) == '') {
            $($('#ctrlnapdienthoaiemailaddress_naptiendt')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlnapdienthoaiemailaddress_naptiendt').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim(email) != '') {
            if (!Common.IsValidEmail(email)) {
                $($('#ctrlnapdienthoaiemailaddress_naptiendt')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlnapdienthoaiemailaddress_naptiendt').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }



        return flag;
    }

    self.validateloginndt = function () {
        var flag = true;

        var uemail = $('#ctrlemailtxt_log').val();
        if ($.trim(uemail) == '') {
            $($('#ctrlemailtxt_log')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($.trim(uemail) != '') {
            if (!Common.IsValidEmail(uemail)) {
                $($('#ctrlemailtxt_log')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        var pass = $('#ctrlpasstxt_log').val();
        if ($.trim(pass) == '') {
            $($('#ctrlpasstxt_log')).tooltip('hide').attr('title', 'Hãy nhập mật khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlpasstxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }
}
//===============================================
//=========== for mobile end======================




//Lịch sử giao dịch
function HistoryTransaction() {
    var self = this;

    //init date picker for search transaction
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var fdate = $('#ctrlfromdatetxt').datepicker({
        format: 'dd/mm/yyyy'
        //onRender: function (date) {
        //    return date.valueOf() < now.valueOf() ? 'disabled' : '';
        //}
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > tdate.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            tdate.setValue(newDate);
        }
        fdate.hide();
        $('#ctrltodatetxt')[0].focus();
    }).data('datepicker');
    var tdate = $('#ctrltodatetxt').datepicker({
        format: 'dd/mm/yyyy'
    }).on('changeDate', function (ev) {
        tdate.hide();
    }).data('datepicker');



    var gridtrans = $("#gridTransaction").grid({
        dataSource: { url: "/user/GetAllChargeForUsers" },
        uiLibrary: "bootstrap",
        notFoundText: "Bạn không có giao dịch nào",
        columns: [
            { field: "Trace", width: 100, sortable: true, title: "Mã GD" },
            { field: "Type", width: 150, sortable: true, title: "Loại giao dịch" },
            { field: "Status", width: 150, sortable: true, title: "Trạng thái" },
            { field: "StrAmount", width: 100, sortable: true, title: "Mệnh giá" },
             { field: "StrPrice", width: 100, sortable: true, title: "Thành tiền" },
             { field: "StrCurrentBalance", width: 100, sortable: true, title: "Số dư" },
            { field: "Description", sortable: true, title: "Chi tiết" },
            { field: "CreateDate", width: 200, sortable: true, title: "Thời gian" }
        ],
        pager: { enable: true, limit: 20, sizes: [20, 50, 100] }
    });

    //gridtrans.on("cellDataBound", function (e, $wrapper, id, index, record) {       
    //});

    //event search button click in history transaction
    $('#ctrlsearchtransactionbtn').on("click", function () {
        var fromdate = $('#ctrlfromdatetxt').val();
        var todate = $('#ctrltodatetxt').val();
        //SUM
        $.ajax({
            url: '/user/GetCalculateAllChargeForUsers',
            data: { searchString: $("#search").val(), typeString: $("#ctrlLoaiGiaoDich").val(), statusString: $("#ctrltrangthai").val(), fromdate: fromdate, todate: todate },
            type: "get",
            success: function (obj) {
                if (obj.success == true) {
                    $("#idSumMoneyHistory").html(obj.tongtien);
                    $("#idSumMoneyActual").html(obj.thucnhan);
                }
            }
        });


        gridtrans.reload({ searchString: $("#search").val(), typeString: $("#ctrlLoaiGiaoDich").val(), statusString: $("#ctrltrangthai").val(), fromdate: fromdate, todate: todate });
    });
}
// lịch sử đổi thẻ
function HistoryDoithe() {
    var self = this;

    //init date picker for search transaction
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var fdate = $('#ctrlfromdatetxt').datepicker({
        format: 'dd/mm/yyyy'
        //onRender: function (date) {
        //    return date.valueOf() < now.valueOf() ? 'disabled' : '';
        //}
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > tdate.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            tdate.setValue(newDate);
        }
        fdate.hide();
        $('#ctrltodatetxt')[0].focus();
    }).data('datepicker');
    var tdate = $('#ctrltodatetxt').datepicker({
        format: 'dd/mm/yyyy'
    }).on('changeDate', function (ev) {
        tdate.hide();
    }).data('datepicker');



    var gridtrans = $("#griddoithe").grid({
        dataSource: { url: "/user/GetAllDoitheForUsers" },
        uiLibrary: "bootstrap",
        notFoundText: "Bạn không có giao dịch nào",
        columns: [
            //{ field: "Trace", width: 100, sortable: true, title: "Mã GD" },
            //{ field: "Type", width: 150, sortable: true, title: "Loại giao dịch" },
            { field: "Status", width: 150, sortable: true, title: "Trạng thái" },
            { field: "StrAmount", width: 100, sortable: true, title: "Mệnh giá" },
             { field: "StrPrice", width: 100, sortable: true, title: "Thành tiền" },
             //{ field: "StrCurrentBalance", width: 100, sortable: true, title: "Số dư" },
            { field: "Description", width: 200, sortable: true, title: "Chi tiết" },
            { field: "CreateDate", width: 200, sortable: true, title: "Thời gian" }
        ],
        pager: { enable: true, limit: 20, sizes: [20, 50, 100] }
    });

    //gridtrans.on("cellDataBound", function (e, $wrapper, id, index, record) {       
    //});

    //event search button click in history transaction
    $('#ctrlsearchdoithe').on("click", function () {
        var fromdate = $('#ctrlfromdatetxt').val();
        var todate = $('#ctrltodatetxt').val();
        //SUM
        $.ajax({
            url: '/user/SumAllDoitheForUsers',
            data: { searchString: $("#searchdoithe").val(), typeString: 4, statusString: $("#ctrltrangthaidoithe").val(), fromdate: fromdate, todate: todate },
            type: "get",
            success: function (obj) {
                if (obj.success == true) {
                    $("#idSumMoneyHistory").html(obj.sumamount);
                    $("#idSumMoneyActual").html(obj.sumprice);
                }
            }
        });


        gridtrans.reload({ searchString: $("#searchdoithe").val(), typeString: 4, statusString: $("#ctrltrangthaidoithe").val(), fromdate: fromdate, todate: todate });
    });
}
// Lịch sử mua thẻ
function HistoryMuathe() {
    var self = this;

    //init date picker for search transaction
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var fdate = $('#ctrlfromdatetxt').datepicker({
        format: 'dd/mm/yyyy'
        //onRender: function (date) {
        //    return date.valueOf() < now.valueOf() ? 'disabled' : '';
        //}
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > tdate.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            tdate.setValue(newDate);
        }
        fdate.hide();
        $('#ctrltodatetxt')[0].focus();
    }).data('datepicker');
    var tdate = $('#ctrltodatetxt').datepicker({
        format: 'dd/mm/yyyy'
    }).on('changeDate', function (ev) {
        tdate.hide();
    }).data('datepicker');



    var gridtrans = $("#gridmuathe").grid({
        dataSource: { url: "/user/GetAllMuatheForUsers" },
        uiLibrary: "bootstrap",
        notFoundText: "Bạn không có giao dịch nào",
        columns: [
            //{ field: "Trace", width: 100, sortable: true, title: "Mã GD" },
            //{ field: "Type", width: 150, sortable: true, title: "Loại giao dịch" },
            { field: "Status", width: 150, sortable: true, title: "Trạng thái" },
            { field: "StrAmount", width: 100, sortable: true, title: "Mệnh giá" },
             { field: "StrPrice", width: 100, sortable: true, title: "Thành tiền" },
            // { field: "StrCurrentBalance", width: 100, sortable: true, title: "Số dư" },
            { field: "Description", width: 200, sortable: true, title: "Chi tiết" },
            { field: "CreateDate", width: 200, sortable: true, title: "Thời gian" }
        ],
        pager: { enable: true, limit: 20, sizes: [20, 50, 100] }
    });

    //gridtrans.on("cellDataBound", function (e, $wrapper, id, index, record) {       
    //});

    //event search button click in history transaction
    $('#ctrlsearchmuathe').on("click", function () {
        var fromdate = $('#ctrlfromdatetxt').val();
        var todate = $('#ctrltodatetxt').val();
        //SUM
        $.ajax({
            url: '/user/SumMuatheForUsers',
            data: { searchString: $("#searchmuathe").val(), typeString: 2, statusString: $("#ctrltrangthaimuathe").val(), fromdate: fromdate, todate: todate },
            type: "get",
            success: function (obj) {
                if (obj.success == true) {
                    $("#idSumMoneyHistory").html(obj.tongtien);
                    $("#idSumMoneyActual").html(obj.thucnhan);
                }
            }
        });


        gridtrans.reload({ searchString: $("#searchmuathe").val(), typeString: 2, statusString: $("#ctrltrangthaimuathe").val(), fromdate: fromdate, todate: todate });
    });
}
// Lịch sử nạp tiền điện thoại
function HistoryNaptiendt() {
    var self = this;

    //init date picker for search transaction
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var fdate = $('#ctrlfromdatetxt').datepicker({
        format: 'dd/mm/yyyy'
        //onRender: function (date) {
        //    return date.valueOf() < now.valueOf() ? 'disabled' : '';
        //}
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > tdate.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            tdate.setValue(newDate);
        }
        fdate.hide();
        $('#ctrltodatetxt')[0].focus();
    }).data('datepicker');
    var tdate = $('#ctrltodatetxt').datepicker({
        format: 'dd/mm/yyyy'
    }).on('changeDate', function (ev) {
        tdate.hide();
    }).data('datepicker');



    var gridtrans = $("#gridnaptiendt").grid({
        dataSource: { url: "/user/GetAllNaptienDTForUsers" },
        uiLibrary: "bootstrap",
        notFoundText: "Bạn không có giao dịch nào",
        columns: [
            //{ field: "Trace", width: 100, sortable: true, title: "Mã GD" },
            //{ field: "Type", width: 150, sortable: true, title: "Loại giao dịch" },
            { field: "Status", width: 150, sortable: true, title: "Trạng thái" },
            { field: "StrAmount", width: 100, sortable: true, title: "Mệnh giá" },
             { field: "StrPrice", width: 100, sortable: true, title: "Thành tiền" },
             //{ field: "StrCurrentBalance", width: 100, sortable: true, title: "Số dư" },
            { field: "Description", width: 200, sortable: true, title: "Chi tiết" },
            { field: "CreateDate", width: 200, sortable: true, title: "Thời gian" }
        ],
        pager: { enable: true, limit: 20, sizes: [20, 50, 100] }
    });

    //gridtrans.on("cellDataBound", function (e, $wrapper, id, index, record) {       
    //});

    //event search button click in history transaction
    $('#ctrlsearchnaptiendt').on("click", function () {
        var fromdate = $('#ctrlfromdatetxt').val();
        var todate = $('#ctrltodatetxt').val();
        //SUM
        $.ajax({
            url: '/user/SumNaptienDTForUsers',
            data: { searchString: $("#searchnaptiendt").val(), typeString: 1, statusString: $("#ctrltrangthainaptiendt").val(), fromdate: fromdate, todate: todate },
            type: "get",
            success: function (obj) {
                if (obj.success == true) {
                    $("#idSumMoneyHistory").html(obj.tongtien);
                    $("#idSumMoneyActual").html(obj.thucnhan);
                }
            }
        });


        gridtrans.reload({ searchString: $("#searchnaptiendt").val(), typeString: 1, statusString: $("#ctrltrangthainaptiendt").val(), fromdate: fromdate, todate: todate });
    });
}
// Lịch sử api
function LichSuDoitheAPI() {
    var self = this;

    self.initHistoryDoitheAPI = function () {
        self.HistoryDoitheAPITable();
        self.TinhTienAPI();
        self.HistoryDoiTheAPIFunction();
    }

    // Hàm chức năng
    self.HistoryDoiTheAPIFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $("#ctrlsearchdoitheapi").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuDoiTheAPI");
            self.TinhTienAPI();
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.HistoryDoitheAPITable = function () {
        //Load Email: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblLichSuDoiTheAPI').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                {
                    "name": "searchString",
                    "value": $("#searchdoitheapi").val()
                },
                {
                    "name": "telcoCode",
                    "value": $("#cboLoaiTheLichSuAPI option").filter(":selected").val()
                },
                {
                    "name": "fromDate",
                    "value": $("#ctrlfromdatetxt").val()
                },
                {
                    "name": "toDate",
                    "value": $("#ctrltodatetxt").val()
                },
                {
                    "name": "typeString",
                    "value": 4
                },
                {
                    "name": "statusString",
                    "value": $("#ctrltrangthaidoithe").val()
                }
                )
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            //"sDom": 'it<pl>',
            "dom": '<l>Brtp', "buttons": ['excelFlash'],
            "sAjaxSource": '/user/LichSuDoiTheAPI',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Serial" },
            { "mData": "CardCode" },
            { "mData": "TelcoCode" },
            { "mData": "StrAmount" },
            { "mData": "StrPrice" },
            { "mData": "StrCurrentBalance" },
            { "mData": "Status" },
            { "mData": "CreateDate" },
            ],
            "order": [7, 'desc'],
            "oLanguage": {
                "sProcessing": "Đang xử lý",
                "sLengthMenu": "_MENU_ ",
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
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Tính tiền
    self.TinhTienAPI = function () {
        $.ajax({
            url: Config.AppUrl + 'user/LichSuDoiTheAPI',
            type: 'GET',
            data: {
                searchString: $("#searchdoitheapi").val(), telcoCode: $("#cboLoaiTheLichSuAPI option").filter(":selected").val(),
                fromDate: $("#ctrlfromdatetxt").val(), toDate: $("#ctrltodatetxt").val(),
                typeString: 4, statusString: $("#ctrltrangthaidoithe").val()
            },
            success: function (data) {
                $("#idSumMoneyHistory").html(data.sumamount);
                $("#idSumMoneyActual").html(data.sumprice);
            }
        });
    }
}
// Kết thúc lịch sử api
// Lịch sử mua thẻ
function LichSuMuaThe() {
    var self = this;

    self.initLichSuMuaThe = function () {
        self.LichSuMuaTheTable();
        self.LichSuMuaTheFunction();
    }

    // Hàm chức năng
    self.LichSuMuaTheFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $("#ctrlsearchmuathe").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuMuaThe");
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.LichSuMuaTheTable = function () {
        var dTable = $('#tblLichSuMuaThe').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                {
                    "name": "searchString",
                    "value": $("#searchmuathe").val()
                },
                {
                    "name": "telcoCode",
                    "value": $("#cboLichSuMuaThe option").filter(":selected").val()
                },
                {
                    "name": "fromDate",
                    "value": $("#ctrlfromdatetxt").val()
                },
                {
                    "name": "toDate",
                    "value": $("#ctrltodatetxt").val()
                },
                {
                    "name": "typeString",
                    "value": 2
                },
                {
                    "name": "statusString",
                    "value": -1
                }
                )
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtp', "buttons": ['excelFlash'],
            "sAjaxSource": '/user/_LichSuMuaThe',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Serial" },
            { "mData": "StrAmount" },
            { "mData": "TelcoCode" },
            { "mData": "CreateDate" }
            ],
            "order": [3, 'desc'],
            "oLanguage": {
                "sProcessing": "Đang xử lý",
                "sLengthMenu": "_MENU_ ",
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
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }
}
// Kết thúc lịch sử mua thẻ
// Lịch sử nạp tiền điện thoại
function LichSuNapTienDienThoai() {
    var self = this;

    self.initLichSuNapTienDienThoai = function () {
        self.LichSuNapTienDienThoaiTable();
        self.TinhTienLichSuNapTienDienThoai();
        self.LichSuNapTienDienThoaiFunction();
    }

    // Hàm chức năng
    self.LichSuNapTienDienThoaiFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $("#ctrlsearchnaptiendt").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuNapTienDienThoai");
            self.TinhTienLichSuNapTienDienThoai();
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.LichSuNapTienDienThoaiTable = function () {
        var dTable = $('#tblLichSuNapTienDienThoai').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                {
                    "name": "searchString",
                    "value": $("#searchnaptiendt").val()
                },
                {
                    "name": "fromDate",
                    "value": $("#ctrlfromdatetxt").val()
                },
                {
                    "name": "toDate",
                    "value": $("#ctrltodatetxt").val()
                },
                {
                    "name": "typeString",
                    "value": 1
                },
                {
                    "name": "statusString",
                    "value": $("#ctrltrangthainaptiendt").val()
                }
                )
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtp', "buttons": ['excelFlash'],
            "sAjaxSource": '/user/_LichSuNapTienDienThoai',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Phone" },
            { "mData": "StrAmount" },
            { "mData": "Status" },
            { "mData": "CreateDate" }
            ],
            "order": [3, 'desc'],
            "oLanguage": {
                "sProcessing": "Đang xử lý",
                "sLengthMenu": " _MENU_ ",
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
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Tính tiền nạp tiền điện thoại
    self.TinhTienLichSuNapTienDienThoai = function () {
        $.ajax({
            url: Config.AppUrl + 'user/_LichSuNapTienDienThoai',
            type: 'GET',
            data: {
                searchString: $("#searchnaptiendt").val(), typeString: 1, statusString: $("#ctrltrangthainaptiendt").val(), fromdate: $("#ctrlfromdatetxt").val(), todate: $("#ctrltodatetxt").val()
            },
            success: function (data) {
                $("#idSumMoneyHistory").html(data.tongTien);
            }
        });
    }

}
// Kết thúc lịch sử nạp tiền điện thoại
// Lịch sử rút tiền
function LichSuRuttien() {
    var self = this;

    self.initLichSuRuttien = function () {
        self.LichSuRuttienTable();
        self.TinhTienLichSuRuttien();
        self.LichSuRuttienFunction();
    }

    // Hàm chức năng
    self.LichSuRuttienFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $("#ctrlsearchrutien").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuRutTien");
            self.TinhTienLichSuRuttien();
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.LichSuRuttienTable = function () {
        //Load Email: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblLichSuRutTien').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                {
                    "name": "searchString",
                    "value": $("#searchrutien").val()
                },
                {
                    "name": "fromDate",
                    "value": $("#ctrlfromdatetxt").val()
                },
                {
                    "name": "toDate",
                    "value": $("#ctrltodatetxt").val()
                },
                {
                    "name": "statusString",
                    "value": $("#ctrltrangthairutien").val()
                }
                )
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtp', "buttons": ['excelFlash'],
            "sAjaxSource": '/user/LichSuRutTienNguoiDung',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "StrAmount" },
            { "mData": "BankCode" },
            { "mData": "strStatus" },
            { "mData": "StrCreateDate" }
            ],
            "order": [3, 'desc'],
            "oLanguage": {
                "sProcessing": "Đang xử lý",
                "sLengthMenu": " _MENU_ ",
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
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Tính tiền
    self.TinhTienLichSuRuttien = function () {
        $.ajax({
            url: Config.AppUrl + 'user/LichSuRutTienNguoiDung',
            type: 'GET',
            data: {
                searchString: $("#searchrutien").val(),
                fromDate: $("#ctrlfromdatetxt").val(), toDate: $("#ctrltodatetxt").val(), statusString: $("#ctrltrangthairutien").val()
            },
            success: function (data) {
                $("#idSumMoneyHistory").html(data.tongtien);
            }
        });
    }
}
// Kết thúc lịch sử rút tiền

// Lịch sử chuyển tiền
function LichSuChuyenTien() {
    var self = this;

    self.initLichSuChuyenTien = function () {
        self.LichSuChuyenTienTable();
        self.LichSuChuyenTienFunction();
    }

    // Hàm chức năng
    self.LichSuChuyenTienFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $("#ctrlsearchchuyentien").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuChuyenTien");
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.LichSuChuyenTienTable = function () {
        var dTable = $('#tblLichSuChuyenTien').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                {
                    "name": "fromDate",
                    "value": $("#ctrlfromdatetxt").val()
                },
                {
                    "name": "toDate",
                    "value": $("#ctrltodatetxt").val()
                },
                {
                    "name": "typeString",
                    "value": 7
                },
                {
                    "name": "statusString",
                    "value": -1
                }
                )
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtp', "buttons": ['excelFlash'],
            "sAjaxSource": '/user/_LichSuChuyenTien',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "StrAmount" },
            { "mData": "Email" },
            { "mData": "CreateDate" }
            ],
            "order": [2, 'desc'],
            "oLanguage": {
                "sProcessing": "Đang xử lý",
                "sLengthMenu": " _MENU_ ",
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
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }
}

// Lịch sử nhận tiền
function LichSuNhanTien() {
    var self = this;

    self.initLichSuNhanTien = function () {
        self.LichSuNhanTienTable();
        self.LichSuNhanTienFunction();
    }

    // Hàm chức năng
    self.LichSuNhanTienFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $("#ctrlsearchnhantien").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuNhanTien");
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.LichSuNhanTienTable = function () {
        var dTable = $('#tblLichSuNhanTien').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                {
                    "name": "fromDate",
                    "value": $("#ctrlfromdatetxt").val()
                },
                {
                    "name": "toDate",
                    "value": $("#ctrltodatetxt").val()
                },
                {
                    "name": "typeString",
                    "value": 8
                },
                {
                    "name": "statusString",
                    "value": -1
                }
                )
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtp', "buttons": ['excelFlash'],
            "sAjaxSource": '/user/_LichSuNhanTien',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "StrAmount" },
            { "mData": "Email" },
            { "mData": "CreateDate" }
            ],
            "order": [2, 'desc'],
            "oLanguage": {
                "sProcessing": "Đang xử lý",
                "sLengthMenu": " _MENU_ ",
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
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }
}
// Kết thúc lịch sử nhận tiền
// Lịch sử đổi thẻ
function LichSuDoithe() {
    var self = this;

    self.initHistoryDoithe = function () {
        self.HistoryDoiTheTable();
        self.TinhTien();
        self.HistoryDoiTheFunction();
    }

    // Hàm chức năng
    self.HistoryDoiTheFunction = function () {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $("#ctrlsearchdoithe").click(function () {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuDoiThe");
            self.TinhTien();
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load dữ liệu lên bảng sử dụng datatable 
    self.HistoryDoiTheTable = function () {
        //Load Email: lấy dữ liệu từ controller và đẩy dữ liệu vào bảng
        var dTable = $('#tblLichSuDoiThe').DataTable({
            "bDestroy": true,
            "fnServerParams": function (aoData) {
                aoData.push(
                {
                    "name": "searchString",
                    "value": $("#searchdoithe").val()
                },
                {
                    "name": "telcoCode",
                    "value": $("#cboLoaiTheLichSu option").filter(":selected").val()
                },
                {
                    "name": "fromDate",
                    "value": $("#ctrlfromdatetxt").val()
                },
                {
                    "name": "toDate",
                    "value": $("#ctrltodatetxt").val()
                },
                {
                    "name": "typeString",
                    "value": 4
                },
                {
                    "name": "statusString",
                    "value": $("#ctrltrangthaidoithe option").filter(":selected").val()
                }
                )
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtp', "buttons": ['excelFlash'],
            "sAjaxSource": '/user/LichSuDoiTheNguoiDung',
            "lengthMenu": [20, 50, 100, 200, 1000],
            "aoColumns": [
            { "mData": "Serial" },
            { "mData": "CardCode" },
            { "mData": "TelcoCode" },
            { "mData": "StrAmount" },
            { "mData": "StrPrice" },
            { "mData": "StrCurrentBalance" },
            { "mData": "Status" },
            { "mData": "CreateDate" },
            ],
            "order": [7, 'desc'],
            "oLanguage": {
                "sProcessing": "Đang xử lý",
                "sLengthMenu": "_MENU_  ",
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
    }

    // Phương thức tải lại dữ liệu lên table
    self.RefreshTableUser = function (tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Tính tiền
    self.TinhTien = function () {
        $.ajax({
            url: Config.AppUrl + 'user/LichSuDoiTheNguoiDung',
            type: 'GET',
            data: {
                searchString: $("#searchdoithe").val(), telcoCode: $("#cboLoaiTheLichSu option").filter(":selected").val(),
                fromDate: $("#ctrlfromdatetxt").val(), toDate: $("#ctrltodatetxt").val(),
                typeString: 4, statusString: -1
            },
            success: function (data) {
                $("#idSumMoneyHistory").html(data.tongtien);
                $("#idSumMoneyActual").html(data.thucnhan);
            }
        });
    }
}
// Kết thúc lịch sử đổi thẻ

// Lịch sử api
function HistoryDoitheAPI() {
    var self = this;

    //init date picker for search transaction
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var fdate = $('#ctrlfromdatetxt').datepicker({
        format: 'dd/mm/yyyy'
        //onRender: function (date) {
        //    return date.valueOf() < now.valueOf() ? 'disabled' : '';
        //}
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > tdate.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            tdate.setValue(newDate);
        }
        fdate.hide();
        $('#ctrltodatetxt')[0].focus();
    }).data('datepicker');
    var tdate = $('#ctrltodatetxt').datepicker({
        format: 'dd/mm/yyyy'
    }).on('changeDate', function (ev) {
        tdate.hide();
    }).data('datepicker');



    var gridtrans = $("#griddoitheapi").grid({
        dataSource: { url: "/user/GetAllAPIForUsers" },
        uiLibrary: "bootstrap",
        notFoundText: "Bạn không có giao dịch nào",
        columns: [
            //{ field: "Trace", width: 100, sortable: true, title: "Mã GD" },
            //{ field: "Type", width: 150, sortable: true, title: "Loại giao dịch" },
            { field: "Status", width: 150, sortable: true, title: "Trạng thái" },
            { field: "StrAmount", width: 100, sortable: true, title: "Mệnh giá" },
             { field: "StrPrice", width: 100, sortable: true, title: "Thành tiền" },
             //{ field: "StrCurrentBalance", width: 100, sortable: true, title: "Số dư" },
            { field: "Description", sortable: true, title: "Chi tiết" },
            { field: "CreateDate", width: 200, sortable: true, title: "Thời gian" }
        ],
        pager: { enable: true, limit: 20, sizes: [20, 50, 100] }
    });

    //gridtrans.on("cellDataBound", function (e, $wrapper, id, index, record) {       
    //});

    //event search button click in history transaction
    $('#ctrlsearchdoitheapi').on("click", function () {
        var fromdate = $('#ctrlfromdatetxt').val();
        var todate = $('#ctrltodatetxt').val();
        //SUM
        $.ajax({
            url: '/user/SumApiForUser',
            data: { searchString: $("#searchdoitheapi").val(), typeString: 4, statusString: $("#ctrltrangthaidoithe").val(), fromdate: fromdate, todate: todate },
            type: "get",
            success: function (obj) {
                if (obj.success == true) {
                    $("#idSumMoneyHistory").html(obj.sumamount);
                    $("#idSumMoneyActual").html(obj.sumprice);
                }
            }
        });


        gridtrans.reload({ searchString: $("#searchdoitheapi").val(), typeString: 4, statusString: $("#ctrltrangthaidoithe").val(), fromdate: fromdate, todate: todate });
    });
}
// Lịch sử rút tiền
function HistoryRuttien() {
    var self = this;

    //init date picker for search transaction
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var fdate = $('#ctrlfromdatetxt').datepicker({
        format: 'dd/mm/yyyy'
        //onRender: function (date) {
        //    return date.valueOf() < now.valueOf() ? 'disabled' : '';
        //}
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > tdate.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            tdate.setValue(newDate);
        }
        fdate.hide();
        $('#ctrltodatetxt')[0].focus();
    }).data('datepicker');
    var tdate = $('#ctrltodatetxt').datepicker({
        format: 'dd/mm/yyyy'
    }).on('changeDate', function (ev) {
        tdate.hide();
    }).data('datepicker');



    var gridtrans = $("#gridrutien").grid({
        dataSource: { url: "/user/GetAllRuttienForUsers" },
        uiLibrary: "bootstrap",
        notFoundText: "Bạn không có giao dịch nào",
        columns: [
            //{ field: "Trace", width: 100, sortable: true, title: "Mã GD" },
            //{ field: "Type", width: 150, sortable: true, title: "Loại giao dịch" },
            { field: "Status", width: 150, sortable: true, title: "Trạng thái" },
            { field: "StrAmount", width: 100, sortable: true, title: "Mệnh giá" },
             { field: "StrPrice", width: 100, sortable: true, title: "Thành tiền" },
             //{ field: "StrCurrentBalance", width: 100, sortable: true, title: "Số dư" },
            { field: "Description", width: 200, sortable: true, title: "Chi tiết" },
            { field: "CreateDate", width: 200, sortable: true, title: "Thời gian" }
        ],
        pager: { enable: true, limit: 20, sizes: [20, 50, 100] }
    });

    //gridtrans.on("cellDataBound", function (e, $wrapper, id, index, record) {       
    //});

    //event search button click in history transaction
    $('#ctrlsearchrutien').on("click", function () {
        var fromdate = $('#ctrlfromdatetxt').val();
        var todate = $('#ctrltodatetxt').val();
        //SUM
        $.ajax({
            url: '/user/SumRuttienForUsers',
            data: { searchString: $("#searchrutien").val(), typeString: 6, statusString: $("#ctrltrangthairutien").val(), fromdate: fromdate, todate: todate },
            type: "get",
            success: function (obj) {
                if (obj.success == true) {
                    $("#idSumMoneyHistory").html(obj.tongtien);
                    $("#idSumMoneyActual").html(obj.thucnhan);
                }
            }
        });


        gridtrans.reload({ searchString: $("#searchrutien").val(), typeString: 6, statusString: $("#ctrltrangthairutien").val(), fromdate: fromdate, todate: todate });
    });
}
function UserInfo() {
    var self = this;

    //event textbox keyup
    $('#ctrlemailtxt').keyup(function () {
        if ($('#ctrlemailtxt').val() != '' && Common.IsValidEmail($('#ctrlemailtxt').val())) {
            $($('#ctrlemailtxt')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });
    $('#ctrlhotentxt').keyup(function () {
        if ($('#ctrlhotentxt').val() != '') {
            $($('#ctrlhotentxt')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });
    $('#ctrlphonetxt').keyup(function () {
        if ($('#ctrlphonetxt').val() != '' && $('#ctrlphonetxt').val().length > 9) {
            $($('#ctrlphonetxt')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });


    //Event click Update user info
    $("#save_user_info").click(function () {
        if (self.validateUpdateUserInfo()) {
            var _userEntity =
             {
                 BankNumber: $('#_so_tk').val(),
                 BankAccount: $('#_chu_tk').val(),
                 BankCode: $("#_ngan_hang option:selected").val(),
                 BankBranch: $('#_chi_nhanh').val(),
                 Name: $('#_user_name').val(),
                 Address: $('#_diachi').val(),
                 Phone: $('#_dien_thoai').val()
             };
            var _data = JSON.stringify({ userEntity: _userEntity });
            $.ajax({
                url: "/user/UpdateUserInfo",
                type: 'POST',
                data: _data,
                dataType: 'json',
                contentType: "application/json; charset=utf-8",
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (obj) {
                    //alert('Cập nhật thành công!');
                    $("#boxLoading").hide();
                    if (obj.IsFaceBook) {
                        alert('Cập nhật thành công!');
                        window.location.href = "/";
                    } else {
                        window.location.href = "/user/comfirm";
                    }
                    //window.location.href = "/user/comfirm";
                },
                error: function (obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                }
            });
        }
    });


    self.Init_UserInfo = function () {
        $.ajax({
            url: "/user/CheckIfSessionValid",
            type: "POST",
            success: function (result) {
                if (result.Success == true) {
                    $('#ctrlemailaddress').val(result.email);

                    self.loaduserinfo();
                }
            }
        });
    }

    //Load user info
    self.loaduserinfo = function () {
        $.ajax({
            url: "/user/GetUserInfo",
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (obj) {

                if (obj.Success == true) {
                    $('#lblvipaycard').text(formatCurrency(obj.uinfo.Cash, ""));
                    $('#lblemail').text(obj.uinfo.Email);
                    $('#lblhoten').text(obj.uinfo.Name);


                    $('#_user_name').val(obj.uinfo.Name);
                    $('#_email').val(obj.uinfo.Email);
                    $('#_dien_thoai').val(obj.uinfo.Phone);
                    $('#_diachi').val(obj.uinfo.Address);

                    if (obj.uinfo.Address == '') {
                        $('#lbladdress').text("Chưa cập nhật");
                        $('#lbladdress').addClass('tred');
                    } else {
                        $('#lbladdress').text(obj.uinfo.Address);
                    }
                    $('#lblphone').text(obj.uinfo.Phone);
                    //-----
                    if (obj.uinfo.BankNumber == null || obj.uinfo.BankNumber == '') {
                        $('#lblsotaikhoan').text("Chưa cập nhật");
                        $('#lblsotaikhoan').addClass('tred');
                    } else {
                        $('#lblsotaikhoan').text(obj.uinfo.BankNumber);
                    }
                    if (obj.uinfo.BankAccount == null || obj.uinfo.BankAccount == '') {
                        $('#lblchutaikhoan').text("Chưa cập nhật");
                        $('#lblchutaikhoan').addClass('tred');
                    } else {
                        $('#lblchutaikhoan').text(obj.uinfo.BankAccount);
                    }
                    if (obj.uinfo.BankName == null || obj.uinfo.BankName == '') {
                        $('#lbltennganhang').text("Chưa cập nhật");
                        $('#lbltennganhang').addClass('tred');
                    } else {
                        $('#lbltennganhang').text(obj.uinfo.BankName);
                    }
                    if (obj.uinfo.BankBranch == null || obj.uinfo.BankBranch == '') {
                        $('#lblchinhanh').text("Chưa cập nhật");
                        $('#lblchinhanh').addClass('tred');
                    } else {
                        $('#lblchinhanh').text(obj.uinfo.BankBranch);
                    }


                } else {
                    //alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                }
            },
            error: function (obj) {
                //alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            }
        });
    }



    //Load user info
    self.load_user_info_for_edit = function () {
        $.ajax({
            url: "/user/GetUserInfo",
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (obj) {

                if (obj.Success == true) {
                    //user infor
                    $('#_user_name').val(obj.uinfo.Name);
                    $('#_email').val(obj.uinfo.Email);
                    $('#_dien_thoai').val(obj.uinfo.Phone);
                    $('#_diachi').val(obj.uinfo.Address);
                    //account infor
                    $('#_so_tk').val(obj.uinfo.BankNumber);
                    $('#_chu_tk').val(obj.uinfo.BankAccount);
                    $('#_ngan_hang').val(obj.uinfo.BankCode);
                    $('#_chi_nhanh').val(obj.uinfo.BankBranch);

                    if (obj.uinfo.Address == '') {
                        $('#lbladdress').text("Chưa cập nhật");
                        $('#lbladdress').addClass('tred');
                    } else {
                        $('#lbladdress').text(obj.uinfo.Address);
                    }
                }
                else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            }
        });

    }




    self.init_edituseraccount = function () {
        //load user account
        $.ajax({
            url: "/user/GetUserInfo",
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (obj) {
                if (obj.Success == true) {
                    $('#ctrlemailtxt').val(obj.uinfo.Email);
                    $('#ctrlhotentxt').val(obj.uinfo.Name);
                    $('#ctrladdresstxt').val(obj.uinfo.Address);
                    $('#ctrlphonetxt').val(obj.uinfo.Phone);

                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            }
        });

        //Event click Update user account
        $("#ctrlupdateuseraccountbtn").click(function () {
            if (self.validateUpdateUserInfo()) {
                var _userEntity = {
                    Name: $('#ctrlhotentxt').val(),
                    Address: $('#ctrladdresstxt').val(),
                    Phone: $('#ctrlphonetxt').val()
                };
                var _data = JSON.stringify({ userEntity: _userEntity });
                $.ajax({
                    url: "/user/UpdateUserInfo",
                    type: 'POST',
                    data: _data,
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (obj) {
                        //alert('Cập nhật thành công!');
                        $("#boxLoading").hide();
                        if (obj.IsFaceBook) {
                            alert('Cập nhật thành công!');
                            window.location.href = "/";
                        } else {
                            window.location.href = "/user/comfirm";
                        }

                    },
                    error: function (obj) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    }
                });
            }
        });
    }

    self.init_edituserbank = function () {
        $.ajax({
            url: "/user/GetUserInfo",
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (obj) {
                if (obj.Success == true) {
                    $('#ctrlbanknumtxt').val(obj.uinfo.BankNumber);
                    $('#ctrlbankaccounttxt').val(obj.uinfo.BankAccount);
                    $('#ctrlbanknamedrp').val(obj.uinfo.BankCode);
                    $('#ctrlbankbranchtxt').val(obj.uinfo.BankBranch);

                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                }
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            }
        });

        //Event click Update user bank
        $("#ctrlupdatebankaccountbtn").click(function () {
            if (self.validateUpdateUserBank()) {
                var _userEntity = {
                    BankNumber: $('#ctrlbanknumtxt').val(),
                    BankAccount: $('#ctrlbankaccounttxt').val(),
                    BankCode: $("#ctrlbanknamedrp option:selected").val(),
                    BankBranch: $('#ctrlbankbranchtxt').val()
                };
                var _data = JSON.stringify({ userEntity: _userEntity });
                $.ajax({
                    url: "/user/UpdateUserInfo",
                    type: 'POST',
                    data: _data,
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (obj) {
                        //alert('Cập nhật thành công!');
                        $("#boxLoading").hide();
                        if (obj.IsFaceBook) {
                            alert('Cập nhật thành công!');
                            window.location.href = "/";
                        } else {
                            window.location.href = "/user/comfirm";
                        }
                        //window.location.href = "/user/comfirm";
                    },
                    error: function (obj) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    }
                });
            }
        });
    }

    //function check valid user account
    self.validateUpdateUserInfo = function () {
        var flag = true;

        var uhoten = $('#ctrlhotentxt').val();
        if ($.trim(uhoten) == '') {
            $($('#ctrlhotentxt')).tooltip('hide').attr('title', 'Bạn không thể để trống họ tên.').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlhotentxt').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var udienthoai = $('#ctrlphonetxt').val();
        if ($.trim(udienthoai) == '') {
            $($('#ctrlphonetxt')).tooltip('hide').attr('title', 'Bạn cần điền số điện thoại.').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlphonetxt').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }
    //function check valid user Bank
    self.validateUpdateUserBank = function () {
        var flag = true;

        var bnum = $('#ctrlbanknumtxt').val();
        if ($.trim(bnum) == '') {
            $($('#ctrlbanknumtxt')).tooltip('hide').attr('title', 'Hãy nhập số tài khoản.').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlbanknumtxt').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var bacc = $('#ctrlbankaccounttxt').val();
        if ($.trim(bacc) == '') {
            $($('#ctrlbankaccounttxt')).tooltip('hide').attr('title', 'Hãy nhập tên chủ tài khoản.').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlbankaccounttxt').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($('#ctrlbanknamedrp').find(':selected').val() == '0') {
            $($('#ctrlbanknamedrp')).tooltip('hide').attr('data-original-title', 'Hãy chọn ngân hàng').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlbanknamedrp').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }

    //function check valid user Bank
    self.validateUpdateUserInfo = function () {
        var flag = true;

        var bnum = $('#_user_name').val();
        if ($.trim(bnum) == '') {
            $($('#_user_name')).tooltip('hide').attr('title', 'Hãy nhập số tài khoản.').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }
        else {
            $('#_user_name').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var bacc = $('#_email').val();
        if ($.trim(bacc) == '') {
            $($('#_email')).tooltip('hide').attr('title', 'Hãy nhập tên chủ tài khoản.').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }
        else {
            $('#_email').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var bacc = $('#_dien_thoai').val();
        if ($.trim(bacc) == '') {
            $($('#_dien_thoai')).tooltip('hide').attr('title', 'Hãy nhập tên chủ tài khoản.').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }
        else {
            $('#_dien_thoai').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var bacc = $('#_diachi').val();
        if ($.trim(bacc) == '') {
            $($('#_diachi')).tooltip('hide').attr('title', 'Hãy nhập tên chủ tài khoản.').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }
        else {
            $('#_diachi').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var bacc = $('#_so_tk').val();
        if ($.trim(bacc) == '') {
            $($('#_so_tk')).tooltip('hide').attr('title', 'Hãy nhập tên chủ tài khoản.').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }
        else {
            $('#_so_tk').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var bacc = $('#_chu_tk').val();
        if ($.trim(bacc) == '') {
            $($('#_chu_tk')).tooltip('hide').attr('title', 'Hãy nhập tên chủ tài khoản.').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }
        else {
            $('#_chu_tk').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        if ($('#_ngan_hang').find(':selected').val() == '0') {
            $($('#_ngan_hang')).tooltip('hide').attr('data-original-title', 'Hãy chọn ngân hàng').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }
        else {
            $('#_ngan_hang').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($('#_chi_nhanh').val() == '') {
            $($('#_chi_nhanh')).tooltip('hide').attr('data-original-title', 'Hãy chọn ngân hàng').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }
        else {
            $('#_chi_nhanh').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }

}

function TaoSoNgauNhien(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}
var TCoin = function () {
    var t = this;
    var randomint = 0;
    var index = 0;
    t.init = function () {
        var e = new Date;
        new Date(e.getFullYear(), e.getMonth(), e.getDate(), 0, 0, 0, 0), $("#txtTransferDate").datepicker({
            format: "dd.mm.yyyy"
        }).data("datepicker");
        $.ajax({
            url: "/News/Checknganhang",
            type: "POST",
            data: { bankcode: "" },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show()
            },
            success: function (result) {
                if (result.Success == true) {
                    var rspListCard = result.data;
                    var tgindex = parseInt(rspListCard.ToBankCode);
                    $("#ddlReceiveBank").val(rspListCard.ToBankCode);
                    $("#ddlReceiveBank").attr("disabled", "true");
                    $(".bankInfo").show();
                    $(".bo" + rspListCard.ToBankNumber).show();
                    var index1 = tgindex - 1;
                    $(".bo" + rspListCard.ToBankNumber + " .infoBank:eq(" + index1 + ")").show()
                } else {

                    //$("#ddlReceiveBank").val('2');
                    //0 != $("#ddlReceiveBank").find(":selected").val() ? ($($("#ddlReceiveBank")).tooltip("hide").attr("data-original-title", "").removeClass("errorClass"),index = parseInt($(this).val()) - 1,index >= 0 ? ($(".infoBank").hide(),$(".infoBank:eq(" + index + ")").show(), $(".bankInfo").show()) : ($(".infoBank").hide(), $(".bankInfo").hide())) : $($("#ddlReceiveBank")).tooltip("hide").attr("data-original-title", "Hãy chọn ngân hàng nhận tiền").tooltip("fixTitle").addClass("errorClass")
                }
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại sau!")
            },
            complete: function () {
                $("#boxLoading").hide()
            }
        })
        $("#ddlReceiveBank").on("change", function () {
            var bankcode = parseInt($("#ddlReceiveBank").find(":selected").val());
            var codebank = "";
            switch (bankcode) {
                case 1:
                    codebank = "Vietcombank";
                    break;
                case 2:
                    codebank = "Techcombank";
                    break;
                case 3:
                    codebank = "Viettinbank";
                    break;
                case 4:
                    codebank = "Agribank";
                    break;
                case 5:
                    codebank = "Tienphongbank";
                    break;

            }
            var tg = $("#ddlReceiveBank").find(":selected").val();
            if (tg != "0") {
                $($("#ddlReceiveBank")).tooltip("hide").attr("data-original-title", "").removeClass("errorClass");
                index = parseInt($("#ddlReceiveBank").find(":selected").val());
                if (index > 0) {
                    randomint = TaoSoNgauNhien(1, 5);
                    $('.infoBank').hide();
                    $(".bankInfo").show();
                    $(".bo" + randomint).show();
                    var index1 = index - 1;
                    $(".bo" + randomint + " .infoBank:eq(" + index1 + ")").show()
                }
            }

        }), $("#btnSendthongbaoTCoin").click(function () {
            if (t.validatethongbaomuaTCoin()) {
                var e = {
                    TransferType: $("#ddlTransferType").val(),
                    TransferBank: $("#ddlTransferBank").val(),
                    CustomerName: $("#txtCustomerName").val(),
                    CustomerBN: $("#txtCustomerBN").val(),
                    ReceiveBank: $("#ddlReceiveBank").val(),
                    TransferDateStr: $("#txtTransferDate").val(),
                    Amount: $("#txtAmount").val(),
                    ToBankCode: index,
                    ToBankNumber: randomint
                },
                    a = JSON.stringify({
                        sendNotify: e
                    });
                $.ajax({
                    url: "/News/GuiThongBaoNapTien",
                    type: "POST",
                    data: a,
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    beforeSend: function () {
                        $("#boxLoading").show()
                    },
                    success: function () {
                        alert("Gửi thông báo thành công!"), window.location.href = "/"
                    },
                    error: function () {
                        alert("Có lỗi xảy ra. Vui lòng thử lại sau!")
                    },
                    complete: function () {
                        $("#boxLoading").hide()
                    }
                })
            }
        })
    }, t.validatethongbaomuaTCoin = function () {
        var t = !0,
            e = $("#txtAmount").val();
        "" == $.trim(e) ? ($($("#txtAmount")).tooltip("hide").attr("data-original-title", "Nhập số TCoin đặt mua").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#txtAmount").data("title", "").removeClass("errorClass").tooltip("destroy"), 0 == $("#ddlTransferType").find(":selected").val() ? ($($("#ddlTransferType")).tooltip("hide").attr("data-original-title", "Hãy chọn hình thức chuyển tiền").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ddlTransferType").data("title", "").removeClass("errorClass").tooltip("destroy"), 0 == $("#ddlTransferBank").find(":selected").val() ? ($($("#ddlTransferBank")).tooltip("hide").attr("data-original-title", "Hãy chọn ngân hàng chuyển tiền").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ddlTransferBank").data("title", "").removeClass("errorClass").tooltip("destroy");
        var a = $("#txtCustomerName").val();
        "" == $.trim(a) ? ($($("#txtCustomerName")).tooltip("hide").attr("data-original-title", "Hãy nhập tên người chuyển tiền").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#txtCustomerName").data("title", "").removeClass("errorClass").tooltip("destroy");
        var i = $("#txtCustomerBN").val();
        "" == $.trim(i) ? ($($("#txtCustomerBN")).tooltip("hide").attr("data-original-title", "Hãy nhập số tài khoản chuyển tiền").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#txtCustomerBN").data("title", "").removeClass("errorClass").tooltip("destroy");
        $("#txtTransferDate").val();
        return "" == $.trim(i) ? ($($("#txtTransferDate")).tooltip("hide").attr("data-original-title", "Hãy nhập thời gian chuyển tiền").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#txtTransferDate").data("title", "").removeClass("errorClass").tooltip("destroy"), 0 == $("#ddlReceiveBank").find(":selected").val() ? ($($("#ddlReceiveBank")).tooltip("hide").attr("data-original-title", "Hãy chọn ngân hàng nhận tiền").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ddlReceiveBank").data("title", "").removeClass("errorClass").tooltip("destroy"), t
    }
}
//function for dropdowlist multi in buycard
function arrowClick($arrow) {
    if ($arrow.hasClass('down')) {
        $('.boxdrpmega .dropDownList').each(function () {
            $(this).hide();
            $(this).prev().removeClass('up').addClass('down');
        });
        $arrow.removeClass('down').addClass('up');
        $arrow.next().show();
    } else {
        $arrow.removeClass('up').addClass('down');
        $arrow.next().hide();
    }
}

function radioButtonChecked($target) {
    if ($target.is(':checked')) {
        $('#' + $target.attr('rel')).val($target.attr('txt')).attr('value', $target.val());
        $('#' + $target.attr('rel')).next().removeClass('up').addClass('down');
        $('#' + $target.attr('rel')).next().next().hide();
    }
}
//end function for dropdownlist multi column

//Function Check password
var symbols = " !\"#$%&'()*+'-./0123456789:;<=>?@";
function checkPassword(pwd, element) {
    var Hoa = 0;
    var Thuong = 0;
    var So = 0;

    if (pwd.length < 6) {
        $(element).tooltip('hide').attr('title', 'Mật khẩu phải nhiều hơn hoặc có 6 ký tự').tooltip('fixTitle').addClass('errorClass');
        return 1;
    }

    $(element).data("title", "").removeClass("errorClass").tooltip("destroy");
    return 0;

}
function toAscii(a) {
    var loAZ = "abcdefghijklmnopqrstuvwxyz";
    symbols += loAZ.toUpperCase();
    symbols += "[\\]^_`";
    symbols += loAZ;
    symbols += "{|}~";
    var loc;
    a = symbols.indexOf(a);
    if (a > -1) {
        Ascii_Decimal = 32 + a;
        return (32 + a);
    }
    return (0); // If not in range 32-126 return ZERO
}

function RefreshValidateCode(obj) {
    obj.src = "/User/ValidateCode/" + Math.floor(Math.random() * 10000);
}

function formatCurrency(n, currency) {
    return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
var Common={IsValidEmail:function(ctrlEmail){var emailRex=RegExp(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/)
if($.trim(ctrlEmail)=="")return false;if(($.trim(ctrlEmail)!="")&&(!emailRex.test(ctrlEmail))){return false;}return true;},IsValidPhone:function(ctrlPhone){var phoneno=/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;if(ctrlPhone.match(phoneno)){return true;}else{return false;}},IsValidDate:function(txtDate){if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(txtDate))return false;var parts=txtDate.split("/");var day=parseInt(parts[1],10);var month=parseInt(parts[0],10);var year=parseInt(parts[2],10);if(year<1000||year>3000||month==0||month>12)return false;var monthLength=[31,28,31,30,31,30,31,31,30,31,30,31];if(year%400==0||(year%100!=0&&year%4==0))monthLength[1]=29;return day>0&&day<=monthLength[month-1];},hasWhiteSpace:function(s){return s.indexOf(' ')>=0;}}

$(document).ready(function () {
    //Call init Usermager
    var um = new UserManager();

    
    $(document).on('hidden.bs.modal', '.modal', function (event) {
        $(this).removeData('bs.modal');
        if (event.target.id == 'remoteModal') {
            $('#remoteModal .modal-content').html('');
        }
        $('.modal-content').html('');
    });

    $(document).click(function (event) {
        var clickover = $(event.target);
        var _opened = $(".navbar-collapse").hasClass("collapse in");
        if (_opened === true && !clickover.hasClass("navbar-toggle")) {
            $(".navbar-toggle").click();
        }
    });

    ////Clear Content modal sigin after close()  
    $('#signin').on('hidden.bs.modal', function (e) {
        $('#ctrlusername').val('');
        $('#ctrlpass').val('');
        $('#divnotify span').text('');
        $('#divnotify').hide();
    })
    $('.boxdrpmega input.txt').each(function (index, value) {
        $(this).addClass('blur').val($(this).attr('rel')).focus(function () {
            if ($(this).hasClass('blur')) {
                $(this).removeClass('blur');
                if ($(this).val() == $(this).attr('rel'))
                    $(this).val('');
            }
        }).focusout(function () {
            $(this).addClass('blur');
            if (!$(this).hasClass('nochange')) {
                var val = $(this).val();
                if (val == null || val == '')
                    $(this).val($(this).attr('rel'));
            }
        }).change(function () {
            if (!$(this).hasClass('nochange')) {
                var rel = $(this).attr('rel');
                var val = $(this).val();
                if (val == null || val == '')
                    $(this).addClass('blur').val(rel);
                else
                    $(this).removeClass('blur');
            } else {
                return false;
            }
        });

    });

    $('.boxdrpmega input.txt').focus(function () {
        var $arrow = $(this).next();
        if ($arrow.length > 0 && $arrow.hasClass('dropDownListArrow')) {
            arrowClick($arrow);
        }
    });

    $('.boxdrpmega .dropDownListArrow').click(function () {
        arrowClick($(this));
    });

    //Click outside close drop
    $('body').click(function (event) {
        if (!$(event.target).closest('.boxdrpmega').length) {
            $('.dropDownList').hide();
            $('.boxdrpmega .dropDownList').each(function () {
                $(this).hide();
                $(this).prev().removeClass('up').addClass('down');
            });
        };
    });
});

function reloadPage(){
    location.reload();
}

function excel_ls(id) {
    var str = document.getElementById(id).outerHTML;
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
}

function refreshCaptcha() {
    $("#captcha_code").attr('src','/home/captcha_code.php');
  }
function UserManager() {
    var self = this;

    $("#sign_in").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
            if ($('#ctrlusername').val() == '') {
                $('#ctrlusername').focus();
            }
            else if ($('#ctrlpass').val() == '' && $('#ctrlusername').val() != '') {
                $('#ctrlpass').focus();
            }
            else if ($('#ctrlpass').val() != '' && $('#ctrlusername').val() != '') {
                $('#ctrlloginbtn').focus();
                $('#ctrlloginbtn').trigger('click');
            }
        }
    });
    $('#ctrlusername').keyup(function () {
        if ($('#ctrlusername').val() != '' && Common.IsValidEmail($('#ctrlusername').val())) {
            $($('#ctrlusername')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });
    $('#ctrlpass').keyup(function () {
        if ($('#ctrlpass').val() != '') {
            $($('#ctrlpass')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });
    $('#ctrlusername').focus(function () {
        $('#divnotify').hide();
    });
    $('#ctrlpass').focus(function () {
        $('#divnotify').hide();
    });
    $('#ctrlloginbtn').on("click", function () {
        if (self.validatelogin()) {
            $.ajax(
              {
                  type: "POST",
                  url: "/user/login",
                  data: { email: $('#ctrlusername').val().trim(), password: $('#ctrlpass').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.Success == true) {
                          window.location = '/';
                      }
                      else {
                          $('#divnotify span').text(reponse.msg);
                          $('#divnotify').show();
                      }
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
        }
    });

    $('#logoutbtn').on("click", function () {
        $.ajax({
            type: "POST",
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            url: '/user/logout',
            success: function (results) {
                if (results.Success == true) {
                    window.location = '/';
                }
            },
            error: function (err) {
            }
        });
    });

    $('#ctrlbtnchangpasstpass').click(function () {
        if (self.validatechangepass()) {
            var old_possword = $('#old_possword').val();
            var newpass = $("#new_password").val();
            $.ajax({
                url: "/user/changepassword",
                type: 'POST',
                data: { _oldpassword: old_possword, _newpassword: newpass },
                dataType: 'json',
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (obj) {
                    if (obj.Success == true && obj.status == 1) {
                        alert("Mật Khẩu đổi thành công")
                    } else if (obj.Success == true && obj.status == 2) {
                        $($('#old_possword')).tooltip('hide').attr('title', 'Mật Khẩu hiện tại không dúng!').tooltip('fixTitle').addClass('errorClass');
                        $('#old_possword').focus();
                    } else {
                        alert('Lỗi');
                    }

                },
                error: function (obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                },
                complete: function () {
                    $("#boxLoading").hide();
                }
            });
        };
    });

    //register
    $('#ctrregisterbtn').click(function () {
        if (self.validateregister()) {

            var _userEntity = {
                UserName: $("#ctrlemailtxt").val(),
                Password: $("#ctrlpasstxt").val(),
                Name: $('#ctrlhotentxt').val(),
                Email: $('#ctrlemailtxt').val(),
                Phone: $("#ctrlphonetxt").val(),
                _captcha: $("#ValidateCode").val()
            };
            //var _data = JSON.stringify({ userEntity: _userEntity, _captcha: $("#ValidateCode").val() });
            $.ajax({
                url: "/user/check_register",
                type: "POST",
                data: _userEntity,
                dataType: 'json',
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (obj) {
                    if(obj == 0)
                  {
                     alert("Nhập sai mã captcha. Xin vui lòng nhập lại!");
                     $("#ValidateCode").focus();
                  }
                  else if(obj == 2){ 
                     alert("Email dã có người sử dụng!");
                     $("#ctrlemailtxt").focus();
                  }
                  else if(obj == 3)
                  {
                     window.location = "/User/ComfirmRegister";
                  }
                    
                },
                error: function (obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                },
                complete: function () {
                    $("#boxLoading").hide();
                }
            });
        };
    });
    //comfirm
    $('#ctrcomfirmregisterbtn').click(function () {
        if ($("#txtComfirmCode").val()!= '') { 
            var _data = JSON.stringify({ code: $("#txtComfirmCode").val() });
            $.ajax({
                url: "/user/comfirmRegister",
                type: "POST",
                data: _data,
                contentType: "application/json",
                datatype: "html",
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (obj) {
                    if (obj.Success == true) {
                        window.location = '/';
                    } else {
                        alert(obj.Message);
                        $("#txtComfirmCode").focus();
                    }

                },
                error: function (obj) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                },
                complete: function () {
                    $("#boxLoading").hide();
                }
            });
        };
    });

    //forgot password    
    $('#ctrlforgotpassbtn').on("click", function () {
        if (self.validateforgotpass()) {
            $.ajax(
              {
                  type: "POST",
                  url: "/user/forgotpass",
                  data: { _emailforgot: $('#ctrlforgotemailtxt').val().trim() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      
                      if (reponse.Success == true) {
                          var $msgModal = $('#modalinfo').modal({
                              backdrop: 'static',
                              keyboard: false
                          }).find('.modal-header > span').text("Quên Mật Khẩu đăng nhập!").end()
                             .find('.modal-body p').text("Thư khởi tạo Mật Khẩu đã được gửi thành công. Vui lòng kiểm tra hộp thu đến và thư rác để nhận được hướng dẫn tiếp theo.").end();
                      }
                      else {
                          var $msgModal = $('#modalinfo').modal({
                              backdrop: 'static',
                              keyboard: false
                          }).find('.modal-header > span').text("Quên Mật Khẩu đăng nhập!").end()
                            .find('.modal-body p').text(reponse.message).end();
                      }
					  $('#forgotyourpassword').modal('hide');
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
        }
    });

    //check valid login
    self.validatelogin = function () {
        var flag = true;
        var uemail = $('#ctrlusername').val();
        if ($.trim(uemail) == '') {
            $($('#ctrlusername')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlusername').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(uemail) != '') {
            if (!Common.IsValidEmail(uemail)) {
                $($('#ctrlusername')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlusername').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        var pass = $('#ctrlpass').val();
        if ($.trim(pass) == '') {
            $($('#ctrlpass')).tooltip('hide').attr('title', 'Hãy nhập Mật Khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlpass').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }

    //Check valid change password
    self.validatechangepass = function () {
        var flag = true;

        var old_possword = $('#old_possword').val();
        var newpass = $("#new_password").val();
        var renewpass = $("#repeat_new_password").val();

        if (checkPassword(old_possword, $('#old_possword')) == 1) {
            flag = false;
        }

        if (checkPassword(newpass, $('#new_password')) == 1) {
            flag = false;
        }

        if (checkPassword(renewpass, $('#repeat_new_password')) == 1) {
            flag = false;
        }

        if (checkPassword(newpass, $('#new_password')) == 0 && checkPassword(renewpass, $('#repeat_new_password')) == 0 && newpass != renewpass) {
            $($('#repeat_new_password')).tooltip('hide').attr('title', 'Nhập lại Mật Khẩu không phù hợp').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }

        return flag;
    };

    //Check valid register
    self.validateregister = function () {
        var flag = true;

        var hoten = $('#ctrlhotentxt').val();
        var phone = $("#ctrlphonetxt").val();
        var email = $("#ctrlemailtxt").val();
        var pass = $("#ctrlpasstxt").val();
        var repass = $("#ctrlrepasstxt").val();
        var captcha = $("#ValidateCode").val();

        if ($.trim(hoten) == '') {
            $($('#ctrlhotentxt')).tooltip('hide').attr('data-original-title', 'Nhập họ tên').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlhotentxt').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(phone) == '') {
            $($('#ctrlphonetxt')).tooltip('hide').attr('data-original-title', 'Nhập số điện thoại').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlphonetxt').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(email) == '') {
            $($('#ctrlemailtxt')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlemailtxt').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(email) != '') {
            if (!Common.IsValidEmail(email)) {
                $($('#ctrlemailtxt')).tooltip('hide').attr('data-original-title', 'Email không hợp lý').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailtxt').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        if (checkPassword(pass, $('#ctrlpasstxt')) == 1) {
            flag = false;
        }
        if (checkPassword(repass, $('#ctrlrepasstxt')) == 1) {
            flag = false;
        }

        if (checkPassword(pass, $('#ctrlrepasstxt')) == 0 && pass != repass) {
            $($('#ctrlpasstxt')).tooltip('hide').attr('title', 'Nhập lại Mật Khẩu không phù hợp').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        }

        if ($.trim(captcha) == '') {
            $($('#ValidateCode')).tooltip('hide').attr('data-original-title', 'Nhập mã kiểm tra').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ValidateCode').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        return flag;
    };

    //check valid forgot password
    self.validateforgotpass = function () {
        var flag = true;

        var uemail = $('#ctrlforgotemailtxt').val();
        if ($.trim(uemail) == '') {
            $($('#ctrlforgotemailtxt')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlforgotemailtxt').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(uemail) != '') {
            if (!Common.IsValidEmail(uemail)) {
                $($('#ctrlforgotemailtxt')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlforgotemailtxt').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        return flag;
    }

}
function BuyCard(){
    var self = this;
    self.loadAllProvider = function () {
        var strHTML = "<td><p><input id='buyCardProviderSelect_Viettel' name='buyCardProviderSelect' rel='buyCardProvider' value='1' txt='Viettel' type='radio' class='left'>&nbsp;<label class='left mL5' for='buyCardProviderSelect_Viettel'>Viettel </label><span class='separator'></span></p><p><input id='buyCardProviderSelect_Mobifone' name='buyCardProviderSelect' rel='buyCardProvider' value='2' txt='Mobifone' type='radio' class='left'>&nbsp;<label class='left mL5' for='buyCardProviderSelect_Mobifone'>Mobifone</label><span class='separator'></span></p><p><input id='buyCardProviderSelect_Vinaphone' name='buyCardProviderSelect' rel='buyCardProvider' value='3' txt='Vinaphone' type='radio' class='left'>&nbsp;<label class='left mL5' for='buyCardProviderSelect_Vinaphone'>Vinaphone</label><span class='separator'></span></p><p><input id='buyCardProviderSelect_Vietnamobile' name='buyCardProviderSelect' rel='buyCardProvider' value='7' txt='Vietnamobile' type='radio' class='left'>&nbsp;<label class='left mL5' for='buyCardProviderSelect_Vietnamobile'>Vietnamobile</label><span class='separator'></span></p></td>";
                    $("#trprovider").html(strHTML);

                    //Select provider
                    $('.boxdrpmega input[name="buyCardProviderSelect"]').each(function () {
                        $(this).change(function () {
                            radioButtonChecked($(this));
                            $('#buyCardProvider').removeClass('errorClass');
                            $($('#buyCardProvider')).tooltip('hide').attr('data-original-title', '')
                            self.loadAllCardType($(this).val());
                        });
                    });
    };
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
    };
    $('.boxdrpmega input[name="buyCardPaymentMethod"]').each(function () {
        $(this).change(function () {
            radioButtonChecked($(this));
            $($('#buyCardPaymentMethod')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        });
    });
  
    $('#ctrlmuathebtn').on("click", function () {
        if (self.validatebuycard()) {
            //pass prameter and show modal confirm
            $("#lblprovider").text($('#buyCardProvider').val());
            $("#lblcardtype").text($('#buyCardAmount').val());
            $("#lblsoluongthe").text($('#ctrlsoluongthe').val());
            $("#lblemail").text($('#ctrlemailaddress').val());
            $("#lblpaymentmethod").text($('#buyCardPaymentMethod').val());
            if ($('#buyCardPaymentMethod').attr('value') == 'banthe247') { 
                $.ajax({
                    url: "/user/CheckIfSessionValid",
                    type: "POST",
                    dataType: 'json',
                    success: function (result) {
                        if (result.Success == false) {
                            $("#Confirm_BuyCardDetail").show();
                        }
                        else{
                            $("#Confirm_BuyCardDetail").hide();
                            }
                    }
                });
            } else {
                $("#Confirm_BuyCardDetail").hide();
                $('#lblpttt').text('Ngân hàng thanh toán: ')
            }

            $('#buycardpreviewmodal').modal('show', {backdrop: 'static', keyboard: false});
            
        }
    });
     $('#ctrthanhtoanbtn').on("click", function () {
        var isVisible = $('#Confirm_BuyCardDetail').is(':visible');
        if ($('#buyCardPaymentMethod').attr('value') == 'banthe247') { /*case select paycard*/
            if (isVisible) { /*Case not login*/
                if (self.validateloginbuycard()) {//check valid login
                    self.Loginbuycard($('#ctrlemailmuathetxt_log').val(), $('#ctrlpassmuathetxt_log').val(), function () {//login calback
                        self.buycardnotsigin($('#ctrlemailmuathetxt_log').val(), $('#ctrlpassmuathetxt_log').val(), $('#buyCardProvider').attr('value'), $('#buyCardAmount').attr('value'), $('#ctrlemailaddress').val())
                    });
                }else{
                    console.log(self.validateloginbuycard());
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
                                $('.divresult,.buycarddivresult').hide();
                                $("#notifyresult").addClass('alert-warning');
                                $('#notifyresult i').addClass('fa-times-circle');
                                $('#notifyresult strong').text('Lỗi giao dịch: ');
                                $('#notifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                            } else {
                                $("#notifyresult").addClass('alert-success');
                                $('#notifyresult i').addClass('fa-check');
                                $('#notifyresult strong').text('Success ');
                                $('#notifyresult span').text("Giao dịch " + obj.data.message);
                                $('#tblcardinfo').show();
                                //var rsp = obj.data.listCards.split('|');
                                var rspListCard = jQuery.parseJSON(obj.data.listCards);
                                for (var i = 0; i < rspListCard.length; i++) {
                                    $('#buycardtblcardinfo tbody').append('\
                                    <tr><td class="text-center">' + rspListCard[i].ProviderCode + '</td>\
                                        <td class="text-center">' + rspListCard[i].Amount + '</td>\
                                        <td class="text-center">' + rspListCard[i].PinCode + '</td>\
                                        <td class="text-center">' + rspListCard[i].Serial + '</td>\
                                    </tr>\ ');
                                }
                                $('.buycarddivresult').show();
                                $(".datetransaction").text('');
                            }
                        } else {
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Error! ');
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
            self.paymentbuycardusesbank($('#buyCardPaymentMethod').attr('value'), $('#buyCardProvider').attr('value'), $('#ctrlemailaddress').val(), $('#buyCardAmount').attr('value'), $('#ctrlsoluongthe').val())
        }

    });
    $('#xuatexel').on("click", function () {
        var str = document.getElementById('buycardtblcardinfo').outerHTML;
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
    }); 
    self.buycardnotsigin = function (email, password, providerid, amount, mailadd) {
        $.ajax({
            url: "/user/PaymentBuyCardNotLogin",
            type: 'POST',
            data: { UserName: email, password: password, providerId: $('#buyCardProvider').attr('value'), amount: $('#buyCardAmount').attr('value'), quantity: $("#ctrlsoluongthe").val(), mailnhanmathe: mailadd },
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
                        $('.divresult,.buycarddivresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Lỗi giao dịch: ');
                        $('#notifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                    } else {
                        $("#notifyresult").addClass('alert-success');
                        $('#notifyresult i').addClass('fa-check');
                        $('#notifyresult strong').text('Success ');
                        $('#notifyresult span').text("Giao dịch " + obj.data.message);
                        $('#tblcardinfo').show();
                        //var rsp = obj.data.listCards.split('|');

                        var rspListCard = jQuery.parseJSON(obj.data.listCards);
                        for (var i = 0; i < rspListCard.length; i++) {
                            $('#tblcardinfo tbody').append('\
                                    <tr><td class="text-center">' + rspListCard[i].ProviderCode + '</td>\
                                        <td class="text-center">' + rspListCard[i].Amount + '</td>\
                                        <td class="text-center">' + rspListCard[i].PinCode + '</td>\
                                        <td class="text-center">' + rspListCard[i].Serial + '</td>\
                                    </tr>\ ');
                        }
                        $("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                        $("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                        $("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                        $("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                        

                        $(".datetransaction").text('');
                    }
                    //$(location).attr('href', '/');
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text(' Giao dịch không thành công!');
                    $('#tblcardinfo').hide();
                    // $(location).attr('href', '/');
                    $('.buycarddivresult').hide();
                }
                $('#ctrcontinuemuathebtn').attr('onClick','reloadPage()');
            },
            error: function (obj) {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
    }
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
                        
                            window.location.href = obj.data;
                        
                        
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
    };
    self.validateloginbuycard = function () {
        var flag = true;

        var uemail = $('#ctrlemailmuathetxt_log').val();
        if ($.trim(uemail) == '') {
            $($('#ctrlemailmuathetxt_log')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlemailmuathetxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(uemail) != '') {
            if (!Common.IsValidEmail(uemail)) {
                $($('#ctrlemailmuathetxt_log')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailmuathetxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        var pass = $('#ctrlpassmuathetxt_log').val();
        if ($.trim(pass) == '') {
            $($('#ctrlpassmuathetxt_log')).tooltip('hide').attr('title', 'Hãy Nhập Mật Khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlpassmuathetxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }
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
                    $('#divnotifybc span').text('Nhập sai tên Đăng Nhập hoặc Mật Khẩu');
                    $('#divnotifybc').show();
                }
            },
            error: function (msg) {
            }
        });
    }
   self.validatebuycard = function () {
        var flag = true;

        var provider = $('#buyCardProvider').val();
        if ($.trim(provider) == '') {
            $($('#buyCardProvider')).tooltip('hide').attr('title', 'Chọn nhà cung cấp').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#buyCardProvider').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var cardamount = $('#buyCardAmount').val();
        if ($.trim(cardamount) == '') {
            $($('#buyCardAmount')).tooltip('hide').attr('title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#buyCardAmount').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var slthe = $('#ctrlsoluongthe').val();
        if ($.trim(slthe) == '' || $.trim(slthe) == 0) {
            $($('#ctrlsoluongthe')).tooltip('hide').attr('title', 'Nhập số lượng thẻ cần mua').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlsoluongthe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var email = $('#ctrlemailaddress').val();
        if ($.trim(email) == '') {
            $($('#ctrlemailaddress')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim(email) != '') {
            if (!Common.IsValidEmail(email)) {
                $($('#ctrlemailaddress')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        var paymethod = $('#buyCardPaymentMethod').val();
        if ($.trim(paymethod) == '') {
            $($('#buyCardPaymentMethod')).tooltip('hide').attr('title', 'Chọn phương thức thanh toán').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#buyCardPaymentMethod').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }
}
function naptiendt(){ //nap ti?n vào tài kho?n qua th? di?n tho?i
    var self = this;
    self.init_naptiendienthoai = function () {        
        $('#ctrlSoDienThoai').keyup(function () {
            if ($('#ctrlSoDienThoai').val() != '') {
                $($('#ctrlSoDienThoai')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            }
        });

        

        self.loadAllCardType();

        //event Chọn phuong thức thanh toán
        $('.boxdrpmega input[name="topupPaymentMethod"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $($('#topupPaymentMethod')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            });
        });
        $('.boxdrpmega input[name="topuptype"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $($('#topuptype')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            });
        });
        $('#ctrltopupmobilebtn').on("click", function () {
            if (self.validatenaptiendienthoai()) {
                var sodienthoai = $('#ctrlSoDienThoai').val();
                //Code new
                if (sodienthoai != '') {
                    $("#lblphone").text($('#ctrlSoDienThoai').val());
                    
                    $("#lblmenhgia").text($('#topupAmount').val());
                    $("#lbltopupemail").text($('#ctrlnapdienthoaiemailaddress').val());
                    $("#lbltopuppaymentmethod").text($('#topupPaymentMethod').val());
                    if ($('#topupPaymentMethod').attr('value') == 'banthe247') { 
                        $.ajax({
                            url: "/user/CheckIfSessionValid",
                            type: "POST",
                            dataType: 'json',
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
                    alert('Mời Nhập số điện thoại!');
                }

                
            }
        });

        //event btn thanhtoan in modal preview click
        $('#ctrtopupthanhtoanbtn').on("click", function () {
            var isVisible = $('#Topup_Confirm_OrderDetail').is(':visible');
            if ($('#topupPaymentMethod').attr('value') == 'banthe247') {
                if (isVisible) { 
                    if (self.validatelogintopup()) {
                        self.Logintopup($('#ctrlemailtopuptxt_log').val(), $('#ctrlpasstopuptxt_log').val(), function () {//login calback
                            self.topupnotsigin($('#ctrlemailtopuptxt_log').val(), $('#ctrlpasstopuptxt_log').val(), $('#ctrlSoDienThoai').val(), $('#topupAmount').attr('value'), $('#ctrlnapdienthoaiemailaddress').val(),$('#topuptype').attr('value') )
                        });
                    }
                } else {//case has login                
                    $('#naptiendienthoaipreviewmodal').modal('hide');
                    $.ajax({
                        url: "/user/PaymentTopupMobileHasLogin",
                        type: 'POST',
                        data: { sodienthoai: $('#ctrlSoDienThoai').val(), amount: $('#topupAmount').attr('value'), email: $("#ctrlnapdienthoaiemailaddress").val(),telcotype: $('#topuptype').attr('value') },
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
            } else { //case select bank            
                self.paymenttopupusesbank($('#topupPaymentMethod').attr('value'), $('#ctrlSoDienThoai').val(), $('#topupAmount').attr('value'), $('#ctrlnapdienthoaiemailaddress').val(),$('#topuptype').attr('value') )
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
                    $($('#ctrlemailtopuptxt_log')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
                }
            },
            error: function (msg) {
            }
        });
    }
    self.paymenttopupusesbank = function (bankCode, sodienthoai, amount, email,telcotype) {
        $.ajax({
            url: "/user/PaymentTopupMobileUsesBank",
            type: 'POST',
            data: { bankCode: bankCode, sodienthoai: sodienthoai, amount: amount, email: email,telcotype:telcotype },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                $('#naptiendienthoairesultmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                if (obj.code == '00') {
                    //if (obj.Signature == true) {
                        window.location.href=obj.data
                        //if (obj.data.RspCode == "00") {
//                            window.location.href = obj.data.UrlRedirect;
//                        } else {
//                            $('.divresult').hide();
//                            $("#notifyresult").addClass('alert-warning');
//                            $('#notifyresult i').addClass('fa-times-circle');
//                            $('#notifyresult strong').text('K?t n?i v?i ngân hàng dang b? gián do?n, m?i b?n ch?n s? d?ng ngân hàng khác! ');
//                            $('#tblcardinfo').hide();
//                        }
                    //} else {
//                        $('#tblcardinfo').hide();
//                        $('.divresult').hide();
//                        $("#notifyresult").addClass('alert-warning');
//                        $('#notifyresult i').addClass('fa-times-circle');
//                        $('#notifyresult strong').text('Lỗi giao dịch: ');
//                        if (obj.data) {
//                            $('#notifyresult span').text(obj.data.Message + ' ' + obj.data.RspCode);
//                            $('#naptiendienthoaipreviewmodal').modal('toggle');
//                        } else {
//                            $('#notifyresult span').text(obj.Message);
//                            $('#naptiendienthoaipreviewmodal').modal('toggle');
//                        }
//                        
//                    }
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
    self.topupnotsigin = function (email, password, sodienthoai, amount, mailadd,telcotype) {
        $.ajax({
            url: "/user/PaymentTopupMobileNotLogin",
            type: 'POST',
            data: { UserName: email, password: password, sodienthoai: sodienthoai, amount: amount,  mailnhanmathe: mailadd ,telcotype:telcotype},
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
                    $('#notifyresult strong').text(' Nạp thẻ thành công! ');
                    // cập nhật lại số tiền
                    $("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                    $("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                    $("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                    $("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text(' Lỗi giao dịch nạp thẻ! ');
                    $('#tblcardinfo').hide();
                    // $(location).attr('href', '/');
                }
                $('#ctrcontinuetopupbtn').attr('onClick','reloadPage()');
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

        var uemail = $('#ctrlemailtopuptxt_log').val();
        if ($.trim(uemail) == '') {
            $($('#ctrlemailtopuptxt_log')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlemailtopuptxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(uemail) != '') {
            if (!Common.IsValidEmail(uemail)) {
                $($('#ctrlemailtopuptxt_log')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailtopuptxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        var pass = $('#ctrlpasstopuptxt_log').val();
        if ($.trim(pass) == '') {
            $($('#ctrlpasstopuptxt_log')).tooltip('hide').attr('title', 'Hãy Nhập Mật Khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlpasstopuptxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }

    self.loadAllCardType = function () {
        $.ajax({
            url: "/user/GetListCardTypeByProviderId",
            type: 'get',
            data: { PrividerId: 1 },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                if (obj.Success == true) {
                    var strHTML = "<table style='width: 100%;' rel=" + 1 + "><tbody><tr><td>";
                    for (var i = 0; i < obj.data.length; i++) {
                        strHTML += "<input class='left' name='topupAmountSelect' topupAmountSelect_" + obj.data[i].Id + "' rel='topupAmount' value='" + obj.data[i].Amount + "' txt=" + obj.data[i].CardName + " type='radio'>";
                        strHTML += "<label class='left' for='topupAmountSelect_" + obj.data[i].Id + "'>" + obj.data[i].CardName + "</label>";
                        strHTML += "<div style='clear:both;'></div><span class='separator'></span>";
                    }
                    strHTML += "</td></tr></tbody></table>";
                    $("#table_topupAmount").html(strHTML);

                    //Select item                   
                    $('.boxdrpmega input[name="topupAmountSelect"]').each(function () {
                        $(this).change(function () {
                            radioButtonChecked($(this));
                            $('#topupAmount').removeClass('errorClass');
                            $($('#topupAmount')).tooltip('hide').attr('data-original-title', '')

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

    self.validatenaptiendienthoai = function () {
        var flag = true;

        var sodienthoai = $('#ctrlSoDienThoai').val();
        if ($.trim(sodienthoai) == '') {
            $($('#ctrlSoDienThoai')).tooltip('hide').attr('title', 'Nhập số điện thoại').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlSoDienThoai').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        

        var cardamount = $('#topuptype').val();
        if ($.trim(cardamount) == '') {
            $($('#topuptype')).tooltip('hide').attr('title', 'Chọn loại thuê bao').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#topuptype').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        var cardamount = $('#topupAmount').val();
        if ($.trim(cardamount) == '') {
            $($('#topupAmount')).tooltip('hide').attr('title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#topupAmount').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        

        var paymethod = $('#topupPaymentMethod').val();
        if ($.trim(paymethod) == '') {
            $($('#topupPaymentMethod')).tooltip('hide').attr('title', 'Chọn phuong thức thanh toán').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#topupPaymentMethod').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }
}
function muathegame() {
    var self = this;
    
    $('#ctrlgameemailtxt_log').keyup(function () {
        if ($('#ctrlgameemailtxt_log').val() != '' && Common.IsValidEmail($('#ctrlgameemailtxt_log').val())) {
            $($('#ctrlgameemailtxt_log')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });
    $('#ctrlgamepasstxt_log').keyup(function () {
        if ($('#ctrlgamepasstxt_log').val() != '') {
            $($('#ctrlgamepasstxt_log')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });
    $('#ctrlemailaddressgame').keyup(function () {
        if ($('#ctrlemailaddressgame').val() != '' && Common.IsValidEmail($('#ctrlemailaddressgame').val())) {
            $($('#ctrlemailaddressgame')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        }
    });

    $('.boxdrpmega input[name="buyCardGamePaymentMethod"]').each(function () {
        $(this).change(function () {
            radioButtonChecked($(this));
            $($('#buyCardGamePaymentMethod')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
        });
    });

    
    $('#ctrlmuathegamebtn').on("click", function () {
        if (self.validatebuycardgame()) {
            //pass prameter and show modal confirm
            $("#lblgameprovider").text($('#buyCardGameProvider').val());
            $("#lblgamecardtype").text($('#buyCardGameAmount').val());
            $("#lblgamesoluongthe").text($('#ctrlsoluongthegame').val());
            $("#lblgameemail").text($('#ctrlemailaddressgame').val());
            $("#lblgamepaymentmethod").text($('#buyCardGamePaymentMethod').val());
            
            if ($('#buyCardGamePaymentMethod').attr('value') == 'banthe247') { //case select paycard
                $.ajax({
                    url: "/user/CheckIfSessionValid",
                    type: "POST",
                    dataType:'json',
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
        if ($('#buyCardGamePaymentMethod').attr('value') == 'banthe247') { //case select paycard
            if (isVisible) { //Case not login
                if (self.validateloginbuycardgame()) {//check valid login
                    self.LoginbuycardGame($('#ctrlgameemailtxt_log').val(), $('#ctrlgamepasstxt_log').val(), function () {//login calback
                        self.buycardgamenotsigin($('#ctrlgameemailtxt_log').val(), $('#ctrlgamepasstxt_log').val(), $('#buyCardGameProvider').attr('value'), $('#buyCardGameAmount').attr('value'), $('#ctrlemailaddressgame').val())
                    });
                }
            } else {//case has login                
                $('#buycardgamepreviewmodal').modal('hide');
                $.ajax({
                    url: "/user/PaymentBuyCardHasLogin",
                    type: 'POST',
                    data: { providerId: $('#buyCardGameProvider').attr('value'), amount: $('#buyCardGameAmount').attr('value'), quantity: $("#ctrlsoluongthegame").val(), emailnhan: $('#ctrlemailaddressgame').val() },
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
                            $('#gamenotifyresult span').text("Thẻ trong kho không đủ số lượng");
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
        var str = document.getElementById('tblgamecardinfo').outerHTML;
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
    });
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
                    $('#divgamenotifybc span').text('Nhập sai tên Đăng Nhập hoặc Mật Khẩu');
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
            data: { UserName: email, password: password, providerId: $('#buyCardGameProvider').attr('value'), amount: $('#buyCardGameAmount').attr('value'), quantity: $("#ctrlsoluongthegame").val(), mailnhanmathe: mailadd },
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
                    // $(location).attr('href', '/');
                }
                $('#ctrcontinuegamebtn').attr('onClick','reloadPage()');
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
            url: "/user/PaymentBuyCardUsesBank",
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
                        //if (obj.data.RspCode == "00") {
                            window.location.href = obj.data;//.UrlRedirect;
                        //} else {
//                            $('.divgameresult').hide();
//                            $("#gamenotifyresult").addClass('alert-warning');
//                            $('#gamenotifyresult i').addClass('fa-times-circle');
//                            $('#gamenotifyresult strong').text('K?t n?i v?i ngân hàng dang b? gián do?n, m?i b?n ch?n s? d?ng ngân hàng khác! ');
//                            $('#tblcardinfo').hide();
//                        }

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

   
    
    self.loadAllProvider1 = function () {
       
         var strHTML = "<td>";
        strHTML += '<p><input id="buyCardGameProviderSelect_Datamobi" name="buyCardGameProviderSelect" rel="buyCardGameProvider" value="16" txt="Datamobi" gate="" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardGameProviderSelect_Datamobi">Datamobi</label><span class="separator"></span></p><p><input id="buyCardGameProviderSelect_FPT Gate" name="buyCardGameProviderSelect" rel="buyCardGameProvider" value="5" txt="FPT " gate="" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardGameProviderSelect_FPT Gate">FPT Gate </label><span class="separator"></span></p><p><input id="buyCardGameProviderSelect_ZING" name="buyCardGameProviderSelect" rel="buyCardGameProvider" value="12" txt="ZING " type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardGameProviderSelect_ZING">ZING </label><span class="separator"></span></p><p><input id="buyCardGameProviderSelect_VTC" name="buyCardGameProviderSelect" rel="buyCardGameProvider" value="13" txt="Vcoin " type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardGameProviderSelect_VTC">Vcoin </label><span class="separator"></span></p><p><input id="buyCardGameProviderSelect_GAR" name="buyCardGameProviderSelect" rel="buyCardGameProvider" value="14" txt="GAR" type="radio" class="left">&nbsp;<label class="left mL5" for="buyCardGameProviderSelect_GAR">Garena </label><span class="separator"></span></p>';
        strHTML += "</td>";
        $("#trgameprovider").html(strHTML);

                    $('.boxdrpmega input[name="buyCardGameProviderSelect"]').each(function () {
                        $(this).change(function () {
                            radioButtonChecked($(this));
                            $('#buyCardGameProvider').removeClass('errorClass');
                            $($('#buyCardGameProvider')).tooltip('hide').attr('data-original-title', '')
                            self.loadAllCardType($(this).val());
                        });
                    });
    }
    
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
                
            }
        });
    }

    
    self.validatebuycardgame = function () {
        var flag = true;

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
            $($('#ctrlsoluongthegame')).tooltip('hide').attr('title', 'Nhập số luợng thẻ cần mua').tooltip('fixTitle').addClass('errorClass');
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

        var paymethod = $('#buyCardGamePaymentMethod').val();
        if ($.trim(paymethod) == '') {
            $($('#buyCardGamePaymentMethod')).tooltip('hide').attr('title', 'Chọn phuong thức thanh toán').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#buyCardGamePaymentMethod').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        return flag;
    }

    
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
            $($('#ctrlgamepasstxt_log')).tooltip('hide').attr('title', 'Hãy Nhập Mật Khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlgamepasstxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }

}
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
        $('#ctrlmobilenganhangdrp').change(function () {
            if ($('#ctrlmobilenganhangdrp').find(':selected').val() != "0") {
                $($('#ctrlmobilenganhangdrp')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            } else
                $($('#ctrlmobilenganhangdrp')).tooltip('hide').attr('data-original-title', 'Chọn ngân hàng thanh toán').tooltip('fixTitle').addClass('errorClass');
        });

        //event click mua the
        $('#ctrlmobilemuathebtn').on("click", function () {
            if (self.validatebuycard()) {
                //pass prameter and show modal confirm
                $("#lblprovider").text($('#mobileproviderdrp').find(':selected').text());
                $("#lblcardtype").text($('#ctrlmobilemenhgiadrp').find(':selected').text());
                $("#lblsoluongthe").text($('#ctrlsoluongthe').val());
                $("#lblemail").text($('#ctrlemailaddress').val());
                $("#lblpaymentmethod").text($('#ctrlmobilenganhangdrp').find(':selected').text());
                
                if ($('#ctrlmobilenganhangdrp').find(':selected').val() == 'banthe247') { 
                    $.ajax({
                        url: "/user/CheckIfSessionValid",
                        type: "POST",
                        dataType:'json',
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


        $('#ctrthanhtoanbtn').on("click", function () {
            var isVisible = $('#Confirm_OrderDetail').is(':visible');
            if ($('#ctrlmobilenganhangdrp').find(':selected').val() == 'banthe247') { 
                if (isVisible) { //Case not login
                    if (self.validateloginbuycard()) {//check valid login
                        self.Loginbuycard($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), function () {//login calback
                            self.buycardnotsigin($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), $('#mobileproviderdrp').find(':selected').val(), $('#ctrlmobilemenhgiadrp').find(':selected').val(), $('#ctrlemailaddress').val())
                        });
                    }
                } else {//case has login                
                    $('#buycardpreviewmodal').modal('hide');
                    $.ajax({
                        url: "/user/PaymentBuyCardHasLogin",
                        type: 'POST',
                        data: { providerId: $('#mobileproviderdrp').find(':selected').val(), amount: $('#ctrlmobilemenhgiadrp').find(':selected').val(), quantity: $("#ctrlsoluongthe").val() },
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
                                    $('.divresult,.buycarddivresult').hide();
                                    $("#notifyresult").addClass('alert-warning');
                                    $('#notifyresult i').addClass('fa-times-circle');
                                    $('#notifyresult strong').text('Lỗi giao dịch: ');
                                    $('#notifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                                } else {
                                    $("#notifyresult").addClass('alert-success');
                                    $('#notifyresult i').addClass('fa-check');
                                    $('#notifyresult strong').text('Success ');
                                    $('#notifyresult span').text("Quý khách vui lòng kiểm tra email để lấy thông tin thẻ cào");
                                    $('#buycardtblcardinfo').hide();
                                    
                                    var rsp = obj.data.listCards.split('|');
                                    var rspListCard = jQuery.parseJSON(obj.data.listCards);
			                            for (var i = 0; i < rspListCard.length; i++) {
			                                $('#buycardtblcardinfo tbody').append('<tr><td class="text-center">' + rspListCard[i].ProviderCode + '</td><td class="text-center">' + rspListCard[i].Amount + '</td><td class="text-center">' +"'"+ rspListCard[i].PinCode + '</td><td class="text-center">' +"'"+ rspListCard[i].Serial + '</td></tr>');
			                            }
                                   
                                }
                            } else {
                                $('.divresult').hide();
                                $("#notifyresult").addClass('alert-warning');
                                $('#notifyresult i').addClass('fa-times-circle');
                                $('#notifyresult strong').text('Error! ');
                                $('#notifyresult span').text("Mệnh giá khách mua trong kho có thể đã hết");
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

                self.paymentbuycardusesbank($('#ctrlmobilenganhangdrp').find(':selected').val(), $('#mobileproviderdrp').find(':selected').val(), $('#ctrlemailaddress').val(), $('#ctrlmobilemenhgiadrp').find(':selected').val(), $('#ctrlsoluongthe').val())
            }

        });
$('#xuatexel').on("click", function () {
        var str = document.getElementById('buycardtblcardinfo').outerHTML;//$('.buycarddivresult').html();//tableExport({ type: 'excel', escape: 'false' });
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
                dataType:"json",
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

    }
	 self.loadprovider = function () {
        var ctrhtml = '<option value="0">Chọn mạng di động</option><option value="1">Viettel(0%)</option><option value="2">Mobifone(0%)</option><option value="3">Vinaphone(0%)</option><option value="7">Vietnammobile(0%)</option>';
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
    };
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
                    $('#divnotifybc span').text('Nhập sai tên Đăng Nhập hoặc Mật Khẩu');
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
            data: { UserName: email, password: password, providerId: providerid, amount: amount, quantity: $("#ctrlsoluongthe").val(), mailnhanmathe: mailadd },
            dataType: 'json',
            beforeSend: function () {
                $("#boxLoading").show();
            },
            success: function (obj) {
                if (obj.Success == true) {
                    if (obj.data.errorCode != 00) {
                        $('#tblcardinfo').hide();
                        $('.divresult,.buycarddivresult').hide();
                        $("#notifyresult").addClass('alert-warning');
                        $('#notifyresult i').addClass('fa-times-circle');
                        $('#notifyresult strong').text('Lỗi giao dịch: ');
                        $('#notifyresult span').text(obj.data.message + ' ' + obj.data.errorCode);
                    } else {
                        $("#notifyresult").addClass('alert-success');
                        $('#notifyresult i').addClass('fa-check');
                        $('#notifyresult strong').text('Success ');
                        $('#notifyresult span').text("Quý khách vui lòng kiểm tra email để lấy thông tin thẻ cào");
                        $('#tblcardinfo').show();
                        //var rsp = obj.data.listCards.split('|');

                        var rspListCard = jQuery.parseJSON(obj.data.listCards);
                        for (var i = 0; i < rspListCard.length; i++) {
                            $('#tblcardinfo tbody,#buycardtblcardinfo tbody').append('\
                                    <tr><td class="text-center">' + rspListCard[i].ProviderCode + '</td>\
                                        <td class="text-center">' + rspListCard[i].Amount + '</td>\
                                        <td class="text-center">' + rspListCard[i].PinCode + '</td>\
                                        <td class="text-center">' + rspListCard[i].Serial + '</td>\
                                    </tr>\ ');
                        }
                        $("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                        $("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                        $("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                        $("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                        

                        $(".datetransaction").text('');
                    }
                    //$(location).attr('href', '/');
                } else {
                    $('.divresult').hide();
                    $("#notifyresult").addClass('alert-warning');
                    $('#notifyresult i').addClass('fa-times-circle');
                    $('#notifyresult strong').text(' Giao dịch không thành công! ');
                    $('#tblcardinfo').hide();
                    // $(location).attr('href', '/');
                    $('.buycarddivresult').hide();
                }
                $('#ctrcontinuemuathebtn').attr('onClick','reloadPage()');
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
                        if (obj.data.RspCode == "00") {
                            window.location.href = obj.data.UrlRedirect;
                        } else {
                            $('.divresult').hide();
                            $("#notifyresult").addClass('alert-warning');
                            $('#notifyresult i').addClass('fa-times-circle');
                            $('#notifyresult strong').text('Kết nối với ngân hàng đang bị gián đoạn, mời bạn chọn sử dụng ngân hàng khác! ');
                            $('#tblcardinfo').hide();                              
                        }
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

    //function check valid buy card
    self.validatebuycard = function () {
        var flag = true;

        if ($('#mobileproviderdrp').find(':selected').val() == "0") {
            $($('#mobileproviderdrp')).tooltip('hide').attr('data-original-title', 'Chọn mạng di động').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#mobileproviderdrp').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($('#ctrlmobilemenhgiadrp').find(':selected').val() == "0") {
            $($('#ctrlmobilemenhgiadrp')).tooltip('hide').attr('data-original-title', 'Chọn mệnh giá thẻ').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlmobilemenhgiadrp').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        var slthe = $('#ctrlsoluongthe').val();
        if ($.trim(slthe) == '' || $.trim(slthe) == 0) {
            $($('#ctrlsoluongthe')).tooltip('hide').attr('title', 'Nhập số luợng thẻ cần mua').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlsoluongthe').data("title", "").removeClass("errorClass").tooltip("destroy");
        }

        var email = $('#ctrlemailaddress').val();
        if ($.trim(email) == '') {
            $($('#ctrlemailaddress')).tooltip('hide').attr('data-original-title', 'Nhập địa chỉ email').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim(email) != '') {
            if (!Common.IsValidEmail(email)) {
                $($('#ctrlemailaddress')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            } else {
                $('#ctrlemailaddress').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }

        if ($('#ctrlmobilenganhangdrp').find(':selected').val() == "0") {
            $($('#ctrlmobilenganhangdrp')).tooltip('hide').attr('data-original-title', 'Chọn ngân hàng thanh toán').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlmobilenganhangdrp').data("title", "").removeClass("errorClass").tooltip("destroy");;
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
            $('#ctrlemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");;
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
            $($('#ctrlpasstxt_log')).tooltip('hide').attr('title', 'Hãy Nhập Mật Khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlpasstxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }

}
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
        $('.boxdrpmega input[name="mobiletopuptype"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                $($('#mobiletopuptype')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            });
        });
        //check evet keyup
        $('#ctrlmobilenganhangdrp_naptiendt').change(function () {
            if ($('#ctrlmobilenganhangdrp_naptiendt').find(':selected').val() != "0") {
                $($('#ctrlmobilenganhangdrp_naptiendt')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            } else
                $($('#ctrlmobilenganhangdrp_naptiendt')).tooltip('hide').attr('data-original-title', 'Chọn ngân hàng').tooltip('fixTitle').addClass('errorClass');
        });

        //load menh giá th? n?p
        $.ajax({
            url: '/user/GetListCardTypeByProviderId',
            data: { PrividerId: 1 },
            type: "get",
            dataType:"json",
            success: function (obj) {
                if (obj.Success == true) {
                    var cbboxmf = $('#mobilemanhgiathe_naptiendt');
                    $(cbboxmf).empty();
                    var opt = $('<option value="0">Chọn mệnh giá</option>');
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
                    $("#lbltopuppaymentmethod").text($('#ctrlmobilenganhangdrp_naptiendt').find(':selected').text());
                    if ($('#ctrlmobilenganhangdrp_naptiendt').find(':selected').val() == 'banthe247') { 
                        $.ajax({
                            url: "/user/CheckIfSessionValid",
                            type: "POST",
                            dataType:"json",
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

                    $('#naptiendienthoaipreviewmodal').modal({
                        backdrop: 'static',
                        keyboard: false

                    });
                }
                else {
                    alert('Mời Nhập số điện thoại!');
                }


            }
        });

        //event btn thanhtoan in modal preview click
        $('#ctrthanhtoanbtn_mobile').on("click", function () {
            var isVisible = $('#Confirm_OrderDetail').is(':visible');
            if ($('#ctrlmobilenganhangdrp_naptiendt').find(':selected').val() == 'banthe247') { //case select paycard
                if (isVisible) { //Case not login
                    if (self.validateloginndt()) {//check valid login
                        self.Logintopup_mobile($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), function () {//login calback
                            self.topupnotsigin($('#ctrlemailtxt_log').val(), $('#ctrlpasstxt_log').val(), $('#ctrlSoDienThoai_naptiendt').val(), $('#mobilemanhgiathe_naptiendt').find(':selected').val(), $('#ctrlnapdienthoaiemailaddress_naptiendt').val(), $('#mobiletopuptype').attr('value'))
                        });
                    }
                } else {//case has login                
                    $('#naptiendienthoaipreviewmodal').modal('hide');
                    $.ajax({
                        url: "/user/PaymentTopupMobileHasLogin",
                        type: 'POST',
                        data: { sodienthoai: $('#ctrlSoDienThoai_naptiendt').val(), amount: $('#mobilemanhgiathe_naptiendt').find(':selected').val(), email: $("#ctrlnapdienthoaiemailaddress_naptiendt").val(), telcotype: $('#mobiletopuptype').attr('value') },
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
            } else { //case select bank            
                self.paymenttopupusesbank($('#ctrlmobilenganhangdrp_naptiendt').find(':selected').val(), $('#ctrlSoDienThoai_naptiendt').val(), $('#mobilemanhgiathe_naptiendt').find(':selected').val(), $('#ctrlnapdienthoaiemailaddress_naptiendt').val())
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
                    $('#divnotifybc span').text('Nhập sai tên Đăng Nhập hoặc Mật Khẩu');
                    $('#divnotifybc').show();
                }
            },
            error: function (msg) {
            }
        });
    }

    // not login
    self.topupnotsigin = function (email, password, sodienthoai, amount, mailadd, telcotype) {
        $.ajax({
            url: "/user/PaymentTopupMobileNotLogin",
            type: 'POST',
            data: { UserName: email, password: password, sodienthoai: sodienthoai, amount: amount, mailnhanmathe: mailadd, telcotype: telcotype },
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

                if (obj.code == '00') {
                    //if (obj.Signature == true) {
                        //if (obj.data.RspCode == "00") {
                            window.location.href = obj.data;//.UrlRedirect;
                        //} else {
//                            $('.divresult').hide();
//                            $("#notifyresult").addClass('alert-warning');
//                            $('#notifyresult i').addClass('fa-times-circle');
//                            $('#notifyresult strong').text('K?t n?i v?i ngân hàng dang b? gián do?n, m?i b?n ch?n s? d?ng ngân hàng khác! ');
//                            $('#tblcardinfo').hide();
//                        }
                    //} else {
//                        $('#tblcardinfo').hide();
//                        $('.divresult').hide();
//                        $("#notifyresult").addClass('alert-warning');
//                        $('#notifyresult i').addClass('fa-times-circle');
//                        $('#notifyresult strong').text('Lỗi giao dịch: ');
//                        if (obj.data) {
//                            $('#notifyresult span').text(obj.data.Message + ' ' + obj.data.RspCode);
//                        } else {
//                            $('#notifyresult span').text(obj.Message);
//                        }
//
//                    }
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
            $('#mobilemanhgiathe_naptiendt').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        var mbtype = $('#mobiletopuptype').val();
        if ($.trim(mbtype) == '') {
            $($('#mobiletopuptype')).tooltip('hide').attr('title', 'Chọn loại thuê bao').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#mobiletopuptype').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        

        if ($('#ctrlmobilenganhangdrp_naptiendt').find(':selected').val() == "0") {
            $($('#ctrlmobilenganhangdrp_naptiendt')).tooltip('hide').attr('data-original-title', 'Chọn ngân hàng thanh toán').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlmobilenganhangdrp_naptiendt').data("title", "").removeClass("errorClass").tooltip("destroy");;
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
            $('#ctrlemailtxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");;
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
            $($('#ctrlpasstxt_log')).tooltip('hide').attr('title', 'Hãy Nhập Mật Khẩu truy cập').tooltip('fixTitle').addClass('errorClass');
            flag = false;
        } else {
            $('#ctrlpasstxt_log').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag
    }
}
function LichSuMuaThe() {
    var self = this;

    self.initLichSuMuaThe = function() {
        self.LichSuMuaTheTable();
        self.LichSuMuaTheFunction();
    }

    // Hàm ch?c nang
    self.LichSuMuaTheFunction = function() {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $("#ctrlsearchmuathe").click(function() {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuMuaThe");
            $.unblockUI();
        });
        
    
    }

    // Function load data using datatable js: Hàm load d? li?u lên b?ng s? d?ng datatable 
    self.LichSuMuaTheTable = function() {
        var dTable = $('#tblLichSuMuaThe').DataTable({
            "bDestroy": true,
            //"fnServerParams": function(aoData) {
//                aoData.push({
//                    "name": "searchString",
//                    "value": $("#searchmuathe").val()
//                }, {
//                    "name": "telcoCode",
//                    "value": $("#cboLichSuMuaThe option").filter(":selected").val()
//                }, {
//                    "name": "fromDate",
//                    "value": $("#ctrlfromdatetxt").val()
//                }, {
//                    "name": "toDate",
//                    "value": $("#ctrltodatetxt").val()
//                })
//            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtp',
            "buttons": ['excelFlash'],
            "ajax": {
                "url": "/user/KetQuaLichSuMuaThe",
                "type": "GET",
                "datatype": "json",
                'data': function (d) {
                 	d.searchString = $("#searchmuathe").val();
                    d.telcoCode = $("#cboLichSuMuaThe option").filter(":selected").val()
                    d.fromDate = $("#ctrlfromdatetxt").val()
                    d.toDate=$("#ctrltodatetxt").val()
                }
            },
            //"sAjaxSource": '/user/KetQuaLichSuMuaThe',
//            "sServerMethod": "GET",           
            "lengthMenu": [20, 50, 100, 200, 1000],
            //"sColumns": [{
//                "mdata": "Serial"
//            }, {
//                "mdata": "StrAmount"
//            }, {
//                "mdata": "TelcoCode"
//            }, {
//                "mdata": "CreateDate"
//            }],
            "columns": [
            { "data": "Serial" },
            { "data": "StrAmount" },
            { "data": "TelcoCode" },
            { "data": "CreateDate" }
        ],
            "order": [3, 'desc'],
            "oLanguage": {
                "sProcessing": "Ðang xử lý",
                "sLengthMenu": "Hiển thị _MENU_ Bản ghi ",
                "sZeroRecords": "Không tìm thấy ban ghi nào !",
                "sInfo": "Hiển thị t? _START_ - _END_ bản ghi ( trong số _TOTAL_ )",
                "sInfoEmpty": "Không tìm th?y b?n ghi nào !",
                "oPaginate": {
                    "sFirst": "Ðầu",
                    "sPrevious": "Trước",
                    "sNext": "Sau",
                    "sLast": "Cuối"
                }
            }
        });
    }

    // Phuong th?c t?i l?i d? li?u lên table
    self.RefreshTableUser = function(tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }
}
function LichSuNapTienDienThoai() {
    var self = this;

    self.initLichSuNapTienDienThoai = function() {
        self.LichSuNapTienDienThoaiTable();
        self.TinhTienLichSuNapTienDienThoai();
        self.LichSuNapTienDienThoaiFunction();
    }

    // Hàm ch?c nang
    self.LichSuNapTienDienThoaiFunction = function() {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $("#ctrlsearchnaptiendt").click(function() {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuNapTienDienThoai");
            self.TinhTienLichSuNapTienDienThoai();
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load d? li?u lên b?ng s? d?ng datatable 
    self.LichSuNapTienDienThoaiTable = function() {
        var dTable = $('#tblLichSuNapTienDienThoai').DataTable({
            "bDestroy": true,

            "ajax": {
                "url": "/user/GetLichSuNapTienDienThoai",
                "type": "GET",
                "datatype": "json",
                'data': function (d) {
                 	d.searchString = $("#searchnaptiendt").val();
                    d.statusString = $("#ctrltrangthainaptiendt option").filter(":selected").val();
                    d.fromDate = $("#ctrlfromdatetxt").val();
                    d.toDate=$("#ctrltodatetxt").val();
                }
            },
           "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtp',
            "buttons": ['excelFlash'],
            //"sAjaxSource": '/user/_LichSuNapTienDienThoai',
            "lengthMenu": [20, 50, 100, 200, 1000],
           // "aoColumns": [{
//                "mData": "MobileNo"
//            }, {
//                "mData": "StrAmount"
//            }, {
//                "mData": "TelcoStatus"
//            }, {
//                "mData": "CreateDate"
//            }],
            "columns": [
            { "data": "MobileNo" },
            { "data": "StrAmount" },
            { "data": "TelcoStatus" },
            { "data": "CreateDate" }
        ],
            "order": [3, 'desc'],
            "oLanguage": {
                "sProcessing": "Ðang xử lý",
                "sLengthMenu": " _MENU_ ",
                "sZeroRecords": "Không tìm thấy bản ghi nào !",
                "sInfo": "Hiển thị _START_ t?i _END_ c?a ( _TOTAL_ bản ghi )",
                "sInfoEmpty": "Không tìm thấy bản ghi nào !",
                "oPaginate": {
                    "sFirst": "Ðầu",
                    "sPrevious": "Trước",
                    "sNext": "Sau",
                    "sLast": "Cuối"
                }
            }
        });
    }

    // Phuong th?c t?i l?i d? li?u lên table
    self.RefreshTableUser = function(tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }

    // Tính ti?n n?p ti?n di?n tho?i
    self.TinhTienLichSuNapTienDienThoai = function() {

    }

}
// l?ch s? n?p ti?n ví
function LichSuNapTienVi() {
    var self = this;

    self.initLichSuNapTienVi = function() {
        self.LichSuNapTienViTable();
        self.LichSuNapTienViFunction();
    }

    // Hàm ch?c nang
    self.LichSuNapTienViFunction = function() {

        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        $("#ctrlsearchnaptien").click(function() {
            Busy.Block();
            self.RefreshTableUser("#tblLichSuNapTienVi");
            self.TinhTienLichSuNapTienVi();
            $.unblockUI();
        });
    }

    // Function load data using datatable js: Hàm load d? li?u lên b?ng s? d?ng datatable 
    self.LichSuNapTienViTable = function() {
        var dTable = $('#tblLichSuNapTienVi').DataTable({
            "bDestroy": true,
            //"fnServerParams": function(aoData) {
//                aoData.push({
//                    "name": "fromDate",
//                    "value": $("#ctrlfromdatetxt").val()
//                }, {
//                    "name": "toDate",
//                    "value": $("#ctrltodatetxt").val()
//                }, {
//                    "name": "typeString",
//                    "value": 7
//                }, {
//                    "name": "statusString",
//                    "value": -1
//                })
//            },
            "ajax": {
                "url": "/user/lichsunaptienvi",
                "type": "GET",
                "datatype": "json",
                'data': function (d) {                 
                    d.fromDate = $("#ctrlfromdatetxt").val();
                    d.toDate=$("#ctrltodatetxt").val();
                }
            },
            "processing": true,
            "serverSide": true,
            "bProcessing": true,
            "iDisplayLength": 20,
            "sPaginationType": "full_numbers",
            "dom": '<l>Brtp',
            "buttons": ['excelFlash'],
            //"sAjaxSource": '/user/GetLichSuChuyenTien',
            "lengthMenu": [20, 50, 100, 200, 1000],
            //"aoColumns": [{
//                "mData": "StrAmount"
//            }, {
//                "mData": "Email"
//            }, {
//                "mData": "CreateDate"
//            }],
            "columns": [
            
            { "data": "TenNganHang" },
            { "data": "StrAmount" },            
            { "data": "CreateDate" }
            ],
            "order": [2, 'desc'],
            "oLanguage": {
                "sProcessing": "Ðang xử lý",
                "sLengthMenu": " _MENU_ ",
                "sZeroRecords": "Không tìm thấy bản ghi nào !",
                "sInfo": "Hiển thị _START_ t?i _END_ c?a ( _TOTAL_ bản ghi )",
                "sInfoEmpty": "Không tìm thấy bản ghi nào !",
                "oPaginate": {
                    "sFirst": "Ðầu",
                    "sPrevious": "Trước",
                    "sNext": "Sau",
                    "sLast": "Cuối"
                }
            }
        });
    }

    // Phuong th?c t?i l?i d? li?u lên table
    self.RefreshTableUser = function(tableId) {
        table = $(tableId).dataTable();
        oSettings = table.fnSettings();
        table.fnDraw();
    }
    // tính ti?n
    self.TinhTienLichSuNapTienVi = function() {
        $.ajax({
            "url": '/user/lichsunaptienvi',
            "type": 'GET',
            "datatype": "html",
            "data": {                 	
                    fromDate:$("#ctrlfromdatetxt").val(),
                    toDate:$("#ctrltodatetxt").val()
                },
            success: function(obj) {
               var sumamount= jQuery.parseJSON(obj)
                $("#idSumMoneyHistory").html(sumamount.tongtien);
            }
        });
    }
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
            url: "/news/checknganhang",
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
                    //0 != $("#ddlReceiveBank").find(":selected").val() ? ($($("#ddlReceiveBank")).tooltip("hide").attr("data-original-title", "").removeClass("errorClass"),index = parseInt($(this).val()) - 1,index >= 0 ? ($(".infoBank").hide(),$(".infoBank:eq(" + index + ")").show(), $(".bankInfo").show()) : ($(".infoBank").hide(), $(".bankInfo").hide())) : $($("#ddlReceiveBank")).tooltip("hide").attr("data-original-title", "Hãy ch?n ngân hàng nh?n ti?n").tooltip("fixTitle").addClass("errorClass")
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
                    ToBankNumber: randomint,
                    ToBankName: $("#txtToBankName").val()
                },
                    a = JSON.stringify({
                        sendNotify: e
                    });
                $.ajax({
                    url: "/news/guithongbaonaptien",
                    type: "POST",
                    data: e,
                    dataType: "json",
                    //contentType: "application/json; charset=utf-8",
                    beforeSend: function () {
                        $("#boxLoading").show()
                    },
                    success: function (obj) {
                        if(obj.Success==true){
                            $('.modal_tbnt').hide();
                            $('.modal_thtc').show();
                        // alert("Gửi thông báo thành công!"), window.location.href = "/";
                        }else{
                            alert('Bạn phải Đăng Nhập');
                        }
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
        "" == $.trim(e) ? ($($("#txtAmount")).tooltip("hide").attr("data-original-title", "Nhập s? TCoin d?t mua").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#txtAmount").data("title", "").removeClass("errorClass").tooltip("destroy"), 0 == $("#ddlTransferType").find(":selected").val() ? ($($("#ddlTransferType")).tooltip("hide").attr("data-original-title", "Hãy ch?n hình th?c chuy?n ti?n").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ddlTransferType").data("title", "").removeClass("errorClass").tooltip("destroy"), 0 == $("#ddlTransferBank").find(":selected").val() ? ($($("#ddlTransferBank")).tooltip("hide").attr("data-original-title", "Hãy ch?n ngân hàng chuy?n ti?n").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ddlTransferBank").data("title", "").removeClass("errorClass").tooltip("destroy");
        var a = $("#txtCustomerName").val();
        "" == $.trim(a) ? ($($("#txtCustomerName")).tooltip("hide").attr("data-original-title", "Hãy Nhập tên ngu?i chuy?n ti?n").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#txtCustomerName").data("title", "").removeClass("errorClass").tooltip("destroy");
        var i = $("#txtCustomerBN").val();
        "" == $.trim(i) ? ($($("#txtCustomerBN")).tooltip("hide").attr("data-original-title", "Hãy Nhập s? tài kho?n chuy?n ti?n").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#txtCustomerBN").data("title", "").removeClass("errorClass").tooltip("destroy");
        $("#txtTransferDate").val();
        return "" == $.trim(i) ? ($($("#txtTransferDate")).tooltip("hide").attr("data-original-title", "Hãy Nhập th?i gian chuy?n ti?n").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#txtTransferDate").data("title", "").removeClass("errorClass").tooltip("destroy"), 0 == $("#ddlReceiveBank").find(":selected").val() ? ($($("#ddlReceiveBank")).tooltip("hide").attr("data-original-title", "Hãy ch?n ngân hàng nh?n ti?n").tooltip("fixTitle").addClass("errorClass"), t = !1) : $("#ddlReceiveBank").data("title", "").removeClass("errorClass").tooltip("destroy"), t
    }
}




// function chung
function TaoSoNgauNhien(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}
function radioButtonChecked($target) {
    if ($target.is(':checked')) {
        $('#' + $target.attr('rel')).val($target.attr('txt')).attr('value', $target.val());
        $('#' + $target.attr('rel')).next().removeClass('up').addClass('down');
        $('#' + $target.attr('rel')).next().next().hide();
    }
}
function arrowClick($arrow) {
    if ($arrow.hasClass('down')) {
        $('.boxdrpmega .dropDownList').each(function() {
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
function checkPassword(pwd, element) {
    var Hoa = 0;
    var Thuong = 0;
    var So = 0;

    if (pwd.length < 6) {
        $(element).tooltip('hide').attr('title', 'Mật Khẩu phải nhiều hơn hoặc có 6 ký tự').tooltip('fixTitle').addClass('errorClass');
        return 1;
    }
    //for (i = 0; i < pwd.length; i++) {
    //    a = toAscii(pwd.charAt(i));
    //    if (a >= 65 && a <= 90) {
    //        Hoa = 1;
    //    }
    //    if (a >= 97 && a <= 122) {
    //        Thuong = 1;
    //    }
    //    if (a >= 48 && a <= 57) {
    //        So = 1;
    //    }
    //}
    //if (Hoa == 0) {
    //    $(element).tooltip('hide').attr('title', 'Mật Khẩu ph?i g?m c? ký t? vi?t hoa').tooltip('fixTitle').addClass('errorClass');
    //    return 1;
    //}
    //else if (Thuong == 0) {
    //    $(element).tooltip('hide').attr('title', 'Mật Khẩu ph?i g?m c? ký t? vi?t thu?ng').tooltip('fixTitle').addClass('errorClass');
    //    return 1;
    //}
    //else if (So == 0) {
    //    $(element).tooltip('hide').attr('title', 'Mật Khẩu ph?i g?m c? s?').tooltip('fixTitle').addClass('errorClass');
    //    return 1;
    //}
    $(element).data("title", "").removeClass("errorClass").tooltip("destroy");
    return 0;

}
<? include("config.php") ?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Mua nhiều thẻ</title>
   <meta name="description" content='Mua thẻ cào nhanh chóng, mua nhiều loại thẻ cào cùng lúc tiện lợi, mua thẻ điện thoại, thẻ game' />
   <meta name="keywords" content='đổi thẻ cào, đổi thẻ cào sang tiền mặt' />
   <meta name="robots" content='noodp,index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='https://banthe247.com/huong-dan-mua-the' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
  <link rel="stylesheet" type="text/css" href="/css/responsive.css" />  
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/common.js"></script>
  <script src="/js/usermanager.js"></script>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   
   
     <? include ("../includes/inc_header.php")?>

  <div class="container">
    <div class="row">      
    <div class="noidungtrangchu"> <div class=""> 
    <script type="text/javascript">
    $(document).ready(function () {
        var bien = 1;
        var self = this;
        $.ajax({
            url: "/user/GetListProvider",
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
                        strHTML += "<p><input id='buyCardProviderSelect_" + obj.data[i].Name + "' name='buyCardProviderSelect' rel='buyCardProvider' value=" + obj.data[i].Id + " txt=" + obj.data[i].Name + " type='radio' class='left'>";
                        strHTML += "&nbsp;<label class='left mL5' for='buyCardProviderSelect_" + obj.data[i].Name + "'>" + obj.data[i].Name + "</label>";
                        strHTML += "<span class='separator'></span></p>"
                    }
                    strHTML += "</td>";
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
                }
            },
            error: function (obj) {
                //alert('lỗi khi load nhà cung cấp!');
            },
            complete: function () {

                //$("#boxLoading").hide();
            }
        });
        var url = '@Url.Action("Index", "Home")';
        var valuelogin = true;
        $.ajax({
            url: "/user/CheckIfSessionValid",
            type: "POST",
            success: function (result) {
                if (result.Success == false) {
                    valuelogin = false;
                    //$("#Confirm_OrderDetail").show();
                }
                else
                    valuelogin = true;
                //$("#Confirm_OrderDetail").hide();
            }
        });
        $('.boxdrpmega input[name="buyCardPaymentMethod"]').each(function () {
            $(this).change(function () {
                radioButtonChecked($(this));
                if (($('#buyCardPaymentMethod').attr('value') == 'Paycard') && (valuelogin == false)) {
                    alert("Chọn phương thức thanh toán này bạn phải Login");
                    window.location.href = url;
                    //$('#signin').show();

                }
                $($('#buyCardPaymentMethod')).tooltip('hide').attr('data-original-title', '').removeClass('errorClass');
            });

        });
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
        }

        $('#ctrlthemnhieuthebtn').on("click", function () {

            if (validatethemloaithe()) {
                var provider = $('#buyCardProvider').val();
                var cardamount = $('#buyCardAmount').val();
                var slthe = $('#ctrlsoluongthe').val();
                var providervalue = $('#buyCardProvider').attr('value');
                var cardamountvalue = $('#buyCardAmount').attr('value');
                //debugger;

                bien = bien + 1;
                //loadprovidercode($('#buyCardProvider').attr('value'), "muathe")
                $.ajax({
                    url: "/user/GetGroupProviderbyID",
                    type: 'POST',
                    data: { providerid: $('#buyCardProvider').attr('value'), typenap: "muathe" },
                    dataType: 'json',
                    success: function (obj1) {
                        if (obj1.Success == true) {
                            self.chietkhau = obj1.chietkhau;
                            var thanhtien1 = parseInt(slthe) * parseInt(cardamountvalue) * parseFloat(self.chietkhau);
                            $('#tblmuanhieuthe tbody').append('\
                                    <tr id="rownt' + bien + '" class="rownt"><td class="text-center"><span class="menhgia" data-val="' + $('#buyCardAmount').attr('value') + '">' + $('#buyCardAmount').val() + '</span></td>\
                                        <td class="text-center"><span class="nhamang" data-val="' + providervalue + '">' + provider + '</span></td>\
                                        <td class="text-center"><span class="soluong" data-val="' + $('#ctrlsoluongthe').val() + '">' + $('#ctrlsoluongthe').val() + '</span></td>\
                                        <td class="text-center"><span class="chietkhau" data-val="' + self.chietkhau.toString() + '">' + (100 - self.chietkhau * 100).toString() + '</span></td>\
                                        <td class="text-center"><span class="thanhtien" data-val="' + thanhtien1 + '">' + thanhtien1 + '</span></td>\
                                        <td class="text-center"><a class="btnDelete"><span class="xoarow">Xóa</span></a></td>\
                                    </tr>\ ');
                            $(".btnDelete").bind("click", Delete);
                            var thanhtoan = parseInt($("#thanhtien").html());
                            thanhtoan += parseInt(thanhtien1);
                            $("#thanhtien").text(thanhtoan.toString());
                        }
                    }
                });
                var tongtien = parseInt($("#tongtien").html());
                //alert(topupmount1);
                var tongrow = parseInt(cardamountvalue) * parseInt(slthe);

                tongtien += parseInt(tongrow);
                //alert(tongtien);

                $("#tongtien").text(tongtien.toString());
            }
        });
        var bien1 = 1;
        function loadprovidercode(providervalu, typenap) {
            $.ajax({
                url: "/user/GetGroupProviderbyID",
                type: 'POST',
                data: { providerid: providervalu, typenap: typenap },
                dataType: 'json',
                success: function (obj1) {
                    if (obj1.Success == true) {
                        self.chietkhau = obj1.chietkhau;
                    }
                }
            });
        }
        function Delete() {
            var par = $(this).parent().parent(); //tr
            //$(this).find
            //var currentRow = $("#tblnapnhieuso tr#rownt" + bien1);
            //var sodienthoai1 = currentRow.find(".sodienthoai").html();
            var tongtien = 0;
            var thanhtoan = 0;
            par.remove();
            for (bien1 = 1; bien1 < bien; bien1++) {

                var dem = $("#tblmuanhieuthe tr#rownt" + bien1).length;
                if (dem > 0) {
                    var currentRow = $("#tblmuanhieuthe tr#rownt" + bien1);
                    var delcard = currentRow.find(".menhgia").attr("data-val");
                    var delsoluong = currentRow.find(".soluong").attr("data-val");
                    var thanhtoan = currentRow.find(".thanhtien").attr("data-val");
                    var deltong = parseInt(delcard) * parseInt(delsoluong);
                    thanhtoan += parseInt(thanhtoan);
                    tongtien += parseInt(deltong);
                }
            }
            $("#thanhtien").text(thanhtoan.toString());
            $("#tongtien").text(tongtien.toString());
        };
        $('#ctrlmuanhieuthebtn').on("click", function () {
            bien1 = 1;
            if (validatemuanhieumathe()) {
                debugger;
                for (bien1 = 0; bien1 < bien; bien1++) {
                    var demrow = $("#tblmuanhieuthe tr#rownt" + bien1).length;
                    if (demrow > 0) {
                        var currentRow = $("#tblmuanhieuthe tr#rownt" + bien1);
                        var menhgiathe = currentRow.find(".menhgia").attr("data-val");
                        var soluongthe = currentRow.find(".soluong").attr("data-val");
                        var manhamang = currentRow.find(".nhamang").attr("data-val");
                        if ($('#buyCardPaymentMethod').attr('value') == 'Paycard') {
                            $.ajax({
                                url: "/user/PaymentBuyCardHasLogin",
                                type: 'POST',
                                data: { providerId: manhamang, amount: menhgiathe, quantity: soluongthe, emailnhan: $('#ctrlemailaddress').val() },
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
                                            $('#notifyresult strong').text('Success ');
                                            $('#notifyresult span').text("Giao dịch " + obj.data.message);
                                            //$('#tblcardinfo').show();
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
                                            sodutaikhoan();
                                            //$("#spansum .lenhrut b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                                            //$("#spansum .tienconlai b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
                                            //$("#spanmobile .lenhrutmb b").text(Intl.NumberFormat().format(obj.tongtien)).end();
                                            //$("#spanmobile .tienconlaimb b").text(Intl.NumberFormat().format(obj.tienconlai)).end();
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
                        } else {
                            $.ajax({
                                url: "/user/PaymentBuyCardUsesBank",
                                type: 'POST',
                                data: { bankCode: $('#buyCardPaymentMethod').attr('value'), providerId: manhamang, email: $('#ctrlemailaddress').val(), amount: menhgiathe, quantity: soluongthe },
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
                    }
                }
            }
            $('#tblcardinfo').show();
        });
        function validatethemloaithe() {
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



            return flag;

        }
        function validatemuanhieumathe() {
            var flag = true;
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
    });
    //$(function () {
    //    var bc = new BuyCard();
    //    bc.loadAllProvider();       
    //});
</script>
<ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li>Dịch vụ</li>
    <li class="active">Mua nhiều thẻ</li>
</ol>
<h2>Mua nhiều mã thẻ</h2>
<div class="col-md-3">
    <div class="section-title bg-lable1">
        Mua nhiều thẻ
    </div>
    <div class="form-content bg1">
        <form name="buycard" action="#" method="post">
            <div class="form-group">
                <div class="boxdrpmega">
                    <input class="txt nochange blur form-control" placeholder="Chọn nhà cung cấp" size="22" maxlength="40"
                           id="buyCardProvider" value="" name="buyCardProvider" type="text" title="" readonly>
                    <span class="dropDownListArrow down"></span>
                    <div style="display: none; text-transform: none !important" class="dropDownList">
                        <table rel="" style="" width="100%">
                            <tr>
                                <td colspan="10" class="last">
                                    <h3>
                                        Chọn nhà cung cấp
                                    </h3>
                                    <span class="separator"></span>
                                </td>
                            </tr>
                            <tr id="trprovider"></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="boxdrpmega">
                    <input class="txt nochange blur form-control" placeholder="Mệnh giá thẻ nạp" size="22" maxlength="40" id="buyCardAmount" val="" name="buyCardAmount" type="text" readonly>
                    <span class="dropDownListArrow down"></span>
                    <div style="display: none; text-transform: none !important" class="dropDownList" id="table_CardAmount">

                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" maxlength="40" id="ctrlsoluongthe" name="ctrlsoluongthe" value="" class="form-control txt" placeholder="Số lượng thẻ cần mua" title="Số lượng thẻ" />
            </div>            
            <div class="form-group divbt">
                <button type="button" class="btn btn-spec1 btn-md btn-block" id="ctrlthemnhieuthebtn">Thêm loại thẻ</button>
            </div>

        </form>
    </div>
</div>
<div class="col-md-9">
    <div class="classWithPad">
        <div class="section-title bg-lable1">
            THÔNG TIN DỊCH VỤ
        </div>
        <div class="form-content">
            <table id="tblmuanhieuthe" style=" color:#808080 !important;width:100%" >
                <tbody>
                    <tr class="trtieude">
                        <td style="text-align:center;width:130px;">
                            Mệnh giá
                        </td>
                        <td style="text-align:center;width:130px;">
                            Nhà cung cấp
                        </td>
                        <td style="text-align:center;width:130px;">
                            Số lượng
                        </td>    
                        <td style="text-align:center;width:110px;">
                            Chiết khấu
                        </td>
                        <td style="text-align:center;width:110px;">
                            Thành tiền
                        </td>                    
                        <td style="text-align:center">
                            Xóa
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="tbltongtien" style="color:#808080 !important;width:100%">
                <tr>
                    <td style="width:130px;">
                        
                    </td>
                    <td style="text-align:center;width:130px;">
                        <b>Tiền nạp</b>
                    </td>
                    <td style="text-align:center;width:130px;">
                        <span id="tongtien">0</span> VNĐ
                    </td>
                    <td style="text-align:center;width:110px;">
                        <b>Thanh toán</b>
                    </td>
                    <td style="width:110px;text-align:center;">
                         <span id="thanhtien">0</span> VNĐ
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
            <form name="frmmuanhieumathe" method="post" action="#">
           <div class="form-group">
                <input type="email" id="ctrlemailaddress" name="ctrlemailaddress" value="" class="form-control txt" placeholder="Địa chỉ email nhận mã thẻ" title="" />
                </div>
                <div class="form-group">
                    <div class="boxdrpmega">
                        <input class="txt nochange blur form-control" placeholder="Phương thức thanh toán" size="22" maxlength="40"
                               id="buyCardPaymentMethod" value="" name="buyCardPaymentMethod" type="text" title="">
                        <span class="dropDownListArrow down"></span>
                        <div style="display: none; text-transform: none !important" class="dropDownList">
                            <table>
                                <tbody>
                                    <tr align="left">
                                        <td colspan="4" class="last">
                                            <h4 class="fz14 fb700 cl333" style="text-transform: none">
                                                Thanh toán bằng tài khoản thành viên
                                            </h4>
                                            <span class="separator"></span>
                                        </td>
                                    </tr>
                                    <tr align="left">
                                        <td colspan="4" style="vertical-align:middle;height:40px;" class="last">
                                            <ul>
                                                <li>
                                                    <input txt="PayCard" rel="buyCardPaymentMethod" value="Paycard" id="buyCardPaymentMethodSelect_member" name="buyCardPaymentMethod" type="radio">
                                                    <label for="buyCardPaymentMethodSelect_member"><img src="/images/paycardvi.png" title="PayCard"></label>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="form-group divbt">
                    <button type="button" class="btn btn-spec1 btn-md btn-block" id="ctrlmuanhieuthebtn">Mua nhiều thẻ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--popup work start here-->
<!--Preview confirm buy card Start-->
<div class="modal fade" id="buycardpreviewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông tin giao dịch</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="panel-body">
                    <div class="row form-horizontal">
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4">Nhà cung cấp:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lblprovider"></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4">Loại thẻ:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lblcardtype"></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4">Số lượng:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lblsoluongthe"></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4">Địa chỉ Email nhận mã thẻ:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lblemail"></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4" id="lblpttt">Phương thức thanh toán:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lblpaymentmethod"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="Confirm_OrderDetail">
                        <div class="form-group col-sm-12">
                            <label class="col-sm-offset-4 col-sm-8"><h5>Vui lòng nhập thông tin tài khoản của bạn</h5></label>
                        </div>
                        <div class="col-sm-12">
                            <div class="alert alert-danger" id="divnotifybc">
                                <i class="fa fa-info-circle fa-lg"></i>
                                <span></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-4" for="ctrlemailtxt_log">Địa chỉ Email:<span class="asterisk_input"></span></label>
                            <div class="col-sm-7">
                                <input type="email" id="ctrlemailtxt_log" name="ctrlemailtxt_log" class="form-control" placeholder="Địa chỉ Email" value="">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-4" for="ctrlpasstxt_log">Mật khẩu:<span class="asterisk_input"></span></label>
                            <div class="col-sm-7">
                                <input type="password" id="ctrlpasstxt_log" name="ctrlpasstxt_log" class="form-control" placeholder="Mật khẩu" value="">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="col-sm-offset-4 col-sm-7">
                                <a class="pull-right" href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotyourpassword"><i>Quên mật khẩu</i></a>
                                <span class="pull-right">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                <a class="pull-right" href="/user/register"><i>Đăng ký</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-primary" id="ctrthanhtoanbtn" tabindex="1"><i class="fa fa-sign-in"></i> Thanh toán ngay</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="2"><i class="fa fa-times"></i>Hủy giao dịch</button>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Preview confirm buy card End-->
<!--Show result buy card Start-->
<div class="modal fade" id="buycardshowresultmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông báo giao dịch mua mã thẻ</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="panel-body">
                    <div class="">
                        <div id="notifyresult" class="alertx">
                            <i class="fa sign"></i><strong></strong><span></span>
                        </div>
                        <div class="divresult">
                            <table id="tblcardinfo" class="no-border">
                                <thead class="no-border">
                                    <tr>
                                        <th class="text-center">Loại thẻ</th>
                                        <th class="text-center">Mệnh giá</th>
                                        <th class="text-center">Mã số thẻ</th>
                                        <th class="text-center">Số serial thẻ</th>
                                    </tr>
                                </thead>
                                <tbody class="no-border-y"></tbody>
                            </table>
                            <div style="padding-top: 20px;"><span>Thời gian giao dịch: <span class="datetransaction"></span></span></div>
                        </div>

                    </div>

                    <div class="modalbottom">
                        <button type="button" class="btn btn-primary" id="ctrcontinuebtn" data-dismiss="modal" tabindex="1"><i class="fa fa-sign-in"></i> Tiếp tục mua</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
     </div> </div>
  </div>
</div>
  <? include ("../includes/inc_footer.php")?>  

</body>
</html>
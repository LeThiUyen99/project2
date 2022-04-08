<? include("config.php") ?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Mua thẻ điện thoại online, mua thẻ cào Viettel, Vina, Mobi giá rẻ</title>
   <meta name="description" content='Mua thẻ điện thoại online chiết khấu cao, thanh toán trực tuyến nhanh chóng, nạp tiền thuê bao di động, mua thẻ cào Viettel, Vina, Mobi bằng thẻ ATM, VISA.' />
   <meta name="keywords" content='Mua the cao, mua thẻ điện thoại, mua card online' />
   <meta name="robots" content='noodp,index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='https://banthe247.com/the-dien-thoai' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="/css/style.min2.css?v=3" />
  <link rel="stylesheet" type="text/css" href="/css/responsive.css" />  
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/common.js?v=1"></script>
  <script src="/js/usermanager.js"></script>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   
   
    <? include ("../includes/inc_header.php")?>

  <div class="container">
    <div class="row">
        <div style="clear:both;height:20px;"></div>
       <div class="col-md-8">
        <div class="section-title bg-lable1">
            <p style="font-size:17px;font-weight:bold;margin:0px;padding:0px;line-height:35px;">Mua mã thẻ điện thoại</p>
        </div>
        <div class="thedianthoai" style="padding-top:15px;">
            <form name="buycard" action="#" method="post">
                <div class="col-md-6" style="height:172px;position:relative;">
                    <div class="form-group">
                        <div class="boxdrpmega">
                            <input class="txt nochange blur form-control" placeholder="Chọn nhà cung cấp" size="22" maxlength="40"
                                   id="buyCardProvider" value="" name="buyCardProvider" type="text" title="" readonly>
                            <span class="dropDownListArrow down"></span>
                            <div style="display: none; text-transform: none !important" class="dropDownList">
                                <table rel="" style="" width="100%">
                                    <tr>
                                        <td colspan="10" class="last">
                                            <p>Chọn nhà cung cấp</p>
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
                   
                </div>
                <div class="col-md-6" style="height:172px;position:relative;">
                    
                    <div class="form-group">
                        <input type="email" id="ctrlemailaddress" name="ctrlemailaddress" value="" class="form-control txt" placeholder="Địa chỉ email nhận mã thẻ" title="" />
                    </div>
                    <div class="form-group">
                        <div class="boxdrpmega">
                            <input class="txt nochange blur form-control" placeholder="Phương thức thanh toán" size="22" maxlength="40"
                                   id="buyCardPaymentMethod" value="" name="buyCardPaymentMethod" type="text" title="" autocomplete="off">
                            <span class="dropDownListArrow down"></span>
                            <div style="display: none; text-transform: none !important" class="dropDownList">
                                <table>
                                    <tbody>
                                        <tr align="left">
                                            <td colspan="4" class="last">
                                                <p class="fz14 fb700 cl333" style="text-transform: none">
                                                    Thanh toán bằng tài khoản thành viên
                                                </p>
                                                <span class="separator"></span>
                                            </td>
                                        </tr>
                                        <tr align="left">
                                            <td colspan="4" style="vertical-align:middle;height:40px;" class="last">
                                                <ul>
                                                    <li>
                                                        <input txt="banthe247" rel="buyCardPaymentMethod" value="banthe247" id="buyCardPaymentMethodSelect_member" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethodSelect_member"><img src="/images/paycardvi.png" title="Nạp tiền điện thoại" alt="Nạp tiền điện thoại"></label>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr align="left" style="display: none;">
                                            <td colspan="4" class="last">
                                                <p class="fz14 fb700 cl333" style="text-transform: none">
                                                    Lựa chọn ngân hàng (có đăng ký Internet banking hoặc DV Thanh toán trực tuyến)
                                                </p>
                                                <span class="separator"></span>
                                            </td>
                                        </tr>
                                        <tr  style="display: none;">
                                            <td class="last">
                                                <ul>
                                                    <li>
                                                        <input txt="VietcomBank" rel="buyCardPaymentMethod" value="VIETCOMBANK" id="buyCardPaymentMethodSelect_vcb" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethodSelect_vcb"><img src="/images/vcb.png" alt="VietcomBank" title="VietcomBank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="Vietinbank" rel="buyCardPaymentMethod" value="VIETINBANK" id="buyCardPaymentMethod_ViettinBank" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_ViettinBank"><img src="/images/vtb.png" alt="Vietinbank" title="Vietinbank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="Đông Á Bank" rel="buyCardPaymentMethod" value="DONGABANK" id="buyCardPaymentMethod_DongABank" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_DongABank"><img src="/images/DongA.gif" alt="Đông Á Bank" title="Đông Á Bank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="NCB" rel="buyCardPaymentMethod" value="NCB" id="buyCardPaymentMethod_NCB" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_NCB">
                                                            <img src="/images/ncb.png" alt="NCB" title="NCB">
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input txt="AgriBank" rel="buyCardPaymentMethod" value="AGRIBANK" id="buyCardPaymentMethod_AGRIBANK" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_AGRIBANK"><img src="/images/agribank.jpg" alt="AGRIBANK" title="AGRIBANK"></label>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="last">
                                                <ul>
                                                    <li>
                                                        <input txt="Sacombank" rel="buyCardPaymentMethod" value="SACOMBANK" id="buyCardPaymentMethod_Sacombank" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_Sacombank"><img src="/images/scb.png" alt="Sacombank" title="Sacombank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="BIDV" rel="buyCardPaymentMethod" value="BIDV" id="buyCardPaymentMethod_bidv" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_bidv"><img src="/images/bidv.jpg" alt="BIDV" title="BIDV"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="Maritimebank" rel="buyCardPaymentMethod" value="MSBANK" id="buyCardPaymentMethod_mrt" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_mrt"><img src="/images/maritime.jpg" alt="Maritimebank" title="Maritimebank"></label>
                                                    </li>
                                                    <li>

                                                    </li>
                                                    <li>
                                                        <input txt="MBBANK" rel="buyCardPaymentMethod" value="MBBANK" id="buyCardPaymentMethod_MBBANK" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_MBBANK"><img src="/images/mb.png" alt="MBBANK" title="MBBANK"></label>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="last">
                                                <ul>
                                                    <li>
                                                        <input txt="Ocean Bank" rel="buyCardPaymentMethod" value="OJB" id="buyCardPaymentMethod_Ojb" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_Ojb"><img src="/images/ocean.png" alt="Ocean Bank" title="Ocean Bank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="Techcombank" rel="buyCardPaymentMethod" value="TECHCOMBANK" id="buyCardPaymentMethod_tcb" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_tcb"><img src="/images/tcb.png" alt="Techcombank" title="Techcombank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="Nam Á Bank" rel="buyCardPaymentMethod" value="NAMABANK" id="buyCardPaymentMethod_nab" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_nab"><img src="/images/NamABank.jpg" alt="Nam Á Bank" title="Nam Á Bank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="EXIMBANK" rel="buyCardPaymentMethod" value="EXIMBANK" id="buyCardPaymentMethod_EXIMBANK" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_EXIMBANK"><img src="/images/exb.png" alt="EXIMBANK" title="EXIMBANK"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="ACB" rel="buyCardPaymentMethod" value="ACB" id="buyCardPaymentMethod_ACB" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_ACB"><img src="/images/acb.png" alt="ACB" title="ACB"></label>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="last">
                                                <ul>
                                                    <li>
                                                        <input txt="HD Bank" rel="buyCardPaymentMethod" value="HDBANK" id="buyCardPaymentMethod_HDBank" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_HDBank"><img src="/images/hdb.png" alt="HD Bank" title="HD Bank"></label>
                                                    </li>
                                                    <li>

                                                    </li>
                                                    <li>
                                                        <input txt="TienPhongBank" rel="buyCardPaymentMethod" value="TPBANK" id="buyCardPaymentMethod_tpb" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_tpb"><img src="/images/tpb.jpg" alt="TienPhongBank" title="TienPhongBank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="OCB" rel="buyCardPaymentMethod" value="OCB" id="buyCardPaymentMethod_OCB" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_OCB"><img src="/images/ocb.png" alt="OCB" title="OCB"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="VPBANK" rel="buyCardPaymentMethod" value="VPBANK" id="buyCardPaymentMethod_VPBANK" name="buyCardPaymentMethod" type="radio">
                                                        <label for="buyCardPaymentMethod_ACB"><img src="/images/vpb.jpg" alt="VPBANK" title="VPBANK"></label>
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
                        <button type="button" class="btn btn-spec1 btn-md btn-block" id="ctrlmuathebtn" style="width:288px;">Mua thẻ ngay</button>
                        <!--<a style="display:block;text-align:right;padding-right:0px;margin-right:-10px;font-size:14px;" >&nbsp;</a>-->
                    </div>
                </div>
                

            </form>
        </div>
        <!--popup work start here-->
        <!--Preview confirm buy card Start-->
        
    </div>
    <div class="col-md-4" style="position: static;">
        <div class="section-title" style="font-size: 17px; font-weight: bold; margin: 0px; padding: 0px; line-height: 35px;">Thông tin giao dịch</div>
		<label class="control-label bold">* Bán thẻ cho GAME: <pre style="color:#ff0000;">
		<a rel="nofollow" style="color:#ff0000" href="http://banthe247.com/upload/API_mua_ma_the_banthe247.pdf">Tài liệu hướng dẫn tích hợp API mua thẻ tự động</a></pre></label>
        <div class="control-label">
            <label class="txtcon" id="lblnhamang"></label>
        </div>
        <div class="control-label">
            <label class="txtcon" id="lblmenhgiadt"></label>
        </div>
        <div class="control-label">
            <label class="txtcon" id="lblsoluongdt"></label>
        </div>
        <div class="control-label">
            <label class="txtcon" id="lblthanhtiendt"></label>
        </div>
        
        
        
        
    </div>
    <div class="noidungtrangchu"> <div class="" style="border: 1px solid #ccc; padding: 0px 3px;   overflow: hidden;    border-radius: 5px;">  
    <? include("../includes/home/inc_linktuychon1.php") ?>
      </div> </div>
  </div>
</div>
  <? include ("../includes/inc_footer.php")?>
  <div class="modal fade" id="buycardpreviewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thanh toán giao dịch</h4>
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
                                <label class="control-label col-sm-4">Email nhận mã thẻ:</label>
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
                            <div class="row" id="Confirm_BuyCardDetail">
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
                                    <label class="control-label col-sm-4" for="ctrlemailmuathetxt_log">Địa chỉ Email:<span class="asterisk_input"></span></label>
                                    <div class="col-sm-7">
                                        <input type="email" id="ctrlemailmuathetxt_log" name="ctrlemailmuathetxt_log" class="form-control" placeholder="Địa chỉ Email" value="">
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label class="control-label col-sm-4" for="ctrlpassmuathetxt_log">Mật khẩu:<span class="asterisk_input"></span></label>
                                    <div class="col-sm-7">
                                        <input type="password" id="ctrlpassmuathetxt_log" name="ctrlpassmuathetxt_log" class="form-control" placeholder="Mật khẩu" value="">
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
                                    <table id="buycardtblcardinfo" class="no-border" style="display:none !important;">
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
                                    <span id="xuatexel" class="btn btn-green">Chi tiết mã thẻ</span>
                                </div>

                            </div>

                            <div class="modalbottom">
                                <button type="button" class="btn btn-primary" id="ctrcontinuebtn" data-dismiss="modal" tabindex="1"><i class="fa fa-sign-in"></i> Thoát</button>
                                <a href="/thong-bao-mua-tcoin" rel="nofollow" type="button" class="btn btn-success charge_money"><i class="fa fa-money"></i> Nạp tiền vào tài khoản</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<script type="text/javascript">

    $(document).ready(function () {
        var bc = new BuyCard();
        bc.loadAllProvider();
          $('#buyCardAmount').on('change',function() {
                var thanhtien1 = $(this).attr('value');
                if (typeof ($("#lblmenhgiadt").text()) != "undefined") {
                
                }
            })
            
        $('.boxdrpmega input[name="buyCardProviderSelect"]').each(function () {
            $(this).change(function () {
                var nhamang = $(this).attr('value');
                var soluong1 = ($('#ctrlsoluongthe').val() == "") ? 0 : $('#ctrlsoluongthe').val();
                var menhgia1 = ($("#buyCardAmount").attr('value') == "") ? 0 : $("#buyCardAmount").attr('value');
                var thanhtien1 = menhgia1;
                if (nhamang == 1) {
                    $("#lblnhamang").html("Nhà mạng: <b style='color:#ff0000;'>Viettel</b>");
                     thanhtien1 = menhgia1 * soluong1 * 0.975;
                if (menhgia1 < 50000) {
                    thanhtien1 = menhgia1 * soluong1 * 0.995;
                }
                $("#lblthanhtiendt").html("Thành tiền: <b style='color:#ff0000;'>"+thanhtien1.toLocaleString('en-US', { minimumFractionDigits: 0 })+" VNĐ, Giảm:"+(menhgia1 * soluong1- thanhtien1).toLocaleString('en-US', { minimumFractionDigits: 0 })+"</b>");
            
                }
                if (nhamang == 2) {
                    $("#lblnhamang").html("Nhà mạng: <b style='color:#ff0000;'>Mobifone</b>");
                     thanhtien1 = menhgia1 * soluong1 * 0.965;
                if (menhgia1 < 50000) {
                    thanhtien1 = menhgia1 * soluong1 * 0.985;
                }
                $("#lblthanhtiendt").html("Thành tiền: <b style='color:#ff0000;'>"+thanhtien1.toLocaleString('en-US', { minimumFractionDigits: 0 })+" VNĐ, Giảm:"+(menhgia1 * soluong1- thanhtien1).toLocaleString('en-US', { minimumFractionDigits: 0 })+"</b>");
            
                }
                if (nhamang == 3) {
                    $("#lblnhamang").html("Nhà mạng: <b style='color:#ff0000;'>Vinaphone</b>");
                     thanhtien1 = menhgia1 * soluong1 * 0.965;
                if (menhgia1 < 50000) {
                    thanhtien1 = menhgia1 * soluong1 * 0.985;
                }
                $("#lblthanhtiendt").html("Thành tiền: <b style='color:#ff0000;'>"+thanhtien1.toLocaleString('en-US', { minimumFractionDigits: 0 })+" VNĐ, Giảm:"+(menhgia1 * soluong1- thanhtien1).toLocaleString('en-US', { minimumFractionDigits: 0 })+"</b>");
            
                }
                if (nhamang == 7) {
                    $("#lblnhamang").html("Nhà mạng: <b style='color:#ff0000;'>Vietnamobile</b>");
                     thanhtien1 = menhgia1 * soluong1 * 0.95;
                if (menhgia1 < 50000) {
                    thanhtien1 = menhgia1 * soluong1 * 0.97;
                }
                $("#lblthanhtiendt").html("Thành tiền: <b style='color:#ff0000;'>"+thanhtien1.toLocaleString('en-US', { minimumFractionDigits: 0 })+" VNĐ, Giảm:"+(menhgia1 * soluong1- thanhtien1).toLocaleString('en-US', { minimumFractionDigits: 0 })+"</b>");
            
                }
                

            });
        });
        
        $('#ctrlsoluongthe').keyup(function (e) {
            $('#lblsoluongdt').html("Số lượng: <b style='color:#ff0000;'>" +this.value +"</b>");
            var nhamang1 = ($("#buyCardProvider").attr('value')=="")?0:$("#buyCardProvider").attr('value');
            var soluong1 = $(this).val();
            var menhgia1 = ($("#buyCardAmount").attr('value')=="")?0:$("#buyCardAmount").attr('value');
            var thanhtien1 = menhgia1;
            if (nhamang1 == 1) {
                thanhtien1 = menhgia1 * soluong1 * 0.975;
                if (menhgia1 < 50000) {
                    thanhtien1 = menhgia1 * soluong1 * 0.995;
                }
                $("#lblthanhtiendt").html("Thành tiền: <b style='color:#ff0000;'>"+thanhtien1.toLocaleString('en-US', { minimumFractionDigits: 0 })+" VNĐ, Giảm:"+(menhgia1 * soluong1- thanhtien1).toLocaleString('en-US', { minimumFractionDigits: 0 })+"</b>");
            }
            if (nhamang1 == 2) {
                thanhtien1 = menhgia1 * soluong1 * 0.965;
                if (menhgia1 < 50000) {
                    thanhtien1 = menhgia1 * soluong1 * 0.985;
                }
                $("#lblthanhtiendt").html("Thành tiền: <b style='color:#ff0000;'>" + thanhtien1.toLocaleString('en-US', { minimumFractionDigits: 0 }) + " VNĐ, Giảm:"+(menhgia1 * soluong1- thanhtien1).toLocaleString('en-US', { minimumFractionDigits: 0 })+"</b>");
            }
            if (nhamang1 == 3) {
                thanhtien1 = menhgia1 * soluong1 * 0.965;
                if (menhgia1 < 50000) {
                    thanhtien1 = menhgia1 * soluong1 * 0.985;
                }
                $("#lblthanhtiendt").html("Thành tiền: <b style='color:#ff0000;'>" + thanhtien1.toLocaleString('en-US', { minimumFractionDigits: 0 }) + " VNĐ, Giảm:"+(menhgia1 * soluong1- thanhtien1).toLocaleString('en-US', { minimumFractionDigits: 0 })+"</b>");
            }
            if (nhamang1 == 7) {
                thanhtien1 = menhgia1 * soluong1 * 0.95;
                if (menhgia1 < 50000) {
                    thanhtien1 = menhgia1 * soluong1 * 0.97;
                }
                $("#lblthanhtiendt").html("Thành tiền: <b style='color:#ff0000;'>" + thanhtien1.toLocaleString('en-US', { minimumFractionDigits: 0 }) + " VNĐ, Giảm:"+(menhgia1 * soluong1- thanhtien1).toLocaleString('en-US', { minimumFractionDigits: 0 })+"</b>");
            }
            $("#lblmenhgiadt").html("Nhà mạng: <b style='color:#ff0000;'>"+menhgia1.toLocaleString('en-US', { minimumFractionDigits: 0 })+" VNĐ</b>");
                
        });
    });


    setTimeout(function(){
          $('#buyCardPaymentMethodSelect_member').prop('checked', true);
          $('#buyCardPaymentMethod').val('banthe247').attr('value', 'banthe247');  
    }, 100);

</script>
</body>
</html>
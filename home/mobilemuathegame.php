<?
include("config.php");

$userinfourl=$_SERVER['REQUEST_URI'];

$urluri="/mobile/muathegame";
if($userinfourl != $urluri)
{
   header("HTTP/1.1 301 Moved Permanently"); 
   header("Location: $urluri");
   exit();
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Mua thẻ game tại banthe247.com</title>
   <meta name="description" content='Mua thẻ game tại banthe247.com' />
   <meta name="keywords" content='Mua thẻ game tại banthe247.com' />
   <meta name="robots" content='noodp,noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='https://banthe247.com/mobile/muathegame' />
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
<body class="mobile">
   <!--header section work start-->        
   <? include("../includes/inc_header.php") ?>
   <div class="container">
    <div class="divcontent1 row">
     <div class="col-md-12 col-sm-12">
      <div class="section-title bg-lable3" style="clear: both;   background: #e05649;">
        <h2 style="font-size:15px;margin:0px;line-height:37px;">MUA MÃ THẺ GAME,VIRUS,3G DATA</h2> </div>
        <div class="form-content bg1">
         <form name="buycard" action="#" method="post">
           <div class="form-group">
            <select id="mobileproviderdrp" class="form-control" tabindex="1"></select>
          </div>
          <div class="form-group">
            <select id="ctrlmobilemenhgiadrp" class="form-control" tabindex="2"><option value="0">Chọn mệnh giá thẻ</option></select>
          </div>
          <div class="form-group">
             <input type="text" maxlength="40" id="ctrlsoluongthe" name="ctrlsoluongthe" value="" class="form-control" placeholder="Số lượng thẻ cần mua" title="Số lượng thẻ" tabindex="3" /> </div>
           <div class="form-group">
            <input type="email" id="ctrlemailaddress" name="ctrlemailaddress" value="" class="form-control" placeholder="Địa chỉ email nhận mã thẻ" title="" tabindex="4" /> </div>
            <div class="form-group">
              <select id="ctrlmobilenganhangdrp" class="form-control" tabindex="5">
                <option selected="selected" value="0">Chọn ngân hàng</option>
                <option value="banthe24h">Vi Banthe24h</option>
                <option value="vietcombank">Vietcombank</option>
                <option value="vietinbank">Vietinbank</option>
                <option value="DONGABANK">Đông Á Bank</option>
                <option value="SACOMBANK">Sacombank</option>
                <option value="BIDV">BIDV</option>
                <option value="MSBANK">Maritimebank</option>
                <option value="OJB">Ocean Bank</option>
                <option value="TECHCOMBANK">Techcombank</option>
                <option value="NAMABANK">Nam Á Bank</option>
                <option value="HDBANK">HD Bank</option>
                <option value="VNMART">VnMart</option>
                <option value="TPBANK">Tiên Phong Bank</option>

            </select>
            </div>
            <div class="form-group divbt">
              <button type="button" class="btn btn-green btn-md btn-block" id="ctrlmobilemuathebtn" tabindex="6">Mua thẻ ngay</button>
            </div>
            <div class="modal fade" id="buycardpreviewmodal" aria-hidden="true">
             <div class="modal-dialog modal-md">
               <div class="panel panel-primary">
                 <div class="panel-heading">
                   <div style="font-weight: bold;" class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i> Thông tin giao dịch</div>
                 </div>
                 <form class="form-horizontal" role="form">
                   <div class="panel-body">
                     <div class="row form-horizontal">
                       <div class="col-sm-12">
                         <label class="control-label col-sm-4">Nhà cung cấp:</label>
                         <div class="col-sm-7">
                           <label class="txtcon" id="lblncc"></label>
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
                         <label class="txtcon" id="lblsoluong"></label>
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
                       <label class="txtcon" id="lblphuongthuc"></label>
                     </div>
                   </div>
                 </div>
                 <div class="row" id="Confirm_OrderDetail">
                  <div class="form-group col-sm-12">
                    <label class="col-sm-offset-4 col-sm-8">
                      <div style="font-weight: bold;">Vui lòng nhập thông tin tài khoản của bạn</div>
                    </label>
                  </div>

                  <div class="form-group col-sm-12">
                   <label class="control-label col-sm-4">Địa chỉ Email:<span class="asterisk_input"></span></label>
                   <div class="col-sm-7">
                     <input type="email" id="ctrlemailtxt_log" name="ctrlemailtxt_log" class="form-control" placeholder="Địa chỉ Email" value=""> </div>
                   </div>
                   <div class="form-group col-sm-12">
                     <label class="control-label col-sm-4">Mật khẩu:<span class="asterisk_input"></span></label>
                     <div class="col-sm-7">
                       <input type="password" id="ctrlpasstxt_log" name="ctrlpasstxt_log" class="form-control" placeholder="Mật khẩu" value=""> </div>
                     </div>
                     <div class="form-group col-sm-12">
                       <div class="col-sm-offset-4 col-sm-7"> <a class="pull-right" href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotyourpassword"><i>Quên mật khẩu</i></a> <span class="pull-right">|</span> <a class="pull-right" href="#"><i>Đăng ký</i></a> </div>
                     </div>
                   </div>
                 </div>
                 <div class="panel-footer text-center">
                   <button type="button" class="btn btn-primary" id="ctrthanhtoanbtn"  tabindex="1"><i class="fa fa-sign-in"></i> Thanh toán ngay</button>
                   <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="2"><i class="fa fa-times"></i> Hủy giao dịch</button>
                   <div class="clearfix"></div>
                 </div>
               </form>
             </div>
           </div>
         </div>
       </div>


       <div class="table-responsive">
        <table width="100%" class="table">
          <tbody>
            <tr class="bg-lable2">
              <td colspan="6"  class="text-center">
                <p class="text-center"> <strong>Bảng giá dành cho khách đăng ký thành viên của Banthe247.com </strong> <span style="display:block;text-transform:none;font-weight:normal;">(Chỉ cần 1.000.000 đ bạn có thể trở thành đại lý của banthe247, chi tiết xem <a href="#" style="color:#ff0000">tại đây</a>)</span> </p>
              </td>
            </tr>
            <tr>
              <td><strong>Thẻ điện thoại</strong></span> </td>
              <td><strong>Viettel </strong></span> </td>
              <td><strong>Mobifone </strong></span> </td>
              <td><strong>Vinaphone </strong></span> </td>
              <td><strong>Gmobile</strong></span> </td>
              <td><strong>Vietnamobile</strong></span> </td>
            </tr>
            <tr>
              <td> Chiết khấu </td>
              <td> 5.0% </td>
              <td> 5.1% </td>
              <td> 5.1% </td>
              <td> 5.6% </td>
              <td> 6.2% </td>
            </tr>
            <tr>
              <td><strong>Thẻ Game</strong></span> </td>
              <td><strong>Vcoin </strong></span> </td>
              <td><strong>Gate / Zing </strong></span> </td>
              <td><strong>On cash </strong></span> </td>
              <td><strong>Thẻ BIT</strong></span> </td>
              <td><strong>Sò Garena</strong></span> </td>
            </tr>
            <tr>
              <td> Chiết khấu </td>
              <td> 5.0% </td>
              <td> 5.0% </td>
              <td> 6.8% </td>
              <td> 6.3% </td>
              <td> 5.0% </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
   
   
   
   <? include("../includes/inc_footer.php") ?>
<script type="text/javascript">
    $(function () {
        var bc = new MobileBuyCard();
        bc.loadprovider1();
        bc.init();
    });
</script>
</body>
</html>
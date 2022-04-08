<?
include("config.php");

$userinfourl=$_SERVER['REQUEST_URI'];

$urluri="/mobile/nap-tien-dien-thoai";
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
   <title>Nap tien dien thoai</title>
   <meta name="description" content='Nap tien dien thoai' />
   <meta name="keywords" content='Nap tien dien thoai' />
   <meta name="robots" content='index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe24h.vn" />
   <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
   <link rel="canonical" href='https://banthe24h.vn/' />
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
        <div class="section-title bg-lable1" style="clear: both;">
          <h2 style="font-size:18px;margin:0px;line-height:37px;">Nạp tiền điện thoại</h2> </div>
          <div class="form-content bg1">
           <form name="buycard" action="#" method="post">
             <div class="form-group">
              <input type="text" maxlength="14" id="ctrlSoDienThoai_naptiendt" name="ctrlSoDienThoai_naptiendt" value="" class="form-control" placeholder="Số điện thoại" title="Số điện thoại" tabindex="1" />
            </div>
            <div class="form-group">
              <div class="boxdrpmega">
                <input class="txt nochange blur form-control" placeholder="Loại thuê bao" size="22" maxlength="40" id="mobiletopuptype" val="" name="mobiletopuptype" type="text" readonly>
                <span class="dropDownListArrow down"></span>
                <div style="display: none; text-transform: none !important" class="dropDownList" id="table_topuptopuptype">
                    <table rel="" style="" width="100%">
                        <tbody>
                            <tr id="trprovider"><td><p><input id="mobiletopuptype_1" name="mobiletopuptype" rel="mobiletopuptype" value="TT" txt="Trả trước" type="radio" class="left">&nbsp;<label class="left mL5" for="mobiletopuptype_1">Trả trước</label><span class="separator"></span></p><p><input id="mobiletopuptype_2" name="mobiletopuptype" rel="mobiletopuptype" value="TS" txt="Trả sau" type="radio" class="left">&nbsp;<label class="left mL5" for="mobiletopuptype_2">Trả sau</label><span class="separator"></span></p></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            <div class="form-group">
             <select id="mobilemanhgiathe_naptiendt" class="form-control" tabindex="2"></select> </div>
             <div class="form-group">
              <input type="email" id="ctrlnapdienthoaiemailaddress_naptiendt" name="ctrlnapdienthoaiemailaddress_naptiendt" value="" class="form-control" placeholder="Email (Không bắt buộc)" title="" tabindex="3"/> </div>
              <div class="form-group">
                <select id="ctrlmobilenganhangdrp_naptiendt" class="form-control" tabindex="4">
                    <option selected="selected" value="0">Chọn ngân hàng</option>
                    <option value="banthe24h">Vi Banthe24h</option>
<!--                <option value="vietcombank">Vietcombank</option>
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
    				        <option value="ACB">ACB Bank</option> -->
                </select>
              </div>
              <div class="form-group divbt">
                <button type="button"  class="btn btn-spec1 btn-md btn-block" id="ctrlnaptiendienthoaibtn_naptiendt" tabindex="5">Nạp tiền ngay</button>
              </div>
              <div class="modal fade" id="naptiendienthoaipreviewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông tin giao dịch</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="panel-body">
                    <div class="row form-horizontal">
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4">Số điện thoại:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lblphone"></label>
                            </div>
                        </div>
                       
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4">Mệnh giá:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lblmenhgia"></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4">Địa chỉ Email nhận mã thẻ:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lbltopupemail"></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4" id="lblpttt">Phương thức thanh toán:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lbltopuppaymentmethod"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="Confirm_OrderDetail">
                        <div class="form-group col-sm-12">
                            <label class="col-sm-offset-4 col-sm-8"><h5>Vui lòng nhập thông tin tài khoản của bạn</h5></label>
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
                                <a class="pull-right" href="/User/register"><i>Đăng ký</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-primary" id="ctrthanhtoanbtn_mobile" tabindex="1"><i class="fa fa-sign-in"></i> Thanh toán ngay</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="2"><i class="fa fa-times"></i>Hủy giao dịch</button>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>
         </div>

       <div class="table-responsive">
    <table width="100%" border="1" class="table table-bordered table-striped mT20 table-bordered-green">
        <tbody>
            <tr class="bg-lable2">
                <td colspan="6" align="center" valign="middle" class="text-center textCASE fz13 fb clfff pdt10 pdb10">
                    <p class="text-center"> <strong>Bảng giá dành cho khách đăng ký thành viên của Banthe24h.vn </strong> <span style="display:block;text-transform:none;font-weight:normal;">(Chỉ cần 1.000.000 đ bạn có thể trở thành đại lý của banthe24h, chi tiết xem <a href="http://banthe24h.vn/Dai-ly/kinh-doanh-la-dai-ly-the-cao-chi-voi-1-trieu-dong-tai-banthe24h-4050.html" style="color:#ff0000">tại đây</a>)</span> </p>
                </td>
            </tr>
            <tr>
                <td align="center" valign="middle"> <span class="cl0098de"><strong>Nạp tiền điện thoại</strong></span> </td>
                <td align="center" valign="middle"> <span class="cl0098de"><strong>Viettel </strong></span> </td>
                <td align="center" valign="middle"> <span class="cl0098de"><strong>Mobifone </strong></span> </td>
                <td align="center" valign="middle"> <span class="cl0098de"><strong>Vinaphone </strong></span> </td>
                <td align="center" valign="middle"> <span class="cl0098de"><strong>Gmobile</strong></span> </td>
                <td align="center" valign="middle"> <span class="cl0098de"><strong>Vietnamobile</strong></span> </td>
            </tr>
            <tr>
                <td align="left"> Chiết khấu </td>
                <td align="center"> -% </td>
                <td align="right"> 4% </td>
                <td align="right"> 4% </td>
                <td align="right"> -% </td>
                <td align="center"> -% </td>
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
        var bc = new MobileNapTienDienThoai();
        bc.init();
    });
</script>
</body>
</html>
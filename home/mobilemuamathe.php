<?
include("config.php");

$userinfourl=$_SERVER['REQUEST_URI'];

$urluri="/mobile/mua-ma-the";
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
   <title>Mua ma the</title>
   <meta name="description" content='Mua ma the. Hỗ trợ 24/7' />
   <meta name="keywords" content='Mua ma the. Hỗ trợ 24/7' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='https://banthe247.com/' />
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
   <div class="row">
        <div class="divcontent1"></div>
        <div class="col-md-12 col-sm-12">
        <div class="section-title bg-lable2">
          <h2 style="font-size:18px;margin:0px;line-height:37px;">Mua mã thẻ điện thoại</h2> </div>
          <div class="form-content bg1">
           <form name="buycard" action="#" method="post">
             <div class="form-group">
              <select id="mobileproviderdrp" class="form-control" tabindex="1"></select>
            </div>
            <div class="form-group">
              <select id="ctrlmobilemenhgiadrp" class="form-control" tabindex="2"><option value="0">Chọn mệnh giá thẻ</option></select>
            </div>
            <div class="form-group">
             <input type="text" maxlength="40" id="ctrlsoluongthe" name="ctrlsoluongthe" value="" class="form-control" placeholder="Số lượng thẻ cần mua" title="Số lượng thẻ" tabindex="3" />
              </div>
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
                <button type="button" class="btn btn-green btn-block" data-toggle="modal" data-target="#buycardgamepreviewmodal" id="ctrlmuathegamebtn">Mua thẻ ngay</button>
              </div>
              <div class="modal fade" id="buycardgamepreviewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
       </div>
       
        <div class="col-md-12 col-sm-12">
       <div style="float:left;width:100%;">
         <table border="1" class="table table-bordered table-striped mT20 table-bordered-green" width="100%">
           <tbody>
             <tr class="bg-lable2">
               <td align="center" class="text-center textCASE fz13 fb clfff pdt10 pdb10" valign="middle">
                 <p class="text-center" style="margin: 0 0 0px;text-transform: uppercase;"> Bảng chiết khấu khi mua thẻ</p> <span style="font-weight:normal;text-transform:none;">(Dành cho khách hàng là thành viên của hệ thống banthe24h.vn)</span></td>
               </tr>
               <tr>
                 <td style="padding-left:0px;padding-right:0px;padding-top:0px;">
                   <div class="panel-group" id="accordion">
                     <div class="panel panel-default">
                       <div class="panel-heading">
                         <div class="panel-title"> <a aria-expanded="true" data-parent="#accordion" data-toggle="collapse" href="#collapse1">Mua thẻ Viettel </a></div>
                       </div>
                       <div aria-expanded="true" class="panel-collapse collapse in" id="collapse1">
                         <div class="panel-body">
                           <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                             <thead>
                               <tr>
                                 <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                                 <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                                 <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                                 <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                               </tr>
                             </thead>
                             <tbody>
                              <tr>
                                <td style="text-align: center;"> Viettel</td>
                                <td style="text-align: center;"> 500.0000 VNĐ</td>
                                <td style="text-align: center;"> 2.5%</td>
                                <td style="text-align: center;"> 487.500 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Viettel</td>
                                <td style="text-align: center;"> 300.0000 VNĐ</td>
                                <td style="text-align: center;"> 2.5%</td>
                                <td style="text-align: center;"> 292.500 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Viettel</td>
                                <td style="text-align: center;"> 200.0000 VNĐ</td>
                                <td style="text-align: center;"> 2.5%</td>
                                <td style="text-align: center;"> 195.000 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Viettel</td>
                                <td style="text-align: center;"> 100.0000 VNĐ</td>
                                <td style="text-align: center;"> 2.5%</td>
                                <td style="text-align: center;"> 97.500 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Viettel</td>
                                <td style="text-align: center;"> 50.000 VNĐ</td>
                                <td style="text-align: center;"> 2.5%</td>
                                <td style="text-align: center;"> 48.750 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Viettel</td>
                                <td style="text-align: center;"> 30.000 VNĐ</td>
                                <td style="text-align: center;"> 0.5%</td>
                                <td style="text-align: center;"> 29.850 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Viettel</td>
                                <td style="text-align: center;"> 20.000 VNĐ</td>
                                <td style="text-align: center;"> 0.5%</td>
                                <td style="text-align: center;"> 19.900 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Viettel</td>
                                <td style="text-align: center;"> 10.000 VNĐ</td>
                                <td style="text-align: center;"> 0.5%</td>
                                <td style="text-align: center;"> 9.950 VNĐ</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <div class="panel-title"> <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse2">Mua thẻ Mobifone </a></div>
                      </div>
                      <div aria-expanded="false" class="panel-collapse collapse" id="collapse2">
                        <div class="panel-body">
                          <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                            <thead>
                              <tr>
                                <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                                <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                                <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                                <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                              </tr>
                            </thead>
                            <tbody>
                             <tr>
                               <td style="text-align: center;"> Mobifone</td>
                               <td style="text-align: center;"> 500.0000 VNĐ</td>
                               <td style="text-align: center;"> 3.5%</td>
                               <td style="text-align: center;"> 482.500VNĐ</td>
                             </tr>
                             <tr>
                               <td style="text-align: center;"> Mobifone</td>
                               <td style="text-align: center;"> 300.0000 VNĐ</td>
                               <td style="text-align: center;"> 3.5%</td>
                               <td style="text-align: center;"> 289.500 VNĐ</td>
                             </tr>
                             <tr>
                               <td style="text-align: center;"> Mobifone</td>
                               <td style="text-align: center;"> 200.0000 VNĐ</td>
                               <td style="text-align: center;"> 3.5%</td>
                               <td style="text-align: center;"> 193.000 VNĐ</td>
                             </tr>
                             <tr>
                               <td style="text-align: center;"> Mobifone</td>
                               <td style="text-align: center;"> 100.0000 VNĐ</td>
                               <td style="text-align: center;"> 3.5%</td>
                               <td style="text-align: center;"> 96.500 VNĐ</td>
                             </tr>
                             <tr>
                               <td style="text-align: center;"> Mobifone</td>
                               <td style="text-align: center;"> 50.000 VNĐ</td>
                               <td style="text-align: center;"> 3.5%</td>
                               <td style="text-align: center;"> 48.250 VNĐ</td>
                             </tr>
                             <tr>
                               <td style="text-align: center;"> Mobifone</td>
                               <td style="text-align: center;"> 30.000 VNĐ</td>
                               <td style="text-align: center;"> 1.5%</td>
                               <td style="text-align: center;"> 29.550 VNĐ</td>
                             </tr>
                             <tr>
                               <td style="text-align: center;"> Mobifone</td>
                               <td style="text-align: center;"> 20.000 VNĐ</td>
                               <td style="text-align: center;"> 1.5%</td>
                               <td style="text-align: center;"> 19.700 VNĐ</td>
                             </tr>
                             <tr>
                               <td style="text-align: center;"> Mobifone</td>
                               <td style="text-align: center;"> 10.000 VNĐ</td>
                               <td style="text-align: center;"> 1.5%</td>
                               <td style="text-align: center;"> 9.850 VNĐ</td>
                             </tr>
                           </tbody>
                         </table>
                       </div>
                     </div>
                   </div>
                   <div class="panel panel-default">
                     <div class="panel-heading">
                       <div class="panel-title"> <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse3">Mua thẻVinaphone </a></div>
                     </div>
                     <div aria-expanded="false" class="panel-collapse collapse" id="collapse3">
                       <div class="panel-body">
                         <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                           <thead>
                             <tr>
                               <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                               <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                               <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                               <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                             </tr>
                           </thead>
                           <tbody>
                            <tr>
                              <td style="text-align: center;"> Vinaphone</td>
                              <td style="text-align: center;"> 500.0000 VNĐ</td>
                              <td style="text-align: center;"> 3.5%</td>
                              <td style="text-align: center;"> 482.500VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Vinaphone</td>
                              <td style="text-align: center;"> 300.0000 VNĐ</td>
                              <td style="text-align: center;"> 3.5%</td>
                              <td style="text-align: center;"> 289.500VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Vinaphone</td>
                              <td style="text-align: center;"> 200.0000 VNĐ</td>
                              <td style="text-align: center;"> 3.5%</td>
                              <td style="text-align: center;"> 193.000VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Vinaphone</td>
                              <td style="text-align: center;"> 100.0000 VNĐ</td>
                              <td style="text-align: center;"> 3.5%</td>
                              <td style="text-align: center;"> 96.500VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Vinaphone</td>
                              <td style="text-align: center;"> 50.000 VNĐ</td>
                              <td style="text-align: center;"> 3.5%</td>
                              <td style="text-align: center;"> 48.250VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Vinaphone</td>
                              <td style="text-align: center;"> 30.000 VNĐ</td>
                              <td style="text-align: center;"> 1.5%</td>
                              <td style="text-align: center;"> 29.550VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Vinaphone</td>
                              <td style="text-align: center;"> 20.000 VNĐ</td>
                              <td style="text-align: center;"> 1.5%</td>
                              <td style="text-align: center;"> 19.700VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Vinaphone</td>
                              <td style="text-align: center;"> 10.000 VNĐ</td>
                              <td style="text-align: center;"> 1.5%</td>
                              <td style="text-align: center;"> 9.850 VNĐ</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                   <div class="panel-heading">
                     <div class="panel-title"> <a aria-expanded="false" class="collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse5">Mua thẻ VietNammobile </a></div>
                   </div>
                   <div aria-expanded="false" class="panel-collapse collapse" id="collapse5">
                     <div class="panel-body">
                       <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                         <thead>
                           <tr>
                             <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                             <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                             <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                             <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td style="text-align: center;"> VietNammobile</td>
                            <td style="text-align: center;"> 500.0000 VNĐ</td>
                            <td style="text-align: center;"> 5%</td>
                            <td style="text-align: center;"> 475.000 VNĐ</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> VietNammobile</td>
                            <td style="text-align: center;"> 300.0000 VNĐ</td>
                            <td style="text-align: center;"> 5%</td>
                            <td style="text-align: center;"> 285.000 VNĐ</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> VietNammobile</td>
                            <td style="text-align: center;"> 200.0000 VNĐ</td>
                            <td style="text-align: center;"> 5%</td>
                            <td style="text-align: center;"> 190.000 VNĐ</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> VietNammobile</td>
                            <td style="text-align: center;"> 100.0000 VNĐ</td>
                            <td style="text-align: center;"> 5%</td>
                            <td style="text-align: center;"> 95.000 VNĐ</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> VietNammobile</td>
                            <td style="text-align: center;"> 50.000 VNĐ</td>
                            <td style="text-align: center;"> 5%</td>
                            <td style="text-align: center;"> 47.500 VNĐ</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> VietNammobile</td>
                            <td style="text-align: center;"> 30.000 VNĐ</td>
                            <td style="text-align: center;"> 3%</td>
                            <td style="text-align: center;"> 29.100 VNĐ</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> VietNammobile</td>
                            <td style="text-align: center;"> 20.000 VNĐ</td>
                            <td style="text-align: center;"> 3%</td>
                            <td style="text-align: center;"> 19.400 VNĐ</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> VietNammobile</td>
                            <td style="text-align: center;"> 10.000 VNĐ</td>
                            <td style="text-align: center;"> 3%</td>
                            <td style="text-align: center;"> 9.700 VNĐ</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                 <div class="panel-heading gamecard">
                   <div class="thegame" data-parent="#accordion" data-toggle="collapse" href="#collapseThree">
                     <p class="text-center" style="margin: 0 0 0px;text-transform: uppercase; color: red"> Chiết khấu thẻ game</p> <span style="font-weight:normal;text-transform:none;">( Dành cho khách hàng đã đăng ký tài khoản banthe24h.vn )</span></div>
                   </div>
                   <div class="panel-collapse collapse" id="collapseThree">
                     <div class="panel-body">
                       <div class="panel-group" id="accordion2">
                         <div class="panel panel-default">
                           <div class="panel-heading tuychonthe">
                             <div class="panel-title "> <a aria-expanded="true" data-parent="#accordion2" data-toggle="collapse" href="#collapse4">Mua thẻ Gate (FPT) </a></div>
                           </div>
                           <div aria-expanded="true" class="panel-collapse collapse in" id="collapse4">
                             <div class="panel-body">
                               <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                                 <thead>
                                   <tr>
                                     <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                                     <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                                     <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                                     <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                  <tr>
                                    <td style="text-align: center;"> FPT</td>
                                    <td style="text-align: center;"> 500.0000 VNĐ</td>
                                    <td style="text-align: center;"> 3.5%</td>
                                    <td style="text-align: center;"> 482.500VNĐ</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center;"> FPT</td>
                                    <td style="text-align: center;"> 200.0000 VNĐ</td>
                                    <td style="text-align: center;"> 3.5%</td>
                                    <td style="text-align: center;"> 193.000VNĐ</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center;"> FPT</td>
                                    <td style="text-align: center;"> 100.0000 VNĐ</td>
                                    <td style="text-align: center;"> 3.5%</td>
                                    <td style="text-align: center;"> 96.500VNĐ</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center;"> FPT</td>
                                    <td style="text-align: center;"> 50.000 VNĐ</td>
                                    <td style="text-align: center;"> 3.5%</td>
                                    <td style="text-align: center;"> 48.250VNĐ</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center;"> FPT</td>
                                    <td style="text-align: center;"> 20.000 VNĐ</td>
                                    <td style="text-align: center;"> 1.5%</td>
                                    <td style="text-align: center;"> 19.700VNĐ</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center;"> FPT</td>
                                    <td style="text-align: center;"> 10.000 VNĐ</td>
                                    <td style="text-align: center;"> 1.5%</td>
                                    <td style="text-align: center;"> 9.850VNĐ</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                         <div class="panel-heading tuychonthe">
                           <div class="panel-title"> <a aria-expanded="false" class="collapsed" data-parent="#accordion2" data-toggle="collapse" href="#collapse6">Mua thẻ Zing </a></div>
                         </div>
                         <div aria-expanded="false" class="panel-collapse collapse" id="collapse6">
                           <div class="panel-body">
                             <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                               <thead>
                                 <tr>
                                   <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                                   <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                                   <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                                   <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                                 </tr>
                               </thead>
                               <tbody>
                                <tr>
                                  <td style="text-align: center;"> Zing</td>
                                  <td style="text-align: center;"> 500.0000 VNĐ</td>
                                  <td style="text-align: center;"> 3.5%</td>
                                  <td style="text-align: center;"> 482.500VNĐ</td>
                                </tr>
                                <tr>
                                  <td style="text-align: center;"> Zing</td>
                                  <td style="text-align: center;"> 200.0000 VNĐ</td>
                                  <td style="text-align: center;"> 3.5%</td>
                                  <td style="text-align: center;"> 193.000VNĐ</td>
                                </tr>
                                <tr>
                                  <td style="text-align: center;"> Zing</td>
                                  <td style="text-align: center;"> 100.0000 VNĐ</td>
                                  <td style="text-align: center;"> 3.5%</td>
                                  <td style="text-align: center;"> 96.500 VNĐ</td>
                                </tr>
                                <tr>
                                  <td style="text-align: center;"> Zing</td>
                                  <td style="text-align: center;"> 50.000 VNĐ</td>
                                  <td style="text-align: center;"> 3.5%</td>
                                  <td style="text-align: center;"> 48.250VNĐ</td>
                                </tr>
                                <tr>
                                  <td style="text-align: center;"> Zing</td>
                                  <td style="text-align: center;"> 20.000 VNĐ</td>
                                  <td style="text-align: center;"> 1.5%</td>
                                  <td style="text-align: center;"> 19.700VNĐ</td>
                                </tr>
                                <tr>
                                  <td style="text-align: center;"> Zing</td>
                                  <td style="text-align: center;"> 10.000 VNĐ</td>
                                  <td style="text-align: center;"> 1.5%</td>
                                  <td style="text-align: center;"> 9.850VNĐ</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                       <div class="panel-heading tuychonthe">
                         <div class="panel-title"> <a aria-expanded="false" class="collapsed" data-parent="#accordion2" data-toggle="collapse" href="#collapse7">Mua thẻ Garena </a></div>
                       </div>
                       <div aria-expanded="false" class="panel-collapse collapse" id="collapse7">
                         <div class="panel-body">
                           <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                             <thead>
                               <tr>
                                 <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                                 <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                                 <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                                 <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                               </tr>
                             </thead>
                             <tbody>
                              <tr>
                                <td style="text-align: center;"> Garena</td>
                                <td style="text-align: center;"> 500.0000 VNĐ</td>
                                <td style="text-align: center;"> 3.5%</td>
                                <td style="text-align: center;"> 482.500 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Garena</td>
                                <td style="text-align: center;"> 200.0000 VNĐ</td>
                                <td style="text-align: center;"> 3.5%</td>
                                <td style="text-align: center;"> 193.000 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Garena</td>
                                <td style="text-align: center;"> 100.0000 VNĐ</td>
                                <td style="text-align: center;"> 3.5%</td>
                                <td style="text-align: center;"> 96.500 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Garena</td>
                                <td style="text-align: center;"> 50.000 VNĐ</td>
                                <td style="text-align: center;"> 3.5%</td>
                                <td style="text-align: center;"> 48.250 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> Garena</td>
                                <td style="text-align: center;"> 20.000 VNĐ</td>
                                <td style="text-align: center;"> 1.5%</td>
                                <td style="text-align: center;"> 19.700 VNĐ</td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> </td>
                                <td style="text-align: center;"> </td>
                                <td style="text-align: center;"> </td>
                                <td style="text-align: center;"> </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                     <div class="panel-heading tuychonthe">
                       <div class="panel-title"> <a aria-expanded="false" class="collapsed" data-parent="#accordion2" data-toggle="collapse" href="#collapse8">Mua thẻ VTC </a></div>
                     </div>
                     <div aria-expanded="false" class="panel-collapse collapse" id="collapse8">
                       <div class="panel-body">
                         <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                           <thead>
                             <tr>
                               <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                               <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                               <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                               <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                             </tr>
                           </thead>
                           <tbody>
                            <tr>
                              <td style="text-align: center;"> VTC</td>
                              <td style="text-align: center;"> 500.0000 VNĐ</td>
                              <td style="text-align: center;"> 3.5%</td>
                              <td style="text-align: center;"> 482.500 VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> VTC</td>
                              <td style="text-align: center;"> 200.0000 VNĐ</td>
                              <td style="text-align: center;"> 3.5%</td>
                              <td style="text-align: center;"> 193.000 VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> VTC</td>
                              <td style="text-align: center;"> 100.0000 VNĐ</td>
                              <td style="text-align: center;"> 3.5%</td>
                              <td style="text-align: center;"> 96.500 VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> VTC</td>
                              <td style="text-align: center;"> 50.000 VNĐ</td>
                              <td style="text-align: center;"> 3.5%</td>
                              <td style="text-align: center;"> 48.250 VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> VTC</td>
                              <td style="text-align: center;"> 20.000 VNĐ</td>
                              <td style="text-align: center;"> 1.5%</td>
                              <td style="text-align: center;"> 19.700 VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> VTC</td>
                              <td style="text-align: center;"> 10.000 VNĐ</td>
                              <td style="text-align: center;"> 1.5%</td>
                              <td style="text-align: center;"> 9.850 VNĐ</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
           <div class="panel-heading gamecard">
             <div class="thevirus" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">
               <p class="text-center" style="margin: 0 0 0px;text-transform: uppercase; color: blue"> Chiết khấu thẻ Virus, Data mobi</p> <span style="font-weight:normal;text-transform:none;">( Dành cho khách hàng đã đăng ký tài khoản banthe24h.vn )</span></div>
             </div>
             <div class="panel-collapse collapse" id="collapseTwo">
               <div class="panel-body">
                 <div class="panel-group" id="accordion3">
                   <div class="panel panel-default">
                     <div class="panel-heading tuychonthe2">
                       <div class="panel-title"> <a aria-expanded="true" data-parent="#accordion3" data-toggle="collapse" href="#collapse10">Thẻ Data Mobi </a></div>
                     </div>
                     <div aria-expanded="true" class="panel-collapse collapse in" id="collapse10">
                       <div class="panel-body">
                         <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                           <thead>
                             <tr>
                               <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                               <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                               <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                               <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                             </tr>
                           </thead>
                           <tbody>
                            <tr>
                              <td style="text-align: center;"> Data Mobi</td>
                              <td style="text-align: center;"> 84.0000 VNĐ</td>
                              <td style="text-align: center;"> 7.5%</td>
                              <td style="text-align: center;"> 77.700 VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Data Mobi</td>
                              <td style="text-align: center;"> 56.0000 VNĐ</td>
                              <td style="text-align: center;"> 7.5%</td>
                              <td style="text-align: center;"> 51.800 VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Data Mobi</td>
                              <td style="text-align: center;"> 42.0000 VNĐ</td>
                              <td style="text-align: center;"> 7.5%</td>
                              <td style="text-align: center;"> 38.850 VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Data Mobi</td>
                              <td style="text-align: center;"> 28.000 VNĐ</td>
                              <td style="text-align: center;"> 7.5%</td>
                              <td style="text-align: center;"> 25.900 VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Data Mobi</td>
                              <td style="text-align: center;"> 20.000 VNĐ</td>
                              <td style="text-align: center;"> 7.5%</td>
                              <td style="text-align: center;"> 18.500 VNĐ</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;"> Data Mobi</td>
                              <td style="text-align: center;"> 14.000 VNĐ</td>
                              <td style="text-align: center;"> 7.5%</td>
                              <td style="text-align: center;"> 12.950 VNĐ</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                   <div class="panel-heading tuychonthe2">
                     <div class="panel-title"> <a aria-expanded="false" class="collapsed" data-parent="#accordion3" data-toggle="collapse" href="#collapse11">Key Bitdefender </a></div>
                   </div>
                   <div aria-expanded="false" class="panel-collapse collapse" id="collapse11">
                     <div class="panel-body">
                       <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                         <thead>
                           <tr>
                             <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                             <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                             <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                             <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                           </tr>
                         </thead>
                         <tbody>
                          <tr>
                            <td style="text-align: center;"> Bitdefender</td>
                            <td style="text-align: center;"> 390.0000 VNĐ</td>
                            <td style="text-align: center;"> 14%</td>
                            <td style="text-align: center;"> 335.400 VNĐ</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> Bitdefender</td>
                            <td style="text-align: center;"> 250.000 VNĐ</td>
                            <td style="text-align: center;"> 14%</td>
                            <td style="text-align: center;"> 215.000 VNĐ</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> Bitdefender Anti</td>
                            <td style="text-align: center;"> 290.000 VNĐ</td>
                            <td style="text-align: center;"> 14%</td>
                            <td style="text-align: center;"> 249.400 VNĐ</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> Bitdefender Anti</td>
                            <td style="text-align: center;"> 160.000 VNĐ</td>
                            <td style="text-align: center;"> 14%</td>
                            <td style="text-align: center;"> 137.600 VNĐ</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                 <div class="panel-heading tuychonthe2">
                   <div class="panel-title"> <a aria-expanded="false" class="collapsed" data-parent="#accordion3" data-toggle="collapse" href="#collapse12">Thẻ Kaspersky </a></div>
                 </div>
                 <div aria-expanded="false" class="panel-collapse collapse" id="collapse12">
                   <div class="panel-body">
                     <table border="1" cellpadding="1" cellspacing="1" style="width: 100%">
                       <thead>
                         <tr>
                           <th scope="col"> <span style="color:#008000;">Sản phẩm</span></th>
                           <th scope="col"> <span style="color:#008000;">Mệnh giá</span></th>
                           <th scope="col"> <span style="color:#008000;">Chiết khấu</span></th>
                           <th scope="col"> <span style="color:#008000;">Giá bán (VNĐ)</span></th>
                         </tr>
                       </thead>
                       <tbody>
                        <tr>
                          <td style="text-align: center;"> KIS</td>
                          <td style="text-align: center;"> 770.0000 VNĐ</td>
                          <td style="text-align: center;"> 14%</td>
                          <td style="text-align: center;"> 662.200 VNĐ</td>
                        </tr>
                        <tr>
                          <td style="text-align: center;"> KIS</td>
                          <td style="text-align: center;"> 570.0000 VNĐ</td>
                          <td style="text-align: center;"> 14%</td>
                          <td style="text-align: center;"> 490.200 VNĐ</td>
                        </tr>
                        <tr>
                          <td style="text-align: center;"> KIS</td>
                          <td style="text-align: center;"> 290.0000 VNĐ</td>
                          <td style="text-align: center;"> 14%</td>
                          <td style="text-align: center;"> 249.400 VNĐ</td>
                        </tr>
                        <tr>
                          <td style="text-align: center;"> KIS</td>
                          <td style="text-align: center;"> 190.000 VNĐ</td>
                          <td style="text-align: center;"> 14%</td>
                          <td style="text-align: center;"> 163.400 VNĐ</td>
                        </tr>
                        <tr>
                          <td style="text-align: center;"> Kaspersky Anti</td>
                          <td style="text-align: center;"> 340.000 VNĐ</td>
                          <td style="text-align: center;"> 14%</td>
                          <td style="text-align: center;"> 292.400 VNĐ</td>
                        </tr>
                        <tr>
                          <td style="text-align: center;"> Kaspersky Anti</td>
                          <td style="text-align: center;"> 170.000 VNĐ</td>
                          <td style="text-align: center;"> 14%</td>
                          <td style="text-align: center;"> 146.200 VNĐ</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </td>
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
        bc.loadprovider();
        bc.init();
    });
</script>
</body>
</html>
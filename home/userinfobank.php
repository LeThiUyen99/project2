<?
include("config.php");
if($logger != 1)
{
   redirect("/");
}
$userinfourl=$_SERVER['REQUEST_URI'];

$urluri="/tai-khoan-ngan-hang";
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
   <title>Cập nhật thông tin taifk hoản ngân hàng | Doithe66.com</title>
   <meta name="description" content='Dịch vụ đổi thẻ trực tuyến - Đổi thẻ cào thành tiền mặt uy tín nhất, mức phí thấp nhất - Tiết kiệm - Nhanh chóng - An toàn. Hỗ trợ 24/7' />
   <meta name="keywords" content='doi the cao thanh tien, doi the cao, đổi thẻ cào, thu mua thẻ cào, thu mua the cao, đổi thẻ đện thoại, doi the dien thoai' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="doithe66.com" />
   <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
   <link rel="canonical" href='https://doithe66.com/' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
   <link href="/css/grid-0.4.3.min.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="/css/site.css" />
   <link rel="stylesheet" type="text/css" href="/css/common.css?v=5" />
   <script src="/js/jquery-1.9.1.js"></script>
   <script src="/js/bootstrap.min.js"></script>    
   <script src="/js/bootstrap-datepicker.js"></script>    
   <script src="/js/grid-0.4.3.min.js" type="text/javascript"></script>   
   <script type="text/javascript" src="/js/crawler.js"></script>
   <script src="/js/Trans.js"></script>
   <script src="/js/usermanager.js?v=6"></script>
   <script src="/js/common.js"></script>
   <script src="/js/date.format.js"></script>
   <script type="text/javascript" src="/js/jquery.slicknav.js"></script>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   <? include("../includes/inc_header.php") ?>
   <div class="container mid_content">
      <div id="boxLoading" style="display:none;">
         <div class="overlay"></div>
         <div class="boxLoading">Working..</div>
      </div>
      <div>
          <? include("../includes/inc_box_center.php");?>  
          <div class="container">
              <div class="login_success">
                    <section>
           <div class="main_sc">                
                <div class="right_sc">
                    <div class="personal_info">
                    <h3>THÔNG TIN CÁ NHÂN</h3>
            
                    <div class="main_info_user_acc">
                        <div class="form_sc">
                            <span>HỌ TÊN</span>
                            <input type="text" id="_user_name" class="rgname" value="">
                        </div>
                        <div class="form_sc">
                            <span>SĐT</span>
                            <input type="text" id="_dien_thoai" class="rgname" value="">
                        </div>
                        <div class="form_sc">
                            <span>EMAIL</span>
                            <input  type="text" id="_email" class="rgname" value="" disabled="true" style="background-color:#ccc;"/>
                        </div>
                        <div class="form_sc">
                            <span>ĐỊA CHỈ</span>
                            <input type="text" id="_diachi" class="rgname" value="">
                        </div>
                    </div>
            
                    <div class="info_user_stk">
                        <h3>THÔNG TIN TK NGÂN HÀNG</h3>
                        <div class="main_info_user_acc">
                            <div class="form_sc">
                                <span>SỐ TK</span>
                                <input id="_so_tk" type="text" value="">
                            </div>
                            <div class="form_sc">
                                <span>CHỦ TK</span>
                                <input id="_chu_tk" type="text" value="">
                            </div>
                            <div class="form_sc">
                                <span>NGÂN HÀNG</span>
                                <select id="_ngan_hang">
                                    <option value="0">[-- Lựa chọn ngân hàng--]</option>
                                    <option value="Agribank">Agribank - Ngân hàng Nông nghiệp và Phát triển Nông thôn</option>
                                    <option value="BIDV">BIDV - Ngân hàng TMCP Đầu tư và Phát triển Việt Nam</option>
                                    <option value="Vietinbank">Vietinbank - Ngân hàng TMCP Công thương Việt Nam </option>
                                    <option value="Vietcombank">Vietcombank - Ngân hàng Ngoại thương Việt Nam</option>
                                    <option value="Techcombank">Techcombank - Ngân hàng TMCP Kỹ thương</option>
                                    <option value="SCB">SCB - Ngân hàng TMCP Sài Gòn</option>
                                    <option value="Navibank">Navibank - Ngân hàng TMCP Nam Việt</option>
                                    <option value="TienPhongBank">TienPhongBank - Ngân hàng TMCP Tiên Phong</option>
                                    <option value="VietABank">VietABank - Ngân hàng TMCP Việt Á</option>
                                    <option value="VIBBank">VIBBank - Ngân hàng TMCP Quốc tế</option>
                                    <option value="EIBBank">EIBBank - Ngân hàng TMCP Xuất nhập khẩu</option>                                    
                                    <option value="HDBank">HDBank - Ngân hàng Phát triển nhà tp Hồ Chí Minh</option>
                                    <option value="IVBBank">IVBBank - Ngân hàng TNHH Indo Vina Bank</option>
                                    <option value="SHBBank">SHBBank - Ngân hàng TMCP Sài Gòn Hà Nội</option>
                                    <option value="DongABank">DongABank - Ngân hàng TMCP Đông Á </option>
                                    <option value="ACBBank">ACBBank - Ngân hàng TMCP Á Châu</option>
                                    <option value="SeABank">SeABank - Ngân hàng TMCP Đông Nam Á</option>
                                    <option value="Sacombank ">Sacombank  - Ngân hàng TMCP Sài Gòn Thương tín</option>
                                    <option value="Saigonbank">Saigonbank - Ngân hàng TMCP Sài Gòn Công thương</option>
                                    <option value="ABBank">ABBank - Ngân hàng TMCP An Bình</option>
                                    <option value="MHBbank">MHBbank - Ngân hàng Phát triển nhà Đồng bằng song Cửu Long</option>
                                    <option value="Westernbank">Westernbank - Ngân hàng TMCP Phương Tây</option>
                                    <option value="Oceanbank">Oceanbank - Ngân hàng  TMCP Đại Dương</option>
                                    <option value="PGBank">PGBank - Ngân hàng Xăng dầu Petrolimex</option>
                                    <option value="VRBbank">VRBbank - Ngân hàng liên doanh Việt Nga</option>
                                    <option value="TRUSTBank">TRUSTBank - Ngân hàng TMCP Đại Tín</option>
                                    <option value="NamABank">NamABank - Ngân hàng TMCP Nam Á</option>
                                    <option value="BacABank">BacABank - Ngân hàng TMCP  Bắc Á</option>
                                    <option value="GPBank">GPBank - Ngân hàng TMCP Dầu khí toàn cầu</option>
                                    <option value="CCF">CCF - Quĩ Tín dụng Nhân dân Trung Ương</option>
                                    <option value="DaiABank">DaiABank - Ngân hàng TMCP Đại Á</option>
                                    <option value="MBbank">MBbank - Ngân hàng TMCP Quân đội</option>
                                    <option value="Eximbank">Eximbank - Ngân hàng Xuất Nhập Khẩu ViệT Nam</option>
                                    <option value="Maritime Bank">Maritime Bank - Ngân hàng TMCP Hàng Hải Việt Nam</option>
                                    <option value="VPBank">VPBank - Ngân Hàng Việt Nam Thịnh Vượng</option>
                                    <option value="ShinhanBank">ShinhanBank - Ngân hàng Shinhan Việt Nam</option>
                                    <option value="OCB">Ngân hàng Phương Đông</option>
                                </select>
                            </div>
                            <div class="form_sc">
                                <span>CHI NHÁNH</span>
                                <input id="_chi_nhanh" type="text"/>
                                   
                            </div>
            
                        </div>
            
                    </div>
                    <input type="submit" id="save_user_info" class="btn_info" value="LƯU CẬP NHẬT">
                </div>
                </div>
               <? include("../includes/inc_right_history.php"); ?>
            </div>
          </section>
              </div>
                
          </div>
          
      <!--right section work end-->  
      </div>
   </div>
   <? include("../includes/inc_footer.php") ?>
    <script type="text/javascript">
         $(function ()
         {
            var ui = new UserInfo();
            ui.load_user_info_for_edit();
        });
    </script>
</body>
</html>
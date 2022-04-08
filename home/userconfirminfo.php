<?
include("config.php");
if($logger != 1)
{
   redirect("/");
}
$userinfourl=$_SERVER['REQUEST_URI'];
$userinfourl= parse_url("https://doithe66.com".$userinfourl, PHP_URL_PATH);
$urluri="/user/comfirminfo";
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
   <title>Cập nhật thông tin taifk hoản ngân hàng | banthe24h</title>
   <meta name="description" content='Dịch vụ đổi thẻ trực tuyến - Đổi thẻ cào thành tiền mặt uy tín nhất, mức phí thấp nhất - Tiết kiệm - Nhanh chóng - An toàn. Hỗ trợ 24/7' />
   <meta name="keywords" content='doi the cao thanh tien, doi the cao, đổi thẻ cào, thu mua thẻ cào, thu mua the cao, đổi thẻ đện thoại, doi the dien thoai' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe24h" />
   <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
   <link rel="canonical" href='https://banthe24h.vn/' />
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
                    <div class="kichthoattk">
                        <h2>Cập nhật thông tin tài khoản</h2>
                        <div class="">
                            <div class="alert-success"><div style="padding:15px;"><h3>Chào bạn!</h3>Bạn đã cập nhật thành công thông tin tài khoản</div></div>
                            <div class="alert-warning"><div style="padding:15px;"><h3>Chào bạn!</h3>Tài khoản của bạn chưa được cập nhật tài khoản</div></div>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="col-md-8 col-sm-12">
                    
                            <h3 class="page_titel">Điều khoản sử dụng</h3>
                            <div class="news-content">
                                <div class="article">
                                    <span class="subtitle"></span>
                                    <div style="text-align: justify;">
                                        <p>
                                            Cam kết có hiệu lực từ tháng 7 năm 2017 , tất cả thành viên, cá nhân, tổ chức sử dụng dịch vụ tại doithe3s bắt buộc phải đọc và cam kết nội dung này khi đăng ký và sử dụng dịch vụ của doithe3s . Cam kết này có giá trị pháp lý là một văn bản giao kết thương mại giữa doithe3s và người sử dụng  , tất cả thành viên sử dụng bất kỳ dịch vụ nào trên doithe3s được hiểu là mặc định đã  ký vào cam kết này và chịu trách nhiệm trước pháp luật nước CHXHCN Việt Nam .
                                        </p>
                                        <span class="subtitle">CĂN CỨ</span>
                                        <p>
                                            -  Việc đăng ký tài khoản và hoạt động kinh doanh trực tuyến cần đảm bảo đúng pháp luật nước CHXHCN Việt Nam ( căn cứ : Luật giao dịch điện tử số 51/2005/QH11 do Quốc hội thông qua ngày 29/11/2005;Nghị định số 57/2006/NĐ-CP do Chính phủ ban hành ngày 09/06/2006 về thương mại điện tử;Thông tư số 09/2008/TT-BCT do Bộ công thương ban hành ngày 21/07/2008 hướng dẫn nghị định Thương mại điện tử về cung cấp thông tin và giao kết hợp đồng trên website thương mại điện tử)
                                        </p>
                                        <p>
                                            - doithe3s cho phép : đăng ký miễn phí tài khoản tại doithe3s.com khi người dùng cam kết cung cấp thông tin đúng quy định.
                                        </p>
                                        <p>
                                            - doithe3s cho phép mọi cá nhân có nhu cầu mua bán, trao đổi mọi loại hàng hóa, dịch vụ mà doithe3s cung cấp; các tổ chức, cá nhân có nhu cầu tích hợp thanh toán (các phương thức tích hợp có sẵn của doithe3s) có thể đăng ký miễn phí và sử dụng tự do mọi công cụ trên website
                                        </p>
                                        <p>-  Nhu cầu của người muốn sử dụng dịch vụ, hàng hóa do doithe3s.com cung cấp và tích hợp các công cụ thanh toán của doithe3s.</p>
                    
                                        <span class="subtitle">TÔI LÀ:</span>
                                        <p>- Cá nhân đăng ký tài khoản doithe3s để giao dịch trực tuyến vật phẩm ảo trong Game Online</p>
                                        <p>- Cá nhân hoặc cá nhân đại diện cho tổ chức sử dụng doithe3s cho việc tích hợp thanh toán trực tuyến cho hoạt động kinh doanh trực tuyến của cá nhân/tổ chức.</p>
                                        <span class="subtitle">TÔI XIN CAM KẾT ĐÃ HIỂU VÀ THỪA NHẬN NHỮNG ĐIỀU SAU:</span>
                                        <p>- Webiste doithe3s.com là một website kinh doanh và cung cấp dịch vụ hỗ trợ giao dịch các sản phẩm có giá trị liên quan đến dịch vụ trò chơi trực tuyến Game Online và các giải pháp tích hợp thanh toán trực tuyến.</p>
                                        <p>-  Website doithe3s.com thuộc sở hữu của Công ty TNHH một thành viên doithe3s.com là một pháp nhân được thành lập và hoạt động hợp pháp theo pháp luật Việt Nam, có đẩy đủ năng lực cung cấp dịch vụ, sản phẩm trực tuyến.</p>
                                        <p>-  Khi tôi sử dụng giải pháp tích hợp thanh toán trực tuyến do doithe3s.com cung cấp, tôi thừa nhận rằng doithe3s chỉ cung cấp giải pháp tích hợp thanh toán trung gian mà không có bất cứ liên quan nào về hoạt động kinh doanh, pháp lý với các sản phẩm hoặc/và dịch vụ mà tôi cung cấp cho khách hàng của mình.</p>
                                        <p>- Khi phát hiện bất kỳ một giao dịch/khoản tiền nào của tôi có dấu hiệu nghi vấn, doithe3s.com có quyền từ chối cung cấp sản phẩm, dịch vụ cho tôi mà không cần báo trước hoặc/và xử lý các sai phạm đó bằng hình thức: Hạn chế một vài chức năng, đóng băng một khoản tiền, phong tỏa tài khoản, khóa truy cập tài khoản, ngừng cung cấp dịch vụ hoặc lập hồ sơ gửi cơ quan công an v.v… tùy theo mức độ cho đến khi làm sáng tỏ.</p>
                                        <span class="subtitle">TÔI XIN CAM KẾT CHỊU TRÁCH NHIỆM TRƯỚC PHÁP LUẬT NHỮNG ĐIỀU SAU : </span>
                                        <p>- Tôi cam kết chịu trách nhiệm hoàn toàn trước pháp luật về các hoạt động kinh doanh, thương mại, sản phẩm, dịch vụ, giao dịch trực tuyến của mình khi sử dụng giải pháp tích hợp thanh toán của doithe3s.</p>
                                        <p>- Tôi cam kết toàn bộ hoạt động sử dụng dịch vụ, mua bán các sản phẩm, dịch vụ của doithe3s được thực hiện theo đúng quy định pháp luật hiện hành nước Cộng hòa xã hội chủ nghĩa Việt Nam.</p>
                                        <p>- Tôi cam kết toàn bộ thông tin đăng ký tài khoản và giao dịch trên doithe3s là chính xác và tôi chịu trách nhiệm hoàn toàn tính xác thực thông tin mình cung cấp.</p>
                                        <p>-  Tôi cam kết phối hợp chặt chẽ với doithe3s và cơ quan điều tra trong mọi trường hợp xác minh các dấu hiệu lừa đào, vi phạm pháp luật nước Cộng hòa xã hội chủ nghĩa Việt Nam</p>
                                        <span class="subtitle">Với các cam kết trên Tôi đồng ý đăng ký sử dụng dịch vụ của doithe3s.com</span>
                                    </div>
                                    <div class="clearThis">
                                    </div>
                    
                                </div>
                            </div>
                    
                        </div>
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
    $(document).ready(function () {
        $('.alert-success').hide();
        $('.alert-warning').hide();
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
        var c = getParameterByName('c');
        var u = getParameterByName('u');
        $.ajax({
            url: "/user/postcomfirmuserinfo",
            type: 'post',
            data: {c:c,u:u},
            dataType: 'json',
            
            success: function (obj) {
                if (obj.Success == true) {
                    $('.alert-success').show();
                    $('.alert-warning').hide();
                } else {
                    $('.alert-success').hide();
                    $('.alert-warning').show();
                }
            },
            error: function (obj) {
                
            },
            complete: function () {

               
            }
        });
    });
</script>
</body>
</html>
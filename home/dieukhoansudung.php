<?
include("config.php");

      $urlcano = $urlwebsite.'/dieu-khoan-su-dung';
      $userinfourl=$_SERVER['REQUEST_URI'];
      
//echo $userinfourl;
$urlfull= $urlwebsite.$userinfourl;
//var_dump($urlfull);
//var_dump($urlcano);die();
if($urlfull != $urlcano)
{
   header("HTTP/1.1 301 Moved Permanently"); 
   header("Location: $urlcano");
   exit();
}

?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>banthe247.com - Điều khoản sử dụng các dịch vụ</title>
   <meta name="description" content='Quý khách vui lòng đọc kĩ các điều khoản sử dụng trên website banthe247.com để tránh những sai sót đáng tiếc xảy ra. Xin cám ơn quý khách' />
   <meta name="keywords" content='bán thẻ điện thoại online, bán thẻ game online, nạp thẻ online, nạp thẻ trực tuyến, đổi thẻ mới, nap the online uy tin, bán thẻ gate online, bán thẻ zing online' />
   <meta name="robots" content='noodp,index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="new_item" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='<?= $urlcano ?>' />
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
   <? include("../includes/inc_header.php") ?>
   <div class="container">
    <div class="divcontent1"></div>
    <div class="row">
      <div class="col-md-12 col-xs-12 main-tintuc-left">
         <h3 class="page_titel">Điều khoản sử dụng</h3>
<div class="news-content">
    <div class="article">
        <span class="subtitle"></span>
        <h1 class="title"></h1>
        <div style="text-align: justify;">
            <p>
                Cam kết có hiệu lực từ tháng 10 năm 2015 , tất cả thành viên, cá nhân, tổ chức sử dụng dịch vụ tại Banthe247 bắt buộc phải đọc và cam kết nội dung này khi đăng ký và sử dụng dịch vụ của Banthe247 . Cam kết này có giá trị pháp lý là một văn bản giao kết thương mại giữa Banthe247 và người sử dụng  , tất cả thành viên sử dụng bất kỳ dịch vụ nào trên Banthe247 được hiểu là mặc định đã  ký vào cam kết này và chịu trách nhiệm trước pháp luật nước CHXHCN Việt Nam .
            </p>
            <span class="subtitle">CĂN CỨ</span>
            <p>
                -  Việc đăng ký tài khoản và hoạt động kinh doanh trực tuyến cần đảm bảo đúng pháp luật nước CHXHCN Việt Nam ( căn cứ : Luật giao dịch điện tử số 51/2005/QH11 do Quốc hội thông qua ngày 29/11/2005;Nghị định số 57/2006/NĐ-CP do Chính phủ ban hành ngày 09/06/2006 về thương mại điện tử;Thông tư số 09/2008/TT-BCT do Bộ công thương ban hành ngày 21/07/2008 hướng dẫn nghị định Thương mại điện tử về cung cấp thông tin và giao kết hợp đồng trên website thương mại điện tử)
            </p>
            <p>
                - Banthe247 cho phép : đăng ký miễn phí tài khoản tại Banthe247.com khi người dùng cam kết cung cấp thông tin đúng quy định.
            </p>
            <p>
                - Banthe247 cho phép mọi cá nhân có nhu cầu mua bán, trao đổi mọi loại hàng hóa, dịch vụ mà Banthe247 cung cấp; các tổ chức, cá nhân có nhu cầu tích hợp thanh toán (các phương thức tích hợp có sẵn của Banthe247) có thể đăng ký miễn phí và sử dụng tự do mọi công cụ trên website
            </p>
            <p>-  Nhu cầu của người muốn sử dụng dịch vụ, hàng hóa do Banthe247.com cung cấp và tích hợp các công cụ thanh toán của Banthe247.</p>

            <span class="subtitle">TÔI LÀ:</span>
            <p>- Cá nhân đăng ký tài khoản Banthe247 để giao dịch trực tuyến vật phẩm ảo trong Game Online</p>
            <p>- Cá nhân hoặc cá nhân đại diện cho tổ chức sử dụng Banthe247 cho việc tích hợp thanh toán trực tuyến cho hoạt động kinh doanh trực tuyến của cá nhân/tổ chức.</p>
            <span class="subtitle">TÔI XIN CAM KẾT ĐÃ HIỂU VÀ THỪA NHẬN NHỮNG ĐIỀU SAU:</span>
            <p>- Webiste banthe247.com là một website kinh doanh và cung cấp dịch vụ hỗ trợ giao dịch các sản phẩm có giá trị liên quan đến dịch vụ trò chơi trực tuyến Game Online và các giải pháp tích hợp thanh toán trực tuyến.</p>
            <p>-  Website banthe247.com thuộc sở hữu của Công ty TNHH một thành viên Banthe247.com là một pháp nhân được thành lập và hoạt động hợp pháp theo pháp luật Việt Nam, có đẩy đủ năng lực cung cấp dịch vụ, sản phẩm trực tuyến.</p>
            <p>-  Khi tôi sử dụng giải pháp tích hợp thanh toán trực tuyến do Banthe247.com cung cấp, tôi thừa nhận rằng Banthe247 chỉ cung cấp giải pháp tích hợp thanh toán trung gian mà không có bất cứ liên quan nào về hoạt động kinh doanh, pháp lý với các sản phẩm hoặc/và dịch vụ mà tôi cung cấp cho khách hàng của mình.</p>
            <p>- Khi phát hiện bất kỳ một giao dịch/khoản tiền nào của tôi có dấu hiệu nghi vấn, Banthe247.com có quyền từ chối cung cấp sản phẩm, dịch vụ cho tôi mà không cần báo trước hoặc/và xử lý các sai phạm đó bằng hình thức: Hạn chế một vài chức năng, đóng băng một khoản tiền, phong tỏa tài khoản, khóa truy cập tài khoản, ngừng cung cấp dịch vụ hoặc lập hồ sơ gửi cơ quan công an v.v… tùy theo mức độ cho đến khi làm sáng tỏ.</p>
            <span class="subtitle">TÔI XIN CAM KẾT CHỊU TRÁCH NHIỆM TRƯỚC PHÁP LUẬT NHỮNG ĐIỀU SAU : </span>
            <p>- Tôi cam kết chịu trách nhiệm hoàn toàn trước pháp luật về các hoạt động kinh doanh, thương mại, sản phẩm, dịch vụ, giao dịch trực tuyến của mình khi sử dụng giải pháp tích hợp thanh toán của Banthe247.</p>
            <p>- Tôi cam kết toàn bộ hoạt động sử dụng dịch vụ, mua bán các sản phẩm, dịch vụ của Banthe247 được thực hiện theo đúng quy định pháp luật hiện hành nước Cộng hòa xã hội chủ nghĩa Việt Nam.</p>
            <p>- Tôi cam kết toàn bộ thông tin đăng ký tài khoản và giao dịch trên Banthe247 là chính xác và tôi chịu trách nhiệm hoàn toàn tính xác thực thông tin mình cung cấp.</p>
            <p>-  Tôi cam kết phối hợp chặt chẽ với Banthe247 và cơ quan điều tra trong mọi trường hợp xác minh các dấu hiệu lừa đào, vi phạm pháp luật nước Cộng hòa xã hội chủ nghĩa Việt Nam</p>
            <span class="subtitle">Với các cam kết trên Tôi đồng ý đăng ký sử dụng dịch vụ của Banthe247.com</span>
        </div>
        <div class="clearThis">
        </div>

    </div>
</div>
<br />
      </div>
      
        </div>
      </div>
   <? include("../includes/inc_footer.php") ?>
</body>
</html>
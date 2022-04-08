<?
include("config.php");
$newid = getValue("newid","int","GET",0);
$newid = (int)$newid;
//var_dump($newid);die();
if($newid > 0)
{
   $db_qr1 = new db_query("SELECT * FROM faqs Where FaqID = $newid LIMIT 1");
   if(mysql_num_rows($db_qr1->result) > 0)
   {
      $row1 = mysql_fetch_assoc($db_qr1->result);
      $urlcano = $urlwebsite.rewrite_news($newid,$row1['Title'],"chuyen-muc-hoi-dap");
   }
$indexfoloow="noodp,index,follow";

}
?>
<!DOCTYPE html>
<html amp lang="vi">
<head>
    <meta charset="UTF-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <title><?= $row1['Title'] ?></title>
   <meta name="description" content='<?= trim(removeHTML($row1['Answer'])) ?>' />
   <meta name="keywords" content='<?= $row1['MetaKeyword']!=NULL?$row1['MetaKeyword']:"Thu mua thẻ cào điện thoại, thẻ cào game với chiết khấu ưu đãi nhất cho khách hàng tới trên 87,5% , Mua thẻ điện thoại, thẻ game nhanh chóng, tiết kiệm." ?>' />
   <meta name="robots" content='<?=$indexfoloow ?>' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='<?= $urlcano ?>' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
        *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;color:#333;font-family:Roboto,sans-serif}@font-face{font-family:Roboto,sans-serif;src:url(roboto/Roboto-Regular.ttf);font-display:swap}@font-face{font-family:Roboto-Medium,sans-serif;src:url(roboto/Roboto-Medium.ttf);font-display:swap}@font-face{font-family:Roboto-Bold,sans-serif;src:url(roboto/Roboto-Bold.ttf);font-display:swap}.reg{float:left;width:100%;background:#0098db}.mxh{float:right;padding:5px}.hotline{color:#fff;font-size:14px}.sky{background:url(/images/skype.png) no-repeat left;padding-left:25px;color:#337ab7;font-size:14px}.menu{background:#f8f8f8;padding:0 15px}#showMenu{float:right;border:1px solid #e75a1d;background:#e75a1d;border-radius:5px;padding:5px 10px;margin-top:10px}.icon-bar{width:22px;height:2px;background-color:#fff;margin:4px 0}.menu-nav{float:right;font-weight:700;margin-right:5px;margin-top:5px}.menu ul{padding-top:30px;padding-left:10px}.menu ul li{list-style-type:none;padding:7px 0}.ml_h2,.ul_h2{color:#3f51b5}.ml_h3,.ul_h3{padding-left:20px;color:#00bcd4}.menu ul li a{font-size:15px;padding:7px 10px;color:#777;font-weight:400;font-family:Roboto;line-height:20px}a{text-decoration:none}.container-faq{width:95%;margin:auto}.article{padding:0 15px}h1.title{font-size:24px;display:block;line-height:28px;font-weight:700;color:#333}.date_cate{display:flex;font-size:14px;color:#333}.ans{font-size:16px;line-height:20px;text-indent:20px;font-weight:700;text-align:justify}.fullans{text-align:justify}.fullans p{text-indent:20px;font-size:16px;line-height:20px}.fullans h2{font-size:20px;line-height:24px;font-weight:700;color:#333}.relate-link span{font-size:18px;font-weight:700;padding:10px 0 0 10px;display:block;border-bottom:1px solid #e2e2e2}.relate-link ul{margin-left:20px}.relate-link li{padding:2px 0;list-style-type:circle;list-style-position:inside;font-size:16px}.relate-link .clear ul li a{font-size:16px;color:#333;line-height:20px}.date_cate amp-img{margin-right:5px}footer{display:flex;background:url(/images/footer.jpg) no-repeat center;background-size:100% 100%;padding:0 15px}footer p{font-family:Roboto,sans-serif;color:#fff;padding:5px;margin:0;display:flex;width:100%}.thongtin{font-size:24px}.cty{font-size:14px;font-weight:bold}.vanphong,.dienthoai,.mail{font-size:14px}.col-lg-12{text-align:center;padding:0 15px;padding-bottom:5px}.text-theme{color:#ccc;font-size:12px}#call_icon{position:fixed;right:10px;bottom:80px;z-index:9999999}a{color:#337ab7;text-decoration:none}.fa{display:inline-block;font:normal normal normal 14px/1 FontAwesome;font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;padding-right:5px}.fa-company:before{content:"\f275"}.fa-adress:before{content:"\f279"}.fa-phone:before{content:"\f098"}.fa-mail:before{content:"\f199"}.fa-sm:before{content:"\f118"}.fa-monney:before{content:"\f155"}.fa-secur:before{content:"\f023"}

    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="reg">
                    <div class="mxh">
                        <span class="hotline">
                            Hotline: 0972.022.116 -
                        </span>
                        <a href="skype:live:binhminhmta123?chat"><span class="sky">banthe247.com</span></a>
                    </div>
                </div>
                <div class="menu">
                    <a href="/" class="navbar-brand" rel="nofollow" title="Website Mua thẻ điện thoại và nạp tiền điện thoại">
                        <amp-img layout="intrinsic" width="170" height="50"  src="/images/logo.png" alt="logo"></amp-img>
                    </a>
                    <button id="showMenu" on="tap:menuBar.open">
                        <div class="icon-bar"></div>
                        <div class="icon-bar"></div>
                        <div class="icon-bar"></div>
                    </button>
                    <amp-sidebar style="width: 300px" id="menuBar" class="sample-sidebar" layout="nodisplay" side="right">
                        <button class="menu-nav" on="tap:menuBar.close">X</button>
                        <nav>
                            <ul>
                                <li><a rel="nofollow" href="https://banthe247.com/">Trang chủ</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/the-dien-thoai">Mua thẻ điện thoại</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/mua-the-game">Mua thẻ game</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/nap-tien-dien-thoai">Nạp tiền điện thoại</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/thong-bao-mua-tcoin">Nạp tiền vào tài khoản</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/chiet-khau">Chiết khấu</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/the-giay">Thẻ giấy</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/may-in-the-cao">Máy in</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/chuyen-muc-hoi-dap">Hỏi đáp</a></li>
                                <li><a rel="nofollow" on="tap:menuBar2.open">Tin tức</a></li>
                            </ul>
                        </nav>
                    </amp-sidebar>
                    <amp-sidebar style="width: 300px" id="menuBar2" class="sample-sidebar" layout="nodisplay" side="right">
                        <button class="menu-nav" on="tap:menuBar2.close">X</button>
                        <nav >
                            <ul>
                                <li><a rel="nofollow" href="https://banthe247.com/tin-tuc-1.html">Tin tức bán thẻ</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/huong-dan-su-dung-5.html">Hướng dẫn</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/doi-the">Đổi thẻ</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/game-app-8.html">Game app</a></li>
                            </ul>
                        </nav>
                    </amp-sidebar>
                </div>
            </div>
        </div>
    </header>
    <div class="container-faq">
      <div class="divcontent1"></div>
      <div class="row">
         <div class="col-md-12 col-xs-12 main-tintuc-left">
            <div class="news-content">
               
                <div class="article">
        
                    <span class="subtitle"></span>
                    <h1 class="title"><?= $row1['Title'] ?></h1>
                    <span class="date_cate"> <amp-img width="15" height="15" src="/images/icon_clock.png" alt="Clock"/></amp-img> Cập nhật: <?= date("d/m/Y h:i:s A",strtotime($row1['CreateDate'])) ?></span> 
                    <div class="ans"><?= amp_content($row1['Answer']) ?></div>
                    <div class="fullans"><?= amp_content($row1['FullAnswer']) ?></div>
                
                    <div class="clearThis"></div>
                </div>
                <div class="banner_news">
                    <a href="https://banthe247.com/the-dien-thoai"><amp-img layout="intrinsic" width="900" height="450" src="../images/banner_the.jpg" alt="Mua thẻ điện thoại"></a>
                </div>
                <div class="cauhoi">
                    <div class="relate-link">
                        <span>Các câu hỏi khác</span> 
                        <div class="clear">
                            <ul>
                                <?
                                $db_qrnew = new db_query("SELECT * FROM faqs WHERE FaqID <> $newid LIMIT 5");
                                While($rownew = mysql_fetch_assoc($db_qrnew->result))
                                {
                                ?>
                                <li><a title="<?= $rownew['Title'] ?>" href="<?= rewrite_news($rownew['FaqID'],$rownew['Title'],"chuyen-muc-hoi-dap") ?>"><?= $rownew['Title'] ?></a></li>
                                <?
                                }
                                unset($db_qrnew,$rownew);
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                    
               
            </div>
         </div>
         
      </div>
   </div>
    <footer>
        <div class="footer-detail">
            <p class="thongtin">Thông tin liên hệ</p>
            <p class="cty"><i class="fa fa-industry"></i>Công ty cổ phần thanh toán Hưng Hà</p>
            <p class="vanphong"><i class="fa fa-map"></i>Văn phòng: Thôn Thanh Miếu, Xã Việt Hưng, Huyện Văn Lâm, Tỉnh Hưng Yên</p>
            <p class="dienthoai"><i class="fa fa fa-phone-square"></i>Điện thoại: 0972.022.116 hoặc 1900633682 ấn phím 2</p>
            <p class="mail"><i class="fa fa-envelope-square"></i>Email: HotroBanthe247.com</p>
            <p style="font-size:24px">Tải ứng dụng</p>
            <div class="btn_app" style="text-align: left;position: relative;margin-bottom:7px;"> <a href="https://play.google.com/store/apps/details?id=com.banthe247" rel="nofollow"><amp-img width="170" height="50" class=" lazyloaded" src="/images/button_app_adr.png" data-src="/images/button_app_adr.png" alt="ứng dụng banthe247"></a> </div>
            <p><i class="fa fa-smile-o"></i>Mua thẻ cào nhanh chóng, tiện lợi</p>
            <p><i class="fa fa-usd"></i>Thanh toán an toàn, tiết kiệm</p>
            <p><i class="fa fa-lock"></i>Bảo mật SSl</p>
            <a rel="nofollow" href="tel:0972022116" id="call_icon">
                <amp-img width="50" height="50" alt="Liên hệ qua số điện thoại" src="/images/icon_phone.png"></amp-img>
            </a>
            <div class="col-lg-12">
                <span class="text-theme copyrightft">
                    Copyright © 2015 
                    <a rel="nofollow" href="https://banthe247.com">Banthe247.com</a> 
                </span> 
            </div>
        </div>
    </footer>
</body>
<amp-analytics type="googleanalytics">
    <script type="application/json">
    {
    "vars": {
        "account": "UA-131300376-1"
    },
    "triggers": {
        "trackPageview": {
        "on": "visible",
        "request": "pageview"
        }
    }
    }
    </script>
</amp-analytics>
</html>
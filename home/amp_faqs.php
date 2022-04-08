<?
include("config.php");
$newid = getValue("newid","int","GET",0);
$newid = (int)$newid;
if($newid > 0)
{
   $db_qr1 = new db_query("SELECT * FROM faqs Where FaqID = $newid LIMIT 1");
   if(mysql_num_rows($db_qr1->result) > 0)
   {
      $row1 = mysql_fetch_assoc($db_qr1->result);
      $urlcano = $urlwebsite.rewrite_news($newid,$row1['Title'],"chuyen-muc-hoi-dap");
   }
$indexfoloow="noodp,index,follow";
// if($newid==1017 || $newid==14 || $newid==15 || $newid==5 || $newid==7 || $newid==6){
// $indexfoloow="noodp,noindex,nofollow";
// }
}
?>
<!DOCTYPE html>
<html amp lang="vi">
<head>
    <meta charset="UTF-8">
    <script async src='https://cdn.ampproject.org/v0.js'></script>
    <script async custom-element='amp-sidebar' src='https://cdn.ampproject.org/v0/amp-sidebar-0.1.js'></script>
    <script async custom-element='amp-fit-text' src='https://cdn.ampproject.org/v0/amp-fit-text-0.1.js'></script>
    <script async custom-element='amp-analytics' src='https://cdn.ampproject.org/v0/amp-analytics-0.1.js'></script>
    <script async custom-element='amp-iframe' src='https://cdn.ampproject.org/v0/amp-iframe-0.1.js'></script>
    <title><?= $row1['Title'] ?></title>
   <meta name="description" content='<?= trim(removeHTML($row1['Answer'])) ?>' />
   <meta name="keywords" content='<?= $row1['MetaKeyword']!=NULL?$row1['MetaKeyword']:"Thu mua thẻ cào điện thoại, thẻ cào game với chiết khấu ưu đãi nhất cho khách hàng tới trên 87,5% , Mua thẻ điện thoại, thẻ game nhanh chóng, tiết kiệm." ?>' />
   <meta name="robots" content='<?=$indexfoloow ?>' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe24h.vn" />
   <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
   <link rel="canonical" href='<?= $urlcano ?>' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
        *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-family:Roboto,sans-serif}.container1{display:flex;justify-content:space-between;align-items:center;padding:10px 25px 10px 0;background:linear-gradient(white,#fff,#fff,#f3f3f3)}.row1{width:100%}#showMenu{float:right;border:1px solid #e75a1d;background:#e75a1d;border-radius:5px;padding:5px 10px;margin-top:10px}.icon-bar{width:22px;height:2px;background-color:#fff;margin:4px 0}.menu-nav{float:right;font-weight:700;margin-right:5px;margin-top:5px}.menu ul{padding-top:30px;padding-left:10px}.menu ul a{padding:9px 7px;color:#000;font-family:Roboto,sans-serif;font-size:14px;line-height:28px}a{text-decoration:none}.container{width:95%;margin:auto}.main-tintuc-left{padding:15px;position:relative}h1.title{font-size:24px;font-family:Roboto,sans-serif;display:block;line-height:1.6;font-weight:700;text-align:justify}.date_cate{display:flex;font-family:Roboto,sans-serif;font-size:14px;color:#333}.date_cate amp-img{margin-right:5px}.ans{text-align:justify;font-weight:700;font-family:Roboto,sans-serif;font-size:16px;line-height:1.6;margin-bottom:12px}.ans p{text-indent:20px}.ans ul{list-style-type:none}.fulans ul{list-style-type:none}.ans ul li strong{text-indent:0}.ans ul li strong a span{color:#000;line-height:1.6;font-size:16px}.fulans{text-align:justify}.fulans h2{font-size:20px;line-height:1.6;font-weight:700;font-family:Roboto,sans-serif;color:#333}.fulans p{font-size:16px;font-family:Roboto,sans-serif;line-height:1.6;text-indent:20px;color:#000;margin-bottom:12px}blockquote{padding:10px 20px;margin:0 0 20px;font-size:17.5px;border-left:5px solid #eee}blockquote a{color:#000}.fulans h3{font-size:18px;line-height:1.6;font-weight:700;font-family:Roboto,sans-serif;color:#333}a{color:#337ab7;text-decoration:none}.relate-link span{font-size:18px;font-weight:700;padding:10px 0 0 10px;display:block}.relate-link ul{margin-left:20px}.relate-link .clear ul li{list-style-type:circle;list-style-position:inside;padding:2px 0;font-size:16px;padding-top:5px;line-height:1.42857143}.relate-link .clear ul li a{color:#333}.main-tintuc-right .title1{background:#298aaa;border-radius:0 10px;padding:10px 14px;margin-bottom:35px;border-bottom:none;height:auto}.title1{margin-top:22px;line-height:27px;text-transform:uppercase;height:28px;border-bottom:3px solid #6cbe58;float:left;width:100%;font-family:Roboto}.main-tintuc-right .title1 span{font-weight:700;font-size:15px;line-height:18px;color:#fff;margin-left:12px;line-height:28px}.title1 span{font-weight:700;font-size:18px;color:#348dab;height:28px;display:block;float:left}.main-tintuc-right .title1 span:before{content:"";background:url(../images/blog_detail/ic_tt.png) no-repeat;background-position:center left;display:inline-block;height:20px;width:20px;margin-right:15px;vertical-align:middle}.news{margin:10px 0}.caption{padding:10px 15px}.caption a{font-size:16px;text-decoration:none;color:#337ab7;font-family:Roboto,sans-serif}.main-tintuc-right .question span:before{content:"";background:url(../images/blog_detail/ic_chtg.png) no-repeat;background-position:center left;display:inline-block;height:25px;width:26px;margin-right:15px;vertical-align:middle}.topbank{text-align:center}.topbank .banksupport{margin-top:15px;text-align:center;background-image:url(../images/bgbank.jpg);background-position:left bottom;background-repeat:repeat-x}.topbank .banksupport span{background-color:#3f98bc;border-top-left-radius:3px;border-top-right-radius:3px;line-height:33px;color:#fff;text-transform:uppercase;padding:5px 10px;font-family:Roboto,sans-serif;font-size:14px}.topbank amp-img{margin:10px;transition:all .5s ease 0;border:1px solid #ccc}.lienhe{display:flex;flex-wrap:wrap}.container-ft{background:#cddce3}.row-ft{width:85%;padding:10px 30px}.row-ft ul{padding:0;list-style-type:none}.container-ft h2{margin:10px 0;font-size:19px;font-family:Roboto,sans-serif;color:#333;font-weight:500;line-height:1.42857143}.container-ft p{font-size:14px;font-family:Roboto,sans-serif;color:#333;line-height:1.42857143;margin:0}.container-ft p span{font-weight:700}.container-ft a{color:#337ab7;text-decoration:none;font-family:Roboto,sans-serif;font-size:14px;display:flex;line-height:1.42857143}@media only screen and (max-width: 414px){.topbank amp-img:nth-child(2),.topbank amp-img:nth-child(5),.topbank amp-img:nth-child(8),.topbank amp-img:nth-child(11){margin-left:10px;margin-right:10px}.topbank amp-img{margin:10px 0;width:29%}}@media only screen and (max-width: 310px){.topbank amp-img:nth-child(2),.topbank amp-img:nth-child(5),.topbank amp-img:nth-child(8),.topbank amp-img:nth-child(11){margin-left:10px;margin-right:10px}.topbank amp-img{margin:10px;width:29%}}
    </style>
</head>
<body>
    <header>
        <div class="container1">
            <div class="row1">
                <div class="menu">
                    <a href="/"><amp-img layout="intrinsic" width="180" height="50" src="/images/logo.png" alt="logo"></amp-img></a>
                    <button id="showMenu" on="tap:menuBar.open"> 
                        <div class="icon-bar"></div>
                        <div class="icon-bar"></div>
                        <div class="icon-bar"></div>
                    </button>
                    <amp-sidebar style="width: 300px" id="menuBar" class="sample-sidebar" layout="nodisplay" side="right">
                        <button class="menu-nav" on="tap:menuBar.close">X</button>
                        <nav>
                            <ul>
                                <li><a href="https://banthe24h.vn/tien-ich/mua-the-game">Mua thẻ game</a></li>
                                <li><a href="https://banthe24h.vn/tien-ich/nap-tien-dien-thoai">Nạp tiền điện thoại</a></li>
                                <li><a rel="nofollow" href="https://banthe24h.vn/thong-bao-mua-tcoin">Nạp tiền</a></li>
                                <li><a on="tap:menuBar3.open">shop</b></a></li>
                                <li><a on="tap:menuBar2.open">Tin tức thẻ</b></a></li>
                            </ul>
                        </nav>
                    </amp-sidebar>
                    <amp-sidebar style="width: 300px;" id="menuBar2" class="sample-sidebar" layout="nodisplay" side="right">
                        <button class="menu-nav" on="tap:menuBar2.close">X</button>
                        <nav >
                            <ul>
                                <li><a href="https://banthe24h.vn/tin-tuc-1.html">Tin tức mua thẻ</a></li>
                                <li><a href="https://banthe24h.vn/huong-dan-8.html">Hướng dẫn mua thẻ</a></li>
                                <li><a href="https://banthe24h.vn/chuyen-muc-hoi-dap">Hỏi đáp thẻ</a></li>
                                <li><a href="https://banthe24h.vn/chiet-khau">Chiết khấu mua thẻ</a></li>
                                <li><a href="https://banthe24h.vn/app-tro-choi-1015.html">App trò chơi</a></li>
                            </ul>
                        </nav>
                    </amp-sidebar>
                    <amp-sidebar style="width: 300px;" id="menuBar3" class="sample-sidebar" layout="nodisplay" side="right">
                        <button class="menu-nav" on="tap:menuBar3.close">X</button>
                        <nav >
                            <ul>
                                <li><a rel="nofollow" href="/the-giay">Thẻ giấy</a></li>
                                <li><a href="/may-in-the-cao">Máy in thẻ cào</a></li>
                            </ul>
                        </nav>
                    </amp-sidebar>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
      <div class="divcontent1"></div>
      <div class="row">
         <div class="col-md-8 col-xs-12 main-tintuc-left">
            <div class="news-content">
                <div class="article">
                    <span class="subtitle"></span>
                    <h1 class="title"><?= $row1['Title'] ?></h1>
                    <span class="date_cate"> <amp-img width="15" height="15" src="/images/icon_clock.png" alt="Clock"/></amp-img> Cập nhật: <?= date("d/m/Y h:i:s A",strtotime($row1['CreateDate'])) ?></span> 
                    <div class="ans"><?= amp_content ($row1['Answer']) ?></div>
                    <div class="fulans"><?= amp_content ($row1['FullAnswer']) ?>
                    </div>
                    <div class="clearThis"></div>
                </div>
                <div class="banner_news">
                    <a href="https://banthe24h.vn"><amp-img layout="intrinsic" width="900" height="300" src="../images/banner_the.jpg" alt="mua thẻ điện thoại"></amp-img></a>
                </div>
                <div style="margin-bottom: 10px; clear: both;">
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

         <div class="col-md-4 col-xs-12 main-tintuc-right">
            <div class="title1"><span>Tin tức</span></div>
            <div class="clearfix"></div>
            <div class="news">
            <?
                $db_qrnew = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                                            FROM articles 
                                            LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                            WHERE IsActive = 1 AND articles.categoryid = 1 
                                            ORDER BY Id DESC LIMIT 4");
                While($rownew = mysql_fetch_assoc($db_qrnew->result))
                {
                if($rownew['ShortTitle'] != NULL)
                {
                    $urlshort = $rownew['ShortTitle'];
                }
                else
                {
                    $urlshort = $rownew['Title'];
                }
                
                ?>
                    <div class="caption">
                    <a rel="nofollow" href="<?= rewrite_news($rownew['Id'],$urlshort,$rownew['categoryname']) ?>">
                        <i class="fa fa-hand-o-right"></i> <?= $rownew['Title'] ?>
                    </a>
                    </div>
                
                <?
                unset($urlshort);
                }
                unset($db_qrnew,$rownew);
                ?>
            
            
            </div>
            <div class="question">
            <div class="title1"><span>Câu hỏi thường gặp</span></div>
            <div class="clearfix"></div>
            <div class="news">
                <?
                    $db_qrnew = new db_query("SELECT * FROM faqs ORDER BY createdate DESC LIMIT 4");
                    while($rownew = mysql_fetch_assoc($db_qrnew->result))
                    {
                    ?>
                    <div class="caption">
                <a rel="nofollow" href="<?= rewrite_news($rownew['FaqID'],$rownew['Title'],"chuyen-muc-hoi-dap")  ?>">
                    <i class="fa fa-hand-o-right"></i> <?= $rownew['Title'] ?>
                </a>
                </div>               
                    <?
                    }
                    unset($db_qrnew,$rownew);
                    ?>
                
                
            </div>
            </div>
        </div>

      </div>
        
        <div class="banner">
            <a rel="nofollow">
                <amp-img layout="intrinsic" width="900" height="500" src="/images/bannerjp.png" alt="banner mua thẻ cào online"></amp-img>
            </a>
        </div>
      <div class="topbank">
            <div class="banksupport">
                <span>Hỗ trợ thanh toán mua thẻ</span>
            </div>
            <p> 
                <amp-img layout="intrinsic" width="90" height="50" src="/images/vcb.png" alt="Vietcombank"></amp-img>
                <amp-img layout="intrinsic" width="90" height="50" src="/images/scb.png" alt="sacombank"></amp-img>
                <amp-img layout="intrinsic" width="90" height="50" src="/images/ocean.png" alt="Oceanbank"> </amp-img>
                <amp-img layout="intrinsic" width="90" height="50" src="/images/hdb.png" alt="hdbank"> </amp-img>
                <amp-img layout="intrinsic" width="90" height="50" src="/images/vib.png" alt="vibbank"> </amp-img>
                <amp-img layout="intrinsic" width="90" height="50" src="/images/bidv.jpg" alt="bidv"> </amp-img>
                <amp-img layout="intrinsic" width="90" height="50" src="/images/tcb.png" alt="techcombank"></amp-img> 
                <amp-img layout="intrinsic" width="90" height="50" src="/images/vnmart.gif" alt="vnmart"> </amp-img>
                <amp-img layout="intrinsic" width="90" height="50" src="/images/DongA.gif" alt="dongabank"> </amp-img>
                <amp-img layout="intrinsic" width="90" height="50" src="/images/maritime.jpg" alt="maritimebank"> </amp-img>
                <amp-img layout="intrinsic" width="90" height="50" src="/images/NamABank.jpg" alt="namabank"> </amp-img>
                <amp-img layout="intrinsic" width="90" height="50" src="/images/tpb.jpg" alt="tienphongbank"> </amp-img>
            </p>
        </div>
   </div>
    <footer>
        <div class="container-ft">
            <div class="row-ft">
                <h2>Thông tin liên hệ</h2>
                <p><span>Địa chỉ</span>: Tầng 4, B50, Lô 6, KĐT Định Công - Hoàng Mai - Hà Nội</p>
                <p><span>Email</span>: info@24hpay.vn</p>
                <p><span>Điện thoại</span>: 0971.412.658</p>
                <p>Một sản phẩm của Công ty Cổ phần Thanh toán Hưng Hà</p>
                <a href="http://zalo.me/0982079209" rel="nofollow" title="Click chọn để chat qua zalo"><amp-img layout="intrinsic" width="20" height="20" src="/images/icon_zalo.png"> </amp-img>zalo banthe24h.vn</a>
                <p class="lienhe">Kết nối với chúng tôi: 
                    <a rel="nofollow" href="https://vimeo.com/banthe24hvn"><amp-img width=20 height=20 src="/images/new/Logo-01.png" alt="Vimeo"></amp-img>Vimeo</a>
                    <a rel="nofollow" href="https://issuu.com/banthe24h"><amp-img width=20 height=20 src="/images/new/Logo-02.png" alt="Issuu"></amp-img>Issuu</a>
                    <a rel="nofollow" href="https://banthe24h.tumblr.com/"><amp-img width=20 height=20 src="/images/new/Logo-04.png" alt="Tumblr"></amp-img>Tumblr</a>
                    <a rel="nofollow" href="https://www.flickr.com/people/189533206@N02/"><amp-img width=20 height=20 src="/images/new/Logo-03.png" alt="Flickr"></amp-img>Flickr</a>
                    <a rel="nofollow" href="https://www.instagram.com/banthe24hh/"><amp-img width=20 height=20 src="/images/new/Logo-05.png" alt="Instagram"></amp-img>Instagram</a>
                </p>
                <h2>Quy định chính sách</h2>
                <ul class="list-unstyled addres">
                    <li><a href="/gioi-thieu" rel="nofollow">Giới thiệu</a></li>
                    <li><a href="/quy-dinh-bao-mat" rel="nofollow">Quy định bảo mật</a></li>                      
                    <li><a href="/dieu-khoan-su-dung" rel="nofollow">Điều khoản sử dụng</a></li>                          
                    <li><a href="/giai-quyet-khieu-nai" rel="nofollow">Giải quyết khiếu nại</a></li>
                    <li><a href="/sitemap.xml" rel="nofollow">Sitemap</a></li>

                </ul>
                <a href="https://play.google.com/store/apps/details?id=com.something.windows10now.muathe24h">
                    <amp-img layout="intrinsic" width="180" height="50"  alt="ứng dụng banthe24h" class="lazyloaded" src="/images/button_app_adr.png"></amp-img>
                </a>
            </div>
            <p style="font-size: 18px;text-align: center;border-top: solid 2px #fff;padding: 15px 0px;">Bản quyền ©2016-2020 Banthe24h.vn</p>
        </div>
    </footer>
</body>
<amp-analytics type="googleanalytics">
    <script type="application/json">
    {
    "vars": {
        "account": "UA-139150820-1"
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
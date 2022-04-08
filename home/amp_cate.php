<?
include("config.php");
$catid = getValue("catid","int","GET",0);
$catid = (int)$catid;
$page  = getValue('page','int','GET',1,2);
$page  = intval(@$page);
$curentPage = 10;
$pageab = abs($page - 1);
$start = $pageab * $curentPage;
$start = intval(@$start);
$start = abs($start);
$indexfoloow="noodp,index,follow";
if($page == 0)
{
   $page = 1;
}
if($page> 1){
    $indexfoloow="noodp,noindex,nofollow";
}
if($catid==6){
$indexfoloow="noodp,index,follow";
}
if($catid > 0)
{
   $qrinfo = new db_query("SELECT * FROM categories WHERE CategoryID = $catid LIMIT 1");
   if(mysql_num_rows($qrinfo->result) > 0)
   {
      $rowinfo = mysql_fetch_assoc($qrinfo->result);
      $db_qrcat = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,categoryname,ShortTitle
                             FROM articles 
                             LEFT JOIN categories ON articles.categoryid = categories.categoryid
                             WHERE IsActive = 1 AND articles.categoryid = $catid 
                             ORDER BY Id DESC LIMIT ".$start.",".$curentPage);
      $numrow = new db_query("SELECT count(1) FROM articles 
                              LEFT JOIN categories ON articles.categoryid = categories.categoryid
                              WHERE IsActive = 1 AND articles.categoryid = $catid"); 
   }

}

$count = mysql_fetch_assoc($numrow->result);
$count = $count['count(1)'];
$pageccr = $count/$curentPage;
$pageccr =  ceil($pageccr);
$title = $rowinfo['CategoryName']." banthe24h.vn";
$desc=$rowinfo['CategoryName']." banthe24h.vn";
if($catid==1){
    $desc="Tổng hợp tin tức về dịch vụ mua thẻ điện thoại, thẻ game, nạp tiền điện thoại online giá rẻ cũng như cập nhật chính xác thông tin mới nhất thẻ cào các nhà mạng";
}
$urlcano = $urlwebsite.rewriteNews($catid,$rowinfo['CategoryName']);
if($page == 1)
{
   $url_r = $urlwebsite.rewriteNews($catid,$rowinfo['CategoryName']);
   $title = $rowinfo['CategoryName'] . " banthe24h.vn";
}
else if($page > 1)
{
   $title = $rowinfo['CategoryName']." banthe24h.vn ,trang ".$page;
   $url_r = $urlwebsite.rewriteNews($catid,$rowinfo['CategoryName'])."?page=".$page;
}
$urluri = $urlwebsite.$_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html amp lang="vi">
<head>
    <meta charset="UTF-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <title><?= $title ?></title>
   <meta name="description" content='<?= $rowinfo['MetaDesc']!=null?$rowinfo['MetaDesc']:'Thu mua thẻ cào điện thoại, thẻ cào game trực tuyến giá tốt nhất, thanh toán nhanh chóng, tiện lợi nhất. Địa chỉ thu mua card diện thoại online, uy tín.' ?>' />
   <meta name="keywords" content='<?= $rowinfo['Meta']!=null?$rowinfo['Meta']:'thu mua the cao, thu mua thẻ cào, thu mua thẻ điện thoại, thu mua card, thu mua card điện thoại, thu mua thẻ cào trực tuyến, thu mua mã thẻ' ?>' />
   <meta name="robots" content='<?=$indexfoloow ?>' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe24h.vn" />
   <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
   <link rel="canonical" href='<?= $urlcano ?>' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
    @font-face{font-family:Roboto,sans-serif;src:url(roboto/Roboto-Regular.ttf);font-display:swap}@font-face{font-family:Roboto-Medium,sans-serif;src:url(roboto/Roboto-Medium.ttf);font-display:swap}@font-face{font-family:Roboto-Bold,sans-serif;src:url(roboto/Roboto-Bold.ttf);font-display:swap}.container1{display:flex;justify-content:space-between;align-items:center;padding:10px 25px 10px 0;background:linear-gradient(white,#fff,#fff,#f3f3f3)}.row1{width:100%}#showMenu{float:right;border:1px solid #e75a1d;background:#e75a1d;border-radius:5px;padding:5px 10px;margin-top:10px}.icon-bar{width:22px;height:2px;background-color:#fff;margin:4px 0}.menu-nav{float:right;font-weight:700;margin-right:5px;margin-top:5px}.menu ul{padding-top:30px;padding-left:10px}.menu ul a{padding:9px 7px;color:#000;font-family:Roboto,sans-serif;font-size:14px;line-height:28px}.row{margin:auto;width:85%}.page_title{margin-top:5px;margin-bottom:20px;padding-bottom:4px;color:#666;border-bottom:1px dashed #ccc;font-size:36px;font-family:Roboto,sans-serif;font-weight:500}.new_item{padding-top:20px;padding-bottom:20px;height:auto;border-bottom:1px solid #ccc;overflow:hidden;margin-bottom:10px}.new_item_img{position:relative;min-height:1px;padding-right:15px;padding-left:15px}.thumbnail{display:block;padding:4px 10px 0;margin-bottom:20px;line-height:1.42857143;background-color:#fff;border:1px solid #ddd;border-radius:4px;-webkit-transition:border .2s ease-in-out;-o-transition:border .2s ease-in-out;transition:border .2s ease-in-out}.new_title{position:relative;min-height:1px;padding-right:15px;padding-left:15px}.heading_title{padding:0;margin:0;font-size:18px;font-weight:700;line-height:22px;margin-bottom:7px;font-family:Roboto,sans-serif}.new_item .heading_title a{color:#222;text-decoration:none}.far{display:inline-block;font:normal normal normal 14px/1 FontAwesome;font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;padding-right:5px}.fa-clock:before{content:"\f017"}.box-meta{position:relative;top:1px;display:inline-block;font-family:Roboto,sans-serif;font-style:normal;font-weight:400;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;font-size:14px;color:#333;line-height:1.42857143}.title{text-align:justify;font-family:Roboto,sans-serif;font-size:14px;color:#333;line-height:1.42857143}.pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}.col-sm-12{position:relative;min-height:1px;padding-right:15px;padding-left:15px}.pagination > li{display:inline}.pagination > li:first-child > a,.pagination > li:first-child > span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px;position:relative;float:left;padding:6px 12px;line-height:1.42857143;text-decoration:none;border:1px solid #ddd}.pagination > .active > a,.pagination > .active > a:focus,.pagination > .active > a:hover,.pagination > .active > span,.pagination > .active > span:focus,.pagination > .active > span:hover{z-index:2;color:#fff;cursor:default;background-color:#337ab7;border-color:#337ab7}.pagination > li > a,.pagination > li > span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:#337ab7;text-decoration:none;background-color:#fff;border:1px solid #ddd;font-family:Roboto,sans-serif}a{color:#337ab7;text-decoration:none}.ml{display:flex;width:100%}.main-tintuc-right{width:100%;position:relative;min-height:1px}.main-tintuc-right .title1{background:#298aaa;border-radius:0 10px;margin-bottom:35px;border-bottom:none;height:auto;margin-top:22px;line-height:27px;text-transform:uppercase;width:100%;float:left}.main-tintuc-right .title1 span{font-weight:700;font-size:15px;line-height:18px;color:#fff;margin-left:12px;line-height:28px;height:28px;display:block;float:left;font-family:Roboto,sans-serif;padding:10px 14px}.main-tintuc-right .title1 span:before{content:"";background:url(../images/blog_detail/ic_tt.png) no-repeat;background-position:center left;display:inline-block;height:20px;width:20px;margin-right:15px;vertical-align:middle}.news{margin:10px 0}.caption{padding:10px 15px}.caption a{font-size:16px;text-decoration:none;font-family:Roboto,sans-serif}.main-tintuc-right .question span:before{content:"";background:url(../images/blog_detail/ic_chtg.png) no-repeat;background-position:center left;display:inline-block;height:25px;width:26px;margin-right:15px;vertical-align:middle}.topbank{text-align:center}.topbank .banksupport{margin-top:15px;text-align:center;background-image:url(../images/bgbank.jpg);background-position:left bottom;background-repeat:repeat-x}.topbank .banksupport span{background-color:#3f98bc;border-top-left-radius:3px;border-top-right-radius:3px;line-height:33px;color:#fff;text-transform:uppercase;padding:5px 10px;font-family:Roboto,sans-serif;font-size:14px}.topbank amp-img{margin:10px;transition:all .5s ease 0;border:1px solid #ccc}.container-ft{background:#cddce3}.row-ft{width:85%;margin:auto}.row-ft ul{padding:0;list-style-type:none}.container-ft h2{margin:10px 0;font-size:19px;font-family:Roboto,sans-serif;color:#333;font-weight:500;line-height:1.42857143;float:left;width:100%}.container-ft p{font-size:14px;font-family:Roboto,sans-serif;color:#333;line-height:1.42857143;margin:0}.container-ft p span{font-weight:700}.lienhe{display:flex;flex-wrap:wrap}.container-ft a{color:#337ab7;text-decoration:none;font-family:Roboto,sans-serif;font-size:14px;line-height:1.42857143}@media only screen and (max-width: 414px){.topbank amp-img:nth-child(2),.topbank amp-img:nth-child(5),.topbank amp-img:nth-child(8),.topbank amp-img:nth-child(11){margin-left:10px;margin-right:10px}.topbank amp-img{margin:10px 0;width:29%}}@media only screen and (max-width: 400px){.thumbnail{padding:4px 4px 0}}@media only screen and (max-width: 310px){.topbank amp-img:nth-child(2),.topbank amp-img:nth-child(5),.topbank amp-img:nth-child(8),.topbank amp-img:nth-child(11){margin-left:10px;margin-right:10px}.topbank amp-img{margin:10px;width:29%}}
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
        <div class="row">
            <div class="list">
                <h1 class="page_title"><?= $rowinfo['CategoryName'] ?></h1>
                <div class="list_title">
                <? 
                While($rowcate = mysql_fetch_assoc($db_qrcat->result))
                            {
                                if($rowcate['ShortTitle'] != NULL)
                            {
                                $urlshort = $rowcate['ShortTitle'];
                            }
                            else
                            {
                                $urlshort = $rowcate['Title'];
                            }
                            $src=$rowcate['ImageUrl'];
                            if(strpos($rowcate['ImageUrl'],'/upload/files') === false)
                            {
                                $src="/pictures/news/".$rowcate['ImageUrl'];
                            }
                ?>
                <div class="new_item">
                    <div class="new_item_img col-md-3 col-sm-3">
                    <a href="<?= rewrite_news($rowcate['Id'],$urlshort,$rowcate['categoryname']) ?>" class="thumbnail">
                                <amp-img layout="intrinsic" width="900" height="500"  alt="<?= $rowcate['Title'] ?>" src="<?= $src ?>" class="media-object lazy wp-post-image"></amp-img> </a> 
                    
                    </div>
                    <div class="new_title col-md-9 col-sm-9" style="max-height: 150px;overflow: hidden;">
                    <h2 class="heading_title"><a title="<?= $rowcate['Title'] ?>" href="<?= rewrite_news($rowcate['Id'],$urlshort,$rowcate['categoryname']) ?>"><?= $rowcate['Title'] ?></a></h2>
                    <div class="box-meta"><i class="far fa-clock"></i> Cập nhật: <?= date("d/m/Y h:i:s A",strtotime($rowcate['PublicDate'])) ?></div>
                    <div class="title">
                    <?= trim(removeHTML($rowcate['Intro'])) ?>  
                    </div>
                    </div>
                </div>
                <div class="clear"></div>
                <?}?>
                </div>
                <div class="pull-right pagination">
                    <div class="col-sm-12" style="text-align:right">
                        <ul class="pagination">
                            <?
                            echo generatePageBar3('',$page,$curentPage,$count,rewriteNews($catid,$rowinfo['CategoryName']),'?','','active','preview','<','next','>','first','Đầu','last','Cuối');
                            ?>
                            <li style="display:none" id="tongSoTrang"><?= $pageccr ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ml">
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
                            <?= $rownew['Title'] ?>
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
                            <?= $rownew['Title'] ?>
                            </a>
                        </div>               
                            <?
                            }
                            unset($db_qrnew,$rownew);
                            ?>
                        
                        
                        </div>
                    </div>
                    <div class="banner">
                        <a rel="nofollow">
                        <amp-img layout="intrinsic" width="900" height="500"  src="/images/bannerjp.png" alt="banner mua thẻ cào online"></amp-img>
                        </a>
                    </div>
                </div>
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
                    <a rel="nofollow" href="https://www.instagram.com/banthe24hh/"><amp-img width=20 height=20 src="/images/new/Logo-05.png" alt="Instagram"></amp-img>Instagram</a></p>
                <h2>Quy định chính sách</h2>
                <ul class="list-unstyled addres">
                    <li><a href="/gioi-thieu" rel="nofollow">Giới thiệu</a></li>
                    <li><a href="/quy-dinh-bao-mat" rel="nofollow">Quy định bảo mật</a></li>                      
                    <li><a href="/dieu-khoan-su-dung" rel="nofollow">Điều khoản sử dụng</a></li>                          
                    <li><a href="/giai-quyet-khieu-nai" rel="nofollow">Giải quyết khiếu nại</a></li>
                    <li><a href="/sitemap.xml" rel="nofollow">Sitemap</a></li>

                </ul>
                <a rel="nofollow" href="https://play.google.com/store/apps/details?id=com.something.windows10now.muathe24h">
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
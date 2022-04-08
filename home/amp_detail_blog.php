<?
include("config.php"); 
$newid = getValue("newid","int","GET",0);
$newid = (int)$newid;
$indexfoloow = "noodp,index,follow";
if($newid > 0){
    $db_qr = new db_query("SELECT Id,articles.categoryid,link_301,ImageUrl,Intro,new_tdgy,new_ndgy,articles.Description,Title,categoryname,ShortTitle,articles.Meta,PublicDate,articles.MetaDesc
                                         FROM articles 
                                         LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                         WHERE IsActive = 1 AND Id = $newid");
    if(mysql_num_rows($db_qr->result) > 0)
    {
        $row = mysql_fetch_assoc($db_qr->result);

        if ($row['ShortTitle'] != NULL) {
            $urlshort = $row['ShortTitle'];
        } else {
            $urlshort = $row['Title'];
        }
        $urlcano =  rewrite_news($newid, $urlshort, $row['categoryname']);
        $userinfourl = $_SERVER['REQUEST_URI'];
        $src = $row['ImageUrl'];
        if (strpos($row['ImageUrl'], '/upload/') === false)
        {
            $src = "https://banthe247.com/pictures/news/" . $row['ImageUrl'];
        }

        $urlfull = $userinfourl;
        if ($row['categoryid'] == 5) {
            $indexfoloow = "noodp,noindex,nofollow";
        }
    }
}
$db_qrnew = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.CategoryID
                            WHERE IsActive = 1 AND articles.categoryid = '" . $row['categoryid'] . "'
                            AND Id != '" . $row['Id'] . "' 
                            ORDER BY PublicDate DESC LIMIT 4");

// Dữ liệu cho mục tin tức
$db_qrnews = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.categoryid
                            WHERE IsActive = 1 AND articles.categoryid = 1 
                            ORDER BY Id DESC LIMIT 4");

// Dữ liệu cho mục hỏi đáp
$db_qrfaqs = new db_query("SELECT * FROM faqs ORDER BY createdate DESC LIMIT 4");


$db_qr2   = new db_query("SELECT * FROM categories");
$row_back = $db_qr2->result_array('CategoryID');
$row_name = $row_back[$row['categoryid']]['CategoryName'];
$url_back = rewriteNews($row['categoryid'], $row_name);
?>
<!DOCTYPE html>
<html amp lang="vi">
<head>
<meta charset="UTF-8"/>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
  
    <title><?= $row['Title'] ?></title>
    <!-- <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" /> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <meta name="description" content='<?= $row['MetaDesc'] ?>' />
    <meta name="keywords" content='<?= $row['Meta'] ?>' />
    <meta name="robots" content='<?= $indexfoloow ?>' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <meta http-equiv="content-language" content="vi" />
    <meta name="author" itemprop="author" content="new_item" />
    <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
    <link rel="canonical" href='https://banthe247.com<?= $urlcano ?>' />
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />

    <meta property="og:image:url" content='<?= $src ?>'>
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content='<?= $row['Title'] ?>'>
    <meta property="og:url" itemprop="url" content='https://banthe247.com<?= $urlcano ?>'>
    <meta property="og:description" itemprop="description" content='<?= $row['MetaDesc'] ?>'>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content='<?= $src ?>'>
    <meta name="twitter:description" content='<?= $row['MetaDesc'] ?>'>
    <meta name="twitter:title" content='<?= $row['Title'] ?>'>
    <meta name="twitter:site" content="banthe247.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style amp-custom>
        @font-face{font-family:Roboto,sans-serif;src:url(roboto/Roboto-Regular.ttf);font-display:swap}@font-face{font-family:Roboto-Medium,sans-serif;src:url(roboto/Roboto-Medium.ttf);font-display:swap}@font-face{font-family:Roboto-Bold,sans-serif;src:url(roboto/Roboto-Bold.ttf);font-display:swap}.reg{float:left;width:100%;background:#0098db}.mxh{float:right;padding:5px}.regiter{float:right;width:50%;padding:0 15px}.dangky,.dangnhap{float:left;width:42%;text-align:center;padding:5px}.dangnhap{background:#337ab7;border-radius:5px;margin-right:10px}.dangky{background:#26b903;border-radius:5px}.dangky a,.dangnhap a{color:#fff;font-size:14px;text-decoration:none}.hotline{color:#fff;font-size:14px}.sky{background:url(/images/skype.png) no-repeat left;padding-left:25px;color:#337ab7;font-size:14px}.menu{background:#f8f8f8;padding:0 15px}.menu-nav{float:right;font-weight:700;margin-right:5px;margin-top:5px}.menu ul{padding-top:30px;padding-left:10px}.menu ul li{list-style-type:none;padding:7px 0}.menu ul li a{font-size:15px;padding:7px 10px;color:#777;font-weight:400;font-family:Roboto;line-height:20px}#showMenu{float:right;border:1px solid #e75a1d;background:#e75a1d;border-radius:5px;padding:5px 10px;margin-top:10px}.icon-bar{width:22px;height:2px;background-color:#fff;margin:4px 0}.container{display:flex;width:100%}.detail-row{margin:auto;width:95%}.title{font-size:24px;line-height:normal;border-bottom:1px solid #e7e8ea;padding-bottom:20px;font-family:Roboto,sans-serif;font-weight:400;text-align:justify}.date{display:flex;align-items:center;font-size:14px;line-height:12px;letter-spacing:.02em;color:#999;padding-bottom:10px;font-family:Roboto,sans-serif}.description{text-align:justify;color:#484848;font-size:16px;font-family:"Noto Serif",serif;line-height:28px}.description p:first-of-type{font-style:italic;font-family:"Noto Serif",serif}.description p{margin:0;color:#484848;line-height:28px;text-indent:22px;font-family:"Noto Serif",serif;font-size:16px;float:left;width:100%;margin-bottom:10px}#sub_tbl_news p{text-indent:0;text-align:center}#sub_tbl_news p:first-of-type{text-indent:22px;text-align:justify;font-style:unset}#sub_tbl_news amp-img{float:left;margin:0}.stb_title p{width:auto;margin:0;margin-right:10px}.description span{width:100%}blockquote{box-sizing:border-box;width:100%;padding:5px 10px;margin:8px 0;border-left-width:3px;border-left-style:solid;border-left-color:#ed7600;background:#f8f8f8;float:left}h3,h3 span{color:#0098db;margin:0;float:left;width:100%;font-style:italic;font-size:18px;line-height:1.6;font-weight:unset;font-family:Roboto,sans-serif}.phuluc{float:left;width:100%}.mucluc{border:2px dashed #0098db;width:85%;margin:30px auto;padding:20px}.mucluc span{line-height:40px;font-weight:700;font-size:16px;text-transform:uppercase;color:#fff;font-style:normal}.title_phu_luc,.tt_phu_luc{clip-path:polygon(100% 0,89% 48%,100% 100%,0 100%,11% 48%,0 0);width:100%;background:#0098db;text-align:center;padding:10px 0}.mucluc ul{padding:0;height:165px;overflow:auto;padding-right:5px;list-style-type:none}.mucluc ul li{padding-bottom:15px}.mucluc ul::-webkit-scrollbar{width:5px}.mucluc ul::-webkit-scrollbar-thumb{background:#0098db;border-radius:20px}.mucluc ul::-webkit-scrollbar-track{border-radius:20px;background:0 0}.mucluc .ml_h2,.mucluc .ul_h2{font-weight:500;font-size:16px;line-height:21px;color:#3f51b5;font-family:"Noto Serif",serif;text-decoration:none}.mucluc .ml_h3,.mucluc .ul_h3{font-style:italic;font-weight:500;font-size:14px;line-height:20px;color:#00bcd4;padding-left:16px;text-decoration:none;font-family:"Noto Serif",serif;padding-left:20px}.mucluc .ml_h4,.mucluc .ul_h4{font-style:italic;font-weight:400;font-size:14px;line-height:20px;color:#878080c0;padding-left:32px}.tt-img{letter-spacing:.03em;color:#484848;margin-top:5px;font-style:italic;font-family:"Noto Serif";text-align:center}.description amp-img{float:left}.description #dif_news amp-img{margin:0}h2,h2 span{font-weight:700;font-size:20px;line-height:1.6;text-align:justify;color:#0098db;width:100%;font-family:Roboto,sans-serif}h4{color:#212529;margin:0;margin-bottom:20px;font-style:italic;font-size:16px;line-height:1.6;float:left;width:100%}h4 span{color:#212529;margin:0;margin-bottom:20px;font-style:italic;font-size:16px;line-height:1.6;font-family:"Roboto";font-weight:400}h3{padding:15px 0}.description p span,.description p span span{font-size:16px;line-height:25px}#sub_tbl_news{float:left;width:100%;border:2px solid #fd3e45;box-sizing:border-box;border-radius:5px 5px 0 0;text-indent:0}.stb_title{padding:15px 20px;font-weight:700;color:#fff;line-height:22px;margin-bottom:15px;background:#fd3e45;font-size:16px;font-family:"Noto Serif";display:flex;align-items:center;text-align:center}.stb_desc{padding:0 15px 20px;font-size:15px;float:left}#sub_tbl_news a{background:linear-gradient(180deg,#ff666c 0,#ff252d 100%);border-radius:15px;color:#fff;padding:10px 26px 10px 27px;text-decoration:none;font-weight:700;display:inline-block}#sub_tbl_news .stb_title span{width:auto}.description img{width:100%;height:auto;float:left;padding-top:10px}.description figure{margin:0;float:left;margin-bottom:15px}.description figcaption{letter-spacing:.03em;color:#484848;font-style:italic;font-family:"Noto Serif";padding-top:10px;float:left;text-align:center;width:100%}#sub_tbl_news img{width:auto}#dif_news ul{padding:0;padding-left:0;justify-content:space-between;list-style:none;display:flex;justify-content:space-between;width:100%;flex-wrap:wrap}#dif_news ul li{font-family:"Noto Serif",serif;font-size:16px;list-style-type:none;margin-bottom:35px;float:left;width:48%}#dif_news ul li .dif_news_thumb{width:100%}#dif_news ul li .dif_news_thumb img{width:100%;height:100%}#dif_news ul li a{font-size:14px;line-height:16px;color:#222;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2;overflow:hidden;padding-top:10px;float:left}#dif_news ul li a{color:#222;text-decoration:none}#dif_news .banner{padding-top:20px;float:left;width:100%;padding-bottom:15px}#dif_news{float:left;width:100%;font-family:ROboto,sans-serif;border-top:1px solid#D3D2D2}.description ul{font-family:Roboto,sans-serif;line-height:1.5}.description li{font-family:"Noto Serif",serif;line-height:28px}blockquote div{text-align:center;font-family:Roboto,sans-serif;font-style:italic}center table{border:none}table{width:100%;border:none;border-collapse:collapse}td,th{text-align:center;font-family:Roboto,sans-serif;padding:8px;border:1px solid #ddd}td div span a{color:red;padding-left:10px}td div{text-align:left}td div p span button{background:#fff;border:1px solid #dfdfdf;padding:.5em;text-transform:uppercase;display:block;border-radius:5px;float:right;margin-right:5px;font-style:italic}tr:first-of-type th{color:#fff;background:#73a302}td div div h4{background:#73a302;margin:0;text-align:center;padding:8px;font-style:italic}tr:nth-child(1) td p{background:#73a302;margin:0}tr:nth-child(1) td{background:#73a302;color:#fff}.panel-group{border:2px solid #ddd;border-radius:5px}table td span amp-img{margin:8px}table:last-of-type td{padding:0}.panel-heading{text-align:center;background:#73a302;padding:8px}.panel-heading span{text-align:center;font-weight:600;color:#212529;margin:0;margin-bottom:20px;font-style:italic;font-size:16px;line-height:1.6;font-family:ROboto,sans-serif}.panel-body{padding:15px}.panel-body th span{color:green;font-family:ROboto,sans-serif}.banner_b amp-img{margin:0;margin-bottom:20px}footer{display:flex;background:url(/images/footer.jpg) no-repeat center;background-size:100% 100%;padding:0 15px}.footer-detail{width:100%;font-size:14px}footer p{color:#fff;padding:5px;margin:0;display:flex;width:100%;font-family:Roboto,sans-serif}.thongtin{font-size:24px}.cty{font-weight:700}.ud{font-size:18px}#call_icon{position:fixed;right:10px;bottom:80px;z-index:9999999}.col-lg-12{text-align:center;padding:0 15px;padding-bottom:5px;font-family:Roboto,sans-serif;font-size:12px}.text-theme{color:#ccc}a{color:#337ab7;text-decoration:none}.fa{display:inline-block;font:normal normal normal 14px/1 FontAwesome;font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;padding-right:5px}.fa-company:before{content:"\f275"}.fa-adress:before{content:"\f279"}.fa-phone:before{content:"\f098"}.fa-mail:before{content:"\f199"}.fa-sm:before{content:"\f118"}.fa-monney:before{content:"\f155"}.fa-secur:before{content:"\f023"}@media screen and (max-width: 375px){.regiter{width:55%}#dif_news ul li{width:100%}}@media screen and (max-width: 360px){.regiter{width:60%}}@media screen and (max-width: 320px){.regiter{width:55%}#dif_news ul li .dif_news_thumb{height:82px}.regiter{width:65%}}@media screen and (max-width: 280px){.regiter{width:75%}}
    </style>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
</head>
<body>
    <header>
        <div class="container-h">
            <div class="detail">
                <div class="reg">
                    <div class="mxh">
                        <span class="hotline">
                            Hotline: 0972.022.116 -
                        </span>
                        <a href="skype:live:binhminhmta123?chat"><span class="sky">banthe247.com</span></a>
                    </div>
                    <!-- <div class="regiter">
                        <div id="lidangnhap" class="dangnhap">
                            <a href="#" rel="nofollow" data-toggle="modal" data-target="#signin" class="btnc"><span style="color:#FFF;">Đăng nhập</span></a>
                        </div>
                        <div id="lidangky" class="dangky">
                            <a href="/user/register" class="btnc " rel="nofollow"><span style="color:#FFF;">Đăng ký</span></a>
                        </div>
                    </div> -->
                </div>
                
                <div class="menu">
                    <!-- <div class="logo"> -->
                    <a href="/" class="navbar-brand" rel="nofollow" title="Website Mua thẻ điện thoại và nạp tiền điện thoại">
                        <amp-img layout="intrinsic" width="180" height="50"  src="/images/logo.png" alt="logo"></amp-img>
                    </a>
                    <!-- </div> -->
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
    <div class="container">
        <div class="detail-row">
            <h1 class="title"><?= $row['Title'] ?></h1>
            <div class="date">Cập nhật: <?= date("d/m/Y • h:i:s A", strtotime($row['PublicDate'])) ?></div>
            <div class="description">
                <p><? echo trim(removeHTML($row['Intro'])) ?></p>
               <div class="phuluc">
                    <div class="mucluc">
                        <? echo makeML($row['Description']) ?>
                    </div>
                </div>
                <? 
                $text = amp_content($row['Description']);
                echo makeML_content($text);				 
                ?>
               <?php if ($row['new_tdgy'] != "") { ?>
                        <div id="sub_tbl_news" class="text-center">
                            <div class="stb_title text-left">
                                <p><amp-img width=25 height=25  src="/images/blog_detail/ic_last.png"></amp-img></p>
                                <span><?= $row['new_tdgy'] ?></span>
                            </div>
                            <div class="stb_desc text-left">
                                <? $text = amp_content($row['new_ndgy']);
                               echo $text = str_replace('&nbsp;','',$text) ?>
                            </div>
                        </div>
                    <? } ?>
                    <div id="dif_news">
                        <div class="banner">
                            <a href="https://banthe247.com/the-dien-thoai">
                                <amp-img layout="intrinsic" width="900" height="420" src="/images/banner_the.jpg" alt="Mua thẻ điện thoại"></amp-img>
                            </a>
                        </div>
                        <div>Các tin khác</div>
                        <ul>
                            <?
                            while ($rownew = mysql_fetch_assoc($db_qrnew->result)) {
                                if ($rownew['ShortTitle'] != NULL) {
                                    $urlshortde = $rownew['ShortTitle'];
                                } else {
                                    $urlshortde = $rownew['Title'];
                                }
                                $src1 = $rownew['ImageUrl'];
                                if (strpos($rownew['ImageUrl'], '/upload/') === false) {
                                    $src1 = "/pictures/news/" . $rownew['ImageUrl'];
                                }
                            ?>
                                <li>
                                    <div class="dif_news_thumb"><amp-img layout="intrinsic" width="900" height="500" src="<?= $src1 ?>" title="<?= $rownew['Title'] ?>" alt="<?= $rownew['Title'] ?>"></amp-img></div>
                                    <a title="<?= $rownew['Title'] ?>" href="<? echo rewrite_news($rownew['Id'], $urlshortde, $rownew['categoryname']) ?>"><?= $rownew['Title'] ?></a>
                                </li>
                            <?
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="banner_b">
                        <a rel="nofollow" href="https://timviec365.vn/cv-xin-viec">
                            <amp-img layout="intrinsic"  width="900" height="1000" src="/images/banner_cv_right.gif"></amp-img>
                        </a>
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
            <p class="ud"><i class="fa fa-smile-o"></i>Mua thẻ cào nhanh chóng, tiện lợi</p>
            <p class="ud"><i class="fa fa-usd"></i>Thanh toán an toàn, tiết kiệm</p>
            <p class="ud"><i class="fa fa-lock"></i>Bảo mật SSl</p>
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
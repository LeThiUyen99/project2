<?
include("config.php");
$page = getValue('page', 'int', 'GET', 1, 2);
$page = intval(@$page);
$curentPage = 4;
$pageab = abs($page - 1);
$start = $pageab * $curentPage;
$start = intval(@$start);
$start = abs($start);
$catid = 1015;


$qrinfo = new db_query("SELECT * FROM categories WHERE CategoryID = $catid LIMIT 1");
$rowinfo = mysql_fetch_assoc($qrinfo->result);
$db_top = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,articles.Meta,ImageUrl,Title,categoryname,ShortTitle,category_parent_id
FROM articles
LEFT JOIN categories ON articles.categoryid = categories.categoryid
WHERE IsActive = 1 AND articles.categoryid = $catid
ORDER BY Id DESC LIMIT 7");

//DB cho game noi bat

$db_tgame = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,view,ImageUrl,Title,categoryname,ShortTitle,category_parent_id
FROM articles
LEFT JOIN categories ON articles.categoryid = categories.categoryid
WHERE IsActive = 1 AND articles.categoryid = $catid
ORDER BY view DESC, Id DESC LIMIT " . $start . "," . $curentPage);

//DB cho game noi bat trong tuan
$db_wgame = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,view,ImageUrl,Title,categoryname,ShortTitle,category_parent_id
FROM articles
LEFT JOIN categories ON articles.categoryid = categories.categoryid
WHERE PublicDate >= DATE_ADD(NOW(), INTERVAL -7 DAY) AND articles.categoryid = $catid
ORDER BY view DESC, Id DESC LIMIT 5");



$db_qr = new db_query("SELECT * FROM categories");
$db_cat = $db_qr->result_array('CategoryID');



$numrow = new db_query("SELECT count(1) FROM articles
LEFT JOIN categories ON articles.categoryid = categories.categoryid
WHERE IsActive = 1 AND articles.categoryid = $catid");
$count = mysql_fetch_assoc($numrow->result);
$count = $count['count(1)'];
$pageccr = $count / $curentPage;
$pageccr = ceil($pageccr);
$title = $rowinfo['CategoryName'] . " banthe24h.vn";
$desc = $rowinfo['MetaDesc'] . " banthe24h.vn";
$meta = $rowinfo['Meta'];

$urlcano = rewriteNews($catid, $rowinfo['CategoryName']);
$urlcano = $urlwebsite . $urlcano;
if ($page == 1) {
    $url_r = rewriteNews($catid, $rowinfo['CategoryName']);
    $url_r = $urlwebsite . $url_r;
    $title = $rowinfo['CategoryName'] . " banthe24h.vn";
} else if ($page > 1) {
    $url_r = rewriteNews($catid, $rowinfo['CategoryName']) . "?page=" . $page;
    $url_r = $urlwebsite . $url_r;
}
$urluri = $_SERVER['REQUEST_URI'];
$urluri = $urlwebsite . $urluri;
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
    <meta name="description" content='<?= $desc ?>' />
    <meta name="keywords" content='<?= $meta ?>' />
    <meta name="robots" content='<?=(isset($_GET['page'])) ? 'noodp,noindex,follow' : 'noodp,index,follow'?>' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-language" content="vi" />
    <meta name="author" itemprop="author" content="banthe24h.vn" />
    <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
    <link rel="canonical" href='<?= (isset($_GET['page'])) ? "https://banthe24h.vn/app-tro-choi-1015.html" : $url_r?>' />
    <meta property="og:image:url" content="https://banthe24h.vn/pictures/news/2020/10/09/bfj1602207838.jpg">
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content='<?= $title ?>'>
    <meta property="og:url" itemprop="url" content='<?= (isset($_GET['page'])) ? "https://banthe24h.vn/app-tro-choi-1015.html" : $url_r?>'>
    <meta property="og:description" itemprop="description" content='<?= $desc ?>'>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content="https://banthe24h.vn/pictures/news/2020/10/09/bfj1602207838.jpg">
    <meta name="twitter:description" content='<?= $desc ?>'>
    <meta name="twitter:title" content='<?= $title ?>'>
    <meta name="twitter:site" content="banthe24h.vn">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
        @font-face{font-family:Roboto,sans-serif;src:url(roboto/Roboto-Regular.ttf);font-display:swap}@font-face{font-family:Roboto-Medium,sans-serif;src:url(roboto/Roboto-Medium.ttf);font-display:swap}@font-face{font-family:Roboto-Bold,sans-serif;src:url(roboto/Roboto-Bold.ttf);font-display:swap}.container1{display:flex;justify-content:space-between;align-items:center;padding:10px 25px 10px 0;background:linear-gradient(white,#fff,#fff,#f3f3f3)}.row1{width:100%}#showMenu{float:right;border:1px solid #e75a1d;background:#e75a1d;border-radius:5px;padding:5px 10px;margin-top:10px}.icon-bar{width:22px;height:2px;background-color:#fff;margin:4px 0}.menu-nav{float:right;font-weight:700;margin-right:5px;margin-top:5px}.menu ul{padding-top:30px;padding-left:10px}.menu ul a{padding:9px 7px;color:#000;font-family:Roboto,sans-serif;font-size:14px;line-height:28px}.container_ga{margin:auto;width:93%}.topbank{text-align:center}.topbank .banksupport{margin-top:15px;text-align:center;background-image:url(../images/bgbank.jpg);background-position:left bottom;background-repeat:repeat-x}.topbank .banksupport span{background-color:#3f98bc;border-top-left-radius:3px;border-top-right-radius:3px;line-height:33px;color:#fff;text-transform:uppercase;padding:5px 10px;font-family:Roboto,sans-serif;font-size:14px}.topbank amp-img{margin:10px;transition:all .5s ease 0;border:1px solid #ccc}.lienhe{display:flex;flex-wrap:wrap}.game_thumb_1 a{line-height:14px;font-size:12px;padding:8px 11px;background:#50b952;border-radius:0 5px 5px 0;letter-spacing:normal;color:#fff;position:absolute;bottom:8px;left:0;text-decoration:none;font-family:Roboto,sans-serif}.game-des .smg{line-height:14px;font-size:12px;padding:8px 11px;background:#50b952;border-radius:0 5px 5px 0;letter-spacing:normal;color:#fff;position:absolute;bottom:8px;left:0;text-decoration:none;font-family:Roboto,sans-serif}.game-des{bottom:0;width:100%}amp-carousel .game_desc_1{position:absolute;bottom:0;width:100%;padding:7px;padding:0 0 23px}amp-carousel .game_desc_1 .desc_1{padding:0 7px;padding-top:10px}#wp_app_game{display:flex;padding-top:30px}.game_desc_1{padding:11px 7px 1px;font-size:14px;line-height:16px;border-radius:0 0 15px 15px;background:#348daf;letter-spacing:normal;color:#fff;text-decoration:none;font-family:Roboto,sans-serif}.game_desc_1 span{font-size:10px;line-height:12px;margin-left:7px}.game_name_1{margin-bottom:8px;color:#fff;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2;overflow:hidden;text-decoration:none}.game_thumb_1 amp-img{border-radius:20px 20px 0 0}#carousel-with-preview .game_thumb_1 a{bottom:80px}#ga_content{justify-content:space-between;display:block;margin-bottom:30px}#top_game{width:100%;margin-bottom:29px}.ga_title{border-bottom:2px solid #348daf;margin-bottom:27px;clear:both}.ga_title span{font-weight:500;font-size:18px;line-height:21px;text-indent:30px;font-family:Roboto,sans-serif;letter-spacing:normal;text-transform:capitalize;color:#348daf;display:inline-block}.ga_title span::after{content:"";display:block;width:100%;height:4px;background:#348daf;border-radius:5px 5px 0 0;margin-top:5px}#list_top_game{display:flex;flex-wrap:wrap}.box_game_2{width:48.9%;flex-grow:unset;margin-bottom:57px}.box_game_2:nth-child(odd){margin-right:7px}.bg_box{position:relative;width:100%}.bg_box > div{width:92.9%;padding:9px 7px 9px 9px;bottom:-34px;position:absolute;background:#fff;box-shadow:0 3px 10px rgba(0,0,0,0.2);border-radius:10px;transition:all linear .3s}.carousel-preview{text-align:center;position:absolute;z-index:1;margin-top:-28px;width:93%}.carousel-preview button{border:1px solid #fff;border-radius:50%;width:7px;height:15px;margin:5px;outline:0;background:#348daf}.carousel-preview button:active{width:15px;height:16px;transform:scale(1.4);background:#c4c4c4;border:1px solid #ffff}a{text-decoration:none}.bg_box > div .game_type{top:-36px;left:0;line-height:14px;font-size:12px;padding:8px 11px;margin:0;position:absolute;letter-spacing:normal;color:#fff;background:#50b952;border-radius:0 5px 5px 0;transition:all linear .3s;font-family:Roboto,sans-serif}.game_name_2{font-size:10px;line-height:12px;margin-bottom:3px;-webkit-line-clamp:3;height:36px;overflow:hidden;display:-webkit-box;-webkit-box-orient:vertical;color:#348daf;letter-spacing:normal;font-weight:500;font-family:Roboto,sans-serif}.game_public{font-size:10px;line-height:12px;margin:0;font-family:Roboto,sans-serif;display:flex;align-items:center;letter-spacing:normal;color:#bbbbbe;padding:5px 0}.short_desc{font-size:14px;line-height:16px;letter-spacing:normal;margin-bottom:10px;margin-top:15px;display:none;transition:all linear .3s;font-family:Roboto,sans-serif}.see_more{font-weight:500;font-size:14px;line-height:16px;letter-spacing:normal;color:#50b952;float:right;clear:both;display:none;transition:all linear .3s;font-family:Roboto,sans-serif}.box_game_2:hover .see_more,.box_game_2:focus .see_more{display:inline-block}#list_top_game .pagination{width:100%;display:flex;justify-content:flex-end;margin:0;padding-left:0;border-radius:4px}#list_top_game .pagination > li{margin:0 5px;display:inline}#list_top_game .pagination > li > a:focus,#list_top_game .pagination > li > a:hover,#list_top_game .pagination > li > span:focus,#list_top_game .pagination > li > span:hover,#list_top_game .pagination > li.active > a{color:#fff;border-color:#50b952;background:#50b952;z-index:2;cursor:default;font-family:Roboto,sans-serif}#list_top_game .pagination > li > a,#list_top_game .pagination > li > span{padding:10px 14px;line-height:15px;font-size:13px;border:1px solid #50b952;margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px;text-decoration:none;font-family:Roboto,sans-serif;color:#333}#ga_type{margin-bottom:43px;margin-top:30px}.ga_title{border-bottom:2px solid #348daf;margin-bottom:27px;clear:both}#list_game_type{padding:0 27px;background:none;position:unset;margin-bottom:0;justify-content:space-between;width:inherit;left:0;display:flex;flex-wrap:wrap;list-style-type:none}#list_game_type li{width:45%;margin-bottom:29px}#list_game_type li a{text-align:center;border:1px solid transparent;transition:all linear .3s;display:block;background:#fff;box-shadow:0 4px 10px rgba(0,0,0,0.2);border-radius:5px;padding:22px 19px 0}#list_game_type li a span{display:block;margin-top:3px;font-weight:500;font-size:16px;line-height:19px;letter-spacing:normal;text-transform:capitalize;color:#333;font-family:Roboto,sans-serif}#list_game_type li a::after{content:"";display:block;height:4px;width:100%;border-radius:5px 5px 0 0;background:transparent;transition:all linear .3s;margin-top:20px}.bg_box amp-img{border-radius:10px}#ga_header .game-hot > div:nth-child(1){width:100%;margin-bottom:12px;margin-left:9px;margin:0 auto 9px;clear:both}#ga_header .game-hot > div:nth-child(1) .game_thumb_1{width:100%;border-radius:15px 15px 0 0;overflow:hidden;position:relative;bottom:-4px}#ga_header .game-hot > div:nth-child(2){margin-left:0}#ga_header .game-hot > div:nth-child(2),#ga_header .game-hot > div:nth-child(3){margin-left:0;width:48.8%;border-radius:10px;overflow:hidden;float:left;justify-content:space-between}#ga_header .game-hot > div:nth-child(2) .game_thumb_1,#ga_header .game-hot > div:nth-child(3) .game_thumb_1{width:100%;border-radius:0;bottom:-4px}.game_thumb_1{display:block;width:100%;border-radius:15px 0 0 0;overflow:hidden;position:relative}.game-hot{padding:0;padding-left:0;list-style:none;display:flex;justify-content:space-between;width:100%;padding-top:14px;flex-wrap:wrap}#list_hot_game{position:relative;overflow:hidden}.box_show{display:flex;justify-content:space-between;padding:11px 0 12px;border-bottom:1px solid #c8c8be}.box_show:last-child{border-bottom:0}.box_show a{display:block;width:127px;margin-right:18px}.game_desc_3{flex:1}.game_desc_3 a{font-family:Roboto,sans-serif;font-weight:500;font-size:14px;line-height:16px;letter-spacing:.05em;color:#333;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:6px;width:100%;height:auto}.box_game_2:hover .short_desc,.box_game_2:focus .short_desc{display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:4;overflow:hidden}#ga_header{margin-bottom:43px;padding:0}.game_public_1{display:none}.box_game_1:nth-child(1) .game_public_1{display:block}.container-ft{background:#cddce3}.row-ft{width:85%;padding:10px 30px}.row-ft ul{padding:0;list-style-type:none}.container-ft h2{margin:10px 0;font-size:19px;font-family:Roboto,sans-serif;color:#333;font-weight:500;line-height:1.42857143}.container-ft p{font-size:14px;font-family:Roboto,sans-serif;color:#333;line-height:1.42857143;margin:0}.container-ft p span{font-weight:700}.container-ft a{color:#337ab7;text-decoration:none;font-family:Roboto,sans-serif;font-size:14px;display:flex;line-height:1.42857143}@media screen and (max-width: 768px){.bg_box > div{margin-left:10px}}@media screen and (max-width: 340px){.box_game_2{width:48%}}@media screen and (max-width: 300px){.box_game_2{width:48%}.bg_box > div{width:87%}}@media screen and (max-width: 380px){.bg_box > div{width:90.5%}}@media only screen and (max-width: 414px){.topbank amp-img:nth-child(2),.topbank amp-img:nth-child(5),.topbank amp-img:nth-child(8),.topbank amp-img:nth-child(11){margin-left:10px;margin-right:10px}.topbank amp-img{margin:10px 0;width:29%}}@media only screen and (max-width: 310px){.topbank amp-img:nth-child(2),.topbank amp-img:nth-child(5),.topbank amp-img:nth-child(8),.topbank amp-img:nth-child(11){margin-left:10px;margin-right:10px}.topbank amp-img{margin:10px;width:29%}}
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
    <div id="wp_app_game">
        <div class="container_ga">
            <div id="ga_header">
                <div class="slide">
                <amp-carousel id="carousel-with-preview" width="450" height="300" layout="responsive" type="slides" role="region" aria-label="Carousel with slide previews" >
                        <?
                        $i1 = 0;
                        while ($rowtop = mysql_fetch_assoc($db_top->result)) {
                            if (array_key_exists($rowtop['category_parent_id'], $db_cat)) {
                                $CategoryName = $db_cat[$rowtop['category_parent_id']]['CategoryName'];
                                $gt_name1 = rewriteNews($rowtop['category_parent_id'], $CategoryName);
                            }else{
                                $CategoryName = "Game app";
                            }
                            $url1 = rewrite_news($rowtop['Id'], $rowtop['ShortTitle'], 'app-tro-choi');
                            $i1++;
                        ?>
                            <div class="box_game_1">
                                <div class="game_thumb_1">
                                    <amp-img layout="intrinsic"  width=900 height=500 src="https://banthe24h.vn//pictures/news/<?= $rowtop['ImageUrl']; ?>" alt="<?= $rowtop['Title']; ?>"></amp-img>
                                    <a class="smg" href="<?= $gt_name1 ?>" title="Xem thêm game <?= $CategoryName ?>"><?= $CategoryName ?></a>
                                </div>
                                <div class="game-des">
                                    
                                    <div class="game_desc_1">
                                        <div class="desc_1">
                                            <a href="<?= $url1; ?>" class="game_name_1" title="<?= $rowtop['Title']; ?>"><?= $rowtop['Title']; ?></a>
                                            <p class="game_public_1">
                                                <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock.png" alt="clock"></amp-img>
                                                <span><?= date("d/m/Y h:i:s A", strtotime($rowtop['PublicDate'])) ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?
                            if ($i1 == 4) {
                                break;
                            }
                        }
                        ?>
                    </amp-carousel>
                    <div class="carousel-preview" >
                    <button on="tap:carousel-with-preview.goToSlide(index=0)"></button>
                    <button on="tap:carousel-with-preview.goToSlide(index=1)"></button>
                    <button on="tap:carousel-with-preview.goToSlide(index=2)"></button>
                    <button on="tap:carousel-with-preview.goToSlide(index=3)"></button>
                    </div>
                </div>
                <!-- End slider -->
                <div class="game-hot">
                <?
                while ($rowtop = mysql_fetch_assoc($db_top->result)) {
                    $url1 = rewrite_news($rowtop['Id'], $rowtop['ShortTitle'], 'app-tro-choi');
                ?>
                    <div class="box_game_1">
                        <div class="game_thumb_1">
                            <amp-img layout="intrinsic"  width=900 height=500 src="https://banthe24h.vn//pictures/news/<?= $rowtop['ImageUrl']; ?>" alt="<?= $rowtop['Title']; ?>"></amp-img>
                            <a href="<?= $gt_name1 ?>" title="Xem thêm game <?= $CategoryName ?>"><?= $CategoryName ?></a>
                        </div>
                        <div class="game_desc_1">
                            <a href="<?= $url1; ?>" class="game_name_1" title="<?= $rowtop['Title']; ?>"><?= $rowtop['Title']; ?></a>
                            <p class="game_public_1">
                                <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock.png" alt="clock"></amp-img>
                                <span><?= date("d/m/Y h:i:s A", strtotime($rowtop['PublicDate'])) ?></span>
                            </p>
                        </div>
                    </div>
                <?
                    $i1++;
                    if ($i1 == 7) {
                        break;
                    }
                }
                ?>
                </div>
                <div class="clr"></div>
            </div>
            <!-- End ga_header -->
            <div id="ga_content">
                <div id="top_game">
                    <div class="ga_title"><span>Game nổi bật</span></div>
                    <div id="list_top_game">
                        <?
                        while ($row2 = mysql_fetch_assoc($db_tgame->result)) {
                            if (array_key_exists($row2['category_parent_id'], $db_cat)) {
                                $CategoryName1 = $db_cat[$row2['category_parent_id']]['CategoryName'];
                                $gt_name2 = rewriteNews($row2['category_parent_id'], $CategoryName1);
                            }
                            $url2 = rewrite_news($row2['Id'], $row2['ShortTitle'], 'app-tro-choi');
                        ?>
                            <div class="box_game_2">
                                <div class="bg_box">
                                    <amp-img layout="intrinsic"  width=900 height=700 src="https://banthe24h.vn//pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title']; ?>"></amp-img>
                                    <div>
                                        <a href="<?= $gt_name2 ?>" class="game_type" title="Xem thêm game <?= $CategoryName1 ?>"><?= $CategoryName1 ?></a>
                                        <div class="game_desc_2">
                                            <a href="<?= $url2; ?>" class="game_name_2" title="<?= $row2['Title']; ?>"><?= $row2['Title']; ?></a>
                                            <p class="game_public">
                                                <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xanh.png" alt="clock"></amp-img>
                                                <span><?= date("d/m/Y h:i:s A", strtotime($row2['PublicDate'])) ?></span>
                                            </p>
                                            <p class="short_desc"><?= trim(removeHTML($row2['Intro'])) ?></p>
                                            <a href="<?= $url2; ?>" class="see_more" title="Xem thêm">Xem thêm >></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?
                        }
                        ?>
                        <div class="pull-right pagination">
                            <div class="col-sm-12" style="text-align:right">
                                <ul class="pagination">
                                    <?
                                    echo generatePageBar3('', $page, $curentPage, $count, rewriteNews($catid, $rowinfo['CategoryName']), '?', '', 'active', 'preview', '<', 'next', '>', 'first', 'Đầu', 'last', 'Cuối');
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End top_game -->

                <div id="hot_game">
                    <div class="ga_title"><span>Game hot trong tuần</span></div>
                    <div id="list_hot_game">
                        <?
                        while ($row3 = mysql_fetch_assoc($db_wgame->result)) {
                            $url3 = rewrite_news($row3['Id'], $row3['ShortTitle'], 'app-tro-choi');
                        ?>
                            <div class="box_game_3">
                                <div class="box_show">
                                    <a href="<?= $url3 ?>" title="<?= $row3['Title'] ?>"><amp-img layout="intrinsic"  width=900 height=600 src="https://banthe24h.vn//pictures/news/<?= $row3['ImageUrl']; ?>" alt="<?= $row3['Title'] ?>"></amp-img></a>
                                    <div class="game_desc_3">
                                        <a href="<?= $url3 ?>" class="game_name_3"><?= $row3['Title'] ?></a>
                                        <p class="game_public">
                                            <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                            <span><?= date("d/m/Y h:i:s A", strtotime($row3['PublicDate'])) ?></span>
                                        </p>
                                        <a href="<?= $url3 ?>" title="Xem thêm" class="see_more_hg">Xem thêm</a>
                                    </div>
                                </div>
                                <div class="box_hover"></div>
                            </div>
                        <?
                        }
                        ?>
                    </div>
                </div>
                <!-- End hot_game -->
            </div>
            <!-- End ga_content -->
            <div id="ga_type">
                <div class="ga_title"><span>Thể loại game</span></div>
                <ul id="list_game_type">
                    <?
                    foreach ($db_cat as $item) {
                        if ($item['CategoryID'] >= 1016 && $item['CategoryID'] <= 1028) {
                            $url_r = rewriteNews($item['CategoryID'], $item['CategoryName']);
                            // $src = "/images/app_game/".replaceTitle($item['CategoryName']).".png";
                            // $type_name = replaceTitle($item['CategoryName'])
                    ?>
                            <li>
                                <a href="<?= $url_r ?>" title="<?= $item['CategoryName'] ?>">
                                    <amp-img layout="intrinsic"  width=47 height=47 src="/images/app_game/<?= replaceTitle($item['CategoryName']) ?>.png" alt="<?= $item['CategoryName'] ?>"></amp-img>
                                    <span><?= $item['CategoryName'] ?></span>
                                </a>
                            </li>
                            <!-- <li class="game_type"><a target="blank" title="<?= $item['CategoryName'] ?>" href="<?= $url_r ?>"><?= $item['CategoryName'] ?></a></li> -->
                    <?
                        }
                    }
                    ?>
                </ul>
            </div>
            <!-- End ga_type -->
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
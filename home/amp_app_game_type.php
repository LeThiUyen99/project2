<? 
include("config.php");
$catid = getValue('id', 'int', 'GET', 1);

// Game moi cap nhat
$db_ngame = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy,articles.Description
FROM articles
LEFT JOIN categories ON categories.CategoryID = $catid
WHERE IsActive = 1 AND category_parent_id = categories.CategoryID
ORDER BY Id DESC LIMIT 4");

//Game xem nhieu
$db_tgame = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy,articles.Description
FROM articles
LEFT JOIN categories ON categories.CategoryID = $catid
WHERE IsActive = 1 AND category_parent_id = categories.CategoryID
ORDER BY view DESC, Id DESC LIMIT 4");


$db_qr = new db_query("SELECT * FROM categories");
$db_cat = $db_qr->result_array('CategoryID');
$type_name = $db_cat[$catid]['CategoryName'];
$title = "Tổng hợp trò chơi " . $type_name;
$desc = $db_cat[$catid]['MetaDesc'];
$meta = $db_cat[$catid]['Meta'];

$url_r = rewriteNews($catid, $type_name);
$url_r = $urlwebsite . $url_r;
$urluri = $_SERVER['REQUEST_URI'];
$urluri = $urlwebsite . $urluri;
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
        <title><?= $title ?></title>
    <meta name="description" content="<?= $desc ?>" />
    <meta name="keywords" content="<?= $meta ?>" />
    <meta name="robots" content='noodp,index,follow' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-language" content="vi" />
    <meta name="author" itemprop="author" content="banthe24h.vn" />
    <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
    <link rel="canonical" href="<?= $url_r ?>" />
    <meta property="og:image:url" content="https://banthe24h.vn/pictures/news/2020/10/09/bfj1602207838.jpg">
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content="<?= $title ?>">
    <meta property="og:url" itemprop="url" content="<?= $url_r ?>">
    <meta property="og:description" itemprop="description" content="<?= $desc ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content="https://banthe24h.vn/pictures/news/2020/10/09/bfj1602207838.jpg">
    <meta name="twitter:description" content="<?= $desc ?>">
    <meta name="twitter:title" content="<?= $title ?>">
    <meta name="twitter:site" content="banthe24h.vn">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
        *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.container1{display:flex;justify-content:space-between;align-items:center;padding:10px 25px 10px 0;background:linear-gradient(white,#fff,#fff,#f3f3f3)}.row1{width:100%}#showMenu{float:right;border:1px solid #e75a1d;background:#e75a1d;border-radius:5px;padding:5px 10px;margin-top:10px}.icon-bar{width:22px;height:2px;background-color:#fff;margin:4px 0}.menu-nav{float:right;font-weight:700;margin-right:5px;margin-top:5px}.menu ul{padding-top:30px;padding-left:10px}.menu ul a{padding:9px 7px;color:#000;font-family:Roboto,sans-serif;font-size:14px;line-height:28px}a{text-decoration:none}.container_ga{width:95%;margin:auto}.game_type_title{margin:16px 0 33px;font-size:20px;line-height:23px;letter-spacing:normal;text-transform:uppercase;color:#348DAF;font-weight:500;text-align:center;font-family:'Roboto'}.ga_title{margin-bottom:39px;border-bottom:2px solid #348DAF;clear:both}.ga_title span{text-indent:15px;font-size:18px;line-height:21px;font-weight:500;letter-spacing:normal;text-transform:capitalize;color:#348DAF;display:inline-block;font-family:Roboto}#wp_game_type .ga_title span::after{content:"";display:block;width:105%;height:4px;background:#348DAF;border-radius:5px 5px 0 0;margin-top:5px}.box_game_t{padding:0 12px;padding-bottom:30px}.box_game_2{margin-right:7px;margin:0 auto 120px;flex-grow:unset}.box_game_2 amp-img{border-radius:9px}.bg_box>div{position:absolute;background:#FFF;box-shadow:0 3px 10px rgba(0,0,0,0.2);border-radius:10px;padding:18px 13px;transition:all linear .3s;margin-top:-37px;width:89.5%}.bg_box>div .game_type{line-height:14px;font-size:12px;padding:8px 11px;background:#50B952;border-radius:0 5px 5px 0;transition:all linear .3s;top:-36px;letter-spacing:normal;color:#FFF;margin:0;position:absolute;left:0;font-family:Roboto}#wp_game_type .game_name_2{font-size:14px;line-height:16px;margin-bottom:12px;-webkit-line-clamp:2;font-weight:500;letter-spacing:normal;color:#348DAF;display:-webkit-box;-webkit-box-orient:vertical;overflow:hidden;font-family:'Roboto'}.game_public{font-size:10px;line-height:12px;margin:0;letter-spacing:normal;color:#348DAF;display:flex;align-items:center;font-family:'Roboto'}.box_game_3{border-bottom:1px solid #C8C8BE;display:flex}.box_game_3 .box_show{display:flex}.box_game_3:nth-child(4){border-bottom:none}.box_hover{display:none}.game_name_3{overflow:hidden;display:-webkit-box;-webkit-box-orient:vertical;letter-spacing:normal;color:#000;font-weight:500;font-size:13px;line-height:15px;-webkit-line-clamp:3;margin-bottom:7px;font-family:'Roboto'}.box_game_3 .box_show amp-img{width:145px;height:100px}.box_game_3 .box_show a{padding:10px 0;padding-right:10px}.game_desc_3 .game_public{font-size:12px;line-height:14px;letter-spacing:normal;color:#BBBBBE}#wp_game_type .game_desc_3 .game_type{display:none}#list_game_type{background:none;position:unset;margin-bottom:0;justify-content:space-between;width:inherit;flex-wrap:wrap;display:flex;padding:0 27px;list-style-type:none}#list_game_type li.active a::after{background:#50B952}#list_game_type li a::after{content:"";display:block;height:4px;width:100%;border-radius:5px 5px 0 0;background:transparent;transition:all linear .3s;margin-top:20px}#list_game_type li:first-child{margin-left:0;margin-bottom:29px;width:135px;margin-right:0}#list_game_type li.active a{border:1px solid #50B952}#list_game_type li a{padding:22px 19px 0;display:block;background:#FFF;box-shadow:0 4px 10px rgba(0,0,0,0.2);border-radius:5px;text-align:center;transition:all linear .3s}#list_game_type li a span{display:block;margin-top:3px;font-weight:500;font-size:16px;line-height:19px;letter-spacing:normal;text-transform:capitalize;color:#333;font-family:Roboto}#list_game_type li{width:135px;margin-right:0;margin-bottom:29px}#list_game_type li a:hover{border:1px solid #50B952}#list_game_type li a:hover::after{background:#50B952}.topbank{text-align:center}.topbank .banksupport{margin-top:15px;text-align:center;background-image:url(../images/bgbank.jpg);background-position:left bottom;background-repeat:repeat-x}.topbank .banksupport span{background-color:#3f98bc;border-top-left-radius:3px;border-top-right-radius:3px;line-height:33px;color:#fff;text-transform:uppercase;padding:5px 10px;font-family:Roboto,sans-serif;font-size:14px}.topbank amp-img{margin:10px;transition:all .5s ease 0;border:1px solid #ccc}.lienhe{display:flex;flex-wrap:wrap}.game_thumb_1 a{line-height:14px;font-size:12px;padding:8px 11px;background:#50b952;border-radius:0 5px 5px 0;letter-spacing:normal;color:#fff;position:absolute;bottom:8px;left:0;text-decoration:none;font-family:Roboto,sans-serif}.game-des .smg{line-height:14px;font-size:12px;padding:8px 11px;background:#50b952;border-radius:0 5px 5px 0;letter-spacing:normal;color:#fff;position:absolute;bottom:8px;left:0;text-decoration:none;font-family:Roboto,sans-serif}.game-des{bottom:0;width:100%}.container-ft{background:#cddce3}.row-ft{width:85%;padding:10px 30px}.row-ft ul{padding:0;list-style-type:none}.container-ft h2{margin:10px 0;font-size:19px;font-family:Roboto,sans-serif;color:#333;font-weight:500;line-height:1.42857143}.container-ft p{font-size:14px;font-family:Roboto,sans-serif;color:#333;line-height:1.42857143;margin:0}.container-ft p span{font-weight:700}.container-ft a{color:#337ab7;text-decoration:none;font-family:Roboto,sans-serif;font-size:14px;display:flex;line-height:1.42857143}@media(min-width: 500px) and (max-width: 600px){.bg_box>div{width:90.5%}}@media(min-width: 601px) and (max-width: 770px){.bg_box>div{width:92%}}@media screen and (max-width: 280px){.bg_box>div{width:86.5%}}@media only screen and (max-width: 414px){.topbank amp-img:nth-child(2),.topbank amp-img:nth-child(5),.topbank amp-img:nth-child(8),.topbank amp-img:nth-child(11){margin-left:10px;margin-right:10px}.topbank amp-img{margin:10px 0;width:29%}}@media only screen and (max-width: 310px){.topbank amp-img:nth-child(2),.topbank amp-img:nth-child(5),.topbank amp-img:nth-child(8),.topbank amp-img:nth-child(11){margin-left:10px;margin-right:10px}.topbank amp-img{margin:10px;width:29%}}
    </style>
</head>
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
    <div id="wp_game_type">
        <div class="container_ga">
            <h1 class="game_type_title text-center">Game <?= $type_name ?> Hấp dẫn</h1>

            <div id="list_new_game">
                <div class="ga_title"><span>Game <?= $type_name ?> mới cập nhật</span></div>

                <div class="box_game_t">
                    <?
                    $i1 = 0;
                    while ($row1 = mysql_fetch_assoc($db_ngame->result)) {
                        $url1 = rewrite_news($row1['Id'], $row1['ShortTitle'], 'app-tro-choi');
                        $i1++;
                    ?>
                        <div class="box_game_2">
                            <div class="bg_box">
                                <amp-img layout="intrinsic" width="900" height="500"  src="https://banthe24h.vn//pictures/news/<?= $row1['ImageUrl']; ?>" alt="<?= $row1['Title'] ?>"></amp-img>
                                
                                <div>
                                    <p class="game_type"><?= $type_name ?></p>
                                    <div class="game_desc_2">
                                        <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>" class="game_name_2"><?= $row1['Title'] ?></a>
                                        <p class="game_public">
                                            <amp-img width="10" height="10"  src="/images/app_game/ic_clock_xanh.png" alt="clock"></amp-img>
                                            <span><?= date("d/m/Y h:i:s A", strtotime($row1['PublicDate'])) ?></span>
                                        </p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <?
                        if ($i1 == 1) {
                            break;
                        }
                    }
                    ?>
                    <?
                    while ($row1 = mysql_fetch_assoc($db_ngame->result)) {
                        $url1 = rewrite_news($row1['Id'], $row1['ShortTitle'], 'app-tro-choi');
                    ?>
                        <div class="box_game_3">
                            <div class="box_show">
                                <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>"><amp-img layout="intrinsic" width="250" height="180"  src="https://banthe24h.vn//pictures/news/<?= $row1['ImageUrl']; ?>" alt="<?= $row1['Title'] ?>"></amp-img></a>
                                <div class="game_desc_3">
                                    <a href="<?= $url1 ?>" class="game_name_3"><?= $row1['Title'] ?></a>
                                    <p class="game_public">
                                        <amp-img width="10" height="10"  src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                        <span><?= date("d/m/Y h:i:s A", strtotime($row1['PublicDate'])) ?></span>
                                    </p>
                                    <p class="game_type"><?= $type_name ?></p>
                                </div>
                            </div>
                            <div class="box_hover"><a href="<?= $url1 ?>" class="see_more_hg">Xem thêm</a></div>
                        </div>
                    <?
                        $i1++;
                        if ($i1 == 4) {
                            break;
                        }
                    }
                    ?>
                    <div class="clr"></div>
                </div>
            </div>
            <!-- End list_new_game -->

            <div id="top_tiew_game" data-catid="<?= $catid ?>">
                <div class="ga_title"><span>Game <?= $type_name ?> xem nhiều</span></div>
                <div class="list_tvg">
                    <div class="box_game_t">
                        <?
                        $i2 = 0;
                        while ($row2 = mysql_fetch_assoc($db_tgame->result)) {
                            $url2 = rewrite_news($row2['Id'], $row2['ShortTitle'], 'app-tro-choi');
                            $i2++;
                        ?>
                            <div class="box_game_2" data-id="<?= $row2['Id'] ?>">
                                <div class="bg_box">
                                    <amp-img layout="intrinsic" width="900" height="500"  src="https://banthe24h.vn//pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>"></amp-img>
                                    <div>
                                        <p class="game_type"><?= $type_name ?></p>
                                        <div class="game_desc_2">
                                            <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>" class="game_name_2"><?= $row2['Title'] ?></a>
                                            <p class="game_public">
                                                <amp-img layout="intrinsic" width="10" height="10"  src="/images/app_game/ic_clock_xanh.png" alt="clock"></amp-img>
                                                <span><?= date("d/m/Y h:i:s A", strtotime($row2['PublicDate'])) ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?
                            if ($i2 == 1) {
                                break;
                            }
                        }
                        ?>
                        <?
                        while ($row2 = mysql_fetch_assoc($db_tgame->result)) {
                            $url2 = rewrite_news($row2['Id'], $row2['ShortTitle'], 'app-tro-choi');
                        ?>
                            <div class="box_game_3" data-id="<?= $row2['Id'] ?>">
                                <div class="box_show">
                                    <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>"><amp-img layout="intrinsic" width="180" height="50"  src="https://banthe24h.vn//pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>"></amp-img></a>
                                    <div class="game_desc_3">
                                        <a href="<?= $url2 ?>" class="game_name_3"><?= $row2['Title'] ?></a>
                                        <p class="game_public">
                                            <amp-img width="10" height="10"  src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                            <span><?= date("d/m/Y h:i:s A", strtotime($row2['PublicDate'])) ?></span>
                                        </p>
                                        <p class="game_type"><?= $type_name ?></p>
                                    </div>
                                </div>
                                <div class="box_hover"><a href="<?= $url2 ?>" class="see_more_hg">Xem thêm</a></div>
                            </div>
                        <?
                            $i2++;
                            if ($i2 == 4) {
                                break;
                            }
                        }
                        ?>
                        <div class="clr"></div>
                    </div>

                </div>
                <!-- <div class="see_more_tvg">
                    <a id="append_data" data-id="1" href=""><i class="fa">&#xf01e;</i> Xem thêm</a>
                    <div class="list_loading">
                        <div class="loading_show">
                            <span class="rect1"></span>
                            <span class="rect2"></span>
                            <span class="rect3"></span>
                            <span class="rect4"></span>
                            <span class="rect5"></span>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- End top_tiew_game -->

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
                            <li <?= ($item['CategoryID'] == $catid) ? "class='active'" : ''; ?>>
                                <a href="<?= $url_r ?>" title="<?= $item['CategoryName'] ?>">
                                    <amp-img layout="intrinsic" width="47" height="47"  src="/images/app_game/<?= replaceTitle($item['CategoryName']) ?>.png" alt="<?= $item['CategoryName'] ?>"></amp-img>
                                    <span><?= $item['CategoryName'] ?></span>
                                </a>
                            </li>
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
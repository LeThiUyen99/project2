<?
include("config.php");
$catid = getValue('id', 'int', 'GET', 1);

// Game moi cap nhat
$db_ngame = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy,articles.Description
                            FROM articles 
                            LEFT JOIN categories ON categories.CategoryID = $catid
                            WHERE IsActive = 1 AND category_parent_id = categories.CategoryID
                            ORDER BY Id DESC LIMIT 5");

//Game xem nhieu
$db_tgame = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy,articles.Description,view
                            FROM articles 
                            LEFT JOIN categories ON categories.CategoryID = $catid
                            WHERE IsActive = 1 AND category_parent_id = categories.CategoryID
                            ORDER BY view DESC, Id DESC LIMIT 5");


$db_qr   = new db_query("SELECT * FROM categories");
$db_cat  = $db_qr->result_array('CategoryID');
$type_name = $db_cat[$catid]['CategoryName'];
$title = "Tổng hợp trò chơi " . $type_name;
$desc = $db_cat[$catid]['MetaDesc'];
$meta = $db_cat[$catid]['Meta'];

$url_r = rewriteNews($catid, $type_name);
$urluri = $_SERVER['REQUEST_URI'];

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
    <meta name="robots" content='noodp,index,follow' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-language" content="vi" />
    <meta name="author" itemprop="author" content="banthe247.com" />
    <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
    <link rel="canonical" href='https://banthe247.com<?= $url_r ?>' />
    <meta property="og:image:url" content="https://banthe247.com/upload/files/mua-the-dien-thoai.png">
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content='<?= $title ?>'>
    <meta property="og:url" itemprop="url" content='https://banthe247.com<?= $url_r ?>'>
    <meta property="og:description" itemprop="description" content='<?= $desc ?>'>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content="https://banthe247.com/upload/files/mua-the-dien-thoai.png">
    <meta name="twitter:description" content='<?= $desc ?>'>
    <meta name="twitter:title" content='<?= $title ?>'>
    <meta name="twitter:site" content="banthe247.com">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>

    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
        *{font-family:Roboto,sans-serif}@font-face{font-family:Roboto,sans-serif;src:url(roboto/Roboto-Regular.ttf);font-display:swap}@font-face{font-family:Roboto-Medium,sans-serif;src:url(roboto/Roboto-Medium.ttf);font-display:swap}@font-face{font-family:Roboto-Bold,sans-serif;src:url(roboto/Roboto-Bold.ttf);font-display:swap}.reg{float:left;width:100%;background:#0098db}.mxh{float:right;padding:5px}.hotline{color:#fff;font-size:14px}.sky{background:url(/images/skype.png) no-repeat left;padding-left:25px;color:#337ab7;font-size:14px}.menu{background:#f8f8f8;padding:0 15px}#showMenu{float:right;border:1px solid #e75a1d;background:#e75a1d;border-radius:5px;padding:5px 10px;margin-top:10px}.icon-bar{width:22px;height:2px;background-color:#fff;margin:4px 0}.menu-nav{float:right;font-weight:700;margin-right:5px;margin-top:5px}.menu ul{padding-top:30px;padding-left:10px}.menu ul li{list-style-type:none;padding:7px 0}.menu ul li a{font-size:15px;padding:7px 10px;color:#777;font-weight:400;font-family:Roboto,sans-serif;line-height:20px}a{text-decoration:none}.container_ga{padding:0 13px;width:93.5%;margin:auto}#wp_app_game_type h1{letter-spacing:.05em;text-transform:uppercase;color:#0f70b8;font-weight:500;text-align:center;font-family:Roboto-Bold,sans-serif;font-size:18px;line-height:21px;margin:17px 0 42px}#wp_app_game_type h1 span:last-child{color:#f79823}.ga_title{color:#f79a27;line-height:23px;letter-spacing:.05em;text-transform:capitalize;border-bottom:1px solid #c8c8be;font-weight:500;font-family:Roboto-Bold,sans-serif;font-size:18px;margin-bottom:13px}.ga_title span:first-child{border-bottom:3px solid #f79a27;color:#3a70bf}.ga_title span{padding-bottom:6px;display:inline-block}.list_item{justify-content:space-between;padding-top:11px;display:block;margin-bottom:55px}.content_gt_left{width:100%;display:block;margin-bottom:18px;padding-bottom:8px;border-bottom:1px solid #bbbbbe;justify-content:space-between;margin-right:0}.content_gt_left>a{margin-right:35px;display:block;width:100%;margin-bottom:12px}.content_gt_left .big_game_info{padding-top:0;flex:1}.game_name_3{font-size:14px;line-height:16px;letter-spacing:.05em;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:12px;font-weight:700;font-family:Roboto-Bold,sans-serif;color:#333}.game_fee{position:unset;display:inline-block;border-radius:5px;font-size:12px;line-height:14px;padding:6px 8px;top:-24px;background:#0f70b8;letter-spacing:.05em;color:#fff;margin:0;left:0;font-family:Roboto,sans-serif}.big_game_info .game_info{margin:12px 0;display:block;flex-direction:column-reverse;font-size:10px;line-height:12px;letter-spacing:.05em;color:#bbbbbe;position:relative;z-index:1}.game_type_2{color:#0f70b8;margin-right:20px;font-family:Roboto,sans-serif;font-size:14px}.short_desc{-webkit-line-clamp:3;font-size:14px;line-height:16px;display:-webkit-box;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:12px}p{margin:0 0 10px}.short_desc span{font-family:Roboto,sans-serif;font-size:16px;line-height:19px;letter-spacing:.05em;margin-bottom:18px;display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden}.big_game_info .see_more{background:#f79a27;display:inline-block;width:24px;height:24px;line-height:24px;border-radius:50%;text-align:center}.see_more span{font-size:10px;position:relative;top:-2px}.big_game_info .see_more span{color:#fff}.content_gt_right{flex:1}.list_show_more{flex-wrap:wrap;margin:0 auto;margin-top:-11px;width:100%;display:flex;justify-content:space-between}.box_game_3{flex:unset;width:45.5%;background:0 0;padding:11px 8px;transition:all linear .3s}.game_thumb_3{margin-bottom:12px;display:block;width:100%}.game_info,.game_public{font-size:10px;line-height:12px;display:inline-block;margin-bottom:0;letter-spacing:.05em;color:#bbbbbe;position:relative;z-index:1}.list_game_type{padding:0}.amp-carousel-slide{width:40%;padding:0 14px}.list_game_type li a{display:flex;border:1px solid #bbbbbe;box-sizing:border-box;box-shadow:0 4px 10px rgba(0,0,0,.15);border-radius:0 10px 10px 10px;padding:22px 19px;text-align:center;transition:all .3s;justify-content:center;flex-wrap:wrap}.list_game_type li a span{display:block;font-weight:700;font-size:16px;line-height:19px;letter-spacing:.05em;text-transform:capitalize;color:#333;margin-top:7px;width:100%;font-family:Roboto,sans-serif}.carousel-preview{text-align:center}.cty{font-size:14px;font-weight:bold}.vanphong,.dienthoai,.mail{font-size:14px}.carousel-preview button{border:1px solid #0f70b8;border-radius:50%;width:7px;height:15px;margin:5px;outline:0}.carousel-preview button:active{width:15px;height:16px;transform:scale(1.4);background:#0f70b8;border:1px solid #0f70b8}.amp-carousel-button-next,.amp-carousel-button-prev{display:none}footer{display:flex;background:url(/images/footer.jpg) no-repeat center;background-size:100% 100%;padding:0 15px}footer p{font-family:Roboto,sans-serif;color:#fff;padding:5px;margin:0;display:flex;width:100%}.thongtin{font-size:24px}.col-lg-12{text-align:center;padding:0 15px;padding-bottom:5px}.text-theme{color:#ccc}#call_icon{position:fixed;right:10px;bottom:80px;z-index:9999999}.copyrightft{display:block;text-align:center;padding:5px;font-size:11px}a{color:#337ab7;text-decoration:none}.fa{display:inline-block;font:normal normal normal 14px/1 FontAwesome;font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;padding-right:5px}.fa-company:before{content:"\f275"}.fa-adress:before{content:"\f279"}.fa-phone:before{content:"\f098"}.fa-mail:before{content:"\f199"}.fa-sm:before{content:"\f118"}.fa-monney:before{content:"\f155"}.fa-secur:before{content:"\f023"}@media screen and (max-width:380px){.box_game_3{width:44.5%}}@media screen and (max-width:300px){.box_game_3{width:43.8%}.list_game_type li a span{font-size:14px}}
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
                        <a href="skype:live:binhminhmta123?chat"> <span class="sky">banthe247.com</span></a>
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
    <div id="wp_app_game_type">
        <div class="container_ga">
            <h1><span>Game <?= $type_name ?></span> <span>hấp dẫn</span></h1>

            <div id="wp_list_new_game">
                <div class="ga_title"><span>Game <?= $type_name ?></span> <span>mới cập nhật</span></div>

                <div class="list_item">
                    <?
                    $i1 = 0;
                    while ($row1 = mysql_fetch_assoc($db_ngame->result)) {
                        $i1++;
                        $url1 = rewrite_news($row1['Id'], $row1['ShortTitle'], 'game-app');
                    ?>
                        <div class="content_gt_left">
                            <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>"><amp-img layout="intrinsic"  width=900 height=500 src="https://banthe247.com/pictures/news/<?= $row1['ImageUrl']; ?>" alt="<?= $row1['Title'] ?>"></amp-img></a>
                            <div class="big_game_info">
                                <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>" class="game_name_3"><?= $row1['Title'] ?></a>
                                <p class="game_fee"><span>Miễn phí</span></p>
                                <div class="game_info">
                                    <p class="game_type_2"><?= $type_name ?></p>
                                    <p class="game_public">
                                        <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                        <span><?= date("d/m/Y   h:i:s A", strtotime($row1['PublicDate'])) ?></span>
                                    </p>
                                </div>
                                <div class="short_desc"><?= $row1['Intro'] ?></div>
                                <a href="<?= $url1 ?>" class="see_more" title="Xem thêm"><span>⟶</span></a>
                            </div>
                        </div>
                        <!-- End content_gt_left -->
                    <?
                        if ($i1 == 1) {
                            break;
                        }
                    }
                    ?>

                    <div class="content_gt_right">
                        <div class="list_show_more">
                            <?
                            while ($row1 = mysql_fetch_assoc($db_ngame->result)) {
                                $url1 = rewrite_news($row1['Id'], $row1['ShortTitle'], 'game-app');
                            ?>
                                <div class="box_game_3">
                                    <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>" class="game_thumb_3"><amp-img layout="intrinsic"  width=900 height=500 src="https://banthe247.com/pictures/news/<?= $row1['ImageUrl']; ?>" alt="<?= $row1['Title'] ?>"></amp-img></a>
                                    <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>" class="game_name_3"><?= $row1['Title'] ?></a>
                                    <p class="game_type_2"><?= $type_name ?></p>
                                    <p class="game_public">
                                        <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                        <span><?= date("d/m/Y   h:i:s A", strtotime($row1['PublicDate'])) ?></span>
                                    </p>
                                </div>
                            <?
                                $i1++;
                            }
                            ?>
                        </div>
                    </div>
                    <!-- End content_gt_right -->
                </div>
            </div>
            <!-- End new_game -->

            <div id="hot_game">
                <div class="ga_title"><span>Game <?= $type_name ?></span> <span>xem nhiều</span></div>

                <div class="list_item">
                    <?
                    $i2 = 0;
                    while ($row2 = mysql_fetch_assoc($db_tgame->result)) {
                        $i2++;
                        $url2 = rewrite_news($row2['Id'], $row2['ShortTitle'], 'game-app');
                    ?>
                        <div class="content_gt_left">
                            <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>"><amp-img layout="intrinsic"  width=900 height=500 src="https://banthe247.com/pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>"></amp-img></a>
                            <div class="big_game_info">
                                <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>" class="game_name_3"><?= $row2['Title'] ?></a>
                                <p class="game_fee"><span>Miễn phí</span></p>
                                <div class="game_info">
                                    <p class="game_type_2"><?= $type_name ?></p>
                                    <p class="game_public">
                                        <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                        <span><?= date("d/m/Y   h:i:s A", strtotime($row2['PublicDate'])) ?></span>
                                    </p>
                                </div>
                                <div class="short_desc"><?= $row2['Intro'] ?></div>
                                <a href="<?= $url2 ?>" class="see_more" title="Xem thêm"><span>⟶</span></a>
                            </div>
                        </div>
                        <!-- End content_gt_left -->
                    <?
                        if ($i2 == 1) {
                            break;
                        }
                    }
                    ?>

                    <div class="content_gt_right">
                        <div class="list_show_more">
                            <?
                            while ($row2 = mysql_fetch_assoc($db_tgame->result)) {
                                $url2 = rewrite_news($row2['Id'], $row2['ShortTitle'], 'game-app');
                            ?>
                                <div class="box_game_3">
                                    <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>" class="game_thumb_3"><amp-img layout="intrinsic"  width=900 height=500 src="https://banthe247.com/pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>"></amp-img></a>
                                    <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>" class="game_name_3"><?= $row2['Title'] ?></a>
                                    <p class="game_type_2"><?= $type_name ?></p>
                                    <p class="game_public">
                                        <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                        <span><?= date("d/m/Y   h:i:s A", strtotime($row2['PublicDate'])) ?></span>
                                    </p>
                                </div>
                            <?
                                $i2++;
                            }
                            ?>
                        </div>
                    </div>
                    <!-- End content_gt_right -->
                </div>

                <div class="mid_content_foot">
                </div>
                <!-- <p class="show_more_tg"><a href="javascript:void()" title="Xem thêm"><span data-id="1" data-catid="<?= $catid  ?>">Xem thêm <i class="fa"></i></span></a></p> -->
            </div>
            <!-- End hot_game -->


            <div class="wp_list_game_type">
                <div class="ga_title"><span>Thể loại</span> <span> game</span></div>
                <div class="game_type">
                    <ul class="list_game_type slider_2">
                        <amp-carousel height="135" id="carousel-with-preview" layout="fixed-height" type="carousel" role="region" aria-label="Basic usage carousel">
                            <?
                            foreach ($db_cat as $item) {
                                if ($item['CategoryID'] >= 9 && $item['CategoryID'] <= 21) {
                                    $url_r = rewriteNews($item['CategoryID'], $item['CategoryName']);
                            ?>
                                    <li>
                                        <a href="<?= $url_r ?>" title="<?= $item['CategoryName'] ?>" target="_blank">
                                            <amp-img layout="intrinsic"  width=50 height=50 src="/images/app_game/<?= replaceTitle($item['CategoryName']) ?>.png" alt="<?= $item['CategoryName'] ?>"></amp-img>
                                            <span><?= $item['CategoryName'] ?></span>
                                        </a>
                                    </li>
                            <?
                                }
                            }
                            ?>
                        </amp-carousel>
                        <div class="carousel-preview" >
                            <button [class]="selected.slide == 0 ? 'active' : ''" class="active" on="tap:carousel-with-preview.goToSlide(index=0)"></button>
                            <button [class]="selected.slide == 2 ? 'active' : ''" on="tap:carousel-with-preview.goToSlide(index=2)"></button>
                            <button [class]="selected.slide == 4 ? 'active' : ''" on="tap:carousel-with-preview.goToSlide(index=4)"></button>
                        </div>
                    </ul>
                </div>
                <!-- End list_game_type -->
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
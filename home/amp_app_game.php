<?
include("config.php");
$catid = 8;



$qrinfo = new db_query("SELECT * FROM categories WHERE CategoryID = $catid LIMIT 1");
$rowinfo = mysql_fetch_assoc($qrinfo->result);


$db_qr   = new db_query("SELECT * FROM categories");
$db_cat  = $db_qr->result_array('CategoryID');

//DB for new game
$db_ngame = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,categoryname,ShortTitle,category_parent_id
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.categoryid
                            WHERE IsActive = 1 AND articles.categoryid = $catid 
                            ORDER BY Id DESC LIMIT 5");

//DB for hot game
$db_hgame = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,categoryname,ShortTitle,view,category_parent_id
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.categoryid
                            WHERE IsActive = 1 AND articles.categoryid = $catid 
                            ORDER BY view DESC, Id DESC LIMIT 10");


//DB for week game
$db_wgame = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,categoryname,ShortTitle,category_parent_id
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.categoryid
                            WHERE PublicDate >= DATE_ADD(NOW(), INTERVAL - 7 DAY) AND articles.categoryid = $catid 
                            ORDER BY view DESC, Id DESC LIMIT 4");


$title = $rowinfo['CategoryName'] . " banthe247.com";
$desc  = $rowinfo['MetaDesc'];
$meta = $rowinfo['Meta'];

$urlcano = $urlwebsite . rewriteNews($catid, $rowinfo['CategoryName']);
$url_r = rewriteNews($catid, $rowinfo['CategoryName']);
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
    <link rel="canonical" href='<?= $urlcano ?>' />
    <meta property="og:image:url" content="https://banthe247.com/upload/files/mua-the-dien-thoai.png">
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content='<?= $title ?>'>
    <meta property="og:url" itemprop="url" content='<?= $urlcano ?>'>
    <meta property="og:description" itemprop="description" content='<?= $desc ?>'>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content="https://banthe247.com/upload/files/mua-the-dien-thoai.png">
    <meta name="twitter:description" content='<?= $desc ?>'>
    <meta name="twitter:title" content='<?= $title ?>'>
    <meta name="twitter:site" content="banthe247.com">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
    
    <style amp-custom>
        @font-face{font-family:Roboto,sans-serif;src:url(roboto/Roboto-Regular.ttf);font-display:swap}@font-face{font-family:Roboto-Medium,sans-serif;src:url(roboto/Roboto-Medium.ttf);font-display:swap}@font-face{font-family:Roboto-Bold,sans-serif;src:url(roboto/Roboto-Bold.ttf);font-display:swap}.reg{float:left;width:100%;background:#0098db}.mxh{float:right;padding:5px}.hotline{color:#fff;font-size:14px}.sky{background:url(/images/skype.png) no-repeat left;padding-left:25px;color:#337ab7;font-size:14px}.menu{background:#f8f8f8;padding:0 15px}#showMenu{float:right;border:1px solid #e75a1d;background:#e75a1d;border-radius:5px;padding:5px 10px;margin-top:10px}.icon-bar{width:22px;height:2px;background-color:#fff;margin:4px 0}.menu-nav{float:right;font-weight:700;margin-right:5px;margin-top:5px}.menu ul{padding-top:30px;padding-left:10px}.menu ul li{list-style-type:none;padding:7px 0}.menu ul li a{font-size:15px;padding:7px 10px;color:#777;font-weight:400;font-family:Roboto;line-height:20px;font-family:Roboto,sans-serif}a{text-decoration:none}.container-game{display:flex;padding-top:30px}.row-game{padding:0 13px;width:91%;margin:auto}.list_game_type .amp-carousel-slide{width:40%;padding:0 14px}.list_game_type li a span{display:block;font-weight:700;font-size:16px;line-height:19px;letter-spacing:.05em;text-transform:capitalize;color:#333;margin-top:7px;width:100%;font-family:Roboto,sans-serif}.carousel-preview-slr{text-align:center}.carousel-preview-slr button{border:1px solid #0f70b8;border-radius:50%;width:7px;height:15px;margin:5px;outline:0}.carousel-preview-slr button:active{width:15px;height:16px;transform:scale(1.4);background:#0f70b8;border:1px solid #0f70b8}.ga_title span:first-child{border-bottom:3px solid #f79a27;color:#3a70bf}.ga_title span:first-child{border-bottom:3px solid #f79a27;color:#3a70bf}.ga_title{font-family:Roboto-Bold,sans-serif;font-weight:500;font-size:20px;line-height:23px;letter-spacing:.05em;text-transform:capitalize;border-bottom:1px solid #c8c8be;margin-bottom:15px;color:#f79a27}#new_game .card-img-overlay{position:absolute;bottom:0;width:100%;padding:7px}.game_fee{font-size:12px;line-height:14px;padding:6px 8px;top:-24px;letter-spacing:.05em;color:#fff;background:#0f70b8;position:absolute;border-radius:5px;font-family:Roboto,sans-serif;margin:0;left:0}.game_name{font-family:Roboto,sans-serif;font-weight:500;font-size:15px;line-height:21px;letter-spacing:.05em;color:#fff;margin-bottom:11px;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden;position:relative;z-index:1;width:93%}.game_info{font-family:Roboto,sans-serif;flex-direction:column-reverse;letter-spacing:.05em;color:#bbbbbe;position:relative;z-index:1;margin:12px 0;display:flex;font-size:10px;line-height:12px;width:100%}.bg_gradient{position:absolute;top:0;bottom:0;width:100%;height:98%;background:linear-gradient(180deg,#fff 0%,#0d4775 48.96%);mix-blend-mode:multiply;left:0}.mid_content_head .game_fee{position:relative;float:left}.game_info a{margin-right:20px}.game_public{letter-spacing:.05em;color:#bbbbbe;position:relative;z-index:1;margin:0;display:inline-block;margin-bottom:0}#new_game .game_public{color:#fff}#new_game .game_info a{color:#fff}#new_game button{padding:2px;width:20%;border:none;background:#fff}.carousel-preview{width:100%;display:flex}a{color:#337ab7;text-decoration:none}.game_name_3{font-family:Roboto-Bold,sans-serif;font-weight:700;font-size:14px;line-height:16px;letter-spacing:.05em;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;color:#333}.short_desc span{font-family:"Roboto",sans-serif;font-size:16px;line-height:19px;letter-spacing:.05em;margin-bottom:18px;display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden;font-style:normal}.big_game_info .game_name_3{height:60px}.big_game_info .see_more{width:24px;height:24px;line-height:24px;background:#f79a27;display:inline-block;border-radius:50%;text-align:center;color:#fff}.list_show_more{padding:0;padding-left:0;list-style:none;display:flex;justify-content:space-between;width:100%;flex-wrap:wrap;padding-top:10px}.box_game_3{font-family:"Noto Serif",serif;font-size:16px;list-style-type:none;margin-bottom:35px;width:48%;float:left}.mid_content_foot .game_type_2{font-family:Roboto,sans-serif;margin-bottom:7px;font-size:12px;line-height:14px}.game_public span{font-family:Roboto,sans-serif;font-size:12px}.list_game_type{list-style-type:none;padding:0}.list_game_type li a{display:flex;border:1px solid #bbbbbe;box-sizing:border-box;box-shadow:0 4px 10px rgba(0,0,0,0.15);border-radius:0 10px 10px 10px;padding:22px 19px;text-align:center;transition:all .3s;justify-content:center;flex-wrap:wrap}.box_game_1{position:relative;overflow:hidden}.game_thumb_1{display:flex;justify-content:space-between;padding:11px 0 12px}.game_thumb_1 > a{display:block;width:127px;height:92px;margin-right:18px}.game_thumb_1 > a > img{width:100%;height:100%}.game_info_2{flex:1;padding-top:12px}.game_name_2{font-family:Roboto-Bold,sans-serif;font-weight:700;font-size:14px;line-height:16px;letter-spacing:.05em;color:#333;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:6px}.box_game_1 .box_hover{position:absolute;width:100%;height:100%;background:rgba(15,112,184,0.5);display:flex;justify-content:center;align-items:center;left:-100%;transition:all linear .3s}.box_game_1:hover .box_hover{left:0;top:0}.see_more{width:24px;height:24px;line-height:24px;background:#fff;border-radius:50%;text-align:center}.see_more span{color:#f79a27;font-size:16px}.big_game_info .see_more span{color:#fff}.carousel-preview amp-img{width:100%}#new_game button{outline:0}#week_game,#top_game,.wp_list_game_type{margin-top:40px}.list_game_type .amp-carousel-button-next,.list_game_type .amp-carousel-button-prev{display:none}footer{display:flex;background:url(/images/footer.jpg) no-repeat center;background-size:100% 100%;padding:0 15px}.footer-detail{padding-top:15px}footer p{color:#fff;padding:5px;margin:0;display:flex;width:100%;font-family:Roboto,sans-serif}.thongtin{font-size:24px}#call_icon{position:fixed;right:10px;bottom:80px;z-index:9999999}.col-lg-12{text-align:center;padding:0 15px;padding-bottom:5px}.text-theme{color:#ccc;font-family:Roboto,sans-serif;font-size:12px}.cty{font-size:14px;font-weight:700}.vanphong,.dienthoai,.mail{font-size:14px}a{color:#337ab7;text-decoration:none}.fa{display:inline-block;font:normal normal normal 14px/1 FontAwesome;font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;padding-right:5px}.fa-company:before{content:"\f275"}.fa-adress:before{content:"\f279"}.fa-phone:before{content:"\f098"}.fa-mail:before{content:"\f199"}.fa-sm:before{content:"\f118"}.fa-monney:before{content:"\f155"}.fa-secur:before{content:"\f023"}@media screen and (max-width: 400px){.list_game_type li a span{font-size:12px}.box_game_3{width:45.3%}}@media screen and (max-width: 300px){.list_game_type li a span{font-size:12px}.box_game_3{width:43.7%}}

    </style>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
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
    <div class="container-game">
        <div class="row-game">
            <div id="hot">
                <!-- new game -->
                <div id="new_game">
                <amp-carousel id="carousel-with-preview" width="450" height="300" layout="responsive" type="slides" role="region" aria-label="Carousel with slide previews" >
                        <?
                        while ($row1 = mysql_fetch_assoc($db_ngame->result)) {
                            if (array_key_exists($row1['category_parent_id'], $db_cat)) {
                                $CategoryName1 = $db_cat[$row1['category_parent_id']]['CategoryName'];
                                $gt_name1 = rewriteNews($row1['category_parent_id'], $CategoryName1);
                            }
                            $url1 = rewrite_news($row1['Id'], $row1['ShortTitle'], 'game-app');
                        ?>
                            <div class="card">
                                <amp-img layout="responsive"  width=900 height=500 src="https://banthe247.com/pictures/news/<?= $row1['ImageUrl']; ?>" alt="<?= $row1['Title'] ?>" title="<?= $row1['Title'] ?>" class="card-img"></amp-img>
                                <div class="card-img-overlay">
                                    <p class="game_fee"><span>Miễn phí</span></p>
                                    <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>" class="game_name"><span><?= $row1['Title'] ?></span></a>
                                    <div class="game_info">
                                        <a href="<?= $gt_name1 ?>" class="game_type"><?= $CategoryName1 ?></a>
                                        <p class="game_public">
                                            <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                            <span><?= date("d/m/Y   h:i:s A", strtotime($row1['PublicDate'])) ?></span>
                                        </p>
                                    </div>
                                    <div class="bg_gradient"></div>
                                </div>
                            </div>
                        <?
                        }
                        ?>
                    </amp-carousel>
                    <div class="carousel-preview">
                        
                            <?
                            $i=0;
                            $db_ngame2 = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,categoryname,ShortTitle,category_parent_id
                                                        FROM articles 
                                                        LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                                        WHERE IsActive = 1 AND articles.categoryid = $catid 
                                                        ORDER BY Id DESC LIMIT 5");
                            while ($row2 = mysql_fetch_assoc($db_ngame2->result)) {
                            ?>
                            <button on="tap:carousel-with-preview.goToSlide(index=<?= $i ?>)">
                                <div class="card">
                                    <amp-img layout="intrinsic"  width=900 height=600 src="https://banthe247.com/pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>" title="<?= $row2['Title'] ?>" class="card-img"></amp-img>
                                </div>
                                </button>
                                
                            <?
                            $i++;
                            }
                            ?>
                        
                    </div>
                </div>
                <!-- week game -->
                <div id="week_game">
                    <div class="ga_title"><span>Game hot</span> <span> trong tuần</span></div>
                    <?
                    while ($row3 = mysql_fetch_assoc($db_wgame->result)) {
                        $url2 = rewrite_news($row3['Id'], $row3['ShortTitle'], 'game-app');
                    ?>
                        <div class="box_game_1">
                            <div class="box_show">
                                <div class="game_thumb_1">
                                    <a href="<?= $url2 ?>" title="<?= $row3['Title'] ?>"><amp-img layout="intrinsic"  width=900 height=650 src="https://banthe247.com/pictures/news/<?= $row3['ImageUrl']; ?>" alt="<?= $row3['Title'] ?>"></amp-img></a>
                                    <div class="game_info_2">
                                        <a href="<?= $url2 ?>" class="game_name_2" title="<?= $row3['Title'] ?>"><?= $row3['Title'] ?></a>
                                        <p class="game_public">
                                            <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                            <span><?= date("d/m/Y   h:i:s A", strtotime($row2['PublicDate'])) ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="box_hover">
                                <a href="<?= $url2 ?>" class="see_more" title="Xem thêm"><span>⟶</span></a>
                            </div>
                        </div>
                    <?
                    }
                    ?>
                </div>
            </div>
            <!-- nổi bật -->
            <div id="top_game">
                <div class="ga_title"><span>Game</span> <span> nổi bật</span></div>
                <?
                $i = 0;
                while ($row4 = mysql_fetch_assoc($db_hgame->result)) {
                    $i++;
                    if (array_key_exists($row4['category_parent_id'], $db_cat)) {
                        $CategoryName2 = $db_cat[$row4['category_parent_id']]['CategoryName'];
                        $gt_name2 = rewriteNews($row4['category_parent_id'], $CategoryName2);
                    }
                    $url2 = rewrite_news($row4['Id'], $row4['ShortTitle'], 'game-app');
                ?>
                    <div class="mid_content_head">
                        <a href="<?= $url2 ?>" title="<?= $row4['Title'] ?>"><amp-img layout="intrinsic"  width=900 height=500 src="https://banthe247.com/pictures/news/<?= $row4['ImageUrl']; ?>" alt="<?= $row4['Title'] ?>"></amp-img></a>
                        <div class="big_game_info">
                            <a href="<?= $url2 ?>" title="<?= $row4['Title'] ?>" class="game_name_3"><?= $row4['Title'] ?></a>
                            <p class="game_fee"><span>Miễn phí</span></p>
                            <div class="game_info">
                                <a href="<?= $gt_name2 ?>" class="game_type_2" title="Xem thêm game <?= $CategoryName2 ?>"><?= $CategoryName2 ?></a>
                                <p class="game_public">
                                    <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                    <span><?= date("d/m/Y   h:i:s A", strtotime($row4['PublicDate'])) ?></span>
                                </p>
                            </div>
                            <div class="short_desc"><?= $row4['Intro'] ?></div>
                            <a href="<?= $url2 ?>" class="see_more" title="Xem thêm"><span>⟶</span></a>
                        </div>
                    </div>
                    <!-- End mid_content_head -->
                <?
                    if ($i == 1) {
                        break;
                    }
                }
                ?>
                <div class="mid_content_foot">
                    <div class="list_show_more">
                        <?
                        while ($row5 = mysql_fetch_assoc($db_hgame->result)) {
                            if (array_key_exists($row5['category_parent_id'], $db_cat)) {
                                $CategoryName3 = $db_cat[$row5['category_parent_id']]['CategoryName'];
                                $gt_name3 = rewriteNews($row5['category_parent_id'], $CategoryName3);
                            }
                            $url3 = rewrite_news($row5['Id'], $row5['ShortTitle'], 'game-app');
                        ?>
                            <div class="box_game_3">
                                <a href="<?= $url3 ?>" title="<?= $row5['Title'] ?>" class="game_thumb_3"><amp-img layout="intrinsic"  width=900 height=500 src="https://banthe247.com/pictures/news/<?= $row5['ImageUrl']; ?>" alt="<?= $row5['Title'] ?>"></amp-img></a>
                                <a href="<?= $url3 ?>" title="<?= $row5['Title'] ?>" class="game_name_3"><?= $row5['Title'] ?></a>
                                <a href="<?= $gt_name3 ?>" class="game_type_2" title="Xem thêm game <?= $CategoryName3 ?>"><?= $CategoryName3 ?></a>
                                <p class="game_public">
                                    <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                    <span><?= date("d/m/Y   h:i:s A", strtotime($row5['PublicDate'])) ?></span>
                                </p>
                            </div>
                        <?
                            // $i++;
                            // if ($i == 5) {
                            //     break;
                            // }
                        }
                        ?>
                    </div>
                </div>
                <!-- End mid_content_foot -->
                <!-- <p class="show_more_tg"><a href="javasript:void()" title="Xem thêm"><span data-id="1" data-catid="<?= $catid ?>">Xem thêm <i class="fa">&#xf103;</i></span></a></p> -->

            </div>
            <!-- thể loại -->
            <div class="wp_list_game_type">
                <div class="ga_title"><span>Thể loại</span> <span> game</span></div>
                <div class="game_type">
                    <ul class="list_game_type">
                        <amp-carousel height="135" id="carousel-preview-sl" layout="fixed-height" type="carousel" role="region" aria-label="Basic usage carousel">
                            <?
                            foreach ($db_cat as $item) {
                                if ($item['CategoryID'] >= 9 && $item['CategoryID'] <= 21) {
                                    $url_r = rewriteNews($item['CategoryID'], $item['CategoryName']);
                            ?>
                                    <li>
                                        <a href="<?= $url_r ?>" title="<?= $item['CategoryName'] ?>">
                                            <amp-img layout="intrinsic"  width=47 height=47 src="/images/app_game/<?= replaceTitle($item['CategoryName']) ?>.png" alt="<?= $item['CategoryName'] ?>"></amp-img>
                                            <span><?= $item['CategoryName'] ?></span>
                                        </a>
                                    </li>
                            <?
                                }
                            }
                            ?>
                        </amp-carousel>
                        <div class="carousel-preview-slr" >
                            <button [class]="selected.slide == 0 ? 'active' : ''" class="active" on="tap:carousel-preview-sl.goToSlide(index=0)"></button>
                            <button [class]="selected.slide == 2 ? 'active' : ''" on="tap:carousel-preview-sl.goToSlide(index=2)"></button>
                            <button [class]="selected.slide == 4 ? 'active' : ''" on="tap:carousel-preview-sl.goToSlide(index=4)"></button>
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
<?
include("config.php");
$id = getValue('id', 'int', 'GET', 1);
$db_update_view = new db_query("UPDATE articles SET view = view + 1 WHERE Id = $id");

$db_game = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,articles.Meta,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy,articles.Description,link_301
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.CategoryID 
                            WHERE IsActive = 1 AND Id = $id");
$rowgame = mysql_fetch_assoc($db_game->result);

$db_qr   = new db_query("SELECT * FROM categories");
$db_cat  = $db_qr->result_array('CategoryID');

if (array_key_exists($rowgame['category_parent_id'], $db_cat)) {
    $type_name = $db_cat[$rowgame['category_parent_id']]['CategoryName'];
    $url_type = rewriteNews($rowgame['category_parent_id'], $type_name);
}
$cat_id = $rowgame['category_parent_id'];
$db_sub = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy
                            FROM articles  
                            LEFT JOIN categories ON categories.CategoryID = $cat_id
                            WHERE categories.CategoryID = articles.category_parent_id AND Id != $id 
                            ORDER BY Id DESC LIMIT 6");

$title = $rowgame['Title'];
$desc = $rowgame['MetaDesc'];
$meta = $rowgame['Meta'];

if ($rowgame['ShortTitle'] != NULL) {
    $urlshort = $rowgame['ShortTitle'];
} else {
    $urlshort = $rowgame['Title'];
}
$urlcano = rewrite_news($id, $urlshort, 'game-app');
$userinfourl = $_SERVER['REQUEST_URI'];
$src = $rowgame['ImageUrl'];
if (strpos($rowgame['ImageUrl'], '/upload/') === false)
{
    $src = "https://banthe247.com/pictures/news/" . $rowgame['ImageUrl'];
}
$urlfull = $userinfourl;

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
    <meta name="description" content="str_replace('"', '', $row_hd['$desc'])" />
    <meta name="keywords" content='<?= $meta ?>' />
    <meta name="robots" content='noodp,index,follow' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-language" content="vi" />
    <meta name="author" itemprop="author" content="banthe247.com" />
    <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
    <link rel="canonical" href='https://banthe247.com<?= $urlcano ?>' />
    <meta property="og:image:url" content=<?= $src ?>>
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content='<?= $title ?>'>
    <meta property="og:url" itemprop="url" content='https://banthe247.com<?= $urlcano ?>'>
    <meta property="og:description" itemprop="description" content='<?= $desc ?>'>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content=<?= $src ?>>
    <meta name="twitter:description" content='<?= $desc ?>'>
    <meta name="twitter:title" content='<?= $title ?>'>
    <meta name="twitter:site" content="banthe247.com">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
    
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
        @font-face{font-family:Roboto,sans-serif;src:url(roboto/Roboto-Regular.ttf);font-display:swap}@font-face{font-family:Roboto-Medium,sans-serif;src:url(roboto/Roboto-Medium.ttf);font-display:swap}@font-face{font-family:Roboto-Bold,sans-serif;src:url(roboto/Roboto-Bold.ttf);font-display:swap}.reg{float:left;width:100%;background:#0098db}.mxh{float:right;padding:5px}.hotline{color:#fff;font-size:14px}.sky{background:url(/images/skype.png) no-repeat left;padding-left:25px;color:#337ab7;font-size:14px}.menu{background:#f8f8f8;padding:0 15px}#showMenu{float:right;border:1px solid #e75a1d;background:#e75a1d;border-radius:5px;padding:5px 10px;margin-top:10px}.icon-bar{width:22px;height:2px;background-color:#fff;margin:4px 0}.menu-nav{float:right;font-weight:700;margin-right:5px;margin-top:5px}.menu ul{padding-top:30px;padding-left:10px}.menu ul li{list-style-type:none;padding:7px 0}.ml_h2,.ul_h2{color:#3f51b5}.ml_h3,.ul_h3{padding-left:20px;color:#00bcd4}.menu ul li a{font-size:15px;padding:7px 10px;color:#777;font-weight:400;font-family:Roboto;line-height:20px}a{text-decoration:none}.container_ga{margin:0 auto;margin-bottom:70px;width:94%}#gd_head{display:block;margin-top:30px;margin-bottom:21px;justify-content:space-between}.bg_thumb{width:calc(85% - 50px);padding:21px 37px 26px 36px;margin-right:0;margin:0 auto;background:url(/images/app_game/bg_thumb.png) no-repeat;background-size:100% 100%}.game_name_4{font-weight:400;line-height:29px;letter-spacing:.05em;color:#333;display:-webkit-box;font-size:18px;line-height:21px;margin-bottom:14px;font-family:Roboto,sans-serif}.game_public{letter-spacing:.05em;color:#bbbbbe;position:relative;z-index:1;font-size:10px;line-height:12px;font-family:Roboto,sans-serif}#wp_app_game_detail .game_public,#wp_app_game_detail .game_type_2{display:block;margin-bottom:11px}.game_type_2{font-family:Roboto,sans-serif;color:#0f70b8;margin-right:20px;font-size:12px;line-height:14px}.list_sub_link{padding:5px 0 5px 29px;border-left:6px solid #0f70b8}.sub_link:first-child{margin-bottom:11px}.sub_link{display:-webkit-box;font-weight:400;font-size:15px;line-height:18px;letter-spacing:.05em;color:#333;position:relative;font-family:Roboto,sans-serif}.gd_intro{font-family:'Roboto';line-height:28px;color:#333}.sub_link::before{content:"";width:8px;height:8px;left:-14px;top:5px;background:#f79926;position:absolute;display:block;border-radius:50%}.gd_content_left{flex:1}.gd_content_left .image{margin:25px 0}.game_menu{width:81%;height:fit-content;top:20px;display:block;margin-left:0;margin-right:29px;margin:0 auto 29px}.title_phu_luc,.tt_phu_luc{margin-bottom:22px;padding:0 40px}.title_phu_luc span,.tt_phu_luc span{font-family:Roboto-Bold,sans-serif;border:1px solid #0f70b8;border-radius:5px 0;padding:8px 0;font-weight:700;font-size:18px;line-height:21px;letter-spacing:.05em;text-transform:uppercase;display:block;text-align:center}h3,h3 span,h4,h4 span{color:#333;margin:0;margin-bottom:20px;font-style:italic;font-size:16px;line-height:1.6;font-family:Roboto,sans-serif;font-weight:400}.gd_content_left figure figcaption{background:0 0;color:#333;text-align:center;font-size:14px;font-style:italic;padding:8px 0 3px}.sub_post{background:rgba(247,152,35,0.2);border-radius:10px;text-align:center;padding:84px 13px 29px;margin-bottom:27px;margin-top:63px}.sub_post_title{font-weight:400;font-size:18px;line-height:21px;margin:0}.sub_post_content p:first-child{margin-bottom:47px;text-align:justify}figure{margin:0}.sub_post_content p:first-child::before{content:"";background:url(/images/app_game/ic1.png) no-repeat;background-size:100% 100%;margin-top:9px;width:21px;height:15px;margin-left:0;margin-bottom:15px;z-index:1;display:block}.sub_post_content p:first-child::after{width:21px;height:15px;right:0;bottom:-21px;content:"";background:url(/images/app_game/ic2.png) no-repeat;background-size:100% 100%;display:block;position:relative;z-index:1;float:right}.sub_post_content p:last-child a{background:#0f70b8;box-shadow:0 2px 5px rgba(0,0,0,0.05);border-radius:10px;max-width:100%;padding:10px 50px;color:#fff;display:block;width:fit-content;margin:0 auto}.wp_list_related_game{width:100%}.ga_title{font-weight:500;font-size:18px;line-height:23px;letter-spacing:.05em;text-transform:capitalize;border-bottom:1px solid #c8c8be;margin-bottom:13px;color:#f79a27;font-family:Roboto,sans-serif}.ga_title span:first-child{border-bottom:3px solid #f79a27;color:#3a70bf}.ga_title span{padding-bottom:6px;display:inline-block}.game_menu ul{max-height:300px;overflow-y:scroll;padding:0}.game_menu ul::-webkit-scrollbar{width:5px}.game_menu ul::-webkit-scrollbar-thumb{background:#0098db;border-radius:20px}.game_menu ul::-webkit-scrollbar-track{border-radius:20px;background:0 0}.game_menu ul li{margin-bottom:19px}li{list-style:none}.game_menu ul li a{font-family:Roboto,sans-serif;font-weight:400;font-size:15px;line-height:20px;transition:all .25s}.ml_h2,.ul_h2{font-weight:400}.ml_h3,.ul_h3{padding-left:20px}.gd_content_left > p,.gd_intro > p{margin-bottom:15px;text-align:justify;flex:1}.gd_content_left{font-size:16px;line-height:19px;text-align:justify;letter-spacing:.05em;color:#333;font-family:Roboto,sans-serif;font-style:normal}h2,h2 span{font-weight:700;font-size:18px;line-height:1.6;text-align:justify;color:#333;margin-bottom:20px}.list_related_game{flex-wrap:wrap;justify-content:space-between;display:block;padding:0}.game_thumb_1{display:flex;justify-content:space-between;padding:11px 0 12px;border-bottom:1px solid #c8c8be}.game_thumb_1 > a{display:block;width:50%;margin-right:18px}.game_thumb_1 > a > img{width:100%;height:100%}.game_thumb_1 a amp-img{width:127px;height:95px}.game_name_2{font-family:Roboto,sans-serif;font-size:13px;line-height:15px;margin-bottom:6px;letter-spacing:.05em;color:#333;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;font-weight:500}.list_related_game .game_thumb_1:nth-child(4){border-bottom:0}.list_game_type{padding:0}.amp-carousel-slide{width:40%;padding:0 14px}.list_game_type li a{display:flex;border:1px solid #bbbbbe;box-sizing:border-box;box-shadow:0 4px 10px rgba(0,0,0,0.15);border-radius:0 10px 10px 10px;padding:22px 19px;text-align:center;transition:all .3s;justify-content:center;flex-wrap:wrap}.list_game_type li a span{display:block;font-weight:500;font-size:16px;line-height:19px;letter-spacing:.05em;text-transform:capitalize;color:#333;margin-top:7px;width:100%;font-family:Roboto,sans-serif}.carousel-preview{text-align:center}.carousel-preview button{border:1px solid #0f70b8;border-radius:50%;width:7px;height:15px;margin:5px;outline:0}.carousel-preview button:active{width:15px;height:16px;transform:scale(1.4);background:#0f70b8;border:1px solid #0f70b8}.amp-carousel-button-next,.amp-carousel-button-prev{display:none}.list_social{display:flex;align-items:center}.list_social::after,.list_social::before{content:"";display:inline-block;flex:1;height:1px;background:#0f70b8}.list_social li{list-style:none;padding:0;margin:0 13px;height:20px}.banner_news{padding-bottom:72px}footer{display:flex;background:url(/images/footer.jpg) no-repeat center;background-size:100% 100%;padding:0 15px}footer p{font-family:Roboto,sans-serif;color:#fff;padding:5px;margin:0;display:flex;width:100%;font-size:18px}#call_icon{position:fixed;right:10px;bottom:80px;z-index:9999999}.cty{font-size:14px;font-weight:700}.vanphong,.dienthoai,.mail{font-size:14px}.thongtin{font-size:24px}.col-lg-12{text-align:center;padding:0 15px;padding-bottom:5px;font-family:'Roboto';font-size:11px}.text-theme{color:#ccc}a{color:#337ab7;text-decoration:none}.fa{display:inline-block;font:normal normal normal 14px/1 FontAwesome;font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;padding-right:5px}.fa-company:before{content:"\f275"}.fa-adress:before{content:"\f279"}.fa-phone:before{content:"\f098"}.fa-mail:before{content:"\f199"}.fa-sm:before{content:"\f118"}.fa-monney:before{content:"\f155"}.fa-secur:before{content:"\f023"}@media only screen and (max-width: 770px){.game_thumb_1 a amp-img{width:310px;height:180px}}@media only screen and (max-width: 540px){.game_thumb_1 a amp-img{width:280px;height:150px}}@media only screen and (max-width: 414px){.game_thumb_1 a amp-img{width:127px;height:95px}}
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
                        <span class="sky">banthe247.com</span>
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
    <div id="wp_app_game_detail">
        <div class="container_ga">
            <div id="gd_head">
                <div class="bg_thumb">
                    <amp-img layout="intrinsic"  width=900 height=700  src="https://banthe247.com/pictures/news/<?= $rowgame['ImageUrl']; ?>" alt="<?= $rowgame['Title']; ?>" title="<?= $rowgame['Title']; ?>"></amp-img>
                </div>

                <div class="game_info_4">
                    <h1 class="game_name_4"><?= $rowgame['Title']; ?></h1>
                    <p class="game_public">
                        <amp-img layout="intrinsic"  width=10 height=10  src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                        <span><?= date("d/m/Y   h:i:s A", strtotime($rowgame['PublicDate'])) ?></span>
                    </p>
                    <a href="<?= $url_type ?>" title="Xem thêm game <?= $type_name ?>" class="game_type_2"><?= $type_name ?></a>
                    <div class="list_sub_link">
                        <?
                        $i = 0;
                        while ($rowsub = mysql_fetch_assoc($db_sub->result)) {
                            $url_sub = rewrite_news($rowsub['Id'], $rowsub['ShortTitle'], 'game-app');
                            $i++;
                        ?>
                            <a href="<?= $url_sub ?>" title="<?= $rowsub['Title'] ?>" class="sub_link"><?= $rowsub['Title'] ?></a>
                        <?
                            if ($i == 2) {
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="gd_intro">
                <? echo trim(removeHTML($rowgame['Intro'])) ?>
            </div>
            <div id="gd_content">
                <div class="game_menu">
                    <? echo makeML($rowgame['Description'])  ?>
                </div>
                <div class="gd_content_left">
                    
                    <?               
                    $text = amp_content($rowgame['Description']);
                    echo makeML_content($text);				 
                    ?>
                    <?php if ($rowgame['new_tdgy'] != "") { ?>
                        <div class="sub_post">
                            <div class="sub_post_title"><?= amp_content($rowgame['new_tdgy']) ?></div>
                            <div class="sub_post_content">
                                <?= amp_content($rowgame['new_ndgy']) ?>
                            </div>
                        </div>
                    <? } ?>

                </div>
            </div>
                <div class="banner_news">
                    <a href="https://banthe247.com/the-dien-thoai"><amp-img layout="intrinsic"  width=900 height=450 src="../images/banner_the.jpg" alt="Mua thẻ điện thoại"></amp-img></a>
                </div>
            <div class="wp_list_related_game">
                <div class="ga_title"><span>Có thể bạn</span> <span>quan tâm</span></div>
                <div class="list_related_game">
                    <?
                    while ($rowsub = mysql_fetch_assoc($db_sub->result)) {
                        $url_sub = rewrite_news($rowsub['Id'], $rowsub['ShortTitle'], 'game-app');
                    ?>
                        <div class="game_thumb_1">
                            <a href="<?= $url_sub ?>" title="<?= $rowsub['Title'] ?>"><amp-img layout="intrinsic"  width=300 height=280 src="https://banthe247.com/pictures/news/<?= $rowsub['ImageUrl']; ?>" alt=" <?= $rowsub['Title'] ?>"></amp-img></a>
                            <div class="game_info_2">
                                <a href="<?= $url_sub ?>" class="game_name_2" title="<?= $rowsub['Title'] ?>"> <?= $rowsub['Title'] ?></a>
                                <p class="game_public">
                                    <amp-img layout="intrinsic"  width=10 height=10 src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                    <span><?= date("d/m/Y   h:i:s A", strtotime($rowsub['PublicDate'])) ?></span>
                                </p>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
            <!-- End wp_list_related_game -->


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
                            <button [class]="selected.slide == 1 ? 'active' : ''" on="tap:carousel-with-preview.goToSlide(index=2)"></button>
                            <button [class]="selected.slide == 2 ? 'active' : ''" on="tap:carousel-with-preview.goToSlide(index=4)"></button>
                        </div>
                    </ul>
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
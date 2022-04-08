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
if ($url_r != $urluri) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: $url_r");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $desc ?>" />
    <meta name="keywords" content="<?= $meta ?>" />
    <meta name="robots" content="<?=(isset($_GET['page'])) ? 'noodp,noindex,follow' : 'noodp,index,follow'?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name='revisit-after' content='1 days' />
    <meta http-equiv="content-language" content="vi" />
    <meta name="author" itemprop="author" content="banthe24h.vn" />
    <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
    <link rel="canonical" href="<?= (isset($_GET['page'])) ? "https://banthe24h.vn/app-tro-choi-1015.html" : $url_r?>" />
    <meta property="og:image:url" content="https://banthe24h.vn/pictures/news/2020/10/09/bfj1602207838.jpg">
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content="<?= $title ?>">
    <meta property="og:url" itemprop="url" content="<?= (isset($_GET['page'])) ? "https://banthe24h.vn/app-tro-choi-1015.html" : $url_r?>">
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
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/slick-theme.css">
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
    <link rel="stylesheet" type="text/css" href="/css/app_game.css" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css" />


</head>

<body>
    <? include("../includes/inc_header.php") ?>
    <div style="clear: both;"></div>

    <!-- Start app game -->
    <div id="wp_app_game">
        <div class="container_ga">
            <div id="ga_header">
                <div class="slider">
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
                                <img src="https://banthe24h.vn//pictures/news/<?= $rowtop['ImageUrl']; ?>" alt="<?= $rowtop['Title']; ?>">
                                <a href="<?= $gt_name1 ?>" title="Xem thêm game <?= $CategoryName ?>"><?= $CategoryName ?></a>
                            </div>
                            <div class="game_desc_1">
                                <a href="<?= $url1; ?>" class="game_name_1" title="<?= $rowtop['Title']; ?>"><?= $rowtop['Title']; ?></a>
                                <p class="game_public_1">
                                    <img src="/images/app_game/ic_clock.png" alt="clock">
                                    <span><?= date("d/m/Y h:i:s A", strtotime($rowtop['PublicDate'])) ?></span>
                                </p>
                            </div>
                        </div>
                    <?
                        if ($i1 == 4) {
                            break;
                        }
                    }
                    ?>
                </div>
                <!-- End slider -->

                <?
                while ($rowtop = mysql_fetch_assoc($db_top->result)) {
                    $url1 = rewrite_news($rowtop['Id'], $rowtop['ShortTitle'], 'app-tro-choi');
                ?>
                    <div class="box_game_1">
                        <div class="game_thumb_1">
                            <img src="https://banthe24h.vn//pictures/news/<?= $rowtop['ImageUrl']; ?>" alt="<?= $rowtop['Title']; ?>">
                            <a href="<?= $gt_name1 ?>" title="Xem thêm game <?= $CategoryName ?>"><?= $CategoryName ?></a>
                        </div>
                        <div class="game_desc_1">
                            <a href="<?= $url1; ?>" class="game_name_1" title="<?= $rowtop['Title']; ?>"><?= $rowtop['Title']; ?></a>
                            <p class="game_public_1">
                                <img src="/images/app_game/ic_clock.png" alt="clock">
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
                                    <img src="https://banthe24h.vn//pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title']; ?>">
                                    <div>
                                        <a href="<?= $gt_name2 ?>" class="game_type" title="Xem thêm game <?= $CategoryName1 ?>"><?= $CategoryName1 ?></a>
                                        <div class="game_desc_2">
                                            <a href="<?= $url2; ?>" class="game_name_2" title="<?= $row2['Title']; ?>"><?= $row2['Title']; ?></a>
                                            <p class="game_public">
                                                <img src="/images/app_game/ic_clock_xanh.png" alt="clock">
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
                        <script>
                            $(document).ready(function() {
                                var url = window.location.href;
                                var page = window.location.href.split('?page=')[1];
                                var totalPage = $("#tongSoTrang").text();
                                if (parseInt(page) > parseInt(totalPage)) {
                                    var newUrl = url.replace("page=" + page, "page=" + totalPage);
                                    window.location = newUrl;
                                }
                            });
                        </script>
                        <ul class="pagination">
                            <?
                            echo generatePageBar3('', $page, $curentPage, $count, rewriteNews($catid, $rowinfo['CategoryName']), '?', '', 'active', 'preview', '<', 'next', '>', 'first', 'Đầu', 'last', 'Cuối');
                            ?>
                        </ul>
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
                                    <a href="<?= $url3 ?>" title="<?= $row3['Title'] ?>"><img src="https://banthe24h.vn//pictures/news/<?= $row3['ImageUrl']; ?>" alt="<?= $row3['Title'] ?>"></a>
                                    <div class="game_desc_3">
                                        <a href="<?= $url3 ?>" class="game_name_3"><?= $row3['Title'] ?></a>
                                        <p class="game_public">
                                            <img src="/images/app_game/ic_clock_xam.png" alt="clock">
                                            <span><?= date("d/m/Y h:i:s A", strtotime($row3['PublicDate'])) ?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="box_hover"><a href="<?= $url3 ?>" title="Xem thêm" class="see_more_hg">Xem thêm</a></div>
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
                                <a href="<?= $url_r ?>" title="<?= $item['CategoryName'] ?>" target="_blank">
                                    <img src="/images/app_game/<?= replaceTitle($item['CategoryName']) ?>.png" alt="<?= $item['CategoryName'] ?>">
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
        </div>
    </div>
    <!-- End app game -->


    <? include("../includes/inc_footer.php") ?>
</body>
<script src="/js/jquery.min.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/usermanager.js"></script>
<script>
    $('.slider').slick({
        dots: true,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: true
    });
</script>

</html>
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
$urlamp = $urlwebsite . rewriteNews($catid, 'amp-'. $type_name);
$urluri = $_SERVER['REQUEST_URI'];
$urluri = $urlwebsite . $urluri;
if ($url_r != $urluri) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /app-tro-choi-1015.html");
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
    <meta name="robots" content='noodp,index,follow' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name='revisit-after' content='1 days' />
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
    <link rel="amphtml" href="<?=$urlamp ?>" />

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

    <!-- Start wp_game_type -->
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
                                <img src="https://banthe24h.vn//pictures/news/<?= $row1['ImageUrl']; ?>" alt="<?= $row1['Title'] ?>">
                                <div>
                                    <p class="game_type"><?= $type_name ?></p>
                                    <div class="game_desc_2">
                                        <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>" class="game_name_2"><?= $row1['Title'] ?></a>
                                        <p class="game_public">
                                            <img src="/images/app_game/ic_clock_xanh.png" alt="clock">
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
                                <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>"><img src="https://banthe24h.vn//pictures/news/<?= $row1['ImageUrl']; ?>" alt="<?= $row1['Title'] ?>"></a>
                                <div class="game_desc_3">
                                    <a href="<?= $url1 ?>" class="game_name_3"><?= $row1['Title'] ?></a>
                                    <p class="game_public">
                                        <img src="/images/app_game/ic_clock_xam.png" alt="clock">
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
                                    <img src="https://banthe24h.vn//pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>">
                                    <div>
                                        <p class="game_type"><?= $type_name ?></p>
                                        <div class="game_desc_2">
                                            <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>" class="game_name_2"><?= $row2['Title'] ?></a>
                                            <p class="game_public">
                                                <img src="/images/app_game/ic_clock_xanh.png" alt="clock">
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
                                    <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>"><img src="https://banthe24h.vn//pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>"></a>
                                    <div class="game_desc_3">
                                        <a href="<?= $url2 ?>" class="game_name_3"><?= $row2['Title'] ?></a>
                                        <p class="game_public">
                                            <img src="/images/app_game/ic_clock_xam.png" alt="clock">
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
                <div class="see_more_tvg">
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
                </div>
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
                                <a href="<?= $url_r ?>" title="<?= $item['CategoryName'] ?>" target="_blank">
                                    <img src="/images/app_game/<?= replaceTitle($item['CategoryName']) ?>.png" alt="<?= $item['CategoryName'] ?>">
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
        </div>
    </div>
    <!-- End wp_game_type -->


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
    $("#append_data").click(function() {
        var id = $(this).attr("data-id");
        var catid = $("#top_tiew_game").attr("data-catid");
        $.ajax({
            type: "POST",
            url: "/ajax/appgame_process.php",
            data: {
                id: id,
                catid: catid
            },
            success: function(data) {
                setTimeout(function() {
                    $('body').addClass("body_fade");
                }, 500);
                setTimeout(function() {
                    $('body').removeClass("body_fade");
                }, 2000);
                setTimeout(function() {
                    $('.list_loading').show();
                }, 500);
                setTimeout(function() {
                    $('.list_loading').hide();
                }, 2000);
                setTimeout(function() {
                    $('.list_tvg').append(data);
                    id++;
                    $('#append_data').attr("data-id", id);
                }, 2000);

            }
        });
        return false;
    });
</script>

</html>
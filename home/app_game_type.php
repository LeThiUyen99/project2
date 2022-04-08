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
// $url_r = $urlwebsite . rewriteNews($catid, $rowinfo['CategoryName']);
$urluri = $_SERVER['REQUEST_URI'];
// $urluri = $urlwebsite . $_SERVER['REQUEST_URI'];
if ($url_r != $urluri) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /game-app-8.html");
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
    <meta name="author" itemprop="author" content="banthe247.com" />
    <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
    <link rel="canonical" href="<?= $url_r ?>" />


    <meta property="og:image:url" content="https://banthe247.com/upload/files/mua-the-dien-thoai.png">
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content="<?= $title ?>">
    <meta property="og:url" itemprop="url" content="<?= $url_r ?>">
    <meta property="og:description" itemprop="description" content="<?= $desc ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content="https://banthe247.com/upload/files/mua-the-dien-thoai.png">
    <meta name="twitter:description" content="<?= $desc ?>">
    <meta name="twitter:title" content="<?= $title ?>">
    <meta name="twitter:site" content="banthe247.com">

    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
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

    <!-- Start wp_app_game_type -->
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
                            <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>"><img src="https://banthe247.com/pictures/news/<?= $row1['ImageUrl']; ?>" alt="<?= $row1['Title'] ?>"></a>
                            <div class="big_game_info">
                                <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>" class="game_name_3"><?= $row1['Title'] ?></a>
                                <p class="game_fee"><span>Miễn phí</span></p>
                                <div class="game_info">
                                    <p href="" class="game_type_2"><?= $type_name ?></p>
                                    <p class="game_public">
                                        <img src="/images/app_game/ic_clock_xam.png" alt="clock">
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
                                    <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>" class="game_thumb_3"><img src="https://banthe247.com/pictures/news/<?= $row1['ImageUrl']; ?>" alt="<?= $row1['Title'] ?>"></a>
                                    <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>" class="game_name_3"><?= $row1['Title'] ?></a>
                                    <p class="game_type_2"><?= $type_name ?></p>
                                    <p class="game_public">
                                        <img src="/images/app_game/ic_clock_xam.png" alt="clock">
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
                            <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>"><img src="https://banthe247.com/pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>"></a>
                            <div class="big_game_info">
                                <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>" class="game_name_3"><?= $row2['Title'] ?></a>
                                <p class="game_fee"><span>Miễn phí</span></p>
                                <div class="game_info">
                                    <p href="" class="game_type_2"><?= $type_name ?></p>
                                    <p class="game_public">
                                        <img src="/images/app_game/ic_clock_xam.png" alt="clock">
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
                                    <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>" class="game_thumb_3"><img src="https://banthe247.com/pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>"></a>
                                    <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>" class="game_name_3"><?= $row2['Title'] ?></a>
                                    <p class="game_type_2"><?= $type_name ?></p>
                                    <p class="game_public">
                                        <img src="/images/app_game/ic_clock_xam.png" alt="clock">
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
                <p class="show_more_tg"><a href="javascript:void()" title="Xem thêm"><span data-id="1" data-catid="<?= $catid  ?>">Xem thêm <i class="fa"></i></span></a></p>
            </div>
            <!-- End hot_game -->


            <div class="wp_list_game_type">
                <div class="ga_title"><span>Thể loại</span> <span> game</span></div>
                <div class="game_type">
                    <ul class="list_game_type slider_2">
                        <?
                        foreach ($db_cat as $item) {
                            if ($item['CategoryID'] >= 9 && $item['CategoryID'] <= 21) {
                                $url_r = rewriteNews($item['CategoryID'], $item['CategoryName']);
                        ?>
                                <li>
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
                <!-- End list_game_type -->
            </div>
        </div>
    </div>
    <!-- End wp_app_game_type -->

    <? include("../includes/inc_footer.php") ?>
</body>

<script src="/js/jquery.min.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/usermanager.js"></script>
<script>
    $(document).ready(function() {
        $('.slider_2').slick({
            slidesToShow: 5,
            slidesToScroll: 5,
            dots: true,
            arrows: true,
            responsive: [{
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: false,
                        dots: true
                    }
                }, {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: false,
                        dots: true
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });

        $(".show_more_tg a span").click(function () { 
            var id = $(this).attr("data-id");
            var catid = $(this).attr("data-catid");
            $.ajax({
                type: "POST",
                url: "/ajax/appgame_process2.php",
                data: {
                    id: id,
                    catid: catid
                },
                success: function (data) {
                    $(".mid_content_foot").append(data);
                    id++;
                    $(".show_more_tg a span").attr("data-id",id);
                }
            });
            return false;
        });
    });
</script>

</html>
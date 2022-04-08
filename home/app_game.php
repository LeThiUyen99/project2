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
                            ORDER BY view DESC, Id DESC LIMIT 5");


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
// $url_r = $urlwebsite.rewriteNews($catid,$rowinfo['CategoryName']);
$urluri = $_SERVER['REQUEST_URI'];
// $urluri = $urlwesite . $_SERVER['REQUEST_URI'];
// if ($url_r != $urluri) {
//     header("HTTP/1.1 301 Moved Permanently");
//     header("Location: $url_r");
//     exit();
// }
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
    <link rel="canonical" href="<?= $urlcano ?>" />


    <meta property="og:image:url" content="https://banthe247.com/upload/files/mua-the-dien-thoai.png">
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content="<?= $title ?>">
    <meta property="og:url" itemprop="url" content="<?= $urlcano ?>">
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

    <!-- Start app_game -->
    <div id="wp_app_game">
        <div class="container_ga">
            <div id="top_content">
                <div id="new_game">
                    <div class="slider-for slider">
                        <?
                        while ($row1 = mysql_fetch_assoc($db_ngame->result)) {
                            if (array_key_exists($row1['category_parent_id'], $db_cat)) {
                                $CategoryName1 = $db_cat[$row1['category_parent_id']]['CategoryName'];
                                $gt_name1 = rewriteNews($row1['category_parent_id'], $CategoryName1);
                            }
                            $url1 = rewrite_news($row1['Id'], $row1['ShortTitle'], 'game-app');
                        ?>
                            <div class="card">
                                <img src="https://banthe247.com/pictures/news/<?= $row1['ImageUrl']; ?>" alt="<?= $row1['Title'] ?>" title="<?= $row1['Title'] ?>" class="card-img">
                                <div class="card-img-overlay">
                                    <p class="game_fee"><span>Miễn phí</span></p>
                                    <a href="<?= $url1 ?>" title="<?= $row1['Title'] ?>" class="game_name"><span><?= $row1['Title'] ?></span></a>
                                    <div class="game_info">
                                        <a href="<?= $gt_name1 ?>" class="game_type"><?= $CategoryName1 ?></a>
                                        <p class="game_public">
                                            <img src="/images/app_game/ic_clock_trang.png" alt="clock">
                                            <span><?= date("d/m/Y   h:i:s A", strtotime($row1['PublicDate'])) ?></span>
                                        </p>
                                    </div>
                                    <div class="bg_gradient"></div>
                                </div>
                            </div>
                        <?
                        }
                        ?>
                    </div>
                    <div class="slider-nav slider">
                        <?
                        $db_ngame2 = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,categoryname,ShortTitle,category_parent_id
                                                    FROM articles 
                                                    LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                                    WHERE IsActive = 1 AND articles.categoryid = $catid 
                                                    ORDER BY Id DESC LIMIT 5");
                        while ($row2 = mysql_fetch_assoc($db_ngame2->result)) {
                        ?>
                            <div class="card">
                                <img src="https://banthe247.com/pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>" title="<?= $row2['Title'] ?>" class="card-img">
                            </div>
                        <?
                        }
                        ?>
                    </div>
                </div>
                <!-- End new_game -->

                <div id="week_game">
                    <div class="ga_title"><span>Game hot</span> <span> trong tuần</span></div>
                    <?
                    while ($row3 = mysql_fetch_assoc($db_wgame->result)) {
                        $url2 = rewrite_news($row3['Id'], $row3['ShortTitle'], 'game-app');
                    ?>
                        <div class="box_game_1">
                            <div class="box_show">
                                <div class="game_thumb_1">
                                    <a href="<?= $url2 ?>" title="<?= $row3['Title'] ?>"><img src="https://banthe247.com/pictures/news/<?= $row3['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>" alt="<?= $row3['Title'] ?>"></a>
                                    <div class="game_info_2">
                                        <a href="<?= $url2 ?>" class="game_name_2" title="<?= $row3['Title'] ?>"><?= $row3['Title'] ?></a>
                                        <p class="game_public">
                                            <img src="/images/app_game/ic_clock_xam.png" alt="clock">
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
                <!-- End week_game -->
            </div>
            <!-- End top_content -->

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
                        <a href="<?= $url2 ?>" title="<?= $row4['Title'] ?>"><img src="https://banthe247.com/pictures/news/<?= $row4['ImageUrl']; ?>" alt="<?= $row4['Title'] ?>"></a>
                        <div class="big_game_info">
                            <a href="<?= $url2 ?>" title="<?= $row4['Title'] ?>" class="game_name_3"><?= $row4['Title'] ?></a>
                            <p class="game_fee"><span>Miễn phí</span></p>
                            <div class="game_info">
                                <a href="<?= $gt_name2 ?>" class="game_type_2" title="Xem thêm game <?= $CategoryName2 ?>"><?= $CategoryName2 ?></a>
                                <p class="game_public">
                                    <img src="/images/app_game/ic_clock_xam.png" alt="clock">
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
                                <a href="<?= $url3 ?>" title="<?= $row5['Title'] ?>" class="game_thumb_3"><img src="https://banthe247.com/pictures/news/<?= $row5['ImageUrl']; ?>" alt="<?= $row5['Title'] ?>"></a>
                                <a href="<?= $url3 ?>" title="<?= $row5['Title'] ?>" class="game_name_3"><?= $row5['Title'] ?></a>
                                <a href="<?= $gt_name3 ?>" class="game_type_2" title="Xem thêm game <?= $CategoryName3 ?>"><?= $CategoryName3 ?></a>
                                <p class="game_public">
                                    <img src="/images/app_game/ic_clock_xam.png" alt="clock">
                                    <span><?= date("d/m/Y   h:i:s A", strtotime($row5['PublicDate'])) ?></span>
                                </p>
                            </div>
                        <?
                            $i++;
                            if ($i == 5) {
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- End mid_content_foot -->
                <p class="show_more_tg"><a href="javasript:void()" title="Xem thêm"><span data-id="1" data-catid="<?= $catid ?>">Xem thêm <i class="fa">&#xf103;</i></span></a></p>

            </div>
            <!-- End top_game -->

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
        <!-- End app_game -->

        <? include("../includes/inc_footer.php") ?>
</body>

<script src="/js/jquery.min.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/usermanager.js"></script>
<script>
    $(document).ready(function() {
        $('.slider-for').slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            centerMode: true,
            centerPadding: '0px',
            asNavFor: '.slider-nav',
            autoplay: true,
            autoplaySpeed: 3000
        });
        $('.slider-nav').slick({
            infinite: false,
            slidesToShow: 5,
            asNavFor: '.slider-for',
            dots: false,
            arrows: false,
            centerMode: true,
            centerPadding: '0px',
            focusOnSelect: true,
            variableWidth: true
        });
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

        $(".show_more_tg a span").click(function() {
            var id = $(this).attr("data-id");
            var catid = $(this).attr("data-catid");
            $.ajax({
                type: "POST",
                url: "/ajax/appgame_process.php",
                data: {
                    id: id,
                    catid: catid
                },
                success: function(data) {
                    $(".mid_content_foot").append(data);
                    id++;
                    $(".show_more_tg a span").attr("data-id", id);
                }
            });
            return false;
        });
    });
</script>

</html>
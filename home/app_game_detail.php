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
if ($rowgame['link_301'] != '') {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $rowgame['link_301']);
}
if ($rowgame['ShortTitle'] != NULL) {
    $urlshort = $rowgame['ShortTitle'];
} else {
    $urlshort = $rowgame['Title'];
}
$urlcano = rewrite_news($id, $urlshort, 'game-app');
// $urlcano = $urlwebsite . rewrite_news($id, $urlshort, $rowgame['categoryname']);
$userinfourl = $_SERVER['REQUEST_URI'];
$urlfull = $userinfourl;
// $urlfull = $urlwebsite . $userinfourl;

if ($urlfull != $urlcano) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: $urlcano");
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

    <!-- Start wp_app_game_detail -->
    <div id="wp_app_game_detail">
        <div class="container_ga">
            <div id="gd_head">
                <div class="bg_thumb">
                    <img src="https://banthe247.com/pictures/news/<?= $rowgame['ImageUrl']; ?>" alt="<?= $rowgame['Title']; ?>" title="<?= $rowgame['Title']; ?>">
                </div>

                <div class="game_info_4">
                    <p class="game_name_4"><?= $rowgame['Title']; ?></p>
                    <p class="game_public">
                        <img src="/images/app_game/ic_clock_xam.png" alt="clock">
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
            <!-- End gd_head -->

            <div id="gd_content">
                <div class="game_menu">
                    <? echo makeML($rowgame['Description'])  ?>
                </div>
                <!-- End game_menu -->
                <div class="gd_content_left">
                    <div class="gd_intro">
                        <div class="game_menu tablet">
                            <? echo makeML($rowgame['Description'])  ?>
                        </div>
                        <?= $rowgame['Intro'] ?>
                    </div>
                    <? echo makeML_content($rowgame['Description']) ?>

                    <?php if ($rowgame['new_tdgy'] != "") { ?>
                        <div class="sub_post">
                            <div class="sub_post_title"><?= $rowgame['new_tdgy'] ?></div>
                            <div class="sub_post_content">
                                <?= $rowgame['new_ndgy'] ?>
                            </div>
                        </div>
                        <!-- End_ sub_post -->
                        <!-- End tbl_news -->
                    <? } ?>

                    <ul class="list_social">
                        <li>
                            <div class="fb-share-button" data-href="<?= $urlcano ?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                        </li>
                        <li><a href="<?= $urlcano ?>" class="twitter-share-button" data-show-count="false">Tweet</a></li>
                        <li>
                            <script type="IN/Share" data-url="<?= $urlcano ?>"></script>
                        </li>
                    </ul>
                    <!-- End list_socail -->

                </div>
                <!-- End gd_content_left -->
            </div>
            <!-- End gd_content -->

            <div class="wp_list_related_game">
                <div class="ga_title"><span>Có thể bạn</span> <span>quan tâm</span></div>
                <div class="list_related_game">
                    <?
                    while ($rowsub = mysql_fetch_assoc($db_sub->result)) {
                        $url_sub = rewrite_news($rowsub['Id'], $rowsub['ShortTitle'], 'game-app');
                    ?>
                        <div class="game_thumb_1">
                            <a href="<?= $url_sub ?>" title="<?= $rowsub['Title'] ?>"><img src="https://banthe247.com/pictures/news/<?= $rowsub['ImageUrl']; ?>" alt=" <?= $rowsub['Title'] ?>"></a>
                            <div class="game_info_2">
                                <a href="<?= $url_sub ?>" class="game_name_2" title="<?= $rowsub['Title'] ?>"> <?= $rowsub['Title'] ?></a>
                                <p class="game_public">
                                    <img src="/images/app_game/ic_clock_xam.png" alt="clock">
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
    <!-- End wp_app_game_detail -->

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
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            infinite: false,
            slidesToShow: 5,
            slidesToScroll: 0,
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
        $(document).on('click', 'a[href^="#"]', function(e) {
            var id = $(this).attr('href');

            var $id = $(id);
            if ($id.length === 0) {
                return;
            }

            e.preventDefault();

            var pos = $id.offset().top - 15;

            $('body, html').animate({
                scrollTop: pos
            }, 'slow');
            console.log(pos);
        });
    });
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0" nonce="itUyJ4Xm"></script>

<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

<script async src="https://platform.linkedin.com/in.js" type="text/javascript">
    lang: en_US
</script>

</html>
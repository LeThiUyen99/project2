<?
include("config.php");
$id = getValue('id', 'int', 'GET', 1);
if ($id > 0) {
    $db_game = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,articles.Meta,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy,articles.Description,link_301,link_canonical
                            FROM articles
                            LEFT JOIN categories ON articles.categoryid = categories.CategoryID
                            WHERE IsActive = 1 AND Id = $id");
    if (mysql_num_rows($db_game->result) > 0) {
        $db_update_view = new db_query("UPDATE articles SET view = view + 1 WHERE Id = $id");

        $rowgame = mysql_fetch_assoc($db_game->result);

        $db_qr = new db_query("SELECT * FROM categories");
        $db_cat = $db_qr->result_array('CategoryID');

        if (array_key_exists($rowgame['category_parent_id'], $db_cat)) {
            $nav_name = $db_cat[$rowgame['category_parent_id']]['CategoryName'];
            $url_type = rewriteNews($rowgame['category_parent_id'], $nav_name);
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
        $urlcano = rewrite_news($id, $urlshort, 'app-tro-choi');

        $urlamp  = $urlwebsite . "/amp-app-tro-choi/" . replaceTitle($urlshort)  . "-" . $id . ".html";

        $urlcano = $urlwebsite . $urlcano;
        $userinfourl = $_SERVER['REQUEST_URI'];
        $urlfull = $urlwebsite . $userinfourl;
        // var_dump($userinfourl);

        if ($urlfull != $urlcano) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: $urlcano");
            exit();
        }
    } else {
        redirect("/app-tro-choi-1015.html");
    }
} else {
    redirect("/app-tro-choi-1015.html");
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
    <link rel="canonical" href="<?= ($rowgame['link_canonical'] != '') ? $rowgame['link_canonical'] : $urlcano ?>" />
    <link rel="amphtml" href="<?=$urlamp ?>" />
    


    <meta property="og:image:url" content="https://banthe24h.vn//pictures/news/<?= $rowgame['ImageUrl'] ?>">
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content="<?= $title ?>">
    <meta property="og:url" itemprop="url" content="<?= ($rowgame['link_canonical'] != '') ? $rowgame['link_canonical'] : $urlcano ?>">
    <meta property="og:description" itemprop="description" content="<?= $desc ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content="https://banthe24h.vn//pictures/news/<?= $rowgame['ImageUrl'] ?>">
    <meta name="twitter:description" content="<?= $desc ?>">
    <meta name="twitter:title" content="<?= $title ?>">
    <meta name="twitter:site" content="banthe24h.vn">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/slick-theme.css">
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.min2.css?v=<?=$ver;?>" />
    <link rel="stylesheet" type="text/css" href="/css/app_game.css?v=<?=$ver;?>" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css?v=<?=$ver;?>" />
</head>

<body>
    <? include("../includes/inc_header.php") ?>
    <div style="clear: both;"></div>

    <!-- Start wp_game_detail -->
    <div id="wp_game_detail">
        <div id="gd_header">
            <div class="container_ga">
                <div class="gd_thumb"><img src="https://banthe24h.vn//pictures/news/<?= $rowgame['ImageUrl']; ?>" alt="<?= $rowgame['Title'] ?>" title="<?= $rowgame['Title'] ?>"></div>
                <div class="game_info">
                    <h1 class="gd_name"><?= $rowgame['Title'] ?></h1>
                    <p class="game_public">
                        <img src="/images/app_game/ic_clock_xam.png" alt="clock">
                        <span><?= date("d/m/Y h:i:s A", strtotime($rowgame['PublicDate'])) ?></span>
                    </p>
                    <a href="<?= $url_type ?>" class="game_type"><?= $nav_name ?></a>
                    <div class="wp_sub_link" <?= !empty(mysql_fetch_assoc($db_sub->result)) ? '' : 'style="display: none;"'; ?>>
                        <?
                        $i = 0;
                        while ($rowsub = mysql_fetch_assoc($db_sub->result)) {
                            $i++;
                            $urlsub = rewrite_news($rowsub['Id'], $rowsub['ShortTitle'], 'app-tro-choi');
                        ?>
                            <a href="<?= $urlsub ?>" class="sub_link" title="<?= $rowsub['Title'] ?>"><?= $rowsub['Title'] ?></a>
                        <?
                            if ($i == 2) {
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container_ga">
            <div id="gd_content">
                <div class="gd_right">
                    <div class="gd_menu"><? echo makeML($rowgame['Description']) ?></div>
                </div>
                <!-- End gd_right -->
                <div class="gd_left">

                    <div class="intro">
                        <?= $rowgame['Intro'] ?>
                        <div class="ml_mobi gd_menu">
                            <? echo makeML($rowgame['Description']) ?>
                        </div>
                    </div>
                    
                    <? echo makeML_content($rowgame['Description']) ?>
                    <?php if ($rowgame['new_tdgy'] != "") { ?>
                        <div class="tbl_news">
                            <div class="tbl_news_title"><span><?= $rowgame['new_tdgy'] ?></span></div>
                            <div class="tbl_news_content text-center">
                                <?= $rowgame['new_ndgy'] ?>
                            </div>
                        </div>
                        <!-- End tbl_news -->
                    <? } ?>


                    <ul class="list_social">
                        <li><span>Chia sẻ: </span></li>
                        <li>
                            <div class="fb-share-button" data-href="<?= $urlcano ?>" data-layout="button" data-size="small"><a target="_blank" href="<?= $urlcano ?>" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                        </li>
                        <li style="position: relative; top: 3px;"><a href="<?= $urlcano ?>" class="twitter-share-button" data-show-count="false">Tweet</a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </li>
                        <li>
                            <script type="IN/Share" data-url="<?= $urlcano ?>"></script>
                        </li>
                    </ul>
                    <!-- End list_social -->

                    <!-- <div class="banner_cv_bv" style="float: left;width: 100%;margin-bottom: 15px">
                        <a href="https://timviec365.vn" target="blank" rel="nofollow"><img style="width: 100%" src="https://banthe24h.vn/images/banner_cv_bv.gif"></a>
                    </div> -->
                    <div class="banner_news" style="width: 100%;float: left;height: 200px;margin-bottom: 15px;">
                        <a href="https://banthe24h.vn" target="blank"><img style="width: 100%;height: 100%" src="https://banthe24h.vn/images/banner_the.jpg" alt="mua thẻ điện thoại"></a>
                    </div>

                    <div id="related_post" <?= !empty(mysql_fetch_assoc($db_sub->result)) ? '' : 'style="display: none;"'; ?>>
                        <div class="ga_title"><span>Có thể bạn quan tâm</span></div>
                        <div class="list_related_post">
                            <?
                            while ($rowsub = mysql_fetch_assoc($db_sub->result)) {
                                $urlsub2 = rewrite_news($rowsub['Id'], $rowsub['ShortTitle'], 'app-tro-choi');
                            ?>
                                <div class="box_game_3">
                                    <div class="box_show">
                                        <a href="<?= $urlsub2 ?>" title="<?= $rowsub['Title'] ?>"><img src="https://banthe24h.vn//pictures/news/<?= $rowsub['ImageUrl']; ?>" alt="<?= $rowsub['Title'] ?>"></a>
                                        <div class="game_desc_3">
                                            <a href="<?= $urlsub2 ?>" title="<?= $rowsub['Title'] ?>" class="game_name_3"><?= $rowsub['Title'] ?></a>
                                            <p class="game_public">
                                                <img src="/images/app_game/ic_clock_xam.png" alt="clock">
                                                <span><?= date("d/m/Y h:i:s A", strtotime($rowsub['PublicDate'])) ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?
                                $i++;
                                if ($i == 6) {
                                    break;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- End gd_left -->
            </div>

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
    <!-- End wp_game_detail -->


    <? include("../includes/inc_footer.php") ?>

</body>
<script src="/js/jquery.min.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/usermanager.js"></script>
<script>
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
</script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0" nonce="sj1YQXPV"></script>
<script src="https://platform.linkedin.com/in.js" type="text/javascript">
    lang: en_US
</script>


</html>
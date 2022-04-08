<?
include("config.php");
$newid = getValue("newid", "int", "GET", "");
$newid = (int)$newid;

$indexfoloow = "noodp,index,follow";


if ($_SERVER['REQUEST_URI'] == '/tin-tuc/mimaxsv-375.html') {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://banthe247.com/tin-tuc/mimaxsv-528.html");
    exit();
}

if ($_SERVER['REQUEST_URI'] == '/tin-tuc/mua-the-game-tai-han-quoc-378.html') {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://banthe247.com/tin-tuc/mua-the-game-tai-han-quoc-527.html");
    exit();
}


if ($newid > 0) {
    $db_qr1 = new db_query("SELECT Id,articles.categoryid,link_301,ImageUrl,Intro,new_tdgy,new_ndgy,articles.Description,Title,categoryname,ShortTitle,articles.Meta,PublicDate,articles.MetaDesc
                                         FROM articles 
                                         LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                         WHERE IsActive = 1 AND id = $newid");
    //var_dump(mysql_num_rows($db_qr1->result));die();
    if (mysql_num_rows($db_qr1->result) > 0) {

        $row1 = mysql_fetch_assoc($db_qr1->result);



        if ($row1['link_301'] != '') {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $row1['link_301']);
            exit();
        }

        if ($row1['ShortTitle'] != NULL) {
            $urlshort = $row1['ShortTitle'];
        } else {
            $urlshort = $row1['Title'];
        }
        $urlcano =  rewrite_news($newid, $urlshort, $row1['categoryname']);
        // $urlcano = $urlwebsite . rewrite_news($newid, $urlshort, $row1['categoryname']);
        $userinfourl = $_SERVER['REQUEST_URI'];
        $src = $row1['ImageUrl'];
        if (strpos($row1['ImageUrl'], '/upload/') === false) //files
        {
            $src = "https://banthe247.com/pictures/news/" . $row1['ImageUrl'];
        }

        //echo $userinfourl;
        $urlfull = $userinfourl;
        // $urlfull = $urlwebsite . $userinfourl;
        //var_dump($urlfull,$urlcano);
        if ($row1['categoryid'] == 5) {
            $indexfoloow = "noodp,noindex,nofollow";
        }
        if ($urlfull != $urlcano) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: $urlcano");
            exit();
        }
    } else {
        // redirect("/");
    }
} else {
    // redirect("/");
}


// Dữ liệu cho tin khác
$db_qrnew = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.CategoryID
                            WHERE IsActive = 1 AND articles.categoryid = '" . $row1['categoryid'] . "'
                            AND Id != '" . $row1['Id'] . "' 
                            ORDER BY PublicDate DESC LIMIT 4");
// Dữ liệu cho mục tin tức
$db_qrnews = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.categoryid
                            WHERE IsActive = 1 AND articles.categoryid = 1 
                            ORDER BY Id DESC LIMIT 4");

// Dữ liệu cho mục hỏi đáp
$db_qrfaqs = new db_query("SELECT * FROM faqs ORDER BY createdate DESC LIMIT 4");


$db_qr2   = new db_query("SELECT * FROM categories");
$row_back = $db_qr2->result_array('CategoryID');
$row_name = $row_back[$row1['categoryid']]['CategoryName'];
$url_back = rewriteNews($row1['categoryid'], $row_name);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $row1['Title'] ?></title>
    <meta name="description" content='<?= $row1['MetaDesc'] ?>' />
    <meta name="keywords" content='<?= $row1['Meta'] ?>' />
    <meta name="robots" content='<?= $indexfoloow ?>' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name='revisit-after' content='1 days' />
    <meta http-equiv="content-language" content="vi" />
    <meta name="author" itemprop="author" content="new_item" />
    <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
    <link rel="canonical" href='<?= $urlcano ?>' />
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />

    <meta property="og:image:url" content="<?= $src ?>">
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content="<?= $row1['Title'] ?>">
    <meta property="og:url" itemprop="url" content="<?= $urlcano ?>">
    <meta property="og:description" itemprop="description" content='<?= $row1['MetaDesc'] ?>'>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content="<?= $src ?>">
    <meta name="twitter:description" content="<?= $row1['MetaDesc'] ?>">
    <meta name="twitter:title" content="<?= $row1['Title'] ?>">
    <meta name="twitter:site" content="banthe247.com">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.min2.css?v=" />
    <link rel="stylesheet" type="text/css" href="/css/blog_detail.css?v=" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css?v=" />
</head>

<body>
    <? include("../includes/inc_header.php") ?>
    <div style="clear: both;"></div>
    <!-- Start wp_blog_detail -->
    <div id="wp_blog_detail">
        <a href="<?= $url_back ?>" id="back_home" title="Nhấn để quay lại trang trước">
            <img src="/images/blog_detail/back.png" alt="">
            <span>Quay lại</span>
        </a>

        <!-- Start  content -->
        <div class="container_bd">
            <!-- Start main_content -->

            <div id="wp_main_content">

                <!-- Start sub_content -->
                <div id="sub_content">

                    <div class="menu_bd">
                        <? echo makeML($row1['Description']) ?>
                    </div>
                    <!-- End menu_bd -->

                </div>
                <!-- End sub_content -->
                <div id="main_content">
                    <h1 id="bd_title"><?= $row1['Title'] ?></h1>

                    <div id="created_bar">
                        <div id="date_hours">
                            <div>Cập nhật: <?= date("d/m/Y • h:i:s A", strtotime($row1['PublicDate'])) ?></div>
                        </div>
                    </div>
                    <!-- End created_bar -->

                    <p>
                        <? echo trim(removeHTML($row1['Intro'])) ?>
                    </p>

                    <div class="menu_hide">
                        <? echo makeML($row1['Description']) ?>
                    </div>
                    <!-- End menu_bd -->
                    <? echo makeML_content($row1['Description'])  ?>

                    <?php if ($row1['new_tdgy'] != "") { ?>
                        <div id="sub_tbl_news" class="text-center">
                            <div class="stb_title text-left">
                                <img src="/images/blog_detail/ic_last.png" alt="">
                                <span><?= $row1['new_tdgy'] ?></span>
                            </div>
                            <div class="stb_desc text-left">
                                <?= $row1['new_ndgy'] ?>
                            </div>
                        </div>
                    <? } ?>

                    <div id="dif_news">
                        <div>Các tin khác</div>
                        <ul>
                            <?
                            while ($rownew = mysql_fetch_assoc($db_qrnew->result)) {
                                if ($rownew['ShortTitle'] != NULL) {
                                    $urlshortde = $rownew['ShortTitle'];
                                } else {
                                    $urlshortde = $rownew['Title'];
                                }
                                $src1 = $rownew['ImageUrl'];
                                if (strpos($rownew['ImageUrl'], '/upload/') === false) {
                                    $src1 = "https://napthe365.com/pictures/news/" . $rownew['ImageUrl'];
                                }
                            ?>
                                <li>
                                    <div class="dif_news_thumb"><img src="<?= $src1 ?>" title="<?= $rownew['Title'] ?>" alt="<?= $rownew['Title'] ?>"></div>
                                    <a title="<?= $rownew['Title'] ?>" href="<? echo rewrite_news($rownew['Id'], $urlshortde, $rownew['categoryname']) ?>"><?= $rownew['Title'] ?></a>
                                </li>
                            <?
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- End dif_news -->
                </div>


            </div>
            <!-- End main_content -->


        </div>
    </div>
    <!-- End  content -->
    </div>
    <!-- End wp_blog_detail -->

    <? include("../includes/inc_footer.php") ?>
</body>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/common.js?v=<?= $ver; ?>"></script>
<script src="/js/usermanager.js?v=<?= $ver; ?>"></script>
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
    var url = window.location.href;
    $(".m1").removeClass("active");
    $(".menu a").each(function() {
        if (url == this.href) {
            $(this).closest("li").addClass("active");
            $(this).closest("li").parents("li").addClass("active subtintuc");
        }
    });
    if (screen.width <= 1024) {
        $(".btn_login").on("click", function() {
            $("#signin").modal("show");
            $(".showmore").removeClass("active");
        });

        $(".btn_register").on("click", function() {
            $("#register").modal("show");
            $(".showmore").removeClass("active");
        });

    }
    $(".shownewx").click(function(e) {
        e.stopPropagation();
        if ($(".showmore").hasClass("active") == false) {
            $(".showmore").addClass("active");
        } else {
            $(".showmore").removeClass("active");
        }
    });
    $(document).click(function() {
        if ($(".showmore").hasClass("active") == true) {
            $(".showmore").removeClass("active");
        }
    });
    $(".showmore").click(function(e) {
        e.stopPropagation();
    });
</script>

</html>
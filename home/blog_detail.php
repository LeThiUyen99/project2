<?
include("config.php");
$newid = getValue("newid", "int", "GET", 0);
$newid = (int)$newid;

if ($newid > 0) {
    $db_qr1 = new db_query("SELECT Id,articles.categoryid,link_canonical,new_tdgy,new_ndgy,link_301,ImageUrl,Intro,articles.Description,Title,categoryname,ShortTitle,articles.Meta,PublicDate,articles.MetaDesc
                                         FROM articles 
                                         LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                         WHERE IsActive = 1 AND id = $newid");
    //var_dump(mysql_num_rows($db_qr1->result));die();
    if (mysql_num_rows($db_qr1->result) > 0) {

        $row1 = mysql_fetch_assoc($db_qr1->result);

        if ($row1['link_301'] != '') {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $row1['link_301']);
        }
        if ($row1['ShortTitle'] != NULL) {
            $urlshort = $row1['ShortTitle'];
        } else {
            $urlshort = $row1['Title'];
        }
        // $urlcano = rewrite_news($newid, $urlshort, $row1['categoryname']);
        $urlcano = $urlwebsite . rewrite_news($newid, $urlshort, $row1['categoryname']);
        $userinfourl = $_SERVER['REQUEST_URI'];
        $urlamp =$urlwebsite . rewrite_news($newid, $urlshort, 'amp-' .$row1['categoryname']);

        $src = $row1['ImageUrl'];
        if (strpos($row1['ImageUrl'], '/upload/') === false) {
            $src = "https://banthe24h.vn/pictures/news/" . $row1['ImageUrl'];
        }

        //echo $userinfourl;
        // $urlfull = $userinfourl;
        $urlfull = $urlwebsite . $userinfourl;
        //var_dump($urlfull);

        if ($urlfull != $urlcano) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: $urlcano");
            exit();
        }
    } else {
        redirect("/");
    }
} else {
    redirect("/");
}

// Dữ liệu cho tin khác
$db_qrnew = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.CategoryID
                            WHERE IsActive = 1 AND articles.categoryid = '" . $row1['categoryid'] . "'
                            AND Id != '" . $row1['Id'] . "' 
                            ORDER BY PublicDate DESC LIMIT 3");

// Dữ liệu cho mục tin tức
$db_qrnews = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.categoryid
                            WHERE IsActive = 1 AND articles.categoryid = 1 AND Id != '" . $row1['Id'] . "'
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
    <meta name="robots" content='noodp,index,follow' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name='revisit-after' content='1 days' />
    <meta http-equiv="content-language" content="vi" />
    <meta name="author" itemprop="author" content="new_item" />
    <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
    <link rel="canonical" href='<?= ($row1['link_canonical'] != '') ? $row1['link_canonical'] : $urlcano ?>' />
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <link rel="amphtml" href="<?=$urlamp ?>" />

    <meta property="og:image:url" content="<?= $src ?>">
    <meta property="og:image:width" content="476">
    <meta property="og:image:height" content="249">
    <meta property="og:title" itemprop="headline" content="<?= $row1['Title'] ?>">
    <meta property="og:url" itemprop="url" content="<?= ($row1['link_canonical'] != '') ? $row1['link_canonical'] : $urlcano ?>">
    <meta property="og:description" itemprop="description" content='<?= $row1['MetaDesc'] ?>'>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content="<?= $src ?>">
    <meta name="twitter:description" content="<?= $row1['MetaDesc'] ?>">
    <meta name="twitter:title" content="<?= $row1['Title'] ?>">
    <meta name="twitter:site" content="banthe24h.vn">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.min2.css?v=2" />
    <link rel="stylesheet" type="text/css" href="/css/blog_detail.css?v=2" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css" />
</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0" nonce="hh38CacZ"></script>
    <? include("../includes/inc_header.php") ?>
    <div style="clear: both;"></div>
    <!-- Start wp_blog_detail -->
    <div id="wp_blog_detail">
        <a href="<?= $url_back ?>" id="back_home">
            <img src="/images/blog_detail/back.png" alt="">
            <span>Quay lại</span>
        </a>

        <!-- Start  content -->
        <div class="container_bd">
            <!-- Start main_content -->
            <div id="main_content">
                <h1 id="bd_title"><?= $row1['Title'] ?></h1>

                <div id="created_bar">
                    <div id="date_hours">
                        <img src="/images/blog_detail/date.png" alt="">
                        <div><?= date("d/m/Y • h:i:s A", strtotime($row1['PublicDate'])) ?></div>
                    </div>
                    <div id="like_share">
                        <div class="fb-like" data-href="<?= $urlfull ?>" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
                    </div>
                </div>
                <!-- End created_bar -->

                <p>
                    <? echo trim(removeHTML($row1['Intro'])) ?>
                </p>

                <div class="menu_bd">
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
                <!-- <div id="sub_tbl_news" class="text-center">
                    <div class="stb_title text-left">
                        <img src="/images/blog_detail/ic_last.png" alt="">
                        <span>Quản trị kinh doanh: triển vọng và thách thức khi theo đuổi nghề</span>
                    </div>
                    <div class="stb_desc text-left">Bên cạnh tìm hiểu về các chiến lược tuyển dụng nhân viên cao cấp thì bộ phận nhân sự của công ty cũng nên biết được các kênh tuyển dụng hiệu quả để có kết quả như mong muốn. Top các website tuyển dụng nhân sự cao cấp uy tín được cập nhật trong bài viết dưới đây. Bạn hãy theo dõi và tìm hiểu kỹ càng để áp dụng vào công việc tốt nhất</div>
                    <a href="">Những thách thức khi theo đuổi nghề spa</a>
                </div> -->


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
                        ?>
                            <li><a title="<?= $rownew['Title'] ?>" href="<? echo rewrite_news($rownew['Id'], $urlshortde, $rownew['categoryname']) ?>"><?= $rownew['Title'] ?></a></li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
                <!-- End dif_news -->
            </div>
            <!-- End main_content -->


            <!-- Start sub_content -->
            <div id="sub_content">
                <div id="blog_news">
                    <div class="sc_title">
                        <img src="/images/blog_detail/ic_tt.png" alt="tin tức">
                        <span>Tin tức</span>
                    </div>
                    <ul>
                        <?
                        while ($row1 = mysql_fetch_assoc($db_qrnews->result)) {
                            if ($row1['ShortTitle'] != NULL) {
                                $url = $row1['ShortTitle'];
                            } else {
                                $url = $row1['Title'];
                            }
                        ?>
                            <li><a title="<?= $row1['Title'] ?>" href="<? echo rewrite_news($row1['Id'], $url, $row1['categoryname']) ?>"><?= $row1['Title'] ?></a></li>
                        <?
                        }
                        ?>
                    </ul>
                </div>

                <div id="question">
                    <div class="sc_title">
                        <img src="/images/blog_detail/ic_chtg.png" alt="câu hỏi thường gặp">
                        <span>Câu hỏi thường gặp</span>
                    </div>
                    <ul>
                        <?
                        while ($row2 = mysql_fetch_assoc($db_qrfaqs->result)) {
                        ?>
                            <li><a rel="nofollow" title="<?= $row2['Title'] ?>" href="<? echo rewrite_news($row2['FaqID'], $row2['Title'], " chuyen-muc-hoi-dap") ?>"><?= $row2['Title'] ?></a></li>
                        <?
                        }
                        ?>
                    </ul>
                </div>

                <div id="banner_ads">
                    <a rel="nofollow"><img src="/images/blog_detail/ads_tc.png" alt="banner mua thẻ cào online"></a>
                </div>
            </div>
            <!-- End sub_content -->
        </div>
        <!-- End  content -->
    </div>
    <!-- End wp_blog_detail -->

    <? include("../includes/inc_footer.php") ?>
</body>
<script src="/js/jquery.min.js"></script>
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

</html>
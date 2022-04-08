<?
    include("config.php");
    $db_qr = new db_query("SELECT * FROM mayinthecao WHERE status=1 ORDER BY id LIMIT 8");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máy in thẻ cào</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <meta name="description" content='Bán thẻ điện thoại Viettel, Vina, Mobi,.. thẻ game với chiết khấu cao, chỉ bằng một vài thao tác đơn giản, nhanh chóng, đăng ký tài khoản miễn phí sử dụng dịch vụ.' />
   <meta name="keywords" content='ban the cao, bán thẻ cào, bán thẻ điện thoại, banthe247, bán thẻ viettel, bán thẻ điện thoại viettel' />
   <meta name="robots" content='noodp,index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <meta name="twitter:card" content="summary"/>
   <meta name="twitter:description" content="Banthe247.com - địa chỉ uy tín giúp bạn mua thẻ cào online giá rẻ, đăng ký tài khoản miễn phí để nhận chiết khấu từ 5% cho thẻ điện thoại."/>
   <meta name="twitter:title" content="Banthe247.com - Dịch vụ mua thẻ cào online chiết khấu cao, nhanh chóng nhất"/>
   <meta name="twitter:site" content="banthe247com"/>
   <meta property="og:image:url" content='https://banthe247.com/upload/files/mua-the-dien-thoai.png'>
   <meta property="og:image:width" content="476">
   <meta property="og:image:height" content="249">
   <meta property="og:title" itemprop="headline" content='Website bán thẻ cào điện thoại, thẻ game uy tín, giá rẻ nhất | Banthe247.com'>
   <meta property="og:url" itemprop="url" content='https://banthe247.com/'>
   <meta property="og:description" itemprop="description" content='Bán thẻ điện thoại Viettel, Vina, Mobi,.. thẻ game với chiết khấu cao, chỉ bằng một vài thao tác đơn giản, nhanh chóng, đăng ký tài khoản miễn phí sử dụng dịch vụ ngay.'>
   <meta property="og:type" content="website">
   <meta property="og:locale" content="vi_VN">
   <link rel="canonical" href='https://banthe247.com/' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/may_in_the_cao.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css" />

</head>

<body>
    <? include("../includes/inc_header.php") ?>
    <div class="may_in_container">
        <div class="may_in_row">
            <div class="banner">
                <img src="/images/may_in_the/may_in_the.png" alt="/images/may_in_the/may_in_the.png">
            </div>
            <div class="title">
                <div class="name-tt">
                    <h2>MÁY IN THẺ CÀO</h2>
                </div>
            </div>
            <div class="col-md-4">

                <?
                    while($row=mysql_fetch_assoc($db_qr->result)){
                        if ($row['mayin_url'] != '') {
                            $url = $row['mayin_url'];
                        }else{
                            $url = $row['name'];
                        }
                    if(mysql_num_rows($db_qr->result) > 0)
                    {
                        $src = "/pictures/may_in/".$row['image'].".jpg";
                    }
                    $url = rewrite_news($row['id'],$url,"may-in");
                ?>
                <div class="box">
                    <div class="inf-tc">
                        <div class="form">
                            <div class="images">
                                <div class="img-mayin" style="padding-top:100%;">
                                    <a href="<?= $url ?>" class="img-warpper cover">
                                        <img src="<?= $src ?>" alt="<?= $row['name'] ?>">
                                    </a>
                                </div>
                            </div>
                            <div class="info">
                                <div class="gia">
                                    <div class="gia-tien">
                                        <p>
                                            <a href="<?= $url ?>" class="img-warpper cover"><?= number_format($row['price'], 0, '.', '.') ?>đ</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="title">
                                    <div class="">
                                        <h2>
                                            <a href="<?= $url ?>" class="img-warpper cover"><?= $row['name'] ?></a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?  }
            ?>
            </div>
            <div class="col-md-9">
                <div class="group-iteam">
                    <div class='col-12'>
                        <div class="tieude">
                            <p>Thanh toán an toàn</p>
                        </div>
                        <div class="item-img">
                            <img src="/images/may_in_the/thanh_toan.png" alt="/images/may_in_the/thanh_toan.png">
                        </div>
                    </div>
                    <div class='col-12'>
                        <div class="tieude">
                            <p>Giá cả phù hợp</p>
                        </div>
                        <div class="item-img">
                            <img src="/images/may_in_the/gia_ca.png" alt="Giá cả phù hợp">
                        </div>
                    </div>
                    <div class='col-12'>
                        <div class="tieude">
                            <p>Mua sắm với sự tự tin</p>
                        </div>
                        <div class="item-img">
                            <img src="/images/may_in_the/mua_sam.png" alt="Mua sắm với sự tự tin">
                        </div>
                    </div>
                    <div class='col-12'>
                        <div class="tieude">
                            <p>Hỗ trợ 24/7</p>
                        </div>
                        <div class="item-img">
                            <img src="/images/may_in_the/ho_tro.png" alt="Hỗ trợ 24/7">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <? include("../includes/inc_footer.php") ?>
</body>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/usermanager.js"></script>

</html>
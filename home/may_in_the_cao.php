<?
include("config.php"); 
$db_qr = new db_query("SELECT * FROM mayinthecao WHERE status=1 ORDER BY id");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máy in thẻ cào</title>
    
  <meta name="description" content='Địa chỉ bán thẻ cào uy tín, bạn có thể mua nhanh chóng thẻ điện thoại, thẻ game hay nạp tiền cho điện thoại giá rẻ nhất, thao tác trực tiếp tại web Banthe24h.vn.' />
  <meta name="keywords" content='Website bán thẻ điện thoại, bán thẻ game, banthe24h' />
  <meta name="robots" content='noodp,noindex,nofollow' />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name='revisit-after' content='1 days' />
  <meta http-equiv="content-language" content="vi" />
  <meta name="author" itemprop="author" content="banthe24h.com" />
  <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
  <link rel="canonical" href='https://banthe24h.vn/' />
  <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="/css/style.min2.css?v=<?= $ver; ?>" />
  <link rel="stylesheet" type="text/css" href="/css/responsive.css?v=<?= $ver; ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/css/mayinthecao.css">
    <link rel="stylesheet" type="text/css" href="/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="/css/slick-theme.css">
</head>
<body>
<? include("../includes/inc_header.php") ?>
<div class="container-mayin">
    <div class="banner"><img src="/images/may_in_the/banner.jpg" alt=""></div>
    <div class="row">
        <h1>MÁY IN THẺ CÀO</h1>
        <div class="mayinthcao">
            <div class="col-md-4 mayin">

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
                                    <div class="img-mayin">
                                        <a href="<?= $url ?>" class="img-warpper cover">
                                            <img src="<?= $src ?>" alt="<?= $row['name'] ?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="title">
                                        <div class="">
                                            <h2>
                                                <a href="<?= $url ?>" class="img-warpper cover"><?= $row['name'] ?></a>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="gia">
                                        <div class="gia-tien">
                                            <p>
                                                <a href="<?= $url ?>" class="img-warpper cover"><?= number_format($row['price'], 0, '.', '.') ?>đ</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?  }
                ?>
            </div>
        </div>
        <div class="box_see_3" style="">
            <a id="see_more">Xem thêm </a>
            <a id="hide_text">Rút gọn </a>
        </div>
    </div>
    <div class="banner-buttom">
        <div class="col-md-9">
            <div class="group-iteam">
                <div class='col-12'>
                    <div class="item-img">
                        <img src="/images/may_in_the/thanh_toan.jpg" alt="Thanh toán an toàn">
                    </div>
                    <div class="tieude">
                        <p>Thanh toán an toàn</p>
                    </div>
                    <div class="nd">
                        <p>Phương thức thanh toán phổ biến nhất</p>
                    </div>
                </div>
                <div class='col-12'>
                    <div class="item-img">
                        <img src="/images/may_in_the/mua-sam.jpg" alt="Mua sắm với sự tự tin">
                    </div>
                    <div class="tieude">
                        <p>Mua sắm với sự tự tin</p>
                    </div>
                    <div class="nd">
                        <p>Bảo vệ người mua hàng trên hệ thống chúng tôi</p>
                    </div>
                </div>
                <div class='col-12'>
                    <div class="item-img">
                        <img src="/images/may_in_the/gia-ca.jpg" alt="Giá cả phù hợp">
                    </div>
                    <div class="tieude">
                        <p>Giá cả phù hợp</p>
                    </div>
                    <div class="nd">
                        <p>Cung cấp giá sản phẩm tốt trên hệ thống</p>
                    </div>
                </div>
                <div class='col-12'>
                    <div class="item-img">
                        <img src="/images/may_in_the/ho-tro.jpg" alt="Trung tâm trợ giúp 24/7">
                    </div>
                    <div class="tieude">
                        <p>Trung tâm trợ giúp 24/7</p>
                    </div>
                    <div class="nd">
                        <p>Hỗ trợ tận tâm để người dùng thoải mái nhất</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <script src="/js/jquery.min.js"></script>
 <script src="/js/lazysizes.min.js"></script>
<? include("../includes/inc_footer.php") ?>
 <script>
         $(document).ready(function(){ 
      if ($(".mayin").height() > 196) {
        $(".mayin").css({"height": "782px", "overflow": "hidden"});
      }else{
        $('.box_see_3').hide();
      }
      $('#hide_text').hide();
      $("#hide_text").click(function(){
        $(this).hide();
        $('#see_more').show();
        $(".mayin").css("height","782px");
      });

      $("#see_more").click(function(){
        $(this).hide();
        $('#hide_text').show();
        $(".mayin").css("height","unset");
      });
    });
 </script>   
</body>
</html>
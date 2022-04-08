<?
include("config.php");
// echo "<pre>";
// print_r($_COOKIE);
// echo "</pre>";
if(isset($_POST['btn_info'])){
    if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $_POST['product_email'], $matchs)){
        $error['product_email'] = "Bạn phải nhập đúng email";
    }else{
        $product_email = $_POST['product_email'];
    }
    if(!preg_match("/^[0-9]+$/", $_POST['product_phone'], $matchs)){
        $error['product_phone'] = "Bạn phải nhập đúng số điện thoại";
    }else{
        $product_phone = $_POST['product_phone'];
    }
    $product_note = $_POST['product_note'];
    
    
    
    if( empty($_POST['dieukhoan'])){
        $error['dieukhoan'] = "Bạn chưa chọn điều khoản";
    }
    if(empty($_POST['product_email'])){
        $error['product_email'] = "Bạn chưa nhập email";
    }
    if(empty($_POST['product_phone'])){
        $error['product_phone'] = "Bạn chưa nhập số điện thoại";
    }
    $product_name = $_COOKIE['product_name'];
    $buy_quantity = $_COOKIE['buy_quantity'];
    $city_order = $_COOKIE['city_order'];
    $product_thumb = $_COOKIE['product_thumb'];
    if(empty($error)){
        $insert = new db_query("INSERT INTO thong_tin_lien_he (`ghi_chu`, `email`, `sdt`, `name`, `so_luong`, `cit_name`, `image`) VALUES ('$product_note','$product_email','$product_phone','$product_name','$buy_quantity','$city_order','$product_thumb')");   
    }
    header("Location: /home");
}

$url_site = $_SERVER['REQUEST_URI'];
$urlfull = "/may-in/lien-he-dat-mua.html";
if($url_site != $urlfull){
    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: /may-in-the-cao");
    exit();
}
// echo $urlfull;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin liên hệ</title>
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
<div class="thongtinlienhe">
    <div class="banner"><img src="/images/may_in_the/banner.jpg" alt=""></div>
    <div class="row-thongtin">
        <div class="title-h">
            <h1>LIÊN HỆ NHÀ CUNG CẤP</h1>
            <div class="ll"></div>
        </div>
        <p>(Mời bạn điền đầy đủ thông tin để hỗ trợ)</p>

        <div class="form-thongtin">
            <div class="form-group">
                <table>
                    <tr class="tr-tt">
                        <td class="inf-pr">Thông tin sản phẩm</td>
                        <td class="sluong">Số lượng</td>
                        <td>Tỉnh / thành phố</td>
                    </tr>
                    <tr class="tr-sp">
                        <td class="inf-pr">
                            <span class="product_thumb"><img src="<?php echo "/pictures/may_in/".$_COOKIE["product_thumb"]. ".jpg";?>" alt="<?php echo "/pictures/may_in/".$_COOKIE["product_thumb"]. ".jpg";?>"></span>
                            <span class="product_name"><?php echo($_COOKIE["product_name"]. "<br />");?></span>
                        </td>
                        <td class="sluong">
                            <div class="slg">
                                <span class="buy_quantity"><?php echo($_COOKIE["buy_quantity"]. "<br />");?></span>
                            </div>
                        </td>
                        <td>
                            <div class="ttp">
                                <span class="city_order"><?php echo $_COOKIE["city_order"]. "<br />";?></span>
                            </div>
                        </td>
                    </tr>
                </table>
                
                <div class="form_right">
                    <form action="" method="post">
                    <label for="fname" class="ghichu">Ghi chú:</label>
                    <textarea class="form_general" name="product_note" id="product_note" cols="30" rows="3" placeholder="Nhập ghi chú"></textarea>

                    <?
                    if(!empty($error['product_email'])){
                        echo "<p class='text-danger'>{$error['product_email']}</p>";
                    }
                    ?>
                    <div class="mail">
                        <label for="lname" class="email"><span>*</span>Email:</label>
                        <input type="email" id="lname" name="product_email" placeholder="Vui lòng nhập địa chỉ email của bạn" value="<? if (!empty($_POST['product_email'])) {echo $_POST['product_email'];} ?>">
                    </div>
                    <?
                    if(!empty($error['product_phone'])){
                        echo "<p class='text-danger'>{$error['product_phone']}</p>";
                    }
                    ?>
                    <div class="tlphone">
                        <label for="fname" class="phone"><span>*</span>Số điện thoại:</label>
                        <input type="tel" id="fname" name="product_phone" placeholder="Vui lòng nhập số diện thoại của bạn" value="<? if (!empty($_POST['product_phone'])) {echo $_POST['product_phone'];} ?>">
                    </div>
                    
                    <div class="dieu-khoan">
                        <?
                        if(!empty($error['dieukhoan'])){
                            echo "<p class='text-danger'>{$error['dieukhoan']}</p>";
                        }
                        ?>
                        <div class="check">
                            <!-- <form action="" method="post"> -->
                                <input type="checkbox" checked="checked" name="dieukhoan" id="dieukhoan">
                                <span>Tôi đồng ý với các điều khoản sử dụng của banthe24h.vn</span>
                            <!-- </form> -->
                        </div>
                    </div>
                    <input type="submit" name="btn_info" id="btn_info" value="GỬI YÊU CẦU NGAY">
                    </form>
                    <p class="nd">Vui lòng chắc chắn rằng địa chỉ email của bạn nhập chính xác</p>
                </div>
            </div>
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
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/usermanager.js"></script>
<? include("../includes/inc_footer.php") ?>    
<script>
    // $('#btn_info').click(function() {
    //     if ($("#dieukhoan").val().length == 0) {
    //         alert('Bạn chưa đồng ý với các điều khoản');
    //         $("#dieukhoan").focus();
    //     }
    //     return false;
    // });
</script>
</body>
</html>
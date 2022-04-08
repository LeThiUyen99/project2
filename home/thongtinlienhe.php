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
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin liên hệ</title>
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/may_in_the_cao.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css" />
</head>
<body>

<? include("../includes/inc_header.php") ?>
<div class="thongtinlienhe">
    <h1>LIÊN HỆ NHÀ CUNG CẤP</h1>
    <div class="row-thongtin">
        <p>(Mời bạn điền đầy đủ thông tin để hỗ trợ)</p>
        <div class="form-group">
            <div class="form_left">

                <div class="tt-mayin">
                    <p>Thông tin sản phẩm</p>
                    <div class="mayin left">
                        <span class="product_thumb"><img src="<?php echo "/pictures/may_in/".$_COOKIE["product_thumb"]. ".jpg";?>" alt="<?php echo "/pictures/may_in/".$_COOKIE["product_thumb"]. ".jpg";?>"></span>
                        <span class="product_name"><?php echo($_COOKIE["product_name"]. "<br />");?></span>
                    </div>
                </div>
                <div class="soluong">
                    <p>Số lượng</p>
                    <div class="sluong left">
                        <span class="buy_quantity"><?php echo($_COOKIE["buy_quantity"]. "<br />");?></span>
                    </div>
                </div>
                <div class="thanh_pho">
                    <p>Tỉnh/Thành phố</p>
                    <div class="tinh-thanh left">
                        <span class="city_order"><?php echo $_COOKIE["city_order"]. "<br />";?></span>
                    </div>
                </div>


                <!-- <div class="dieu-khoan">
                <?
                if(!empty($error['dieukhoan'])){
                    echo "<p class='text-danger'>{$error['dieukhoan']}</p>";
                }
                ?>
                    <div class="check">
                        <form action="" method="post">
                            <input type="checkbox" checked="checked" name="dieukhoan" id="dieukhoan">
                            <span>Tôi đồng ý với các điều khoản sử dụng của banthe247.com</span>
                        </form>
                    </div> -->
            </div>
            <div class="form_right">
                <form action="" method="post">
                <label for="fname">Ghi chú:</label>
                <textarea class="form_general" name="product_note" id="product_note" cols="30" rows="3" placeholder="Nhập ghi chú"></textarea>

                <?
                if(!empty($error['product_email'])){
                    echo "<p class='text-danger'>{$error['product_email']}</p>";
                }
                ?>
                <label for="lname">Email(<span>*</span>):</label>
                <input type="email" id="lname" name="product_email" placeholder="Vui lòng nhập địa chỉ email của bạn" value="<? if (!empty($_POST['product_email'])) {echo $_POST['product_email'];} ?>">

                <?
                if(!empty($error['product_phone'])){
                    echo "<p class='text-danger'>{$error['product_phone']}</p>";
                }
                ?>
                <label for="fname">Số điện thoại(<span>*</span>):</label>
                <input type="tel" id="fname" name="product_phone" placeholder="Vui lòng nhập số diện thoại của bạn" value="<? if (!empty($_POST['product_phone'])) {echo $_POST['product_phone'];} ?>">
                <div class="dieu-khoan">
                    <div class="check">
                        <!-- <form action="" method="post"> -->
                            <input type="checkbox" checked="checked" name="dieukhoan" id="dieukhoan">
                            <span>Tôi đồng ý với các điều khoản sử dụng của banthe247.com</span>
                        <!-- </form> -->
                    </div>
                </div>
                <p>Vui lòng chắc chắn rằng địa chỉ email của bạn nhập chính xác</p>
                <input type="submit" name="btn_info" id="btn_info" value="GỬI YÊU CẦU NGAY">
                </form>
            </div>
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
                            <img src="/images/may_in_the/gia_ca.png" alt="/images/may_in_the/gia_ca.png">
                        </div>
                    </div>
                    <div class='col-12'>
                        <div class="tieude">
                            <p>Mua sắm với sự tự tin</p>
                        </div>
                        <div class="item-img">
                            <img src="/images/may_in_the/mua_sam.png" alt="/images/may_in_the/mua_sam.png">
                        </div>
                    </div>
                    <div class='col-12'>
                        <div class="tieude">
                            <p>Hỗ trợ 24/7</p>
                        </div>
                        <div class="item-img">
                            <img src="/images/may_in_the/ho_tro.png" alt="/images/may_in_the/ho_tro.png">
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
<?
include("config.php");
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";

if(isset($_POST['save']))
{	 
	 $product_name = $_POST['name'];
	 $product_quantity = $_POST['so_luong'];
	 $product_city = $_POST['cit_name'];
     $product_email = $_POST['email	'];
     $product_note = $_POST['ghi_chu'];
	 $product_phone = $_POST['sdt'];
	 $sql = new db_query("INSERT INTO `thong_tin_lien_he`(`thongtin_id`, `sp_id`, `cm_id`, `ghi_chu`, `email`, `sdt`) VALUES ('$product_name','$product_quantity','$product_city','$product_email','$product_note','$product_phonel')");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin liên hệ</title>
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="/css/may_in_the_cao.css" />
</head>
<body>
    <? include("../includes/inc_header.php") ?>
    <div class="thongtinlienhe">
        <h1>LIÊN HỆ NHÀ CUNG CẤP</h1>
        <div class="row-thongtin">
            <form action="" method="post">
                <div class="group-left">
                    <label for="fname">Thông tin sản phẩm</label>
                    <input type="text" id="lname" name="product_name" placeholder="Vui lòng nhập địa chỉ email của bạn">

                    <label for="lname">Số lượng</label>
                    <input type="text" id="lname" name="product_quantity" placeholder="Vui lòng nhập địa chỉ email của bạn">

                    <label for="fname">Tỉnh / thành phố</label>
                    <input type="text" id="fname" name="product_city" placeholder="Vui lòng nhập số diện thoại của bạn">
                </div>
                <div class="group-right">
                    <label for="fname">Ghi chú:</label>
                    <textarea class="form_general" name="Ghi chú" id="product_note" cols="30" rows="3" placeholder="Nhập ghi chú"></textarea>

                    <label for="lname">Email(<span>*</span>):</label>
                    <input type="text" id="lname" name="product_email" placeholder="Vui lòng nhập địa chỉ email của bạn">

                    <label for="fname">Số điện thoai(<span>*</span>):</label>
                    <input type="text" id="fname" name="product_phone" placeholder="Vui lòng nhập số diện thoại của bạn">

                    <p>Vui lòng chắc chắn rằng địa chỉ email của bạn nhập chính xác</p>
                </div>
                <input type="submit" name="save" value="GỬI YÊU CẦU NGAY">
            </form>
        </div>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/usermanager.js"></script>
    <? include("../includes/inc_footer.php") ?>     
</body>
</html>
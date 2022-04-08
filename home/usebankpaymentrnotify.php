<? include("config.php");
if(isset($_GET['vnp_SecureHash'])){
$vnp_SecureHash = $_GET['vnp_SecureHash'];
//echo print_r($_GET);
}
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }

        $secureHash = md5($vnp_HashSecret . $hashData);
        
 ?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Thông báo kết quả giao dịch banknet</title>
   <meta name="description" content='THong bao ket qua giao dich banknet.' />
   <meta name="keywords" content='ket qua giao dich banknet' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='https://banthe247.com/thong-bao' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
  <link rel="stylesheet" type="text/css" href="/css/responsive.css" />  
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/common.js"></script>
  <script src="/js/usermanager.js"></script>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   <? include("../includes/inc_header.php") ?>
   <div class="container">
      <div class="divcontent1"></div>
      <div class="row">
         <div style="clear:both;"></div>
         <div class="container chietkhau">
            <h1 style="font-size:22px;">Kết quả giao dịch thanh toán banknet</h1>
            <div style="padding:15px;">
                <div class="form-group">
                    <label >Mã đơn hàng:</label>

                    <label><?php if(isset($_GET['vnp_TxnRef'])){ echo $_GET['vnp_TxnRef']; }?></label>
                </div>
                 <div class="form-group">
                    <label >Nội dung thanh toán:</label>
                    <label><?php if(isset($_GET['vnp_OrderInfo'])){ echo $_GET['vnp_OrderInfo'];} ?></label>
                </div>   
                <div class="form-group">
                    <label >Mã Ngân hàng:</label>
                    <label><?php if(isset($_GET['vnp_BankCode'])){ echo $_GET['vnp_BankCode'];} ?></label>
                </div>
                 <div class="form-group">
                    <label >Kết quả:</label>
                    <label>
                        <?php
                        if (isset($_GET['vnp_ResponseCode'])){
                        if ($secureHash == $vnp_SecureHash) {
                            
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                echo "GD Thanh cong";
                            } else {
                                echo "GD Khong thanh cong";
                            }
                        } else {
                            echo "Chu ky khong hop le";
                        }
                        }
                        ?>

                    </label>
                </div> 
            </div>
         </div>
         <!--right section work end-->  
      </div>
   </div>
   <? include("../includes/inc_footer.php") ?>
</body>
</html>
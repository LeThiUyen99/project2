<? include("config.php"); 
$urlamp = $urlwebsite."/amp-doi-the";
?>

<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Đổi thẻ cào sang tiền mặt, đổi thẻ điện thoại thành tiền</title>
   <meta name="description" content='Đổi thẻ cào sang tiền mặt uy tín chiết khấu thấp nhất, đổi thẻ cào điện thoại Viettel, Vina, Mobi, thẻ game thành tiền. Thanh toán từ 1-15 phút tới 22h00 tất cả các ngày. Đăng ký tài khoản miễn phí đổi thẻ cào ra tiền đơn giản, nhanh chóng tại Banthe247.com' />
   <meta name="keywords" content='đổi thẻ cào, đổi thẻ cào sang tiền mặt' />
   <meta name="robots" content='noodp,index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <link rel="amphtml" href="<?=$urlamp ?>" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='https://banthe247.com/doi-the' />
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
   
   
     <? include ("../includes/inc_header.php")?>

  <div class="container">
    <div class="row">      
    <div class="noidungtrangchu"> <div class=""> 
    <?
$db_qr = new db_query("SELECT * FROM `newstable` WHERE Type = '900' AND IsActive='1'");
if(mysql_num_rows($db_qr->result) > 0)
    {
        $row=mysql_fetch_assoc($db_qr->result);
?>
<div style="float:left;width:100%;">
            <?=$row['Description']?>
        </div>
<?  }?>
<div class=""> 
<table width="90%" border="1" class="table table-bordered table-striped mT20 table-bordered-blue">
    <tbody>
        <tr class="bg-lable1">
            <td colspan="2" align="center" valign="middle" class="text-center textCASE fz13 fb clfff pdt10 pdb10">
                <p class="text-center">
                    <strong>Tài liệu kết nối mua mã thẻ banthe247 </strong>
                </p>
            </td>
        </tr>
        <tr>
            <td align="center" valign="middle">
                <span class="cl0098de"><strong>Nội dung</strong></span>
            </td>
            <td align="center" valign="middle">
                <span class="cl0098de"><strong>Link tải </strong></span>
            </td>
        </tr>

        <tr>
            <td align="left">
                Tài liệu hướng dẫn kết nối nạp thẻ điện thoại online
            </td>
            <td align="center">
                <a rel="nofollow" href="https://banthe247.com/upload/API_nap_the_dien_thoai_banthe247.pdf">Tải tại đây</a>
            </td>
        </tr>

        <tr>
            <td align="left">
                Tài liệu hướng dẫn kết nối mua mã thẻ online
            </td>
            <td align="center">
                <a rel="nofollow" href="https://banthe247.com/upload/API_mua_ma_the_banthe247.pdf">Tải tại đây</a>
            </td>
        </tr>
        <tr>
            <td align="left">
                Hướng dẫn tích hợp code .NET
            </td>
            <td align="center">
                <a rel="nofollow" href="/samplecodebanthe247.rar" download="">Tải tại đây</a>
            </td>
        </tr>
        <tr>
            <td align="left">
                Hướng dẫn tích hợp code PHP
            </td>
            <td align="center">
                <a rel="nofollow" href="/sample_php_banthet247.zip" download="">Tải tại đây</a>
            </td>
        </tr> 
    </tbody>
</table>
     </div></div> </div>
  </div>
</div>
  <? include ("../includes/inc_footer.php")?>  

</body>
</html>
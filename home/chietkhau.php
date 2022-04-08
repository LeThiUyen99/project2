<? include("config.php") ?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Chiết khấu mua thẻ online tại website Banthe247.com</title>
  <meta name="description" content='Chi tiết các mức chiết khấu mua thẻ dành cho khách hàng đăng ký tài khoản trên hệ thống Banthe247.com, đăng ký tài khoản miễn phí để nhận chiết khấu cao nhất' />
  <meta name="keywords" content='thu mua thẻ cào, thẻ điện thoại, thu mua the cao, thu mua card, thu mua thẻ cào điện thoại, thu mua ma the, thu mua thẻ' />
  <meta name="robots" content='index,follow' />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name='revisit-after' content='1 days' />
  <meta http-equiv="content-language" content="vi" />
  <meta name="author" itemprop="author" content="banthe247.com" />
  <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
  <link rel="canonical" href='https://banthe247.com/chiet-khau' />
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
      <div class="col-md-12 col-xs-12 main-tintuc-left chietkhau">
        <div class="col-md-12 col-sm-12">
          <h1 class="page_titel" style="font-size:18px;font-weight: bold;">Chiết khấu thu mua thẻ cào, thu mua thẻ điện thoại, thẻ game</h1>
          <?
$db_qr = new db_query("SELECT * FROM `newstable` WHERE Type = '100' AND IsActive='1'");
if(mysql_num_rows($db_qr->result) > 0)
    {
        $row=mysql_fetch_assoc($db_qr->result);
?>
          <div style="float:left;width:100%;">
            <?= $row['Description'] ?>
          </div>
          <?  }
?>
        </div>
      </div>
      <?php //include("../includes/inc_tin_tuc_right.php")
      ?>
    </div>
  </div>
  <? include("../includes/inc_footer.php") ?>
</body>

</html>
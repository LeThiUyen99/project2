<? include("config.php") ?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>DoiNhieuThe</title>
   <meta name="description" content='Đổi nhiều thẻ thành tiền tại banthe247' />
   <meta name="keywords" content='đổi thẻ cào, đổi thẻ cào sang tiền mặt' />
   <meta name="robots" content='noodp,index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='https://banthe247.com/doi-nhieu-the' />
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
   
<h2>DoiNhieuThe</h2>
<style type="text/css">
        .bs-example {
            margin: 20px;
        }
        /* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
        .form-horizontal .control-label {
            padding-top: 7px;
        }
        .navbar-header
        {
            width:100%;
        }
        .control-label
        {
            font-size:13px;
            font-weight:bold;
        }
        fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;

}
    </style>
    
    <div class="bs-example">      
                 
                <div class="form-group">
                    <label for="inputEmail" class="control-label col-xs-2">Họ tên</label>
                    <div class="col-xs-10">
                        <p class="form-control-static"><span id="txtHoTen"></span></p>
                    </div>
                    <label for="inputEmail" class="control-label col-xs-2">Email</label>
                    <div class="col-xs-10">
                        <div class="col-xs-10" style="padding-left:0px !important;"><p class="form-control-static"><span id="txtEmail"></span></p></div>
                        <div class="col-xs-10 col-md-6"><input type="email" id="ctrlemailtxt" name="ctrlemailtxt" class="form-control" placeholder="Nhập địa chỉ email của bạn" value="" required="required" autocorrect="off" spellcheck="false" autocapitalize="off" tabindex="3">
                        </div><div class="col-md-6 col-xs-10"><button type="button" id="btntimtaikhoan" class="btn btn-primary">Tìm tài khoản</button></div>
                    </div>
                    <label for="inputEmail" class="control-label col-md-2 col-xs-12">Số tiền trong tài khoản:</label>
                    <div class="col-xs-12 col-md-10">
                        <p class="form-control-static"><span id="txttaikhoan"></span></p>
                    </div>
                    <label for="inputEmail" class="control-label col-md-2 col-xs-12">Thông tin ngân hàng</label>
                    <div class="col-xs-12 col-md-10">
                        <p class="form-control-static"><strong>Tên tài khoản:</strong>&nbsp;&nbsp;<span id="BankAccount"></span> &nbsp;   <strong>Số tài khoản:</strong>&nbsp;&nbsp;<span id="BankNumber"></span>  &nbsp;  <strong>Ngân hàng:</strong> &nbsp;<span id="BankName"></span></p>
                    </div>
                </div>

           
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="inputPassword" class="control-label col-xs-2">Nhà cung cấp</label>
                    <div class="col-xs-10">
                        <select class="form-control input-lg" id="provider">
                            <option value="1">Thẻ Viettel</option>
                            <option value="2">Thẻ Mobifone</option>
                            <option value="3">Thẻ Vinaphone</option>
                            <option value="5">Thẻ Gate</option>
                            <option value="7">Thẻ Vietnam mobile</option>
                            <option value="12">Thẻ ZING</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label col-xs-2">Mã thẻ</label>
                    <div class="col-xs-10">
                        <input type="text" id="txtPinCode" class="form-control">                        
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label col-xs-2">Số serial</label>
                    <div class="col-xs-10">
                        <input type="text" id="txtSerial" class="form-control">                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="button" id="doithesangtienbtn" class="btn btn-primary">Đổi thẻ sang tiền</button>
                    </div>
                </div>
            </form>
        
    </div>
<br />
<h3 class="text-head">Lịch sử giao dịch</h3>
    <div class="row form-horizontal">
    <div class="col-md-3">
        <div class="form-group">
            <label class="col-md-5 control-label" for="ctrlfromdatetxt">Từ ngày</label>
            <div class="input-group col-md-7">
                <input type="text" class="form-control" id="ctrlfromdatetxt" placeholder="Từ ngày">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="col-md-5 control-label" for="ctrltodatetxt">Đến ngày</label>
            <div class="input-group col-md-7">
                <input type="text" class="form-control" id="ctrltodatetxt" placeholder="Đến ngày">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <button type="button" class="btn btn-primary btn-primary" id="ctrlsearchtransactionbtn">Tra cứu giao dịch</button>
    </div>
</div>
<br />
<div style="margin-bottom:20px;">
    <table id="gridTransaction" class="gridTransaction"></table>
    </div>
  </div>
</div>
  <? include ("../includes/inc_footer.php")?>  

</body>
</html>
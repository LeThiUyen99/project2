<?
include("config.php");
if($logger != 1)
{
   redirect("/");
}
$userinfourl=$_SERVER['REQUEST_URI'];

$urluri="/user/lichsunaptiendienthoai";
if($userinfourl != $urluri)
{
   header("HTTP/1.1 301 Moved Permanently"); 
   header("Location: $urluri");
   exit();
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Lịch sử nạp tiền điện thoại | banthe24h.vn</title>
   <meta name="description" content='Lịch sử nạp tiền điện thoại ' />
   <meta name="keywords" content='Lịch sử nạp tiền điện thoại ' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe24h.vn" />
   <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
   <link rel="canonical" href='https://banthe24h.vn/user/lichsunaptiendienthoai' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
  <link rel="stylesheet" type="text/css" href="/css/responsive.css" />  
  <script src="/js/jquery-1.9.1.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/common.js"></script>

   <script>
    var Config = {
        AppUrl: ''
    };
    $(document).ready(function () {
        Config.AppUrl = '@Url.Content("/")';
    });
</script>
<!--Css và jquery datatable-->
<link href="/Assets/css/dataTables/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="/Assets/css/dataTables/dataTables.responsive.css" rel="stylesheet" />
<link href="/Assets/css/dataTables/buttons.dataTables.min.css" rel="stylesheet" />
<link href="/Assets/css/dataTables/jquery.dataTables.min.css" rel="stylesheet" />
<script src="/Assets/js/dataTables/jquery.dataTables.min.js"></script>
<script src="/Assets/js/dataTables/dataTables.bootstrap.min.js"></script>
<script src="/Assets/js/dataTables/dataTables.responsive.min.js"></script>
<script src="/Assets/js/dataTables/dataTables.buttons.min.js"></script>
<script src="/Assets/js/dataTables/dataTables.select.min.js"></script>
<script src="/Assets/js/dataTables/buttons.flash.min.js"></script>
<!--Kết thúc Css và jquery datatable-->
<script src="/js/Busy.js"></script>
<!--Lịch-->
<script src="/Assets/js/moment.js"></script>
<script src="/Assets/js/bootstrap-datetimepicker.js"></script>
<link href="/Assets/css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="/Assets/js/localDatetime.js"></script>
  <script src="/js/usermanager.js"></script>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   <? include("../includes/inc_header.php") ?>
   <div class="container">
      <div class="divcontent1"></div>
      <div class="row">
        <div class="container">
            <div class="col-md-3"> 
                <nav class="nav-sidebar"> 
                    <ul class="nav"> 
                    <li>
                        <a href="/user/lichsunaptientaikhoan"><i class="glyphicon glyphicon-check"></i> Lịch sử nạp tiền vào tài khoản</a>
                    </li> 
                    <li>
                        <a href="/user/lichsumuathe"><i class="glyphicon glyphicon-check"></i> Lịch sử mua mã thẻ</a>
                    </li> 
                    <li>
                        <a href="/user/lichsunaptiendienthoai"><i class="glyphicon glyphicon-check"></i> Lịch sử nạp tiền nhanh</a>
                    </li>
                </ul> 
            </nav> 
            </div>
            <div class="col-md-9">
                <div style="float:left;width:100%;">
                                    <h3 class="title">Lịch sử nạp tiền điện thoại</h3>
                                </div>
                <div class="row" style="background-color: #eeeeee; margin-left: 0px; margin-right: 0px; margin-bottom: 10px; padding-top: 10px; border: 1px solid #ddd;">
                                    <p class="col-sm-6">Tổng số tiền mệnh giá: <a id="idSumMoneyHistory"></a> VNĐ</p>
                                </div>
                                <div class="row" style="margin-top:20px;">
                                    <div class="col-xs-12 col-lg-2" style="float: left; padding-bottom: 5px;">
                                        <label style="font-weight:400; margin-top:5px;">Bắt đầu:</label>
                                    </div>
                                    <div class='input-group date col-xs-12 col-lg-3' id='datetimepicker1' style="float: left; padding-bottom: 5px; padding-left: 15px; padding-right:15px;">
                                        <input type="text" class="form-control" id="ctrlfromdatetxt" placeholder="Từ ngày">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                    <div class="col-xs-12 col-lg-2" style="float: left; padding-bottom:5px;">
                                        <label style="font-weight: 400; margin-top: 5px;">Trạng thái:</label>
                                    </div>
                                    <div style="float: left; padding-bottom: 5px;" class="col-xs-12 col-lg-3">
                                        <select id="ctrltrangthainaptiendt" class="form-control">
                                            <option value="-1">----Tất cả----</option>
                                            <option value="1">Thành công</option>
                                            <option value="2">Thất bại</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-xs-12 col-lg-2" style="float: left; padding-bottom: 5px;">
                                        <label style="font-weight: 400; margin-top: 5px;">Kết thúc:</label>
                                    </div>
                                    <div class='input-group date col-xs-12 col-lg-3' id='datetimepicker2' style="float: left; padding-bottom: 5px; padding-left: 15px; padding-right:15px;">
                                        <input type="text" class="form-control" id="ctrltodatetxt" placeholder="Đến ngày">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                    <div class="col-xs-12 col-lg-2" style="float: left; padding-bottom: 5px;">
                                        <label style="font-weight: 400; margin-top: 5px;">Số điện thoại:</label>
                                    </div>
                                    <div style="float: left; padding-bottom: 5px;" class="col-xs-12 col-lg-3">
                                        <input type="text" id="searchnaptiendt" class="form-control" placeholder="Vui lòng nhập số điện thoại...">
                                    </div>
                                    <div class="col-xs-12 col-lg-4" style="margin-top: 15px;">
                                        <button type="button" class="btn btn-success" id="ctrlsearchnaptiendt">Tra cứu</button>

                                        <button type="button" class="btn btn-warning" id="xuatexel_ls">Xuất excel</button>

                                    </div>
                                </div>
                                <br />
                <div class="row" style="margin-bottom:20px;">
                                    <div class="col-sm-12">
                                        <table id="tblLichSuNapTienDienThoai" class="display table table-bordered table-responsive dt-responsive datatable" cellspacing="0" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">Số điện thoại</th>
                                                    <th style="text-align:center">Mệnh giá</th>
                                                    <th style="text-align:center">Trạng thái</th>
                                                    <th style="text-align:center">Thời gian</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div> 
            </div>
        </div>
      </div>
      <div>          
          
      <!--right section work end-->  
      </div>
   </div>
   <? include("../includes/inc_footer.php") ?>
   <script>
    $(document).ready(function () {
            $("#ctrlfromdatetxt").val("");
            $("#ctrltrangthainaptiendt").val("-1");
            $("#ctrltodatetxt").val("");
            $("#searchnaptiendt").val("");
            var ht = new LichSuNapTienDienThoai();
            ht.initLichSuNapTienDienThoai();
        });
    </script>

   <script type="text/javascript">
      function click_ls() {
        $('#ctrlsearchnaptiendt').click();
      }

      $('#xuatexel_ls').click(function(){
          $.ajax({
             url:click_ls(),
             success:function(){ 
              setTimeout(function(){
                excel_ls('tblLichSuNapTienDienThoai');
              }, 200);
             }
          })  
      });
   </script>  
</body>
</html>
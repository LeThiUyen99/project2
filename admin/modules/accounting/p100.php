<?
require_once("inc_security.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
   <link href="/css/grid-0.4.3.min.css" rel="stylesheet" type="text/css"/>
  
   <script src="/js/jquery-1.9.1.js"></script>
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
<script src="/js/AdminQuanLyGiaoDich.js?v=1"></script>
<!---Css Quản lý giao dịch-->

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<br />
<br />
<div class="row" style="margin-left:0px; margin-bottom:15px" id="thongbao" hidden>
    <span style="color:red; font-weight:bold"></span>
</div>
<!--end row 0-->

<script>
    $(document).ready(function () {
        var giaoDich = new GiaoDich();
        giaoDich.Init();
    });
</script>

<!--row 1-->
<div class="row form-group">
    <label class="control-label col-xs-1" style="font-weight:bold;line-height:2.5;">Loại dịch vụ:</label>
    <div class="col-xs-4">
        <select class="form-control" id="optTaiKhoan" style="width: 100%">
            <option value="-1" selected>--- Vui lòng chọn  ---</option>
            <option value="1">Nạp tiền điện thoại</option>
            <option value="2">Mua mã thẻ cào</option>
            <option value="4">Gạch thẻ</option>
            <option value="5">Nạp tiền vào TK</option>
            <option value="6">Rút tiền</option>
            <option value="7">Chuyển tiền</option>
            <option value="8">Nhận tiền</option>
            <option value="9">Nạp tại quầy</option>
        </select>
    </div>
    <label class="control-label col-xs-1" style="font-weight:bold;line-height:2.5;">Nhóm:</label>
    <div class="col-xs-4">
        <select class="form-control" id="optNhom" style="width: 100%">
            <option value="-1" selected>--- Vui lòng chọn nhóm ---</option>
            <option value="1">Đại lí cấp 1</option>
            <option value="4">Đại lí cấp 2</option>
            <option value="5">Đại lí cấp 3</option>
            <option value="6">Người dùng PayCard</option> 
        </select>
    </div>
</div>
<!--end row 1-->

<!--row 2-->
<div class="row form-group">
    <label class="control-label col-xs-1" style="font-weight:bold;line-height:2.5;">Từ ngày:</label>
    <div class="col-xs-4">
        <div class='input-group date' id='datetimepicker1' style="width: 100%">
            <input type='text' placeholder="Start ......." id="txtStart" class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <label class="control-label col-xs-1" style="font-weight:bold;line-height:2.5;">Đến ngày:</label>
    <div class="col-xs-4">
        <div class='input-group date' id='datetimepicker2' style="width: 100%">
            <input type='text' placeholder="End ......." id="txtEnd" class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="col-xs-2"><button type="button" class="btn btn-primary" id="btnTimKiem"><i class="fa fa-search"></i>Tìm kiếm</button></div>
</div>
<!--end row 2-->

<div class="row" style="border:1px solid #CCCCCC; font-weight:bold; margin-left:0px; margin-right:0px; padding-top:7px; padding-bottom:7px; padding-left:7px">
    Tổng tiền: <input style="padding:3px; color:red" type="text" id="money" /> VNĐ
    <div class="pull-right col-md-6" style="text-align:right;">Tổng tài khoản: <input style="padding:3px; color:red" type="text" id="moneyinaccount" /> VNĐ</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <!--table quản lý giao dịch-->
        <table id="tblQuanLyGiaoDich" class="display table table-bordered table-responsive table-striped dt-responsive datatable" cellspacing="0" style="width:100%">
            <thead>
                <tr>
                    <th>Họ và tên</th>
                    <th>Tên tài khoản</th>
                    <th>Loại giao dịch</th>
                    <th style="text-align:left">Số tiền</th>
                    <th>Số tiền trong tài khoản</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>


<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<? unset($db_admin_listing);?>
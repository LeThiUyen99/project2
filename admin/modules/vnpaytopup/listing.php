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
   <script src="/js/admin/js/bootstrap.min.js"></script>
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
<link href="/js/admin/css/plugins/gritter/jquery.gritter.css" rel="stylesheet">
<script src="/js/admin/js/plugins/gritter/jquery.gritter.js"></script>
<script src="/js/admin/js/plugins/bootbox/bootbox.min.js"></script>
<script src="/js/Busy.js"></script>
<!--Lịch-->
<script src="/Assets/js/moment.js"></script>
<script src="/Assets/js/bootstrap-datetimepicker.js"></script>
<link href="/Assets/css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="/Assets/js/localDatetime.js"></script>
<script src="/js/admin/js/admin-quan-ly-vnpay-topup-mobile.js?v=2"></script>
<!---Css Quản lý giao dịch-->

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">

 <script>
        $(document).ready(function () {
            var _topUpMobile = new TopUpMobile();
            _topUpMobile.initTopUpMobile();
        });
    </script>
<div class="">  
    <br />
   <div class="row tieuDeAdmin">
        <div class="col-sm-12">
            <h3>Quản lý TopUp Mobile</h3>
        </div>
    </div>
    <!--Chức năng-->
    <div class="row" style="margin-bottom:5px; margin-top:5px; margin-left:0px; margin-right:0px; padding-top:5px; padding-bottom:5px">
        <div class="col-sm-12" style="padding-bottom:10px">
            <div class='input-group date' id='datetimepicker1' style="width: 250px; float: left; margin-left: -15px; margin-right: 30px; padding-top: 10px; ">
                <input type='text' placeholder="Từ ngày" class="form-control" id="txtStart" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <div class='input-group date' id='datetimepicker2' style="width: 250px; float: left; margin-left: -15px; margin-right: 15px; padding-top: 10px; ">
                <input type='text' placeholder="Đến ngày" class="form-control" id="txtEnd" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            <div class="input-group" style="width: 350px; text-align: right; margin-left: -15px; margin-right: 30px; padding-top: 10px; ">
                <input type="text" id="txtfinKey" placeholder="Vui lòng nhập số điện thoại cần tìm ....." class="ctrlsearch form-control" />
                <span class="input-group-addon btn btn-success" id="btnTimKiem"><i class="fa fa-search"></i> Tìm kiếm</span>
            </div>
        </div>
    </div>
    <!--Kết thúc chức năng-->

    <div class="row">
        <div class="col-sm-12">
            <div id="content"></div>
        </div>
    </div>

    <div class="row" style="padding-left:15px; padding-right:15px; margin-bottom:10px">
        <div class="col-sm-12" style="border-bottom:1px solid orange;"></div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table id="tblTopUpMobile" class="display table table-bordered table-responsive dt-responsive datatable" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Số điện thoại</th>
                        <th>Mệnh giá</th>
                        <th>Resp Code</th>
                        <th>Trang thái</th>
                        <th>Ngày tạo</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<? unset($db_admin_listing);?>
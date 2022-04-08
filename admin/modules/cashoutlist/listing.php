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
<script src="/js/admin/js/admin-quan-ly-rut-tien.js?v=2"></script>
<!---Css Quản lý giao dịch-->

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">

 <script>
        $(document).ready(function () {
            var rutTien = new QuanLyRutTien();
            rutTien.initQuanLyRutTien();
        });
    </script>
<div class="">  
    <br />
   <div class="row tieuDeAdmin">
        <div class="col-sm-12">
            <h3>Thống kê lệnh rút</h3>
        </div>
    </div>
    <!--Chức năng-->
    <div class="row">
        <div class="col-sm-2" style="float: left; padding-bottom: 5px;">
            <label style="margin-top:6px;">Bắt đầu:</label>
        </div>
        <div class='input-group date col-sm-3' id='datetimepicker1' style="float: left; padding-bottom: 5px; padding-left: 15px; padding-right:15px;">
            <input type='text' placeholder="Thời gian bắt đầu..." class="form-control" id="txtStart" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <div class="col-sm-2" style="float: left; padding-bottom:5px;">
            <label style="margin-top:6px;">Trạng thái:</label>
        </div>
        <div style="float: left; padding-bottom: 5px;" class="col-sm-3">
            <select class="form-control" id="optTrangThai">
                <option value="-1" selected="selected">Vui lòng chọn trạng thái</option>
                <option value="1">Đã duyệt</option>
                <option value="0">Chưa duyệt</option>
            </select>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col-sm-2" style="float: left; padding-bottom: 5px;">
            <label style="margin-top:6px;">Kết thúc:</label>
        </div>
        <div class='input-group date col-sm-3' id='datetimepicker2' style="float: left; padding-bottom: 5px; padding-left: 15px; padding-right:15px;">
            <input type='text' placeholder="Thời gian kết thúc..." class="form-control" id="txtEnd" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <div class="col-sm-2" style="float: left; padding-bottom: 5px;">
            <label style="margin-top:6px;">Từ khóa:</label>
        </div>
        <div class="input-group col-sm-4" style="float: left; padding-left: 0px; padding-bottom: 5px; margin-left:15px; margin-right:0px;">
            <input type="text" id="txtfinKey" placeholder="Email, số điện thoại, tên khách hàng cần tìm ....." class="form-control" />
            <span class="input-group-addon btn btn-success" id="btnTimKiem"><i class="fa fa-search"></i> Tìm kiếm</span>
        </div>
    </div>
    <div class="row" style="margin-bottom:5px; margin-top:5px; margin-left:-15px; margin-right:-15px; padding-top:5px; padding-bottom:5px">
        <div class="col-sm-7">
            <div class="col-sm-6">
                <label>Đã chuyển:</label>
                <span class="tongdachuyet"></span>
            </div>
            <div class="col-sm-6">
                <label>Chưa chuyển:</label>
                <span class="tongchuaduyet"></span>
            </div>
        </div>
    </div>
    <!--Kết thúc chức năng-->

    <div class="row" style="padding-left:15px; padding-right:15px; margin-bottom:10px">
        <div class="col-sm-12" style="border-bottom:1px solid orange;"></div>
    </div>
    <div class="row">
        <div class="col-sm-12" id="content">
            <table id="tblKhoTheNguoiDung" class="display table table-bordered table-responsive dt-responsive datatable" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Người rút</th>
                        <th>Số tiền</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th>Mã giao dịch</th>                        
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
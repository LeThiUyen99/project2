<?
require_once("inc_security.php");

	//gọi class DataGird


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
<script src="/js/admin/js/admin-quan-ly-tai-khoan.js"></script>
<script src="/js/admin/js/admin-Layout.js"></script>
<link href="/js/admin/css/font-awesome.min.css" rel="stylesheet" />
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>
<script>
    $(document).ready(function () {
        var quanLyTaiKhoanNguoiDung = new QuanLyTaiKhoanNguoiDung();
        quanLyTaiKhoanNguoiDung.initQuanLyTaiKhoanNguoiDung();
    });
</script>
<style>
    table#tblKichHoatTaiKhoanNguoiDung th {
        text-align: center;
    }

    #btnTimKiem:hover {
        cursor: pointer;
        background-color: #5cb85c;
        color: white;
    }
</style>
<br />
<div style="width:100%;padding-left:10px;padding-right:10px;">
<div class="row tieuDeAdmin" id="tabBanthe24h">
    <a class="tabNoiDungBanthe24h activeTab col-lg-6" data-value="noiDungBanThe24h"><h3>Quản lý tài khoản</h3></a>
</div>
<div id="noiDungBanThe24h">
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
                <!--<option value="-1" selected="selected">Vui lòng chọn trạng thái</option>
                <option value="1">Đã kích hoạt</option>-->
                <option value="0">Chưa kích hoạt</option>
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
        <div class="input-group col-sm-4" style="float: left; padding-left: 0px; padding-bottom: 5px; margin-left: 15px; margin-right: 0px; padding-right: 20px;">
            <input type="text" id="txtfinKey" placeholder="Email, số điện thoại, tên khách hàng cần tìm ....." class="form-control" />
            <span class="input-group-addon" id="btnTimKiem"><i class="fa fa-search"></i> Tìm kiếm</span>
        </div>
    </div>
    <div class="row" style="margin:0px; margin-top:10px;">
        <div class="col-sm-12" style="margin-left:-15px;">
            <label>Số lượng tài khoản:</label> <label id="totalAccount" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
        </div>
    </div>

    <div class="row" style="padding-left:15px; padding-right:15px; margin-bottom:10px">
        <div class="col-sm-12" style="border-bottom:1px solid orange;"></div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table id="tblKichHoatTaiKhoanNguoiDung" class="display table table-bordered table-responsive dt-responsive datatable" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Họ và tên</th>
                        <th>Tên đăng nhập</th>
                        <th>Nhóm</th>
                        <th>Số điện thoại</th>
                        <th>Thời gian tạo</th>
                        <th style="text-align:center">Trạng thái</th>
                        <th style="width:120px; text-align:center">Chức năng</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<div id="huongDanSuDungBanThe24h" style="display:none">
    Hướng dẫn sử dụng
</div>
</div>
<? /*---------Body------------*/ ?>
</body>
</html>
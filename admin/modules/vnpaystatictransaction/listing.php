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
<script src="/js/admin/js/admin-quan-ly-thong-ke-giao-dich-banknet?v=1.1"></script>
<!---Css Quản lý giao dịch-->

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">

 <script>
       $(document).ready(function () {
        var storeView = new TyLeBankNet();
        storeView.Init();
    });
    </script>
<div class="">  
    <br />
   <div class="row tieuDeAdmin">
        <div class="col-sm-12">
            <h3>Thống kê banknet</h3>
        </div>
    </div>
    <!--Chức năng-->
    <div class="row form-group">
        <label class="control-label col-xs-2" style="font-weight:bold;line-height:2.5;">Trạng thái:</label>
        <div class="col-xs-3">
            <select class="form-control" id="optTaiKhoan" style="width: 100%;">
                <option value="-1" selected>--- Vui lòng chọn ---</option>
                <option value="1">Thành công</option>
                <option value="0">Thất bại</option>

            </select>
        </div>
        <label class="control-label col-xs-2" style="font-weight:bold;line-height:2.5;">Loại giao dịch:</label>
        <div class="col-xs-3">
            <select class="form-control" id="optNhom" style="width: 100%">
                <option value="0" selected>Tất cả</option>
                <option value="1">Nạp tiền điện thoại</option>
                <option value="10">Nạp Viettel</option>
                <option value="2">Mua mã thẻ</option>
                <option value="5">Nạp tiền tài khoản</option>
                <option value="99">Khách vãng lai</option>
                <option value="100">Khách đăng kí tk</option>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <label class="control-label col-xs-2" style="font-weight:bold;line-height:2.5;">Từ ngày:</label>
        <div class="col-xs-3">
            <div class='input-group date' id='datetimepicker1' style="width: 100%">
                <input type='text' placeholder="Start ......." id="txtStart" class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <label class="control-label col-xs-2" style="font-weight:bold;line-height:2.5;">Đến ngày:</label>
        <div class="col-xs-3">
            <div class='input-group date' id='datetimepicker2' style="width: 100%">
                <input type='text' placeholder="End ......." id="txtEnd" class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="col-xs-2"><button type="button" class="btn btn-primary" id="btnTimKiem"><i class="fa fa-search"></i> Tìm kiếm</button></div>
    </div>
    <!--Kết thúc chức năng-->

    <div class="row" style="margin:0px; margin-top:10px;">
        <div class="col-sm-12" style="margin-left:-15px;">
            <label>Tổng giao dịch:</label> <label id="totalSoLuong" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            <label style="margin-left:30px;">Tổng tiền:</label> <label id="totalSoTien" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            <label style="margin-left:30px;">Số thẻ bán ra:</label> <label id="totalsothe" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            <label style="margin-left:30px;">Tổng mệnh giá bán:</label> <label id="totalmenhgiathe" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            <label style="margin-left:30px;">Số lượng topup:</label> <label id="totalsotopup" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>            
            <label style="margin-left:30px;">Tổng mệnh giá topup:</label> <label id="totalmenhgiatopup" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            <label style="margin-left:30px;">Tổng mệnh giá:</label> <label id="totalall" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
        </div>
    </div>

    <div class="row" style="padding-left:15px; padding-right:15px; margin-bottom:10px">
        <div class="col-sm-12" style="border-bottom:1px solid orange;"></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!--table quản lý giao dịch-->
            <table id="tblStoreView" class="display table table-bordered table-responsive table-striped dt-responsive datatable" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Giao dịch</th>
                        <th style="text-align:center">Chiết khấu</th>
                        <th style="text-align:center">Số lượng</th>
                        
                        <th style="text-align:center">Phí Ngân hàng</th>
                        <th>Mệnh giá</th>
                        <th>Chi tiết giao dịch</th>
                        <th>Số tiền</th>
                        <th>Email</th>
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
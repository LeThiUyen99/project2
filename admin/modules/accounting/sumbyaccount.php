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
<script src="/js/AdminSumByUser.js"></script>
<!---Css Quản lý giao dịch-->

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<br />
<br />
<script>
    $(document).ready(function () {
        var giaoDich = new SumByUser();
        giaoDich.Init();
    });
</script>
<div class="row">  
    <br />
    <div class="row form-horizontal">
        <div class="col-md-3">
            <div class="form-group">
                <label class="col-md-5 control-label" for="ctrlfromdatetxt">Từ khóa</label>
                <div class="input-group col-md-7">                    
                   <input type="text" id="search" class="form-control" placeholder="Nhập từ khóa">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="col-md-5 control-label" for="ctrlfromdatetxt">Từ ngày</label>
                <div class="input-group col-md-7">
                    <div class='input-group date' id='datetimepicker1' style="width: 100%">
                        <input type='text' placeholder="Start ......." id="txtStart" class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="col-md-5 control-label" for="ctrltodatetxt">Đến ngày</label>
                <div class="input-group col-md-7">
                    <div class='input-group date' id='datetimepicker2' style="width: 100%">
                        <input type='text' placeholder="End ......." id="txtEnd" class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="width:20%">
            <button type="button" class="btn btn-primary btn-primary" id="ctrlsearchtransactionbtn">Tra cứu giao dịch</button>
        </div>
    </div>
    <br />
  
</div>
<br /> 
<!--<p><span class="input-group-addon"  ><label class="col-md-2 control-label" for="ctrlfromdatetxt">Tổng số tiền mệnh giá: <a id="idSumMoneyValue"></a> VNĐ</label> 
<label class="col-md-2 control-label" for="ctrlfromdatetxt">Tổng price: <a id="idSumPriceValue"></a> VNĐ</label>
</span>
</p>-->
<table id="grid" class="display table table-bordered table-responsive table-striped dt-responsive datatable" cellspacing="0" style="width:100%">
    <thead>
        <tr>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Name</th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Tên đăng nhập</th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: right;">Topup mobile</th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: right;">Mua mã thẻ cào</th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: right;">Gạch thẻ</th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: right;">Nạp tiền vào TK </th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: right;">Rút tiền</th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: right;">Chuyển tiền</th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: right;">Nhận tiền</th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: right;">Nạp tiền tại quầy</th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: right;">Tổng tiền</th>
        </tr>
    </thead>
</table>
 <!-- Modal -->


<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<? unset($db_admin_listing);?>
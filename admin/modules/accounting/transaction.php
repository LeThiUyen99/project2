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
<script src="/js/AdminTransacsions.js?v=6"></script>
<!---Css Quản lý giao dịch-->

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<br />
<br />
<script>
    $(document).ready(function () {
        var giaoDich = new Transaction();
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
                    <select id="search" class="form-control">
                        <option value="">--Tất cả--</option>
                        <option value="1">Topup mobile</option>
                        <option value="2">Mua mã thẻ cào</option>
                        <option value="4">Gạch thẻ</option>
                        <option value="5">Nạp tiền vào tài khoản</option>
                        <option value="6">Rút tiền</option>  
                        <option value="7">Chuyển tiền</option> 
                        <option value="8">Nhận tiền</option> 
                        <option value="9">Nạp tại quầy</option> 
                    </select>
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
   <!--<div class="col-md-12">
         <div class="col-md-2" style="width:20%">
            <button type="button" class="btn btn-primary btn-primary" id="ctrlcongtienchokhach">Cộng tiền cho khách</button>
        </div>
    </div>-->
</div>
<br /> 
<p><span class="input-group-addon"  ><label class="col-md-2 control-label" for="ctrlfromdatetxt">Tổng số tiền mệnh giá: <a id="idSumMoneyValue"></a> VNĐ</label> 
<label class="col-md-2 control-label" for="ctrlfromdatetxt">Tổng price: <a id="idSumPriceValue"></a> VNĐ</label>
</span>
</p>
<table id="grid" class="display table table-bordered table-responsive table-striped dt-responsive datatable" cellspacing="0" style="width:100%">
    <thead>
        <tr>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">GroupName
            </th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Tên đăng nhập
            </th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Email
            </th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Hình thức
            </th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Số tiền
            </th>
            <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Thời gian
            </th>
        </tr>
    </thead>
</table>
 <!-- Modal -->
<div class="modal fade" id="GroupAddPrice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md">
        <div class="panel panel-primary">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="groupModalLabel">Thêm mới giá chiết khấu</h4>
            </div>
            <div class="modal-body">
                <div>
                    <table>
                        <tr>
                            <td style="width:30%">
                                <label for="ctrladdprice">Tìm tài khoản</label>
                            </td>
                            <td style="width:40%">
                                <input id="ctrlEmailaddprice" name="ctrlEmailaddprice" class="form-control col-md-3"  placeholder="Điền email" type="text" />
                            </td>
                            <td style="width:30%">
                                <button type="button" id="btntimtaikhoan" class="btn btn-primary pull-right">Tìm kiếm</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <br />
                <hr />
                <form>
                    <div class="form-group" style="overflow:hidden;">
                        <label for="inputEmail" class="control-label col-sm-3" style="font-size:14px;"><b>Tên người nhận</b></label>
                        <p class="col-sm-9"><span id="txtHoTen"></span></p>
                    </div> 
                    <div class="form-group" style="overflow:hidden;">
                        <label for="inputEmail" class="control-label col-sm-3" style="font-size:14px;"><b>Số điện thoại</b></label>
                        <p class="col-sm-9"><span id="txtdienthoai"></span></p>
                    </div>
                    <div class="form-group" style="overflow:hidden;">
                        <label for="inputEmail" class="control-label col-sm-3" style="font-size:14px;"><b>Email</b></label>
                        <p class="col-sm-9"><span id="txtEmail"></span></p>
                    </div>
                    <div class="form-group" style="overflow:hidden;">
                        <label for="inputEmail" class="control-label col-sm-3" style="font-size:14px;"><b>Tk ngân hàng</b></label>
                        <p class="col-sm-9"><span id="BankAccount"></span></p>
                    </div>
                    <div class="form-group" style="overflow:hidden;">
                        <label for="inputEmail" class="control-label col-sm-3" style="font-size:14px;"><b>Tài khoản</b></label>
                        <p class="col-sm-9"><span id="BankNumber" ></span></p>
                    </div>
                    <div class="form-group" style="overflow:hidden;">
                        <label for="bankname" class="control-label col-sm-3" style="font-size:14px;"<b>Ngân hàng</b></label>
                        <p class="col-sm-9" ><span id="BankName"></span></p>
                    </div>    
                     <div class="form-row">
                        <label for="c2">Số tiền nhập</label>
                        <div class="input-group"> 
                            <span class="input-group-addon">VNĐ</span>
                            <input type="number" value="0" min="0" step="50000" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                        </div>
                     </div>               
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btnSaveP" class="btn btn-primary">Save</button>
            </div>        
        </div>
    </div>
</div>

<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<? unset($db_admin_listing);?>
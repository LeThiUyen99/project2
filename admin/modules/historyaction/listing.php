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
<script src="/js/admin/js/admin-quan-ly-lich-su-thao-tac.js?v=1"></script>
<!---Css Quản lý giao dịch-->

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">

 <script>
       $(document).ready(function () {
            var lichSuThaoTac = new LichSuThaoTacDB();
            lichSuThaoTac.initThaoTacDB();
        });
    </script>
<div class="">  
    <br />
   <div class="row tieuDeAdmin">
        <div class="col-sm-12">
            <h3>Quản lý lịch sử thao tác</h3>
        </div>
    </div>
    <!--Chức năng-->
     <div class="row">
        <div class="col-sm-2" style="float: left; padding-bottom:5px;">
            <label>Từ ngày:</label>
        </div>
        <div class='input-group date col-sm-3' id='datetimepicker1' style="float: left; padding-bottom: 5px; padding-left: 15px;">
            <input type='text' placeholder="Từ ngày" class="form-control" id="txtStart" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <div class="col-sm-2" style="float: left; padding-bottom: 5px; margin-left:15px;">
            <label>Thao tác:</label>
        </div>
        <div style="float: left; padding-bottom: 5px;" class="col-sm-4">
            <select class="form-control" id="optThaoTac">
                <option value="0">Lựa chọn thao tác</option>
                <option value="1">Hủy topup thành công</option>
                <option value="2">Hủy topup thất bại</option>
                <option value="3">Cộng tiền khách hàng</option>
                <option value="4">Duyệt cộng tiền</option>
                <option value="5">Hủy duyệt cộng tiền</option>
                <option value="6">Hoàn tiền TopUp</option>
            </select>
        </div>
    </div>
    <div class="row" style="margin-top:10px; margin-bottom:10px;">
        <div class="col-sm-2" style="float: left; padding-bottom: 5px;">
            <label>Đến ngày:</label>
        </div>
        <div class='input-group date col-sm-3' id='datetimepicker2' style="float: left; padding-bottom: 5px; padding-left: 15px; ">
            <input type='text' placeholder="Đến ngày" class="form-control" id="txtEnd" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <div class="col-sm-2" style="float: left; padding-bottom: 5px; margin-left: 15px">
            <label>Email:</label>
        </div>
        <div class="input-group col-sm-4" style="float: left; padding-left: 15px; padding-bottom: 5px; padding-right: 15px;">
            <input type="text" id="txtfinKey" placeholder="Vui lòng nhập email cần tìm ....." class="ctrlsearch form-control" />
            <span class="input-group-addon btn btn-success" id="btnTimKiem"><i class="fa fa-search"></i> Tìm kiếm</span>
        </div>
    </div>
    <!--Kết thúc chức năng-->

    <div class="row">
        <div class="col-sm-3">
            <label>Tổng số thao tác:&nbsp;&nbsp;&nbsp;</label><label id="lblTongThaoTac" style="color:red"></label>
        </div>
        <div class="col-sm-3">
            <label>Tổng tiền:&nbsp;&nbsp;&nbsp;</label><label id="lbltongTien" style="color:red"></label>
        </div>
    </div>

    <div class="row" style="padding-left:15px; padding-right:15px; margin-bottom:10px; margin-top:10px;">
        <div class="col-sm-12" style="border-bottom:1px solid orange;"></div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table id="tblThaoTacDB" class="display table table-bordered table-responsive dt-responsive datatable" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Người dùng</th>
                        <th>Hành động</th>
                        <th>Số điện thoại - Email</th>
                        <th>Số tiền</th>
                        <th>Ngày tạo</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade bs-example-modal-sm" id="modalChiTietThaoTacDB" role="dialog" style="width: 700px !important; margin:0 auto; margin-top:70px;">
        <div class="modal-dialog modal-sm" style="width:700px !important;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 id="title">Chi tiết lịch sử thao tác</h5>
                    <label hidden id="_txtIdMaThe"></label>
                </div>
                <div class="modal-body" style="padding:10px;">
                    <div class="form-group row">
                        <label for="_txtMaThe" class="col-sm-3 col-form-label">Mô tả:</label>
                        <div class="col-sm-9">
                            <textarea id="txaMoTaChiTiet" style="width:100%; padding:5px;" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<? unset($db_admin_listing);?>
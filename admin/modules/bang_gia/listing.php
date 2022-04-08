<?
require_once("inc_security.php");

	//gọi class DataGird
$queryCat   = "SELECT * FROM `group` WHERE Status = 1 ORDER BY Id DESC " ;//. intval($new_category_id);
$dbCat      = new db_query($queryCat);
$listAllCat='';
while($rowcat = mysql_fetch_assoc($dbCat->result)) {
    $listAllCat[]=$rowcat;
    }
  $queryProvider   = "SELECT * FROM `providers` WHERE Status = 1 ORDER BY Id DESC " ;//. intval($new_category_id);
$dbprovi      = new db_query($queryProvider);
$listAllprovider='';
while($rowpro = mysql_fetch_assoc($dbprovi->result)) {
    $listAllprovider[]=$rowpro;
}  
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
<script src="/js/admin/js/AdminGroupProvider.js?v=1"></script>
<script src="/js/admin/js/admin-Layout.js"></script>
<link href="/js/admin/css/font-awesome.min.css" rel="stylesheet" />
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>
<script>
    $(document).ready(function () {
        
        var quanLyTaiKhoanNguoiDung = new QuanLyTaiBangGia();
        quanLyTaiKhoanNguoiDung.initQuanLyBangGia();
        $("#btnAddGroupP").click(function(){
            AddGroupProvider() ;
        });
        $("#btnSaveP").click(function(){
            Save();
            quanLyTaiKhoanNguoiDung.RefreshTableUser('#tblBangGia');
        })
        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'YYYY-MM-DD'
        });

        $('#datetimepicker2').datetimepicker({
            locale: 'vi',
            format: 'YYYY-MM-DD'
        });
    });
</script>
<style>
    table#tblBangGia th {
        text-align: center;
    }

    #btnTimKiem:hover {
        cursor: pointer;
        background-color: #5cb85c;
        color: white;
    }
    .form-control{padding:0px 12px;}
</style>
<br />
<div style="width:100%;padding-left:10px;padding-right:10px;">
<div class="row tieuDeAdmin" id="tabBanthe24h">
    <a class="tabNoiDungBanthe24h activeTab col-lg-6" data-value="noiDungBanThe24h"><h3>Quản lý tài khoản</h3></a>
</div>
<div id="noiDungBanThe24h">
    <div class="row">
        
        <div class="input-group">
            <div class="col-md-4">
            <input type="text" id="search" class="form-control" placeholder="Search for...">
                </div>
            <div class="col-md-4">
            <select id="providertype" name="providertype" class="form-control">
                <option value="0">Lựa chọn ----</option>
                <option value="1">Topup Mobile</option>
                <option value="2">Mua thẻ điện thoại</option>
                <option value="3">Mua thẻ Game</option>
                <option value="4">Nạp tiền vào TK</option>
            </select>
            </div>
            <div class="col-md-2">
                <span class="input-group-btn">
                    <button type="button" id="btnSearchGroupP" class="btn btn-default">Tìm kiếm!</button>
                </span>
                </div>
            <div class="col-md-2">
                <button type="button" id="btnAddGroupP" class="btn btn-default pull-right">Thêm mới</button>
            </div>
        </div>
        
    </div>
<br />
    <div class="row">
        <div class="col-sm-12">
            <table id="tblBangGia" class="display table table-bordered table-responsive dt-responsive datatable" cellspacing="0" style="width:100%">
               <thead>
                    <tr>
                    <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="width: 50px; text-align: left;">ID </th>
                    <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Đại lý</th>
                    <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Nhà cung cấp</th>
                    <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;"> Loại</th>
                    <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Giá</th>
                    <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Mô tả</th>
                    <th class="gj-grid-bootstrap-thead-cell gj-grid-thead-sortable" style="text-align: left;">Trạng thái</th>
                    <th class="gj-grid-bootstrap-thead-cell" style="width: 34px; text-align: left;">Chức năng</th>
                    </tr>
               </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

</div>
<div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md">
        <div class="panel panel-primary">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="groupModalLabel">Thêm mới giá chiết khấu</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="Id" />
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="typegroupprovider">Loại</label>
                            <select class="form-control" id="typegroupprovider" name="typegroupprovider">
                                  <option value="1">Topup Mobile</option>
                                  <option value="2">Mua thẻ điện thoại</option>
                                  <option value="3">Mua thẻ Game</option>
                                  <option value="4">Gạch thẻ</option>
                                  <option value="5">Nạp tiền vào TK</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="groupDescription">Mổ tả</label>
                            <input type="text" class="form-control" id="groupDescription" placeholder="Mổ tả">
                        </div>
                        <div class="form-group">
                            <label for="grouplistgroup">Chọn đại lý</label>
                            <div>
                            <select class="form-control" id="grouplistgroup" name="grouplistgroup">
                                <option value=""><?="Chọn Nhóm"?></option>
                    			<?
                                foreach($listAllCat as $i=>$cat){
                                    ?>
                                        <option value="<?=$cat["Id"]?>" >
                                        <?
                                        
                                        echo $cat["Name"];
                                        ?>
                                        </option>
                                    <?
                                }?>
                            </select>
                           
                            </div>
                        </div>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="groupPrice">Giá</label>
                            <input type="number" class="form-control" id="groupPrice" >
                        </div>
                        <div class="form-group">
                            <label for="groupStatus">Trạng thái</label>
                            <select class="form-control" id="groupStatus" style="width: 100%">            
                                <option value="0">Không kích hoạt</option>
                                <option value="1">Kích hoạt</option> 
                            </select>
    
                        </div>
                        <div class="form-group">
                            <label for="groupprovider">Nhà mạng</label>
                            <div>
                                <select class="form-control" id="groupprovider" name="groupprovider"><option value="">Please select</option>
    <?
                                foreach($listAllprovider as $i=>$cat){
                                    ?>
                                        <option value="<?=$cat["Id"]?>" >
                                        <?
                                        
                                        echo $cat["ProviderCode"];
                                        ?>
                                        </option>
                                    <?
                                }?>
    </select>
                            </div>
                        </div>
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
                    
                    
                    
                    
                    
                    
                    
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btnSaveP" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<? /*---------Body------------*/ ?>
</body>
</html>
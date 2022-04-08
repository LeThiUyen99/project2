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
<script src="/js/admin/js/admin-quan-ly-cong-tien-cho-khach.js?v=7"></script>
<!---Css Quản lý giao dịch-->

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<style>
    table tr th {
        text-align: center;
    }

    a._congTienKhachHang {
        text-decoration: none;
        padding-top: 3px;
        padding-bottom: 3px;
    }

        a._congTienKhachHang:hover {
            text-decoration: none;
            padding-top: 3px;
            padding-bottom: 3px;
        }

    #khachHang {
        margin-bottom: 15px !important;
    }

    #chiTietKhachHang {
        width: 100%;
        border: 1px solid #CCCCCC;
    }
</style>
<script>
    $(document).ready(function () {
        var congTienKhachHang = new CongTienKhachHang();
        congTienKhachHang.initCongTienKhachHang();
    });
</script>
<div class="">  
    <br />
   <div class="row tieuDeAdmin">
        <div class="col-sm-12">
            <h3>Quản lý cộng tiền khách hàng</h3>
        </div>
    </div>
    <!--Chức năng-->
     <div class="row" style="margin-bottom:5px; margin-top:5px; margin-left:-15px; margin-right:-15px; padding-top:5px; padding-bottom:5px">
        <div class="col-sm-5" style="text-align:right; padding-top:2px;">
            <div class="input-group" style="width: 100%; text-align: right">
                <input type="text" id="txtfinKey" placeholder="Vui lòng nhập email, số điện thoại cần tìm ....." class="ctrlsearch form-control" />
                <span class="input-group-addon btn btn-success" id="btnTimKiem"><i class="fa fa-search"></i> Tìm kiếm</span>
            </div>
        </div>
    </div>
    <!--Kết thúc chức năng-->
<div class="row" style="padding-left:15px; padding-right:15px; margin-bottom:10px">
        <div class="col-sm-12" style="border-bottom:1px solid orange;"></div>
    </div>

    <div class="row" id="khachHang" style="padding-right:15px !important" hidden>
        <div class="col-sm-12" id="tbl_DanhSachKH" style="padding-right: 0px !important">
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bs-example-modal-sm" id="modalCongTienTK" role="dialog" style="width: 1000px !important; margin:0 auto; margin-top:50px;">
        <div class="modal-dialog modal-sm" style="width:900px !important;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 id="title">Cộng tiền khách hàng banthe24h</h5>
                </div>
                <div class="modal-body" style="padding:10px; min-height:470px;">
                    <div style="width:100%; font-weight:bold; text-align:center; font-size:16px; color:orange; margin-bottom:10px;" class="cls">
                        <div style="float:left; width:50%"> Cộng tiền</div>
                        <div>Danh sách 10 lệnh gần nhất</div>
                    </div>
                    <div>
                        <div style="float:left; width:45%">
                            <table id="chiTietKhachHang" class="table table-striped table-bordered" style="width:auto; margin-left:5px;">
                                <tr>
                                    <td class="col-sm-3">Họ và tên:</td>
                                    <td>
                                        <label id="lblHoTenKH"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>
                                        <label id="lblTenDangNhap"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại:</td>
                                    <td>
                                        <label id="lblSoDienThoai"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ngân hàng:</td>
                                    <td>
                                        <select class="form-control" id="optNganHang"></select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Số tiền:</td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Vui lòng nhập số tiền" id="txtSoTien" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nội dung:</td>
                                    <td>
                                        <textarea class="form-control" id="txaNoiDung" style="width:100%" rows="5" placeholder="Nội dung"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:center">
                                        <button id="btnCongTienKhachHang" class="btn btn-success"><i class="fa fa-plus"></i> Cộng tiền khách hàng bán thẻ 24h</button>
                                        <label id="lblUserIdKhachHang" hidden></label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div style="float:left; width:55%" id="tbl_DanhSachLenh">
                        </div>
                    </div>
                    <div class="cls"></div>
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
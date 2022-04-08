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
<link href="/js/admin/css/plugins/gritter/jquery.gritter.css" rel="stylesheet"/>
<script src="/js/admin/js/plugins/gritter/jquery.gritter.js"></script>
<script src="/js/admin/js/plugins/bootbox/bootbox.min.js"></script>
<script src="/js/Busy.js"></script>
<!--Lịch-->
<script src="/Assets/js/moment.js"></script>
<script src="/Assets/js/bootstrap-datetimepicker.js"></script>
<link href="/Assets/css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="/Assets/js/localDatetime.js"></script>
<script src="/js/admin/js/admin-quan-ly-chuyen-tien.js?v=5"></script>
<!---Css Quản lý giao dịch-->

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">

<script>
    $(document).ready(function () {
        var _chuyenTien = new QuanLyDoiChuyenTien();
        _chuyenTien.initDoiChuyenTien();
    });
</script>
<div class="">  
    <br />
   <div class="row tieuDeAdmin">
        <div class="col-sm-12">
            <h3>Hệ thống quản lý chuyển tiền</h3>
        </div>
    </div>
    <!--Chức năng-->
    <div class="row">
        <div class="col-lg-2" style="float: left; padding-bottom:5px;">
            <label style="margin-top:6px;">Trạng thái:</label>
        </div>
        <div style="float: left; padding-bottom: 5px;" class="col-lg-3">
            <select class="form-control" id="optTrangThai">
                <option value="0" selected="selected">Vui lòng chọn trạng thái</option>
                <option value="2">Chưa xử lý</option>
                <option value="3">Đang xử lý</option>
                <option value="1">Đã chuyển</option>
            </select>
        </div>
        <div class="col-lg-2" style="float: left; padding-bottom: 5px;">
            <label style="margin-top:6px;">Bắt đầu:</label>
        </div>
        <div class='input-group date col-lg-3' id='datetimepicker1' style="float: left; padding-bottom: 5px; padding-left: 15px; padding-right:15px;">
            <input type='text' placeholder="Thời gian bắt đầu..." class="form-control" id="txtTuNgay" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col-lg-2" style="float: left; padding-bottom: 5px;">
            <label style="margin-top:6px;">Ngân hàng:</label>
        </div>
        <div style="float: left; padding-bottom: 5px;" class="col-lg-3">
            <select class="form-control" id="optNganHang"></select>
        </div>
        <div class="col-lg-2" style="float: left; padding-bottom: 5px;">
            <label style="margin-top:6px;">Kết thúc:</label>
        </div>
        <div class='input-group date col-lg-3' id='datetimepicker2' style="float: left; padding-bottom: 5px; padding-left: 15px; padding-right:15px;">
            <input type='text' placeholder="Thời gian kết thúc..." class="form-control" id="txtDenNgay" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col-lg-2" style="float: left; padding-bottom: 5px;">
            <label style="margin-top:6px;">Người chuyển tiền:</label>
        </div>
        <div style="float: left; padding-bottom: 5px;" class="col-lg-3">
            <select class="form-control" id="optNguoiChuyenTien"></select>
        </div>
        <div class="col-lg-2" style="float: left; padding-bottom:5px;">
            <label style="margin-top:6px;">Lọc tiền chuyển:</label>
        </div>
        <div style="float: left; padding-bottom: 5px;" class="col-lg-3">
            <select class="form-control" id="optsotien">
                <option value="0" selected="selected">Giới hạn tiền</option>
                <option value="500000">Dưới 500k</option>
                <option value="1000000">Dưới 1tr</option>
                <option value="5000000">Dưới 5tr</option>
            </select>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        
        <div class="col-lg-5" style="float: left; padding-left: 15px; padding-bottom: 5px">
            <input type="text" id="txtFindKey" placeholder="Nhập từ khóa cần tìm ( Email, Số điện thoại,)....." class="form-control" />
        </div>
        <div class="col-lg-2" style="float: left; padding-left: 15px; padding-bottom: 5px">
            <button id="btnTimKiem" class="btn btn-success"><i class="fa fa-search"></i>&nbsp; &nbsp;&nbsp;Tìm kiếm&nbsp;&nbsp;&nbsp;</button>
        </div>
        <div class="col-lg-2">
            
        </div>
    </div>
    <div class="row" style="border: 1px solid #cccccc; margin-left: 0px; margin-right: 0px; margin-top: 20px; margin-bottom: 20px; padding-left: 10px; padding-right: 10px; background-color: #eee">
        <div class="row" style="margin:0px; margin-top:10px; border-bottom: 1px solid #cccccc">
            <div class="col-lg-2" style="margin-left:-15px">
                <label>Tổng lệnh: </label>
            </div>
            <div class="col-lg-2" style="margin-left:-15px">
                <label id="lblTongLenh" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            </div>
            <div class="col-lg-2" style="margin-left:-15px">
                <label>Đã chuyển: </label>
            </div>
            <div class="col-lg-2" style="margin-left:-15px">
                <label id="lblTongLenhDaChuyen" style="color: white; background-color: #f0ad4e; padding: 3px 7px 3px 7px; border-radius: 3px;"></label>
            </div>
            <div class="col-lg-2" style="margin-left:-15px">
                <label>Chưa chuyển: </label>
            </div>
            <div class="col-lg-2" style="margin-left:-15px">
                <label id="lblTongLenhChuaChuyen" style="color: white; background-color: #d9534f; padding: 3px 7px 3px 7px; border-radius: 3px;"></label>
            </div>
        </div>
        <div class="row" style="margin:0px; margin-top:10px;">
            <div class="col-lg-2" style="margin-left:-15px">
                <label>Tổng tiền:</label>
            </div>
            <div class="col-lg-2" style="margin-left:-15px">
                <label id="totalMoney" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            </div>
            <div class="col-lg-2" style="margin-left:-15px">
                <label>Đã chuyển: </label>
            </div>
            <div class="col-lg-2" style="margin-left:-15px">
                <label id="cashMoney" style="color: white; background-color: #f0ad4e; padding: 3px 7px 3px 7px; border-radius: 3px;"></label>
            </div>
            <div class="col-lg-2" style="margin-left:-15px">
                <label>Chưa chuyển: </label>
            </div>
            <div class="col-lg-2" style="margin-left:-15px">
                <label id="cashOutMoney" style="color: white; background-color: #d9534f; padding: 3px 7px 3px 7px; border-radius: 3px;"></label>
            </div>
        </div>
    </div>
    <div class="row" style="margin:0px; margin-top:10px; margin-bottom:20px;">
        <div class="col-lg-12" style="margin-left:-15px; margin-right:-15px;">
            <button class="btn btn-primary btn-sm" id="btnNhanNhieuLenh">
                <i class='fa fa-bell-slash'></i>&nbsp;&nbsp;Nhận nhiều lệnh
            </button>
            <button class="btn btn-warning btn-sm" id="btnHoanTatNhieuLenh" style="margin-left:30px;">
                <i class='fa fa-spinner'></i>&nbsp;&nbsp;Hoàn tất nhiều lệnh
            </button>
            <button class="btn btn-success btn-sm" id="btnChuyenLenh" style="margin-left:30px;">
                <i class='fa fa-random'></i>&nbsp;&nbsp;Chuyển người nhận lệnh
            </button>
             <button class="btn btn-danger btn-sm" id="btnCancelCashout" style="margin-left:30px;">
                <i class='fa fa-random'></i>&nbsp;&nbsp;HỦY RÚT TIỀN
            </button>
        </div>
    </div>
    <!--Kết thúc chức năng-->

    <div class="row">
        <div class="col-lg-12">
            <table id="tblDoiChuyenTien" class="display table table-bordered table-responsive dt-responsive datatable" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th width="10px"><input type="checkbox" id="luaChonNhieuLenh" name="luaChonNhieuLenh" /></th>
                        <th>STT</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Họ tên</th>
                        <th>Số tài khoản</th>
                        <th>Ngân hàng</th>
                        <th>Chi nhánh</th>
                        <th>Số tiền</th>
                        <th>Phí ngân hàng</th>
                        <th>Ngày tạo lệnh</th>
                        <th>Thời gian duyệt</th>
                        <th>Trạng thái</th>
                        <th>Người xử lý</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Modal chuyển lệnh-->
    <div class="modal fade bs-example-modal-md" id="modalChuyenLenh" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 id="title">Chuyển người nhận lệnh</h5>
                </div>
                <div class="modal-body" style="padding:10px;">
                    <div style="font-weight:bold; color:red; margin-top:10px; margin-bottom:10px;" id="thongBaoChuyenNguoiNhanLenh"></div>
                    <table class="table table-bordered">
                        <tr>
                            <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Số thứ tự:</td>
                            <td class="col-lg-4">
                                <input class="form-control" tabindex="1" autofocus placeholder="Vui lòng nhập số thứ tự lệnh cần chuyển" type="text" id="txtMaLenh">
                            </td>
                        </tr>
                    </table>
                    <div class="row chucNang">
                        <div class="col-lg-12" style="margin-left:-5px;">
                            <button class="btn btn-success" id="btnXacNhanChuyenLenh">
                                <i class='fa fa-random' tabindex='6'></i> Chuyển người nhận lệnh
                            </button>
                            <button data-dismiss="modal" class="btn btn-danger">
                                <i class="glyphicon glyphicon-remove"></i> Hủy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chuyển lệnh-->
    <div class="modal fade bs-example-modal-lg" id="modalDetailCashOut" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 id="title">So sánh 2 lệnh rút tiền gần nhất</h5>
                </div>
                <div class="modal-body" style="padding:10px;">
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table table-bordered" id="recordOld">
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Số thứ tự:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtMaLenhCu">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Thời gian:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtThoiGianCu">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Email:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtEmailCu">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Số điện thoại:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtSoDienThoaiCu">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Họ tên:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtHoTenCu">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Số tài khoản:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtSoTKCu">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Ngân hàng:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtNganHangCu">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Chi nhánh:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" disabled type="text" id="txtChiNhanhCu">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Số tiền:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" disabled type="text" id="txtSoTienCu">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-bordered" id="recordNew">
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Số thứ tự:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtMaLenhMoi">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Thời gian:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtThoiGianMoi">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Email:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtEmailMoi">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Số điện thoại:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtSoDienThoaiMoi">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Họ tên:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtHoTenMoi">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Số tài khoản:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtSoTKMoi">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Ngân hàng:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtNganHangMoi">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Chi nhánh:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" type="text" disabled id="txtChiNhanhMoi">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-2" style="vertical-align:middle; font-weight:bold">Số tiền:</td>
                                    <td class="col-lg-4">
                                        <input class="form-control" disabled type="text" id="txtSoTienMoi">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row" style="color:red">
                        <div class="col-lg-12">
                            * Vui lòng gọi điện cho thông tin tài khoản cũ để xác minh trạng thái thay đổi thông tin tài khoản ngân hàng nhận tiền.
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
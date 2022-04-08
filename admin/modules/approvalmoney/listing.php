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
<script src="/js/admin/js/admin-quan-ly-cong-tien-admin.js?v=3"></script>
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
            var quanLyDuyetCongTien = new QuanLyDuyetCongTienAdmin();
            quanLyDuyetCongTien.initQuanLyDuyetCongTienAdmin();
        });
    </script>
<div class="">  
    <br />
   <div class="row tieuDeAdmin">
        <div class="col-sm-12">
            <h3>Quản lý duyệt cộng tiền</h3>
        </div>
    </div>
    <!--Chức năng-->
     
    <!--Kết thúc chức năng-->


    <!-- Modal -->
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
                    <option value="0">Chưa duyệt</option>
                    <option value="1">Đã duyệt</option>
                    <option value="2">Đã hủy</option>
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
                <label style="margin-top:6px;">Ngân hàng:</label>
            </div>
            <div class="col-sm-3" style="float: left; padding-left: 0px; padding-bottom: 5px; margin-left:15px; padding-right:30px; margin-right:0px;">
                <select class="form-control" id="optNganHang"></select>
            </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="input-group col-sm-6" style="float: left; padding-left: 0px; padding-bottom: 5px; margin-left:15px; padding-right:23px; margin-right:0px;">
                <input type="text" id="txtfinKey" placeholder="Vui lòng nhập email, số điện thoại, số tiền, nội dung, cần tìm ....." class="form-control" />
                <span class="input-group-addon" id="btnTimKiem"><i class="fa fa-search"></i> Tìm kiếm</span>
            </div>
        </div>
        <div class="row" style="margin:0px; margin-top:10px;">
            <div class="col-sm-3" style="margin-left:-15px;">
                <label>Tổng tiền:</label> <label id="tongTien" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            </div>
            <div class="col-sm-3" style="margin-left:-15px;">
                <label>Đã duyệt:</label> <label id="tienDaDuyet" style="color: white; background-color: #5cb85c; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            </div>
            <div class="col-sm-3" style="margin-left:-15px;">
                <label>Chưa duyệt:</label> <label id="tienChuaDuyet" style="color: white; background-color: #f0ad4e; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            </div>
            <div class="col-sm-3" style="margin-left:-15px;">
                <label>Đã hủy:</label> <label id="tienDaHuy" style="color: white; background-color: #d9534f; padding: 3px 7px 3px 7px; border-radius: 3px; "></label>
            </div>
        </div>

        <div class="row" style="padding-left:15px; padding-right:15px; margin-bottom:10px">
            <div class="col-sm-12" style="border-bottom:1px solid orange;"></div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table id="tblQuanLyLenh" class="display table table-bordered table-responsive dt-responsive datatable" cellspacing="0" style="width:100%">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Ngân hàng</th>
                            <th>Số tiền</th>
                            <th>Nội dung</th>
                            <th>Thời gian tạo</th>
                            <th>Người tạo lệnh</th>
                            <th>Thời gian duyệt</th>
                            <th>Người duyệt</th>
                            <th style="text-align:center">Trạng thái</th>
                            <th style="width:120px; text-align:center">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade bs-example-modal-lg" id="modalXacNhanCongTienTK" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 id="title">Xác nhận cộng tiền khách hàng banthe24h</h5>
                    </div>
                    <div class="modal-body" style="padding:10px">
                        <table id="chiTietKhachHang" class="table table-striped table-bordered" style="vertical-align:middle">
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
                                    <input type="text" class="form-control" placeholder="Vui lòng nhập số tiền" id="txtNganHang" />
                                </td>
                            </tr>
                            <tr>
                                <td>Số tiền:</td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Vui lòng nhập số tiền" id="txtSoTien" />
                                </td>
                            </tr>
                            <tr>
                                <td>Thời gian:</td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Vui lòng nhập số tiền" id="txtThoiGian" />
                                </td>
                            </tr>
                            <tr>
                                <td>Nội dung:</td>
                                <td>
                                    <textarea class="form-control" id="txaNoiDung" style="width:100%" rows="4" placeholder="Nội dung"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Tk cộng tiền:</td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Vui lòng nhập số tiền" id="txtTkCongTien" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center">
                                    <button id="btnXacNhanCongTienKhachHang" class="btn btn-warning"><i class="fa fa-plus"></i> Xác nhận cộng tiền khách hàng bán thẻ 24h</button>
                                    <label id="lblCongTienId" hidden></label>
                                </td>
                            </tr>
                        </table>
                        <div class="cls"></div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade bs-example-modal-md" id="modalXacNhanHuyCongTienTK" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 id="title">Xác nhận hủy cộng tiền khách hàng banthe24h</h5>
                    </div>
                    <div class="modal-body">
                        <table id="chiTietKhachHang" class="table table-striped table-bordered" style="width:100%; margin-left:5px; margin-right:5px;">
                            <tr>
                                <td class="col-sm-3">Email:</td>
                                <td>
                                    <input type="text" id="txtEmailHuyCongTien" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-3">Số tiền:</td>
                                <td>
                                    <input type="text" id="txtSoTienHuyCongTien" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-3">Số điện thoại:</td>
                                <td>
                                    <input type="text" id="txtSoDienThoaiHuyCongTien" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>Ngân hàng:</td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Vui lòng nhập số tiền" id="txtHuyNganHang" />
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-3">Thời gian:</td>
                                <td>
                                    <input type="text" id="txtThoiGianHuyCongTien" class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>Tk cộng tiền:</td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Vui lòng nhập số tiền" id="txtHuyTkCongTien" />
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-3">Nội dung:</td>
                                <td>
                                    <textarea id="txaHuyNoiDungCongTien" class="form-control" style="width:100%" rows="5" placeholder="Vui lòng nhập nội dung hủy cộng tiền"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center">
                                    <button id="btnXacNhanHuyCongTienKhachHang" class="btn btn-success"><i class="fa fa-plus"></i> Xác nhận hủy cộng tiền khách hàng bán thẻ 24h</button>
                                    <label id="lblHuyCongTienId" hidden></label>
                                </td>
                            </tr>
                        </table>
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

<div class="section-title bg-lable2">
    <h3 class="h3naptiendienthoai">Nạp tiền điện thoại</h3>
    <div class="form-content bg2 main_content">
        <form name="buycard" action="#" method="post">
            <div class="midletopup">
            <div class="form-sl">
                <input type="text" maxlength="14" id="ctrlSoDienThoai" name="ctrlSoDienThoai" value="" autocomplete="off" placeholder="Số điện thoại" title="Số điện thoại" />
            </div>
                <!--<div class="form-sl">
                    <div style="height:45px;margin-bottom:15px;width:100%">
                        <div class="topuppercen" style="display: none;">
                            <div id="vcb" style="display: none;" class="topuppc topuppcVTT">
                                <div class="box_price"><div class="img_pc"><img src="/Images/icon_vt.png" alt="Nạp tiền vào ví qua thẻ VIETTEL"></div><p class="nhamang">VTEL</p><p class="chietkhau">17.75%</p></div>
                            </div>
                            <div id="tcb" style="display: none;" class="topuppc topuppcVMS">
                                <div class="box_price"><div class="img_pc"><img src="/Images/icon_mobi.png" alt="Nạp tiền vào ví qua thẻ MOBIPHONE" data-pin-nopin="true"></div><p class="nhamang">MOBI</p><p class="chietkhau">17.5%</p></div>
                            </div>
                            <div id="vtb" style="display: none;" class="topuppc topuppcVNP">
                                <div class="box_price"><div class="img_pc"><img src="/Images/icon_vina.png" alt="Nạp tiền vào ví qua thẻ VINAPHONE" data-pin-nopin="true"></div><p class="nhamang">VINA</p><p class="chietkhau">17.5%</p></div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="form-sl">                
                <div class="boxdrpmega">                    
                    <table rel="" width="100%">
                        <tr id="table_topupAmount">
                            <select id="topupAmount" style="width:100%;">
                                <option value="0">Mệnh giá thẻ nạp</option>
                            </select>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="form-sl">
                <div style="float:right;width:100%;">
                    <div class="boxdrpmega">
                        <input class="txt nochange blur form-control" placeholder="Chọn nhà cung cấp" size="22" maxlength="40"
                               id="NapGameCardType" value="" name="NapGameCardType" type="text" title="" readonly>
                        <span class="dropDownListArrow down"></span>
                        <div style="text-transform: none !important; display: none;" class="dropDownList">
                            <table rel="" style="" width="100%">
                                <tbody>
                                    <tr>
                                        <td colspan="10" class="last">
                                            <h3>
                                                Chọn loại thuê bao
                                            </h3>
                                            <span class="separator"></span>
                                        </td>
                                    </tr>
                                    <tr id="trnapgame_cardtype"><td><p><input id="NapGameCardType_1" name="NapGameCardTypeSelect" rel="NapGameCardType" value="TT" txt="Trả trước" type="radio" class="left">&nbsp;<label class="left mL5" for="NapGameCardType">Thuê bao trả trước</label><span class="separator"></span></p><p><input id="NapGameCardType_2" name="NapGameCardTypeSelect" rel="NapGameCardType" value="TS" txt="Thuê bao trả sau" type="radio" class="left">&nbsp;<label class="left mL5" for="NapGameCardType">Thuê bao trả sau</label><span class="separator"></span></p></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>  
                <div class="form-sl">
                    <input type="password" autocomplete="off" id="topupghichumuathe" value="" name="topupghichumuathe" placeholder="Mật khẩu cấp 2" />
                </div> 
            <div class="form-sl">                
                <input type="email" autocomplete="off" id="ctrlnapdienthoaiemailaddress" name="ctrlnapdienthoaiemailaddress" value="" placeholder="Địa chỉ email kiểm tra giao dịch" title="" />
            </div>
<div class="form-sl">
                    <div class="boxdrpmega">
                        <input class="txt nochange blur form-control" placeholder="Phương thức thanh toán" size="22" maxlength="40"
                               id="topupPaymentMethod" value="" name="topupPaymentMethod" type="text" title="">
                        <span class="dropDownListArrow down"></span>
                        <div style="display: none; text-transform: none !important" class="dropDownList">
                            <table>
                                <tbody>
                                    <tr align="left">
                                        <td colspan="4" class="last">
                                            <h5 class="fz14 fb700 cl333" style="text-transform: none">
                                                Thanh toán bằng tài khoản thành viên
                                            </h5>
                                            <span class="separator"></span>
                                        </td>
                                    </tr>
                                    <tr align="left">
                                        <td colspan="4" style="vertical-align:middle;height:40px;" class="last">
                                            <ul>
                                                <li>
                                                    <input txt="PayCard" rel="topupPaymentMethod" value="Paycard" id="topupPaymentMethodSelect_member" name="topupPaymentMethod" type="radio">
                                                    <label for="topupPaymentMethodSelect_member"><img src="/images/paycardvi.png" title="Nạp tiền điện thoại" alt="Nạp tiền điện thoại"></label>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr align="left">
                                        <td colspan="4" class="last">
                                            <h5 class="fz14 fb700 cl333" style="text-transform: none">
                                                Lựa chọn ngân hàng (có đăng ký Internet banking hoặc DV Thanh toán trực tuyến)
                                            </h5>
                                            <span class="separator"></span>
                                        </td>
                                    </tr>
                                    <tr>
                            <td class="last">
                                <ul>
                                    <li>
                                        <input txt="VietcomBank" rel="topupPaymentMethod" value="Vietcombank" id="topupPaymentMethodSelect_vcb" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethodSelect_vcb"><img src="/images/vcb.png" alt="VietcomBank" title="VietcomBank"></label>
                                    </li>
                                    <li>
                                        <input txt="Vietinbank" rel="topupPaymentMethod" value="Vietinbank" id="topupPaymentMethod_ViettinBank" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_ViettinBank"><img src="/images/vtb.png" alt="Vietinbank" title="Vietinbank"></label>
                                    </li>
                                    <li>
                                        <input txt="Đông Á Bank" rel="topupPaymentMethod" value="DongABank" id="topupPaymentMethod_DongABank" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_DongABank"><img src="/images/DongA.gif" alt="Đông Á Bank" title="Đông Á Bank"></label>
                                    </li>
                                    <li>
                                        <input txt="MB Bank" rel="topupPaymentMethod" value="MB" id="topupPaymentMethod_MBBANK" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_MBBANK"><img src="/images/mb.png" alt="MB Bank" title=" mb bank"></label>
                                    </li>
                                    <li>
                                        <input txt="EximBank" rel="topupPaymentMethod" value="Eximbank" id="topupPaymentMethod_EXIMBANK" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_EXIMBANK"><img src="/images/exb.png" alt="EXIMBANK" title="EXIMBANK"></label>
                                    </li>
                                </ul>
                            </td>
                            <td class="last">
                                <ul>
                                    <li>
                                        <input txt="Sacombank" rel="topupPaymentMethod" value="Sacombank" id="topupPaymentMethod_Sacombank" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_Sacombank"><img src="/images/scb.png" alt="Sacombank" title="Sacombank"></label>
                                    </li>
                                    <li>
                                        <input txt="BIDV" rel="topupPaymentMethod" value="BIDV" id="topupPaymentMethod_bidv" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_bidv"><img src="/images/bidv.jpg" alt="BIDV" title="BIDV"></label>
                                    </li>
                                    <li>
                                        <input txt="Maritimebank" rel="topupPaymentMethod" value="MSBank" id="topupPaymentMethod_mrt" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_mrt"><img src="/images/maritime.jpg" alt="Maritimebank" title="Maritimebank"></label>
                                    </li>
                                    <li>
                                        <input txt="ACB Bank" rel="topupPaymentMethod" value="ACB" id="topupPaymentMethod_ACB" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_ACB"><img src="/images/acb.png" alt="ACB Bank" title="ACB Bank"></label>
                                    </li>
                                    <li>
                                        <input txt="VPBANK" rel="topupPaymentMethod" value="VPBank" id="topupPaymentMethod_VPBANK" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_VPBANK"><img src="/images/vpb.jpg" alt="VPBANK" title="VPBANK"></label>
                                    </li>
                                </ul>
                            </td>
                            <td class="last">
                                <ul>
                                    <li>
                                        <input txt="Ocean Bank" rel="topupPaymentMethod" value="Oceanbank" id="topupPaymentMethod_Ojb" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_Ojb"><img src="/images/ocean.png" alt="Ocean Bank" title="Ocean Bank"></label>
                                    </li>
                                    <li>
                                        <input txt="Techcombank" rel="topupPaymentMethod" value="Techcombank" id="topupPaymentMethod_tcb" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_tcb"><img src="/images/tcb.png" alt="Techcombank" title="Techcombank"></label>
                                    </li>
                                    <li>
                                        <input txt="Nam Á Bank" rel="topupPaymentMethod" value="NamABank" id="topupPaymentMethod_nab" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_nab"><img src="/images/NamABank.jpg" alt="Nam Á Bank" title="Nam Á Bank"></label>
                                    </li>
                                    <li>
                                        <input txt="Phương Đông Bank" rel="topupPaymentMethod" value="OCB" id="topupPaymentMethod_OCB" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_OCB"><img src="/images/ocb.png" alt="Phương Đông Bank" title="Phương Đông Bank"></label>
                                    </li>
                                    <li>
                                        <input txt="AGRIBANK" rel="topupPaymentMethod" value="Agribank" id="topupPaymentMethod_AGRIBANK" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_AGRIBANK"><img src="/images/agribank.jpg" alt="AGRIBANK" title="AGRIBANK"></label>
                                    </li>
                                </ul>
                            </td>
                            <td class="last">
                                <ul>
                                    <li>
                                        <input txt="HD Bank" rel="topupPaymentMethod" value="HDBank" id="topupPaymentMethod_HDBank" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_HDBank"><img src="/images/hdb.png" alt="HD Bank" title="HD Bank"></label>
                                    </li>
                                    <li>
                                        <input txt="Master" rel="topupPaymentMethod" value="Master" id="topupPaymentMethod_Master" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_Master"><img src="/images/mastercard.gif" alt="Master" title="Master"></label>
                                    </li>
                                    <li>
                                        <input txt="TienPhongBank" rel="topupPaymentMethod" value="TienPhongBank" id="topupPaymentMethod_tpb" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_tpb"><img src="/images/tpb.jpg" alt="TienPhongBank" title="TienPhongBank"></label>
                                    </li>
                                    <li>
                                        <input txt="Quốc Dân Bank" rel="topupPaymentMethod" value="NCB" id="topupPaymentMethod_NCB" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_NCB"><img src="/images/ncb.jpg" alt="Quốc Dân Bank" title="Quốc Dân Bank"></label>
                                    </li>
                                    <li>
                                        <input txt="Visa" rel="topupPaymentMethod" value="Visa" id="topupPaymentMethod_VISA" name="topupPaymentMethod" type="radio">
                                        <label for="topupPaymentMethod_VISA"><img src="/images/visacard.gif" alt="Visa" title="Visa"></label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="form-sl  divmuathe">
                    <button type="button" id="ctrltopupmobilebtn">Nạp tiền ngay</button>
                </div>
                <div class="info-napthe">

                        <span>* Bạn vui lòng đăng nhập để sử dụng dịch vụ</span>
    <a class="dangkytopup">Đăng ký ngay!</a>


                </div>
               
            </div>
        </form>
    </div>
</div>
<!--popup work start here-->
<!--Preview confirm nap tien dien thoai Start-->
<div class="modal fade" id="naptiendienthoaipreviewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông tin giao dịch</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="panel-body">
                    <div class="row form-horizontal">
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4">Số điện thoại:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lblphone"></label>
                            </div>
                        </div>
                       
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4">Mệnh giá:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lblmenhgia"></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label col-sm-4">Địa chỉ Email kiểm tra GD:</label>
                            <div class="col-sm-7">
                                <label class="txtcon" id="lbltopupemail"></label>
                            </div>
                        </div>
                         
                    </div>
                    <div class="row" id="Topup_Confirm_OrderDetail">
                        <div class="form-group col-sm-12">
                            <label class="col-sm-offset-4 col-sm-8"><h5>Vui lòng nhập thông tin tài khoản của bạn</h5></label>
                        </div>
                        <div class="col-sm-12">
                            <div class="alert alert-danger" id="divnotifynt">
                                <i class="fa fa-info-circle fa-lg"></i>
                                <span></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-4" for="ctrlemailtxt_log">Địa chỉ Email:<span class="asterisk_input"></span></label>
                            <div class="col-sm-7">
                                <input type="email" id="topup_ctrlemailtxt_log" name="topup_ctrlemailtxt_log" class="form-control" placeholder="Địa chỉ Email" value="">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-4" for="topup_ctrlpasstxt_log">Mật khẩu:<span class="asterisk_input"></span></label>
                            <div class="col-sm-7">
                                <input type="password" id="topup_ctrlpasstxt_log" name="topup_ctrlpasstxt_log" class="form-control" placeholder="Mật khẩu" value="">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="col-sm-offset-4 col-sm-7">
                                <a class="pull-right" href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotyourpassword"><i>Quên mật khẩu</i></a>
                                <span class="pull-right">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                <a class="pull-right" href="/User/register"><i>Đăng ký</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-primary" id="ctrtopupthanhtoanbtn_desktop" tabindex="1"><i class="fa fa-sign-in"></i> Thanh toán ngay</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="2"><i class="fa fa-times"></i>Hủy giao dịch</button>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Preview confirm nap tien dien thoai End-->
<!--Show result nap tien dien thoai Start-->
<div class="modal fade" id="naptiendienthoairesultmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông báo giao dịch nạp thẻ điện thoại</h4>
            </div>
            <form class="form-horizontal" role="form">
                <div class="panel-body">
                    <div class="">
                        <div id="notifyresult" class="alertx">
                            <i class="fa sign"></i><strong></strong><span></span>
                        </div>
                        <div class="divresult">
                            <table id="tblcardinfo" class="no-border">
                                <thead class="no-border">
                                    <tr>
                                        <th class="text-center">Loại thẻ</th>
                                        <th class="text-center">Mệnh giá</th>
                                        <th class="text-center">Mã số thẻ</th>
                                        <th class="text-center">Số serial thẻ</th>
                                    </tr>
                                </thead>
                                <tbody class="no-border-y"></tbody>
                            </table>
                            <div style="padding-top: 20px;"><span>Thời gian giao dịch: <span class="datetransaction"></span></span></div>
                        </div>

                    </div>

                    <div class="modalbottom">
                        <button type="button" class="btn btn-primary" id="ctrcontinuebtn" data-dismiss="modal" tabindex="1"><i class="fa fa-sign-in"></i> Tiếp tục mua</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Preview confirm nap tien dien thoai End-->

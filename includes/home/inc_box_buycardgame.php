    <div class="section-title bg-lable1">
        <h3 class="h3muamathe">Mua thẻ Game, virus, 3g/4g Mobi</h3>
</div>
    <!--right section work start-->
    <br />
    <div class="form-content bg1 main_content">
        <form name="buycardgame" action="#" method="post">
            <div class="middlebuycard">
                <div class="middlebuycard_l">
                    <div class="form-sl">
                        <div class="boxdrpmega">
                            <input class="txt nochange blur form-control" placeholder="Chọn nhà cung cấp" size="22" maxlength="40"
                                   id="buyCardGameProvider" value="" name="buyCardGameProvider" type="text" title="" readonly>
                            <span class="dropDownListArrow down"></span>
                            <div style="display: none; text-transform: none !important" class="dropDownList">
                                <table rel="" style="" width="100%">
                                    <tr>
                                        <td colspan="10" class="last">
                                            <h3>
                                                Chọn nhà cung cấp
                                            </h3>
                                            <span class="separator"></span>
                                        </td>
                                    </tr>
                                    <tr id="trgameprovider"></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-sl">
                        <div class="boxdrpmega">
                            <input class="txt nochange blur form-control" placeholder="Mệnh giá thẻ nạp" size="22" maxlength="40" id="buyCardGameAmount" val="" name="buyCardGameAmount" type="text" readonly>
                            <span class="dropDownListArrow down"></span>
                            <div style="display: none; text-transform: none !important" class="dropDownList" id="game_CardAmount">

                            </div>
                        </div>
                    </div>
                    <div class="form-sl">
                        <input autocomplete="off" type="text" maxlength="40" id="ctrlsoluongthegame" name="ctrlsoluongthegame" value="" class="form-control txt" placeholder="Số lượng thẻ cần mua" title="Số lượng thẻ" />
                    </div>
                    <div class="form-sl" >
                        <input type="email" id="ctrlemailaddressgame" name="ctrlemailaddressgame" value="" class="form-control txt" placeholder="Địa chỉ email nhận mã thẻ" title="" />
                    </div>
                    <div class="form-sl">
                        <div class="boxdrpmega">
                            <input class="txt nochange blur form-control" placeholder="Phương thức thanh toán" size="22" maxlength="40"
                                   id="buyCardGamePaymentMethod" value="" name="buyCardGamePaymentMethod" type="text" title="">
                            <span class="dropDownListArrow down"></span>
                            <div style="display: none; text-transform: none !important" class="dropDownList">
                                <table>
                                    <tbody>
                                        <tr align="left">
                                            <td colspan="4" class="last">
                                                <h4 class="fz14 fb700 cl333" style="text-transform: none">
                                                    Thanh toán bằng tài khoản thành viên
                                                </h4>
                                                <span class="separator"></span>
                                            </td>
                                        </tr>
                                        <tr align="left">
                                            <td colspan="4" style="vertical-align:middle;height:40px;" class="last">
                                                <ul>
                                                    <li>
                                                        <input txt="PayCard" rel="buyCardGamePaymentMethod" value="Paycard" id="buyCardGamePaymentMethodSelect_member" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethodSelect_member"><img src="/images/paycardvi.png" title="banthe24h" alt="banthe24h"></label>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr align="left">
                                            <td colspan="4" class="last">
                                                <h4 class="fz14 fb700 cl333" style="text-transform: none">
                                                    Lựa chọn ngân hàng (có đăng ký Internet banking hoặc DV Thanh toán trực tuyến)
                                                </h4>
                                                <span class="separator"></span>
                                            </td>
                                        </tr>
                                        <tr>
                            <td class="last">
                                <ul>
                                    <li>
                                        <input txt="VietcomBank" rel="buyCardGamePaymentMethod" value="Vietcombank" id="buyCardGamePaymentMethodSelect_vcb" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethodSelect_vcb"><img src="/images/vcb.png" alt="VietcomBank" title="VietcomBank"></label>
                                    </li>
                                    <li>
                                        <input txt="Vietinbank" rel="buyCardGamePaymentMethod" value="Vietinbank" id="buyCardGamePaymentMethod_ViettinBank" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_ViettinBank"><img src="/images/vtb.png" alt="Vietinbank" title="Vietinbank"></label>
                                    </li>
                                    <li>
                                        <input txt="Đông Á Bank" rel="buyCardGamePaymentMethod" value="DongABank" id="buyCardGamePaymentMethod_DongABank" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_DongABank"><img src="/images/DongA.gif" alt="Đông Á Bank" title="Đông Á Bank"></label>
                                    </li>
                                    <li>
                                        <input txt="NCB" rel="buyCardGamePaymentMethod" value="NCB" id="buyCardGamePaymentMethod_NCB" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_NCB">
                                            <img src="/images/ncb.png" alt="NCB" title="NCB">
                                        </label>
                                    </li>
                                    <li>
                                        <input txt="AgriBank" rel="buyCardGamePaymentMethod" value="Agribank" id="buyCardGamePaymentMethod_AGRIBANK" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_AGRIBANK"><img src="~/Images/agribank.jpg" alt="AGRIBANK" title="AGRIBANK"></label>
                                    </li>
                                </ul>
                            </td>
                            <td class="last">
                                <ul>
                                    <li>
                                        <input txt="Sacombank" rel="buyCardGamePaymentMethod" value="Sacombank" id="buyCardGamePaymentMethod_Sacombank" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_Sacombank"><img src="/images/scb.png" alt="Sacombank" title="Sacombank"></label>
                                    </li>
                                    <li>
                                        <input txt="BIDV" rel="buyCardGamePaymentMethod" value="BIDV" id="buyCardGamePaymentMethod_bidv" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_bidv"><img src="/images/bidv.jpg" alt="BIDV" title="BIDV"></label>
                                    </li>
                                    <li>
                                        <input txt="Maritimebank" rel="buyCardGamePaymentMethod" value="MaritimeBank" id="buyCardGamePaymentMethod_mrt" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_mrt"><img src="/images/maritime.jpg" alt="Maritimebank" title="Maritimebank"></label>
                                    </li>
                                    <li>
                                        <input txt="VISA" rel="buyCardGamePaymentMethod" value="Visa" id="buyCardGamePaymentMethod_VISA" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_VISA"><img src="~/Images/Visa.png" alt="VISA" title="VISA"></label>
                                    </li>
                                    <li>
                                        <input txt="MBBANK" rel="buyCardGamePaymentMethod" value="MB" id="buyCardGamePaymentMethod_MBBANK" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_MBBANK"><img src="~/Images/mb.png" alt="MBBANK" title="MBBANK"></label>
                                    </li>
                                </ul>
                            </td>
                            <td class="last">
                                <ul>
                                    <li>
                                        <input txt="Ocean Bank" rel="buyCardGamePaymentMethod" value="Oceanbank" id="buyCardGamePaymentMethod_Ojb" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_Ojb"><img src="/images/ocean.png" alt="Ocean Bank" title="Ocean Bank"></label>
                                    </li>
                                    <li>
                                        <input txt="Techcombank" rel="buyCardGamePaymentMethod" value="Techcombank" id="buyCardGamePaymentMethod_tcb" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_tcb"><img src="/images/tcb.png" alt="Techcombank" title="Techcombank"></label>
                                    </li>
                                    <li>
                                        <input txt="Nam Á Bank" rel="buyCardGamePaymentMethod" value="NamABank" id="buyCardGamePaymentMethod_nab" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_nab"><img src="/images/NamABank.jpg" alt="Nam Á Bank" title="Nam Á Bank"></label>
                                    </li>
                                    <li>
                                        <input txt="EXIMBANK" rel="buyCardGamePaymentMethod" value="Eximbank" id="buyCardGamePaymentMethod_EXIMBANK" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_EXIMBANK"><img src="~/Images/exb.png" alt="EXIMBANK" title="EXIMBANK"></label>
                                    </li>
                                    <li>
                                        <input txt="ACB" rel="buyCardGamePaymentMethod" value="ACB" id="buyCardGamePaymentMethod_ACB" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_ACB"><img src="~/Images/acb.png" alt="ACB" title="ACB"></label>
                                    </li>
                                </ul>
                            </td>
                            <td class="last">
                                <ul>
                                    <li>
                                        <input txt="HD Bank" rel="buyCardGamePaymentMethod" value="HDBank" id="buyCardGamePaymentMethod_HDBank" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_HDBank"><img src="/images/hdb.png" alt="HD Bank" title="HD Bank"></label>
                                    </li>
                                     <li>
                                            <input txt="Master" rel="buyCardPaymentMethod" value="Master" id="buyCardPaymentMethod_Master" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_Master"><img src="/images/mastercard.gif" alt="Master" title="Master"></label>
                                        </li>
                                    <li>
                                        <input txt="TienPhongBank" rel="buyCardGamePaymentMethod" value="TienPhongBank" id="buyCardGamePaymentMethod_tpb" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_tpb"><img src="/images/tpb.jpg" alt="TienPhongBank" title="TienPhongBank"></label>
                                    </li>
                                    <li>
                                        <input txt="OCB" rel="buyCardGamePaymentMethod" value="OCB" id="buyCardGamePaymentMethod_OCB" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_OCB"><img src="~/Images/ocb.png" alt="OCB" title="OCB"></label>
                                    </li>
                                    <li>
                                        <input txt="VPBANK" rel="buyCardGamePaymentMethod" value="VPBank" id="buyCardGamePaymentMethod_VPBANK" name="buyCardGamePaymentMethod" type="radio">
                                        <label for="buyCardGamePaymentMethod_ACB"><img src="~/Images/vpb.jpg" alt="VPBANK" title="VPBANK"></label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-sl">
                        <input type="password" id="ctrlgameghichumuathe" autocomplete="off" name="ctrlgameghichumuathe" placeholder="Mật khẩu cấp 2" />
                    </div>
                    <div class="form-group divbt">
                        <button type="button" class="btn btn-spec1 btn-md btn-block" style="background: #36c0d1;color:#fff; " id="ctrlmuathegamebtn">Mua thẻ ngay</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--right section work end-->
    <!--Preview confirm buy card Start-->
    <div class="modal fade" id="buycardgamepreviewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông tin giao dịch</h4>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="panel-body">
                        <div class="row form-horizontal">
                            <div class="col-sm-12">
                                <label class="control-label col-sm-4">Nhà cung cấp:</label>
                                <div class="col-sm-7">
                                    <label class="txtcon" id="lblgameprovider"></label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="control-label col-sm-4">Loại thẻ:</label>
                                <div class="col-sm-7">
                                    <label class="txtcon" id="lblgamecardtype"></label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="control-label col-sm-4">Số lượng:</label>
                                <div class="col-sm-7">
                                    <label class="txtcon" id="lblgamesoluongthe"></label>
                                </div>
                            </div>
                            <div class="col-sm-12" style="display:none;">
                                <label class="control-label col-sm-4">Địa chỉ Email nhận mã thẻ:</label>
                                <div class="col-sm-7">
                                    <label class="txtcon" id="lblgameemail"></label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="control-label col-sm-4" id="lblptttgame">Phương thức thanh toán:</label>
                                <div class="col-sm-7">
                                    <label class="txtcon" id="lblgamepaymentmethod"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="Confirm_OrderGameDetail">
                            <div class="form-group col-sm-12">
                                <label class="col-sm-offset-4 col-sm-8"><h5>Vui lòng nhập thông tin tài khoản của bạn</h5></label>
                            </div>
                            <div class="col-sm-12">
                                <div class="alert alert-danger" id="divgamenotifybc">
                                    <i class="fa fa-info-circle fa-lg"></i>
                                    <span></span>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="control-label col-sm-4" for="ctrlemailtxt_log">Địa chỉ Email:<span class="asterisk_input"></span></label>
                                <div class="col-sm-7">
                                    <input type="email" id="ctrlgameemailtxt_log" name="ctrlgameemailtxt_log" class="form-control" placeholder="Địa chỉ Email" value="">
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="control-label col-sm-4" for="ctrlpasstxt_log">Mật khẩu:<span class="asterisk_input"></span></label>
                                <div class="col-sm-7">
                                    <input type="password" id="ctrlgamepasstxt_log" name="ctrlgamepasstxt_log" class="form-control" placeholder="Mật khẩu" value="">
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
                        <button type="button" class="btn btn-primary" id="ctrthanhtoangamebtn" tabindex="1"><i class="fa fa-sign-in"></i> Thanh toán ngay</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="2"><i class="fa fa-times"></i>Hủy giao dịch</button>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Preview confirm buy card End-->
    <!--Show result buy card Start-->
    <div class="modal fade" id="buycardgameshowresultmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="modal-title" id="gamemyModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông báo giao dịch mua mã thẻ</h4>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="panel-body">
                        <div class="">
                            <div id="gamenotifyresult" class="alertx">
                                <i class="fa sign"></i><strong></strong><span></span>
                            </div>
                            <div class="divgameresult">
                                <table id="tblgamecardinfo" class="no-border">
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
                                <div style="padding-top: 20px;"><span>Thời gian giao dịch: <span class="datetransactiongame"></span></span></div>
                                <span id="xuatexelgame" class="btn btn-green">Chi tiết mã thẻ</span>
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
    <!--Preview confirm buy card End-->
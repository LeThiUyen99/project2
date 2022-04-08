<script type="text/javascript">
                $(function () {
                    var bc = new BuyCard();
                    bc.loadAllProvider();
                    var bc1= new naptiendt();
                    bc1.init_naptiendienthoai();
                    var gm = new muathegame();
                    gm.loadAllProvider1();
                });

                
            </script>
<div id="slideout"> 
  <img src="/images/phone.png" alt="hotline banthe24h.vn"> 
  <div id="slideout_inner"> 
    <div style="color:#fd0000">Hotline:</div> 
    <span><b>1900 633682</b></span> 
    <div style="color:#fd0000">Email:</div> 
    <span><b>info@24hpay.vn</b></span> 
  </div> 
</div>
<div class="container mid_content">
 <div class="divcontent1">
  <div id="maintopcontent">
    <div class="row">
      <div class="col-md-12">
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="/images/banner-b24h.png" alt="mua thẻ cào online" />
          </div>
        </div>

        <div style="clear:both;height:10px;"></div>
      </div>
    </div>
    <div class="row">

      <div class="col-md-4 col-sm-12">
        <div class="section-title bg-lable1">
          <h2 style="font-size:18px;margin:0px;line-height:37px;">Mua thẻ điện thoại</h2> </div>
          <div class="form-content bg1">
           <form name="buycard" action="#" method="post">
             <div class="form-group">
                <div class="boxdrpmega">
                    <input class="txt nochange blur form-control" placeholder="Chọn nhà cung cấp" size="22" maxlength="40"
                           id="buyCardProvider" value="" name="buyCardProvider" type="text" title="" readonly>
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
                            <tr id="trprovider"></tr>
                        </table>
                    </div>
                </div>
              
            </div>
            <div class="form-group">
              <div class="boxdrpmega">
                <input class="txt nochange blur form-control" placeholder="Mệnh giá thẻ nạp" size="22" maxlength="40" id="buyCardAmount" val="" name="buyCardAmount" type="text" readonly>
                <span class="dropDownListArrow down"></span>
                <div style="display: none; text-transform: none !important" class="dropDownList" id="table_CardAmount">

                </div>
            </div>
            </div>
            <div class="form-group">
             <input type="text" maxlength="40" id="ctrlsoluongthe" name="soluongthe" value="" class="form-control" placeholder="Số lượng thẻ <=300" title="Số lượng thẻ" /> </div>
             <div class="form-group">
              <input type="email" id="ctrlemailaddress" name="emailaddress" value="" class="form-control" placeholder="Địa chỉ email nhận mã thẻ" title="" /> </div>
              <div class="form-group">
                <div class="boxdrpmega">
                  <input class="txt nochange blur form-control" placeholder="Phương thức thanh toán" size="22" maxlength="40"
                       id="buyCardPaymentMethod" value="" name="buyCardPaymentMethod" type="text" title="">
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
                                            <input txt="banthe24h" rel="buyCardPaymentMethod" value="banthe24h" id="buyCardPaymentMethodSelect_member" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethodSelect_member"><img src="/images/logobt24h.png" title="mua the dien thoai" alt="mua the dien thoai"></label>
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
                                            <input txt="VietcomBank" rel="buyCardPaymentMethod" value="VIETCOMBANK" id="buyCardPaymentMethodSelect_vcb" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethodSelect_vcb"><img src="/images/vcb.png" alt="VietcomBank" title="VietcomBank"></label>
                                        </li>
                                        <li>
                                            <input txt="Vietinbank" rel="buyCardPaymentMethod" value="VIETINBANK" id="buyCardPaymentMethod_ViettinBank" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_ViettinBank"><img src="/images/vtb.png" alt="Vietinbank" title="Vietinbank"></label>
                                        </li>
                                        <li>
                                            <input txt="Đông Á Bank" rel="buyCardPaymentMethod" value="DONGABANK" id="buyCardPaymentMethod_DongABank" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_DongABank"><img src="/images/DongA.gif" alt="Đông Á Bank" title="Đông Á Bank"></label>
                                        </li>
                                        <li>
                                            <input txt="NCB" rel="buyCardPaymentMethod" value="NCB" id="buyCardPaymentMethod_NCB" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_NCB">
                                                <img src="/images/ncb.png" alt="NCB" title="NCB"></label>
                                        </li>
                                        <li>
                                            <input txt="AgriBank" rel="buyCardPaymentMethod" value="AGRIBANK" id="buyCardPaymentMethod_AGRIBANK" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_AGRIBANK"><img src="/images/agribank.jpg" alt="AGRIBANK" title="AGRIBANK"></label>
                                        </li>
                                    </ul>
                                </td>
                                <td class="last">
                                    <ul>
                                        <li>
                                            <input txt="Sacombank" rel="buyCardPaymentMethod" value="SACOMBANK" id="buyCardPaymentMethod_Sacombank" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_Sacombank"><img src="/images/scb.png" alt="Sacombank" title="Sacombank"></label>
                                        </li>
                                        <li>
                                            <input txt="BIDV" rel="buyCardPaymentMethod" value="BIDV" id="buyCardPaymentMethod_bidv" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_bidv"><img src="/images/bidv.jpg" alt="BIDV" title="BIDV"></label>
                                        </li>
                                        <li>
                                            <input txt="Maritimebank" rel="buyCardPaymentMethod" value="MSBANK" id="buyCardPaymentMethod_mrt" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_mrt"><img src="/images/maritime.jpg" alt="Maritimebank" title="Maritimebank"></label>
                                        </li>
                                        <li>
                                            <input txt="VISA" rel="buyCardPaymentMethod" value="VISA" id="buyCardPaymentMethod_VISA" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_VISA"><img src="/images/Visa.png" alt="VISA" title="VISA"></label>
                                        </li>
                                        <li>
                                            <input txt="MBBANK" rel="buyCardPaymentMethod" value="MBBANK" id="buyCardPaymentMethod_MBBANK" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_MBBANK"><img src="/images/mb.png" alt="MBBANK" title="MBBANK"></label>
                                        </li>
                                    </ul>
                                </td>
                                <td class="last">
                                    <ul>
                                        <li>
                                            <input txt="Ocean Bank" rel="buyCardPaymentMethod" value="OJB" id="buyCardPaymentMethod_Ojb" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_Ojb"><img src="/images/ocean.png" alt="Ocean Bank" title="Ocean Bank"></label>
                                        </li>
                                        <li>
                                            <input txt="Techcombank" rel="buyCardPaymentMethod" value="TECHCOMBANK" id="buyCardPaymentMethod_tcb" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_tcb"><img src="/images/tcb.png" alt="Techcombank" title="Techcombank"></label>
                                        </li>
                                        <li>
                                            <input txt="Nam Á Bank" rel="buyCardPaymentMethod" value="NAMABANK" id="buyCardPaymentMethod_nab" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_nab"><img src="/images/NamABank.jpg" alt="Nam Á Bank" title="Nam Á Bank"></label>
                                        </li>
                                         <li>
                                            <input txt="EXIMBANK" rel="buyCardPaymentMethod" value="EXIMBANK" id="buyCardPaymentMethod_EXIMBANK" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_EXIMBANK"><img src="/images/exb.png" alt="EXIMBANK" title="EXIMBANK"></label>
                                        </li>
                                        <li>
                                            <input txt="ACB" rel="buyCardPaymentMethod" value="ACB" id="buyCardPaymentMethod_ACB" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_ACB"><img src="/images/acb.png" alt="ACB" title="ACB"></label>
                                        </li>
                                    </ul>
                                </td>
                                <td class="last">
                                    <ul>
                                        <li>
                                            <input txt="HD Bank" rel="buyCardPaymentMethod" value="HDBANK" id="buyCardPaymentMethod_HDBank" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_HDBank"><img src="/images/hdb.png" alt="HD Bank" title="HD Bank"></label>
                                        </li>
                                        <li>
                                            <input txt="VnMart" rel="buyCardPaymentMethod" value="VNMART" id="buyCardPaymentMethod_VnMart" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_VnMart"><img src="/images/vnmart.gif" alt="VnMart" title="VnMart"></label>
                                        </li>
                                        <li>
                                            <input txt="TienPhongBank" rel="buyCardPaymentMethod" value="TPBANK" id="buyCardPaymentMethod_tpb" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_tpb"><img src="/images/tpb.jpg" alt="TienPhongBank" title="TienPhongBank"></label>
                                        </li>
                                        <li>
                                            <input txt="OCB" rel="buyCardPaymentMethod" value="OCB" id="buyCardPaymentMethod_OCB" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_OCB"><img src="/images/ocb.png" alt="OCB" title="OCB"></label>
                                        </li>
                                        <li>
                                            <input txt="VPBANK" rel="buyCardPaymentMethod" value="VPBANK" id="buyCardPaymentMethod_VPBANK" name="buyCardPaymentMethod" type="radio">
                                            <label for="buyCardPaymentMethod_ACB"><img src="/images/vpb.jpg" alt="VPBANK" title="VPBANK"></label>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    </div>
                  </div>
                  <div class="form-group divbt">
                    <button type="button" class="btn btn-spec1 btn-md btn-block" id="ctrlmuathebtn">Mua thẻ ngay</button> <a style="display:block;text-align:center;padding-right:0px;" rel="nofollow" href="">&nbsp;</a> </div>
                  </form>
                </div>
                <!--popup work start here-->
                <!--Preview confirm buy card Start-->
                <div class="modal fade" id="buycardpreviewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                 <div class="modal-dialog modal-md">
                   <div class="panel panel-primary">
                     <div class="panel-heading">
                       <div style="font-weight: bold;" class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i> Thông tin giao dịch</div>
                     </div>
                     <form class="form-horizontal" role="form">
                       <div class="panel-body">
                         <div class="row form-horizontal">
                           <div class="col-sm-12">
                             <label class="control-label col-sm-4">Nhà cung cấp:</label>
                             <div class="col-sm-7">
                               <label class="txtcon" id="lblprovider"></label>
                             </div>
                           </div>
                           <div class="col-sm-12">
                            <label class="control-label col-sm-4">Loại thẻ:</label>
                            <div class="col-sm-7">
                              <label class="txtcon" id="lblcardtype"></label>
                            </div>
                          </div>
                          <div class="col-sm-12">
                           <label class="control-label col-sm-4">Số lượng:</label>
                           <div class="col-sm-7">
                             <label class="txtcon" id="lblsoluongthe"></label>
                           </div>
                         </div>
                         <div class="col-sm-12">
                          <label class="control-label col-sm-4">Email nhận mã thẻ:</label>
                          <div class="col-sm-7">
                            <label class="txtcon" id="lblemail"></label>
                          </div>
                        </div>
                        <div class="col-sm-12">
                         <label class="control-label col-sm-4" id="lblpttt">Phương thức thanh toán:</label>
                         <div class="col-sm-7">
                           <label class="txtcon" id="lblpaymentmethod"></label>
                         </div>
                       </div>
                     </div>
                     <div class="row" id="Confirm_BuyCardDetail">
                      <div class="form-group col-sm-12">
                        <label class="col-sm-offset-4 col-sm-8">
                          <div style="font-weight: bold;">Vui lòng nhập thông tin tài khoản của bạn</div>
                        </label>
                      </div>
                        <div class="col-sm-12">
                            <div class="alert alert-danger" id="divnotifybc">
                                <i class="fa fa-info-circle fa-lg"></i>
                                <span></span>
                            </div>
                        </div>
                      <div class="form-group col-sm-12">
                       <label class="control-label col-sm-4" for="ctrlemailtxt_log">Địa chỉ Email:<span class="asterisk_input"></span></label>
                       <div class="col-sm-7">
                         <input type="email" id="ctrlemailmuathetxt_log" name="ctrlemailtxt_log" class="form-control" placeholder="Địa chỉ Email" value=""> </div>
                       </div>
                       <div class="form-group col-sm-12">
                         <label class="control-label col-sm-4" for="ctrlpasstxt_log">Mật khẩu:<span class="asterisk_input"></span></label>
                         <div class="col-sm-7">
                           <input type="password" id="ctrlpassmuathetxt_log" name="ctrlpasstxt_log" class="form-control" placeholder="Mật khẩu" value=""> </div>
                         </div>
                         <div class="form-group col-sm-12">
                           <div class="col-sm-offset-4 col-sm-7"> <a class="pull-right" href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotyourpassword"><i>Quên mật khẩu</i></a> <span class="pull-right">&nbsp;&nbsp;|&nbsp;&nbsp;</span> <a class="pull-right" href="#"><i>Đăng ký</i></a> </div>
                         </div>
                       </div>
                     </div>
                     <div class="panel-footer text-center">
                       <button type="button" class="btn btn-primary" id="ctrthanhtoanbtn"  tabindex="1"><i class="fa fa-sign-in"></i> Thanh toán ngay</button>
                       <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="2"><i class="fa fa-times"></i> Hủy giao dịch</button>
                       <div class="clearfix"></div>
                     </div>
                   </form>
                 </div>
               </div>
             </div>
             <div class="modal fade" id="buycardshowresultmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div style="font-weight: bold;" class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông báo giao dịch mua mã thẻ</div>
            </div>
            <form class="form-horizontal" role="form">
                <div class="panel-body">
                    <div class="">
                        <div id="notifyresult" class="alertx">
                            <i class="fa sign"></i><strong></strong><span></span>
                        </div>
                        <div class="buycarddivresult">
                            <table id="buycardtblcardinfo" class="no-border" style="display:none !important;">
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
                            <span id="xuatexel" class="btn btn-green">Chi tiết mã thẻ</span>
                           
                        </div>

                    </div>

                    <div class="modalbottom">
                        <button type="button" class="btn btn-primary" id="ctrcontinuemuathebtn" data-dismiss="modal" tabindex="1"><i class="fa fa-sign-in"></i> Tiếp tục mua</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
           </div>
           <div class="col-md-4 col-sm-12">
            <div class="section-title bg-lable3">
              <h2 style="font-size:18px;margin:0px;line-height:37px;">Nạp tiền điện thoại</h2> </div>
              <div class="form-content bg3">
               <form name="buycard" action="#" method="post">
                 <div class="form-group">
                   <input type="text" maxlength="14" id="ctrlSoDienThoai" name="ctrlSoDienThoai" value="" class="form-control txt" placeholder="Số điện thoại" title="Số điện thoại" /> 
                   </div>
                   <div class="form-group">
                    <div class="boxdrpmega">
                        <input class="txt nochange blur form-control" placeholder="Loại thuê bao" size="22" maxlength="40" id="topuptype" val="" name="topuptype" type="text" readonly>
                        <span class="dropDownListArrow down"></span>
                        <div style="display: none; text-transform: none !important" class="dropDownList" id="table_topuptopuptype">
                            <table rel="" style="" width="100%">
                                <tbody>                       
                                    <tr id="trprovider"><td><p><input id="topuptype_1" name="topuptype" rel="topuptype" value="TT" txt="Trả trước" type="radio" class="left">&nbsp;<label class="left mL5" for="topuptype_1">Trả trước</label><span class="separator"></span></p><p><input id="topuptype_2" name="topuptype" rel="topuptype" value="TS" txt="Trả sau" type="radio" class="left">&nbsp;<label class="left mL5" for="topuptype_2">Trả sau</label><span class="separator"></span></p></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                   <div class="boxdrpmega">
                        <input class="txt nochange blur form-control" placeholder="Mệnh giá thẻ nạp" size="22" maxlength="40" id="topupAmount" val="" name="topupAmount" type="text" readonly>
                        <span class="dropDownListArrow down"></span>
                        <div style="display: none; text-transform: none !important" class="dropDownList" id="table_topupAmount">
        
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <input type="email" id="ctrlnapdienthoaiemailaddress" name="ctrlnapdienthoaiemailaddress" value="" class="form-control txt" placeholder="Email thông tin giao dịch(không bắt buộc)" title="" />
                </div>
                  <div class="form-group">
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
                                            <input txt="banthe24h" rel="topupPaymentMethod" value="banthe24h" id="topupPaymentMethodSelect_member" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethodSelect_member"><img src="/images/logobt24h.png" title="Nạp tiền điện thoại" alt="Nạp tiền điện thoại"></label>
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
                                            <input txt="VietcomBank" rel="topupPaymentMethod" value="VIETCOMBANK" id="topupPaymentMethodSelect_vcb" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethodSelect_vcb"><img src="/images/vcb.png" alt="VietcomBank" title="VietcomBank"></label>
                                        </li>
                                        <li>
                                            <input txt="Vietinbank" rel="topupPaymentMethod" value="VIETINBANK" id="topupPaymentMethod_ViettinBank" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_ViettinBank"><img src="/images/vtb.png" alt="Vietinbank" title="Vietinbank"></label>
                                        </li>
                                        <li>
                                            <input txt="Đông Á Bank" rel="topupPaymentMethod" value="DONGABANK" id="topupPaymentMethod_DongABank" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_DongABank"><img src="/images/DongA.gif" alt="Đông Á Bank" title="Đông Á Bank"></label>
                                        </li>
                                        <li>
                                            <input txt="MB Bank" rel="topupPaymentMethod" value="MBBANK" id="topupPaymentMethod_MBBANK" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_MBBANK"><img src="/images/mb.png" alt="MB Bank" title=" mb bank"></label>
                                        </li>
                                        <li>
                                            <input txt="EximBank" rel="topupPaymentMethod" value="EXIMBANK" id="topupPaymentMethod_EXIMBANK" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_EXIMBANK"><img src="/images/exb.png" alt="EXIMBANK" title="EXIMBANK"></label>
                                        </li>
                                    </ul>
                                </td>
                                <td class="last">
                                    <ul>
                                        <li>
                                            <input txt="Sacombank" rel="topupPaymentMethod" value="SACOMBANK" id="topupPaymentMethod_Sacombank" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_Sacombank"><img src="/images/scb.png" alt="Sacombank" title="Sacombank"></label>
                                        </li>
                                        <li>
                                            <input txt="BIDV" rel="topupPaymentMethod" value="BIDV" id="topupPaymentMethod_bidv" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_bidv"><img src="/images/bidv.jpg" alt="BIDV" title="BIDV"></label>
                                        </li>
                                        <li>
                                            <input txt="Maritimebank" rel="topupPaymentMethod" value="MSBANK" id="topupPaymentMethod_mrt" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_mrt"><img src="/images/maritime.jpg" alt="Maritimebank" title="Maritimebank"></label>
                                        </li>
                                        <li>
                                            <input txt="ACB Bank" rel="topupPaymentMethod" value="ACB" id="topupPaymentMethod_ACB" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_ACB"><img src="/images/acb.png" alt="ACB Bank" title="ACB Bank"></label>
                                        </li>
                                        <li>
                                            <input txt="VPBANK" rel="topupPaymentMethod" value="VPBANK" id="topupPaymentMethod_VPBANK" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_VPBANK"><img src="/images/vpb.jpg" alt="VPBANK" title="VPBANK"></label>
                                        </li>
                                    </ul>
                                </td>
                                <td class="last">
                                    <ul>
                                       <li>
                                            <input txt="Ocean Bank" rel="topupPaymentMethod" value="OJB" id="topupPaymentMethod_Ojb" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_Ojb"><img src="/images/ocean.png" alt="Ocean Bank" title="Ocean Bank"></label>
                                        </li>
                                        <li>
                                            <input txt="Techcombank" rel="topupPaymentMethod" value="TECHCOMBANK" id="topupPaymentMethod_tcb" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_tcb"><img src="/images/tcb.png" alt="Techcombank" title="Techcombank"></label>
                                        </li>
                                        <li>
                                            <input txt="Nam Á Bank" rel="topupPaymentMethod" value="NAMABANK" id="topupPaymentMethod_nab" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_nab"><img src="/images/NamABank.jpg" alt="Nam Á Bank" title="Nam Á Bank"></label>
                                        </li>
                                        <li>
                                            <input txt="Phương Đông Bank" rel="topupPaymentMethod" value="OCB" id="topupPaymentMethod_OCB" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_OCB"><img src="/images/ocb.png" alt="Phương Đông Bank" title="Phương Đông Bank"></label>
                                        </li>
                                        <li>
                                            <input txt="AGRIBANK" rel="topupPaymentMethod" value="AGRIBANK" id="topupPaymentMethod_AGRIBANK" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_AGRIBANK"><img src="/images/agribank.jpg" alt="AGRIBANK" title="AGRIBANK"></label>
                                        </li>
                                    </ul>
                                </td>
                                <td class="last">
                                    <ul>
                                        <li>
                                            <input txt="HD Bank" rel="topupPaymentMethod" value="HDBANK" id="topupPaymentMethod_HDBank" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_HDBank"><img src="/images/hdb.png" alt="HD Bank" title="HD Bank"></label>
                                        </li>
                                        <li>
                                            <input txt="VnMart" rel="topupPaymentMethod" value="VNMART" id="topupPaymentMethod_VnMart" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_VnMart"><img src="/images/vnmart.gif" alt="VnMart" title="VnMart"></label>
                                        </li>
                                        <li>
                                            <input txt="TienPhongBank" rel="topupPaymentMethod" value="TPBANK" id="topupPaymentMethod_tpb" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_tpb"><img src="/images/tpb.jpg" alt="TienPhongBank" title="TienPhongBank"></label>
                                        </li>
                                        <li>
                                            <input txt="Quốc Dân Bank" rel="topupPaymentMethod" value="NCB" id="topupPaymentMethod_NCB" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_NCB"><img src="/images/ncb.jpg" alt="Quốc Dân Bank" title="Quốc Dân Bank"></label>
                                        </li>
                                        <li>
                                            <input txt="Visa" rel="topupPaymentMethod" value="VISA" id="topupPaymentMethod_VISA" name="topupPaymentMethod" type="radio">
                                            <label for="topupPaymentMethod_VISA"><img src="/images/VISA.png" alt="Visa" title="Visa"></label>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                      </div>
                      <div class="form-group divbt">
                        <button type="button" class="btn btn-md btn-block bg-lable3" style="color:#fff;" id="ctrltopupmobilebtn">Nạp tiền ngay</button> <a style="display:block;text-align:center;padding-right:0px;" rel="nofollow" href="">&nbsp;</a> </div>
                      </form>
                    </div>
                    <!--popup work start here-->
                    <!--Preview confirm nap tien dien thoai Start-->
                    <div class="modal fade" id="naptiendienthoaipreviewmodal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                       <div class="panel panel-primary">
                         <div class="panel-heading">
                           <div style="font-weight: bold;" class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông tin giao dịch</div>
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
                               <label class="control-label col-sm-4">Địa chỉ Email nhận mã thẻ:</label>
                               <div class="col-sm-7">
                                 <label class="txtcon" id="lbltopupemail"></label>
                               </div>
                             </div>
                             <div class="col-sm-12">
                              <label class="control-label col-sm-4" id="lblpttt">Phương thức thanh toán:</label>
                              <div class="col-sm-7">
                                <label class="txtcon" id="lbltopuppaymentmethod"></label>
                              </div>
                            </div>
                          </div>
                          <div class="row" id="Topup_Confirm_OrderDetail">
                            <div class="form-group col-sm-12">
                              <label class="col-sm-offset-4 col-sm-8">
                                <div style="font-weight: bold;">Vui lòng nhập thông tin tài khoản của bạn</div>
                              </label>
                            </div>
                            <div class="form-group col-sm-12">
                             <label class="control-label col-sm-4" for="ctrlemailtxt_log">Địa chỉ Email:<span class="asterisk_input"></span></label>
                             <div class="col-sm-7">
                               <input type="email" id="ctrlemailtopuptxt_log" name="ctrlemailtopuptxt_log" class="form-control" placeholder="Địa chỉ Email" value=""> </div>
                             </div>
                             <div class="form-group col-sm-12">
                               <label class="control-label col-sm-4" for="ctrlpasstxt_log">Mật khẩu:<span class="asterisk_input"></span></label>
                               <div class="col-sm-7">
                                 <input type="password" id="ctrlpasstopuptxt_log" name="ctrlpasstopuptxt_log" class="form-control" placeholder="Mật khẩu" value=""> </div>
                               </div>
                               <div class="form-group col-sm-12">
                                 <div class="col-sm-offset-4 col-sm-7"> <a class="pull-right" href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotyourpassword"><i>Quên mật khẩu</i></a> <span class="pull-right">&nbsp;&nbsp;|&nbsp;&nbsp;</span> <a class="pull-right" href="/User/register"><i>Đăng ký</i></a> </div>
                               </div>
                             </div>
                           </div>
                           <div class="panel-footer text-center">
                             <button type="button" class="btn btn-primary" id="ctrtopupthanhtoanbtn" tabindex="1"><i class="fa fa-sign-in"></i> Thanh toán ngay</button>
                             <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="2"><i class="fa fa-times"></i>Hủy giao dịch</button>
                             <div class="clearfix"></div>
                           </div>
                         </form>
                       </div>
                     </div>
                   </div>
                   <!--Preview confirm nap tien dien thoai End-->
<div class="modal fade" id="naptiendienthoairesultmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div style="font-weight: bold;" class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông báo giao dịch nạp thẻ điện thoại</div>
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
                        <button type="button" class="btn btn-primary" id="ctrcontinuetopupbtn" data-dismiss="modal" tabindex="1"><i class="fa fa-sign-in"></i> Tiếp tục mua</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                 </div>
                 <div class="col-md-4 col-sm-12">
                  <div class="section-title bg-lable4">
                    <h2 style="font-size:18px;margin:0px;line-height:37px;">Mua thẻ Garena, Gate, Zing, Vtc</h2> </div>
                    <!--right section work start-->
                    <div class="form-content bg1" style="padding-bottom: 24px">
                     <form name="buycardgame" action="#" method="post">
                       <div class="form-group">
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
                      <div class="form-group">
                        <div class="boxdrpmega">
                            <input class="txt nochange blur form-control" placeholder="Mệnh giá thẻ nạp" size="22" maxlength="40" id="buyCardGameAmount" val="" name="buyCardGameAmount" type="text" readonly>
                            <span class="dropDownListArrow down"></span>
                            <div style="display: none; text-transform: none !important" class="dropDownList" id="game_CardAmount">
            
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                       <input type="text" maxlength="40" id="ctrlsoluongthegame" name="ctrlsoluongthegame" value="" class="form-control txt" placeholder="Số lượng thẻ cần mua" title="Số lượng thẻ" />
                      </div>
                       <div class="form-group">
                        <input type="email" id="ctrlemailaddressgame" name="ctrlemailaddressgame" value="" class="form-control txt" placeholder="Địa chỉ email nhận mã thẻ" title="" /> 
                      </div>
                        <div class="form-group">
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
                                                        <input txt="banthe24h" rel="buyCardGamePaymentMethod" value="banthe24h" id="buyCardGamePaymentMethodSelect_member" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethodSelect_member"><img src="/images/logobt24h.png" title="banthe24h" alt="banthe24h"></label>
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
                                                        <input txt="VietcomBank" rel="buyCardGamePaymentMethod" value="VIETCOMBANK" id="buyCardGamePaymentMethodSelect_vcb" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethodSelect_vcb"><img src="/images/vcb.png" alt="VietcomBank" title="VietcomBank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="Vietinbank" rel="buyCardGamePaymentMethod" value="VIETINBANK" id="buyCardGamePaymentMethod_ViettinBank" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_ViettinBank"><img src="/images/vtb.png" alt="Vietinbank" title="Vietinbank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="Đông Á Bank" rel="buyCardGamePaymentMethod" value="DONGABANK" id="buyCardGamePaymentMethod_DongABank" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_DongABank"><img src="/images/DongA.gif" alt="Đông Á Bank" title="Đông Á Bank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="NCB" rel="buyCardGamePaymentMethod" value="NCB" id="buyCardGamePaymentMethod_NCB" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_NCB">
                                                            <img src="/images/ncb.png" alt="NCB" title="NCB">
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input txt="AgriBank" rel="buyCardGamePaymentMethod" value="AGRIBANK" id="buyCardGamePaymentMethod_AGRIBANK" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_AGRIBANK"><img src="/images/agribank.jpg" alt="AGRIBANK" title="AGRIBANK"></label>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="last">
                                                <ul>
                                                    <li>
                                                        <input txt="Sacombank" rel="buyCardGamePaymentMethod" value="SACOMBANK" id="buyCardGamePaymentMethod_Sacombank" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_Sacombank"><img src="/images/scb.png" alt="Sacombank" title="Sacombank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="BIDV" rel="buyCardGamePaymentMethod" value="BIDV" id="buyCardGamePaymentMethod_bidv" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_bidv"><img src="/images/bidv.jpg" alt="BIDV" title="BIDV"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="Maritimebank" rel="buyCardGamePaymentMethod" value="MSBANK" id="buyCardGamePaymentMethod_mrt" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_mrt"><img src="/images/maritime.jpg" alt="Maritimebank" title="Maritimebank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="VISA" rel="buyCardGamePaymentMethod" value="VISA" id="buyCardGamePaymentMethod_VISA" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_VISA"><img src="/images/Visa.png" alt="VISA" title="VISA"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="MBBANK" rel="buyCardGamePaymentMethod" value="MBBANK" id="buyCardGamePaymentMethod_MBBANK" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_MBBANK"><img src="/images/mb.png" alt="MBBANK" title="MBBANK"></label>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="last">
                                                <ul>
                                                    <li>
                                                        <input txt="Ocean Bank" rel="buyCardGamePaymentMethod" value="OJB" id="buyCardGamePaymentMethod_Ojb" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_Ojb"><img src="/images/ocean.png" alt="Ocean Bank" title="Ocean Bank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="Techcombank" rel="buyCardGamePaymentMethod" value="TECHCOMBANK" id="buyCardGamePaymentMethod_tcb" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_tcb"><img src="/images/tcb.png" alt="Techcombank" title="Techcombank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="Nam Á Bank" rel="buyCardGamePaymentMethod" value="NAMABANK" id="buyCardGamePaymentMethod_nab" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_nab"><img src="/images/NamABank.jpg" alt="Nam Á Bank" title="Nam Á Bank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="EXIMBANK" rel="buyCardGamePaymentMethod" value="EXIMBANK" id="buyCardGamePaymentMethod_EXIMBANK" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_EXIMBANK"><img src="/images/exb.png" alt="EXIMBANK" title="EXIMBANK"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="ACB" rel="buyCardGamePaymentMethod" value="ACB" id="buyCardGamePaymentMethod_ACB" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_ACB"><img src="/images/acb.png" alt="ACB" title="ACB"></label>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="last">
                                                <ul>
                                                    <li>
                                                        <input txt="HD Bank" rel="buyCardGamePaymentMethod" value="HDBANK" id="buyCardGamePaymentMethod_HDBank" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_HDBank"><img src="/images/hdb.png" alt="HD Bank" title="HD Bank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="VnMart" rel="buyCardGamePaymentMethod" value="VNMART" id="buyCardGamePaymentMethod_VnMart" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_VnMart"><img src="/images/vnmart.gif" alt="VnMart" title="VnMart"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="TienPhongBank" rel="buyCardGamePaymentMethod" value="TPBANK" id="buyCardGamePaymentMethod_tpb" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_tpb"><img src="/images/tpb.jpg" alt="TienPhongBank" title="TienPhongBank"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="OCB" rel="buyCardGamePaymentMethod" value="OCB" id="buyCardGamePaymentMethod_OCB" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_OCB"><img src="/images/ocb.png" alt="OCB" title="OCB"></label>
                                                    </li>
                                                    <li>
                                                        <input txt="VPBANK" rel="buyCardGamePaymentMethod" value="VPBANK" id="buyCardGamePaymentMethod_VPBANK" name="buyCardGamePaymentMethod" type="radio">
                                                        <label for="buyCardGamePaymentMethod_ACB"><img src="/images/vpb.jpg" alt="VPBANK" title="VPBANK"></label>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                          </div>
                          <div class="form-group divbt">
                            <button type="button" class="btn btn-spec1 btn-md btn-block" id="ctrlmuathegamebtn">Mua thẻ ngay</button>
                          </div>
                        </form>



                        <!--right section work end-->
                        <!--Preview confirm buy card Start-->
                        <div class="modal fade" id="buycardgamepreviewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-md">
                           <div class="panel panel-primary">
                             <div class="panel-heading">
                               <div style="font-weight: bold;" class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông tin giao dịch</div>
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
                                 <div class="col-sm-12">
                                  <label class="control-label col-sm-4">Email nhận mã thẻ:</label>
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
                                <label class="col-sm-offset-4 col-sm-8">
                                  <div style="font-weight: bold;">Vui lòng nhập thông tin tài khoản của bạn</div>
                                </label>
                              </div>
                              <div class="form-group col-sm-12">
                               <label class="control-label col-sm-4" for="ctrlemailtxt_log">Địa chỉ Email:<span class="asterisk_input"></span></label>
                               <div class="col-sm-7">
                                 <input type="email" id="ctrlgameemailtxt_log" name="ctrlgameemailtxt_log" class="form-control" placeholder="Địa chỉ Email" value=""> </div>
                               </div>
                               <div class="form-group col-sm-12">
                                 <label class="control-label col-sm-4" for="ctrlpasstxt_log">Mật khẩu:<span class="asterisk_input"></span></label>
                                 <div class="col-sm-7">
                                   <input type="password" id="ctrlgamepasstxt_log" name="ctrlgamepasstxt_log" class="form-control" placeholder="Mật khẩu" value=""> </div>
                                 </div>
                                 <div class="form-group col-sm-12">
                                   <div class="col-sm-offset-4 col-sm-7"> <a class="pull-right" href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotyourpassword"><i>Quên mật khẩu</i></a> <span class="pull-right">&nbsp;&nbsp;|&nbsp;&nbsp;</span> <a class="pull-right" href="/user/register"><i>Đăng ký</i></a> </div>
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
                             <div style="font-weight: bold;" class="modal-title" id="gamemyModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông báo giao dịch mua mã thẻ</div>
                           </div>
                           <form class="form-horizontal" role="form">
                             <div class="panel-body">
                               <div class="">
                                 <div id="gamenotifyresult" class="alertx"> <i class="fa sign"></i><strong></strong><span></span> </div>
                                 <div class="divgameresult">
                                   <table id="tblgamecardinfo" class="no-border" style="display:none !important;">
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
                                   <div style="padding-top: 20px;"><span>Thời gian giao dịch: <span class="datetransactiongame"></span></span>
                                   </div> <span id="xuatexelgame" class="btn btn-green">Chi tiết mã thẻ</span> </div>
                                 </div>
                                 <div class="modalbottom">
                                  <button type="button" class="btn btn-primary" id="ctrcontinuegamebtn" data-dismiss="modal" tabindex="1"><i class="fa fa-sign-in"></i> Tiếp tục mua</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!--Preview confirm buy card End-->
                    </div>
                  </div>

                  <div class="clear-fix"></div>
                  <div>
                   <div class="col-md-12 col-sm-12">
                     <div style="float:left;width:100%;"> </div>
                     
                       <? include ("inc_banggiabanthe.php")?>
          
        
        
      </div></div>
    </div>
  </div>
  <div class="content-mobile">
    <ul class="ul_service">
      <li class="sv_2"><a href="/tien-ich/mua-the-dien-thoai">Mua thẻ điện thoại </a></li>
      <li class="sv_1"><a href="/mobile/nap-tien-dien-thoai">Nạp tiền điện thoại nhanh </a></li>
      <li class="sv_4"><a href="/mobile/muathegame">Mua thẻ game, 3G mobi</a></li>
    </ul>
  </div>
  <div class="container" style="float: left;width:100%;text-align:left;font-weight: bold;margin-bottom: 13px;margin-top:13px;    padding: 0px;">
    <div style="float:left;width:100%;" class="linktuychon"> </div>
    <div style="float: left:width:100%">
      <br />
      <div class="noidungtrangchu">
        <div class="noidungtrangchu_l">
          <? include("home/inc_dichvutrangchu.php") ?>
      </div>
    </div>
  </div>
</div>

</div>
</div>
<div class="content-mobile">
  <div class="table-responsive container">
    <div style="float:left;width:100%;" class="linktuychon">
      <? include("home/inc_linktuychon.php") ?>
      </div>
    </div>

  </div>
  <div id="remoteModal" class="modal fade" role="dialog" data-backdrop="static">
   <div class="modal-dialog modal-md">
     <div class="modal-content panel panel-primary"> </div>
   </div>
 </div>


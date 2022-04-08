<div class="content_3">
<div class="section-title bg-lable1">
   <h3 class="h3muamathe">Mua mã thẻ</h3>
   <div class="form-content bg1 main_content">
      <form name="buycard" action="#" autocomplete="false" method="post" >
         <div class="middlebuycard">
            <div class="form-sl">
               <div class="boxdrpmega">
                  <table rel="" style="margin-top:0px!important;" width="100%">
                     <tr id="trprovider"></tr>
                  </table>
               </div>
            </div>
            <div class="form-sl">
               <div style="height:45px;margin-bottom:15px;width:100%">
                  <div class="muathepercen" style="display: none;">
                     <div id="vcb" style="display: none;" class="muathepc muathepc1">
                        <div class="box_price">
                           <div class="img_pc"><img src="/images/icon_vt.png" alt="Nạp tiền vào ví qua thẻ VIETTEL"></div>
                           <p class="nhamang">VTEL</p>
                           <p class="chietkhau">17.75%</p>
                        </div>
                     </div>
                     <div id="tcb" style="display: none;" class="muathepc muathepc2">
                        <div class="box_price">
                           <div class="img_pc"><img src="/images/icon_mobi.png" alt="Nạp tiền vào ví qua thẻ MOBIPHONE" data-pin-nopin="true"></div>
                           <p class="nhamang">MOBI</p>
                           <p class="chietkhau">17.5%</p>
                        </div>
                     </div>
                     <div id="vtb" style="display: none;" class="muathepc muathepc3">
                        <div class="box_price">
                           <div class="img_pc"><img src="/images/icon_vina.png" alt="Nạp tiền vào ví qua thẻ VINAPHONE" data-pin-nopin="true"></div>
                           <p class="nhamang">VINA</p>
                           <p class="chietkhau">17.5%</p>
                        </div>
                     </div>
                     <div id="agb" style="display: none;" class="muathepc muathepc5">
                        <div class="box_price">
                           <div class="img_pc"><img src="/images/icon_gate.png" alt="Nạp tiền vào ví qua thẻ FPT Gate" data-pin-nopin="true"></div>
                           <p class="nhamang">GATE</p>
                           <p class="chietkhau">12.5%</p>
                        </div>
                     </div>
                     <div id="tpb" style="display: none;" class="naptienpc muathepc7">
                        <div class="box_price">
                           <div class="img_pc"><img src="/images/icon_viet_nam.png" alt="Nạp tiền vào ví qua thẻ VIETNAMMOBILE" data-pin-nopin="true"></div>
                           <p class="nhamang">VNM</p>
                           <p class="chietkhau">19.0%</p>
                        </div>
                     </div>
                     <div id="tpb" style="display: none;" class="muathepc muathepc8">
                        <div class="box_price">
                           <div class="img_pc"><img src="/images/icon_ongame.png" alt="Nạp tiền vào ví qua thẻ ONC" data-pin-nopin="true"></div>
                           <p class="nhamang">ONC</p>
                           <p class="chietkhau">20.0%</p>
                        </div>
                     </div>
                     <div id="tpb" style="display: none;" class="muathepc muathepc11">
                        <div class="box_price">
                           <div class="img_pc"><img src="/images/icon_mega.png" alt="Nạp tiền vào ví qua thẻ MGC" data-pin-nopin="true"></div>
                           <p class="nhamang">MGC</p>
                           <p class="chietkhau">11.0%</p>
                        </div>
                     </div>
                     <div id="tpb" style="display: none;" class="muathepc muathepc12">
                        <div class="box_price">
                           <div class="img_pc"><img src="/images/icon_zing.png" alt="Nạp tiền vào ví qua thẻ ZING" data-pin-nopin="true"></div>
                           <p class="nhamang">ZING</p>
                           <p class="chietkhau">19%</p>
                        </div>
                     </div>
                     <div id="vtcc" style="display: none;" class="muathepc muathepc13">
                        <div class="box_price">
                           <div class="img_pc"><img src="/images/icon_vcoin.png" alt="Nạp tiền vào ví qua thẻ VTC" data-pin-nopin="true"></div>
                           <p class="nhamang">VTC</p>
                           <p class="chietkhau">18.75%</p>
                        </div>
                     </div>
                     <div id="bitc" style="display: none;" class="muathepc muathepc15">
                        <div class="box_price">
                           <div class="img_pc"><img src="/images/icon_bit.png" alt="Nạp tiền vào ví qua thẻ BIT" data-pin-nopin="true"></div>
                           <p class="nhamang">BIT</p>
                           <p class="chietkhau">16.0%</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-sl">
               <div class="boxdrpmega">
                  <table rel="" width="100%">
                     <tr id="table_CardAmount">
                        <select id="CardAmount">
                           <option value="0">Mệnh giá thẻ nạp</option>
                        </select>
                     </tr>
                  </table>
               </div>
            </div>
            <div class="form-sl">                
               <input type="text" maxlength="40" autocomplete="off" id="ctrlsoluongthe" name="ctrlsoluongthe" placeholder="Số lượng thẻ cần mua" title="Số lượng thẻ" />
            </div>
            <div class="form-sl">                
               <input type="email" id="ctrlemailaddress" autocomplete="off" name="ctrlemailaddress"  placeholder="Địa chỉ email nhận mã thẻ" title="" />
            </div>
            <div class="form-sl">
               <div class="boxdrpmega">
                  <input type="text" class="txt nochange blur form-control" autocomplete="off"  placeholder="Phương thức thanh toán" size="22" maxlength="40"
                     id="buyCardPaymentMethod" name="buyCardPaymentMethod" title=""/>
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
                                       <input txt="PayCard" rel="buyCardPaymentMethod" value="Paycard" id="buyCardPaymentMethodSelect_member" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethodSelect_member"><img src="/images/paycardvi.png" title="Nạp tiền điện thoại" alt="Nạp tiền điện thoại"></label>
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
                                       <input txt="VietcomBank" rel="buyCardPaymentMethod" value="Vietcombank" id="buyCardPaymentMethodSelect_vcb" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethodSelect_vcb"><img src="/images/vcb.png" alt="VietcomBank" title="VietcomBank"></label>
                                    </li>
                                    <li>
                                       <input txt="Vietinbank" rel="buyCardPaymentMethod" value="Vietinbank" id="buyCardPaymentMethod_ViettinBank" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_ViettinBank"><img src="/images/vtb.png" alt="Vietinbank" title="Vietinbank"></label>
                                    </li>
                                    <li>
                                       <input txt="Đông Á Bank" rel="buyCardPaymentMethod" value="DongABank" id="buyCardPaymentMethod_DongABank" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_DongABank"><img src="/images/DongA.gif" alt="Đông Á Bank" title="Đông Á Bank"></label>
                                    </li>
                                    <li>
                                       <input txt="NCB" rel="buyCardPaymentMethod" value="NCB" id="buyCardPaymentMethod_NCB" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_NCB">
                                       <img src="/images/ncb.png" alt="NCB" title="NCB">
                                       </label>
                                    </li>
                                    <li>
                                       <input txt="AgriBank" rel="buyCardPaymentMethod" value="Agribank" id="buyCardPaymentMethod_AGRIBANK" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_AGRIBANK"><img src="/images/agribank.jpg" alt="AGRIBANK" title="AGRIBANK"></label>
                                    </li>
                                 </ul>
                              </td>
                              <td class="last">
                                 <ul>
                                    <li>
                                       <input txt="Sacombank" rel="buyCardPaymentMethod" value="Sacombank" id="buyCardPaymentMethod_Sacombank" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_Sacombank"><img src="/images/scb.png" alt="Sacombank" title="Sacombank"></label>
                                    </li>
                                    <li>
                                       <input txt="BIDV" rel="buyCardPaymentMethod" value="BIDV" id="buyCardPaymentMethod_bidv" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_bidv"><img src="/images/bidv.jpg" alt="BIDV" title="BIDV"></label>
                                    </li>
                                    <li>
                                       <input txt="Maritimebank" rel="buyCardPaymentMethod" value="MSBank" id="buyCardPaymentMethod_mrt" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_mrt"><img src="/images/maritime.jpg" alt="Maritimebank" title="Maritimebank"></label>
                                    </li>
                                    <li>
                                       <input txt="MBBANK" rel="buyCardPaymentMethod" value="MB" id="buyCardPaymentMethod_MBBANK" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_MBBANK"><img src="/images/mb.png" alt="MBBANK" title="MBBANK"></label>
                                    </li>
                                    <li>
                                       <input txt="VPBANK" rel="buyCardPaymentMethod" value="VPBank" id="buyCardPaymentMethod_VPBANK" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_ACB"><img src="/images/vpb.jpg" alt="VPBANK" title="VPBANK"></label>
                                    </li>
                                 </ul>
                              </td>
                              <td class="last">
                                 <ul>
                                    <li>
                                       <input txt="Ocean Bank" rel="buyCardPaymentMethod" value="ỌB" id="buyCardPaymentMethod_Ojb" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_Ojb"><img src="/images/ocean.png" alt="Ocean Bank" title="Ocean Bank"></label>
                                    </li>
                                    <li>
                                       <input txt="Techcombank" rel="buyCardPaymentMethod" value="Techcombank" id="buyCardPaymentMethod_tcb" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_tcb"><img src="/images/tcb.png" alt="Techcombank" title="Techcombank"></label>
                                    </li>
                                    <li>
                                       <input txt="Nam Á Bank" rel="buyCardPaymentMethod" value="NamABank" id="buyCardPaymentMethod_nab" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_nab"><img src="/images/NamABank.jpg" alt="Nam Á Bank" title="Nam Á Bank"></label>
                                    </li>
                                    <li>
                                       <input txt="EXIMBANK" rel="buyCardPaymentMethod" value="99012" id="buyCardPaymentMethod_EXIMBANK" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_EXIMBANK"><img src="/images/exb.png" alt="EXIMBANK" title="EXIMBANK"></label>
                                    </li>
                                 </ul>
                              </td>
                              <td class="last">
                                 <ul>
                                    <li>
                                       <input txt="HD Bank" rel="buyCardPaymentMethod" value="99011" id="buyCardPaymentMethod_HDBank" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_HDBank"><img src="/images/hdb.png" alt="HD Bank" title="HD Bank"></label>
                                    </li>
                                    <li>
                                       <input txt="TienPhongBank" rel="buyCardPaymentMethod" value="99013" id="buyCardPaymentMethod_tpb" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_tpb"><img src="/images/tpb.jpg" alt="TienPhongBank" title="TienPhongBank"></label>
                                    </li>
                                    <li>
                                       <input txt="OCB" rel="buyCardPaymentMethod" value="99035" id="buyCardPaymentMethod_OCB" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_OCB"><img src="/images/ocb.png" alt="OCB" title="OCB"></label>
                                    </li>
                                    <li>
                                       <input txt="ACB" rel="buyCardPaymentMethod" value="99023" id="buyCardPaymentMethod_ACB" name="buyCardPaymentMethod" type="radio">
                                       <label for="buyCardPaymentMethod_ACB"><img src="/images/acb.png" alt="ACB" title="ACB"></label>
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
               <input type="password" autocomplete="new-password" id="ctrlghichumuathe" value="" name="ctrlghichumuathe" placeholder="Mật khẩu cấp 2" />
            </div>
            <div class="form-sl divmuathe">
               <button type="button" id="ctrlmuathebtn_desktop">Mua thẻ ngay</button>
            </div>
            <div class="info-napthe">
               <?
               if($logger == 0)
               {
               ?>
               <span>* Bạn vui lòng đăng nhập để sử dụng dịch vụ</span>
               <a class="dangkymuathe">Đăng nhập ngay!</a>
               <?
               }
               ?>
            </div>
         </div>
      </form>
   </div>
</div>
<!--popup work start here-->
<!--Preview confirm buy card Start-->
<div class="modal fade" id="buycardpreviewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <label class="txtcon" id="lblprovider"></label>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <label class="control-label col-sm-4">Mệnh giá:</label>
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
                     <label class="control-label col-sm-4">Số tiền thanh toán:</label>
                     <div class="col-sm-7">
                        <label class="txtcon" id="lblsotien"></label>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <label class="control-label col-sm-4">Email nhận mã thẻ:</label>
                     <div class="col-sm-7">
                        <label class="txtcon" id="lblemail"></label>
                     </div>
                  </div>
               </div>
               <div class="row" id="Confirm_OrderDetail">
                  <div class="form-group col-sm-12">
                     <label class="col-sm-offset-4 col-sm-8">
                        <h5>Vui lòng nhập thông tin tài khoản của bạn</h5>
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
                        <input type="email" id="ctrlemailtxt_log" name="ctrlemailtxt_log" class="form-control" placeholder="Địa chỉ Email" value="">
                     </div>
                  </div>
                  <div class="form-group col-sm-12">
                     <label class="control-label col-sm-4" for="ctrlpasstxt_log">Mật khẩu:<span class="asterisk_input"></span></label>
                     <div class="col-sm-7">
                        <input type="password" id="ctrlpasstxt_log" name="ctrlpasstxt_log" class="form-control" placeholder="Mật khẩu" value="">
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
               <button type="button" class="btn btn-primary" id="ctrthanhtoanbtn_desktop" tabindex="1"><i class="fa fa-sign-in"></i> Thanh toán ngay</button>
               <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="2"><i class="fa fa-times"></i>Hủy giao dịch</button>
               <div class="clearfix"></div>
            </div>
         </form>
      </div>
   </div>
</div>
<!--Preview confirm buy card End-->
<!--Show result buy card Start-->
<div class="modal fade" id="buycardshowresultmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="panel panel-primary">
         <div class="panel-heading">
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông báo giao dịch mua mã thẻ</h4>
         </div>
         <form class="form-horizontal" role="form">
            <div class="panel-body">
               <div class="">
                  <div id="notifyresult" class="alertx">
                     <i class="fa sign"></i><strong></strong><span></span>
                  </div>
                  <div class="divresult">
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
                     <div style="padding-top: 20px;"><span>Thời gian giao dịch: <span class="datetransaction"></span></span></div>
                     <span id="xuatexel" class="btn btn-green">Chi tiết mã thẻ</span>
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
<div class="modal fade" id="topupmobieshowresultmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="panel panel-primary">
         <div class="panel-heading">
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-caret-square-o-right"></i>Thông báo giao dịch nạp tiền cho điện thoại</h4>
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
                  <button type="button" class="btn btn-primary" id="ctrcontinuebtn" data-dismiss="modal" tabindex="1"><i class="fa fa-sign-in"></i> Tiếp tục nạp tiền</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
</div>
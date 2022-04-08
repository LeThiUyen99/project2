<?
include("config.php");

$userinfourl=$_SERVER['REQUEST_URI'];

$urluri="/thong-bao-mua-tcoin";
if($userinfourl != $urluri)
{
   header("HTTP/1.1 301 Moved Permanently"); 
   header("Location: $urluri");
   exit();
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Banthe247 - Nạp tiền vào tài khoản</title>
   <meta name="description" content='Bán thẻ cào điện thoại, thẻ game trực tuyến giá rẻ nhất, nạp thẻ cào online nhanh nhất đảm bảo uy tín, đổi thẻ cào sang tiền mặt nhanh với chiết khấu cao.' />
   <meta name="keywords" content='Bán thẻ cào điện thoại, thẻ game trực tuyến giá rẻ nhất, nạp thẻ cào online nhanh nhất đảm bảo uy tín, đổi thẻ cào sang tiền mặt nhanh với chiết khấu cao.' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='https://banthe247.com/thong-bao-mua-tcoin' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="/css/style.min2.css?v=2" />
  <link rel="stylesheet" type="text/css" href="/css/responsive.css?v=3" />  
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/bootstrap-datepicker.js"></script>
  <script src="/js/common.js?v=1"></script>
  <script src="/js/usermanager.js"></script>

  <style type="text/css">
    .nd_tkbank{
      border: dashed 1.5px #ff0000;
      padding: 10px;
    }
  </style>

</head>
<body style="cursor: pointer !important;">
  <!--header section work start-->        
  <? include("../includes/inc_header.php") ?>
  <div class="container">
    <div class="divcontent1"></div>
    <div class="row">

      <div class="col-md-12 noidung_naptien">
        <p class="tt_naptien">Thông tin chi tiết dịch vụ</p>
        <div class="thongtin_naptien">
          <p>Quý khách chọn 1 trong các tài khoản sau để chuyển tiền, tiền sẽ được cộng về tài khoản của quý khách ngay sau 3s</p>
          <p>Chúng tôi có 2 loại tài khoản:</p>
          <p>- Tài khoản cá nhân</p>
          <p>- Tài khoản công ty</p>
          <p>Vì vậy nếu khách hàng có nhu cầu mua thẻ cào với số lượng lớn và được Xuất hóa đơn VAT vui lòng chuyển tiền vào Tài khoản công ty của chúng tôi.</p>
        </div>

        <div class="ly_naptien">
          <p style="font-weight: 500;color: #FF0000;">Lưu ý:</p>
          <p style="color: #444444;">Khi chuyển tiền đến tài khoản của Banthe247.com Quý khách vui lòng điền đúng nội dung chuyển tiền theo cú pháp sau:</p>
          <p style="color: #0098DB;"> [Tài khoản email] - Mua the cao tai web Banthe247.com</p>
        </div>

        <p class="tt_naptien">CÁC SỐ TÀI KHOẢN CỦA BANTHE247.COM</p>

        <div class="tk_naptien">


          <p style="font-weight: 700;color: #444444;">Tài khoản cá nhân</p>
          <div class="ds_bank">
            <a class="nh2"><img src="/images/nh3.png" alt="ngân hàng MSB"></a>
            <a class="nh3"><img src="/images/nh9.png" alt="ngân hàng BIDV"></a>
            <a class="nh4"><img src="/images/nh8.png" alt="ngân hàng VietinBank"></a>
            <a class="nh5"><img src="/images/nh7.png" alt="ngân hàng Agribank"></a>
            <a class="nh6"><img src="/images/nh6.png" alt="ngân hàng Techcombank"></a>
            <a class="nh7"><img src="/images/nh5.png" alt="ngân hàng MB"></a>
            <a class="nh8"><img src="/images/nh4.png" alt="ngân hàng TPBank"></a>
            <a class="nh9"><img src="/images/nh2.png" alt="ngân hàng ACB"></a>
            <a class="nh10"><img src="/images/nh1.png" alt="ngân hàng VietcomBank"></a>
            <a class="nh11"><img src="/images/nh10.jpg" style="border: solid 1px #bababa;" alt="ngân hàng Sacombank"></a>     
            <a class="nh12"><img src="/images/nh11.png" style="border: solid 1px #bababa;" alt="ngân hàng VIB"></a>         
          </div>

          <div>
            <div class="nd_tkbank nh2_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> MSB </p>
              <p><strong>Chủ tài khoản:</strong> Dương Thị Minh Tuyển </p>
              <p><strong>Số tài khoản:</strong> 03501013976108 </p>
              <p><strong>Chi nhánh:</strong> Nam Hà Nội </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web Banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>
            </div>

            <div class="nd_tkbank nh3_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> BIDV </p>
              <p><strong>Chủ tài khoản:</strong> Dương Thị Minh Tuyển </p>
              <p><strong>Số tài khoản:</strong> 21610000462781 </p>
              <p><strong>Chi nhánh:</strong> Hà Nội </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web Banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>
            </div>

            <div class="nd_tkbank nh4_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> Vietinbank </p>
              <p><strong>Chủ tài khoản:</strong> Dương Thị Minh Tuyển </p>
              <p><strong>Số tài khoản:</strong> 103867423326 </p>
              <p><strong>Chi nhánh:</strong> Thanh Xuân - Hà Nội </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web Banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>
            </div>

            <div class="nd_tkbank nh5_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> Agribank </p>
              <p><strong>Chủ tài khoản:</strong> Dương Thị Minh Tuyển </p>
              <p><strong>Số tài khoản:</strong> 1300206354722 </p>
              <p><strong>Chi nhánh:</strong> Thăng Long, Hà Nội </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web Banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>
            </div>

            <div class="nd_tkbank nh6_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> Techcombank </p>
              <p><strong>Chủ tài khoản:</strong> Dương Thị Minh Tuyển </p>
              <p><strong>Số tài khoản:</strong> 19031707022012 </p>
              <p><strong>Chi nhánh:</strong> Nam Hà Nội </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web Banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>
            </div>

            <div class="nd_tkbank nh7_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> MBbank </p>
              <p><strong>Chủ tài khoản:</strong> Dương Thị Minh Tuyển </p>
              <p><strong>Số tài khoản:</strong> 0680117278008 </p>
              <p><strong>Chi nhánh:</strong> Hà Nội </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web Banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>
            </div>

            <div class="nd_tkbank nh8_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> TPbank </p>
              <p><strong>Chủ tài khoản:</strong> Dương Thị Minh Tuyển </p>
              <p><strong>Số tài khoản:</strong> 01818446301 </p>
              <p><strong>Chi nhánh:</strong> Thanh Xuân - Hà Nội </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web Banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>
            </div>

            <div class="nd_tkbank nh9_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> ACB </p>
              <p><strong>Chủ tài khoản:</strong> Dương Thị Minh Tuyển </p>
              <p><strong>Số tài khoản:</strong> 245415299 </p>
              <p><strong>Chi nhánh:</strong> Hà Nội </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web Banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>
            </div>

            <div class="nd_tkbank nh10_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> Vietcombank </p>
              <p><strong>Chủ tài khoản:</strong> Dương Thị Minh Tuyển </p>
              <p><strong>Số tài khoản:</strong> 0301000383905 </p>
              <p><strong>Chi nhánh:</strong> Hoàn Kiếm, Hà Nội </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web Banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>
            </div>
            <div class="nd_tkbank nh11_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> Sacombank </p>
              <p><strong>Chủ tài khoản:</strong> Dư Thị Nhạn </p>
              <p><strong>Số tài khoản:</strong> 020085965000 </p>
              <p><strong>Chi tiết:</strong> phòng giao dịch Định Công- chi nhánh Hoàng Mai </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>                 
            </div>   
            <div class="nd_tkbank nh12_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Tên ngân hàng:</strong> VIB </p>
              <p><strong>Chủ tài khoản:</strong> Dư Thị Nhạn </p>
              <p><strong>Số tài khoản:</strong> 019704060197072 </p>
              <p><strong>Chi tiết:</strong> chi nhánh Hà Đông - Hà Nội </p>
              <p><strong>Nội dung chuyển tiền:</strong> [Tài khoản email] - Mua the cao tai web banthe247.com </p>
              <p style="font-size: 15px;font-style: italic;color: #0098DB">Ngay sau 3s quý khách sẽ được cộng tiền vào tài khoản trên banthe247.com để giao dịch</p>                 
            </div>                        
          </div>


          <p style="font-weight: 700;color: #444444;margin-top: 20px;">Tài khoản công ty</p>
          <div class="ds_bank">
            <a class="nh1"><img src="/images/nh3.png" alt="ngân hàng MSB"></a>

            <div class="nd_tkbank nh1_active">
              <p style="color: #0098DB;font-weight: 700;">Nội dung tài khoản:</p>
              <p><strong>Liên hệ:</strong> 0972.022.116 hoặc 1900633682 ấn phím 2 hoặc Chatbox <span onclick="javascript:void(Tawk_API.toggle())" style="position: unset;"><img src="/images/nt1.png" width="30" ></span></p>              
            </div>

          </div>


        </div>

        <p class="tt_naptien" style="margin: 20px 0px;">SAU KHI CHUYỂN TIỀN THÀNH CÔNG QUÝ KHÁCH HÀNG VUI LÒNG GỬI THÔNG BÁO CHUYỂN TIỀN CHO HỆ THỐNG THEO MỘT TRONG CÁC CÁCH SAU</p>

        <div class="col-md-3 tbnt nt1">
          <a class="show_modal_tbnt">Gửi thông báo nạp tiền</a>
        </div>

        <div class="col-md-3 tbnt nt2">
          <a href="javascript:void(Tawk_API.toggle())" >Thông báo trên Chatbox</a>
        </div>

        <div class="col-md-3 tbnt nt3">
          <a rel="nofollow" href="skype:live:binhminhmta123?chat">Thông báo qua Skype</a>
        </div>

        <div class="col-md-3 tbnt nt4">
          <a>Thông báo qua Hotline</a>
        </div>                

      </div>



      <div class="modal_tbnt">
        <div class="modal_content">
            <p>Thông báo nạp tiền</p>
            <button type="button" class="close_button">X</button>
        <form class="form-horizontal" role="form">

            <div class="col-md-6">
              <!-- Ngân hàng nhận tiền-->
              <div class="form-group">
                  <label class=" col-sm-12" for="ddlReceiveBank">Ngân hàng nhận tiền:<span class="asterisk_input"></span></label>
                  <div class="col-sm-12">
                      <select id="ddlReceiveBank" class="form-control" tabindex=8>
                          <option value="4" data-id="vcb">Vietcombank</option>
                          <option value="5" data-id="tcb">Techcombank</option>
                          <option value="3" data-id="vtb">Vietinbank</option>
                          <option value="1" data-id="agb">Agribank</option>

                          <option value="13" data-id="tpb">Maritimebank</option>
                          <option value="6" data-id="achau">Á Châu</option>
                          <option value="9" data-id="tech">TienPhongBank</option>

                          <option value="33" data-id="mb">MBbank</option>
                          <option value="2" data-id="bidv">BIDV</option>

                      </select>
                  </div>
              </div>

              <!--Hình thức chuyển tiền: -->
              <div class="form-group">
                  <label class=" col-sm-12" for="ddlTransferType">Hình thức chuyển tiền:<span class="asterisk_input"></span></label>
                  <div class="col-sm-12">
                      <select id="ddlTransferType" class="form-control" tabindex=2>
                          <option selected="selected" value="0">Hình thức chuyển tiền</option>
                          <option value="1">Chuyển khoản tại cây ATM</option>
                          <option value="2">Chuyển khoản qua Internetbanking</option>
                          <option value="3">Nộp tiền mặt hoặc ủy nhiệm chi tại ngân hàng</option>
                          <option value="4">Nộp tiền mặt tại banthe247.com</option>

                      </select>
                  </div>
              </div>

              <!-- Tên người chuyển tiền-->
              <div class="form-group">
                  <label class=" col-sm-12" for="txtCustomerName">Tên người chuyển tiền:<span class="asterisk_input"></span></label>
                  <div class="col-sm-12">
                      <input type="text" id="txtCustomerName" name="txtCustomerName" class="form-control" placeholder="Tên người chuyển tiền" value="" tabindex=5>
                  </div>
              </div>

              <!-- Thời gian chuyển tiền:-->
              <div class="form-group">
                  <label class="col-sm-12" for="txtTransferDate">Thời gian chuyển tiền:<span class="asterisk_input"></span></label>
                  <div class="input-group col-sm-12" style="padding: 0 15px;">
                      <input type="text" class="form-control" id="txtTransferDate" placeholder="Ngày/Tháng/Năm" readonly tabindex=7>
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  </div>
              </div>

            </div>

            <div class="col-md-6">
              <!-- Số TCoin đặt mua-->
              <div class="form-group">
                  <label class="col-sm-12" for="txtAmount">Số tiền nạp:<span class="asterisk_input"></span></label>
                  <div class="col-sm-12">
                      <input type="text" id="txtAmount" name="txtAmount" class="form-control" placeholder="Số tiền nạp" value="" tabindex=1 onkeypress=" return isNumberKey(event)">
                  </div>
              </div>

              <!--Ngân hàng chuyển tiền: -->
              <div class="form-group">
                  <label class=" col-sm-12" for="ddlTransferBank"> Ngân hàng chuyển tiền:<span class="asterisk_input"></span></label>
                  <div class="col-sm-12">
                      <select id="ddlTransferBank" class="form-control" tabindex=3>
                          <option selected="selected" value="0">Ngân hàng chuyển tiền</option>
                          <option value="Vietcombank">Vietcombank</option>
                          <option value="Techcombank">Techcombank</option>
                          <option value="Tienphongbank">Tienphongbank</option>
                          <option value="Agribank">Agribank</option>
                          <option value="Viettinbank">Viettinbank</option>
                          <option value="ACB">ACB</option>
                          <option value="BIDV">BIDV</option>
                          <option value="Đông Á">Đông Á</option>
                          <option value="Maritimebank">Maritimebank</option>
                          <option value="Sacombank">Sacombank</option>
                          <option value="MBank">MBank</option>
                          <option value="Other">Ngân hàng khác</option>
                      </select>
                  </div>
              </div>


              <!-- Số tài khoản chuyển tiền:-->
              <div class="form-group">
                  <label class="col-sm-12" for="txtCustomerBN">Số tài khoản chuyển tiền:<span class="asterisk_input"></span></label>
                  <div class="col-sm-12">
                      <input type="text" id="txtCustomerBN" name="txtCustomerBN" class="form-control" placeholder="Số tài khoản chuyển tiền" value="" tabindex=6>
                  </div>
              </div>

              <!-- Nội dung chuyển tiền:-->
              <div class="form-group">
                  <label class="col-sm-12" for="txtCustomerBN">Nội dung chuyển tiền:<span class="asterisk_input"></span></label>
                  <div class="col-sm-12">
                      <input type="text" id="txtToBankName" name="txtToBankName" class="form-control" placeholder="Nội dung chuyển" value="" tabindex=6>
                  </div>
              </div>
            </div>            
            



            <div class="form-group">
                <div class="col-sm-offset-9 col-sm-3">
                    <button type="button" id="btnSendthongbaoTCoin" class="btn btn-primary btn-block" tabindex=9>GỬI THÔNG BÁO</button>
                </div>
            </div>
        </form>
        </div>
      </div>


      <div class="modal_thtc">
        <div class="modal_content">
          <button type="button" class="close_button">X</button>
          <p class="thtc">THÔNG BÁO NẠP TIỀN CỦA QUÝ KHÁCH ĐÃ DƯỢC GỬI THÀNH CÔNG! CÁM ƠN QUÝ KHÁCH ĐẢ TIN TƯỞNG VÀ SỬ DỤNG DỊCH VỤ CỦA BANTHE247.COM</p>

          <img src="/images/nt5.png">

        </div>
      </div>


    </div>
  </div>
   
  
          <script>
            $(document).ready(function () {
                var hc = new TCoin();
                hc.init();
            });
            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if (charCode == 59 || charCode == 46)
                    return true;
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }

            $('.ds_bank a').click( function(){
              $('.ds_bank a').removeClass('active');
              var a = $(this).attr('class');              
              $('.nd_tkbank').hide();
              $('.'+ a +'_active').show();

              var position = $('.'+ a +'_active').offset().top - 20;
              $("body, html").animate({
                scrollTop: position
              }, 700 );

              $(this).addClass('active');
            });

            $('.close_button').click(function(){
              $('.modal_tbnt,.modal_thtc').hide();
            });

            $('.show_modal_tbnt').click(function(){
              $('.modal_tbnt').show();
            });    
    
            $('.nh2_active').show();
            $('.nh2').addClass('active');
        </script>
      <!--right section work end-->  
      </div>
   </div>
   <? include("../includes/inc_footer.php") ?>
</body>
</html>
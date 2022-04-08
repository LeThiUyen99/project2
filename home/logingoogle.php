<?
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Đăng ký tài khoản tại Doithe66.com</title>
   <meta name="description" content='Đăng k&#253; t&#224;i khoản để sử dụng dịch vụ đổi thẻ c&#224;o th&#224;nh tiền mặt t&#224;i Doithe66.com, Uy t&#237;n  Nhanh ch&#243;ng - Tiết kiệm' />
   <meta name="keywords" content='Đăng k&#253; t&#224;i khoản, đổi thẻ c&#224;o điện thoại th&#224;nh tiền mặt, đổi thẻ c&#224;o th&#224;nh tiền mặt' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="doithe66.com" />
   <meta name="google-site-verification" content="aUx6ZWFKAWgafQ1QMy6iAhA6aqaiQpet7LOH2MZ8UMk" />
   <link rel="canonical" href='https://doithe66.com/' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
   <link href="/css/grid-0.4.3.min.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="/css/site.css" />
   <link rel="stylesheet" type="text/css" href="/css/common.css?v=5" />
   <script src="/js/jquery-1.9.1.js"></script>
   <script src="/js/bootstrap.min.js"></script>    
   <script src="/js/bootstrap-datepicker.js"></script>    
   <script src="/js/grid-0.4.3.min.js" type="text/javascript"></script>   
   <script type="text/javascript" src="/js/crawler.js"></script>
   <script src="/js/Trans.js"></script>
   <script src="/js/usermanager.js?v=6"></script>
   <script src="/js/common.js"></script>
   <script src="/js/date.format.js"></script>
   <script type="text/javascript" src="/js/jquery.slicknav.js"></script>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   <? include("../includes/inc_header.php") ?>
   <div class="container mid_content">
      <div id="boxLoading" style="display:none;">
         <div class="overlay"></div>
         <div class="boxLoading">Working..</div>
      </div>
      <div>
         <div style="float:left;width:100%;">
            <div class="container">

<div class="full-register">
   <div style="padding:0px 40px 10px 40px;">
    <h2>Cập nhật mật khẩu cho tài khoản tại doithe66.com</h2>
    <div>
        <form class="form-signin" role="form">
            <div id="status"></div>
            <div class="form-group" style="overflow:hidden;">
                <label for="inputPassword" class="control-label col-sm-3" style="font-size:14px; font-weight:bold;">Mật khẩu mới</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" autocomplete="off">
            </div>
            <div class="form-group" style="overflow:hidden;">
                <label for="inputPassword" class="control-label col-sm-3" style="font-size:14px;font-weight:bold;">Nhập lại mật khẩu</label>

                <input type="password" id="RePassword" class="form-control" placeholder="Nhập lại Password" required="required" autocomplete="off">
            </div>
            <div class="form-group" style="overflow:hidden;">
                <label for="inputPassword" class="control-label col-sm-3" style="font-size:14px; font-weight:bold;">Mật khẩu cấp 2</label>
                <input type="password" id="inputPassword2" class="form-control" placeholder="Password" required="required" autocomplete="off">
            </div>
            <div class="form-group" style="overflow:hidden;">
                <label for="inputPassword" class="control-label col-sm-3" style="font-size:14px;font-weight:bold;">Nhập lại mật khẩu cấp 2</label>

                <input type="password" id="RePassword2" class="form-control" placeholder="Nhập lại Password" required="required" autocomplete="off">
            </div>
            <div class="alert alert-warning"><p>Mật khẩu cấp 2 dùng để sử dụng khi bạn mua mã thẻ, nạp tiền điện thoại, rút tiền</p></div>
            <br />
            <button type="button" id="btnlogingooglesuccess" class="btn btn-primary">Xác nhận</button>
        </form>
        </div>
    </div>
</div>

               </div>
            </div>
         </div>
      </div>
   </div>
   <? include("../includes/inc_footer.php") ?>
                  <script>
    $(document).ready(function () {
       
        $('#btnlogingooglesuccess').on("click", function () {
            if (vali_logingoogle()) {
                var pass = $('#inputPassword').val();
                var pass2 = $('#inputPassword2').val();
                var adata = { passwordnew: pass, passwordnew2: pass2 };
                
                $.ajax({
                    url: "/successlogingoogle",
                    type: 'POST',
                    data: adata,
                    dataType:'json',
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (data) {
                        if (data.errorCode == 1) {                            
                        window.location.href = "/";
                    
                } else {
                    alert("Lỗi đăng nhập google");
                    
                }
            },
            error: function () {
                alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                
            },
            complete: function () {
                $("#boxLoading").hide();
            }
        });
            }
            
        });
        function vali_logingoogle()
        {
            var flag = true;
            var pass = $("#inputPassword").val();
            var repass = $("#RePassword").val();
            
            if (checkPassword(pass, $('#inputPassword')) == 1) {
                flag = false;
            }
            if (checkPassword(repass, $('#RePassword')) == 1) {
                flag = false;
            }

            if (checkPassword(pass, $('#RePassword')) == 0 && pass != repass) {
                $($('#inputPassword')).tooltip('hide').attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            }
            var pass2 = $("#inputPassword2").val();
            var repass2 = $("#RePassword2").val();

            if (checkPassword(pass2, $('#inputPassword2')) == 1) {
                flag = false;
            }
            if (checkPassword(repass2, $('#RePassword2')) == 1) {
                flag = false;
            }

            if (checkPassword(pass2, $('#RePassword2')) == 0 && pass2 != repass2) {
                $($('#inputPassword2')).tooltip('hide').attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            }
            return flag;
        }
    });
    </script>
</body>
</html>
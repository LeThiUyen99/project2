<?
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Thay đổi mật khẩu mới</title>
   <meta name="description" content='Thay đổi mật khẩu' />
   <meta name="keywords" content='Thay đổi mật khẩu' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='https://banthe247.com/' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
  <link rel="stylesheet" type="text/css" href="/css/responsive.css" />  
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/common.js"></script>
  <script src="/js/usermanager.js"></script>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   <? include("../includes/inc_header.php") ?>
   <div class="container">
   <div class="divcontent1"></div>
   <script type="text/javascript">
                        $(document).ready(function () {
                            function getParameterByName(name, url) {
                                if (!url) url = window.location.href;
                                name = name.replace(/[\[\]]/g, "\\$&");
                                var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                                    results = regex.exec(url);
                                if (!results) return null;
                                if (!results[2]) return '';
                                return decodeURIComponent(results[2].replace(/\+/g, " "));
                            }
                            var c = getParameterByName('c');
                            var u = getParameterByName('u');
                            $('#ctrlbtnchangpasstpass1').click(function () {
                                if (valinewpass()){
                                    var newpass = $("#new_pass").val();
                                    $.ajax({
                                        url: "/user/updatenewpass",
                                        type: 'POST',
                                        data: { c: c, u: u,newpass:newpass },
                                        dataType: 'json',
                                        beforeSend: function () {
                                            $("#boxLoading").show();
                                        },
                                        success: function (obj) {
                                            if (obj.Success == true ) {
                                                alert(obj.message);
                                                window.location.href = "/";
                                            }  else {
                                                alert(obj.message);
                                                window.location.href = "/";
                                            }
                                        },
                                        error: function (obj) {
                                            alert('Có l?i x?y ra. Vui lòng th? l?i sau!');
                                        },
                                        complete: function () {
                                            $("#boxLoading").hide();
                                        }
                                    });
                                };
                            });
                            function valinewpass() {
                                var flag = true;
                                var newpass = $("#new_pass").val();
                                var renewpass = $("#repeat_new_pass").val();
                                if (checkPassword(newpass, $('#new_pass')) == 1) {
                                    flag = false;
                                }
                                if (checkPassword(renewpass, $('#repeat_new_pass')) == 1) {
                                    flag = false;
                                }
                                if (checkPassword(newpass, $('#new_pass')) == 0 && checkPassword(renewpass, $('#repeat_new_pass')) == 0 && newpass != renewpass) {
                                    $($('#repeat_new_pass')).tooltip('hide').attr('title', 'Nh?p l?i m?t kh?u không phù h?p').tooltip('fixTitle').addClass('errorClass');
                                    flag = false;
                                }
                                return flag;
                            }
                        });
                     </script>
      <div class="row">
      <div class="col-md-8 col-xs-12 main-tintuc-left">
        <h2>Thay đổi mật khẩu</h2>
                     
                     <form class="form-horizontal" role="form">
                        <div class="alert alert-danger" id="divnotify">
                           <i class="fa fa-info-circle fa-lg"></i>
                           <span></span>
                        </div>
                        <div class="form-group">
                           <label for="new_password" class="col-sm-2 control-label">Mật khẩu mới<span class="asterisk_input"></span></label>
                           <div class="col-sm-6">
                              <input type="password" name="new_pass" class="form-control" id="new_pass" placeholder="Mật khẩu mới" autocomplete="off" tabindex="2" title=""/>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="repeat_new_password" class="col-sm-2 control-label">Xác nhận mật khẩu mới<span class="asterisk_input"></span></label>
                           <div class="col-sm-6">
                              <input type="password" name="repeat_new_pass" class="form-control" id="repeat_new_pass" placeholder="Xác nhận mật khẩu mới" autocomplete="off" tabindex="3" title=""/>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-offset-2 col-sm-6">
                              <button type="button" class="btn btn-primary" tabindex="4" id="ctrlbtnchangpasstpass1">
                              Thay đổi mật khẩu
                              &nbsp; <i class="icon ion-log-in"></i>
                              </button>
                           </div>
                        </div>
                     </form>
      </div>
      <? include("../includes/inc_tin_tuc_right.php") ?>
      </div>
      
   </div>
   <? include("../includes/inc_footer.php") ?>
</body>
</html>
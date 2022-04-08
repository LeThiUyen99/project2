<?
include("config.php");
if($logger != 1)
{
   redirect("/");
}
$userinfourl=$_SERVER['REQUEST_URI'];
$userinfourl=parse_url("https://doithe66.com".$userinfourl, PHP_URL_PATH);

$urluri="/user/changenewpassii";
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
   <title>Đổi mật khẩu cấp 2 | Doithe66.com</title>
   <meta name="description" content='Dịch vụ đổi thẻ trực tuyến - Đổi thẻ cào thành tiền mặt uy tín nhất, mức phí thấp nhất - Tiết kiệm - Nhanh chóng - An toàn. Hỗ trợ 24/7' />
   <meta name="keywords" content='doi the cao thanh tien, doi the cao, đổi thẻ cào, thu mua thẻ cào, thu mua the cao, đổi thẻ đện thoại, doi the dien thoai' />
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
          <? include("../includes/inc_box_center.php");?>  
          <div class="container">
              <div class="login_success">              
                    <div class="main_sc">
                        <div class="right_sc">
                            <div class="doimatkhaucap2">
                                <h1>Thông tin mật khẩu cấp 2 mới</h1>
                                <form class="form-horizontal" role="form">
                                    <div class="alert alert-danger" id="divnotify">
                                        <i class="fa fa-info-circle fa-lg"></i>
                                        <span></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password" class="col-sm-2 control-label">Mật khẩu mới<span class="asterisk_input"></span></label>
                                        <div class="col-sm-6">
                                            <input type="password" name="new_pass" class="form-control" id="new_pass" placeholder="Mật khẩu mới" autocomplete="off" tabindex=2 title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="repeat_new_password" class="col-sm-2 control-label">Xác nhận mật khẩu mới<span class="asterisk_input"></span></label>
                                        <div class="col-sm-6">
                                            <input type="password" name="repeat_new_pass" class="form-control" id="repeat_new_pass" placeholder="Xác nhận mật khẩu mới" autocomplete="off" tabindex=3 title="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-6">
                                            <button type="button" class="btn btn-primary" tabindex="4" id="ctrlbtnchangpasstopass">
                                                Thay đổi mật khẩu
                                                &nbsp; <i class="icon ion-log-in"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>                   
                        </div>
                        <? include("../includes/inc_right_history.php"); ?>
                    </div>
              </div>
                
          </div>
          
      <!--right section work end-->  
      </div>
   </div>
   <? include("../includes/inc_footer.php") ?>
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
        $('#ctrlbtnchangpasstopass').click(function () {
            if (valinewpass()) {
                    
                var newpass = $("#new_pass").val();
                $.ajax({
                    url: "/user/postupdatenewpassii",
                    type: 'POST',
                    data: { c: c, u: u, newpass: newpass },
                    dataType: 'json',
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (obj) {
                        if (obj.Success == true) {
                            alert("bạn đã đổi mật khẩu mới thành công");
                            window.location.href = "/";
                        } else {
                            alert("đổi mật khẩu cấp 2 thất bại");
                            window.location.href = "/";
                        }

                    },
                    error: function (obj) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
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
                $($('#repeat_new_pass')).tooltip('hide').attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('fixTitle').addClass('errorClass');
                flag = false;
            }

            return flag;
        }
    });
</script>
</body>
</html>
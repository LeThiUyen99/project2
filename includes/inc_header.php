  <header>
    <div class="container">
      <div class="navbar">
        <div class="boxlogin col-md-3  pull-right">
          <ul>
            <? if($logger == 1){
            $arrkhadung = GetSoDuByUserId($lg_userid);
            $khaDung = $arrkhadung['KhaDung'];
            $logger = 1;
            ?>
            <li class="list-box dropdown" id="litaikhoan">
              <a rel="nofollow" id="drop7" href="#" role="button" class="btnc dropdown-toggle white" data-toggle="dropdown">
                <span style="color:#337ab7;font-size:12px;">(Tài khoản: </span>
                <span style="color:#337ab7;font-size:12px;"><b> <?= number_format($khaDung) ?></b> )</span> <i class="fa fa-user"></i> <b><?= $lg_userinfo['FullName'] ?></b> </a>
              <ul class="dropdown-menu server-activity">
                <li><a rel="nofollow" href="/user/lichsumuathe"><i class="fa fa-user"></i>Lịch sử giao dịch</a></li>
                <li> <a rel="nofollow" href="/user/index" title="Thay đổi mật khẩu"><i class="fa fa-user"></i>Thay đổi mật khẩu</a> </li>
                <li> <a rel="nofollow" href="#logout" id="logoutbtn" title="Đăng xuất"><i class="fa fa-sign-out"></i> Đăng xuất</a> </li>
              </ul>
            </li>
            <? }else{ ?>
            <li id="lidangnhap"><a href="#" rel="nofollow" data-toggle="modal" data-target="#signin" class="btnc"><span style="color:#FFF;">Đăng nhập</span></a></li>
            <li id="lidangky"><a href="/User/register" class="btnc " rel="nofollow"><span style="color:#FFF;">Đăng ký</span></a></li>
            <? } ?>
          </ul>
        </div>
        <div class="logo col-md-2">
          <a href="/" class="navbar-brand" rel="nofollow" title="Website Mua thẻ điện thoại và nạp tiền điện thoại">
            <img src="/images/logo.png" alt="banthe24h.vn" />
          </a></div>
        <div class="col-md-7 col-xs-12 menu-mobi">
          <div class="navbar navbar-default theme_navigation main-menu">
            <div class="row">
              <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <div class="navbar-collapse collapse" id="navbar-main">
                  <ul class="nav navbar-nav">
                    <li class="mtdt"><a href="/tien-ich/mua-the-dien-thoai" title="mua thẻ điện thoại">Mua thẻ điện thoại</a></li>
                    <li class="mtg"><a rel="nofollow" href="/tien-ich/mua-the-game" title="mua thẻ game">Mua thẻ game</a></li>
                    <li class="ntdt"><a rel="nofollow" href="/tien-ich/nap-tien-dien-thoai" title="nạp tiền điện thoại">Nạp tiền điện thoại</a></li>
                    <li class="nt"><a rel="nofollow" href="/thong-bao-mua-tcoin" title="Nạp tiền">Nạp tiền</a></li>
                    <li class="ct"><a rel="nofollow" href="/chiet-khau" title="chiết khấu">Chiết khấu</a></li>
                    <li class="dropdown tt"> <a rel="nofollow" class="dropdown-toggle" title="Tin tức" data-toggle="dropdown">Tin tức</a>
                      <ul class="dropdown-menu theme_nav_dropdown">
                        <li><a rel="nofollow" href="/tin-tuc-1.html" title="Tin tức">Tin tức chung</a></li>
                        <li><a rel="nofollow" href="/huong-dan-8.html" title="Hướng dẫn">Hướng dẫn</a></li>
                        <li class="nt"><a rel="nofollow" href="/thong-bao-mua-tcoin" title="Nạp tiền">Nạp tiền</a></li>
                        <li class="mtdt"><a href="/tien-ich/mua-the-dien-thoai" title="mua thẻ điện thoại">Mua thẻ điện thoại</a></li>
                        <li class="mtg"><a rel="nofollow" href="/tien-ich/mua-the-game" title="mua thẻ game">Mua thẻ game</a></li>
                        <li><a rel="nofollow" href="/app-tro-choi-1015.html" title="Game app">App trò chơi</a></li></li>
                        <!-- <li><a rel="nofollow" href="/chuyen-muc-hoi-dap" title="hỏi đáp">Hỏi đáp</a></li>
                        <li><a rel="nofollow" href="/tin-tuc/gioi-thieu-ve-cong-ty-cp-thanh-toan-hung-ha-3047.html" title="Giới thiệu"><strong>Giới thiệu</strong></a></li> -->
                      </ul>
                    </li>
                    <li class="dropdown"> <a rel="nofollow" class="dropdown-toggle" title="Shop" data-toggle="dropdown">Shop</a>
                      <ul class="dropdown-menu theme_nav_dropdown">
                      <li class="ct"><a rel="nofollow" href="/may-in-the-cao" title="Máy in thẻ cào">Máy in thẻ cào</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <script>
    function myFunction() {
      var x = document.getElementById("navbar-main");
      if (x.className === "navbar-main") {
        x.className += " responsive";
      } else {
        x.className = "navbar-main";
      }
    }
  </script>
  <!--Login Start-->
  <div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-times"></i></span><span class="sr-only">Close</span></button>
          <div style="font-weight: bold;" class="modal-title" id="myModalLabel"><i class="fa fa-sign-in"></i> Đăng nhập</div>
        </div>
        <form id="sign_in" role="form" action="/user" method="POST">
          <div class="panel-body">
            <div class="form-group">
              <label for="ctrlusername"> Tên đăng nhập </label>
              <input type="text" name="ctxt_username" id="ctrlusername" class="form-control" placeholder="Tên đăng nhập"> </div>
            <div class="form-group">
              <label for="ctrlpass">Mật khẩu</label>
              <input type="password" name="txt_pass" id="ctrlpass" class="form-control"> </div>
            <div class="form-group">
              <button type="button" class="btn btn-primary" id="ctrlloginbtn" tabindex="3"><i class="fa fa-sign-in"></i> Đăng nhập</button> <a rel="nofollow" href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotyourpassword">Quên mật khẩu?</a> </div>
          </div>
          <div class="panel-footer"> <a rel="nofollow" class="pull-right" rel="nofollow" href="/User/register"><i class="fa fa-share-square-o"></i> Bạn chưa có tài khoản? Đăng ký ngay</a>
            <div class="clearfix"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Login End-->

  <!--forgot your password-->
  <div class="modal fade" id="forgotyourpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-times"></i></span><span class="sr-only">Close</span></button>
          <div style="font-weight: bold;" class="modal-title" id="myModalLabel"><i class="fa fa-sign-in"></i> Quên mật khẩu?</div>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label> Địa chỉ Email </label>
            <input type="email" class="form-control" placeholder="Email" id="ctrlforgotemailtxt" name="txt_forgotemail" required="required" tabindex="1" /> </div>
          <div class="form-group">
            <button type="button" id="ctrlforgotpassbtn" class="btn btn-primary" tabindex="2"><i class="fa fa-sign-in"></i> Gửi lại mật khẩu </button>
          </div>
          <div class="form-group" id="Forgot_reply" style="color:#F36"> </div>
        </div>
        <div class="panel-footer">
          <button type="button" class="btn btn-primary pull-right" data-dismiss="modal" data-toggle="modal" data-target="#signin"><i class="fa fa-sign-in"></i> Đăng nhập</button>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  <!--forgot your password End-->
  <!--modal info your password start-->
  <div id="modalinfo" tabindex="-1" role="dialog" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-md">
      <div class="panel panel-primary">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">x</button> <span></span> </div>
        <div class="modal-body">
          <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-default">Đóng</button>
        </div>
      </div>
    </div>
  </div>
  <!--forgot your password end-->
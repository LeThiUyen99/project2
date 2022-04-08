<?
$userinfourl=$_SERVER['REQUEST_URI'];
$active="";

 ?>
<div class="box_center">
            <div class="container">
               <div class="col-lg-offset-3 col-md-9 actionhome">
                    <? 
                    if($userinfourl=="/rut-tien"){
                    ?>
                  <a class="btn active2" href="/rut-tien">Rút tiền</a>
                  <? }else{ ?>
                    <a class="btn" href="/rut-tien">Rút tiền</a>
                  <? } ?>
                  <? 
                    if($userinfourl=="/chuyen-tien-tu-dong"){
                    ?>
                  <a class="btn active2" href="/chuyen-tien-tu-dong">Chuyển tiền</a>
                  <? }else { ?>
                  <a class="btn" href="/chuyen-tien-tu-dong">Chuyển tiền</a>
                  <? } ?>
                   <? 
                    if($userinfourl=="/tai-khoan-ngan-hang"){
                    ?>
                  <a class="btn active2" href="/tai-khoan-ngan-hang">Tài khoản ngân hàng</a>
                  <? }else { ?>
                  <a class="btn" href="/tai-khoan-ngan-hang">Tài khoản ngân hàng</a>
                  <? } ?>
                  <!--<a class="btn" href="/user/lichsudoithe">Lịch sử</a>-->
               </div>
            </div>
         </div>
         <br />
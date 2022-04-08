<footer>
 <div class="foter_first">
   <div class="container">
     <?
$db_qr = new db_query("SELECT * FROM `newstable` WHERE Type = '300' AND IsActive='1'");
if(mysql_num_rows($db_qr->result) > 0)
    {
        $row=mysql_fetch_assoc($db_qr->result);
?>
<div style="float:left;width:100%;">
            <?=$row['Description']?>
        </div>
<?  }
?>
 </div>
</div>
<div class="foter_bottom"> <div class="footer_nav"> <div class="container"> <div class="row"> <div class="col-sm-4"><i class="fa fa-smile-o"></i> Mua thẻ cào nhanh chóng, tiện lợi</div> <div class="col-sm-4"><i class="fa fa-usd"></i> Thanh toán an toàn, tiết kiệm</div> <div class="col-sm-4"><i class="fa fa-lock"></i> Bảo mật SSL</div> </div> </div> </div> <div class="container"> <div class="row"> <div class="col-lg-12"> <span class="text-theme copyrightft"> Copyright © 2015 <a rel="nofollow" href="https://banthe247.com">Banthe247.com</a> </span> </div> </div> </div> </div>
</footer>
<script>
$(function () {
var url = window.location.href;
     $("#navbar-main li").removeClass("active");

     $("#navbar-main a").each(function () {


         if (url == (this.href)) {
             $(this).closest("a").addClass("active");
             $(this).closest("li").parents('li').addClass("active");
         }
     });
     });
</script>

	
<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131300376-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131300376-1');
</script>



<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/56af2e95bc9315005c21aebc/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
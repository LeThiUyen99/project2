<div class="topfooter">
  <div class="container">
    <div class="banksupport"><span>Hỗ trợ thanh toán</span></div>
    <p> <img src="/images/vcb.png" alt="Vietcombank" /> <img src="/images/scb.png" alt="sacombank" /> <img src="/images/ocean.png" alt="Oceanbank" /> <img src="/images/hdb.png" alt="hdbank" /> <img src="/images/vib.png" alt="vibbank" /> <img src="/images/bidv.jpg" alt="bidv" /> <img src="/images/tcb.png" alt="techcombank" /> <img src="/images/vnmart.gif" alt="vnmart" /> <img src="/images/DongA.gif" alt="dongabank" /> <img src="/images/maritime.jpg" alt="maritimebank" /> <img src="/images/NamABank.jpg" alt="namabank" /> <img src="/images/tpb.jpg" alt="tienphongbank" /> </p>
  </div>
</div>
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
        <?= $row['Description'] ?>
      </div>
      <?  }
?>
    </div>
  </div>

</footer>
<script>
  $(function() {
    var url = window.location.href;
    $("#navbar-main li").removeClass("active");

    $("#navbar-main a").each(function() {


      if (url == (this.href)) {
        $(this).closest("a").addClass("active");
        $(this).closest("li").parents('li').addClass("active");
      }
    });
  });
</script>
<script async src="//www.googletagmanager.com/gtag/js?id=UA-127078672-1"></script>
<script defer>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-127078672-1');
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139150820-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-139150820-1');
</script>



<!--Start of Tawk.to Script-->
<script type="text/javascript" defer>
  var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date();
  (function() {
    var s1 = document.createElement("script"),
      s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/5764b867b57c050020956358/default';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  })();
</script>
<!--End of Tawk.to Script-->
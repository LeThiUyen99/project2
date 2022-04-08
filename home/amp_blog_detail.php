<?
include("config.php");
$newid = getValue("newid", "int", "GET", 0);
$newid = (int)$newid;

if ($newid > 0) {
    $db_qr1 = new db_query("SELECT Id,articles.categoryid,link_canonical,new_tdgy,new_ndgy,link_301,ImageUrl,Intro,articles.Description,Title,categoryname,ShortTitle,articles.Meta,PublicDate,articles.MetaDesc
                                         FROM articles 
                                         LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                         WHERE IsActive = 1 AND id = $newid");
    if (mysql_num_rows($db_qr1->result) > 0) {

        $row1 = mysql_fetch_assoc($db_qr1->result);
        if ($row1['ShortTitle'] != NULL) {
            $urlshort = $row1['ShortTitle'];
        } else {
            $urlshort = $row1['Title'];
        }
        $urlcano = $urlwebsite . rewrite_news($newid, $urlshort, $row1['categoryname']);
        $userinfourl = $_SERVER['REQUEST_URI'];

        $src = $row1['ImageUrl'];
        if (strpos($row1['ImageUrl'], '/upload/') === false) {
            $src = "https://banthe24h.vn/pictures/news/" . $row1['ImageUrl'];
        }

        $urlfull = $urlwebsite . $userinfourl;

    }
}

// Dữ liệu cho tin khác
$db_qrnew = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.CategoryID
                            WHERE IsActive = 1 AND articles.categoryid = '" . $row1['categoryid'] . "'
                            AND Id != '" . $row1['Id'] . "' 
                            ORDER BY PublicDate DESC LIMIT 3");

// Dữ liệu cho mục tin tức
$db_qrnews = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                            FROM articles 
                            LEFT JOIN categories ON articles.categoryid = categories.categoryid
                            WHERE IsActive = 1 AND articles.categoryid = 1 AND Id != '" . $row1['Id'] . "'
                            ORDER BY Id DESC LIMIT 4");

// Dữ liệu cho mục hỏi đáp
$db_qrfaqs = new db_query("SELECT * FROM faqs ORDER BY createdate DESC LIMIT 4");


$db_qr2   = new db_query("SELECT * FROM categories");
$row_back = $db_qr2->result_array('CategoryID');
$row_name = $row_back[$row1['categoryid']]['CategoryName'];
$url_back = rewriteNews($row1['categoryid'], $row_name);
?>

<!DOCTYPE html>
<html amp lang="vi">
<head>
	<meta charset='UTF-8'>
    <title><?= $row1["Title"] ?></title>
    <script async src='https://cdn.ampproject.org/v0.js'></script>
    <script async custom-element='amp-sidebar' src='https://cdn.ampproject.org/v0/amp-sidebar-0.1.js'></script>
    <script async custom-element='amp-fit-text' src='https://cdn.ampproject.org/v0/amp-fit-text-0.1.js'></script>
    <script async custom-element='amp-analytics' src='https://cdn.ampproject.org/v0/amp-analytics-0.1.js'></script>

    <meta name='description' content='<?= $row1["MetaDesc"] ?>' />
    <meta name='keywords' content='<?= $row1["Meta"] ?>' />
    <meta name='robots' content='noodp,index,follow' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
    <meta http-equiv='content-language' content='vi' />
    <meta name='author' itemprop='author' content='new_item' />
    <meta name='google-site-verification' content='BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU' />
    <link rel='canonical' href='<?= ($row1["link_canonical"] != '') ? $row1["link_canonical"] : $urlcano ?>' />
    <link href='/favicon.ico' rel='shortcut icon' type='image/x-icon' />
    <link rel='shortcut icon' href='/images/favicon.ico' type='image/x-icon' />

    <meta property='og:image:url' content='<?= $src ?>'>
    <meta property='og:image:width' content='476'>
    <meta property='og:image:height' content='249'>
    <meta property='og:title' itemprop='headline' content='<?= $row1["Title"] ?>'>
    <meta property='og:url' itemprop='url' content='<?= ($row1["link_canonical"] != '') ? $row1["link_canonical"] : $urlcano ?>'>
    <meta property='og:description' itemprop='description' content='<?= $row1["MetaDesc"] ?>'>
    <meta property='og:type' content='website'>
    <meta property='og:locale' content='vi_VN'>
    <meta name='twitter:card' content='summary' />
    <meta name='twitter:image' content='<?= $src ?>'>
    <meta name='twitter:description' content='<?= $row1["MetaDesc"] ?>'>
    <meta name='twitter:title' content='<?= $row1["Title"] ?>'>
    <meta name='twitter:site' content='banthe24h.vn'>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css'>
  	<style amp-custom>
        @font-face{font-family:Roboto,sans-serif;src:url(roboto/Roboto-Regular.ttf);font-display:swap}@font-face{font-family:Roboto-Medium,sans-serif;src:url(roboto/Roboto-Medium.ttf);font-display:swap}@font-face{font-family:Roboto-Bold,sans-serif;src:url(roboto/Roboto-Bold.ttf);font-display:swap}*{padding:0;margin:0;box-sizing:border-box}body{font-family:"Roboto",sans-serif}.wrapper{padding:0}.header{display:flex;justify-content:space-between;align-items:center;padding:10px 25px;background:linear-gradient(white,#fff,#fff,#f3f3f3)}.head-right{color:#555}#showMenu{background:0 0;outline:0;border:none;font-size:30px;color:#666}.post-title{padding:20px 10px;font-weight:400;font-size:28px;border-bottom:1px solid #d3d2d2}.date-writed{padding:10px;color:#aaa;font-size:15px}.date{display:flex;align-items:center;font-size:14px}.date amp-img{margin-right:10px}.content{line-height:28px;color:#484848;font-family:"Noto Serif",serif}.intro{font-style:italic;text-indent:22px;text-align:justify;line-height:28px;font-family:"Noto Serif",serif;color:#484848;padding:0 10px}.mucluc{width:85%;border:2px dashed #2585a7;padding:15px;margin:25px auto}.mucluc p{padding:12px;background:#2585a7;clip-path:polygon(100% 0,89% 48%,100% 100%,0 100%,11% 48%,0 0);text-align:center;color:#fff;font-size:16px;font-weight:700;margin-bottom:20px;font-family:"Noto Serif",serif;text-transform:uppercase}.mucluc ul{list-style-type:none;overflow-y:scroll;max-height:260px}.mucluc ul li{margin-bottom:15px;font-size:16px;line-height:28px}.mucluc ul li a{text-decoration:none;font-weight:600}a{color:#337ab7;text-decoration:none}.mucluc ul::-webkit-scrollbar{width:5px}.mucluc ul::-webkit-scrollbar-thumb{background:#0098db;border-radius:20px}.mucluc ul::-webkit-scrollbar-track{border-radius:20px;background:0 0}.ml_h2,.ul_h2{font-weight:500;color:#3f51b5;font-size:14px;line-height:16px}.ml_h3,.ul_h3{padding-left:20px;color:#00bcd4;font-style:italic;font-weight:550;font-size:14px;line-height:20px}.content h2{margin:20px 0 10px;color:#000;font-size:20px;padding:0 10px}.content h3{margin:15px 0 5px;font-size:18px;font-weight:500;color:#000;padding:0 10px}table{border-collapse:collapse;width:100%}td{border:1px solid #ccc;padding:5px}.content p{text-align:justify;margin-bottom:10px;padding:0 10px;width:100%;float:left}.content p span{float:left;text-indent:22px;width:100%}.content p strong span span #xt{display:inline-block;font-size:16px;color:#fff;text-align:center;background:#fab416;padding:20px 15px;border-radius:40px;text-indent:0;font-weight:700;text-decoration:none;box-sizing:border-box}.box-see-more{border:2px solid #2585a7;border-radius:10px 10px 0 0;margin:20px 0;overflow:hidden}.see-more-title{background:#2585a7;display:flex;align-items:center;justify-content:space-between;padding:10px 20px}.see-more-title amp-img{margin-right:15px}.see-more-title span:nth-child(2){font-size:18px;font-weight:500;color:#fff;margin:auto}.stb_desc{padding:15px;font-size:16px;font-family:"Noto Serif",serif}.stb_desc p span{display:block;text-indent:0;text-align:justify}.stb_desc p a span,.stb_desc p:last-child{text-align:center;font-weight:600}.stb_desc p:nth-child(2){width:100%;text-align:center}.stb_desc a span,.stb_desc a span span{text-align:center}.stb_desc a{margin-top:20px;display:inline-block;padding:13px;color:#fff;background:linear-gradient(180deg,#2585a7 0,#056688 100%);text-decoration:none;border-radius:15px}.litte-banner{margin:10px 0;padding:0 10px}#titlee{margin-top:20px;padding:0 10px}.other-post{padding:10px 0 20px 35px}.other-post li{margin-bottom:10px;font-size:14px}.other-post li a{text-decoration:none;color:#298aaa}#sub_content{padding:0 10px}.sc_title{display:flex;align-items:center;background:#298aaa;padding:12px;font-size:18px;color:#fff;border-radius:0 10px 0 10px;font-weight:600}.sc_title span{margin-left:10px}#sub_content ul{list-style-type:none;padding:15px 0 15px 15px}#sub_content ul li{margin-bottom:15px}#sub_content ul a{text-decoration:none;color:#555}.support-pay{display:flex;flex-direction:column;margin-top:20px}.support-pay p{display:inline-block;padding:5px 15px;background:#3f98bc;text-transform:uppercase;color:#fff;margin:auto}.pay-bank{float:left;text-align:center;justify-content:space-around}.pay-bank amp-img{border:1px solid #ccc;margin:10px}.footer{background:#cddce3;font-size:14px}.top-footer{padding:1px 30px 0}.footer h3{margin:20px 0;font-size:19px;font-weight:unset}.footer p{margin-bottom:10px;font-size:16px}.zaloo a{display:flex;align-items:center;color:#337ab7;text-decoration:none}.footer amp-img{margin-right:5px}.lienhe a{font-size:14px;margin-left:10px;color:#337ab7}.bot-footer{text-align:center;padding:10px;border-top:2px solid #fff}amp-sidebar{background:#fefdfd}amp-sidebar p{display:flex;justify-content:flex-end}amp-sidebar button{font-size:30px;border:none;background:0 0;outline:0;padding:10px;color:#dedede}amp-sidebar ul{padding:0 20px;list-style-type:none}amp-sidebar ul li{padding:0 10px;color:#555;font-size:16px;margin-bottom:15px;text-transform:uppercase;font-weight:600}amp-sidebar ul li a{text-decoration:none;color:#555;cursor:pointer}figure{text-align:center;padding:0 10px}figure amp-img{width:100%}figcaption{text-align:center;font-size:14px;font-style:italic;border:1px solid #c4c4c4;background:#eee}#sub_content ul li a{font-size:15px}.content p amp-img{display:table;margin:auto}.content p strong span span{float:left;width:100%;text-align:center;text-indent:0}
  	</style>

    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<div class="head-left">			
				<a href="https://banthe24h.vn/"><amp-img width=250 height=59 layout="intrinsic" src="/images/logo.png" alt="banthe24h"></amp-img></a>
			</div>
			<div class="head-right">
				<button id="showMenu" on="tap:menuBar.open"><i class="fas fa-th-list"></i></button>
			</div>
		</div>
		<div class="main-content">
			<h1 class="post-title">
				<?= $row1['Title'] ?>
			</h1>
			<div class="date-writed">
				<div class="date"><amp-img width=15px height=15px src="../images/blog_detail/date.png" alt="ngayviet"></amp-img><span><?= date("d/m/Y • h:i:s A", strtotime($row1['PublicDate'])) ?></span></div>
			</div>
            <p class="intro">
                <? echo trim(removeHTML($row1['Intro'])) ?>
            </p>
            <div class="mucluc">
                <? echo makeML($row1['Description']) ?>
            </div>
			<div class="content">
                <? 
                $text = amp_content($row1['Description']);
                echo makeML_content($text);          
                ?>
			</div>
				<?php if ($row1['new_tdgy'] != "") { ?>
                <div class="box-see-more">
                    <div id="sub_tbl_news" class="text-center">
                        <div class="see-more-title">
                            <span><amp-img width=24 height=24 src="/images/blog_detail/ic_last.png" alt=""></amp-img></span>
                            <span><?= amp_content($row1['new_tdgy']) ?></span>
                        </div>
                        <div class="stb_desc text-left">
                            <? echo amp_content($row1['new_ndgy'] ) ?>
                        </div>
                    </div>
                </div>
                <? } ?>
			<div id="dif_news">
				<div class="litte-banner">
					<a href="https://timviec365.vn/"><amp-img layout="intrinsic" width="720" height="200"  layout="intrinsic" src="../images/banner_the.jpg"></amp-img></a>
				</div>
                <div id="titlee">Các tin khác</div>
                <ul class="other-post">
                        <?
                        while ($rownew = mysql_fetch_assoc($db_qrnew->result)) {
                            if ($rownew['ShortTitle'] != NULL) {
                                $urlshortde = $rownew['ShortTitle'];
                            } else {
                                $urlshortde = $rownew['Title'];
                            }
                        ?>
                            <li><a title="<?= $rownew['Title'] ?>" href="<? echo rewrite_news($rownew['Id'], $urlshortde, $rownew['categoryname']) ?>"><?= $rownew['Title'] ?></a></li>
                        <?
                        }
                        ?>
               	</ul>
            </div>
            <div id="sub_content">
                <div id="blog_news">
                    <div class="sc_title">
                        <amp-img width=20 height=20 src="/images/blog_detail/ic_tt.png" alt="tin tức"></amp-img>
                        <span>Tin tức</span>
                    </div>
                    <ul>
                        <?
                        while ($row1 = mysql_fetch_assoc($db_qrnews->result)) {
                            if ($row1['ShortTitle'] != NULL) {
                                $url = $row1['ShortTitle'];
                            } else {
                                $url = $row1['Title'];
                            }
                        ?>
                            <li><a title="<?= $row1['Title'] ?>" href="<? echo rewrite_news($row1['Id'], $url, $row1['categoryname']) ?>"><?= $row1['Title'] ?></a></li>
                        <?
                        }
                        ?>
                    </ul>
                </div>

                <div id="question">
                    <div class="sc_title">
                        <amp-img width=25 height=25 src="/images/blog_detail/ic_chtg.png" alt="câu hỏi thường gặp"></amp-img>
                        <span>Câu hỏi thường gặp</span>
                    </div>
                    <ul>
                        <?
                        while ($row2 = mysql_fetch_assoc($db_qrfaqs->result)) {
                        ?>
                            <li><a rel="nofollow" title="<?= $row2['Title'] ?>" href="<? echo rewrite_news($row2['FaqID'], $row2['Title'], " chuyen-muc-hoi-dap") ?>"><?= $row2['Title'] ?></a></li>
                        <?
                        }
                        ?>
                    </ul>
                </div>
                <div id="banner_ads">
                    <a rel="nofollow"><amp-img width="900" height="500" layout="intrinsic" src="/images/blog_detail/ads_tc.png" alt="banner mua thẻ cào online"></amp-img></a>
                </div>
                <div id="banner_ads" style="margin-top: 20px;">
                    <a rel="nofollow" href="https://timviec365.vn/cv-xin-viec"><amp-img width="900" height="1000" layout="intrinsic" src="/images/banner_cv_right.gif"></a>
                </div>
				<div class="support-pay">
					<p>Hỗ trợ thanh toán mua thẻ</p>
					<div class="pay-bank">
						<amp-img width=90 height=46 layout="intrinsic" src="/images/vcb.png" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/scb.png" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/ocean.png" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/hdb.png" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/vib.png" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/bidv.jpg" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/tcb.png" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/vnmart.gif" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/DongA.gif" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/maritime.jpg" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/NamABank.jpg" alt="Vietcombank"></amp-img>
						<amp-img width=90 height=46 layout="intrinsic" src="/images/tpb.jpg" alt="Vietcombank"></amp-img>
					</div>
				</div>		
            </div>
		</div>
		<div class="footer">
			<div class="top-footer">
				<h3>Thông tin liên hệ</h3>
					<p><strong>Địa chỉ: </strong>Tầng 4, B50, Lô 6, KĐT Định Công - Hoàng Mai - Hà Nội</p>
					<p><strong>Email: </strong>info@24hpay.vn</p>
					<p><strong>Điện thoại: </strong>0971.412.658</p>
					<p>Một sản phẩm của Công ty Cổ phần Thanh toán Hưng Hà</p>
					<p class="zaloo"><a href="https://zalo.me/0982079209"><amp-img width=24 height=24 src="/images/icon_zalo.png" alt="zalo"></amp-img><span>banthe24h.vn</span></a></p>
					<p class="lienhe">Kết nối với chúng tôi: <a href="https://vimeo.com/banthe24hvn"><amp-img width=20 height=20 src="/images/new/Logo-01.png" alt="Vimeo"></amp-img>Vimeo</a><a href="https://issuu.com/banthe24h"><amp-img width=20 height=20 src="/images/new/Logo-02.png" alt="Issuu"></amp-img>Issuu</a><a href="https://banthe24h.tumblr.com/"><amp-img width=20 height=20 src="/images/new/Logo-04.png" alt="Tumblr"></amp-img>Tumblr</a><a href="https://www.flickr.com/people/189533206@N02/"><amp-img width=20 height=20 src="/images/new/Logo-03.png" alt="Flickr"></amp-img>Flickr</a><a href="https://www.instagram.com/banthe24hh/"><amp-img width=20 height=20 src="/images/new/Logo-05.png" alt="Instagram"></amp-img>Instagram</a></p>
			</div>		
			<div class="bot-footer">Bản quyền ©2016-2020 Banthe24h.vn</div>
		</div>
	</div>
</body>
<div>
	<amp-sidebar style="width: 300px" id="menuBar" class="sample-sidebar" layout="nodisplay" side="right">
		<p><button on="tap:menuBar.close"><i class="fas fa-times"></i></button></p>
		<nav >
			<ul>
				<li><a href="https://banthe24h.vn/tien-ich/mua-the-game">Mua thẻ game</a></li>
				<li><a href="https://banthe24h.vn/tien-ich/nap-tien-dien-thoai">Nạp tiền điện thoại</a></li>
				<li><a href="https://banthe24h.vn/thong-bao-mua-tcoin">Nạp tiền</a></li>
				<li><a href="https://banthe24h.vn/the-giay">Thẻ giấy</a></li>
				<li><a on="tap:menuBar2.open">Tin tức thẻ</a></li>
			</ul>
		</nav>
	</amp-sidebar>
	<amp-sidebar style="width: 300px" id="menuBar2" class="sample-sidebar" layout="nodisplay" side="right">
		<p><button on="tap:menuBar2.close"><i class="fas fa-times"></i></button></p>
		<nav>
			<ul>
				<li><a href="https://banthe24h.vn/tin-tuc-1.html">Tin tức mua thẻ</a></li>
				<li><a href="https://banthe24h.vn/huong-dan-8.html">Hướng dẫn mua thẻ</a></li>
				<li><a href="https://banthe24h.vn/chuyen-muc-hoi-dap">Hỏi đáp thẻ</a></li>
				<li><a href="https://banthe24h.vn/chiet-khau">Chiết khấu mua thẻ</a></li>
				<li><a href="https://banthe24h.vn/app-tro-choi-1015.html">App trò chơi</a></li>
			</ul>
		</nav>
	</amp-sidebar>     
</div>
<amp-analytics type="googleanalytics">
    <script type="application/json">
        {
          "vars": {
          "account": "UA-139150820-1"
      },
      "triggers": {
      "trackPageview": {
      "on": "visible",
      "request": "pageview"
  }
}
}
</script>
</amp-analytics>
</html>
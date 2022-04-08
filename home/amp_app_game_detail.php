<?
include("config.php");

$id = getValue('id', 'int', 'GET', 1);
if ($id > 0) {
    $db_game = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,articles.Meta,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy,articles.Description,link_301,link_canonical
                            FROM articles
                            LEFT JOIN categories ON articles.categoryid = categories.CategoryID
                            WHERE IsActive = 1 AND Id = $id");
    if (mysql_num_rows($db_game->result) > 0) {
        $db_update_view = new db_query("UPDATE articles SET view = view + 1 WHERE Id = $id");

        $rowgame = mysql_fetch_assoc($db_game->result);

        $db_qr = new db_query("SELECT * FROM categories");
        $db_cat = $db_qr->result_array('CategoryID');

        if (array_key_exists($rowgame['category_parent_id'], $db_cat)) {
            $nav_name = $db_cat[$rowgame['category_parent_id']]['CategoryName'];
            $url_type = rewriteNews($rowgame['category_parent_id'], $nav_name);
        }
        $cat_id = $rowgame['category_parent_id'];
        $db_sub = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy
                                FROM articles
                                LEFT JOIN categories ON categories.CategoryID = $cat_id
                                WHERE categories.CategoryID = articles.category_parent_id AND Id != $id
                                ORDER BY Id DESC LIMIT 6");

        $title = $rowgame['Title'];
        $desc = $rowgame['MetaDesc'];
        $meta = $rowgame['Meta'];
        if ($rowgame['ShortTitle'] != NULL) {
            $urlshort = $rowgame['ShortTitle'];
        } else {
            $urlshort = $rowgame['Title'];
        }
        $urlcano = rewrite_news($id, $urlshort, 'app-tro-choi');
        $urlcano = $urlwebsite . $urlcano;
        $userinfourl = $_SERVER['REQUEST_URI'];
        $src = $rowgame['ImageUrl'];
        if (strpos($rowgame['ImageUrl'], '/upload/') === false)
        {
            $src = "https://banthe24h.vn/pictures/news/" . $rowgame['ImageUrl'];
        }
        $urlfull = $urlwebsite . $userinfourl;
    }
}
?>

<!DOCTYPE html>
<html amp lang="vi">
<head>
	<meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
    <title><?= $title ?></title>
    <script async src='https://cdn.ampproject.org/v0.js'></script>
    <script async custom-element='amp-sidebar' src='https://cdn.ampproject.org/v0/amp-sidebar-0.1.js'></script>
    <script async custom-element='amp-fit-text' src='https://cdn.ampproject.org/v0/amp-fit-text-0.1.js'></script>
    <script async custom-element='amp-analytics' src='https://cdn.ampproject.org/v0/amp-analytics-0.1.js'></script>
    <script async custom-element='amp-iframe' src='https://cdn.ampproject.org/v0/amp-iframe-0.1.js'></script>


    <meta name='description' content='<?= $desc ?>' />
    <meta name='keywords' content='<?= $meta ?>' />
    <meta name='robots' content='noodp,index,follow' />
    <meta http-equiv='content-language' content='vi' />
    <meta name='author' itemprop='author' content='banthe24h.vn' />
    <meta name='google-site-verification' content='BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU' />
    <link rel='canonical' href='<?= ($rowgame["link_canonical"] != '') ? $rowgame["link_canonical"] : $urlcano ?>' />
    <link href='/favicon.ico' rel='shortcut icon' type='image/x-icon' />
    <link rel='shortcut icon' href='/images/favicon.ico' type='image/x-icon' />

    <meta property='og:image:url' content='<?= $src ?>'>
    <meta property='og:image:width' content='476'>
    <meta property='og:image:height' content='249'>
    <meta property='og:title' itemprop='headline' content='<?= $title ?>'>
    <meta property='og:url' itemprop='url' content='<?= ($rowgame["link_canonical"] != '') ? $rowgame["link_canonical"] : $urlcano ?>'>
    <meta property='og:description' itemprop='description' content='<?= $desc ?>'>
    <meta property='og:type' content='website'>
    <meta property='og:locale' content='vi_VN'>
    <meta name='twitter:card' content='summary' />
    <meta name='twitter:image' content='<?= $src ?>'>
    <meta name='twitter:description' content='<?= $desc ?>'>
    <meta name='twitter:title' content='<?= $title ?>'>
    <meta name='twitter:site' content='banthe24h.vn'>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css'>

    <style amp-custom>
        @font-face{font-family:Roboto,sans-serif;src:url(roboto/Roboto-Regular.ttf);font-display:swap}@font-face{font-family:Roboto-Medium,sans-serif;src:url(roboto/Roboto-Medium.ttf);font-display:swap}@font-face{font-family:Roboto-Bold,sans-serif;src:url(roboto/Roboto-Bold.ttf);font-display:swap}.wrapper{padding:0}.header{display:flex;justify-content:space-between;align-items:center;padding:10px 25px;background:linear-gradient(white,#fff,#fff,#f3f3f3)}.head-right{color:#555}#showMenu{background:0 0;outline:0;border:none;font-size:30px;color:#666}.main-content{padding:0 15px;padding-top:20px}.date{display:flex;align-items:center}.game_type{color:#50b952;font-size:14px}.date amp-img{margin-right:10px}.post-content{line-height:26px;padding-bottom:10px;margin:20px 0}.img-boder{float:left;width:70%}.mucluc ul::-webkit-scrollbar{width:5px}.mucluc ul::-webkit-scrollbar-thumb{background:#0098db;border-radius:20px}.mucluc ul::-webkit-scrollbar-track{border-radius:20px;background:0 0}.intro p{font-style:italic;text-indent:22px;text-align:justify}.mucluc{border:2px dashed #348daf;padding:15px;margin:20px auto}.mucluc p{clip-path:polygon(100% 0,90% 50%,100% 100%,0 100%,10% 50%,0 0);padding:10px;background:#348daf;font-size:20px;text-transform:uppercase;font-weight:600;text-align:center;color:#fff}.mucluc ul{overflow-y:scroll;max-height:260px;list-style-type:none;margin-top:15px;padding:0}.mucluc ul li{margin-bottom:10px}.mucluc ul li a{text-decoration:none;font-family:'Noto Serif',serif;font-size:14px;line-height:20px;margin-bottom:19px;display:block}.mucluc .ml_h3,.mucluc .ul_h3{padding-left:18px;color:#00bcd4}.ml_h2{font-weight:500;font-size:16px}.ml_h3{padding-left:20px;font-weight:400}.post-content h2{font-family:'Noto Serif',serif;font-size:20px;line-height:22px;text-align:justify;letter-spacing:normal;font-weight:700;color:#348DAF}.post-content h3{color:#348DAF;font-family:'Noto Serif',serif;font-size:18px;line-height:24px;text-align:justify;letter-spacing:normal;font-weight:unset}.post-content p{text-indent:22px;margin-bottom:10px;font-family:'Noto Serif',serif;font-size:16px;line-height:24px;letter-spacing:normal}.box-see-more{border:2px solid #2585a7;border-radius:10px;margin:20px auto}.see-more-title{background:#2585a7;display:flex;align-items:center;justify-content:space-between;padding:10px 20px}.see-more-title amp-img{margin-right:15px}.see-more-title span:nth-child(2){margin:auto;color:#FFF;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-family:Roboto,sans-serif;font-size:16px;line-height:19px;font-weight:500}.stb_desc{padding:15px;font-size:16px;line-height:19px;font-family:'Noto Serif',serif}.stb_desc a{display:inline-block;padding:10px;color:#fff;background:linear-gradient(180deg,#2585a7 0,#056688 100%);text-decoration:none;border-radius:15px;font-weight:700}.list_social{display:flex;width:330px;justify-content:space-between}.box-related{padding:0 25px}.box_show{display:flex;margin-bottom:15px}.game_desc_3{color:#bbb;margin-left:15px;font-size:14px}.game_desc_3 a{text-decoration:none;color:#444;font-weight:500;font-size:16px}.game_desc_3 p{margin-top:10px}#list_game_type{display:flex;flex-wrap:wrap;justify-content:space-between;padding:0 27px}.cate-game{display:flex;justify-content:center;align-items:center;margin:10px;background:#fff;width:133px;height:133px;border-radius:7px;width:40%;box-shadow:0 4px 10px rgba(0,0,0,0.2)}.cate-game a{display:flex;flex-direction:column;align-items:center;text-decoration:none;font-size:16px;font-weight:500;color:#555;font-family:Roboto}.cate-game a span{margin-top:5px}.support-pay{display:flex;flex-direction:column;margin-top:50px}.support-pay p{display:inline-block;padding:5px 15px;background:#3f98bc;text-transform:uppercase;color:#fff;margin:auto}.pay-bank{display:flex;flex-wrap:wrap;justify-content:space-around}.pay-bank amp-img{border:1px solid #ccc;margin:10px}.ga_title span::after{content:"";display:block;width:100%;height:6px;background:#348DAF;border-radius:5px 5px 0 0;margin-top:5px}.footer{background:#cddce3;font-size:14px}.top-footer{padding:1px 30px 0}.footer h3{margin:20px 0;font-size:19px;font-family:Roboto,sans-serif;font-weight:400}.footer p{margin-bottom:10px;font-family:'Roboto';font-size:14px}.zaloo a{display:flex;align-items:center;color:#337ab7;text-decoration:none}.footer h2{font-size:19px;margin:10px 0;font-family:'Roboto';font-weight:400}.footer amp-img{margin-right:5px}.lienhe a{font-size:14px;margin-left:10px;color:#337ab7}.footer ul li a{color:#337ab7;text-decoration:none;font-family:'Roboto'}.footer ul{padding:0;list-style-type:none;margin-bottom:5px}.bot-footer{font-size:18px;text-align:center;border-top:solid 2px #fff;padding:15px 0;font-family:'Roboto'}.sub_link{margin-bottom:5px}#mrg{padding:15px 25px}.ga_title2{font-size:22px;font-weight:400;border-bottom:2px solid #348daf}.ga_title2 span{border-bottom:3px solid #348daf;line-height:32px}.ga_title{font-size:22px;font-weight:400;border-bottom:2px solid #348daf}.ga_title span{letter-spacing:normal;text-transform:capitalize;color:#348DAF;display:inline-block;font-weight:500;font-size:18px;line-height:21px;text-indent:30px;font-family:Roboto,sans-serif}amp-sidebar{background:#fefdfd}amp-sidebar p{display:flex;justify-content:flex-end}amp-sidebar button{font-size:30px;border:none;background:0 0;outline:0;padding:10px;color:#dedede}amp-sidebar ul{padding:0 20px;list-style-type:none}amp-sidebar ul li{padding:0 10px;color:#555;font-size:16px;margin-bottom:15px;text-transform:uppercase;font-weight:600}amp-sidebar ul li a{text-decoration:none;color:#555;cursor:pointer}#showMenu{font-size:20px}.pay-bank amp-img{width:70px;height:35.7px}.info-content{font-size:14px}figure{text-align:center;margin:0}figcaption{font-size:14px;text-align:center;font-style:italic;padding-top:8px;border:1px solid #c4c4c4;background-color:#eee;font-family:Roboto}.content p{text-align:justify}.content p > amp-img{display:table;margin:auto}.box-game{display:flex;justify-content:flex-end;padding:20px 0}.box-borde{width:88%;display:flex;position:relative}.bode1{width:100%;border-radius:8px;margin-bottom:10px;background:url(/images/app_game/bg_sublink_tablet.png)no-repeat;background-size:100% 100%}.bode2{border-radius:8px;position:relative;top:7px;left:7px;padding:21px 15px 21px 20px}.bode2 a{display:inline-block;position:relative;color:#555;text-decoration:none;font-family:Roboto-Bold,sans-serif;-webkit-line-clamp:2;font-size:14px;line-height:16px;font-weight:600}.box-game{padding:22px 0;margin-top:15px;position:relative;background:url(/images/app_game/bg_detail_mobi.png)no-repeat;background-size:100% 100%}.game-info{}.mucluc .ml_h2,.mucluc .ul_h2{font-weight:700;color:#3f51b5}.info-content{}.info-content a{display:block;text-decoration:none;overflow:hidden;text-overflow:ellipsis;-webkit-line-clamp:2;display:-webkit-box;-webkit-box-orient:vertical}.info-content h1{font-size:19px;font-weight:500;font-family:Roboto,sans-serif}.info-content p{font-size:14px;line-height:16px;color:#BBBBBE;font-family:Roboto,sans-serif}.info-content p{margin:5px 0;font-size:13px}.stb_desc p:last-child{text-align:center}.stb_desc p:first-child{text-indent:22px}.wp_sub_link > span{position:relative;width:95%;display:flex;padding-left:10px}.wp_sub_link > span:before{width:7px;height:7px;border-radius:50%;background:#50b952;content:"";position:absolute;left:-10px;top:5px}.main-content .content p strong a{width:100%;float:left;text-align:center;padding-bottom:20px}.main-content .content p strong a span span{display:inline-block;font-family:'Noto Serif',serif;font-size:16px;line-height:28px;color:#FFF;text-align:center;background:#fab416;padding:20px 15px;border-radius:40px;text-indent:0;font-weight:700;text-decoration:none}
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
			<div class="box-game">
                <div class="box-borde">
                    <span class="img-boder">
                        <amp-img width=900 height=900 layout="intrinsic" src="https://banthe24h.vn//pictures/news/<?= $rowgame['ImageUrl']; ?>" alt="<?= $rowgame['Title'] ?>" title="<?= $rowgame['Title'] ?>"></amp-img>
                    </span>
                </div>

				<!-- <div class="bg-blue">
					
				</div>
				<div class="game-info">
					<span class="img-boder"><amp-img width=150 height=150 layout="intrinsic" src="https://banthe24h.vn//pictures/news/<?= $rowgame['ImageUrl']; ?>" alt="<?= $rowgame['Title'] ?>" title="<?= $rowgame['Title'] ?>"></amp-img></span>
					<div class="info-content">
						<h1 class="gd_name"><?= $rowgame['Title'] ?></h1>
						<p class="date"><amp-img width=10px height=10px src="/images/app_game/ic_clock_xam.png" alt="ngayviet"></amp-img><span><?= date("d/m/Y • h:i:s A", strtotime($rowgame['PublicDate'])) ?></span></p>
						<p><a href="<?= $url_type ?>" class="game_type"><?= $nav_name ?></a></p>
						<div class="bode1" <?= !empty(mysql_fetch_assoc($db_sub->result)) ? '' : 'style="display: none;"'; ?>>
							<div class=bode2>
								<div class="wp_sub_link" >
                        <?
                        $i = 0;
                        while ($rowsub = mysql_fetch_assoc($db_sub->result)) {
                            $i++;
                            $urlsub = rewrite_news($rowsub['Id'], $rowsub['ShortTitle'], 'app-tro-choi');
                        ?>
                            <a href="<?= $urlsub ?>" class="sub_link" title="<?= $rowsub['Title'] ?>"><?= $rowsub['Title'] ?></a>
                        <?
                            if ($i == 2) {
                                break;
                            }
                        }
                        ?>
                    			</div>
							</div>
						</div>
					</div>
				</div> -->
      
            </div>
            
            <div class="game-info">                    
                        <div class="info-content">
                            <h1 class="gd_name"><?= $rowgame['Title'] ?></h1>
                            <p class="date"><amp-img width=10px height=10px src="/images/app_game/ic_clock_xam.png" alt="ngayviet"></amp-img><span><?= date("d/m/Y • h:i:s A", strtotime($rowgame['PublicDate'])) ?></span>
                            </p>
                            <p><a href="<?= $url_type ?>" class="game_type"><?= $nav_name ?></a></p>
                            </div>
                            <div class="bode1" <?= !empty(mysql_fetch_assoc($db_sub->result)) ? '' : 'style="display: none;"'; ?>>
                                <div class=bode2>
                                    <div class="wp_sub_link" >
                            <?
                            $i = 0;
                            while ($rowsub = mysql_fetch_assoc($db_sub->result)) {
                                $i++;
                                $urlsub = rewrite_news($rowsub['Id'], $rowsub['ShortTitle'], 'app-tro-choi');
                            ?>
                                <span><a href="<?= $urlsub ?>" class="sub_link" title="<?= $rowsub['Title'] ?>"><?= $rowsub['Title'] ?></a></span>
                            <?
                                if ($i == 2) {
                                    break;
                                }
                            }
                            ?>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
            

			<div class="post-content">
				<div class="intro">
                    <?= amp_content($rowgame['Intro']) ?>
                </div>
                <div class="mucluc">
                    <? echo makeML($rowgame['Description'])  ?>
                </div>
                <div class="content">
                    <?  
                    $text = amp_content($rowgame['Description']);
                    echo makeML_content($text); 
                    ?>
                </div>
        
				

			</div>
            <?php if ($rowsub['new_tdgy'] != "") { ?>
                    <div class="box-see-more">
                        <div id="sub_tbl_news" class="text-center">
                            <div class="see-more-title">
                                <span><amp-img width=24 height=24 src="/images/blog_detail/ic_last.png" alt=""></amp-img></span>
                                <span><?= amp_content($rowsub['new_tdgy']) ?></span>
                            </div>
                            <div class="stb_desc text-left">
                                <?= amp_content($rowsub['new_ndgy']) ?>
                            </div>
                        </div>
                    </div>
                <? } ?>
        <div class="banner_news">
            <a href="https://banthe24h.vn"><amp-img layout="intrinsic" width="900" height="300" src="https://banthe24h.vn/images/banner_the.jpg" alt="mua thẻ điện thoại"></amp-img></a>
        </div>
		</div>
		<div id="related-game" <?= !empty(mysql_fetch_assoc($db_sub->result)) ? '' : 'style="display: none;"'; ?>>
                        <div id="mrg">
                        	<div class="ga_title"><span>Có thể bạn quan tâm</span></div>
                    	</div>
                        <div class="box-related">
                            <?
                            while ($rowsub = mysql_fetch_assoc($db_sub->result)) {
                                $urlsub2 = rewrite_news($rowsub['Id'], $rowsub['ShortTitle'], 'app-tro-choi');
                            ?>
                                
                                    <div class="box_show">
                                        <a href="<?= $urlsub2 ?>" title="<?= $rowsub['Title'] ?>"><amp-img width=120 height=80 layout="fixed" src="https://banthe24h.vn//pictures/news/<?= $rowsub['ImageUrl']; ?>" alt="<?= $rowsub['Title'] ?>"></amp-img></a>
                                        <div class="game_desc_3">
                                            <a href="<?= $urlsub2 ?>" title="<?= $rowsub['Title'] ?>" class="game_name_3"><?= $rowsub['Title'] ?></a>
                                            <p class="game_public">
                                                <amp-img width=10 height=10  src="/images/app_game/ic_clock_xam.png" alt="clock"></amp-img>
                                                <span><?= date("d/m/Y h:i:s A", strtotime($rowsub['PublicDate'])) ?></span>
                                            </p>
                                        </div>
                                    </div>
                                
                            <?
                                $i++;
                                if ($i == 6) {
                                    break;
                                }
                            }
                            ?>
                        </div>
                    </div>


		<div id="ga_type">
			<div id="mrg">
				<div class="ga_title"><span>Thể loại game</span></div>
			</div>
                
                <div id="list_game_type">
                    <?
                    foreach ($db_cat as $item) {
                        if ($item['CategoryID'] >= 1016 && $item['CategoryID'] <= 1028) {
                            $url_r = rewriteNews($item['CategoryID'], $item['CategoryName']);

                    ?>
                            <div class="cate-game">
                                <a href="<?= $url_r ?>" title="<?= $item['CategoryName'] ?>" target="_blank">
                                    <amp-img width=47 height=47 layout="intrinsic" src="/images/app_game/<?= replaceTitle($item['CategoryName']) ?>.png" alt="<?= $item['CategoryName'] ?>"></amp-img>
                                    <span><?= $item['CategoryName'] ?></span>
                                </a>
                            </div>
                            
                    <?
                        }
                    }
                    ?>
                </div>
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

            <div class="footer">
			<div class="top-footer">
				<h3>Thông tin liên hệ</h3>
					<p><strong>Địa chỉ: </strong>Tầng 4, B50, Lô 6, KĐT Định Công - Hoàng Mai - Hà Nội</p>
					<p><strong>Email: </strong>info@24hpay.vn</p>
					<p><strong>Điện thoại: </strong>0971.412.658</p>
					<p>Một sản phẩm của Công ty Cổ phần Thanh toán Hưng Hà</p>
					<p class="zaloo"><a href="https://zalo.me/0982079209"><amp-img width=24 height=24 src="/images/icon_zalo.png" alt="zalo"></amp-img><span>banthe24h.vn</span></a></p>
                    <p class="lienhe">Kết nối với chúng tôi: <a href="https://vimeo.com/banthe24hvn"><amp-img width=20 height=20 src="/images/new/Logo-01.png" alt="Vimeo"></amp-img>Vimeo</a><a href="https://issuu.com/banthe24h"><amp-img width=20 height=20 src="/images/new/Logo-02.png" alt="Issuu"></amp-img>Issuu</a><a href="https://banthe24h.tumblr.com/"><amp-img width=20 height=20 src="/images/new/Logo-04.png" alt="Tumblr"></amp-img>Tumblr</a><a href="https://www.flickr.com/people/189533206@N02/"><amp-img width=20 height=20 src="/images/new/Logo-03.png" alt="Flickr"></amp-img>Flickr</a><a href="https://www.instagram.com/banthe24hh/"><amp-img width=20 height=20 src="/images/new/Logo-05.png" alt="Instagram"></amp-img>Instagram</a></p>
                    <h2>Quy định chính sách</h2>
                    <ul class="list-unstyled addres">
                        <li><a href="/gioi-thieu" rel="nofollow">Giới thiệu</a></li>
                        <li><a href="/quy-dinh-bao-mat" rel="nofollow">Quy định bảo mật</a></li>                      
                        <li><a href="/dieu-khoan-su-dung" rel="nofollow">Điều khoản sử dụng</a></li>                          
                        <li><a href="/giai-quyet-khieu-nai" rel="nofollow">Giải quyết khiếu nại</a></li>
                        <li><a href="/sitemap.xml" rel="nofollow" target="_blank">Sitemap</a></li>

                    </ul>
                    <a href="https://play.google.com/store/apps/details?id=com.something.windows10now.muathe24h">
                        <amp-img layout="intrinsic" width="180" height="50"  alt="ứng dụng banthe24h" class="lazyloaded" src="/images/button_app_adr.png"></amp-img>
                    </a>
			</div>
					
			<div class="bot-footer">Bản quyền ©2016-2020 Banthe24h.vn</div>
		</div>
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
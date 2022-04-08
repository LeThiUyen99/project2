<?
include("config.php"); 
$new_id = getValue("newid","int","GET",0);
if ($new_id > 0) {
    $db_qr = new db_query("SELECT id,name,image,price,thong_so_ky_thuat,so_luong,description,mayin_url,rating,numrate,new_date FROM mayinthecao WHERE id ='".$new_id."' LIMIT 1");
    if(mysql_num_rows($db_qr->result) > 0)
    {
        $row = mysql_fetch_assoc($db_qr->result);
        $id = (int)$row['id'];
        if($row['numrate'] != 0){
            $rate_n = ceil($row['rating']/$row['numrate']);
        $rate_n = $rate_n/5;
        $rate_n = $rate_n * 100;
        $rate_n = $rate_n."%";
        }
    }else{
        redirect("/may-in-the-cao");
    }

    $db_new = new db_query("SELECT id,name,image,price FROM mayinthecao WHERE id !=$new_id");
    if(mysql_num_rows($db_new->result) > 0)
    {
        $rownew = mysql_fetch_assoc($db_new->result);
        $id = (int)$rownew['id'];
        
    }else{
        redirect("404.shtml");
    }
    $urlSite = $_SERVER['REQUEST_URI'];
    $qrcomment = new db_query("SELECT * FROM comment WHERE url_cm = '$urlSite'");

    $comment_sp = array();
    while($db_comment = mysql_fetch_assoc($qrcomment->result)){
        $comment_sp[] = $db_comment; 
    }
    $reply = array();
    foreach($comment_sp as $key=>$item){
        if($item['parent_cm_id'] == 0){
            $comments[] = $item;
        }else{
            $reply[$item['parent_cm_id']][] = $item;
        }
    }
    if($row['rating'] > 0){
        $rate = abs((($row['rating']/$row['rating'])/5)*100);
    }
    $error = array();
    if(isset($_POST['btn_submit'])){
        setcookie('product_name',$row['name'], time() + 3600, '/');
        setcookie('product_price',$row['price'], time() + 3600, '/');
        setcookie('product_thumb',"{$row['image']}-1", time() + 3600, '/');
        if(empty($_POST['buy_quantity'])){
            $error['buy_quantity'] = "Bạn chưa chọn số lượng";
        }else{
            setcookie('buy_quantity',$_POST['buy_quantity'], time() + 3600, '/');
        }
        if(empty($_POST['city'])){
            $error['city'] = "Bạn chưa chọn thành phố";
        }else{
            setcookie('city_order',$_POST['city'], time() + 3600, '/');
        }
        if(empty($error)){
            header("Location: /may-in/lien-he-dat-mua.html");
        }
    }

}else{
    redirect("/");
}
$url_r = rewrite_news($new_id, $row['mayin_url'],"may-in");
$url_site = $_SERVER['REQUEST_URI'];
if($url_site != $url_r){
    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: $url_r");
    exit();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
<head>
    <meta charset ="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết máy in thẻ cào</title>
    <meta name="description" content='Địa chỉ bán thẻ cào uy tín, bạn có thể mua nhanh chóng thẻ điện thoại, thẻ game hay nạp tiền cho điện thoại giá rẻ nhất, thao tác trực tiếp tại web Banthe24h.vn.' />
  <meta name="keywords" content='Website bán thẻ điện thoại, bán thẻ game, banthe24h' />
  <meta name="robots" content='noodp,noindex,nofollow' />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name='revisit-after' content='1 days' />
  <meta http-equiv="content-language" content="vi" />
  <meta name="author" itemprop="author" content="banthe24h.com" />
  <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
  <link rel="canonical" href='https://banthe24h.vn/' />
  <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="/css/style.min2.css?v=<?= $ver; ?>" />
  <link rel="stylesheet" type="text/css" href="/css/responsive.css?v=<?= $ver; ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/css/mayinthecao.css">
    <link rel="stylesheet" type="text/css" href="/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="/css/slick-theme.css">
</head>
<body>
<? include("../includes/inc_header.php") ?>
<div class="detail-container">
    <div class="banner"><img src="/images/may_in_the/banner.jpg" alt=""></div>
    <div class="row-detail">
        <h1>MÁY IN THẺ CÀO</h1>
        <div class="banner_bb"></div>
        <div class="content-detail">
            <div class="thongtinsp">
                <div class="images-pr">
                    <div class="slider slider-for">
                        <?
                        for ($i=1; $i <=4 ; $i++) { 
                            # code...
                            $src="/pictures/may_in/".$row['image']."-{$i}.jpg";
                            if(!isset($src)){break;}
                        ?>
                        <div class="item-pr">
                            <img src="<?= $src?>" alt="<?= $row['name'] . ' ' .$i ?>">
                        </div>
                        <?
                        }
                        ?>
                    </div>
                    <div class="slider slider-nav">
                        <?
                        for($i = 1; $i <= 4; $i++)
                        {
                            $src = "/pictures/may_in/".$row['image']."-{$i}.jpg";
                        ?>
                        <div class="pr_item"><img src="<?= $src ?>" alt="<?= $row['name'].' '.$i ?>"></div>
                        <?
                        }
                        ?>
                    </div>
                    
                </div>
                <div class="inf-pr">
                    <div class="name-pr">
                        <h1><?= $row['name'] ?></h1>
                    </div>
                    <div class="sub_bg">
                        <div class="rating">
                            <!-- <p>Đánh giá:</p> -->
                            <div class="wp_rate">
                                <div class="bg_rate">
                                    <div class="rate_range" style="width: <?= (!empty($rate_n)) ? $rate_n : 0 ?>;"></div>
                                    <div class="fake_rate"></div>
                                </div>
                                    <div class="rating"><p><?= $row['rating'] ?> </p></div>
                                <div class="cm_total"><span>| <?= (!empty($comment_sp)) ? count($comment_sp) : 0 ?></span> đánh giá</div>
                                <!-- <a href="#user_comments" class="see_rate">(Xem đánh giá)</a> -->
                            </div>
                        </div>
                        <div class="tt"></div>
                    </div>
                    <div class="price-pr">
                        <span><?= number_format($row['price'], 0, '.', '.') ?>đ</span>
                    </div>
                    <form action="" method="post">
                        <div class="so_luong">
                            <span>Số lượng:</span>
                            <?
                            if(!empty($error['buy_quantity'])){
                                echo "<p class='text-danger'>{$error['buy_quantity']}</p>";
                            }
                            ?>
                            <div class="cart-quan">
                                <button type="button" class="quantity-change them" title="them">-</button>
                                <input type="text" id="" name="buy_quantity" min="1" max="<?= $row['so_luong'] ?>" value="<?= ($row['so_luong'] == 0) ? "0" : "1"; ?>" class="buy_quantity quantity-change text-center cart-quantity">
                                <button type="button" class="quantity-change tru <?= ($row['so_luong'] == 0) ? 'disabled' : ' '; ?>" title="tru">+</button>
                            </div>
                            <p>(còn <?= $row['so_luong'] ?> sản phẩm)</p>
                        </div>
                        <div class="form-group">
                            <span class="tp">Tỉnh / thành phố</span>
                            <?
                            if(!empty($error['city'])){
                                echo "<p class='text-danger'>{$error['city']}</p>";
                            }
                            ?>
                            <select name="city" class="form-control" id="city">
                                
                                <option value="">Chọn tỉnh / thành phố
                                    <?
                                    $query = new db_query("SELECT cit_name FROM city");
                                    while($rowcty= mysql_fetch_assoc($query->result)) {
                                    ?>
                                    <option class="thanhpho" value="<? echo $rowcty['cit_name']; ?>">
                                    <? echo $rowcty['cit_name']; ?>
                                </option>
                                <?
                                }
                            ?>
                                </option>
                            </select>
                            <div class="cc"></div>
                        </div>
                        <button rel="nofollow" type="submit" name="btn_submit" class="submit">
                            <div class="lienhe">
                                <span>liên hệ nhà cung cấp</span>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
            <div class="chitietsp">
                <div class="đaciem">
                    <div class="name-tt">
                        <h2 class="sp-inf">Đặc điểm nổi bật</h2>
                        <h2 class="sp-inf">Thông số kỹ thuật</h2>
                        <h2 class="sp-inf">Đánh giá & Bình luận</h2>
                    </div>
                    <div class="description-pr">
                        <?= $row['description'] ?>
                    </div>
                </div>
                <div class="thongso">
                    <div class="name-tt">
                        <h2 class="sp-inf">Đặc điểm nổi bật</h2>
                        <h2 class="sp-inf">Thông số kỹ thuật</h2>
                        <h2 class="sp-inf">Đánh giá & Bình luận</h2>
                    </div>
                    <div class="thongso-pr">
                        <span><?= $row['thong_so_ky_thuat'] ?></span>
                    </div>
                </div>
                <div class="danhgia-binhluan">
                    <div class="name-tt">
                        <h2 class="sp-inf">Đặc điểm nổi bật</h2>
                        <h2 class="sp-inf">Thông số kỹ thuật</h2>
                        <h2 class="sp-inf">Đánh giá & Bình luận</h2>
                    </div>
                    <div class="comment-pr">
                        <div class="box-rating">
                            <span class="rate">Bài viết này có hữu ích cho bạn không ? </span>
                            <form action="" id="rating-form" method="POST">
                                <span class="rating_stars">
                                    <input type="radio" class="star" checked="" name="rating" value="5"><span class="stars"></span>
                                    <input type="radio" class="star" checked="" name="rating" value="4"><span class="stars"></span>
                                    <input type="radio" class="star" checked="" name="rating" value="3"><span class="stars"></span>
                                    <input type="radio" class="star" checked="" name="rating" value="2"><span class="stars"></span>
                                    <input type="radio" class="star" checked="" name="rating" value="1"><span class="stars"></span>
                                </span>
                                <span class="rating_title">Rất tốt</span>
                            </form>
                        </div>
                        <h3>đăng bình luận</h3>
                        <div class="form">
                            <div class="box-comment">
                                <input type="text" name="fullname" class="form_comment" id="username" placeholder="họ và tên">
                                <input type="text" name="captcha" class="form_comment" id=captcha placeholder="nhập mã captcha(*)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                <img src="/classes/securitycode.php?v=1599879963470" alt="captcha" class="img_captcha">
                                <span class="reload">🗘</span>
                            </div>
                            <div class="content-com">
                                <textarea class="form_comment" name="comment_content" id="comment_content" cols="30" rows="10" placeholder="nhập bình luận của bạn"></textarea>
                            </div>
                            <div class="form_group">
                                <input type="submit" id="btn_comment" name="btn_comment" data-rate="" data-idm="<?= $row['id']?>" value="Gửi" data-url="<?= $_SERVER['REQUEST_URI'] ?>">
                            </div>
                        </div>
                    </div>
                    <!-- list comment -->
                    <div id="list_comment">
                        <div class="cm_total"><span><?= (!empty($comment_sp)) ? count($comment_sp) : 0 ?></span> đánh giá cho <span><?= $row['name'] ?></span></div>
                        <div class="comment_sp">
                            <?
                            if(!empty($comments))
                            {
                                foreach($comments as $comment)
                                {
                            ?>
                            <div class="content_comment">
                                <div class="cm_user">
                                    <div class="img">
                                        <img src="/images/may_in_the/gia-ca.jpg" alt="avarta">
                                    </div>
                                    <div class="name">
                                        <strong><?= $comment['CreateBy'] ?></strong>
                                    </div>
                                </div>
                                <div class="cm_content"><?= $comment['Content'] ?></div>
                                <div class="reply_cm">
                                    <span class="reply_user" data-id="<?= $comment['CommentID'] ?>">trả lời</span>
                                    <span class="date"> | <?= date('d/m/Y', strtotime($comment['CreateDate'])) ?></span>
                                </div>
                                <div class="list_reply" id="cm_<?= $comment['CommentID'] ?>">
                                    <?
                                    if(!empty($reply[$comment['CommentID']]))
                                    {
                                        foreach($reply[$comment['CommentID']] as $item)
                                        {
                                        ?>
                                    <div class="reply" id="">
                                        <div class="cm_user">
                                            <div class="img">
                                                <img src="/images/may_in_the/mua-sam.jpg" alt="avarta">
                                            </div>
                                            <div class="name">
                                                <strong><?= $item['CreateBy'] ?></strong>
                                            </div>
                                        </div>
                                        <div class="cm_content"><?= $item['Content'] ?></div>
                                        <div class="reply_cm">
                                            <span class="reply_user" data-id="<?= $item['CommentID'] ?>">trả lời</span>
                                            <span class="date"> | <?= date('d/m/Y', strtotime($item['CreateDate'])) ?></span>
                                        </div>
                                    </div>
                                    <?
                                    }
                                    }
                                    ?>
                                </div>
                                <div class="reply_post hide">
                                    <div class="close_cp"><span>✖</span> </div>
                                    <div class="group_reply">
                                        <input type="text" name="fullname" class="form_comment" id="username" placeholder="họ và tên">
                                        <input type="text" name="captcha" class="form_comment" id="captcha" placeholder="nhập mã captcha(*)">
                                        <img src="/classes/securitycode.php?v=1599879963470" alt="captcha" class="img_captcha">
                                        <span class="reload">🗘</span>
                                    </div>
                                    <div class="content-com">
                                        <textarea class="form_comment" name="comment_content" id="comment_content" cols="30" rows="10" placeholder="nhập bình luận của bạn"></textarea>
                                    </div>
                                    <div class="form_group">
                                        <input type="submit" id="btn_reply" name="btn_reply" value="Gửi" data-url="<?= $_SERVER['REQUEST_URI'] ?>" data-id="<?= $comment['CommentID'] ?>">
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                        <?
                        }
                        }
                        ?>
                    </div>
                </div>
            </div>
            </div>
            <div class="sanpham-lq">
                <h3 class="title">sản phẩm liên quan</h3>
                <div class="yy"></div>
                <div class="slide">
                    <?
                    while($rownew = mysql_fetch_assoc($db_new->result))
                    {
                    ?>
                    <div class="box">
                        <div class="inf-tc">
                            <div class="form">
                                <div class="images">
                                    <div class="img-mayin" style="padding-top:91%;">
                                    <a title="<?= $rownew['name'] ?>" href="/may-in/<?= replaceTitle($rownew['name']) . "-" . $rownew['id'] ?>.html">
                                            <img src="/pictures/may_in/<?= $rownew['image'] ?>-1.jpg" alt="<?= $rownew['name'] ?>" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="title">
                                        <div class="">
                                            <h2><a href=""><?= $rownew['name'] ?></a></h2>
                                        </div>
                                    </div>
                                    <div class="gia">
                                        <div class="gia-tien">
                                            <a href=""><?= number_format($rownew['price'], 0, '.', '.') ?> <u>đ</u></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-buttom">
        <div class="col-md-9">
            <div class="group-iteam">
                <div class='col-12'>
                    <div class="item-img">
                        <img src="/images/may_in_the/thanh_toan.jpg" alt="Thanh toán an toàn">
                    </div>
                    <div class="tieude">
                        <p>Thanh toán an toàn</p>
                    </div>
                    <div class="nd">
                        <p>Phương thức thanh toán phổ biến nhất</p>
                    </div>
                </div>
                <div class='col-12'>
                    <div class="item-img">
                        <img src="/images/may_in_the/mua-sam.jpg" alt="Mua sắm với sự tự tin">
                    </div>
                    <div class="tieude">
                        <p>Mua sắm với sự tự tin</p>
                    </div>
                    <div class="nd">
                        <p>Bảo vệ người mua hàng trên hệ thống chúng tôi</p>
                    </div>
                </div>
                <div class='col-12'>
                    <div class="item-img">
                        <img src="/images/may_in_the/gia-ca.jpg" alt="Giá cả phù hợp">
                    </div>
                    <div class="tieude">
                        <p>Giá cả phù hợp</p>
                    </div>
                    <div class="nd">
                        <p>Cung cấp giá sản phẩm tốt trên hệ thống</p>
                    </div>
                </div>
                <div class='col-12'>
                    <div class="item-img">
                        <img src="/images/may_in_the/ho-tro.jpg" alt="Trung tâm trợ giúp 24/7">
                    </div>
                    <div class="tieude">
                        <p>Trung tâm trợ giúp 24/7</p>
                    </div>
                    <div class="nd">
                        <p>Hỗ trợ tận tâm để người dùng thoải mái nhất</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/usermanager.js"></script>
<? include("../includes/inc_footer.php") ?>
<script src="/js/slick.js" type="text/javascript"></script>
<script>
        $('.slider-for').slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        centerMode: true,
        centerPadding: '0px',
        asNavFor: '.slider-nav',
        responsive: [{
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false
            }
        }]
    });
    $('.slider-nav').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 0,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerMode: true,
        centerPadding: '0px',
        focusOnSelect: true,
        variableWidth: true,
        responsive: [{
            breakpoint: 480,
            settings: "slick"
        }]
    });

    $('.slide').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });


        // so luong
        var data_id = $('input.buy_quantity').attr('id');
        $('button.them').click(function() {
            var them = $(this).parents(".cart-quan").find('input.buy_quantity').val();
            var num_min = $(this).parents(".cart-quan").find('input.buy_quantity').attr("min")

            // console.log(them);
            if (them > num_min) {
                them = parseInt(them) - 1;
            }
            $(this).parent().find('input.buy_quantity').trigger('change').val(them);
            return false;
        });
        $('button.tru').click(function() {
            var tru = $(this).parent().find('input.buy_quantity').val();
            var num_max = $(this).parent().find('input.buy_quantity').attr("max");
            if (parseInt(tru) < num_max) {
                tru = parseInt(tru) + 1;
            }
            $(this).parent().find('input.buy_quantity').val(tru);
        });

        // rating
        $(".rating_title").hide();
        var ratingLevel = "";
        $(".star").hover(function() {
            var numStar = $(this).attr("value");
            if (numStar == 1) {
                ratingLevel = "Không thích";
            }
            if (numStar == 2) {
                ratingLevel = "Tạm được";
            }
            if (numStar == 3) {
                ratingLevel = "Bình thường";
            }
            if (numStar == 4) {
                ratingLevel = "Rất tốt";
            }
            if (numStar == 5) {
                ratingLevel = "Tuyệt vời";
            }
            $(".rating_title").text(ratingLevel);
            $(".rating_title").stop().fadeIn("slow");
        }, function() {
            $(".rating_title").stop().fadeOut(3000);
        });
        $(".star").click(function() {
            var numStar = $(this).attr("value");
            if (numStar == 1) {
                ratingLevel = "Không thích";
            }
            if (numStar == 2) {
                ratingLevel = "Tạm được";
            }
            if (numStar == 3) {
                ratingLevel = "Bình thường";
            }
            if (numStar == 4) {
                ratingLevel = "Rất tốt";
            }
            if (numStar == 5) {
                ratingLevel = "Tuyệt vời";
            }
            $(".rating_title").text(ratingLevel);
            $(".rating_title").stop().fadeIn("slow");
            $("#btn_comment").attr("data-rate", numStar);
        });
        // comment
        $("#show_post").click(function() {
            $(this).fadeOut("slow");
            $(".box_article").addClass("article_full");
        });
        $('.reload').click(function() {
            $('.img_captcha').attr('src', '/classes/securitycode.php?v=' + Date.now());
        });
        $('#btn_comment').click(function() {
            var comment_user = $(this).parents('.comment-pr').find('#username');
            var captcha = $(this).parents('.comment-pr').find('#captcha');
            var comment_content = $(this).parents('.comment-pr').find('#comment_content');
            var url_comment = $(this).attr('data-url');
            var rate = $(this).attr("data-rate");
            var id = $(this).attr("data-idm");
            // alert(rate);
            if (comment_user.length == 0) {
                alert('Vui lòng nhập họ và tên');
                comment_user.focus();
                return false;
            }
            if (captcha.val().length == 0) {
                alert('Bạn chưa nhập mã captcha');
                captcha.focus();
                return false;
            }
            if (comment_content.val().length == 0) {
                alert('Vui lòng nhập nội dung bình luận');
                comment_content.focus();
                return false;
            }
            var data = {
                url_comment: url_comment,
                comment_user: comment_user.val(),
                captcha: captcha.val(),
                comment_content: comment_content.val(),
                rate: rate,
                id: id
            };
            $.ajax({
                method: "POST",
                url: "/ajax/comment.php",
                dataType: "json",
                data: data,
                success: function(data) {
                    if (data.status == 0) {
                        alert(data.error);
                        $('.reload').click();
                    } else if (data.status == 1) {
                        $('.comment_sp').prepend(data.html);
                    }


                }
            });
        });

        $(document).ready(function() {
            $('.reply_user').click(function() {
                var id = $(this).attr('data-id');
                $(this).parents('.content_comment').find('.reply_post').removeClass('hide');
                $(this).parents('.content_comment').find('.reply_post').children('#btn_reply').attr('data-id', id);
            });
        });

        $('.close_cp span').click(function() {
            $('.reply_post').addClass('hide');
        });

        $('#btn_reply').click(function() {
            var comment_user = $('.reply_post #username');
            var captcha = $('.reply_post #captcha');
            var comment_content = $('.reply_post #comment_content');
            var id_reply = $(this).attr('data-id');
            var url_comment = $(this).attr('data-url');
            if (comment_user.val().length == 0) {
                alert('Vui lòng nhập họ và tên');
                comment_user.focus();
                return false;
            }
            if (captcha.val().length == 0) {
                alert('Bạn chưa nhập mã captcha');
                captcha.focus();
                return false;
            }
            if (comment_content.val().length == 0) {
                alert('Vui lòng nhập nội dung bình luận');
                comment_content.focus();
                return false;
            }

            $.ajax({
                type: "POST",
                url: "/ajax/reply_comment.php",
                dataType: "json",
                data: {
                    id_reply: id_reply,
                    url_comment,
                    comment_user: comment_user.val(),
                    captcha: captcha.val(),
                    comment_content: comment_content.val()
                },
                success: function(data) {
                    if (data.status == 1) {
                        var id  = '#cm_' + id_reply;
                        $(id).prepend(data.html);
                        $('.reload').click();
                        comment_content.val('')
                    } else {
                        console.log(data.error);
                        $('.reload').click();
                    }
                }
            });
        });
    </script>
</body>
</html>
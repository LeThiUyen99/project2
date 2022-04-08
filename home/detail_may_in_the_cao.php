<?
include("config.php"); 
$new_id = getValue("newid","int","GET",0);
if($new_id > 0){
$db_qr = new db_query("SELECT * FROM mayinthecao WHERE id = '".$new_id."' LIMIT 1");
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


$qrnew = new db_query("SELECT * FROM mayinthecao WHERE id != $new_id LIMIT 5");
if(mysql_num_rows($qrnew->result) > 0)
{
    $rownew = mysql_fetch_assoc($qrnew->result);
    $id = (int)$rownew['id'];
}else{
    redirect("404.shtml");
}
// if(isset($_POST['btn_comment'])){
//     setcookie()
// }
// $_COOKIE

$urlSite = $_SERVER['REQUEST_URI'];
$qrcomment = new db_query("SELECT * FROM comment WHERE url_cm = '$urlSite'");

$list_comment = array();
while($db_comment = mysql_fetch_assoc($qrcomment->result)){
    $list_comment[] = $db_comment; 
}
$reply = array();
foreach($list_comment as $key=>$item){
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
if(isset($_POST['btn_contact'])){
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHI TIẾT MÁY IN THẺ CÀO</title>
    <meta name="description" content='Bán thẻ điện thoại Viettel, Vina, Mobi,.. thẻ game với chiết khấu cao, chỉ bằng một vài thao tác đơn giản, nhanh chóng, đăng ký tài khoản miễn phí sử dụng dịch vụ.' />
   <meta name="keywords" content='ban the cao, bán thẻ cào, bán thẻ điện thoại, banthe247, bán thẻ viettel, bán thẻ điện thoại viettel' />
   <meta name="robots" content='noodp,index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <meta name="twitter:card" content="summary"/>
   <meta name="twitter:description" content="Banthe247.com - địa chỉ uy tín giúp bạn mua thẻ cào online giá rẻ, đăng ký tài khoản miễn phí để nhận chiết khấu từ 5% cho thẻ điện thoại."/>
   <meta name="twitter:title" content="Banthe247.com - Dịch vụ mua thẻ cào online chiết khấu cao, nhanh chóng nhất"/>
   <meta name="twitter:site" content="banthe247com"/>
   <meta property="og:image:url" content='https://banthe247.com/upload/files/mua-the-dien-thoai.png'>
   <meta property="og:image:width" content="476">
   <meta property="og:image:height" content="249">
   <meta property="og:title" itemprop="headline" content='Website bán thẻ cào điện thoại, thẻ game uy tín, giá rẻ nhất | Banthe247.com'>
   <meta property="og:url" itemprop="url" content='https://banthe247.com/'>
   <meta property="og:description" itemprop="description" content='Bán thẻ điện thoại Viettel, Vina, Mobi,.. thẻ game với chiết khấu cao, chỉ bằng một vài thao tác đơn giản, nhanh chóng, đăng ký tài khoản miễn phí sử dụng dịch vụ ngay.'>
   <meta property="og:type" content="website">
   <meta property="og:locale" content="vi_VN">
   <link rel="canonical" href='https://banthe247.com/' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/may_in_the_cao.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css" />
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/slick-theme.css">
</head>

<body>
    <? include("../includes/inc_header.php") ?>
    <div class="detail-container">
        <div class="tt-dt"><h1 class="title">MÁY IN THẺ CÀO</h1></div>
        <div class="detail-row">
            <div class="may_in">
                <div class="img">
                    <div class="slides_2">
                        <?
                    for($i = 1; $i <= 4; $i++)
                    {
                        $src ="/pictures/may_in/".$row['image']."-{$i}.jpg";
                        if(!isset($src)){break;}
                    ?>
                        <div class="pr_item"><img src="<?= $src ?>" alt="<?= $row['name'] . ' ' . $i ?>"></div>
                        <?
                    }
                    ?>
                    </div>
                    <!-- <img src="<?= $src ?>" alt=""> -->
                </div>
                <div class="info">
                    <div class="title">
                        <h1><?= $row['name'] ?></h1>
                    </div>
                    <!-- <div class="reating">
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div> -->
                    <div class="sub_bg">
                        <div class="rating">
                            <!-- <p>Đánh giá:</p> -->
                            <div class="wp_rate">
                                <div class="bg_rate">
                                    <div class="rate_range" style="width: <?= (!empty($rate_n)) ? $rate_n : 0 ?>;"></div>
                                    <div class="fake_rate"></div>
                                </div>
                                <div class="cm_total"><span>| <?= (!empty($list_comment)) ? count($list_comment) : 0 ?></span> đánh giá</div>
                                <!-- <a href="#user_comments" class="see_rate">(Xem đánh giá)</a> -->
                            </div>
                        </div>
                        <div class="tt"></div>
                    </div>
                    <div class="price">
                        <p><?= number_format($row['price'], 0, '.', '.') ?>đ</p>
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
                        <!-- <div class="buttom">
                        <a title="<?= $row['name'] ?>" href="/may-in/<?= replaceTitle($row['name']) . "-" . $row['id'] ?>/<?= replaceTitle($row['name']) . "-" . $row['id'] ?>.html">
                            <input type="submit" class="submit" value="LIÊN HỆ NHÀ CUNG CẤP">
                        </a>
                    </div> -->

                        <button rel="nofollow" type="submit" name="btn_contact" class="contact">
                            <div class="bg"></div>
                            <div class="lien-he">
                                <span>LIÊN HỆ NHÀ CUNG CẤP</span>
                            </div>

                        </button>
                    </form>
                </div>
            </div>
            <div class="chitiet">
                <h2><span class="num">01</span> <span> ĐẶC ĐIỂM NỔI BẬT</span></h2>
                <div class="dacdiem">
                    <p><?= $row['description'] ?></p>
                </div>
            </div>
            <div class="thongso">
                <h2><span class="num">02</span> <span> THÔNG SỐ KỸ THUẬT</span></h2>
                <div class="ts-kythuat">
                    <p><?= $row['thong_so_ky_thuat'] ?></p>
                </div>
            </div>
            <div class="comment">
                <h2><span class="num">03</span> <span> ĐÁNH GIÁ VÀ BÌNH LUẬN</span></h2>

                <div class="comment_post">
                    <p class="cp_title">Đăng bình luận</p>
                    <div class="mayin-cm">
                        <div class="form_group">
                            <input type="text" name="fullname" class="form_general" id="cm_user" placeholder="Họ và tên (*)">
                            <input type="text" name="captcha" class="form_general" id="captcha" placeholder="Nhập mã Captcha (*)" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                            <img src="/classes/securitycode.php?v=1599879963470" class="img_captcha" alt="captcha">
                            <span class="reload_captcha">🗘</span>
                        </div>
                        <div class="form_group">
                            <textarea class="form_general" name="comment_content" id="comment_content" cols="30" rows="10" placeholder="Nhập bình luận của bạn"></textarea>
                        </div>
                        <div class="box_rating">
                            <div>
                                <form id="rating-form" method="POST">
                                    <span class="rating_stars">
                                        <input class="icon_star" checked="" type="radio" name="rating" value="5"><span class="star"></span>
                                        <input class="icon_star" checked="" type="radio" name="rating" value="4"><span class="star"></span>
                                        <input class="icon_star" checked="" type="radio" name="rating" value="3"><span class="star"></span>
                                        <input class="icon_star" checked="" type="radio" name="rating" value="2"><span class="star"></span>
                                        <input class="icon_star" checked="" type="radio" name="rating" value="1"><span class="star"></span>
                                    </span>
                                    <span class="rating_title">Rất tốt</span>
                                </form>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="form_group text-right pr-4">
                            <input type="submit" id="btn_comment" name="btn_comment" data-rate="" data-idm="<?= $row['id']?>" value="Gửi đánh giá" data-url="<?= $_SERVER['REQUEST_URI'] ?>">
                        </div>
                    </div>
                </div>
                <!-- End comment_post -->
                <div id="user_comments">
                    <div class="cm_total"><span><?= (!empty($list_comment)) ? count($list_comment) : 0 ?></span> đánh giá cho <span><?= $row['name'] ?></span></div>

                    <ul class="list_comments">
                        <?
                    if(!empty($comments))
                    {
                        foreach($comments as $comment)
                        {
                            ?>
                        <li class="comment_content">
                            <div class="cm_username">
                                <div class="img"><img src="/images/may_in_the/gia_ca.png" alt="/images/may_in_the/gia_ca.png"></div><strong><?= $comment['cm_user'] ?></strong>
                                <div class="bg_rate">
                                    <div class="rate_range" style="width: <?= (!empty($rate)) ? $rate : 0; ?>%;"></div>
                                    <div class="fake_rate"></div>
                                </div>
                            </div>
                            <div class="user_comment"><?= $comment['Content'] ?></div>
                            <div class="reply_cm">
                                <span class="reply_user" data-id="<?= $comment['CommentID'] ?>">Trả lời</span>
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
                                    <div class="cm_username">
                                        <div class="img"><img src="/images/may_in_the/mua_sam.png" alt="/images/may_in_the/mua_sam.png"></div>
                                        <strong><?= $item['cm_user'] ?></strong>
                                    </div>
                                    <div class="user_comment"><?= $item['Content'] ?></div>
                                    <div class="reply_cm">
                                        <span class="reply_user" data-id="<?= $item['CommentID'] ?>">Trả lời</span>
                                        <span class="date"> | <?= date('d/m/Y', strtotime($item['CreateDate'])) ?></span>
                                    </div>
                                </div>
                                <?
                                }
                            }
                            ?>
                            </div>

                            <div class="comment_post reply_post hide">
                                <div class="close_cp text-right"><span>✖</span></div>
                                <div class="form_group">
                                    <input type="text" name="fullname" class="form_general" id="cm_user" placeholder="Họ và tên (*)">
                                    <input type="text" name="captcha" class="form_general" id="captcha" placeholder="Nhập mã Captcha (*)">
                                    <img src="/classes/securitycode.php" class="img_captcha" alt="captcha">
                                    <span class="reload_captcha">🗘</span>
                                </div>
                                <div class="form_group">
                                    <textarea class="form_general" name="comment_content" id="comment_content" cols="30" rows="10" placeholder="Nhập bình luận của bạn"></textarea>
                                </div>
                                <div class="form_group text-right pr-4">
                                    <input type="submit" id="btn_reply" name="btn_reply" value="Gửi đánh giá" data-url="<?= $_SERVER['REQUEST_URI'] ?>" data-id="<?= $comment['CommentID'] ?>">
                                </div>
                            </div>
                        </li>
                        <?
                                }
                                }
                                ?>
                    </ul>
                </div>



            </div>

            <div class="san-pham">
                <h3>SẢN PHẨM LIÊN QUAN</h3>
                <div class="slides">
                    <?
                    while($rownew = mysql_fetch_assoc($qrnew->result))
                    {
                    ?>
                    <div class="group-col-3">
                        <div class="sp_lq">
                            <div class="item">
                                <div class="img">
                                    <div class="img-col-3">
                                        <a title="<?= $rownew['name'] ?>" href="/may-in/<?= replaceTitle($rownew['name']) . "-" . $rownew['id'] ?>.html">
                                            <img src="/pictures/may_in/<?= $rownew['image'] ?>-1.jpg" alt="<?= $rownew['name'] ?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="infor-col">
                                    <div class="price-col">
                                        <p class="price"><?= number_format($rownew['price'], 0, '.', '.') ?> <u>đ</u></p>
                                    </div>
                                    <div class="title">
                                        <h2><a href="" class="title-sp" title=""><?= $rownew['name'] ?></a></h2>
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

            <div class="col-md-9">
                <div class="group-iteam">
                    <div class='col-12'>
                        <div class="tieude">
                            <p>Thanh toán an toàn</p>
                        </div>
                        <div class="item-img">
                            <img src="/images/may_in_the/thanh_toan.png" alt="/images/may_in_the/thanh_toan.png">
                        </div>
                    </div>
                    <div class='col-12'>
                        <div class="tieude">
                            <p>Giá cả phù hợp</p>
                        </div>
                        <div class="item-img">
                            <img src="/images/may_in_the/gia_ca.png" alt="/images/may_in_the/gia_ca.png">
                        </div>
                    </div>
                    <div class='col-12'>
                        <div class="tieude">
                            <p>Mua sắm với sự tự tin</p>
                        </div>
                        <div class="item-img">
                            <img src="/images/may_in_the/mua_sam.png" alt="/images/may_in_the/mua_sam.png">
                        </div>
                    </div>
                    <div class='col-12'>
                        <div class="tieude">
                            <p>Hỗ trợ 24/7</p>
                        </div>
                        <div class="item-img">
                            <img src="/images/may_in_the/ho_tro.png" alt="/images/may_in_the/ho_tro.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- comment
    <img src="/classes/securitycode.php" alt=""> -->
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/usermanager.js"></script>

    <? include("../includes/inc_footer.php") ?>

    <script src="/js/slick.js" type="text/javascript"></script>
    <script>
        $('.slides_2').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.slides').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
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
        $(".icon_star").hover(function() {
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
        $(".icon_star").click(function() {
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
        $("#show_post").click(function() {
            $(this).fadeOut("slow");
            $(".box_article").addClass("article_full");
        });
        $('.reload_captcha').click(function() {
            $('.img_captcha').attr('src', '/classes/securitycode.php?v=' + Date.now());
        });
        $('#btn_comment').click(function() {
            var comment_user = $(this).parents('.mayin-cm').find('#cm_user');
            var captcha = $(this).parents('.mayin-cm').find('#captcha');
            var comment_content = $(this).parents('.mayin-cm').find('#comment_content');
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
                        $('.reload_captcha').click();
                    } else if (data.status == 1) {
                        $('.list_comments').prepend(data.html);
                    }


                }
            });
        });

        $(document).ready(function() {
            $('.reply_user').click(function() {
                var id = $(this).attr('data-id');
                $(this).parents('.comment_content').find('.reply_post').removeClass('hide');
                $(this).parents('.comment_content').find('.reply_post').children('#btn_reply').attr('data-id', id);
            });
        });

        $('.close_cp span').click(function() {
            $('.reply_post').addClass('hide');
        });

        $('#btn_reply').click(function() {
            var comment_user = $('.reply_post #cm_user');
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
                        $('.reload_captcha').click();
                        comment_content.val('')
                    } else {
                        console.log(data.error);
                        $('.reload_captcha').click();
                    }
                }
            });
        });
    </script>
</body>

</html>
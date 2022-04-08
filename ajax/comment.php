<?
include("config.php"); 
$url_comment = getValue("url_comment","str","POST",0);
$comment_user = getValue("comment_user","str","POST",0);
$comment_content = getValue("comment_content","str","POST",0);
$captcha = getValue("captcha","int","POST",0);
$rate  = getValue("rate","int","POST",0);
$id  = getValue("id","int","POST",0);
if($captcha != $_SESSION['code']){
    $data = array(
        'status' => 0,
        'error' => "Mã captcha chưa đúng"
    );
}else{
    $update = new db_query("UPDATE mayinthecao SET `rating` = 'rating' + '$rate' ,`numrate` = 'numrate' + 1 WHERE id = '$id'");
    $insert = new db_query("INSERT INTO comment (`url_cm`,`CreateBy`,`Content`,`CreateDate`,`Status`) VALUES ('$url_comment','$comment_user','$comment_content',NOW(),'1')");
    $db_new = new db_query("SELECT CommentID,rating,numrate FROM comment WHERE `url_cm` = '$url_comment' ORDER BY CommentID DESC LIMIT 1");
    $rownew = mysql_fetch_assoc($db_new->result);
    
    $rate_n = ceil($rate/5);
    $rate_n *100;
    $rate_n=$rate_n."%";
    $data = array(
        'status' => 1,
        'html' => '


        <div class="comment_sp">
            <div class="content_comment">
                <div class="cm_user">
                    <div class="img">
                        <img src="/images/may_in_the/" alt="">
                    </div>
                    <div class="name">
                        <strong>'.$comment_user.'</strong>
                    </div>
                </div>
                <div class="comment_content">'.$comment_content.'</div>
                <div class="reply_cm">
                    <span class="reply_user" data-id="'.$rownew['CommentID'].'">trả lời</span>
                    <span class="date"> | '.date('d/m/Y').'</span>
                </div>
                <div class="list_reply" data-url="'.$url_comment.'" id="cm_'.$rownew['CommentID'].'">

                </div>
                <div class="reply_post hide">
                    <div class="close_up">✖</div>
                    <div class="group_reply">
                        <input type="text" name="fullname" class="form_comment" id="username" placeholder="họ và tên">
                        <input type="text" name="captcha" class="form_comment" id="captcha" placeholder="nhập mã captcha(*)">
                        <img src="/classes/securitycode.php?v=1599879963470" alt="captcha" class="img_captcha">
                    </div>
                    <div class="content-com">
                        <textarea class="form_comment" name="comment_content" id="comment_content" cols="30" rows="10" placeholder="nhập bình luận của bạn"></textarea>
                    </div>
                    <div class="form_group">
                        <input type="submit" id="btn_reply" name="btn_reply" data-url="'.$url_comment.'"  data-id="'.$rownew['CommentID'].'>
                    </div>
                </div>
            </div>
        </div>
        '
    );
}
echo json_encode($data);



                            
                            
                            
                            
                            
                        
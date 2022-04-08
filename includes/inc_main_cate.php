<script>
      $(document).ready(function () { 
         var url = window.location.href; 
         var page = window.location.href.split('?page=')[1]; 
         var totalPage = $("#tongSoTrang").text(); 
         if (parseInt(page) > parseInt(totalPage)) { 
            var newUrl = url.replace("page=" + page, "page=" + totalPage); 
            window.location = newUrl; } }); 
</script> 
<h1 class="page_title"><?= $rowinfo['CategoryName'] ?></h1>
        <div class="list_title">
          <? 
          While($rowcate = mysql_fetch_assoc($db_qrcat->result))
                     {
                         if($rowcate['ShortTitle'] != NULL)
                     {
                        $urlshort = $rowcate['ShortTitle'];
                     }
                     else
                     {
                        $urlshort = $rowcate['Title'];
                     }
                     $src=$rowcate['ImageUrl'];
                     if(strpos($rowcate['ImageUrl'],'/upload/files') === false)
                     {
                        $src="/pictures/news/".$rowcate['ImageUrl'];
                     }
          ?>
          <div class="new_item">
            <div class="new_item_img col-md-3 col-sm-3">
            <a href="<?= rewrite_news($rowcate['Id'],$urlshort,$rowcate['categoryname']) ?>" class="thumbnail">
                        <img alt="<?= $rowcate['Title'] ?>" src="<?= $src ?>" width="300" height="211" class="media-object lazy wp-post-image" style="display: block;"> </a> 
              
            </div>
            <div class="new_title col-md-9 col-sm-9" style="max-height: 150px;overflow: hidden;">
              <h2 class="heading_title"><a title="<?= $rowcate['Title'] ?>" href="<?= rewrite_news($rowcate['Id'],$urlshort,$rowcate['categoryname']) ?>"><?= $rowcate['Title'] ?></a></h2>
              <div class="box-meta"><i class="glyphicon glyphicon-time"></i> Cập nhật: <?= date("d/m/Y h:i:s A",strtotime($rowcate['PublicDate'])) ?></div>
              <div class="title">
              <?= trim(removeHTML($rowcate['Intro'])) ?>  
              </div>
            </div>
          </div>
          <div class="clear"></div>
          <?}?>
        </div>
        <div class="pull-right pagination">
                        <div class="col-sm-12" style="text-align:right">
                           <ul class="pagination">
                              <?
                              echo generatePageBar3('',$page,$curentPage,$count,rewriteNews($catid,$rowinfo['CategoryName']),'?','','active','preview','<','next','>','first','Đầu','last','Cuối');
                              ?>
                              <li style="display:none" id="tongSoTrang"><?= $pageccr ?></li>
                           </ul>
                        </div>
                     </div>

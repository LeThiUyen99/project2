
                  <?
                  while($rowcate = mysql_fetch_assoc($db_qrcat->result))
                  {
                  ?>
                  <div class="new_answer">
                      <h2 class="media-heading">  
                        <a title="<?= $rowcate['Title'] ?>" href="<?= rewrite_news($rowcate['FaqID'],$rowcate['Title'],"chuyen-muc-hoi-dap") ?>"><?= $rowcate['Title'] ?></a> 
                      </h2>
                      <div class="news_excerpt"> 
                      <?= trim(removeHTML($rowcate['Answer'])) ?>
                    <a class="btn btn-right-default" style="float:right" href="<?= rewrite_news($rowcate['FaqID'],$rowcate['Title'],"chuyen-muc-hoi-dap") ?>">Xem tiếp</a>
                      <div class="clear"></div>
                    </div>
                  </div>
                 
                  <?
                  }
                  ?>
                  <div style="clear:both;height:20px;"></div>
                  <?
                  if($page > 1)
                  {
                  ?>
                  <div class="row phantrang">
                     <div class="" style="text-align:right">
                        <ul class="pagination">
                           <?
                           echo generatePageBar3('',$page,$curentPage,$count,"/chuyen-muc-hoi-dap",'?','','active','preview','<','next','>','first','Đầu','last','Cuối');
                           ?>
                           <li style="display:none" id="tongSoTrang"><?= $pageccr ?></li>
                        </ul>
                     </div>
                  </div>
                  <?
                  }
                  ?>
                
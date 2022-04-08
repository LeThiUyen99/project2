
   <div class="news-content">
      <div class="article">
         <span class="subtitle"></span> 
         <h1 class="title"><?= $row1['Title'] ?></h1>
         <span class="date_cate" style="display:block;text-align:right;margin-bottom:5px;"> Cập nhật: <?= date("d/m/Y h:i:s A",strtotime($row1['PublicDate'])) ?></span> 
         <div class="new_description">
            
               <p><?= trim($row1['Intro']) ?></p>
               <?= $row1['Description'] ?>
            
         </div>
         <div class="clearThis"> </div>
      </div>
      <div class="clearThis"></div>
   </div>
   <div style="margin-bottom: 10px; clear: both;">
      <div class="relate-link">
         <span>Các tin khác</span> 
         <div class="clear">
            <ul>
               <?
               $db_qrnew = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                                         FROM articles 
                                         LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                         WHERE IsActive = 1 AND articles.categoryid = '".$row1['categoryid']."'
                                         AND Id <> '".$row1['Id']."' 
                                         ORDER BY PublicDate DESC LIMIT 5");
               While($rownew = mysql_fetch_assoc($db_qrnew->result))
               {
               if($rownew['ShortTitle'] != NULL)
               {
                  $urlshortde = $rownew['ShortTitle'];
               }
               else
               {
                  $urlshortde = $rownew['Title'];
               }
               ?>
               <li><a title="<?= $rownew['Title'] ?>" href="<?= rewrite_news($rownew['Id'],$urlshortde,$rownew['categoryname']) ?>"><?= $rownew['Title'] ?></a></li>
               <?
               unset($urlshortde);
               }
               unset($db_qrnew,$rownew);
               ?>
            </ul>
         </div>
      </div>
   </div>

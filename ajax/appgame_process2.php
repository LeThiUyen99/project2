<div class="list_show_more">
    <?
    include("config.php");
    $id = getValue("id", "int", "POST", 0);
    $id = $id * 5;
    $catid = getValue("catid", "int", "POST", 0);
    $db_qr   = new db_query("SELECT * FROM categories");
    $db_cat  = $db_qr->result_array('CategoryID');
    $db_loadmore = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy,articles.Description,view
                                FROM articles 
                                LEFT JOIN categories ON categories.CategoryID = $catid
                                WHERE IsActive = 1 AND category_parent_id = categories.CategoryID
                                ORDER BY view DESC, Id DESC LIMIT $id,4");

    while ($row6 = mysql_fetch_assoc($db_loadmore->result)) {
        if (array_key_exists($row6['category_parent_id'], $db_cat)) {
            $CategoryName3 = $db_cat[$row6['category_parent_id']]['CategoryName'];
            $gt_name4 = rewriteNews($row6['category_parent_id'], $CategoryName3);
        }
        $url3 = rewrite_news($row6['Id'], $row6['ShortTitle'], 'game-app');
    ?>
        <div class="box_game_3">
            <a href="<?= $url3 ?>" title="<?= $row6['Title'] ?>" class="game_thumb_3"><img src="https://banthe247.com/pictures/news/<?= $row6['ImageUrl']; ?>" alt="<?= $row6['Title'] ?>"></a>
            <a href="<?= $url3 ?>" title="<?= $row6['Title'] ?>" class="game_name_3"><?= $row6['Title'] ?></a>
            <a href="<?= $gt_name4 ?>" class="game_type_2" title="Xem thêm game <?= $CategoryName3 ?>"><?= $CategoryName3 ?></a>
            <p class="game_public">
                <img src="/images/app_game/ic_clock_xam.png" alt="clock">
                <span><?= date("d/m/Y   h:i:s A", strtotime($row6['PublicDate'])) ?></span>
            </p>
        </div>
    <?
    }
    ?>
</div>
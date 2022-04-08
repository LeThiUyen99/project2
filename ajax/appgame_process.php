
<div class="box_game_t"><?
include("config.php");
$id = getValue("id", "int", "POST", 0);
$id = $id * 4;
$catid = getValue("catid", "int", "POST", 0);

$db_loadmore = new db_query("SELECT Id,articles.categoryid,CategoryName,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,ShortTitle,category_parent_id,new_tdgy,new_ndgy,articles.Description
                            FROM articles 
                            LEFT JOIN categories ON categories.CategoryID = $catid
                            WHERE IsActive = 1 AND category_parent_id = categories.CategoryID
                            ORDER BY view DESC, Id DESC LIMIT $id,4");
$i2 = 0;

while ($row2 = mysql_fetch_assoc($db_loadmore->result)) {
    $url2 = rewrite_news($row2['Id'], $row2['ShortTitle'], 'app-tro-choi');
    $i2++;
?>
    <div class="box_game_2" data-id="<?= $row2['Id'] ?>">
        <div class="bg_box">
            <img src="https://banthe24h.vn//pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>">
            <div>
                <p class="game_type"><?= $row2['CategoryName'] ?></p>
                <div class="game_desc_2">
                    <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>" class="game_name_2"><?= $row2['Title'] ?></a>
                    <p class="game_public">
                        <img src="/images/app_game/ic_clock_xanh.png" alt="clock">
                        <span><?= date("d/m/Y   h:i:s A", strtotime($row2['PublicDate'])) ?></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?
    if ($i2 == 1) {
        break;
    }
}
?>
<?
while ($row2 = mysql_fetch_assoc($db_loadmore->result)) {
    $url2 = rewrite_news($row2['Id'], $row2['ShortTitle'], 'app-tro-choi');
?>
    <div class="box_game_3" data-id="<?= $row2['Id'] ?>">
        <div class="box_show">
            <a href="<?= $url2 ?>" title="<?= $row2['Title'] ?>"><img src="https://banthe24h.vn//pictures/news/<?= $row2['ImageUrl']; ?>" alt="<?= $row2['Title'] ?>"></a>
            <div class="game_desc_3">
                <a href="<?= $url2 ?>" class="game_name_3"><?= $row2['Title'] ?></a>
                <p class="game_public">
                    <img src="/images/app_game/ic_clock_xam.png" alt="clock">
                    <span><?= date("d/m/Y   h:i:s A", strtotime($row2['PublicDate'])) ?></span>
                </p>
                <p class="game_type"><?= $row2['CategoryName'] ?></p>
            </div>
        </div>
        <div class="box_hover"><a href="<?= $url2 ?>" class="see_more_hg">Xem thêm</a></div>
    </div>
<?
    $i2++;
}
?>
<div style="clear: both;"></div>
</div>

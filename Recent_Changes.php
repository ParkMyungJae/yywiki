<?php
$RecentSql = "SELECT * FROM `yy_wiki_process` ORDER BY `id` DESC LIMIT 10";
$RecentData = fetchAll($con, $RecentSql);
?>

<div class="Recent_Changes">
    <table class="ui teal table darkTableSet">
        <thead>
            <tr>
                <th>최근 변경</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($RecentData as $item) : ?>
                <tr>
                    <td><a href="<?= "viewer.php?board_id=" . $item->board_id ?>"><?= $item->title ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
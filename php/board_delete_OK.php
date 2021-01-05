<?php
require("db.php");


if (isset($_GET['board_id'])) {
    $id = $_GET['board_id'];

    $loadSql = "SELECT * FROM `yy_wiki_board` WHERE id = ?";
    $loadData = fetch($con, $loadSql, $param = [$id]);

    $psSql = "INSERT INTO `yy_wiki_process`(`board_id`,`category`, `category_src`, `title`, `date`, `status`) VALUES (?, ?, ?, ?, ?, ?)";
    query($con, $psSql, $param = [$id, $loadData->category, $loadData->category_src, $loadData->title, $loadData->date, "게시글 삭제"]);

    $sql = "DELETE FROM `yy_wiki_board` WHERE id = ?";
    $cnt = query($con, $sql, $param = [$id]);
} else {
    echo "장애가 발생하였습니다.";
}

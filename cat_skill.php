<?php
require("./php/db.php");

if (!isset($_SESSION['user'])) {
    echo ('<script> window.location.href = "../login.php"; </script>');
}

if (isset($_SESSION['user']->id)) {
    if ($_SESSION['user']->id == "admin") {
        echo ('<script> window.location.href = "../admin.php"; </script>');
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;

if (!is_numeric($page)) $page = 1;

$sql = "SELECT COUNT(*) AS cnt FROM yy_wiki_board WHERE `category` = '기능반 소개'";
$data = fetch($con, $sql);

$totalCnt = $data->cnt;
$ppn = 25; //페이지당 글의 수
$totalPage = ceil($totalCnt / $ppn);

$cpp = 6; // 챕터당 페이지수

$endPage = ceil($page / $cpp) * $cpp;
$startPage = $endPage - $cpp + 1;

$prev = true;
$next = true;

if ($endPage >= $totalPage) {
    $endPage = $totalPage;
    $next = false;
}

if ($startPage == 1) {
    $prev = false;
}

$cat_skill_sql = "SELECT `id`, `category`, `category_src`, `title`, `ip` FROM `yy_wiki_board` WHERE `category` = '기능반 소개'  ORDER BY `id` DESC Limit " . ($page - 1) * 25 . ", 25";
$cat_yywiki_Result = fetchAll($con, $cat_skill_sql);

?>

<!DOCTYPE html>
<html lang="ko">

<title>양디위키 - 기능반 소개</title>
<?php require("head.php"); ?>

<body>
    <?php require("header.php"); ?>

    <div class="container">
        <div class="viewer">
            <div class="main" style="min-height: 1000px;">
                <h1 style="color: #373a3c;">기능반 소개</h1>
                <div class="white-border" style="border: 1px solid #888; border-radius: 5px; margin: 10px 0; padding: 5px;">분류 : <a href="cat_skill.php">기능반 소개</a></div>

                <div style="text-align: right;">
                    <a href="newDocument.php">[새 문서 만들기]</a>
                </div>

                <table class="table table-striped text-center table-hover table-set">
                    <thead>
                        <tr>
                            <th scope="col" class="tableCat">카테고리</th>
                            <th scope="col" class="tableTitle">제목</th>
                            <th scope="col" class="tableIP">아이피</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cat_yywiki_Result as $item) : ?>
                            <tr>
                                <td><a href="<?= $item->category_src ?>"><?= $item->category ?></a></td>
                                <td class="title"><a href="<?= "/viewer.php?board_id=" . $item->id ?>" class="title"><?= $item->title ?></a></td>
                                <td><?= $item->ip ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $prev ? "" : "disabled" ?>">
                            <a class="page-link" href="/cat_skill.php?page=<?= $startPage - 1 ?>" tabindex="-1">이전</a>
                        </li>

                        <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
                            <li class="page-item <?= $i == $page ? "active" : "" ?>">
                                <a class="page-link" href="/cat_skill.php?page=<?= $i ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $next ? "" : "disabled" ?>">
                            <a class="page-link" href="/cat_skill.php?page=<?= $endPage + 1 ?>">다음</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <?php require("Recent_Changes.php") ?>
        </div>

        <?php require("copy.php"); ?>
    </div>

    <?php require("footer.php"); ?>
</body>

</html>
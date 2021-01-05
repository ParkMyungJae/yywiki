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

$sqlPS = "SELECT COUNT(*) AS cnt FROM yy_wiki_ip";
$data = fetch($con, $sqlPS);

$totalCnt = $data->cnt;
$ppn = 50; //페이지당 글의 수
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

$ipSql = "SELECT * FROM `yy_wiki_ip` ORDER BY `id` DESC LIMIT " . ($page - 1) * 50 . ", 50";
$ipData = fetchAll($con, $ipSql);

?>

<!DOCTYPE html>
<html lang="ko">

<title>양디위키 - 최근 접속자 목록</title>
<?php require("head.php"); ?>

<body>
    <?php require("header.php"); ?>

    <div class="container">
        <div class="viewer">
            <div class="main" style="width: 100% !important; min-height: 1000px;">
                <h1 style="color: #373a3c;">최근 접속자 목록</h1>
                <div class="white-border" style="border: 1px solid #888; border-radius: 5px; margin: 10px 0; padding: 5px;">분류 : <a href="connect.php">최근 접속자 목록</a></div>

                <div style="text-align: right;">
                    <a href="newDocument.php">[새 문서 만들기]</a>
                </div>

                <table class="table table-striped text-center table-hover table-set">
                    <thead>
                        <tr>
                            <th scope="col" class="tableCat" style="width: 50%;">아이피</th>
                            <th scope="col" class="tableTitle" style="width: 50%;">접속일시</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ipData as $item) : ?>
                            <tr>
                                <td><a><?= $item->ip ?></a></td>
                                <td><a><?= $item->connection_time ?></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $prev ? "" : "disabled" ?>">
                            <a class="page-link" href="/connect.php?page=<?= $startPage - 1 ?>" tabindex="-1">이전</a>
                        </li>

                        <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
                            <li class="page-item <?= $i == $page ? "active" : "" ?>">
                                <a class="page-link" href="/connect.php?page=<?= $i ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $next ? "" : "disabled" ?>">
                            <a class="page-link" href="/connect.php?page=<?= $endPage + 1 ?>">다음</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <?php require("copy.php"); ?>
    </div>

    <?php require("footer.php"); ?>
</body>

</html>
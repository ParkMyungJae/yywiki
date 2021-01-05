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

$cat_yywiki_sql = "SELECT `id`, `category`, `category_src`, `title`, `ip` FROM `yy_wiki_board` WHERE `category` = '양디위키'  ORDER BY `id` DESC Limit 5";
$cat_yywiki_Result = fetchAll($con, $cat_yywiki_sql);

?>

<!DOCTYPE html>
<html lang="ko">

<title>양디위키</title>
<?php require("head.php"); ?>

<body>
    <?php require("header.php"); ?>

    <div class="container">
        <div class="viewer">
            <div class="main">
                <h1 style="color: #373a3c;">양디위키 : 대문</h1>
                <div class="white-border" style="border: 1px solid #888; border-radius: 5px; margin: 10px 0; padding: 5px;">분류 : <a href="cat_yywiki.php">양디위키</a></div>

                <p class="white-borderY" style="margin: 20px 0; padding: 15px; text-align: center; font-size: 15px; border-top: 1px solid #888; border-bottom: 1px solid #888;">
                    <span style="font-weight: bold; font-size: 20px;">여러분이 가꾸어 나가는 <span class="dark-orange" style="color: #00a495;">지식의 나무</span></span> <br>
                    <span class="dark-orange" style="color: #00a495;">양디위키</span>에 오신 것을 환영합니다! <br>
                    <span id="darkStatus" style="color: #fff;">디바이스 테마에 따라 양디위키의 테마가 달라집니다.</span>
                    <br>
                    
                    양디위키는 누구나 기여할 수 있는 위키입니다. <br>
                    검증되지 않았거나 편향된 내용이 있을 수 있습니다. <br>
                </p>

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

                <div style="text-align: right;">
                    <a href="cat_yywiki.php" style="text-align: right">
                        [ 더보기 ]
                    </a>
                </div>
            </div>

            <?php require("Recent_Changes.php") ?>
        </div>

        <div class="viewer">
            <div class="category">
                <div class="row categoryRow viewer-dark dark-border-top" style="background: #00a495; color: #fff; text-align: center; font-size: 20px; font-weight: bold;">
                    <div class="col-lg">양디위키 카테고리</div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol"><a href="cat_yywiki.php">양디위키</a></div>
                    <div class="col categoryCol"><a href="cat_yyIntro.php">학교 소개</a></div>
                    <div class="col categoryCol"><a href="cat_school_skill.php">전공 과 소개</a></div>
                    <div class="col categoryCol"><a href="recent.php">최근 변경</a></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol"><a href="cat_skill.php">기능반 소개</a></div>
                    <div class="col categoryCol"><a href="cat_skill_service.php">기능반 편의시설</a></div>
                    <div class="col categoryCol"><a href="cat_skill_class.php">기능반 수업</a></div>
                    <div class="col categoryCol"><a href="cat_skill_lib.php">기능 학습 자료실</a></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol"><a href="cat_Q&A.php">Q&A 게시판</a></div>
                    <div class="col categoryCol"><a href="cat_bulletin_board.php">자유게시판</a></div>
                    <div class="col categoryCol"><a href="cat_bug.php">버그 및 요청 게시판</a></div>
                    <div class="col categoryCol"><a href="connect.php">최근 접속자 목록</a></div>
                </div>
            </div>
        </div>

        <?php require("copy.php"); ?>
    </div>

    <?php require("footer.php"); ?>
</body>

</html>

<script>
    if(window.matchMedia("(prefers-color-scheme: dark)").matches) {
        // alert("다크모드 테스트");
        // window.matchMedia("(prefers-color-scheme: no-preference)");
    }

    // window.matchMedia("(prefers-color-scheme: no-preference)").onchange =true;
</script>
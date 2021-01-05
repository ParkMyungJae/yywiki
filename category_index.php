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

<script>
    console.log("%c잠깐만!", "color: red; text-shadow: 1px 2px #000; font-weight:900; font-size: 60px");
    console.log("%c이 기능은 개발자용으로 브라우저에서 제공되는 내용입니다. 누군가 Thefunnybook 기능을 사용하거나 다른 사람의 계정을 \"해킹\"하기 위해 여기에 특정 콘텐츠를 복사하여 붙여넣으라고 했다면 사기 행위로 간주하세요. 이 기능은 회원님의 Thefunnybook 계정에 대한 액세스 권한을 상대편에게 부여하는 것입니다.", "color: #000; font-weight:900; font-size: 15px");
    console.log("%c자세한 정보는 http://localhost/xhelp.php 에서 확인해주세요.", "color: #000; font-weight:900; font-size: 15px");
</script>

<body>
    <?php require("header.php"); ?>

    <div class="container">
        <div class="viewer">
            <div class="category" style="margin-top: 30px;">
                <div class="row categoryRow viewer-dark dark-border-top" style="background: #00a495; color: #fff; text-align: center; font-size: 20px; font-weight: bold;">
                    <div class="col-lg p-1">양디위키 카테고리</div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol" style="height: 60px;"><a href="cat_yywiki.php">양디위키</a></div>
                    <div class="col categoryCol" style="height: 60px;"><a href="cat_yyIntro.php">학교 소개</a></div>
                    <div class="col categoryCol" style="height: 60px;"><a href="cat_school_skill.php">전공 과 소개</a></div>
                    <div class="col categoryCol" style="height: 60px;"><a href="recent.php">최근 변경</a></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol" style="height: 60px;"><a href="cat_skill.php">기능반 소개</a></div>
                    <div class="col categoryCol" style="height: 60px;"><a href="cat_skill_service.php">기능반 편의시설</a></div>
                    <div class="col categoryCol" style="height: 60px;"><a href="cat_skill_class.php">기능반 수업</a></div>
                    <div class="col categoryCol" style="height: 60px;"><a href="cat_skill_lib.php">기능 학습 자료실</a></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol" style="height: 60px;"><a href="cat_Q&A.php">Q&A 게시판</a></div>
                    <div class="col categoryCol" style="height: 60px;"><a href="cat_bulletin_board.php">자유게시판</a></div>
                    <div class="col categoryCol" style="height: 60px;"><a href="cat_bug.php">버그 및 요청 게시판</a></div>
                    <div class="col categoryCol" style="height: 60px;"><a href="connect.php">최근 접속자 목록</a></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                </div>

                <div class="row categoryRow viewer-dark">
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                    <div class="col categoryCol" style="height: 60px;"></div>
                </div>
            </div>
        </div>

        <?php require("copy.php"); ?>
    </div>

    <?php require("footer.php"); ?>
</body>

</html>
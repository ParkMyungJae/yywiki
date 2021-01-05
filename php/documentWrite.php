<?php
header("Content-Type: application/json");
require("db.php");

/*  문서 작성 POST  */
$categoryName = $_POST["categoryName"];
$editTitle = $_POST["editTitle"];
$date = date("Y-m-d H:i:s");
$ip = $_SESSION['user'];
$cat_src = null;

$categoryName = htmlentities($categoryName);
$editTitle = htmlentities($editTitle);
$date = htmlentities($date);
$ip = htmlentities($ip);
$upfile = $_FILES["imgUploadInput"];
$imgViewer = $_POST["imgViewer"];
$editer_area = $_POST["editer_area"];
$editer_area = htmlentities($editer_area);
$imgViewer = htmlentities($imgViewer);

$board_idx_sql = "SELECT max(`board_id`) as board_id FROM `yy_wiki_process`";
$board_idx = fetch($con, $board_idx_sql);

// 수정모드
$doc_id = $_POST['doc_id'];

/*  카테고리 SRC 분류  */
if ($categoryName == "양디위키") {
    $cat_src = "/cat_yywiki.php";
}

if ($categoryName == "학교 소개") {
    $cat_src = "/cat_yyIntro.php";
}

if ($categoryName == "전공 과 소개") {
    $cat_src = "/cat_school_skill.php";
}

if ($categoryName == "기능반 소개") {
    $cat_src = "/cat_skill.php";
}

if ($categoryName == "기능반 편의시설") {
    $cat_src = "/cat_skill_service.php";
}

if ($categoryName == "기능반 수업") {
    $cat_src = "/cat_skill_class.php";
}

if ($categoryName == "기능 학습 자료실") {
    $cat_src = "/cat_skill_lib.php";
}

if ($categoryName == "Q&A 게시판") {
    $cat_src = "/cat_Q&A.php";
}

if ($categoryName == "자유게시판") {
    $cat_src = "/cat_bulletin_board.php";
}

if ($categoryName == "버그 및 요청 게시판") {
    $cat_src = "/cat_bug.php";
}


if ($doc_id == 0) {
    // 새 글쓰기 모드

    if (empty($editer_area) == true) {
        $upfile["tmp_name"];
        $src = "/upload/" . $upfile['name'];
        move_uploaded_file(
            $upfile["tmp_name"],
            "." . $src
        );

        // 밑에 SQL 적기
        $sql = "INSERT INTO `yy_wiki_board`(`category`, `category_src`, `title`, `img`, `ip`, `date`) VALUES (?, ?, ?, ?, ?, ?)";
        $cnt = query($con, $sql, $param = [$categoryName, $cat_src, $editTitle, $imgViewer, $ip, $date]);

        if ($cnt == 1) {

            $psSql = "INSERT INTO `yy_wiki_process`(`board_id`, `category`, `category_src`, `title`, `date`, `status`) VALUES (?, ?, ?, ?, ?, ?)";
            query($con, $psSql, $param = [$board_idx->board_id + 1, $categoryName, $cat_src, $editTitle, $date, "새 문서 작성"]);

            echo json_encode(
                ['success' => true],
                JSON_UNESCAPED_UNICODE
            );

            exit;
        }
    } else if (empty($imgViewer) == true) {

        // 밑에 SQL 적기
        $sql = "INSERT INTO `yy_wiki_board`(`category`, `category_src`, `title`, `content`, `ip`, `date`) VALUES (?, ?, ?, ?, ?, ?)";
        $cnt = query($con, $sql, $param = [$categoryName, $cat_src, $editTitle, $editer_area, $ip, $date]);

        if ($cnt == 1) {


            $psSql = "INSERT INTO `yy_wiki_process`(`board_id`, `category`, `category_src`, `title`, `date`, `status`) VALUES (?, ?, ?, ?, ?, ?)";
            query($con, $psSql, $param = [$board_idx->board_id + 1, $categoryName, $cat_src, $editTitle, $date, "새 문서 작성"]);

            echo json_encode(
                ['success' => true],
                JSON_UNESCAPED_UNICODE
            );

            exit;
        }
    } else {
        $upfile["tmp_name"];
        $src = "/upload/" . $upfile['name'];
        move_uploaded_file(
            $upfile["tmp_name"],
            ".." . $src
        );

        // 밑에 SQL 적기
        $sql = "INSERT INTO `yy_wiki_board`(`category`, `category_src`, `title`, `content`, `img`, `ip`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $cnt = query($con, $sql, $param = [$categoryName, $cat_src, $editTitle, $editer_area, "/upload/" . $imgViewer, $ip, $date]);

        if ($cnt == 1) {

            $psSql = "INSERT INTO `yy_wiki_process`(`board_id`, `category`, `category_src`, `title`, `date`, `status`) VALUES (?, ?, ?, ?, ?, ?)";
            query($con, $psSql, $param = [$board_idx->board_id + 1, $categoryName, $cat_src, $editTitle, $date, "새 문서 작성"]);

            echo json_encode(
                ['success' => true],
                JSON_UNESCAPED_UNICODE
            );

            exit;
        }
    }
} else {
    // 수정 모드

    if (empty($editer_area) == true) {
        $upfile["tmp_name"];
        $src = "/upload/" . $upfile['name'];
        move_uploaded_file(
            $upfile["tmp_name"],
            "." . $src
        );

        // 밑에 SQL 적기
        $sql = "UPDATE `yy_wiki_board` SET `category`= ?,`category_src`= ?,`title`= ?, `img`= ?,`ip`= ?,`date`= ? WHERE `id` = ?";
        $cnt = query($con, $sql, $param = [$categoryName, $cat_src, $editTitle, "/upload/" . $imgViewer, $ip, $date, $doc_id]);

        if ($cnt == 1) {

            $psSql = "INSERT INTO `yy_wiki_process`(`board_id`, `category`, `category_src`, `title`, `date`, `status`) VALUES (?, ?, ?, ?, ?, ?)";
            query($con, $psSql, $param = [$doc_id, $categoryName, $cat_src, $editTitle, $date, "문서 수정"]);

            echo json_encode(
                ['success' => true],
                JSON_UNESCAPED_UNICODE
            );

            exit;
        }
    } else if (empty($imgViewer) == true) {

        // 밑에 SQL 적기
        $sql = "UPDATE `yy_wiki_board` SET `category`= ?,`category_src`= ?,`title`= ?, `content` = ?, `ip`= ?,`date`= ? WHERE `id` = ?";
        $cnt = query($con, $sql, $param = [$categoryName, $cat_src, $editTitle, $editer_area, $ip, $date, $doc_id]);

        if ($cnt == 1) {


            $psSql = "INSERT INTO `yy_wiki_process`(`board_id`, `category`, `category_src`, `title`, `date`, `status`) VALUES (?, ?, ?, ?, ?, ?)";
            query($con, $psSql, $param = [$doc_id, $categoryName, $cat_src, $editTitle, $date, "문서 수정"]);

            echo json_encode(
                ['success' => true],
                JSON_UNESCAPED_UNICODE
            );

            exit;
        }
    } else {
        $upfile["tmp_name"];
        $src = "/upload/" . $upfile['name'];
        move_uploaded_file(
            $upfile["tmp_name"],
            ".." . $src
        );

        // 밑에 SQL 적기
        $sql = "UPDATE `yy_wiki_board` SET `category`= ?,`category_src`= ?,`title`= ?, `content` = ?, `img`= ?,`ip`= ?,`date`= ? WHERE `id` = ?";
        $cnt = query($con, $sql, $param = [$categoryName, $cat_src, $editTitle, $editer_area, "/upload/" . $imgViewer, $ip, $date, $doc_id]);

        if ($cnt == 1) {

            $psSql = "INSERT INTO `yy_wiki_process`(`board_id`, `category`, `category_src`, `title`, `date`, `status`) VALUES (?, ?, ?, ?, ?, ?)";
            query($con, $psSql, $param = [$doc_id, $categoryName, $cat_src, $editTitle, $date, "문서 수정"]);

            echo json_encode(
                ['success' => true],
                JSON_UNESCAPED_UNICODE
            );

            exit;
        }
    }
}

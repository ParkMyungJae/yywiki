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

$mod = 0; // 글 작성모드
if (isset($_GET['board_id'])) {
    //글 수정 모드
    $mod = $_GET['board_id'];
    $sql = "SELECT * FROM `yy_wiki_board` WHERE id = ?";
    $q = $con->prepare($sql);
    $q->execute([$_GET['board_id']]);
    $data = $q->fetch(PDO::FETCH_OBJ);

    if (!$data) {
        echo "존재하지 않는 글입니다.";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ko">

<title>양디위키 - 새 문서</title>
<?php require("head.php"); ?>

<body>
    <?php require("header.php"); ?>

    <div class="container">
        <div class="viewer">
            <div class="main" style="min-height: 1000px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <?php if ($mod == 0) : ?>
                        <h1 class="dark-white" style="color: #373a3c;">새 문서 만들기</h1>
                    <?php else : ?>
                        <h1 class="dark-white" style="color: #373a3c;">문서 수정하기</h1>
                    <?php endif; ?>

                    <p style="text-align: right">내 아이피 : <?= $_SESSION["user"] ?></p>
                </div>

                <form method="POST" id="newDocumentForm" enctype="multipart/form-data">
                    <div class="white-border" style="border: 1px solid #888; border-radius: 5px; margin: 10px 0; padding: 5px;">분류 :
                        <select class="viewer-dark" name="categoryName" id="categoryName" style="margin-left: 5px; outline: none;">
                            <option value="양디위키">양디위키</option>
                            <option value="학교 소개">학교 소개</option>
                            <option value="전공 과 소개">전공 과 소개</option>
                            <option value="기능반 소개">기능반 소개</option>
                            <option value="기능반 편의시설">기능반 편의시설</option>
                            <option value="기능반 수업">기능반 수업</option>
                            <option value="기능 학습 자료실">기능 학습 자료실</option>
                            <option value="Q&A 게시판">Q&A 게시판</option>
                            <option value="자유게시판">자유게시판</option>
                            <option value="버그 및 요청 게시판">버그 및 요청 게시판</option>
                        </select>
                    </div>

                    <div class="editer">
                        <input type="hidden" class="form-control" name="doc_id" value="<?= $mod ?>">
                        <input type="text" name="editTitle" class="editTitle viewer-dark all-white-border" placeholder="제목을 입력하세요 " style="width: 100%; border: 1px solid #888; margin: 10px 0; padding: 10px; font-size: 16px; outline: none;" value="<?= $mod != 0 ? $data->title : "" ?>">

                        <textarea name="editer_area" class="editer_area viewer-dark all-white-border" cols="30" rows="15" placeholder="내용을 입력하세요."><?= $mod != 0 ? $data->content : "" ?></textarea>

                        <div class="field img_field">
                            <?php if (isset($data->img) != null) : ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend" style="width: 100%;">
                                        <p class="input-group-text viewer-dark all-white-border" style="width: 100%;">현재 파일 : <?= $data->img != null ? $data->img : "없음" ?></p>
                                    </div>
                                </div>

                                <input name="imgViewer" placeholder="변경할 이미지 업로드" type="text" style="width: 100%;" class="imgViewer viewer-dark all-white-border" id="imgViewer" readonly>
                            <?php else : ?>
                                <input name="imgViewer" placeholder="이미지 업로드" type="text" style="width: 100%;" class="imgViewer viewer-dark all-white-border" id="imgViewer" readonly>
                            <?php endif ?>

                            <div class="ui buttons" style="display: flex; justify-content: flex-end; margin: 2px 0;">
                                <input type="button" class="ui button active inputCancel" value="취소">
                                <div class="or"></div>
                                <button type="button" class="ui positive button" id="imgUploadBtn" style="background: #38a59a;">업로드</button>
                            </div>

                            <input type="file" id="imgUploadInput" style="display: none;" name="imgUploadInput">
                        </div>
                    </div>

                    <div style="text-align: right;">
                        <button type="button" class="btn uploadBtn" style="margin-top: 25px; margin-bottom: 10px; background: #38a59a; color: #fff;">문서 만들기</button>
                    </div>
            </div>

            <?php require("Recent_Changes.php") ?>
        </div>

        <?php require("copy.php"); ?>
    </div>

    <?php require("footer.php"); ?>
</body>

</html>

<script>
    let fileViewer = document.querySelector("#imgViewer");
    let cancelBtn = document.querySelector(".inputCancel");
    let imgUploadBtn = document.querySelector("#imgUploadBtn");
    let imgUploadInput = document.querySelector("#imgUploadInput");

    if (imgUploadBtn) {
        imgUploadBtn.addEventListener("click", () => {
            imgUploadInput.click();
        });

        imgUploadInput.addEventListener("input", () => {
            if (imgUploadInput.files[0].name != undefined) {
                fileViewer.value = imgUploadInput.files[0].name;
            }
        });

        cancelBtn.addEventListener("click", () => {
            fileViewer.value = "";
            imgUploadInput.value = "";
        });
    }


    let editTitle = document.querySelector(".editTitle");
    let editer_area = document.querySelector(".editer_area");
    let uploadBtn = document.querySelector(".uploadBtn");

    uploadBtn.addEventListener("click", () => {
        let formData = new FormData($("#newDocumentForm")[0]);

        if ($.trim(editTitle.value) != "" && $.trim(editer_area.value) != "") {
            $.ajax({
                type: "POST",
                url: "/php/documentWrite.php",
                contentType: false,
                processData: false,
                dataType: "json",
                data: formData,
                success: function(response) {
                    if (categoryName.value == "양디위키") {
                        window.location.href = "cat_yywiki.php";
                    }

                    if (categoryName.value == "학교 소개") {
                        window.location.href = "cat_yyIntro.php";
                    }

                    if (categoryName.value == "전공 과 소개") {
                        window.location.href = "cat_school_skill.php";
                    }

                    if (categoryName.value == "기능반 소개") {
                        window.location.href = "cat_skill.php";
                    }

                    if (categoryName.value == "기능반 편의시설") {
                        window.location.href = "cat_skill_service.php";
                    }

                    if (categoryName.value == "기능반 수업") {
                        window.location.href = "cat_skill_class.php";
                    }

                    if (categoryName.value == "기능 학습 자료실") {
                        window.location.href = "cat_skill_lib.php";
                    }

                    if (categoryName.value == "Q&A 게시판") {
                        window.location.href = "cat_Q&A.php";
                    }

                    if (categoryName.value == "자유게시판") {
                        window.location.href = "cat_bulletin_board.php";
                    }

                    if (categoryName.value == "버그 및 요청 게시판") {
                        window.location.href = "cat_bug.php";
                    }
                },
            });
        } else {
            swal({
                title: '오류',
                text: '제목과 내용은 필수 항목입니다.',
                icon: 'error'
            });
            return;
        }
    });
</script>
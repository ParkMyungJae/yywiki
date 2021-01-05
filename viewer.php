<?php
require("./php/db.php");

$sql = "SELECT * FROM yy_wiki_board WHERE id = ?";

$q = $con->prepare($sql);

if (isset($_GET['board_id'])) {
    $id = $_GET['board_id'];
} else {
    echo "<script> alert('잘못된 접근입니다.'); </script>";
    echo "<script> window.history.back(); </script>";
    exit;
}

$q->execute([$id]);
$data = $q->fetch(PDO::FETCH_OBJ);

if (!$data) {
    echo "<script> alert('이미 삭제되었거나 존재하지 않는 글입니다.'); </script>";
    echo "<script> window.history.back(); </script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="ko">

<title>양디위키</title>
<?php require("head.php"); ?>

<body>
    <?php require("header.php"); ?>

    <div class="container">
        <div class="viewer">
            <div class="main" style="min-height: 550px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h1 style="color: #373a3c; word-break: break-all;" class="dark-white"><?= $data->title ?></h1>
                    <input type="hidden" id="idTranking" value="<?= $data->id ?>">
                    <input type="hidden" id="ipTraking" value="<?= $data->ip ?>">
                    <p style="text-align: right">작성자 아이피 : <?= $data->ip ?></p>
                </div>

                <div style="width: 100%; text-align: right;">
                    <p><?= "등록일자 : " . $data->date ?></p>
                </div>

                <div class="white-border" style="border: 1px solid #888; border-radius: 5px; margin: 10px 0; padding: 5px;">분류 : <a href="<?= $data->category_src ?>"><?= $data->category ?></a></div>

                <?php if ($data->img != "") : ?>
                    <img style="margin: 20px 0;" src="<?= $data->img ?>" alt="img">
                <?php endif; ?>

                <textarea id="viewerArea" cols="30" rows="50" readonly><?= $data->content ?></textarea>

                <!-- 라이브리 시티 설치 코드 -->
                <div id="lv-container" data-id="city" data-uid="MTAyMC80OTMyNC8yNTgxNg==">
                    <script type="text/javascript">
                        window.livereOptions = {
                            refer: `yywiki.vivasoft.shop/viewer.php?board_id=<?= $id ?>`
                        };
                        (function(d, s) {
                            var j, e = d.getElementsByTagName(s)[0];

                            if (typeof LivereTower === 'function') {
                                return;
                            }

                            j = d.createElement(s);
                            j.src = 'https://cdn-city.livere.com/js/embed.dist.js';
                            j.async = true;

                            e.parentNode.insertBefore(j, e);
                        })(document, 'script');
                    </script>
                </div>
                <!-- 시티 설치 코드 끝 -->

                <!-- index -->
                <div style="text-align: right;">
                    <a><button id="board_delete_btn" class="btn btn-danger">삭제</button></a>
                    <a href="newDocument.php?board_id=<?= $data->id ?>"><button class="btn btn-primary">수정</button></a>
                    <a href="<?= $data->category_src ?>"><button class="btn btn-info">목록</button></a>
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
    let board_delete_btn = document.querySelector("#board_delete_btn");

    board_delete_btn.addEventListener("click", () => {
        swal({
                title: "정말 삭제하시겠습니까?",
                text: "특별한 사유 없이 제거하는 것이라면\n행위를 멈춰주시길 바랍니다. \n 당신의 아이피 주소 : " + ipTraking.value,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "/php/board_delete_OK.php?board_id=" + idTranking.value,
                        success: function(response) {
                            swal("성공적으로 삭제되었습니다!", {
                                icon: "success",
                            }).then(() => {
                                window.history.back();
                            });
                        }
                    });
                }
            });
    });

    setInterval(() => {
	$("body > span:nth-child(10)").remove();
    }, 500);
</script>
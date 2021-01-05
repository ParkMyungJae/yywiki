<?php require("./php/db.php"); ?>

<!DOCTYPE html>
<html lang="ko">

<?php require("head.php"); ?>

<title>양디위키 - 환경설정</title>

<body>
    <?php require("header.php"); ?>

    <div class="container">
        <div class="displayControl">
            <div class="box">
                <center style="margin-bottom: 50px;">
                    <p style="font-size: 40px; font-weight: bold;">환경설정</p>
                </center>

                <div class="text" style="width: 100%;">Beta 다크모드</div>

                <div class="ui toggle checkbox" style="width: 100%;">
                    <input type="checkbox" id="darkmode" name="darkmode" style="margin-top: 10px !important;">

                    <label style="display: flex; align-items: center; justify-content: space-between; width: 100%; height: 100%;">
                    </label>
                    <p style="margin-top: 20px;">빠른 시일 내에 서비스 드리겠습니다.</p>
                </div>
            </div>
        </div>

        <?php require("copy.php"); ?>
    </div>

    <?php require("footer.php"); ?>

    <script>
        let darkmode = document.querySelector("#darkmode");

        darkmode.addEventListener("input", () => {
            if ($('input:checkbox[name=darkmode]').is(':checked') != true) {
                $("html, body").css("background", "#e9ebee");
                $("html, body").css("color", "#000");

                $("header, nav").attr("style", "rgb(66, 103, 178) !important");
            } else {
                $("html, body").css("background", "#181a1e");
                $("html, body").css("color", "#fff");

                $("header, nav").attr("style", "background: #292d35 !important");
            }
        });
    </script>
</body>

</html>
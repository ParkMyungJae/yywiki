<?php
require("./php/db.php");

?>

<!DOCTYPE html>
<html lang="ko">
<title>관리자 페이지</title>

<?php require("./head.php"); ?>


<body>
    <?php require("./header.php"); ?>

    <a href="./login.php" style="position: absolute; top: 10px; right: 10px; z-index: 123213253252352;"><button type="button" class="btn btn-primary" style="z-index: 123213253252352;">사용자</button></a>
    <div id="login_background">
        <div class="loginBox">
            <h1 style="color: #222; margin-bottom: 10px; text-align: center;">관리자 로그인</h1>

            <input type="text" id="id" name="id" placeholder="아이디를 입력해주세요">
            <input type="password" id="pw" name="pw" placeholder="패스워드를 입력해주세요">

            <input type="button" id="loginBtn" value="접속하기" style="margin-top: 35px;">
        </div>
    </div>
</body>

<script>
    document.getElementById("loginBtn").addEventListener("click", () => {
        if (document.getElementById("loginIP").value === "") return;

        let formData = new FormData();
        formData.append("loginIP", ip);

        $.ajax({
            type: "POST",
            url: "/php/login_OK.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("접속 성공");
                window.location.href = "/";
            }
        });
    });

    let ip = "";

    function getIP(json) {
        ip = json.ip;
    }

    window.onload = function() {
        document.getElementById("loginIP").value = ip;
    }
</script>

<script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>

</html>
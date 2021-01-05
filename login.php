<?php
require("./php/db.php");

if (isset($_SESSION['user'])) {
    echo ('<script> window.location.href = "/"; </script>');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<title>양디고 기능반 홍보Wiki</title>
<?php require("head.php"); ?>

<body>
    <a href="./admin.php" style="position: absolute; top: 10px; right: 10px; z-index: 123213253252352;"><button type="button" class="btn btn-primary" style="z-index: 123213253252352;">관리자</button></a>
    <div id="login_background">
        <div class="loginBox">
            <h1 style="color: #222; margin-bottom: 30px; text-align: center;">양디 기능 Wiki</h1>
            <input type="text" id="loginIP" name="loginIP" readonly>

            <p style="width: 270px; margin: 20px 0;">
                경고 : 해당 사이트의 활동에 대하여 아이피 주소를 수집하고 있습니다.
                욕설, 비방, 사칭, 도배등 서비스 약관 및 법률에 위반된 행동을 할 경우
                민형사상의 책임을 질 수 있습니다. 또한 해당 아이피 주소로는 서비스 이용에 제한이 될 수 있습니다. <br>
            </p>

            <input type="button" id="loginBtn" value="접속하기">
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
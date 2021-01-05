window.onload = function () {

}

var getParameters = function (paramName) { // 리턴값을 위한 변수 선언
    var returnValue; // 현재 URL 가져오기 
    var url = location.href; // get 파라미터 값을 가져올 수 있는 ? 를 기점으로 slice 한 후 split 으로 나눔
    var parameters = (url.slice(url.indexOf('?') + 1, url.length)).split('&'); // 나누어진 값의 비교를 통해 paramName 으로 요청된 데이터의 값만 return
    for (var i = 0; i < parameters.length; i++) {
        var varName = parameters[i].split('=')[0];
        if (varName.toUpperCase() == paramName.toUpperCase()) {
            returnValue = parameters[i].split('=')[1];
            return decodeURIComponent(returnValue);
        }
    }
};

function loadThumbnail(files) {
    let profileInput = document.querySelector("#profileChangeInput");

    files.forEach(async x => {
        let img = await loadFile(x);
        profileInput.value = "";
        profileInput.value = img;
    });
}

function loadFile(file) {
    return new Promise((res, rej) => {
        let reader = new FileReader();

        reader.addEventListener("load", () => {
            let img = new Image();
            img.src = reader.result;
            img.addEventListener("load", () => {
                let canvas = document.createElement("canvas");
                canvas.width = 128;
                canvas.height = 128;
                let ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, 128, 128);
                let url = canvas.toDataURL();

                let thumbImg = new Image();
                thumbImg.src = url;
                res(thumbImg);
            });
        });
        reader.readAsDataURL(file);
    });
}
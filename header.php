<header>
    <nav class="container headerNav">
        <div class="nav-left">
            <a href="/">양디위키</a>

            <div class="navBtn">
                <a href="recent.php"><i class="fas fa-compass"></i> 최근 변경</a>
                <a href="category_index.php"><i class="fas fa-folder"></i> 카테고리</a>
                <a href="cat_Q&A.php"><i class="fas fa-question-circle"></i> Q&A</a>
            </div>
        </div>

        <div class="nav-right">
            <!-- PC 검색 -->
            <form action="search.php" method="GET" class="pc_search_dark uk-search uk-search-navbar pc-search-bar" style="border: .0625rem solid #ccc; display: flex; justify-content: flex-end; width: 300px; height: 42px;">
                <span uk-search-icon style="color: #333;"></span>
                <input name="search" class="pc_search_dark uk-search-input" type="search" placeholder="Search" style="width: 300px; height: 100%; font-size: 1rem; background: #fff; color: #000;">
            </form>

            <!-- 모바일 검색 -->
            <a class="userBtn mobileSearch" href="#modal-full" uk-search-icon uk-toggle style="color: #fff;"></a>

            <div id="modal-full" class="dark-mode uk-modal-full uk-modal" uk-modal>
                <div class="dark-mode uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
                    <button class="uk-modal-close-full" type="button" uk-close></button>
                    <form action="search.php" method="GET" class="uk-search uk-search-large" style="padding: 5px;">
                        <input name="search" class="dark-mode uk-search-input uk-text-center" type="search" placeholder="Search" autofocus style="padding: 10px;">
                    </form>
                </div>
            </div>

            <!-- USER 컨트롤 -->
            <a class="userBtn" href="" uk-icon="user" style="color: #fff;"></a>

            <div class="uk-navbar-dropdown viewer-dark boder-boder" uk-dropdown="mode: click">
                <ul class="uk-nav uk-navbar-dropdown-nav">

                    <li><a><i uk-icon="user"></i> <?= $_SESSION["user"] ?></a></li>
                    <li class="uk-nav-header viewer-dark">제어센터</li>
                    <li><a><i uk-icon="warning"></i> 문제신고</a></li>
                    <li><a href="control.php"><i uk-icon="cog"></i> 환경설정</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a onclick="logoutPS();"><i uk-icon="unlock"></i> 로그아웃</a></li>
                </ul>
            </div>

        </div>
    </nav>
</header>

<script>
    function logoutPS() {
        $.ajax({
            type: "POST",
            url: "/php/logout.php",
            success: function(response) {
                window.location.href = "/";
            }
        });
    }
</script>
<!DOCTYPE html>
<html>

<head>
    <title>Pixel</title>
    <link rel="icon" href="/assets/img/logo.jpg" type="image/gif" sizes="16x16">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body id="body">
    <!-- <img class="mouse" id="mouses" width="20px" src="https://static.thenounproject.com/png/1035955-200.png" alt=""> -->
    <div id="id"></div>
    <div id="loading">
        <img src="https://cssbud.com/wp-content/uploads/2022/05/loading.gif"
            alt="https://cssbud.com/wp-content/uploads/2022/05/loading.gif">
    </div>
    <div id="prt">
        <div id="s"></div>
        <span id="x" role="button" onclick="cancelView()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x"
                viewBox="0 0 16 16">
                <path
                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
            </svg>
        </span>
    </div>
    <div class="member-menu">
        <input role="button" type="color" id="colorPicker">
        <span role="button" onclick="prt()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                <path
                    d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5z" />
            </svg>
        </span>
    </div>
    <canvas id="gameCanvas" width="12000" height="12000"></canvas>
    <script src="https://adpixel.jimdev.id.vn/socket.io/socket.io.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.6.1/dist/echo.iife.js"></script>
    <script src="/assets/js/main.js"></script>
</body>

</html>

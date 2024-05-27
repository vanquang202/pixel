function init() {
    const canvas = document.getElementById("gameCanvas");
    const context = canvas.getContext("2d");
    let gridSize, rows, cols, grid, echo, idU;
    function beginStart() {
        const firstNames = [
            "John",
            "Jane",
            "David",
            "Sarah",
            "Michael",
            "Emily",
        ];
        const lastNames = [
            "Smith",
            "Johnson",
            "Brown",
            "Davis",
            "Wilson",
            "Taylor",
        ];

        function generateRandomName() {
            const randomFirstNameIndex = Math.floor(
                Math.random() * firstNames.length
            );
            const randomLastNameIndex = Math.floor(
                Math.random() * lastNames.length
            );
            const randomFirstName = firstNames[randomFirstNameIndex];
            const randomLastName = lastNames[randomLastNameIndex];
            const randomSuffix = Math.floor(Math.random() * 1000); // Số ngẫu nhiên từ 0 đến 999
            const randomName = randomFirstName + randomLastName + randomSuffix;

            return randomName;
        }
        const randomName = generateRandomName();
        document.getElementById("id").innerHTML = randomName;
        idU = randomName;
    }

    function start() {
        window.Echo = new Echo({
            broadcaster: "socket.io",
            host: `https://adpixel.jimdev.id.vn`,
            withCredentials: true,
        });
        echo = window.Echo.join("pixel");
        window.onload = async function () {
            grid = [];
            gridSize = 5;
            canvasHeight = 12000;
            canvasWidth = 12000;
            rows = canvasHeight / gridSize;
            cols = canvasWidth / gridSize;
            run();

            function run() {
                echo.listenForWhisper("call", async (event) => {
                    const chunkSize = 50;
                    for (let i = 0; i < grid.length; i += chunkSize) {
                        const chunk = grid.slice(i, i + chunkSize);
                        await echo.whisper("client-" + event.idU, {
                            grid: JSON.stringify(chunk),
                        });
                    }
                    await echo.whisper("client-" + event.idU, {
                        isDone: true,
                        canvasHeight: canvasHeight,
                        canvasWidth: canvasWidth,
                        gridSize: gridSize,
                        rows: rows,
                        cols: cols,
                    });
                });
                echo.listenForWhisper("send-client", (event) => {
                    grid[event.clickedRow][event.clickedCol] =
                        event.selectedColor;
                });

                let cesspro = 0;
                function timer(ms) {
                    return new Promise((res) => setTimeout(res, ms));
                }
                async function task(row, col) {
                    if (cesspro == 100000) {
                        cesspro = 0;
                        console.log(
                            "Task process : " + (row / rows) * 100 + " %"
                        );
                        await timer(1000);
                    }
                }
                async function drawGrid() {
                    context.clearRect(0, 0, canvasWidth, canvasHeight);
                    for (let row = 0; row < rows; row++) {
                        grid[row] = [];
                        for (let col = 0; col < cols; col++) {
                            cesspro++;
                            await task(row, col);
                        }
                    }
                    document.getElementById("loading").style.display = "none";
                }
                drawGrid();
            }
        };
    }
    beginStart();
    start();

    // Until
    function prt() {
        let screenshotImage = document.createElement("img");

        // Chuyển đổi nội dung của canvas thành URL dữ liệu hình ảnh
        let dataURL = canvas.toDataURL("image/png");
        screenshotImage.style.width = "100%";
        screenshotImage.style.height = "100%";
        screenshotImage.src = dataURL;
        let prt = document.getElementById("prt");
        let s = document.getElementById("s");
        prt.style.display = "block";
        s.innerHTML = "";
        s.appendChild(screenshotImage);
    }

    function cancelView() {
        let prt = document.getElementById("prt");
        prt.style.display = "none";
    }
    function handleZoom(event) {
        if (event.ctrlKey === true || event.metaKey) {
        }
    }

    window.addEventListener("wheel", handleZoom, { passive: false });
    window.addEventListener("gesturestart", handleZoom);
}
init();

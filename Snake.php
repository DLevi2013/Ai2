<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snake Game</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        canvas {
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <canvas id="snakeCanvas" width="400" height="400"></canvas>
    <script>
        const canvas = document.getElementById("snakeCanvas");
        const ctx = canvas.getContext("2d");

        const box = 20;

        let snake = [{
            x: 10 * box,
            y: 10 * box
        }];

        let food = {
            x: Math.floor(Math.random() * 19 + 1) * box,
            y: Math.floor(Math.random() * 19 + 1) * box
        };

        let d;

        document.addEventListener("keydown", direction);

        function direction(event) {
            if (event.keyCode == 37 && d != "RIGHT") {
                d = "LEFT";
            } else if (event.keyCode == 38 && d != "DOWN") {
                d = "UP";
            } else if (event.keyCode == 39 && d != "LEFT") {
                d = "RIGHT";
            } else if (event.keyCode == 40 && d != "UP") {
                d = "DOWN";
            }
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < snake.length; i++) {
                ctx.fillStyle = i === 0 ? "green" : "white";
                ctx.fillRect(snake[i].x, snake[i].y, box, box);

                ctx.strokeStyle = "black";
                ctx.strokeRect(snake[i].x, snake[i].y, box, box);
            }

            ctx.fillStyle = "red";
            ctx.fillRect(food.x, food.y, box, box);

            let snakeX = snake[0].x;
            let snakeY = snake[0].y;

            if (d === "LEFT") snakeX -= box;
            if (d === "UP") snakeY -= box;
            if (d === "RIGHT") snakeX += box;
            if (d === "DOWN") snakeY += box;

            if (snakeX === food.x && snakeY === food.y) {
                food = {
                    x: Math.floor(Math.random() * 19 + 1) * box,
                    y: Math.floor(Math.random() * 19 + 1) * box
                };
            } else {
                snake.pop();
            }

            const newHead = {
                x: snakeX,
                y: snakeY
            };

            snake.unshift(newHead);
        }

        function gameLoop() {
            draw();
            setTimeout(gameLoop, 100);
        }

        gameLoop();
    </script>
</body>
</html>

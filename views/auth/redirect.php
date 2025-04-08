<?php
session_start();
require '../../app/middleware/Auth.php';
require '../../app/controller/CountController.php';
logUserVisit();
authMiddleware();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Success</title>
    <link rel="icon" type="image/png" href="../../public/asset/logo/logo-title.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        let count = 3;

        function countdown() {
            document.getElementById("timer").innerText = count;
            if (count > 0) {
                count--;
                setTimeout(countdown, 1000);
            } else {
                window.location.href = "../rekap/rekap.php";
            }
        }
        window.onload = countdown;
    </script>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 20px;
        }

        .illustration img {
            width: 70%;
            margin-left: 100px;
        }

        .card {
            border: 0;
            padding: 0;
            margin-inline: -100px;
            background: transparent;
        }

        .message {
            margin-top: 270px;
        }

        h2,
        span {
            font-size: 15px;
        }

        @media screen and (max-width: 768px) {
            body {
                overflow: hidden;
            }

            .message {
                margin-top: 0;
            }

            .illustration img {
                margin-left: 0;
                width: 300px;
            }

            .card {
                margin-inline: 0;
                background: transparent;
            }
        }
        .loading-dots {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
}

.dot {
    width: 10px;
    height: 10px;
    margin: 0 5px;
    background-color: #007bff;
    border-radius: 50%;
    animation: bounce 1.2s infinite ease-in-out;
}

.dot:nth-child(2) {
    animation-delay: 0.2s;
}

.dot:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes bounce {
    0%, 80%, 100% {
        transform: scale(0);
    } 
    40% {
        transform: scale(1);
    }
}

    </style>
</head>

<body>


    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <div class="illustration">
                        <img src="../../public/asset/illustration/illustration_1.png" alt="" class="img">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="message">
    <div class="loading-dots">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
    <h2>Your all set! You will be redirected in <span id="timer">3</span> seconds...</h2>
</div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
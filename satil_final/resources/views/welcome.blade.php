<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>attendance taking system</title>



        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 60px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>


    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                   DIU Attendance Taking System <br>
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs"></a>
                    <a href="https://laracasts.com"></a>
                    <a href="https://laravel-news.com"></a>
                    <a href="https://forge.laravel.com"></a>
                    <a href="https://github.com/laravel/laravel"></a>
                </div>
                               
                                <!DOCTYPE html>
                                <html>
                                <body>

                                <canvas id="canvas" width="200" height="200"
                                style="background-color:#fff">
                                </canvas>

                                <script>
                                var canvas = document.getElementById("canvas");
                                var ctx = canvas.getContext("2d");
                                var radius = canvas.height / 2;
                                ctx.translate(radius, radius);
                                radius = radius * 0.90
                                setInterval(drawClock, 1000);

                                function drawClock() {
                                  drawFace(ctx, radius);
                                  drawNumbers(ctx, radius);
                                  drawTime(ctx, radius);
                                }

                                function drawFace(ctx, radius) {
                                  var grad;
                                  ctx.beginPath();
                                  ctx.arc(0, 0, radius, 0, 2*Math.PI);
                                  ctx.fillStyle = 'white';
                                  ctx.fill();
                                  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
                                  grad.addColorStop(0, '#333');
                                  grad.addColorStop(0.5, 'white');
                                  grad.addColorStop(1, '#333');
                                  ctx.strokeStyle = grad;
                                  ctx.lineWidth = radius*0.1;
                                  ctx.stroke();
                                  ctx.beginPath();
                                  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
                                  ctx.fillStyle = '#333';
                                  ctx.fill();
                                }

                                function drawNumbers(ctx, radius) {
                                  var ang;
                                  var num;
                                  ctx.font = radius*0.15 + "px arial";
                                  ctx.textBaseline="middle";
                                  ctx.textAlign="center";
                                  for(num = 1; num < 13; num++){
                                    ang = num * Math.PI / 6;
                                    ctx.rotate(ang);
                                    ctx.translate(0, -radius*0.85);
                                    ctx.rotate(-ang);
                                    ctx.fillText(num.toString(), 0, 0);
                                    ctx.rotate(ang);
                                    ctx.translate(0, radius*0.85);
                                    ctx.rotate(-ang);
                                  }
                                }

                                function drawTime(ctx, radius){
                                    var now = new Date();
                                    var hour = now.getHours();
                                    var minute = now.getMinutes();
                                    var second = now.getSeconds();
                                    //hour
                                    hour=hour%12;
                                    hour=(hour*Math.PI/6)+
                                    (minute*Math.PI/(6*60))+
                                    (second*Math.PI/(360*60));
                                    drawHand(ctx, hour, radius*0.5, radius*0.07);
                                    //minute
                                    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
                                    drawHand(ctx, minute, radius*0.8, radius*0.07);
                                    // second
                                    second=(second*Math.PI/30);
                                    drawHand(ctx, second, radius*0.9, radius*0.02);
                                }

                                function drawHand(ctx, pos, length, width) {
                                    ctx.beginPath();
                                    ctx.lineWidth = width;
                                    ctx.lineCap = "round";
                                    ctx.moveTo(0,0);
                                    ctx.rotate(pos);
                                    ctx.lineTo(0, -length);
                                    ctx.stroke();
                                    ctx.rotate(-pos);
                                }
                                </script>
                                </body>
                                </html>                           
             </div>
        </div>
    </body>
</html>

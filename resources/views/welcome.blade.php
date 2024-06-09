<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50" id="container">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" />
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">


                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>

                    <a
                        style="color: #000"
                        href="#"
                        onclick="demo();" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Iniciar chat
                    </a>
                </div>
            </div>
        </div>

        <div  id="startChat" style="position:     ; bottom: 0px; right: 0px; z-index: 999999999999; box-sizing: content-box; overflow: hidden; min-width: 400px; min-height: 120px;">
            <div style="position: relative; cursor: pointer;">
                <div  style="background: rgb(255, 255, 255); display: flex; justify-content: center; position: absolute; top: 38px; right: 20px; height: 60px; width: 60px; border: 0px; border-radius: 50%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 20px;">
                    <img src="https://botman.io/img/logo.png" style="width: 100%; height: auto; border-radius: 999px;">
                </div>
            </div>

        </div>

        <script>
            console.log('All assets are loaded');

            function demo() {
                console.log('Exec whisper Say: Mi doc');
                //botmanChatWidget.sayAsBot('Hola soy el bot Kokoldman. En que puedo ayudarte?')
                botmanChatWidget.whisper('Mi doc')
            }


            var botmanWidget = {
                title: 'Chat demo',
                introMessage: '¡Hola!  Soy el ASISTENTE VIRTUAL de la FCCTP, este chatbot está orientado en ayudarte para la matrícula del proceso 2024-2.',
                mainColor: '#dd3333',
                bubbleBackground: '#fff',
                headerTextColor: '#ffffff',
                placeholderText: 'Escribe un mensaje..',
                bubbleAvatarUrl: 'https://avatars.githubusercontent.com/u/9806620?v=4',
                aboutLink: 'https://hube.pe',
                aboutText: 'Desarrollado por hube',
                alwaysUseFloatingButton: !0
            }


        function checkBotmanWidgetReady(callback) {
            if (typeof botmanChatWidget !== 'undefined') {
                callback();
            } else {
                setTimeout(function() { checkBotmanWidgetReady(callback); }, 100);
            }
        }

        window.onload = function() {
            checkBotmanWidgetReady(demo);
        };

        </script>
        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

    </body>


</html>

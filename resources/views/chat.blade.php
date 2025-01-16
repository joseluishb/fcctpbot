<!doctype html>
<html>
<head>
    <title>FCCTPBot</title>
    <meta charset="UTF-8">
    {{-- <link rel="stylesheet" type="text/css" href="{{ url('assets/css/chat.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="/assets/css/chat.css">
</head>
<body>

<script id="botmanWidget" src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/chat.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Función para abrir enlaces en una nueva ventana
    function openLinksInNewWindow(links) {
        links.forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault(); // Prevenir el comportamiento por defecto del enlace
                window.open(this.href, '_blank'); // Abrir en una nueva ventana
            });
        });
    }

    // Crear un observador de mutaciones
    var observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            if (mutation.type === 'childList') {
                // Buscar nuevos enlaces añadidos al DOM
                var newLinks = mutation.target.querySelectorAll('a');
                openLinksInNewWindow(newLinks);
            }
        });
    });

    // Configurar el observador para observar el contenedor del chatbot
    var config = { childList: true, subtree: true };

    // Función para iniciar el observador cuando el nodo objetivo esté disponible
    function startObserving() {
        var targetNode = document.querySelector('#messageArea'); // Reemplaza con el ID o clase del contenedor del chatbot
        if (targetNode) {
            // Iniciar el observador
            observer.observe(targetNode, config);
            console.log('Observador iniciado.');
        } else {
            // Intentar de nuevo después de un breve retraso
            setTimeout(startObserving, 500);
        }
    }

    // Iniciar la observación
    startObserving();

    // Inicialmente, abrir enlaces en una nueva ventana
    var initialLinks = document.querySelectorAll('a');
    openLinksInNewWindow(initialLinks);
});
</script>
</body>
</html>

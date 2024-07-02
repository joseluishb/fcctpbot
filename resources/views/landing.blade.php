<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios de Matrícula - 2024-II</title>
    <link rel="icon" type="image/x-icon" href="assets/images/icon-usmp.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/estilos.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <style>
        body {
            background-image: none;
        }


    </style>

</head>

<body class="">

    <!-- Header -->
    <header class="bg-white fixed w-full z-10 shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <img id="logo" src="assets/images/logo-usmp.svg" alt="Logo"
                class="h-10 lg:h-16 md:h-16 sm:h-10 transition-all duration-300">
            <nav>
                <div class="lg:hidden">
                    <button id="menu-toggle" class="focus:outline-none">
                        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
                <ul id="menu" class="hidden lg:flex space-x-4">

                    <li><a href="#matricula"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Matrícula</a></li>
                    <li><a href="#asesoria"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Asesorías</a></li>
                    <li><a href="#guia"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Guías</a></li>
                    <li><a href="#plan" class="text-gray-700 hover:text-red-500 transition-colors duration-300">Plan de
                            estudio</a></li>
                    <li><a href="#servicio"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Servicios
                            online</a></li>
                    <li><a href="#oficina"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Oficinas</a></li>
                </ul>
            </nav>
        </div>
        <ul id="mobile-menu"
            class="absolute bg-white w-full left-0 top-full hidden lg:hidden space-y-4  shadow-lg menu-enter-active">

            <a href="#matricula" class="text-gray-700">
                <li
                    class="text-left px-8 pt-3 pb-3 border-b border-t hover:bg-gray-700 hover:text-white transition-colors duration-300">
                    Matrícula</li>
            </a>
            <a href="#asesoria" class="text-gray-700">
                <li
                    class="text-left px-8 pt-3 pb-3 border-b hover:bg-gray-700 hover:text-white transition-colors duration-300">
                    Asesorías</li>
            </a>
            <a href="#guia" class="text-gray-700">
                <li
                    class="text-left px-8 pt-3 pb-3 border-b hover:bg-gray-700 hover:text-white transition-colors duration-300">
                    Guías</li>
            </a>
            <a href="#plan" class="text-gray-700">
                <li
                    class="text-left px-8 pt-3 pb-3 border-b hover:bg-gray-700 hover:text-white transition-colors duration-300">
                    Plan de estudio</li>
            </a>
            <a href="#servicio" class="text-gray-700">
                <li
                    class="text-left px-8 pt-3 pb-3 border-b hover:bg-gray-700 hover:text-white transition-colors duration-300">
                    Servicios online</li>
            </a>
            <a href="#oficina" class="text-gray-700">
                <li
                    class="text-left px-8 pt-3 pb-3 border-b hover:bg-gray-700 hover:text-white transition-colors duration-300">
                    Oficinas</li>
            </a>
        </ul>

    </header>

    <!-- Sección slider -->
    <section id="inicio" class="container-fluid mx-auto px-4 pt-32 custom-gradient">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="px-4 pb-0 md:pb-5 sm:pb-0 flex-1 content-center">
                    <h2
                        class="text-3xl lg:text-5xl md:text-3xl sm:text-3xl font-bold font-poppins text-center md:text-left sm:text-center">
                        Servicio
                        de
                        matrícula
                        <br>2024-II
                    </h2>
                    <p
                        class="text-gray-900 font-light text-xl md:text-xl  py-8 text-center md:text-left sm:text-center">
                        Encuentra los servicios y
                        el soporte
                        <br>para tu
                        proceso de
                        matrícula
                        académica.
                    </p>
                    <div class="text-center md:text-left sm:text-center">
                        <a href="#matricula"
                            class="bg-red-700 hover:bg-red-800 py-3 px-4 rounded-md text-center text-white text-base font-light transition-colors duration-300 ease-in-out w-25 cursor-pointer">
                            Más información<i class="fa-solid fa-chevron-down ps-4"></i>
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <div
                        class="rounded-md md:rounded-3xl sm:rounded-md flex items-center justify-center relative bg-black">
                        <img src="assets/images/video_slider.jpg" alt=""
                            class="rounded-md md:rounded-3xl sm:rounded-md opacity-60 w-full h-full object-fit object-cover object-center">
                        <a data-fancybox href="https://www.youtube.com/watch?v=A7n1_akA_Y0" class="absolute">
                            <i class="fa-regular fa-circle-play text-white text-7xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Sección matricula -->
    <section id="matricula" class="container mx-auto px-4 mb-6 pt-10">
        <div class="mx-auto text-center font-poppins mb-10">
            <h6 class="text-red-600 mb-0">Información para matrícula</h6>
            <div class="titulo">Proceso de matrícula académica</div>
        </div>
        <div class=" grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white shadow-md rounded-md border border-gray-100">
                <div class="container mx-auto grid grid-cols-3 gap-4">
                    <div class="col-span-1">
                        <img src="assets/images/foto-gronograma.jpg" alt="Imagen"
                            class="w-full h-full object-fit object-cover object-left rounded-l-md">
                    </div>
                    <div class="col-span-2">
                        <div class="xl:p-8 lg:p-5 md:p-4 sm:p-4 p-4">
                            <div class="subtitulo">Cronograma de matrícula <br>2024 - II</div>
                            <div class="pt-2 mb-6 text-gray-700 text-base font-light">Información general
                                para realizar
                                tu
                                inscripción al presente semestre</div>
                            <a href="https://fcctp.usmp.edu.pe/site/alumnos/servicios-academicos/registros-academicos/alumnos-pregrado/cronograma-academico-pregrado/"
                                target="_blank"
                                class="bg-white-100 hover:bg-red-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                                Ingresar aquí<i class="fa-solid fa-chevron-right ps-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-md border border-gray-100">
                <div class="container mx-auto grid grid-cols-3 gap-4">
                    <div class="col-span-1">
                        <img src="assets/images/asesoria.jpg" alt="Imagen"
                            class="w-full h-full object-fit object-cover object-center rounded-l-md">
                    </div>
                    <div class="col-span-2">
                        <div class="xl:p-8 lg:p-5 md:p-4 sm:p-4 p-4">
                            <div class="subtitulo">Orientación en el proceso de matrícula <br>2024-II</div>
                            <div class="pt-2 mb-6 text-gray-700 text-base font-light">Realiza tus consultas sobre
                                asuntos académicos y no
                                académicos.</div>
                            <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=7x8gmPbZaE6E9cJwUHTjQhU-ixc6PfBBlqERC-CJx11UNkdaUUlZUjFGTEQ0WVRWMzlOV1Q2UjZCSi4u"
                                target="_blank"
                                class="bg-white-100 hover:bg-red-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                                Ir al Formulario<i class="fa-solid fa-chevron-right ps-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Pre requisitos -->
    <section class="container-fluid border border-t-gray-200 border-b-gray-200 mt-20">
        <div class="container-fluid mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                <div class="rounded-lg shadow-lg bg-red-500">
                    <img src="assets/images/bg.jpg" alt="" class="w-full h-full object-cover object-right">
                </div>
                <div
                    class="bg-white p-10 pr-10 md:pr-0 sm:pr-10 flex-col content-center 2xl:w-10/12 xl:w-10/12 lg:w-10/12 md:w-11/12 sm:w-11/12 w-full">
                    <h2 class="text-2xl font-medium font-poppins mb-6 ">¿Cuáles son los requisitos que debo cumplir para
                        mi
                        proceso de
                        matrícula?</h2>
                    <div class="text-gray-700 font-light">
                        <div class="">Para iniciar tu proceso de matrícula a través de la plataforma SAP,
                            tienes
                            que cumplir los siguientes requisitos:</div>
                        <div class="py-6">
                            <ul class="list-disc pl-10">
                                <li>Cancelar tu recibo por derecho de matrícula</li>
                                <li>No tener deudas pendientes</li>
                            </ul>
                        </div>
                        <div class="">
                            Así, podrás comenzar el procedimiento de inscripción de tus cursos para el semestre 2024-I.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Nuestras Asesorias -->
    <section id="asesoria" class="container mx-auto px-4 my-0 lg:my-20 md:my-20 sm:my-5">
        <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-1 grid-cols-1 gap-4">
            <div class="p-6 flex-1 content-center">
                <div class="mx-auto text-left font-poppins mb-10">
                    <h6 class="text-red-600 mb-0">Asesoría académica y de pagos</h6>
                    <div class="titulo">Nuestras asesorías</div>
                </div>
                <div class="">
                    <!-- card 1 -->
                    <div class="bg-white shadow-md rounded-lg p-6 w-full border border-gray-100 mb-5">
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <div class="md:col-span-2 sm:col-span-3 col-span-3">
                                <h2 class="mb-2 subtitulo">Fórmula de matrícula: Alumnos de IX y X
                                    ciclo de
                                    Ciencias de la Comunicación</h2>
                                <p class="text-gray-700">Elige la fórmula de inscripción según ciclo y turno, de acuerdo
                                    a tu área de interés</p>
                            </div>
                            <div class="flex justify-left w-full md:col-span-1 sm:col-span-3 col-span-3">
                                <a href="https://fcctp.usmp.edu.pe/pdf/__proceso_matricula_2024_1.pdf" target="_blank"
                                    class="bg-white-100 hover:bg-red-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                                    <i class="fa-regular fa-file-lines pr-2"></i> Ver PDF
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- card 2 -->
                    <div class="bg-white shadow-md rounded-lg p-6 w-full border border-gray-100">
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <div class="md:col-span-2 sm:col-span-3 col-span-3">
                                <h2 class="mb-2 subtitulo">Tesorería: Asesoría de Pagos</h2>
                                <p class="text-gray-700">Horario de atención: <br>Lunes a viernes. De 7:45 a. m. a 8:30
                                    p. m.</p>
                            </div>
                            <div class="flex justify-left w-full md:col-span-1 sm:col-span-3 col-span-3">
                                <a href="https://api.whatsapp.com/send?phone=51983157357" target="_blank"
                                    class="bg-white-100 hover:bg-green-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                                    <i class="fa-brands fa-whatsapp pr-2 text-xl"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-left">
                <img src="assets/images/foto-asesoria.jpg" alt=""
                    class="rounded-3xl lg:h-full md:w-full md:h-48 sm:w-full sm:h-48 object-cover object-fit object-center hidden block lg:block">
            </div>
        </div>
    </section>

    <!-- Guia -->
    <section class="container-fluid border border-t-gray-200 border-b-gray-200 mx-auto px-4" id="guia">
        <div class="container mx-auto px-36 xl:px-36 lg:px-10 md:px-0 sm:px-4 px-4 py-10 lg:py-20 md:py-20 sm:py-10">
            <div class="mx-auto text-center font-poppins mb-10">
                <h6 class="text-red-600 mb-0">Documentos informativos</h6>
                <div class="titulo">Guía para Ingresantes</div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-10">

                <div class="bg-white p-6 rounded-lg shadow-lg border flex gap-4">
                    <div class="flex-shrink-0">
                        <img src="assets/images/ico-cc.svg" alt="Icon" class="h-12 w-12">
                    </div>
                    <div class="flex-grow">
                        <h2 class="subtitulo leading-5 pb-2">Ciencias de la Comunicación</h2>
                        <p class="text-gray-500">Guía para ingresantes</p>
                        <div class="mt-10 mb-4">
                            <a href="https://fcctp.usmp.edu.pe/pdf/guias_ingresante/2024_1/Guia_Ingresante%202024%20I_CC.pdf"
                                target="_blank"
                                class="bg-white-100 hover:bg-red-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 transition-colors duration-300 ease-in-out">
                                Ver Documento <i class="pl-1 fa-regular fa-file-lines"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg border flex gap-4">
                    <div class="flex-shrink-0">
                        <img src="assets/images/ico-tu.svg" alt="Icon" class="h-12 w-12">
                    </div>
                    <div class="flex-grow">
                        <h2 class="subtitulo leading-5 pb-2">Turismo y Hotelería</h2>
                        <p class="text-gray-500">Guía para ingresantes</p>
                        <div class="mt-10 mb-4">
                            <a href="https://fcctp.usmp.edu.pe/pdf/guias_ingresante/2024_1/Guia_Ingresante_2024_I_TURISMO.pdf"
                                target="_blank"
                                class="bg-white-100 hover:bg-teal-500 hover:text-white border px-4 py-3 rounded-md text-gray-500 transition-colors duration-300 ease-in-out">
                                Ver Documento <i class="pl-1 fa-regular fa-file-lines"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg border flex gap-4">
                    <div class="flex-shrink-0">
                        <img src="assets/images/ico-psi.svg" alt="Icon" class="h-12 w-12">
                    </div>
                    <div class="flex-grow">
                        <h2 class="subtitulo leading-5 pb-2">Psicología</h2>
                        <p class="text-gray-500">Guía para ingresantes</p>
                        <div class="mt-10 mb-4">
                            <a href="https://fcctp.usmp.edu.pe/pdf/guias_ingresante/2024_1/Guia_Ingresante_2024_I_PSICOLOGIA.pdf"
                                target="_blank"
                                class="bg-white-100 hover:bg-sky-500 hover:text-white border px-4 py-3 rounded-md text-gray-500 transition-colors duration-300 ease-in-out">
                                Ver Documento <i class="pl-1 fa-regular fa-file-lines"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Plan -->
    <section class="container mx-auto px-4 my-10 lg:my-20 md:my-20 sm:my-10" id="plan">
        <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-1 grid-cols-1 gap-4">
            <div class="mx-left">
                <img src="assets/images/foto-plan.jpg" alt=""
                    class="rounded-3xl h-48 w-full lg:h-full md:w-full md:h-48 sm:w-full sm:h-48 object-cover object-fit">
            </div>
            <div class="p-6 flex-1 content-center">
                <div class="mx-auto text-left font-poppins mb-10">
                    <h6 class="text-red-600 mb-0">Cursos y pre-requisitos por escuela</h6>
                    <div class="titulo">Plan de estudios</div>
                </div>
                <div class="gap-4 grid md:grid-cols-2 sm:grid-cols-1">
                    <!-- card 1 -->
                    <div class="bg-white shadow-md rounded-lg p-6 w-50 border border-gray-100 mb-5">
                        <div class="gap-4 flex flex-col content-center">
                            <div class="">
                                <h2 class="mb-2 subtitulo">Plan de estudios</h2>
                                <p class="text-gray-700">conoce los cursos y pre-requisitos por escuela</p>
                            </div>
                            <div class="flex justify-center w-40 mt-0">

                                <a href="https://fcctp.usmp.edu.pe/micampus/planes-de-estudios/" target="_blank"
                                    class="bg-white-100 hover:bg-red-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                                    Ver Plan<i class="fa-solid fa-chevron-right ps-4"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                    <!-- card 2 -->
                    <div class="bg-white shadow-md rounded-lg p-6 w-50 border border-gray-100 mb-5">
                        <div class="gap-4 flex flex-col content-center">
                            <div class="">
                                <h2 class="mb-2 subtitulo">Horario de Cursos</h2>
                                <p class="text-gray-700">Visualiza tus horarios de acuerdo a tu escuela</p>
                            </div>
                            <div class="flex justify-center w-40 mt-0">
                                <a href="https://fcctp.usmp.edu.pe/site/alumnos/servicios-academicos/horarios/"
                                    target="_blank"
                                    class="bg-white-100 hover:bg-red-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                                    Ver Horarios<i class="fa-solid fa-chevron-right ps-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios online -->
    <section class="container mx-auto px-4 mb-20 lg:mb-20 md:mb-10 sm:mb-10" id="servicio">
        <div class="mx-auto text-center font-poppins my-0 lg:my-20 md:my-10 sm:my-6">
            <h6 class="text-red-600 mb-0">Trámites y consultas</h6>
            <div class="titulo">Servicios online</div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <div class="w-full bg-white shadow-md rounded-lg overflow-hidden border">
                <img class="w-full h-50 object-cover object-fit" src="assets/images/foto-reinicio.jpg" alt="">
                <div class="px-6 mt-10 ">
                    <h2 class="subtitulo">Reinicio de contraseña SAP</h2>
                    <p class="text-gray-700 mt-2 mb-6">Puedes resetear tu contraseña de la intranet académica SAP para
                        matricularte, por favor haz clic en el botón y sigue las instrucciones:</p>
                    <div class="mb-6">
                        <a href="https://sisfcctp.usmp.edu.pe/fcapps/sapform/reseteo/index.php" target="_blank"
                            class="bg-white-100 hover:bg-red-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                            Solicitar reinicio<i class="fa-solid fa-chevron-right ps-4"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full bg-white shadow-md rounded-lg overflow-hidden border">
                <img class="w-full h-50 object-cover object-fit" src="assets/images/foto-correo.jpg" alt="">
                <div class="p-6 py-8">
                    <h2 class="subtitulo">Sobre el correo USMP</h2>
                    <p class="text-gray-700 mt-2 mb-6">Si deseas actualizar la información de seguridad y contraseña o
                        no cuentas con acceso a la bandeja de tu correo institucional, haz clic en el botón:</p>
                    <div class="mb-6">
                        <a href="https://fcctp.usmp.edu.pe/pdf/actualizacion_doc_alumno.pdf" target="_blank"
                            class="bg-white-100 hover:bg-red-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                            Ver instructivo<i class="fa-solid fa-chevron-right ps-4"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full bg-white shadow-md rounded-lg overflow-hidden border">
                <img class="w-full h-50 object-cover object-fit" src="assets/images/foto-sap.jpg" alt="">
                <div class="p-6 py-8">
                    <h2 class="subtitulo">Accede a la Plataforma SAP</h2>
                    <p class="text-gray-700 mt-2 mb-6">Si deseas ingresar a la plataforma SAP para realizar consultas y
                        trámites académicos, puedes hacerlo haciendo clic en el siguiente botón: </p>
                    <div class="mb-6">
                        <a href="https://fioriprd.udm.hec.ondemand.com/sap/bc/ui2/flp?sap-client=400" target="_blank"
                            class="bg-white-100 hover:bg-red-600 hover:text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                            Ingresa aquí<i class="fa-solid fa-chevron-right ps-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Oficinas -->
    <section id="oficina" class="container-fluid mx-auto pt-10 lg:pt-20 md:pt-10 sm:pt-10 bg-gray-100 fondo">
        <div class="mx-auto text-center font-poppins mb-10">
            <h6 class="text-red-600 mb-0">Si tienes consultas o dudas, comúnicate con </h6>
            <div class="titulo">Nuestras Oficinas</div>
        </div>
        <div class="container mx-auto p-6">
            <div class=" mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-8 mb-8">
                <!-- area  -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900">Dirección de Ciencias de la Comunicación
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> direccion_comunicaciones@usmp.pe</p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2081</p>
                    </div>
                </div>

                <!-- area  -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900">Dirección de Psicología
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> direccion_psicologia@usmp.pe</p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2037</p>
                    </div>
                </div>

                <!-- area  -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900">Dirección de Turismo
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> direccion_epth@usmp.pe </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2052</p>
                    </div>
                </div>

                <!-- area  -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900"> Autentificación y Certificación
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> secretaria_facultad_fcctp@usmp.pe </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2126</p>
                    </div>
                </div>

                <!-- area -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900"> Grados y Títulos
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> gradosytitulosfcctp@usmp.pe </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2085</p>
                    </div>
                </div>
                <!-- area -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900"> Acceso a MiCampus / Aula Virtual
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> soporte_micampus@usmp.pe </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2073</p>
                    </div>
                </div>
                <!-- area 2 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900"> Renuncia FCCTP / Carta de Presentación de
                            Egresados
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> sacad@usmp.pe </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2033</p>
                    </div>
                </div>

                <!-- area 3 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900"> Cartas de Presentación para Prácticas
                            Preprofesionales y Profesionales
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> practicas_fcctp@usmp.pe </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2119</p>
                    </div>
                </div>
                <!-- area 2 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900"> Soporte de Correo USMP
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> soporte_fcctp@usmp.pe (Temas generales) </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2073</p>
                    </div>
                </div>
                <!-- area 1 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900"> Pagos / Deuda
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> tesoreriafcctp@usmp.pe </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2133</p>
                        <p><i class="fa-brands fa-whatsapp pr-2"></i> +51 983157357</p>
                        <p><i class="fa-solid fa-link pr-2"></i><a href="https://fcctp.usmp.edu.pe/tesoreria"
                                target="_blank"> Visitar Website</a></p>
                    </div>
                </div>
                <!-- area 3 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900"> Oficina de Bienestar Universitario
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> bienestarfcctp@usmp.pe</p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo Comunicaciones: 2066</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo Turismo: 2059</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo Psicología: 2067</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-red-700 text-white py-10">
        <div class="container mx-auto px-6 flex flex-wrap items-center justify-between">
            <div class="w-full md:w-auto mb-4 md:mb-0">
                <img src="assets/images/logo-usmp-footer.svg" alt="Logo" class="h-16 mx-auto">
            </div>
            <div class="w-full md:w-auto md:w-100 mb-4 md:mb-0 lg:text-right md:text-right sm:text-center text-center">
                <h2 class="text-lg font-bold">Comúnicate con nuestras oficinas</h2>
                <p class="text-white">Para cualquier consulta o duda</p>

                <div class="mt-4">
                    <a href="#oficina"
                        class=" bg-red-700 border border-white hover:bg-white hover:text-red-700 py-2 px-4 rounded-md text-center text-white text-base font-light transition-colors duration-300 ease-in-out cursor-pointer w-full">
                        <i class="fa-solid fa-building pr-4"></i>Ver oficinas
                    </a>
                </div>

            </div>
        </div>
    </footer>
    <!-- Mini Footer -->
    <div class="bg-gray-900 text-gray-400 py-4 px-4">
        <div class="container mx-auto flex flex-col lg:flex-row justify-between items-center space-y-4 md:space-y-0">
            <div class="text-center md:text-left">&copy; 2024 Facultad de Ciencias de la Comunicación, Turismo y
                Psicología. Todos los derechos reservados.</div>
            <div class="text-sm sm:text-sm block md:block sm:hidden hidden">
                <nav class="space-x-2">
                    <a href="#matricula" class="hover:underline">Matricula</a>
                    <a href="#asesoria" class="hover:underline">Asesorías</a>
                    <a href="#guia" class="hover:underline">Guías</a>
                    <a href="#plan" class="hover:underline">Plan de estudios</a>
                    <a href="#servicio" class="hover:underline">Servicios online</a>
                    <a href="#oficina" class="hover:underline">Oficinas</a>
                </nav>
            </div>
        </div>
    </div>
    <!-- Script propio -->
    <script src="assets/js/script.js"></script>
    <!-- Script lightbox -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


        <script>
            console.log('All assets are loaded');

            function demo() {
                console.log('Exec whisper Say: Mi doc');
                //botmanChatWidget.sayAsBot('Hola soy el bot Kokoldman. En que puedo ayudarte?')
                ///botmanChatWidget.whisper('Mi doc')
            }


            var botmanWidget = {

                title: 'FCCTPBot',
                introMessage: '¡Hola! Soy el Asistente Virtual de la FCCTP 🤖. Estoy aquí para ayudarte con el proceso de matrícula 2024-2. <p>¿En qué puedo asistirte hoy? 😄</p>',
                mainColor: '#dd3333',
                bubbleBackground: '#fff',
                headerTextColor: '#ffffff',
                placeholderText: 'Escribe un mensaje..',
                bubbleAvatarUrl: 'https://botman.io/img/logo.png',
                //bubbleAvatarUrl: 'https://avatars.githubusercontent.com/u/46945071?v=4',
                //bubbleBackground:'#c02026',
                desktopHeight: 600,
                desktopWidth: 400,
                aboutLink: 'https://hube.pe',
                aboutText: 'Desarrollado por OTI-FCCTP',
                alwaysUseFloatingButton: !0,

            }


        function checkBotmanWidgetReady(callback) {
            if (typeof botmanChatWidget !== 'undefined') {
                callback();
            } else {
                setTimeout(function() { checkBotmanWidgetReady(callback); }, 100);
            }
        }

        window.onload = function() {
                checkBotmanWidgetReady(function() {
                    demo();
                    //document.getElementById('chatBotManFrame').style.backgroundImage = 'none'; //bad
                });

        };



        </script>
        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
</body>

</html>

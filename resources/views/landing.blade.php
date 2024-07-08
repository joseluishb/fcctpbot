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

        .mobile-closed-message-avatar {
            height: 66px !important;
            width: 66px !important;
            top: 30px !important;
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
                    <li><a href="#inicio"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Inicio</a></li>
                    <li><a href="#matricula"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Matrícula</a></li>
                    <li><a href="#horario"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Horarios</a></li>
                    <li class="hidden"><a href="#guia"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Guías</a></li>
                    <li><a href="#asesoria"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Asesorías</a></li>
                    <li><a href="#servicio"
                            class="text-gray-700 hover:text-red-500 transition-colors duration-300">Servicios
                            online</a></li>

                </ul>
            </nav>
        </div>
        <ul id="mobile-menu"
            class="absolute bg-white w-full left-0 top-full hidden lg:hidden space-y-4  shadow-lg menu-enter-active">
            <a href="#inicio" class="text-gray-700">
                <li
                    class="text-left px-8 pt-3 pb-3 border-b hover:bg-gray-700 hover:text-white transition-colors duration-300">
                    Inicio</li>
                <a href="#matricula" class="text-gray-700">
                    <li
                        class="text-left px-8 pt-3 pb-3 border-b border-t hover:bg-gray-700 hover:text-white transition-colors duration-300">
                        Matrícula</li>
                </a>
                <a href="#horario" class="text-gray-700">
                    <li
                        class="text-left px-8 pt-3 pb-3 border-b hover:bg-gray-700 hover:text-white transition-colors duration-300">
                        Horarios</li>
                </a>
                <a href="#guia" class="text-gray-700 hidden">
                    <li
                        class="text-left px-8 pt-3 pb-3 border-b hover:bg-gray-700 hover:text-white transition-colors duration-300">
                        Guías</li>
                </a>
                <a href="#asesoria" class="text-gray-700">
                    <li
                        class="text-left px-8 pt-3 pb-3 border-b hover:bg-gray-700 hover:text-white transition-colors duration-300">
                        Asesorías</li>
                </a>
                <a href="#servicio" class="text-gray-700">
                    <li
                        class="text-left px-8 pt-3 pb-3 border-b hover:bg-gray-700 hover:text-white transition-colors duration-300">
                        Servicios online</li>
                </a>

            </a>
        </ul>

    </header>

    <!-- Sección slider -->
    <section id="inicio"
        class="container-fluid mx-auto px-4 pt-32 custom-gradient lg:custom-gradient md:custom-gradient-md sm:custom-gradient-md">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                <div
                    class="px-4 pb-0 md:pb-5 sm:pb-0 flex-1 content-top xl:content-center lg:content-top md:content-top sm:content-top">
                    <h2
                        class="xl:text-5xl lg:text-3xl md:text-3xl sm:text-3xl text-3xl font-bold font-poppins text-center md:text-left sm:text-center">
                        Servicio
                        de
                        matrícula
                        <br>
                    </h2>
                    <p
                        class="text-gray-900 font-light text-xl md:text-xl  py-4 text-center md:text-left sm:text-center">
                        Revisa las orientaciones y soporte <br>del proceso de inscripción académica
                    </p>
                    <div
                        class="text-center md:text-left sm:text-center flex-1 xl:flex lg:flex-1 md:flex-1 sm:flex-1 gap-4 pt-4">
                        <div class="pb-8"><a href="#matricula"
                                class="bg-red-700 hover:bg-red-800 py-3 px-4 rounded-md text-center text-white text-base font-light transition-colors duration-300 ease-in-out w-25 cursor-pointer">
                                Más información<i class="fa-solid fa-chevron-down ps-4"></i>
                            </a></div>
                        <div><a data-fancybox href="https://www.youtube.com/watch?v=WZlx3uU5mSQ"
                                class="btn btn-danger bg-transparent hover:bg-red-700 py-3 px-4 rounded-md text-center text-gray-600 hover:text-white text-base font-md transition-colors duration-300 ease-in-out w-25 cursor-pointer border-2 border-gray-500 hover:border-red-700">
                                Video instructivo de matrícula<i class="fa-solid fa-chevron-right ps-4"></i>
                            </a></div>


                    </div>
                </div>
                <div class="p-6">
                    <div
                        class="rounded-md md:rounded-3xl sm:rounded-md flex items-center justify-center relative bg-black">
                        <img src="assets/images/video_slider.jpg" alt=""
                            class="rounded-md md:rounded-3xl sm:rounded-md opacity-60 w-full h-full object-fit object-cover object-center">
                        <a data-fancybox href="https://www.youtube.com/watch?v=WZlx3uU5mSQ" class="absolute">
                            <i class="fa-regular fa-circle-play text-white text-7xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Sección matricula -->
    <section id="matricula" class="container mx-auto px-4 mb-6 pt-10 ">
        <div class="mx-auto text-center font-poppins mb-14">
            <h6 class="text-red-600 mb-0">Información para matrícula</h6>
            <div class="titulo">Proceso de matrícula académica</div>
        </div>
        <div class=" grid grid-cols-12 gap-4">
            <div class="col-span-12 md:col-span-4 sm:col-span-12">
                <div class="container gap-6 border border-gray-300 rounded-lg">
                    <div class="h-48">
                        <img src="assets/images/foto-cronograma.jpg" alt=""
                            class="w-full h-full object-cover object-center rounded-t-lg">
                    </div>
                    <div class=" col-span-2">
                        <div class="xl:p-8 lg:p-5 md:p-4 sm:p-4 p-4">
                            <div class="subtitulo">Cronograma de matrícula <br>2024 - II</div>
                            <div class="pt-2 mb-6 text-gray-700 text-base font-light">Información general para realizar
                                tu inscripción al presente ciclo académico.</div>
                            <a href="https://fcctp.usmp.edu.pe/pdf/2024/alumnos-regulares-cronograma-2024-2.pdf"
                                target="_blank"
                                class="bg-gray-600 hover:bg-gray-700 text-white border px-4 py-3 rounded-md font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                                Ingresar aquí<i class="fa-solid fa-chevron-right ps-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-span-12 md:col-span-8 sm:col-span-12">
                <div
                    class="p-6 md:pr-0 sm:pr-10 flex-col content-center items-centerxl:w-12/12 xl:w-12/12 lg:w-12/12 md:w-12/12 sm:w-12/12 w-full h-full ">
                    <h2 class="text-xl font-medium font-poppins mb-6 ">¿Cuáles son los requisitos que debo cumplir para
                        mi
                        proceso de
                        matrícula?</h2>
                    <div class="text-gray-700 font-light">
                        <div class="">Para iniciar tu proceso de matrícula a través de la plataforma SAP,
                            tienes
                            que cumplir los siguientes requisitos:</div>
                        <div class="py-4">
                            <ul class="list-disc pl-10">
                                <li>No tener deudas pendientes</li>
                                <li>Cancelar tu recibo por derecho de matrícula</li>
                            </ul>
                        </div>
                        <div class="">
                            <div class="mb-4">Además, Si:</div>
                            <ul class="list-disc pl-10">
                                <li>Te matriculaste en el semestre 2024-I y que no tengas impedimento alguno por sanción
                                    disciplinaria o deficiencia académica.</li>
                                <li>Realizaste el trámite de Reserva de matrícula para el semestre 2024-I.</li>
                                <li>Realizaste el trámite de Retiro de ciclo del semestre 2024-I.</li>
                                <li>Tienes Resolución de Reactualización de matrícula para el semestre 2024-II.</li>
                                <li>Tienes Resolución de matrícula especial para el 2024-II.</li>
                                <li>Perteneces al grupo de ingresantes 2024-II en todas las modalidades con la condición
                                    de
                                    admitido por la Oficina de Admisión.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>





    <!-- Horarios -->
    <section id="horario" class="container mx-auto pt-10 px-4 my-0 lg:my-20 md:my-20 sm:my-5 ">
        <div class="mx-auto text-left font-poppins mb-10">
            <h6 class="text-red-600 mb-0">Asignaturas y prerrequisitos por escuela </h6>
            <div class="titulo">Plan de estudios y Horarios</div>
        </div>


        <div class="grid grid-cols-3 gap-10 p-10 bg-white rounded-xl border">
            <div class="col-span-3 lg:col-span-2 md:col-span-3 sm:col-span-3 ">
                <div>
                    <div class="">
                        <h2 class=" subtitulo">Horario de Cursos</h2>
                        <p class="text-gray-700">Visualiza los turnos que tenemos disponibles</p>
                        <div class="flex justify-left w-full mt-4">
                            <a href="https://app.powerbi.com/view?r=eyJrIjoiOGIxOWQ2NmYtMGYxOS00YWVmLThkMTYtZWI2ZjVhY2YyZGQ1IiwidCI6Ijk4MjAxZmVmLWQ5ZjYtNGU2OC04NGY1LWMyNzA1MDc0ZTM0MiIsImMiOjR9"
                                target="_blank"
                                class="bg-red-700 hover:bg-red-800 py-3 px-3 rounded-md text-center text-white text-base font-light transition-colors duration-300 ease-in-out cursor-pointer">
                                Horarios de cursos<i class="fa-solid fa-chevron-right ps-4"></i>
                            </a>
                        </div>
                    </div>

                    <div class="line mt-10">
                        <hr>
                    </div>

                    <div class="mt-10 gap-4 content-center">
                        <div class="subtitulo">Conoce los planes de estudios </div>
                        <div class="mt-1 mb-6">En esta sección encontrarás los cursos y pre-requisitos de cada
                            escuela.</div>

                        <div class="flex flex-col lg:flex-row md:flex-row sm:flex-col m-1 gap-4  grid-cols-12">
                            <div class="col-span-6 border p-4 rounded-md shadow-md md:w-1/2 sm:w-full">
                                <div class="font-semibold pb-4">
                                    <div>Ingresantes hasta el</div>
                                    <div class="">semestre 2022-I</div>
                                </div>
                                <a href="https://fcctp.usmp.edu.pe/pdf/2024/plan-cc-2024-I.pdf" target="_blank">
                                    <div
                                        class="text-sm border my-2 py-4 px-5 border-gray-300 rounded w-100 text-left bg-white border-l-4 border-l-red-700 hover:bg-red-700 hover:text-white transition-all duration-300 ease-out">
                                        <div class="flex content-center align-center justify-between">
                                            <div>Ciencias de la Comunicación</div>
                                            <div><i class="fa-solid fa-chevron-right ps-4"></i></div>
                                        </div>
                                    </div>
                                </a>
                                <a href="https://fcctp.usmp.edu.pe/pdf/2024/plan-tu-2024-I.pdf" target="_blank">
                                    <div
                                        class="text-sm border my-2 py-4 px-5 border-gray-300 rounded w-100 text-left bg-white border-l-4 border-l-teal-800 hover:bg-teal-800 hover:text-white transition-all duration-300 ease-out">
                                        <div class="flex content-center align-center justify-between">
                                            <div>Turismo y Hotelería</div>
                                            <div><i class="fa-solid fa-chevron-right ps-4"></i></div>
                                        </div>
                                    </div>
                                </a>

                                <a href="https://fcctp.usmp.edu.pe/pdf/2024/plan-psi-2024-I.pdf" target="_blank">
                                    <div
                                        class="text-sm border my-2 py-4 px-5 border-gray-300 rounded w-100 text-left bg-white border-l-4 border-l-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 ease-out">
                                        <div class="flex content-center align-center justify-between">
                                            <div>Psicología</div>
                                            <div><i class="fa-solid fa-chevron-right ps-4"></i></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="border p-4 rounded-md shadow-md md:w-1/2 sm:w-full">
                                <div class="font-semibold pb-4">
                                    <div>Ingresantes a partir del </div>
                                    <div>semestre 2022-II</div>
                                </div>
                                <a href="https://fcctp.usmp.edu.pe/pdf/2024/plan-cc-2024-II.pdf" target="_blank">
                                    <div
                                        class="text-sm border my-2 py-4 px-5 border-gray-300 rounded w-100 text-left bg-white border-l-4 border-l-red-700 hover:bg-red-700 hover:text-white transition-all duration-300 ease-out">
                                        <div class="flex content-center align-center justify-between">
                                            <div>Ciencias de la Comunicación</div>
                                            <div><i class="fa-solid fa-chevron-right ps-4"></i></div>
                                        </div>
                                    </div>
                                </a>
                                <a href="https://fcctp.usmp.edu.pe/pdf/2024/plan-tu-2024-II.pdf" target="_blank">
                                    <div
                                        class="text-sm border my-2 py-4 px-5 border-gray-300 rounded w-100 text-left bg-white border-l-4 border-l-teal-800 hover:bg-teal-800 hover:text-white transition-all duration-300 ease-out">
                                        <div class="flex content-center align-center justify-between">
                                            <div>Turismo y Hotelería</div>
                                            <div><i class="fa-solid fa-chevron-right ps-4"></i></div>
                                        </div>
                                    </div>
                                </a>

                                <a href="https://fcctp.usmp.edu.pe/pdf/2024/plan-psi-2024-II.pdf" target="_blank">
                                    <div
                                        class="text-sm border my-2 py-4 px-5 border-gray-300 rounded w-100 text-left bg-white border-l-4 border-l-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 ease-out">
                                        <div class="flex content-center align-center justify-between">
                                            <div>Psicología</div>
                                            <div><i class="fa-solid fa-chevron-right ps-4"></i></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
            <div class="col-span-3 lg:col-span-1 md:col-span-0 sm:col-span-3"> <img
                    src="assets/images/foto-asesoria.jpg" alt=""
                    class="rounded-xl lg:h-full md:w-full md:h-48 sm:w-full sm:h-48 object-cover object-fit object-center hidden block lg:block">
            </div>
        </div>


    </section>

    <!-- Guia -->
    <section class="container-fluid border border-t-gray-200 border-b-gray-200 mx-auto px-4 hidden" id="guia">
        <div class="container mx-auto px-36 xl:px-24 lg:px-0 md:px-0 sm:px-4 px-4 py-10 lg:py-20 md:py-20 sm:py-10">
            <div class="mx-auto text-center font-poppins mb-10">
                <h6 class="text-red-600 mb-0">Documentos informativos</h6>
                <div class="titulo">Guía para Ingresantes</div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-10">

                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-300 flex gap-4">
                    <div class="flex-shrink-0">
                        <img src="assets/images/ico-cc.svg" alt="Icon" class="h-12 w-12">
                    </div>
                    <div class="flex-grow">
                        <h2 class="subtitulo leading-5 pb-2">Ciencias de la Comunicación</h2>
                        <p class="text-gray-500">Guía para ingresantes</p>
                        <div class="mt-10 mb-4">
                            <a href="https://fcctp.usmp.edu.pe/pdf/guias_ingresante/2024_1/Guia_Ingresante%202024%20I_CC.pdf"
                                target="_blank"
                                class="bg-gray-600 hover:bg-gray-700 text-white border px-4 py-3 rounded-md transition-colors duration-300 ease-in-out">
                                Ver Documento <i class="pl-1 fa-regular fa-file-lines"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-300 flex gap-4">
                    <div class="flex-shrink-0">
                        <img src="assets/images/ico-tu.svg" alt="Icon" class="h-12 w-12">
                    </div>
                    <div class="flex-grow">
                        <h2 class="subtitulo leading-5 pb-2">Turismo y Hotelería</h2>
                        <p class="text-gray-500">Guía para ingresantes</p>
                        <div class="mt-10 mb-4">
                            <a href="https://fcctp.usmp.edu.pe/pdf/guias_ingresante/2024_1/Guia_Ingresante_2024_I_TURISMO.pdf"
                                target="_blank"
                                class="bg-gray-600 hover:bg-gray-700 text-white border px-4 py-3 rounded-md transition-colors duration-300 ease-in-out">
                                Ver Documento <i class="pl-1 fa-regular fa-file-lines"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-300 flex gap-4">
                    <div class="flex-shrink-0">
                        <img src="assets/images/ico-psi.svg" alt="Icon" class="h-12 w-12">
                    </div>
                    <div class="flex-grow">
                        <h2 class="subtitulo leading-5 pb-2">Psicología</h2>
                        <p class="text-gray-500">Guía para ingresantes</p>
                        <div class="mt-10 mb-4">
                            <a href="https://fcctp.usmp.edu.pe/pdf/guias_ingresante/2024_1/Guia_Ingresante_2024_I_PSICOLOGIA.pdf"
                                target="_blank"
                                class="bg-gray-600 hover:bg-gray-700 text-white border px-4 py-3 rounded-md  transition-colors duration-300 ease-in-out">
                                Ver Documento <i class="pl-1 fa-regular fa-file-lines"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- asesorias -->
    <section class="container mx-auto px-4 pt-10 my-10 lg:my-20 md:my-20 sm:my-10" id="asesoria">
        <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-1 grid-cols-1 gap-4">
            <div class="mx-left">
                <img src="assets/images/foto-plan.jpg" alt=""
                    class="rounded-3xl h-48 w-full lg:h-full md:w-full md:h-48 sm:w-full sm:h-48 object-cover object-fit">
            </div>
            <div class="p-6 flex-1 content-center">
                <div class="mx-auto text-left font-poppins mb-10">
                    <h6 class="text-red-600 mb-0">Asesoría académica y de pagos</h6>
                    <div class="titulo">Nuestras asesorías</div>
                </div>
                <div class="">
                    <!-- card 1 -->
                    <div class="bg-white shadow-md rounded-lg p-6 w-full border border-gray-300 mb-5">
                        <div class="">
                            <h2 class="mb-2 subtitulo">Fórmula de matrícula: Alumnos de IX y X
                                ciclo de
                                Ciencias de la Comunicación</h2>
                            <p class="text-gray-700">Elige la fórmula de inscripción según ciclo y turno, de acuerdo
                                a tu área de interés</p>
                        </div>
                        <div class="pt-4">
                            <a href="https://fcctp.usmp.edu.pe/documentos/pdf/proceso-de-matricula-2024-II.pdf"
                                target="_blank"
                                class="bg-gray-600 hover:bg-gray-700 text-white border px-4 py-3 rounded-md font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem]   text-center">
                                <i class="fa-regular fa-file-lines pr-2"></i> Ver PDF
                            </a>
                        </div>
                    </div>
                    <!-- card 2 -->
                    <div class="bg-white shadow-md rounded-lg p-6 w-full border border-gray-300">
                        <div class="">
                            <div class="mb-2 subtitulo">Tesorería: Asesoría de Pagos</div>
                            Horario: Lunes a viernes de 7:45 a. m. a 8:30
                            p. m.<br>
                            Email: tesoreriafcctp@usmp.pe<br>
                            Teléfono: 513 6300 | Anexo: 2133<br>
                        </div>
                        <div class="pt-4 flex gap-4">
                            <a href="https://api.whatsapp.com/send?phone=51983157357" target="_blank"
                                class="bg-green-500 hover:bg-green-700 text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] text-center">
                                <i class="fa-brands fa-whatsapp pr-2 text-xl"></i> WhatsApp
                            </a>
                            <a href="https://fcctp.usmp.edu.pe/tesoreria" target="_blank"
                                class="outline-1 border-2 border-gray-400 px-4 py-3 rounded-md hover:bg-gray-600 hover:text-white hover:border-gray-500 text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] text-center">
                                <i class="fa-solid fa-link pr-2 text-xl"></i>
                                Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios online -->
    <section class="container mx-auto px-4 pt-2 mb-20 lg:mb-20 md:mb-10 sm:mb-10" id="servicio">
        <div class="mx-auto text-center font-poppins my-0 lg:my-20 md:my-10 sm:my-6">
            <h6 class="text-red-600 mb-0">Trámites y consultas</h6>
            <div class="titulo">Servicios online</div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            <div class="w-full bg-white shadow-md rounded-lg overflow-hidden border">
                <img class="w-full h-50 object-cover object-fit" src="assets/images/foto-reinicio.jpg" alt="">
                <div class="px-6 mt-10 ">
                    <h2 class="subtitulo">Actualización de contraseña SAP</h2>
                    <p class="text-gray-700 mt-2 mb-6 text-sm">Puedes actualizar o renovar tu contraseña de la Portal
                        Académico
                        SAP para matricularte, por favor haz clic en el botón y sigue las instrucciones.</p>
                    <div class="mb-6">
                        <a href="https://sisfcctp.usmp.edu.pe/fcapps/sapform/reseteo/index.php" target="_blank"
                            class="bg-gray-600 hover:bg-gray-700 text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                            Solicitar reinicio<i class="fa-solid fa-chevron-right ps-4"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full bg-white shadow-md rounded-lg overflow-hidden border">
                <img class="w-full h-50 object-cover object-fit" src="assets/images/foto-correo.jpg" alt="">
                <div class="p-6 py-8">
                    <h2 class="subtitulo">Sobre el correo USMP</h2>
                    <p class="text-gray-700 mt-2 mb-6 text-sm">Si deseas actualizar la información de seguridad y
                        contraseña o
                        no cuentas con acceso a la bandeja de tu correo institucional, haz clic en el botón:</p>
                    <div class="mb-6">
                        <a href="https://fcctp.usmp.edu.pe/pdf/actualizacion_doc_alumno.pdf" target="_blank"
                            class="bg-gray-600 hover:bg-gray-700 text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                            Ver instructivo<i class="fa-solid fa-chevron-right ps-4"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full bg-white shadow-md rounded-lg overflow-hidden border">
                <img class="w-full h-50 object-cover object-fit" src="assets/images/foto-sap.jpg" alt="">
                <div class="p-6 py-8">
                    <h2 class="subtitulo">Portal Académico SAP</h2>
                    <p class="text-gray-700 mt-2 mb-6 text-sm">Si deseas ingresar a la plataforma SAP para realizar
                        consultas y
                        trámites académicos, puedes hacerlo haciendo clic en el siguiente botón: </p>
                    <div class="mb-6">
                        <a href="https://fioriprd.udm.hec.ondemand.com/sap/bc/ui2/flp?sap-client=400" target="_blank"
                            class="bg-gray-600 hover:bg-gray-700 text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                            Ingresa aquí<i class="fa-solid fa-chevron-right ps-4"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full bg-white shadow-md rounded-lg overflow-hidden border">
                <img class="w-full h-50 object-cover object-fit" src="assets/images/foto-pagador.jpg" alt="">
                <div class="p-6 py-8">
                    <h2 class="subtitulo">Consulta de buen pagador</h2>
                    <p class="text-gray-700 mt-2 mb-6 text-sm"> Verifica si te encuentras en el registro de BUEN
                        PAGADOR para el
                        proceso de matrícula 2024-2. Puedes hacerlo haciendo clic en el siguiente botón: </p>
                    <div class="mb-6">
                        <a href="https://fcctp.usmp.edu.pe/consulta-buen-pagador/" target="_blank"
                            class="bg-gray-600 hover:bg-gray-700 text-white border px-4 py-3 rounded-md text-gray-500 font-light transition-colors duration-300 ease-in-out w-25 block w-[12rem] mb-2 sm:mb-4 text-center">
                            Consulta aquí<i class="fa-solid fa-chevron-right ps-4"></i>
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
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2005</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo de Coordinación Académica: 2036</p>
                    </div>
                </div>
                <!-- area  -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900">Dirección de Psicología
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> direccion_psicologia@usmp.pe</p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2009</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo de Coordinación Académica: 2041</p>
                    </div>
                </div>
                <!-- area  -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900">Dirección de Turismo y Hotelería
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> direccion_epth@usmp.pe </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2016</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo de Coordinación Académica: 2113</p>
                    </div>
                </div>
                <!-- area  -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900"> Autentificación y Certificación
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> secretaria_facultad_fcctp@usmp.pe </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2010, 2126</p>
                    </div>
                </div>
                <!-- area -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                    <div class="p-4 text-sm flex-1 content-center h-full text-gray-600 p-6">
                        <h3 class="text-md font-semibold mb-2 text-gray-900"> Grados y Títulos
                        </h3>
                        <p><i class="fa-regular fa-envelope pr-2"></i> gradosytitulosfcctp@usmp.pe </p>
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300</p>
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2008</p>
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
                        <p><i class="fa-regular fa-building pr-2"></i> Anexo: 2007, 2047, 2056, 2133</p>
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
                        <p><i class="fa-solid fa-square-phone pr-3"></i> 513 6300 | Anexo 2015</p>
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
                    <a href="#inicio" class="hover:underline">Inicio</a>
                    <a href="#matricula" class="hover:underline">Matricula</a>
                    <a href="#horario" class="hover:underline">Horarios</a>
                    <a href="#guia" class="hover:underline">Guías</a>
                    <a href="#asesoria" class="hover:underline">Asesorías</a>
                    <a href="#servicio" class="hover:underline">Servicios online</a>
                </nav>
            </div>
        </div>
    </div>

    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="bg-white w-full max-w-md mx-4 mx-auto rounded-lg shadow-lg">
            <div class="flex flex-col h-full">

                <div class="bg-white px-5 py-4 flex justify-between items-center rounded-t-lg">

                    <h3 class="text-lg font-semibold mb-4">Consulta tu turno de matrícula</h3>
                    <button class="text-gray-600 hover:text-gray-800 focus:outline-none" onclick="closeModal();">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            <div class="flex-1 p-8">
                <form method="POST" action="{{ route('turnomatr') }}" id="formTurnoMtr">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Número de documento:</label>
                        <input name="dni" placeholder="Ingresa tu DNI o CE" required type="text" style="border: solid 2px #999"
                            class="mt-1 block w-full border-gray-400 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                    </div>
                    <div class="mb-4 hidden" id="cMsge">
                        <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                            <p class="font-bold" id="msge"></p>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" id="btnAccept" class="px-4 py-2 text-white bg-red-700 hover:bg-red-800 rounded">Consultar</button>
                    </div>


                </form>
            </div>
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
                frameEndpoint: '/chat',
                title: 'FCCTPBot',
                introMessage: '¡Hola! Soy el Asistente Virtual de la FCCTP 🤖. Estoy aquí para ayudarte con el proceso de matrícula 2024-2. <p>¿En qué puedo asistirte hoy? 😄</p>',
                mainColor: '#dd3333',
                bubbleBackground: '#fff',
                headerTextColor: '#ffffff',
                placeholderText: 'Escribe un mensaje..',
                bubbleAvatarUrl: '/assets/images/botico.png',
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
                });
        };


        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

    function hasClass(el, className) {
        if (el.classList)
            return el.classList.contains(className)
        else
            return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'))
    }

    function addClass(el, className) {
        if (el.classList)
            el.classList.add(className)
        else if (!hasClass(el, className)) el.className += " " + className
    }

    function removeClass(el, className) {
        if (el.classList)
            el.classList.remove(className)
        else if (hasClass(el, className)) {
            var reg = new RegExp('(\\s|^)' + className + '(\\s|$)')
            el.className=el.className.replace(reg, ' ')
        }
    }

        const formTurnoMtr = document.getElementById("formTurnoMtr");

        if(formTurnoMtr) {
            formTurnoMtr.addEventListener("submit", function(event) {
                event.preventDefault();

                const bntSubmit = document.getElementById("btnAccept");
                bntSubmit.innerHTML = '<i class="fas fa-sync fa-spin"></i>';
                addClass(bntSubmit, 'disabled');



                const action = event.target.getAttribute('action');
                const formData = new FormData(event.target);
                fetch(action, {
                        method: 'POST',
                        credentials: "same-origin",
                        headers: {
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then((response) => {
                        if (!response.ok) {
                            throw response;
                        }
                        return response.json();
                    })
                    .then((data) => {
                        document.getElementById('cMsge').classList.remove('hidden');
                        document.getElementById('btnAccept').classList.add('hidden');

                        const msge = document.getElementById('msge');
                        if (data.status === 'Founded') {

                            msge.innerHTML = data.msge;

                            event.target.reset();


                        }else{
                            msge.innerHTML = 'Puedes ingresar a nuestro chatbot para resolver tus dudas referente a la matrícula 2024-2';

                        }
                    })
                    .catch(handleRequestError);


            });
        }

    function handleRequestError(error) {
        if (error instanceof Error) {
            console.log(error.message); // Error en la solicitud
        } else {
            error.json().then((jsonError) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: jsonError.message,
                });
                console.log('Error en la respuesta: ' + error.status); // Código de estado de error
                console.log('Mensaje de error: ' + jsonError.message); // Mensaje de error devuelto en la respuesta
            }).catch((parseError) => {
                console.log('Error al analizar el JSON de error:', parseError);
            });
        }
    }
        </script>
        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
</body>

</html>

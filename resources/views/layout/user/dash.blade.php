<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>PPTSB</title>
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--=============== css  ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link type="text/css" rel="stylesheet" href="{{ asset('user/css/plugins.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('user/css/color.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMgUE4z1wbZbE+6DjlzDD0TcwH3JG5J1f6/8eS" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{ asset('user/images/logo.png') }}">
    <style>
        .offset-sm-3 {
            border: 2px solid green;
        }

        .label-tabel {
            padding-right: 5rem;
            font-weight: 600;
            text-align: left;
            padding-block: 0.4rem;
        }

        .isitabel {
            padding-left: 1rem;
            text-align: left;
            font-weight: bold;
            padding-block: 0.4rem;
        }

        .bg-wrap {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
        }

        .bg {
            background-size: contain;
            /* or use cover depending on your needs */
            background-position: center;
            background-repeat: no-repeat;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .footer-list ul li.active a {
            color: red;
            /* Contoh gaya: Mengubah warna teks menjadi merah */
            font-weight: bold;
            /* Contoh gaya: Membuat teks menjadi tebal */
        }

        .nav-active {
            background-color: #eea1a1;
            /* Latar belakang abu-abu terang */
            border-radius: 5px;
            /* Opsional: Membulatkan sudut */
        }
    </style>
</head>

<body>
    <!-- main start  -->
    <div id="main">
        <!-- progress-bar  -->
        <div class="progress-bar-wrap">
            <div class="progress-bar color-bg"></div>
        </div>
        <!-- progress-bar end -->
        <!-- header -->
        <header class="main-header">
            <!-- top bar -->
            <div class="top-bar fl-wrap">
                <div class="container">
                    <div class="date-holder">
                        <span class="date_num"></span>
                        <span class="date_mounth"></span>
                        <span class="date_year"></span>
                    </div>
                    <ul class="topbar-social">
                        <li><a href="{{ route('facebook') }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{ route('twitter') }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{ route('instagram') }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="{{ route('youtube') }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- top bar end -->
            <div class="header-inner fl-wrap">
                <div class="container">
                    <!-- logo holder  -->
                    <img src="{{ asset('user/images/logo1.jpeg') }}" alt=""
                        style="width: 10rem;height: 3rem; border-radius: 10px;" class="logo-holder">
                    <!-- logo holder end -->
                    <div class="srf_btn htact "><i class="fa-solid fa-right-to-bracket"></i> <span
                            class="header-tooltip"><a style="color: white" href="/login-halaman">Login</a></span></div>
                    <!-- header-search-wrap -->
                    <div class="header-search-wrap novis_sarch">
                        <div class="widget-inner">
                            <form action="#">
                                <input name="se" id="se" type="text" class="search"
                                    placeholder="Search..." value="" />
                                <button class="search-submit" id="submit_btn"><i
                                        class="fa fa-search transition"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- header-search-wrap end -->
                    <!-- nav-button-wrap-->
                    <div class="nav-button-wrap">
                        <div class="nav-button">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                    <!-- nav-button-wrap end-->
                    <!-- navigation -->
                    <div class="nav-holder main-menu">
                        <nav>
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="/pengumuman">Pengumuman</a></li>
                                <li><a href="/sejarah">Sejarah</a></li>
                                <li>
                                    <a href="#">Pengurus<i class="fas fa-caret-down"></i></a>
                                    <ul>
                                        <li><a href="{{ url('user/pusat') }}">Pusat</a></li>
                                        <li><a href="{{ url('user/regional') }}">Regional</a></li>
                                        <li><a href="{{ url('user/cabang') }}">Cabang</a></li>
                                        <li><a href="{{ url('user/sektor') }}">Sektor</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- navigation end -->
                </div>
            </div>
        </header>
        <!-- header end -->
        <!-- wrapper -->
        @yield('content')
        <!-- footer -->
        <footer class="fl-wrap main-footer">
            <div class="container">
                <!-- footer-widget-wrap -->
                <div class="footer-widget-wrap fl-wrap">
                    <div class="row">
                        <!-- footer-widget -->
                        <div class="container">
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <div class="footer-widget">
                                        <div class="footer-widget-content">
                                            <img src="{{ asset('user/images/logo1.jpeg') }}" alt="Logo"
                                                style="width: 200px; height: auto;" class="footer-logo">
                                            <div class="footer-social fl-wrap">
                                                <ul>
                                                    <li><a href="{{ route('facebook') }}" target="_blank"><i
                                                                class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="{{ route('twitter') }}" target="_blank"><i
                                                                class="fab fa-twitter"></i></a></li>
                                                    <li><a href="{{ route('instagram') }}" target="_blank"><i
                                                                class="fab fa-instagram"></i></a></li>
                                                    <li><a href="{{ route('youtube') }}" target="_blank"><i
                                                                class="fab fa-youtube"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="footer-widget">
                                        <div class="footer-widget-title">Links</div>
                                        <div class="footer-widget-content">
                                            <div class="footer-list footer-box fl-wrap">
                                                <ul>
                                                    <li><a href="index">Home</a></li>
                                                    <li><a href="pengumuman">Pengumuman</a></li>
                                                    <li><a href="sejarah">Sejarah</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- footer-widget end-->
                    </div>
                </div>
                <!-- footer-widget-wrap end-->
            </div>
            <div class="footer-bottom fl-wrap">
                <div class="container">
                    <div class="to-top"> <i class="fas fa-caret-up"></i></div>
                </div>
            </div>
        </footer>
        <!-- footer end-->
    </div>
    <!-- wrapper end -->
    <!-- cookie-info-bar end -->
    <!--register form -->
    <div class="main-register-container">
        <div class="reg-overlay close-reg-form"></div>
        <div class="main-register-holder">
            <div class="main-register tabs-act fl-wrap">
                <div class="close-modal close-reg-form"><i class="fal fa-times"></i></div>
                <!--tabs -->
                <div id="tabs-container">
                    <div class="tab">
                        <!--tab -->

                        <!--tab end -->
                        <!--tab -->
                        {{-- <div class="tab">
                            <div id="tab-2" class="tab-content">
                                <div class="custom-form">
                                    <form method="post" name="registerform" class="main-register-form" id="main-register-form2">
                                        <label>Full Name <span>*</span> </label>
                                        <input name="name" type="text" onClick="this.select()" value="">
                                        <label>Email Address <span>*</span></label>
                                        <input name="email" type="text" onClick="this.select()" value="">
                                        <label>Password <span>*</span></label>
                                        <input name="password" type="password" onClick="this.select()" value="">
                                        <button type="submit" class="log-submit-btn color-bg"><span>Register</span></button>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
                        <!--tab end -->
                    </div>
                    <!--tabs end -->
                </div>
            </div>
        </div>
    </div>
    <!--register form end -->
    </div>
    <!-- Main end -->
    <!--=============== scripts ===============-->
    <script src="{{ asset('user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('user/js/plugins.js') }}"></script>
    <script src="{{ asset('user/js/scripts.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', {
                loop: true,
                navigation: {
                    nextEl: '.ss-slider-cont-next',
                    prevEl: '.ss-slider-cont-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                slidesPerView: 1,
                spaceBetween: 10,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Dapatkan URL saat ini
            var currentUrl = window.location.pathname;
            // Tambahkan kelas nav-active ke item menu yang sesuai
            $('nav ul li a').each(function() {
                var linkUrl = $(this).attr('href');
                if (linkUrl === currentUrl) {
                    $(this).addClass('nav-active');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Tampilkan tombol ketika pengguna menggulir ke bawah 100px dari atas halaman
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.to-top').fadeIn();
                } else {
                    $('.to-top').fadeOut();
                }
            });
            // Gulir halaman ke atas ketika tombol diklik
            $('.to-top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
    </script>
</body>

</html>

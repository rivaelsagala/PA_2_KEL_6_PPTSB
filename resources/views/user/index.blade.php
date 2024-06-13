@extends('layout.user.dash')
@section('content')
    <div id="wrapper">
        <!-- content    -->
        <div class="content">
            <!-- hero grid    -->
            <div class="hero-hrid fl-wrap gray-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-slider-wrap fl-wrap">
                                <div class="single-slider fl-wrap">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <!-- swiper-slide -->
                                            @foreach ($kegiatan->sortByDesc('tanggal') as $d)
                                                <div class="swiper-slide">
                                                    <div class="grid-post-item bold_gpi fl-wrap">
                                                        <div class="grid-post-media gpm_sing">
                                                            <a href="detpengumuman/{{ $d->id_kegiatan }}">
                                                                <div class="bg"
                                                                    style="background-image: url('{{ asset('assets/gambar/' . $d->gambar) }}');">
                                                            </a>
                                                        </div>
                                                        <div class="grid-post-media_title">
                                                            <h4><a
                                                                    href="detpengumuman/{{ $d->id_kegiatan }}">{{ $d->nama_aksi_sosial }}</a>
                                                            </h4>
                                                            <h4 style="font-weight: 10;font-size: 15px"><a
                                                                    href="detpengumuman/{{ $d->id_kegiatan }}">{{ $d->keterangan }}</a>
                                                            </h4>
                                                            <span class="video-date"><i
                                                                    class="far fa-clock"></i>{{ $d->tanggal }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        @endforeach
                                        <!-- swiper-slide end -->
                                    </div>
                                </div>
                            </div>
                            <div class="ss-slider-cont ss-slider-cont-prev"><i class="fas fa-caret-left"></i></div>
                            <div class="ss-slider-cont ss-slider-cont-next"><i class="fas fa-caret-right"></i></div>
                        </div>
                    </div>


                    @foreach ($pengumuman->sortByDesc('tanggal')->take(4) as $b)
                        <div class="col-md-3">
                            <div class="grid-post-item bold_gpi fl-wrap">
                                <div class="grid-post-media gpm_sing bold_gpi_half">
                                    <div class="bg"
                                        style="background-image: url('{{ asset('assets/gambar/' . $b->gambar) }}');"></div>
                                    <div class="grid-post-media_title">
                                        <h4><a href="detpengumuman/{{ $b->id_kegiatan }}">{{ $b->nama_aksi_sosial }}</a>
                                        </h4>
                                        <span class="video-date"><i class="far fa-clock"></i>{{ $b->tanggal }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- hero grid end   -->
        <!-- section   -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-container fl-wrap fix-container-init">
                            <div class="section-title sect_dec">
                                <h2>Kegiatan</h2>
                            </div>
                            <div class="grid-post-wrap">
                                <div class="more-post-wrap fl-wrap">
                                    <div class="list-post-wrap list-post-wrap_column fl-wrap">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!--list-post-->
                                                <!--list-post end-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--grid-post-item-->
                                <div class="single-grid-slider-wrap fl-wrap">
                                    <div class="single-grid-slider">
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">
                                                <!-- swiper-slide-->
                                                <!-- swiper-slide end-->
                                                <!-- swiper-slide-->
                                                <!-- swiper-slide end-->
                                                <!-- swiper-slide-->
                                                <div class="swiper-slide"></div>
                                                <!-- swiper-slide end-->
                                            </div>
                                            <div class="sgs-pagination sgs_ver"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--grid-post-item end-->
                                <div class="more-post-wrap fl-wrap">
                                    <div class="list-post-wrap list-post-wrap_column fl-wrap">
                                        <div class="row">
                                            @foreach ($kegiatan->sortByDesc('tanggal')->take(2) as $d)
                                                <div class="col-md-6">
                                                    <!--list-post-->
                                                    <div class="list-post fl-wrap">
                                                        <div class="list-post-media">
                                                            <a href="detpengumuman/{{ $d->id_kegiatan }}">
                                                                <div class="bg-wrap">
                                                                    <div class="bg"
                                                                        style="background-image: url('{{ asset('assets/gambar/' . $d->gambar) }}');">
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="list-post-content">
                                                            <h3><a
                                                                    href="detpengumuman/{{ $d->id_kegiatan }}">{{ $d->nama_aksi_sosial }}</a>
                                                            </h3>
                                                            <span class="post-date"><i
                                                                    class="far fa-clock"></i>{{ $d->tanggal }}</span>
                                                        </div>
                                                    </div>
                                                    <!--list-post end-->
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- sidebar   -->
                        <div class="sidebar-content fl-wrap fix-bar">
                            <!-- box-widget -->
                            <div class="box-widget fl-wrap">
                                <div class="box-widget-content">
                                    <!-- content-tabs-wrap -->
                                    <div class="content-tabs-wrap tabs-act tabs-widget fl-wrap">
                                        <div class="content-tabs fl-wrap">
                                            <ul class="tabs-menu  ">
                                                <li class="current"><a href="#tab-popular"> Pengumuman</a></li>

                                            </ul>
                                        </div>
                                        <!--tabs -->
                                        <div class="tabs-container">
                                            <!--tab -->
                                            <div class="tab">
                                                <div id="tab-popular" class="tab-content first-tab">
                                                    <div class="post-widget-container fl-wrap">
                                                        <!-- post-widget-item -->
                                                        @foreach ($pengumuman->sortByDesc('tanggal')->take(2) as $b)
                                                            <div class="post-widget-item fl-wrap">
                                                                <div class="post-widget-item-media">
                                                                    <a href="detpengumuman/{{ $d->id_kegiatan }}"><img
                                                                            src="{{ asset('assets/gambar/' . $b->gambar) }}"
                                                                            alt=""></a>
                                                                </div>
                                                                <div class="post-widget-item-content">
                                                                    <h4><a
                                                                            href="detpengumuman/{{ $d->id_kegiatan }}">{{ $b->nama_aksi_sosial }}</a>
                                                                    </h4>
                                                                    <ul class="pwic_opt">
                                                                        <li><span><i
                                                                                    class="far fa-clock"></i>{{ $b->tanggal }}</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            <!--tab  end-->
                                            <!--tab -->
                                            <!--tab end-->
                                        </div>
                                        <!--tabs end-->
                                    </div>
                                    <!-- content-tabs-wrap end -->
                                </div>
                            </div>
                            <!-- box-widget  end -->
                            <!-- box-widget -->

                            <!-- box-widget  end -->
                            <!-- box-widget -->
                            <div class="box-widget-content">
                                <div class="social-widget">
                                    <a href="{{ route('facebook') }}" target="_blank" class="facebook-soc">
                                        <i class="fab fa-facebook-f"></i>
                                        <span class="soc-widget-title">Facebook</span>
                                    </a>
                                    <a href="{{ route('twitter') }}" target="_blank" class="twitter-soc">
                                        <i class="fab fa-twitter"></i>
                                        <span class="soc-widget-title">Twitter</span>
                                    </a>
                                    <a href="{{ route('youtube') }}" target="_blank" class="youtube-soc">
                                        <i class="fab fa-youtube"></i>
                                        <span class="soc-widget-title">Youtube</span>
                                    </a>
                                    <a href="{{ route('instagram') }}" target="_blank" class="instagram-soc">
                                        <i class="fab fa-instagram"></i>
                                        <span class="soc-widget-title">Instagram</span>
                                    </a>
                                </div>
                                
                            </div>
                            <!-- box-widget  end -->
                            <!-- box-widget -->

                            <!-- box-widget  end -->
                            <!-- box-widget -->

                            <!-- box-widget  end -->
                        </div>
                        <!-- sidebar  end -->
                    </div>
                </div>
                <div class="limit-box fl-wrap"></div>
            </div>
        </section>

        <!-- section end -->

        <!-- section end -->
        <!-- section end -->
        <!-- section  -->
        <section>
            <div class="container">
                <div class="section-title sect_dec">
                    <h2>Sejarah</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="list-post-wrap list-post-wrap_column list-post-wrap_column_fw">
                            <!--list-post-->
                            <div class="list-post fl-wrap">
                                <div class="list-post-media">
                                    <a href="">
                                        <div class="bg-wrap">
                                            <div class="bg"
                                                style="background-image: url('assets/gambar/logopptsb1.jpg'); height: 100%; background-size: cover;">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!--list-post end-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="list-post-wrap list-post-wrap_column list-post-wrap_column_fw">
                            <!--list-post-->
                            <div class="list-post fl-wrap">
                                <div class="list-post-content">
                                    <h3><a href="{{ route('sejarah') }}">PPTSB (Persatuan Pengurus Tapanuli Selatan
                                            Batak)</a></h3>
                                    <p>mengalami perubahan signifikan dalam sejarahnya berkat dukungan Herman Sinaga dan
                                        Monis Levi Sinaga. Asosiasi ini berkomitmen untuk mempererat ikatan sosial budaya
                                        antar marga Batak di Sumatera Utara, yang terlihat dari pertumbuhannya yang pesat.
                                        PPTSB telah memperluas jangkauannya hingga memiliki 54 cabang di seluruh Indonesia
                                        dengan keanggotaan mencapai 50.000 hingga 100.000 individu</p>
                                </div>
                            </div>
                            <!--list-post end-->
                        </div>
                        <a href="{{ route('sejarah') }}" class="dark-btn fl-wrap">Baca Lengkap</a>
                    </div>
                </div>
            </div>
            <div class="limit-box"></div>
        </section>
        <!-- section end -->
        <!-- section -->

        <!-- section end -->
        <!-- section  -->

        <!-- section end -->
    </div>
    <!-- content  end-->
@endsection

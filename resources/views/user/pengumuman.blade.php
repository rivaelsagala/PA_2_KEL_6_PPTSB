@extends('layout.user.dash')
@section('content')
    <!-- header end  -->
    <!-- wrapper -->
    <div id="wrapper">
        <!-- content    -->
        <div class="content">

            <!--section   -->
            <section class="mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="main-container fl-wrap fix-container-init">
                                <div class="section-title">
                                    <h2>Kegiatan</h2>

                                </div>
                                <div class="list-post-wrap">
                                    <!--list-post-->
                                    @foreach ($kegiatan as $d)
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
                                                <span class="post-date"><i class="far fa-clock"></i>
                                                    {{ $d->tanggal }}</span>
                                                <p>{{ $d->keterangan }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="clearfix"></div>
                                <!--pagination-->

                                <!--pagination end-->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- sidebar   -->
                            <div class="sidebar-content fl-wrap fixed-bar">
                                <!-- box-widget -->
                                <div class="box-widget fl-wrap">
                                    <div class="box-widget-content">

                                    </div>
                                </div>
                                <!-- box-widget  end -->
                                <!-- box-widget -->

                                <!-- box-widget  end -->
                                <!-- box-widget -->

                                <!-- box-widget  end -->
                                <!-- box-widget -->
                                <div class="box-widget fl-wrap">
                                    <div class="widget-title">Sosial Media Kami</div>
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
                                </div>
                                <!-- box-widget  end -->
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
                                                            @foreach ($pengumuman as $b)
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
                                                            <!-- post-widget-item end -->
                                                            <!-- post-widget-item -->

                                                            <!-- post-widget-item end -->
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
                            </div>
                            <!-- sidebar  end -->
                        </div>
                    </div>
                    <div class="limit-box fl-wrap"></div>
                </div>
            </section>
            <!-- section end -->
            <!-- section  -->

            <!-- section end -->
        </div>
        <!-- content  end-->
    @endsection

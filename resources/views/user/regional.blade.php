@extends('layout.user.dash')
@section('content')
    <div id="wrapper">
        <!-- content    -->
        <div class="content">

            <!--section   -->
            <section class="mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="main-container fl-wrap fix-container-init">
                                @foreach ($regional as $d)
                                    <div class="section-title">
                                        <h2>Regional {{ $d->nama_regional }}</h2>

                                    </div>
                                    <div class="list-post-wrap">
                                        <table>
                                            <tr>
                                                <td class="label-tabel">Ketua</td>
                                                <td>:</td>
                                                <td class="isitabel">{{ $d->nama_kepala_regional }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-tabel">Alamat</td>
                                                <td>:</td>
                                                <td class="isitabel">{{ $d->alamat }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
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
                                                <ul class="tabs-menu fl-wrap no-list-style">
                                                    <li class="current"><a href="#tab-popular"> Pengumuman </a></li>
                                                </ul>
                                            </div>
                                            <!--tabs -->
                                            <div class="tabs-container">
                                                <!--tab -->
                                                <div class="tab">
                                                    <div id="tab-popular" class="tab-content first-tab">
                                                        <div class="post-widget-container fl-wrap">
                                                            <!-- post-widget-item -->
                                                            < @foreach ($pengumuman->sortByDesc('tanggal')->take(4) as $b)
                                                                <div class="post-widget-item fl-wrap">
                                                                    <div class="post-widget-item-media">
                                                                        <a
                                                                            href="{{ url('detpengumuman/' . $b->id_kegiatan) }}"><img
                                                                                src="{{ asset('assets/gambar/' . $b->gambar) }}"
                                                                                alt=""></a>
                                                                    </div>
                                                                    <div class="post-widget-item-content">
                                                                        <h4><a
                                                                                href="{{ url('detpengumuman/' . $b->id_kegiatan) }}">{{ $b->keterangan }}</a>
                                                                        </h4>
                                                                        <ul class="pwic_opt">
                                                                            <li><span><i class="far fa-clock"></i>
                                                                                    {{ $b->tanggal }}</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                @endforeach
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
    @endsection

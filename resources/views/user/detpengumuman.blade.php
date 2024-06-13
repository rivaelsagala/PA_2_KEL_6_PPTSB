@extends('layout.user.dash')
@section('content')

<style>
    .post-title {
    font-size: 2.5em;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 20px;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.single-post-content_text img {
    display: block;
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.post-paragraph {
    font-size: 1.2em;
    line-height: 1.6em;
    color: #34495e;
    margin-bottom: 15px;
    text-align: justify;
}

.post-info {
    font-size: 1.1em;
    color: #7f8c8d;
    margin-bottom: 10px;
}

.post-info strong {
    color: #e74c3c;
}


</style>

<div class="content">
    <!--section   -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="main-container fl-wrap fix-container-init">
                        <!-- single-post-header -->
                        <div class="single-post-header fl-wrap">
                            <div class="clearfix"></div>
                            <h1 class="post-title">{{ $pengumuman->nama_kegiatan }}</h1>
                        </div>
                        <div class="single-post-content spc_column fl-wrap">
                            <div class="clearfix"></div>
                            <div class="single-post-content_text">
                                <img style="width: 400px;height: 400px" src="{{ asset('assets/gambar/' . $pengumuman->gambar) }}" alt="" class="gambars">
                                <h1 class="post-paragraph">{{ $pengumuman->nama_aksi_sosial }}</h1>
                                <p class="post-info"><strong>Tempat:</strong> {{ $pengumuman->tempat }}</p>
                                <p class="post-info"><strong>Tanggal:</strong> {{ $pengumuman->tanggal }}</p>
                                <p class="post-info"><strong>Waktu:</strong> {{ $pengumuman->waktu }}</p>
                                <p class="post-info"><strong>Jumlah Bantuan:</strong> {{ $pengumuman->jumlah_bantuan }}</p>
                                <p class="post-info"><strong>Keterangan:</strong> {{ $pengumuman->keterangan }}</p>
                                <p class="post-info"><strong>Nama Aksi Sosial:</strong> {{ $pengumuman->nama_aksi_sosial }}</p>
                                <p class="post-info"><strong>Nama Anggota:</strong> {{ $pengumuman->nama_depan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <!-- sidebar   -->
                    <div class="sidebar-content fl-wrap fixed-bar">
                        <div class="box-widget fl-wrap">
                            <div class="widget-title">Sosial Media Kami</div>
                            <div class="box-widget-content">
                                <div class="social-widget">
                                    <a href="#" target="_blank" class="facebook-soc">
                                        <i class="fab fa-facebook-f"></i>
                                        <span class="soc-widget-title">Facebook</span>
                                    </a>
                                    <a href="#" target="_blank" class="twitter-soc">
                                        <i class="fab fa-twitter"></i>
                                        <span class="soc-widget-title">Twitter</span>
                                    </a>
                                    <a href="#" target="_blank" class="youtube-soc">
                                        <i class="fab fa-youtube"></i>
                                        <span class="soc-widget-title">Youtube</span>
                                    </a>
                                    <a href="#" target="_blank" class="instagram-soc">
                                        <i class="fab fa-instagram"></i>
                                        <span class="soc-widget-title">Instagram</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- sidebar  end -->
                </div>
            </div>
            <div class="limit-box fl-wrap"></div>
        </div>
    </section>
</div>
@endsection

<style>
    .gambars {
        width: 80%;
        height: auto;
    }

    .main-container {
        padding-top: 5rem;
    }

    .single-post-content_text img {
        margin-top: 20px;
    }
</style>
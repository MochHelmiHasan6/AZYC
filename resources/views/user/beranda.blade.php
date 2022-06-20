<!doctype html>
@extends('user.layout.app')
</head>
<body>
@section('header')
<main>
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="3"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="4"></li>
    </ol>
    <div class="carousel-inner">
    <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="{{url('assets/frontend/img/office.jpeg')}}" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success">Lokasi <b>Kantor</b></h1>
                            <h3 class="h2">AZYC NOMERATOR</h3>
                            <p>
                                <strong>Alamat:</strong> Jl. Raya Ki Ageng Gribig No.234, Madyopuro,
                                Kec. Kedungkandang, Kota Malang, Jawa Timur 65138
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="{{url('assets/frontend/img/IMG_1.jpg')}}" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>Klien</b> Kami</h1>
                            <h3 class="h2">HARRIS HOTEL & CONVENTIONS</h3>
                            <!-- <p>
                                <strong>Kearsipan numerator</strong> adalah alat untuk membubuhkan nomor pada lembaran dokumen (cap nomor).
                                Dalam peralatan kearsipan, numerator dibutuhkan untuk membubuhkan nomor pada lembaran dokumen, tanpa harus mencetaknya dengan mesin printer.
                                Pada bentuknya, terdapat nomorator bisa memiliki angka kecil atau besar, dan dengan jumlah digit tertentu.
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="{{url('assets/frontend/img/IMG_4.jpg')}}" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1 text-success"><b>Klien</b> Kami</b></h1>
                            <h3 class="h2">LAPANGAN RAMPAL</h3>
                            <!-- <p>
                                <strong>Porporasi</strong> adalah deretan lubang yang digunakan untuk menyobek kertas agar potongan kertas sesuai pola porporasi.
                                Biasanya porporasi sering ditemukan pada tiket, kuitansi, nota, karcis, dan lain-lain.
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="{{url('assets/frontend/img/IMG_7.jpg')}}" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1 text-success"><b>Klien</b> Kami</h1>
                            <h3 class="h2">PANTAI WISATA BALEKAMBANG</h3>
                            <!-- <p>
                                <strong>Penjilidan</strong> adalah proses menyatukan rangkaian kertas-kertas secara berurutan ke dalam bentuk buku,
                                adakalanya disatukan terlebih dahulu per bagiannya/bloknya untuk kemudian disatukan, ataupun langsung dari satu per satu kertasnya.
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/frontend/img/IMG_8.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1 text-success"><b>Klien</b> Kami</h1>
                            <h3 class="h2">SEKOLAH KRISTEN PAMERDI</h3>
                            <!-- <p>
                                <strong>Percetakan</strong> adalah sebuah proses industri untuk memproduksi secara massal tulisan dan gambar, terutama dengan tinta di atas kertas menggunakan sebuah mesin cetak.
                                Percetakan merupakan sebuah bagian penting dalam penerbitan dan percetakan transaksi.
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-4" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-4" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Jasa AZYC Nomerator</h1>
            {{-- <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.
            </p> --}}
        </div>
    </div>
    <div class="row">
        @foreach ($jasa as $data)
        <div class="col-12 col-md-3 p-5 mt-3">
            <a href="{{ route('transaksi',$data->slug) }}"><img src="{{$data->image}}" class="rounded" width="250" height="125"></a>
            <h5 class="text-center mt-3 mb-3">{{$data->name}}</h5>
            <p class="text-center"><a class="btn btn-success" href="{{ route('transaksi',$data->slug) }}">RP. {{$data->price}}</a></p>
        </div>
        @endforeach
    </div>
    {{$jasa->links()}}
</section>
@endsection

@section('footer')
@endsection
</body>
</html>

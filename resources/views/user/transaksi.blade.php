<!doctype html>
@extends('user.layout.app')
    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/slick.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/slick-theme.css')}}">

</head>

<body>
@section('header')
<main>
    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{url($jasa->image)}}" alt="Card image cap" id="product-detail">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{$jasa->name}}</h1>

                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Harga Satuan:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>Rp. {{$jasa->price}}</strong></p>
                                </li>
                            </ul>

                            <h6>Deskripsi:</h6>
                            <p>{!! html_entity_decode($jasa->description) !!}</p>
                            {{-- <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Avaliable Color :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>White / Black</strong></p>
                                </li>
                            </ul>

                            <h6>Specification:</h6>
                            <ul class="list-unstyled pb-3">
                                <li>Lorem ipsum dolor sit</li>
                                <li>Amet, consectetur</li>
                                <li>Adipiscing elit,set</li>
                                <li>Duis aute irure</li>
                                <li>Ut enim ad minim</li>
                                <li>Dolore magna aliqua</li>
                                <li>Excepteur sint</li>
                            </ul> --}}

                            <form action="{{ route('cartdetail.store') }}" method="POST">
                                @csrf
                                {{-- <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Satuan
                                                <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                        </ul>
                                    </div>
                                </div> --}}
                                <div class="row pb-6">
                                    {{-- <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                    </div> --}}
                                    <div class="col d-grid">
                                        <input type="hidden" name="produk_id" value={{$jasa->id}}>
                                        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-cart-arrow-down"></i> Tambah ke Keranjang</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->
@endsection
    @section('footer')
    <!-- Start Slider Script -->
    <script src="assets/js/slick.min.js"></script>
    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        });
    </script>
    <!-- End Slider Script -->
    @endsection
</body>

</html>

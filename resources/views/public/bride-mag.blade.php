@extends('public.layout')
@section('content')
    @push('styles')
        <style>
        .slider-caption{
            left: unset !important;
            right: 5% !important;
            bottom: 50% !important;
            text-align: right !important;
        }
        </style>
    @endpush
    <div class="container">
        {{-- <img class="img-fluid" src="{{asset('media/content/customer/BrideMag/BrideMAG-1.jpg')}}">--}}
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>

            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('media/content/customer/BrideMag/BrideMAG-1.jpg')}}" alt="First slide">
                    <div class="carousel-caption slider-caption d-none d-md-block col-4">
                        <p class="text-dark">Febrero 10, 2020</p>
                        <h1 class="text-pink-400">THE PERFECT DRESS</h1>
                        <a class="btn bg-pink-400">LEER ARTÍCULO</a>
                    </div>
                </div>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <nav class="navbar navbar-light bg-gray-200 rounded-lg my-2 shadow-lg mx-5">
            <a class="navbar-brand" href="#">Categorias</a>
        </nav>

        <div class="bg-pink-400">
            <h1 class="text-center py-2 text-white">ARTICULOS RECIENTES</h1>
        </div>

        <div class="row">
            <div class="col-4">
        <div class="card text-center" style="width: 22rem;">
            <img class="card-img-top" src="{{asset('media/content/customer/BrideMag/BrideMAG-1.jpg')}}">
            <div class="card-body">
                <p>Novia</p>
                <h5 class="card-title">La ceremonia ideal</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn px-3 py-0 bg-pink-400">Ver</a>
            </div>
        </div>
            </div>
            <div class="col-4">
            <div class="card text-center" style="width: 22rem;">
                <img class="card-img-top" src="{{asset('media/content/customer/BrideMag/BrideMAG-1.jpg')}}">
                <div class="card-body">
                    <p>Novia</p>
                    <h5 class="card-title">La ceremonia ideal</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn px-3 py-0 bg-pink-400">Ver</a>
                </div>
            </div>
            </div>
            <div class="col-4">
            <div class="card text-center" style="width: 22rem;">
                <img class="card-img-top" src="{{asset('media/content/customer/BrideMag/BrideMAG-1.jpg')}}">
                <div class="card-body">
                    <p>Novia</p>
                    <h5 class="card-title">La ceremonia ideal</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn px-3 py-0 bg-pink-400">Ver</a>
                </div>
            </div>
            </div>
        </div>

        <div class="row ">
            <div class="col text-center py-3">
                <button class="btn bg-pink-400">Ver Màs</button>
            </div>
        </div>

        {{-- Bride Advisor Podecast --}}
        <div class="bg-gray-200" style="border-top: solid 10px #ee6ea9;border-bottom: solid 10px #ee6ea9;">
            <div class="text-center py-2">
                <h2>Bride Advisor Podcast</h2>
                <p class="col-6 offset-3">Escucha nuetro podcast con expertos de la industria que te ayudarán a disfrutar el proceso de du boda.</p>
            </div>
            <div class="text-right text-pink-400 mr-4">
                <p><span class="h3">Suscríbete en </span> <i class="fab fa-spotify"></i> <i class="fab fa-youtube"></i></p>
            </div>
        </div>

        {{-- Newsletter--}}
        <div class="py-4">
            <div class="text-center">
                <h2>Noticias y Actualizacines</h2>
                <p class="col-6 offset-3">Registrate para ser el primero en recibir consejos y actualizaciones.</p>
            </div>
            <div>
                <form>
                    <div class="col-6 offset-3">
                    <input class="form-control" type="text" placeholder="Introduce tu correo electronico">
                    </div>
                    <div class="text-center py-3">
                    <button class="btn bg-pink-400" type="submit">REGÍSTRARME</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

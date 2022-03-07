@extends('layouts.main-layout')
@section('content')


<div class="container-fluid">
    <h1>Lista appartamenti</h1>
    <div class="items d-flex mb-2">
        <div class="item apartment">
            <div class="d-flex m-5">
                <div class="photo">
                    <img class="rounded" src="{{ asset('/storage/assets/appartamento.jpg') }}" alt="">
                </div>
                <div class="detail ml-2">
                    <h3>Titolo appartament</h3>
                    <i class="fa-solid fa-star"></i>5.0  - VIA ROMA 4, ROMA
                    <div class="mt-2">
                        <p >Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <span class="mx-2">
                        <i class="fa-solid fa-house"></i>:2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-bed"></i>: 2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-bath"></i>:2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-square"></i>: 80 m<sup>2</sup>
                    </span>
                </div>
            </div><hr>
            <div class="d-flex m-5">
                <div class="photo">
                    <img class="rounded" src="{{ asset('/storage/assets/appartamento.jpg') }}" alt="">
                </div>
                <div class="detail ml-2">
                    <h3>Titolo appartament</h3>
                    <i class="fa-solid fa-star"></i>5.0  - VIA ROMA 4, ROMA
                    <div class="mt-2">
                        <p >Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <span class="mx-2">
                        <i class="fa-solid fa-house"></i>:2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-bed"></i>: 2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-bath"></i>:2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-square"></i>: 80 m<sup>2</sup>
                    </span>
                </div>
            </div><hr>
            <div class="d-flex m-5">
                <div class="photo">
                    <img class="rounded" src="{{ asset('/storage/assets/appartamento.jpg') }}" alt="">
                </div>
                <div class="detail ml-2">
                    <h3>Titolo appartament</h3>
                    <i class="fa-solid fa-star"></i>5.0  - VIA ROMA 4, ROMA
                    <div class="mt-2">
                        <p >Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <span class="mx-2">
                        <i class="fa-solid fa-house"></i>:2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-bed"></i>: 2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-bath"></i>:2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-square"></i>: 80 m<sup>2</sup>
                    </span>
                </div>
            </div><hr>
            <div class="d-flex m-5">
                <div class="photo">
                    <img class="rounded" src="{{ asset('/storage/assets/appartamento.jpg') }}" alt="">
                </div>
                <div class="detail ml-2">
                    <h3>Titolo appartament</h3>
                    <i class="fa-solid fa-star"></i>5.0  - VIA ROMA 4, ROMA
                    <div class="mt-2">
                        <p >Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <span class="mx-2">
                        <i class="fa-solid fa-house"></i>:2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-bed"></i>: 2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-bath"></i>:2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-square"></i>: 80 m<sup>2</sup>
                    </span>
                </div>
            </div><hr>
            <div class="d-flex m-5">
                <div class="photo">
                    <img class="rounded" src="{{ asset('/storage/assets/appartamento.jpg') }}" alt="">
                </div>
                <div class="detail ml-2">
                    <h3>Titolo appartament</h3>
                    <i class="fa-solid fa-star"></i>5.0  - VIA ROMA 4, ROMA
                    <div class="mt-2">
                        <p >Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <span class="mx-2">
                        <i class="fa-solid fa-house"></i>:2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-bed"></i>: 2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-bath"></i>:2
                    </span>
                    <span class="mx-2">
                        <i class="fa-solid fa-square"></i>: 80 m<sup>2</sup>
                    </span>
                </div>
            </div>
        </div>
        <div class="item map">
            <search-in-map></search-in-map>
        </div>
    </div>
</div>
    
@endsection
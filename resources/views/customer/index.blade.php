@extends('layouts.customer.app')

@section('title', 'Warung Kuy')

@section('content')

    <form class="d-flex mb-4" action="{{ route('search') }}" role="search">
        <input class="form-control me-2" name="name" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    <div class="container mt-4">
        <div class="mb-4">
            <h5>Menu Categories</h5>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100" data-aos="zoom-in-right">
                            <div class="card-body text-center">
                                <img src="{{ asset('images') }}/{{ $category->image }}" class="img-fluid mb-2"
                                    alt="image">
                                <a href="{{ route('show_by_category', ['id' => $category->id]) }}"
                                    class="list-group-item list-group-item-action">{{ $category->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div>
            <h5>Menu Warmindo</h5>
            @if (sizeof($menus) == 0)
                <p class="text-center">menu tidak tersedia</p>
            @endif
            <div class="row">
                @foreach ($menus as $item)
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card h-100" data-aos="fade-up">
                            <img height="200px" src="{{ asset('images') }}/{{ $item->image }}" class="card-img-top"
                                alt="Menu Item">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">{{ $item->description }}.</p>
                                <p class="card-text">Rp.{{ number_format($item->price) }}.</p>
                                <form action="{{ route('addToCart') }}" class="d-inline" method="post">
                                    @csrf
                                    <input type="text" name="menu_id" value="{{ $item->id }}" hidden>
                                    <button class="btn btn-primary" type="submit">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@extends('layouts.customer.app')

@section('title', 'Warung Kuy')

@section('content')

    <form class="d-flex mb-4" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    <div class="container mt-4">
        <div class="mb-4">
            <h5>Menu dengan kategori {{ $category->name }}</h5>
            <a href="/" class="btn btn-secondary mb-3">Tampilkan Semua</a>
        </div>
        <div>
            <h5>Menu Warmindo</h5>
            <div class="row">
                @empty($menus)
                    <p>Menu tidak ditemukan</p>
                @endempty
                @foreach ($menus as $item)
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card h-100" data-aos="fade-up">
                            <img height="200px" src="{{ asset('images') }}/{{ $item->image }}" class="card-img-top"
                                alt="Menu Item">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">{{ $item->description }}.</p>
                                <p class="card-text">Rp.{{ number_format($item->price) }}.</p>
                                <button class="btn btn-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

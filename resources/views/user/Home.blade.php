@extends('layouts.user')
@section('content')
    <div class="d-flex flex-wrap justify-content-start gap-2 mt-5 ">
        @foreach ($data as $item)
            <div class="card my-2" style="width: 12rem;" id='product-card'>
                <style>
                    .card {
                        transition: transform 0.3s;
                    }

                    .card:hover {
                        transform: scale(1.05);
                    }
                </style>

                <img src="/images/{{ $item->image }}" class="card-img-top w-full" alt="..." style="height:180px">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="card-text font-weight-bold" style="color: orangered">${{ $item->price }}</p>
                    <div>
                        <form action="{{ route('add-cart', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="name" value="{{ $item->name }}" hidden>
                            <input type="text" name="image" value="{{ $item->image }}" hidden>
                            <input type="number" name="price" value="{{ $item->price }}" hidden>
                            <input type="number" name="quantity" class="form-control w-50" min=1 value=1>
                            <input type="submit" class="mt-2 px-3 py-2 rounded" value='Add to Cart'
                                style="color: orangered; border:rgb(200, 153, 153)" />
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <!-- Bootstrap Pagination -->
@endsection

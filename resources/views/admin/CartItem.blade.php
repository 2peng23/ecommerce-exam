@extends('layouts.admin')
@section('content')
    <div>
        <h1>{{ $title }}</h1>

        <div class="d-flex flex-wrap justify-content-start gap-2 mt-5 ">
            @foreach ($data as $item)
                <div class="card my-2" style="width: 12rem;">
                    <img src="/images/{{ $item->image }}" class="card-img-top w-full" alt="..." style=" height:180px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">${{ $item->price }}</p>
                        <p class="card-text">Quantity: {{ $item->quantity }}</p>
                        <p class="card-text">Total Price: <span style='color:orangered'>
                                ${{ $item->price * $item->quantity }}</span></p>
                        <p class="card-text">Account: {{ $item->user_name }}</p>

                    </div>
                </div>
            @endforeach

        </div>
        <!-- Bootstrap Pagination -->
        <div class="d-flex justify-content-center">
            {{ $data->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

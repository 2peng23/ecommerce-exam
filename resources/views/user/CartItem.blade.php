@extends('layouts.user')

@section('content')
    @if (count($cartItems) > 0)
        <div class="d-flex flex-wrap justify-content-start gap-2 mt-5 ">

            @php
                $totalPrice = 0; // Initialize the total price variable
            @endphp
            @foreach ($cartItems as $item)
                <div class="card my-2" style="width: 9rem;">
                    <style>
                        .card {
                            transition: transform 0.3s;
                        }

                        .card:hover {
                            transform: scale(1.05);
                        }
                    </style>

                    <img src="/images/{{ $item->image }}" class="card-img-top w-full" alt="..." style="height:140px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text font-weight-bold" style="color: orangered">${{ $item->price }}</p>
                        <form id="updateForm_{{ $item->id }}" action="{{ url('update-cart', $item->id) }}"
                            method="POST">
                            @csrf
                            <input type="number" id="quantityInput_{{ $item->id }}" name="quantity"
                                class="form-control w-75" min=1 value='{{ $item->quantity }}'
                                onchange="submitForm('{{ $item->id }}')">
                        </form>


                        <a href="{{ url('delete-cart-item', $item->id) }}" class="btn btn-warning mt-1">Remove</a>
                    </div>
                </div>
                @php
                    $totalPrice += $item->price * $item->quantity; // Update the total price
                @endphp
            @endforeach

        </div>
        <div class="my-5 d-flex justify-content-end font-weight-bold text-uppercase">
            <div>

                <p>Total Price:
                    <span id="total-price" style="color: orangered; margin-left:5px;"> ${{ $totalPrice }}
                    </span>
                </p>
                <p class="border rounded p-3 text-white" style="background-color: orange">Checkout <i
                        class="fa fa-shopping-bag"></i></p>
            </div>
        </div>
    @else
        <h5 class="mt-3">There are no item in your Cart.</h5>
    @endif
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function submitForm(itemId) {
        var formData = $('#updateForm_' + itemId).serialize();
        $.ajax({
            type: 'POST',
            url: $('#updateForm_' + itemId).attr('action'),
            data: formData,
            success: function(response) {
                $('#message_' + itemId).text('Form submitted successfully.');

                // Update the total price dynamically
                $.get("{{ url('get-total-price') }}", function(data) {
                    $('#total-price').text('$' + data);
                });
            },
            error: function(error) {
                $('#message_' + itemId).text('An error occurred while submitting the form.');
            }
        });
    }
</script>

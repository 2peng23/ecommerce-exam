@extends('layouts.admin')
@section('content')
    <form id="productForm" action="{{ route('update-product', $product->id) }}" enctype="multipart/form-data" method="post"
        class=" border p-4 shadow">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Product name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Current Image</label>
            <img src="/images/{{ $product->image }}" alt="" style="width:100px" class="border rounded-circle p-2"
                id="currentImage">
            <input type="file" class="form-control" id="image" name="image" onchange="previewImage()"
                value="{{ $product->image }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value='{{ $product->price }}'>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <script>
        function previewImage() {
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();
            const currentImage = document.getElementById('currentImage');

            reader.addEventListener("load", function() {
                currentImage.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between">
        <h1>{{ $title }}</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Product
        </button>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="error-message" style="display: none;" class="text-danger"></p>
                        <form id="productForm" action="{{ route('save-product') }}" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Product name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="submitForm()">Save</button>
                            </div>
                        </form>



                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-start gap-2 mt-5 ">
        @foreach ($data as $item)
            <div class="card my-2" style="width: 12rem;">
                <img src="/images/{{ $item->image }}" class="card-img-top w-full" alt="..." style=" height:180px">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="card-text">${{ $item->price }}</p>
                    <div>
                        <a href="{{ route('edit-product', $item->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('delete-product', $item->id) }}" class="btn btn-danger"
                            onclick="return confirm('Delete this product?')">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <!-- Bootstrap Pagination -->
    <div class="d-flex justify-content-center">
        {{ $data->links('pagination::bootstrap-4') }}
    </div>
@endsection


<script>
    function submitForm() {
        let form = document.getElementById('productForm');
        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.onload = function(e) {
            if (xhr.status === 200) {
                // Optionally, do something on success, such as displaying a success message
                console.log('Form submitted successfully.');

                // Redirect to the all-products page
                window.location.href =
                    '{{ route('all-products') }}'; // Replace "all-products" with the actual route

            } else {
                document.getElementById('error-message').style.display = 'block';
                document.getElementById('error-message').innerText = 'Please provide all information!';
                console.error('Please provide all information!');
            }
        };
        xhr.send(formData);
    }
</script>

<x-app-layout>
    <section class="bg-light py-5">
        <div class="container">

            @if ($product)
            <div class="row">
                <!-- Product Display -->
                <div class="col-md-4 mb-4 d-flex align-items-center">
                    <div class="d-flex flex-column bg-white border rounded shadow-sm p-3 w-100">
                        <img src="{{ asset( $product->photo) }}" alt="{{ $product['name'] }}" class="img-fluid mb-3">
                        <h5 class="mb-2">{{ $product['name'] }}</h5>
                        <p class="text-muted mb-2">{{ $product['type'] }}</p>
                        <p class="fw-bold mb-3">{{ $product['price'] }}</p>
                        <p class="fw-bold mb-3">{{ $product['description'] }}</p>

                    </div>
                </div>

                <!-- Form -->
                <div class="col-md-8">
                    <div class="text-center mb-4">
                        <p>If you wish to edit the product details, please update the fields below. The current details
                            are already filled in for easy editing.</p>
                    </div>

                    <form action="{{ route('update-product', $product->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <input type="hidden" name="match_id" value="{{ $product['id'] }}">

                        <!-- Match Name -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                                name="photo" value="{{ $product->photo }}">
                            @error('photo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Match Date -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $product->name }}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Match Time -->
                        <div class="mb-3">
                            <label for="type" class="form-label">Product Type</label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror" id="type"
                                name="type" value="{{ $product->type }}">
                            @error('type')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Match Price -->
                        <div class="mb-3">
                            <label for="desription" class="form-label">Product Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" value="{{ $product->description }}">
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Product price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" value="{{ $product->price }}">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex ">
                            <button type="submit" class="btn btn-primary">Update Product</button>
                            <a href="{{ route('manage-shop') }}" class="btn text-light ms-2"
                                style="background-color:red">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>
            @else
            <p class="text-center">Product not found.</p>
            @endif
        </div>
    </section>
    <footer class="text-light py-4" style="background-color:#001C43">
        <div class="container text-center mt-3">
            <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
        </div>
    </footer>
</x-app-layout>
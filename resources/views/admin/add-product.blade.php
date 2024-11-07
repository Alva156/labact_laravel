<x-app-layout>
    <section class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-light">
                        <div class="card-header text-white" style="background-color:#001C43;">
                            <h3 class="mb-0">Create Product</h3>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{route('store-product')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Product Image -->
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Product Image</label>
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror "
                                        id="photo" name="photo">
                                    @error('photo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Product Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}"
                                        placeholder=" Enter product name">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Product Type -->
                                <div class="mb-3">
                                    <label for="type" class="form-label">Product Type (Ex. Baseball Bat,
                                        Baseball Gloves, Shin Guards)</label>
                                    <input type="text" class="form-control @error('type') is-invalid @enderror"
                                        id="type" name="type" value="{{ old('type') }}"
                                        placeholder="Enter product type">
                                    @error('type')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Product Description</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description" value="{{ old('description') }}"
                                        placeholder="Enter description">
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Product Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price') }}"
                                        placeholder=" Enter product price">
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="priceHelp" class="form-text">In American Dollars</div>
                                </div>


                                <!-- Submit Button -->

                                <div class="d-flex ">
                                    <button type="submit" class="btn btn-primary"> Add Product</button>
                                    <a href="{{ route('manage-shop') }}" class="btn text-light ms-2"
                                        style="background-color:red">Cancel</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="text-light py-4" style="background-color:#001C43">
        <div class="container text-center mt-3">
            <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
        </div>
    </footer>
</x-app-layout>
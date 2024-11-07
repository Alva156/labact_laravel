<x-app-layout>
    <section class="bg-light py-5">
        <div class="container">

            @if ($product)
            <div class="row">
                <!-- Product Display -->
                <div class="col-md-4 mb-4 d-flex align-items-center">
                    <div class="d-flex flex-column bg-white border rounded shadow-sm p-3 w-100">
                        <img src="{{ asset($product->photo) }}" alt="{{ $product['name'] }}">
                        <h5 class="mb-2">{{ $product['name'] }}</h5>
                        <p class="text-muted mb-2">{{ $product['type'] }}</p>
                        <p class="fw-bold mb-3">${{ $product['price'] }}</p>
                        <p class="fw-bold mb-3">{{ $product['description'] }}</p>

                    </div>
                </div>

                <!-- Form -->
                <div class="col-md-8">
                    <div class="text-center mb-4">
                        <p>If you wish to reserve this product, please fill out the form below with your details. This
                            helps us ensure your reservation is processed smoothly. <strong>PLEASE NOTE: THIS IS A
                                RESERVATION SYSTEM ONLY. TO COMPLETE YOUR PURCHASE, YOU MUST VISIT THE PHYSICAL STORE,
                                SPEAK TO THE CASHIER PERSONNEL, PROVIDE YOUR NAME, AND CONFIRM THE PRODUCT YOU
                                RESERVED.</strong></p>
                    </div>

                    <form action="{{route('store-buy')}}" method="POST">
                        @csrf

                        <input type="hidden" id="productid" name="productid" value="{{$product->id}}">

                        <div class="mb-3">
                            <label for="name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                value="{{ old('fullname') }}">
                            @error('fullname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address') }}">
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror



                                <div class="mb-3">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control @error('number') is-invalid @enderror"
                                        id="number" name="number" value="{{ old('number') }}">
                                    @error('number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control @error('quntity') is-invalid @enderror"
                                        id="quantity" name="quantity" value="{{ old('quantity') }}">
                                    @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex ">
                                    <button type="submit" class="btn btn-primary"> Make Reservation</button>
                                    <a href="{{ route('user-shop') }}" class="btn text-light ms-2"
                                        style="background-color:red">Cancel</a>
                                </div>
                            </div>
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
<x-guest-layout>
    <section class="bg-light py-5">
        <div class="container">
            <h1 class="display-4 mb-4 text-center">Shop</h1>
            <p class="lead mb-3 text-center">Browse our selection of baseball gear and memorabilia.</p>
            <div class="text-center mb-4">
                <a href="{{ route('login') }}" class="btn btn-lg text-light" style="background-color:#001C43">Login to
                    view and buy a product</a>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-4 mb-4 d-flex align-items-stretch">
                    <div class="d-flex flex-column bg-white border rounded shadow-sm p-3 w-100">
                        <img src="{{ asset($product->photo) }}" alt="{{ $product['name'] }}" class="img-fluid mb-3">
                        <h5 class="mb-2">{{ $product['name'] }}</h5>
                        <p class="text-muted mb-2">{{ $product['type'] }}</p>
                        <p class="fw-bold mb-3">${{ $product['price'] }}</p>


                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <footer class="text-light py-4" style="background-color:#001C43">
        <div class="container text-center mt-3">
            <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
        </div>
    </footer>
</x-guest-layout>
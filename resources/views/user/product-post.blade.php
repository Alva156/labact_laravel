<x-app-layout>
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <h3>{{ $product['name'] }}</h3>
                <p><strong>Product Type:</strong> {{ $product['type'] }}</p>
            </div>
            <div class="card-body">
                <img src="{{ asset($product['picture']) }}" alt="{{ $product['name'] }}"
                    class="img-fluid mx-auto d-block" style="max-width: 100%; height: auto;">

            </div>
        </div>
    </div>
    <footer class="text-light py-4" style="background-color:#001C43">
        <div class="container text-center mt-3">
            <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
        </div>
    </footer>
</x-app-layout>
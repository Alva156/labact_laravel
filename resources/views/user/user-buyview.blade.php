<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <!-- Main content wrapper -->
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">
                    @if ($buy)
                    <div class="row justify-content-center">
                        <!-- Buy Display -->
                        <div class="col-md-8 col-lg-6 mb-4">
                            <div
                                class="bg-white border rounded shadow-lg p-4 d-flex flex-column align-items-center text-center">
                                <!-- Header Section -->
                                <div class="text-white p-3 rounded mb-3" style="background-color:#001C43;">
                                    <h4 class="mb-0">Reservation # {{ $buy->id }}</h4>
                                </div>

                                <!-- Product Image -->
                                <img src="{{ asset($buy->product->photo) }}" class="img-fluid mb-3"
                                    style="object-fit: cover;">

                                <!-- Product Details -->
                                <p><strong>Product:</strong> {{ $buy->product->name ?? 'N/A' }}</p>
                                <p><strong>Customer Name:</strong> {{ $buy->fullname }}</p>
                                <p><strong>Address:</strong> {{ $buy->address }}</p>
                                <p><strong>Contact Number:</strong> {{ $buy->number }}</p>
                                <p><strong>Quantity:</strong> {{ $buy->quantity }}</p>
                                <p><strong>Price:</strong> ${{ $buy->quantity * $buy->product->price }}</p>
                            </div>

                            <!-- Centered Back Button -->
                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{ route('user-shopreserve') }}" class="btn text-light"
                                    style="background-color:red;">Back</a>
                            </div>
                        </div>
                    </div>

                    @else
                    <p class="text-center">Purchase not found.</p>
                    @endif
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="text-light py-4" style="background-color:#001C43">
            <div class="container text-center mt-3">
                <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
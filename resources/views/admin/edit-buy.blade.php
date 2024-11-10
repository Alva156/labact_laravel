<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <!-- Main content wrapper -->
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">
                    @if ($buy)
                    <div class="row">
                        <!-- Buy Display -->
                        <div class="col-md-4 mb-4">
                            <div class="bg-white border rounded shadow-sm p-4 d-flex flex-column h-100">
                                <div class="text-white p-3 rounded mb-3" style="background-color:#001C43;">
                                    <h4 class="mb-0">Transaction #: {{ $buy->id }}</h4>
                                </div>
                                <!-- Product Image -->
                                <img src="{{ asset($buy->product->photo) }}" class="img-fluid mb-3"
                                    style="object-fit: cover;">
                                <p><strong>Product:</strong> {{ $buy->product->name ?? 'N/A' }}
                                <p><strong>Customer Name:</strong> {{$buy->fullname}}
                                <p><strong>Address:</strong> {{ $buy->address }}</p>
                                <p><strong>Contact Number:</strong> {{ $buy->number }}</p>
                                <p><strong>Quantity:</strong> {{ $buy->quantity }}</p>
                            </div>
                        </div>

                        <!-- Form -->
                        <div class="col-md-8">
                            <div class="text-center mb-4">
                                <p>If you wish to edit the buying details, please update the fields below. The current
                                    details are already filled in for easy editing.</p>
                            </div>

                            <form action="{{ route('update-buy', $buy->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="buy_id" value="{{ $buy->id }}">

                                <!-- Customer Name -->
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                        id="fullname" name="fullname" value="{{ $buy->fullname }}">
                                    @error('fullname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" value="{{ $buy->address }}">
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Contact Number -->
                                <div class="mb-3">
                                    <label for="number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control @error('number') is-invalid @enderror"
                                        id="number" name="number" value="{{ $buy->number }}">
                                    @error('number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Quantity -->
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                        id="quantity" name="quantity" value="{{ $buy->quantity }}">
                                    @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary">Update Purchase</button>
                                    <a href="{{ route('manage-shop') }}" class="btn text-light ms-2"
                                        style="background-color:red">Cancel</a>
                                </div>
                            </form>
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
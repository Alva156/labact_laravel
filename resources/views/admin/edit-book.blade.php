<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <!-- Main content wrapper -->
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">
                    @if ($book)
                    <div class="row">
                        <!-- Book Display -->
                        <div class="col-md-4 mb-4">
                            <div class="bg-white border rounded shadow-sm p-4 d-flex flex-column h-100">
                                <div class="text-white p-3 rounded mb-3" style="background-color:#001C43;">
                                    <h4 class="mb-0">Booking ID: {{ $book->id }}</h4>
                                </div>

                                <p><strong>Match:</strong> {{ $book->tickets->first_team ?? 'N/A' }} vs
                                    {{ $book->tickets->second_team ?? 'N/A' }}</p>
                                <p><strong>Address:</strong> {{ $book->address }}</p>
                                <p><strong>Contact Number:</strong> {{ $book->number }}</p>
                                <p><strong>Quantity:</strong> {{ $book->quantity }}</p>
                            </div>
                        </div>

                        <!-- Form -->
                        <div class="col-md-8">
                            <div class="text-center mb-4">
                                <p>If you wish to edit the booking details, please update the fields below. The current
                                    details are already filled in for easy editing.</p>
                            </div>

                            <form action="{{ route('update-book', $book->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="book_id" value="{{ $book->id }}">

                                <!-- Ticket ID -->


                                <!-- Customer Name -->
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                        id="fullname" name="fullname" value="{{ $book->fullname }}">
                                    @error('fullname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" value="{{ $book->address }}">
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Contact Number -->
                                <div class="mb-3">
                                    <label for="number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control @error('number') is-invalid @enderror"
                                        id="number" name="number" value="{{ $book->number }}">
                                    @error('number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Quantity -->
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                        id="quantity" name="quantity" value="{{ $book->quantity }}">
                                    @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary">Update Booking</button>
                                    <a href="{{ route('manage-schedule') }}" class="btn text-light ms-2"
                                        style="background-color:red">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                    <p class="text-center">Booking not found.</p>
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
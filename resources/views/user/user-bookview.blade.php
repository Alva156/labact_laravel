<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <!-- Main content wrapper -->
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">
                    @if ($book)
                    <div class="row justify-content-center">
                        <!-- Book Display -->
                        <div class="col-md-8 col-lg-6 mb-4">
                            <div
                                class="bg-white border rounded shadow-lg p-4 d-flex flex-column align-items-center text-center">
                                <!-- Header Section -->
                                <div class="text-white p-3 rounded mb-3" style="background-color:#001C43;">
                                    <h4 class="mb-0">Reservation # {{ $book->id }}</h4>
                                </div>

                                <!-- Booked Ticket Details -->
                                <p><strong>Match:</strong> {{ $book->tickets->first_team ?? 'N/A' }} vs
                                    {{ $book->tickets->second_team ?? 'N/A' }}</p>
                                <p><strong>Date:</strong>
                                    {{ \Carbon\Carbon::parse($book->tickets->date)->format('F j, Y') }}</p>
                                <p><strong>Time:</strong>
                                    {{ \Carbon\Carbon::createFromFormat('H:i', $book->tickets->time)->format('g:i A') }}
                                </p>
                                <p><strong>Customer Name:</strong> {{ $book->fullname }}</p>
                                <p><strong>Contact Number:</strong> {{ $book->number }}</p>
                                <p><strong>Quantity:</strong> {{ $book->quantity }}</p>
                                <p><strong>Total Price:</strong> ${{ $book->quantity * $book->tickets->price }}</p>
                            </div>

                            <!-- Centered Back Button -->
                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{ route('user-schedreserve') }}" class="btn text-light"
                                    style="background-color:red;">Back</a>
                            </div>
                        </div>
                    </div>

                    @else
                    <p class="text-center">Book reservation not found.</p>
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
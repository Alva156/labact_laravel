<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <section class="bg-light py-5 flex-grow-1">
            <div class="container">
                <div class="row justify-content-center">
                    <main class="col-md-10 col-lg-8 px-4">
                        <div class="bg-white rounded shadow-sm p-4 mb-4 text-center">
                            <h2>Your Reservations</h2>
                            <p>Here you can see your reservations made.</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('user-schedule') }}" class="mb-4 btn btn-lg text-light"
                                style="background-color:#001C43">
                                Return to Schedule
                            </a>
                        </div>

                        <!-- Alert Messages -->
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Product added successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif


                        <!-- Transactions Table -->
                        <div id="transactionsTable" class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Match </th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Address</th>

                                        <th scope="col">Contact Number</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price per Item</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Date of Reservation</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                    <tr>
                                        <th scope="row">{{$book->id}}</th>
                                        <td>{{ $book->tickets->first_team ?? 'N/A' }} vs
                                            {{ $book->tickets->second_team ?? 'N/A' }}</td>

                                        <td>{{$book->fullname}}</td>
                                        <td>{{$book->address}}</td>
                                        <td>{{$book->number}}</td>
                                        <td>{{$book->quantity}}</td>
                                        <td>${{ $book->tickets->price }}</td>
                                        <td>${{ $book->quantity * $book->tickets->price }}</td>

                                        <td>{{$book->created_at->diffForHumans()}}</td>
                                        <td><a href="{{ route('user-bookview', $book->id) }}" class="btn btn-secondary">
                                                <i class="fas fa-eye"></i>
                                            </a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $books->appends(['tab' => 'transactions'])->links() }}
                        </div>
                    </main>
                </div>
            </div>
        </section>

        <footer class="text-light py-4" style="background-color:#001C43">
            <div class="container text-center mt-3">
                <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
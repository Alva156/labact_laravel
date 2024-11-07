<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <!-- Main content wrapper -->
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">
                    @if ($ticket)
                    <div class="row">
                        <!-- Product Display -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-light">
                                <div class="card-header text-white" style="background-color:#001C43;">
                                    {{$ticket->first_team}} vs {{$ticket->second_team}}
                                </div>
                                <div class="card-body text-center">
                                    <p class="card-text">Date:
                                        {{ \Carbon\Carbon::parse($ticket->date)->format('F j, Y') }}</p>
                                    <p class="card-text font-weight-bold">Time:
                                        {{ \Carbon\Carbon::createFromFormat('H:i', $ticket->time)->format('g:i A') }}
                                    </p>
                                    <p class="card-text font-weight-bold">Price: ${{$ticket->price}}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form -->
                        <div class="col-md-8">
                            <div class="text-center mb-4">
                                <p>Please fill out the form below with your details to complete your reservation</p>
                            </div>

                            <form action="{{route('store-book')}}" method="POST">
                                @csrf
                                <input type="hidden" id="ticketid" name="ticketid" value="{{$ticket->id}}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                        id="fullname" name="fullname" value="{{ old('fullname') }}">
                                    @error('fullname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('first_team') is-invalid @enderror"
                                        id="address" name="address" value="{{ old('address') }}">
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

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
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                        id="quantity" name="quantity" value="{{ old('quantity') }}">
                                    @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary">Book Ticket</button>
                                    <a href="{{ route('user-schedule') }}" class="btn text-light ms-2"
                                        style="background-color:red">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                    <p class="text-center">Ticket not found.</p>
                    @endif
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="text-light py-4 mt-auto" style="background-color:#001C43;">
            <div class="container text-center mt-3">
                <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">

                    @if ($ticket)
                    <div class="row">
                        <!-- Match Display -->
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-light">
                                <div class="card-header text-white" style="background-color:#001C43;">
                                    {{$ticket->first_team}} vs {{$ticket->second_team}}
                                </div>
                                <div class="card-body text-center">
                                    <p class="card-text">{{ $ticket['date'] }}</p>
                                    <p class="card-text">{{ $ticket['time'] }}</p>
                                    <p class="card-text font-weight-bold">{{ $ticket['price'] }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form for Editing Match -->
                        <div class="col-md-8">
                            <div class="text-center mb-4">
                                <p>If you wish to edit the match details, please update the fields below. The current
                                    details
                                    are already filled in for easy editing.</p>
                            </div>

                            <form action="{{ route('update-schedule', $ticket->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Existing input fields -->
                                <input type="hidden" name="ticket_id" value="{{ $ticket['id'] }}">

                                <div class="mb-3">
                                    <label for="first_team" class="form-label">First Team</label>
                                    <input type="text" class="form-control @error('first_team') is-invalid @enderror"
                                        id="first_team" name="first_team" value="{{ $ticket->first_team }}">
                                    @error('first_team')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="second_team" class="form-label">Second Team</label>
                                    <input type="text" class="form-control @error('second_team') is-invalid @enderror"
                                        id="second_team" name="second_team" value="{{ $ticket->second_team }}">
                                    @error('second_team')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                        id="date" name="date" value="{{ $ticket['date'] }}">
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="time" class="form-label">Time</label>
                                    <input type="time" class="form-control @error('time') is-invalid @enderror"
                                        id="time" name="time" value="{{ $ticket['time'] }}">
                                    @error('time')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ $ticket['price'] }}">
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex ">
                                    <button type="submit" class="btn btn-primary">Update Schedule</button>
                                    <a href="{{ route('manage-schedule') }}" class="btn text-light ms-2"
                                        style="background-color:red">Cancel</a>
                                </div>


                            </form>
                        </div>
                    </div>
                    @else
                    <p class="text-center">Match not found.</p>
                    @endif
                </div>
            </section>
        </main>
        <footer class="text-light py-4" style="background-color:#001C43">
            <div class="container text-center mt-3">
                <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
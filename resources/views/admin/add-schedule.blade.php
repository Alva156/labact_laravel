<x-app-layout>
    <section class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-light">
                        <div class="card-header text-white" style="background-color:#001C43;">
                            <h3 class="mb-0">Create Match</h3>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{route('store-schedule')}}" method="POST">
                                @csrf

                                <!-- Match Name -->
                                <div class="mb-3">
                                    <label for="matchname" class="form-label">First Team</label>
                                    <input type="text" class="form-control @error('first_team') is-invalid @enderror"
                                        id="first_team" name="first_team" value="{{ old('first_team') }}">
                                    @error('first_team')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="matchname" class="form-label">Second Team</label>
                                    <input type="text" class="form-control @error('second_team') is-invalid @enderror"
                                        id="second_team" name="second_team" value="{{ old('second_team') }}">
                                    @error('second_team')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Match Date -->
                                <div class="mb-3">
                                    <label for="matchdate" class="form-label">Date</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                        id="date" name="date" value="{{ old('date') }}">
                                    @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="dateHelp" class="form-text"></div>
                                </div>

                                <!-- Match Time -->
                                <div class="mb-3">
                                    <label for="matchtime" class="form-label">Time</label>
                                    <input type="time" class="form-control @error('time') is-invalid @enderror"
                                        id="time" name="time" value="{{ old('time') }}">
                                    @error('time')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="timeHelp" class="form-text"></div>
                                </div>

                                <!-- Match Price -->
                                <div class="mb-3">
                                    <label for="matchprice" class="form-label">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price') }}">
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="priceHelp" class="form-text">In American Dollars</div>
                                </div>

                                <!-- Submit Button -->

                                <div class="d-flex ">
                                    <button type="submit" class="btn btn-primary"> Add Game</button>
                                    <a href="{{ route('manage-schedule') }}" class="btn text-light ms-2"
                                        style="background-color:red">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="text-light py-4" style="background-color:#001C43">
        <div class="container text-center mt-3">
            <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
        </div>
    </footer>
</x-app-layout>
<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">

                    @if ($history)
                    <div class="row">
                        <!-- History Display -->
                        <div class="col-md-4 mb-4">
                            <div class="bg-white border rounded shadow-sm p-4 d-flex flex-column h-100">
                                <div class="text-white p-3 rounded mb-3" style="background-color:#001C43;">
                                    <h4 class="mb-0">{{ $history['era'] }}</h4>
                                </div>
                                <p class="fw-bold mb-2">{{ $history['year'] }}</p>
                                <p>{{ $history['description'] }}</p>
                            </div>
                        </div>

                        <!-- Form for Editing History -->
                        <div class="col-md-8">
                            <div class="text-center mb-4">
                                <p>If you wish to edit the history details, please update the fields below. The current
                                    details
                                    are already filled in for easy editing.</p>
                            </div>

                            <form action="{{ route('update-history', $history->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="history_id" value="{{ $history['id'] }}">

                                <!-- Era -->
                                <div class="mb-3">
                                    <label for="era" class="form-label">Era</label>
                                    <input type="text" class="form-control @error('era') is-invalid @enderror" id="era"
                                        name="era" value="{{ $history->era }}">
                                    @error('era')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Year -->
                                <div class="mb-3">
                                    <label for="year" class="form-label">Years</label>
                                    <input type="text" class="form-control @error('year') is-invalid @enderror"
                                        id="year" name="year" value="{{ $history->year }}">
                                    @error('year')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description">{{$history->description}}</textarea>
                                    <div id="contentHelp" class="form-text"></div>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex ">
                                    <button type="submit" class="btn btn-primary">Update History</button>
                                    <a href="{{ route('manage-history') }}" class="btn text-light ms-2"
                                        style="background-color:red">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                    <p class="text-center">History not found.</p>
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
<x-app-layout>
    <main class="d-flex flex-column min-vh-100">
        <section class="bg-light py-5 flex-grow-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm border-light">
                            <div class="card-header text-white" style="background-color:#001C43;">
                                <h3 class="mb-0">Create History</h3>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{route('store-history')}}" method="POST">
                                    @csrf
                                    <!-- Era -->
                                    <div class="mb-3">
                                        <label for="historyera" class="form-label">Era</label>
                                        <input type="text" class="form-control @error('era') is-invalid @enderror"
                                            id="era" name="era" value="{{ old('era') }}">
                                        @error('era')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Year/s -->
                                    <div class="mb-3">
                                        <label for="historyyear" class="form-label">Year/s</label>
                                        <input type="text" class="form-control @error('year') is-invalid @enderror"
                                            id="year" name="year" value="{{ old('year') }}">
                                        @error('year')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            id="description" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->

                                    <div class="d-flex ">
                                        <button type="submit" class="btn btn-primary"> Add History</button>
                                        <a href="{{ route('manage-history') }}" class="btn text-light ms-2"
                                            style="background-color:red">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="text-light py-4 mt-auto" style="background-color:#001C43">
        <div class="container text-center mt-3">
            <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
        </div>
    </footer>
</x-app-layout>
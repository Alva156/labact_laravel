<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-sm border-light">
                                <div class="card-header text-white" style="background-color:#001C43;">
                                    <h3 class="mb-0">Create FAQS</h3>
                                </div>
                                <div class="card-body p-4">
                                    <form action="{{route('store-faq')}}" method="POST">
                                        @csrf
                                        <!-- Question -->
                                        <div class="mb-3">
                                            <label for="question" class="form-label">Question</label>
                                            <input type="text"
                                                class="form-control @error('question') is-invalid @enderror"
                                                id="question" name="question" value="{{ old('question') }}">
                                            @error('question')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Answer -->
                                        <div class="mb-3">
                                            <label for="answer" class="form-label">Answer</label>
                                            <textarea class="form-control @error('answer') is-invalid @enderror"
                                                id="answer" name="answer">{{ old('answer') }}</textarea>
                                            @error('answer')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->

                                        <div class="d-flex ">
                                            <button type="submit" class="btn btn-primary"> Add FAQ</button>
                                            <a href="{{ route('manage-faqs') }}" class="btn text-light ms-2"
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
        <footer class="text-light py-4" style="background-color:#001C43">
            <div class="container text-center mt-3">
                <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
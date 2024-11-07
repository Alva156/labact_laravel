<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <form action="{{route('store-opinion')}}" method="POST" class="m-4">
                @csrf
                <div class="mb-3">
                    <label for="opinion" class="form-label">Opinion</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                        rows="4">{{ old('content') }}</textarea>

                    @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div id="contentHelp" class="form-text">Share your thoughts about the Yankees.</div>
                </div>


                <div class="d-flex ">
                    <button type="submit" class="btn btn-primary">Submit Opinion</button>
                    <a href="{{ route('user-opinions') }}" class="btn text-light ms-2"
                        style="background-color:red">Cancel</a>
                </div>
            </form>
        </main>

        <!-- Sticky Footer -->
        <footer class="mt-auto text-light py-4" style="background-color:#001C43">
            <div class="container text-center mt-3">
                <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
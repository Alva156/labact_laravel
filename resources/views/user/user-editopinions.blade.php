<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">
                    @if ($opinion)
                    <div class="row">
                        <!-- Opinion Display -->
                        <div class="col-md-4 mb-4">
                            <div
                                class="card shadow-sm border-light {{ $opinion->deleted_at ? 'bg-light text-muted' : '' }}">
                                <div class="card-header text-white" style="background-color:#001C43">
                                    {{$opinion->user->name}}
                                </div>
                                <div class="card-body">
                                    <p class="blockquote">
                                        <i>{{$opinion->content}}</i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Form -->
                        <div class="col-md-8">
                            <div class="text-center mb-4">
                                <p>If you wish to edit this opinion, please update the fields below. The current
                                    details are already filled in for easy editing.</p>
                            </div>

                            <form action="{{ route('user-updateopinion', ['id' => $opinion->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Content -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">Opinion</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                                        name="content">{{ $opinion->content }}</textarea>
                                    @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary">Update Opinion</button>
                                    <a href="{{ route('user-myopinions') }}" class="btn text-light ms-2"
                                        style="background-color:red">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                    <p class="text-center">Opinion not found.</p>
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
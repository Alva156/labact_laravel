<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5 text-center">
                <div class="container">
                    <h1 class="display-4 mb-4">Fan Opinions</h1>
                    <p class="lead mb-5">See what fellow Yankees fans have to say about their experiences and thoughts
                        on the team.</p>
                    <a href="{{ route('user-share') }}" class="mb-4 btn btn-lg text-light"
                        style="background-color:#001C43">
                        Share Your Thought?
                    </a>
                    <a href="{{ route('user-myopinions') }}" class="mb-4 btn btn-lg text-light"
                        style="background-color:green">
                        My Opinions
                    </a>

                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Opinion posted successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row">
                        <!-- Fan Opinion 1 -->
                        @foreach($opinions as $opinion)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-light">
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
                        @endforeach
                    </div>
                </div>
            </section>
        </main>

        <!-- Sticky Footer -->
        <footer class="mt-auto text-light py-4" style="background-color:#001C43">
            <div class="container text-center mt-3">
                <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
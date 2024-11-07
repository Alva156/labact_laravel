<x-guest-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5 text-center">
                <div class="container">
                    <h1 class="display-4 mb-4">Fan Opinions</h1>
                    <p class="lead mb-5">See what fellow Yankees fans have to say about their experiences and thoughts
                        on the team.</p>
                    <a href="{{ route('login') }}" class="mb-4 btn btn-lg text-light" style="background-color:#001C43">
                        Log in now to Share Your Thought
                    </a>
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
        <footer class="text-light py-4" style="background-color:#001C43">
            <div class="container text-center mt-3">
                <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-guest-layout>
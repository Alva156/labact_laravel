<x-app-layout>
    <section class="bg-light py-5">
        <div class="container">
            <h1 class="display-4 mb-4 text-center">History of the New York Yankees</h1>
            <p class="lead mb-5 text-center">Explore the rich legacy and milestones of one of baseball's most iconic
                teams.</p>
            <div class="row">
                <!-- History Highlight 1 -->
                @foreach($histories as $history)
                <div class="col-md-4 mb-4">
                    <div class="bg-white border rounded shadow-sm p-4 d-flex flex-column h-100">
                        <div class=" text-white p-3 rounded mb-3" style="background-color:#001C43;">
                            <h4 class="mb-0">{{$history->era}}</h4>
                        </div>
                        <p class="fw-bold mb-2">{{$history->year}}</p>
                        <p>{{$history->description}}</p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <footer class="text-light py-4" style="background-color:#001C43">
        <div class="container text-center mt-3">
            <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
        </div>
    </footer>
</x-app-layout>
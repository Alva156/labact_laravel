<x-guest-layout>
    <section class="bg-cover text-center text-white py-5">
        <div class="container">
            <h1 class="display-4 mb-4" style="color:#001C43">Yankees Game Schedule</h1>
            <p class="lead mb-4" style="color:#001C43">Check out the upcoming Yankees games and secure your tickets for
                an unforgettable
                experience at Yankee Stadium!</p>

            <div class="text-center mb-4">
                <a href="{{ route('login') }}" class="btn btn-lg text-light" style="background-color:#001C43">Login to
                    book a ticket</a>
            </div>

            <div class="row">
                <!-- Game Card 1 -->
                @foreach($tickets as $ticket)
                <div class="col-md-4 mb-4">

                    <div class="card shadow-sm border-light">
                        <div class="card-header  text-white" style="background-color:#001C43;">
                            {{$ticket->first_team}} vs {{$ticket->second_team}}
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text">Date: {{ \Carbon\Carbon::parse($ticket->date)->format('F j, Y') }}</p>
                            <p class="card-text font-weight-bold">Time:
                                {{ \Carbon\Carbon::createFromFormat('H:i', $ticket->time)->format('g:i A') }}</p>
                            <p class="card-text font-weight-bold">Price: $ {{$ticket->price}}</p>

                        </div>
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
</x-guest-layout>
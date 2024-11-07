<x-guest-layout>
    <!-- Hero Section -->
    <header class="hero text-light text-center d-flex align-items-center justify-content-center" style="
    background-image: url('{{ asset('assets/yanks3.jpg') }}'); 
    background-size: cover; 
    background-position: center; 
    height: 80vh; 
    position: relative;">
        <div class="container d-flex justify-content-center align-items-center" style="height: 100%;">
            <div class="bg-opacity-50 p-4 rounded" style="background-color:#001C43; max-width: 800px; width: 100%;">
                <h3 class="display-4">Welcome to the Yankees Fan Zone</h3>
                <p class="lead">Explore the passion of Yankees fandom and see what awaits you behind the login.</p>
                <a href="{{ route('about') }}" class="btn btn-light btn-lg">Learn More</a>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <!-- Schedule Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-light" style="background-color:#001C43">
                            <h5 class="card-title">Game Schedule</h5>
                            <p class="card-text">Check out our thrilling game schedule. Log in to view full details and
                                never miss a match!</p>
                            <a href="{{ route('schedule') }}" class="btn btn-light"> View Schedule</a>
                        </div>
                    </div>
                </div>
                <!-- Shop Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-light" style="background-color:#001C43">
                            <h5 class="card-title">Yankees Shop</h5>
                            <p class="card-text">Find the latest Yankees gear and memorabilia. Log in to access our shop
                                and exclusive offers!</p>
                            <a href="{{ route('shop') }}" class="btn btn-light"> Shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- Stories Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-light" style="background-color:#001C43">
                            <h5 class="card-title">Yankees History</h5>
                            <p class="card-text">Explore the rich history of the New York Yankees. Learn more about our
                                legacy!</p>
                            <a href="{{ route('history') }}" class="btn btn-light">Discover Our History</a>
                        </div>
                    </div>
                </div>
                <!-- Fans' Opinions Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-light" style="background-color:#001C43">
                            <h5 class="card-title">Fans' Opinions</h5>
                            <p class="card-text">See what other fans are saying and share your own opinions! Join the
                                conversation.</p>
                            <a href="{{ route('opinions') }}" class="btn btn-light">Read Fans' Opinions</a>
                        </div>
                    </div>
                </div>
                <!-- FAQs Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-light" style="background-color:#001C43">
                            <h5 class="card-title">FAQs</h5>
                            <p class="card-text">Got questions? Check out our frequently asked questions for more
                                information.</p>
                            <a href="{{ route('faqs') }}" class="btn btn-light">View FAQs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <footer class="text-light py-4" style="background-color:#001C43">
        <div class="container text-center mt-3">
            <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
        </div>
    </footer>
</x-guest-layout>
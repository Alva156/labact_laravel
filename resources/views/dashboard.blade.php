<x-app-layout>
    <section class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Main Content -->
                <main class="col-md-10 col-lg-8 px-4">
                    <div class="bg-white rounded shadow-sm p-4 mb-4 text-center">
                        <h2>Welcome {{ Auth::user()->name }}!</h2>

                    </div>

                    <!-- Content Section -->
                    <div class="row">
                        <!-- For Admin Users -->
                        @if(Auth::user()->role === 'admin')
                        <div class="col-lg-4 d-flex mb-4">
                            <div class="card flex-fill border-light rounded shadow-sm d-flex flex-column">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title mb-3">User List</h4>
                                    <p class="card-text flex-grow-1">See the list of all users of the website.</p>
                                    <a href="{{ route('user-list') }}" class="btn mt-4 text-light"
                                        style="background-color:#001C43">View List</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex mb-4">
                            <div class="card flex-fill border-light rounded shadow-sm d-flex flex-column">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title mb-3">Schedule Management</h4>
                                    <p class="card-text flex-grow-1">Update game schedules and manage event details.</p>
                                    <a href="{{ route('manage-schedule') }}" class="btn mt-4 text-light"
                                        style="background-color:#001C43">Manage Schedule</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex mb-4">
                            <div class="card flex-fill border-light rounded shadow-sm d-flex flex-column">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title mb-3">Shop Management</h4>
                                    <p class="card-text flex-grow-1">Manage products, inventory, and pricing for the
                                        shop.</p>
                                    <a href="{{ route('manage-shop') }}" class="btn mt-4 text-light"
                                        style="background-color:#001C43">Manage Shop</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex mb-4">
                            <div class="card flex-fill border-light rounded shadow-sm d-flex flex-column">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title mb-3">History Management</h4>
                                    <p class="card-text flex-grow-1">Update and maintain the history of the Yankees.</p>
                                    <a href="{{ route('manage-history') }}" class="btn mt-4 text-light"
                                        style="background-color:#001C43">Manage History</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 d-flex mb-4">
                            <div class="card flex-fill border-light rounded shadow-sm d-flex flex-column">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title mb-3">Opinions Management</h4>
                                    <p class="card-text flex-grow-1">Edit and update fan's opinions.</p>
                                    <a href="{{ route('manage-opinions') }}" class="btn mt-4 text-light"
                                        style="background-color:#001C43">Manage Opinions</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex mb-4">
                            <div class="card flex-fill border-light rounded shadow-sm d-flex flex-column">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title mb-3">FAQs Management</h4>
                                    <p class="card-text flex-grow-1">Update and manage frequently asked questions.</p>
                                    <a href="{{ route('manage-faqs') }}" class="btn mt-4 text-light"
                                        style="background-color:#001C43">Manage FAQs</a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- For Regular Users -->
                        @if(Auth::user()->role === 'user')
                        <div class="col-lg-4 d-flex mb-4">
                            <div class="card flex-fill border-light rounded shadow-sm d-flex flex-column">
                                <div class="card-body text-light" style="background-color:#001C43">
                                    <h4 class="card-title mb-3">View Schedule</h4>
                                    <p class="card-text flex-grow-1">Check upcoming Yankees game schedules.</p>
                                    <a href="{{ route('user-schedule') }}" class="btn btn-light">View
                                        Schedule</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 d-flex mb-4">
                            <div class="card flex-fill border-light rounded shadow-sm d-flex flex-column">
                                <div class="card-body text-light" style="background-color:#001C43">
                                    <h4 class="card-title mb-3">Shop</h4>
                                    <p class="card-text flex-grow-1">Browse and purchase products from the Yankees shop.
                                    </p>
                                    <a href="{{ route('user-shop') }}" class="btn btn-light">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-light" style="background-color:#001C43">
                                    <h5 class="card-title">Yankees History</h5>
                                    <p class="card-text">Explore the rich history of the New York Yankees. Learn more
                                        about our
                                        legacy!</p>
                                    <a href="{{ route('user-history') }}" class="btn btn-light">Discover Our History</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 d-flex mb-4">
                            <div class="card flex-fill border-light rounded shadow-sm d-flex flex-column">
                                <div class="card-body text-light" style="background-color:#001C43">
                                    <h4 class="card-title mb-3">Submit Opinion</h4>
                                    <p class="card-text flex-grow-1">Share your thoughts and opinions on the Yankees.
                                    </p>
                                    <a href="{{ route('user-opinions') }}" class="btn btn-light">Submit
                                        Opinion</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 d-flex mb-4">
                            <div class="card flex-fill border-light rounded shadow-sm d-flex flex-column">
                                <div class="card-body text-light" style="background-color:#001C43">
                                    <h4 class="card-title mb-3">FAQs</h4>
                                    <p class="card-text flex-grow-1">Find answers to frequently asked questions.</p>
                                    <a href="{{ route('user-faqs') }}" class="btn btn-light">View
                                        FAQs</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </main>
            </div>
        </div>
    </section>
    <footer class="text-light py-4" style="background-color:#001C43">
        <div class="container text-center mt-3">
            <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
        </div>
    </footer>
</x-app-layout>
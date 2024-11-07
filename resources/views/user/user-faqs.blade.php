<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <section class="bg-light py-5 flex-fill">
            <div class="container">
                <h1 class="display-4 text-center mb-4">Frequently Asked Questions</h1>
                <div class="accordion" id="faqAccordion">
                    <!-- FAQ items -->
                    @foreach($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                aria-controls="collapse{{ $index }}">
                                {{$faq->question}}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-white" style="background-color:#001C43">
                                {{$faq->answer}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-light py-4" style="background-color:#001C43">
            <div class="container text-center mt-3">
                <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</x-app-layout>
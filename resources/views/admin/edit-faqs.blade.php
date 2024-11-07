<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">
                    @if ($faq)
                    <div class="row">
                        <!-- FAQ Display -->
                        <div class="col-md-4 mb-4">
                            <div class="bg-white border rounded shadow-sm p-4 d-flex flex-column h-100">
                                <div class="text-white p-3 rounded mb-3" style="background-color:#001C43;">
                                    <h4 class="mb-0">{{ $faq['question'] }}</h4>
                                </div>
                                <p>{{ $faq['answer'] }}</p>
                            </div>
                        </div>

                        <!-- Form -->
                        <div class="col-md-8">
                            <div class="text-center mb-4">
                                <p>If you wish to edit the FAQ details, please update the fields below. The current
                                    details are already filled in for easy editing.</p>
                            </div>

                            <form action="{{ route('update-faq', $faq->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="faq_id" value="{{ $faq['id'] }}">

                                <!-- Question -->
                                <div class="mb-3">
                                    <label for="question" class="form-label">Question</label>
                                    <input type="text" class="form-control @error('question') is-invalid @enderror"
                                        id="question" name="question" value="{{ $faq->question }}">
                                    @error('question')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Answer -->
                                <div class="mb-3">
                                    <label for="answer" class="form-label">Answer</label>
                                    <textarea class="form-control @error('answer') is-invalid @enderror" id="answer"
                                        name="answer">{{$faq->answer}}</textarea>
                                    <div id="contentHelp" class="form-text"></div>
                                    @error('answer')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex ">
                                    <button type="submit" class="btn btn-primary">Update FAQ</button>
                                    <a href="{{ route('manage-faqs') }}" class="btn text-light ms-2"
                                        style="background-color:red">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                    <p class="text-center">FAQ not found.</p>
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
<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5 text-center">
                <div class="container">
                    <h1 class="display-4 mb-4">Your Opinions</h1>
                    <p class="lead mb-5">You can edit and delete your opinions.</p>
                    <a href="{{ route('user-opinions') }}" class="mb-4 btn btn-lg text-light"
                        style="background-color:#001C43">
                        Return to Opinions
                    </a>
                    @if (session('successupdate'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Your opinion has been updated successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session('successsoft'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Opinion deleted successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session('successrestore'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Opinion restored successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session('successdelete'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Opinion permanently deleted</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="row">
                        <!-- Fan Opinion 1 -->
                        @foreach($opinions as $opinion)
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

                                    <!-- Edit Button -->
                                    <a href="{{ route('user-editopinions', ['id' => $opinion->id]) }}"
                                        class=" btn btn-lg text-light" style="background-color:#001C43">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-lg text-light"
                                        onclick="confirmPermanentDelete({{ $opinion->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>


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



    <!-- Permanent Delete Confirmation Modal -->
    <div class="modal fade" id="permanentDeleteModal" tabindex="-1" aria-labelledby="permanentDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permanentDeleteModalLabel">Confirm Permanent Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to permanently delete this opinion? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="permanentDeleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Permanently Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmPermanentDelete(opinionId) {
        document.getElementById('permanentDeleteForm').action = `/force-delete-opinion/${opinionId}`;
        const permanentDeleteModal = new bootstrap.Modal(document.getElementById('permanentDeleteModal'));
        permanentDeleteModal.show();
    }
    </script>
</x-app-layout>
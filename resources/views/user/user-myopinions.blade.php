<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5 text-center">
                <div class="container">
                    <h1 class="display-4 mb-4">Your Opinions</h1>
                    <p class="lead mb-5">You can edit and delete your opinions.</p>

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
                                        class=" btn btn-lg text-light" style="background-color:blue">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete/Restore Button -->
                                    @if ($opinion->deleted_at)
                                    <!-- Restore Button for Soft Deleted Opinions -->
                                    <button class="btn btn-warning btn-lg text-light"
                                        onclick="confirmRestore({{ $opinion->id }})">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                    <!-- Force Delete Button for Soft Deleted Opinions -->
                                    <button class="btn btn-danger btn-lg text-light"
                                        onclick="confirmPermanentDelete({{ $opinion->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    @else
                                    <!-- Delete Button for Active Opinions -->
                                    <button class="btn btn-danger btn-lg text-light"
                                        onclick="confirmDelete({{ $opinion->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
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

    <!-- Soft Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this opinion?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Restore Confirmation Modal -->
    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restoreModalLabel">Confirm Restoration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to restore this opinion?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="restoreForm" method="POST" action="">
                        @csrf
                        <button type="submit" class="btn btn-warning">Restore</button>
                    </form>
                </div>
            </div>
        </div>
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
    function confirmDelete(opinionId) {
        document.getElementById('deleteForm').action = `/delete-opinion/${opinionId}`;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    function confirmRestore(opinionId) {
        document.getElementById('restoreForm').action = `/restore-opinion/${opinionId}`;
        const restoreModal = new bootstrap.Modal(document.getElementById('restoreModal'));
        restoreModal.show();
    }

    function confirmPermanentDelete(opinionId) {
        document.getElementById('permanentDeleteForm').action = `/force-delete-opinion/${opinionId}`;
        const permanentDeleteModal = new bootstrap.Modal(document.getElementById('permanentDeleteModal'));
        permanentDeleteModal.show();
    }
    </script>
</x-app-layout>
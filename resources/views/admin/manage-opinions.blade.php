<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container">
                    <div class="row justify-content-center">

                        <!-- Main Content -->
                        <div class="col-md-10 col-lg-8 px-4">
                            <div class="bg-white rounded shadow-sm p-4 mb-4 text-center">
                                <h2>Manage Opinions</h2>
                                <p>Here you can manage the fan's opinions.</p>
                            </div>
                            @if (session('successsoft'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Opinion deleted successfully</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if (session('successrestore'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Opinion restored successfully</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if (session('successdelete'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Opinion permanently deleted</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif



                            <!-- Yankees History Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Deleted</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($opinions as $opinion)
                                    <tr class="{{ $opinion->deleted_at ? 'table-secondary' : '' }}">

                                        <th scope="row">{{ $opinion->id }}</th>
                                        <td>{{ $opinion->user->name }}</td>
                                        <td>{{ $opinion->content }}</td>
                                        <td>{{ $opinion->created_at->diffForHumans() }}</td>
                                        <td>{{ $opinion->deleted_at ? $opinion->deleted_at->diffForHumans() : '' }}</td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex">
                                                @if ($opinion->deleted_at)

                                                <button class="btn btn-warning btn-sm me-2"
                                                    onclick="confirmRestore({{ $opinion->id }})">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmPermanentDelete({{ $opinion->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                @else
                                                <!-- Button for active opinions -->
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $opinion->id }})">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$opinions->links()}}
                        </div>
                    </div>
                </div>
            </section>
        </main>


        <footer class="text-light py-4" style="background-color:#001C43">
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
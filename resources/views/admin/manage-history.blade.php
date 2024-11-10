<x-app-layout>
    <section class="bg-light py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <!-- Main Content -->
                <main class="col-md-10 px-4">
                    <div class="bg-white rounded shadow-sm p-4 mb-4 text-center">
                        <h2>Manage History</h2>
                        <p>Here you can create and manage the Yankees' historical events.</p>
                    </div>


                    <div class="d-flex justify-content-between mb-4">
                        <a href="{{ route('add-history') }}" class="btn btn-success text-light">
                            <i class="fas fa-plus"></i> Create History
                        </a>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>History added successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session('updated'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>History updated successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session('successsoft'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>History deleted successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session('successrestore'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>History restored successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session('successdelete'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>History permanently deleted</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Yankees History Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Era</th>
                                <th scope="col">Year(s)</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Deleted</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histories as $history)
                            <tr class="{{ $history->deleted_at ? 'table-secondary' : '' }}">

                                <th scope="row">{{ $history->id }}</th>
                                <td>{{ $history->era }}</td>
                                <td>{{ $history->year }}</td>
                                <td>{{ $history->description }}</td>
                                <td>{{ $history->created_at->diffForHumans() }}</td>
                                <td>{{ $history->updated_at ? $history->updated_at->diffForHumans() : '' }}</td>
                                <td>{{ $history->deleted_at ? $history->deleted_at->diffForHumans() : '' }}</td>

                                <td>
                                    <div class="d-flex">
                                        @if ($history->deleted_at)

                                        <button class="btn btn-warning btn-sm me-2"
                                            onclick="confirmRestore({{ $history->id }})">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="confirmPermanentDelete({{ $history->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        @else

                                        <a href="{{ route('edit-history', ['id' => $history->id]) }}"
                                            class="btn btn-secondary btn-sm me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $history->id }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$histories->links()}}
                </main>
            </div>
        </div>
    </section>
    <footer class="text-light py-4" style="background-color:#001C43">
        <div class="container text-center mt-3">
            <p class="mb-0">© 2024 Yankees Fan Zone. All rights reserved.</p>
        </div>
    </footer>
    <!-- Soft Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this history?
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
                    Are you sure you want to restore this history?
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
                    Are you sure you want to permanently delete this history? This action cannot be undone.
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
    function confirmDelete(historyId) {
        document.getElementById('deleteForm').action = `/delete-history/${historyId}`;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    function confirmRestore(historyId) {
        document.getElementById('restoreForm').action = `/restore-history/${historyId}`;
        const restoreModal = new bootstrap.Modal(document.getElementById('restoreModal'));
        restoreModal.show();
    }

    function confirmPermanentDelete(historyId) {
        document.getElementById('permanentDeleteForm').action = `/force-delete-history/${historyId}`;
        const permanentDeleteModal = new bootstrap.Modal(document.getElementById('permanentDeleteModal'));
        permanentDeleteModal.show();
    }
    </script>
</x-app-layout>
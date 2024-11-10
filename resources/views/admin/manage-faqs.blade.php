<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-fill">
            <section class="bg-light py-5">
                <div class="container-fluid">
                    <div class="row justify-content-center">

                        <!-- Main Content -->
                        <div class="col-md-10 px-4">
                            <div class="bg-white rounded shadow-sm p-4 mb-4 text-center">
                                <h2>Manage FAQS</h2>
                                <p>Here you can create and manage the FAQS.</p>
                            </div>


                            <div class="d-flex justify-content-between mb-4">
                                <a href="{{ route('add-faqs') }}" class="btn btn-success text-light">
                                    <i class="fas fa-plus"></i> Create Faq
                                </a>
                            </div>

                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>FAQ added successfully</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if (session('updated'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>FAQ updated successfully</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if (session('successsoft'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Faq deleted successfully</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if (session('successrestore'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Faq restored successfully</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if (session('successdelete'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Faq permanently deleted</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif


                            <!-- Yankees History Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Question</th>
                                        <th scope="col">Answer</th>
                                        <th scope="col">Created </th>
                                        <th scope="col">Updated </th>
                                        <th scope="col">Deleted </th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faqs as $faq)
                                    <tr class="{{ $faq->deleted_at ? 'table-secondary' : '' }}">

                                        <th scope="row">{{ $faq->id }}</th>
                                        <td>{{ $faq->question }}</td>
                                        <td>{{ $faq->answer }}</td>
                                        <td>{{ $faq->created_at->diffForHumans() }}</td>
                                        <td>{{ $faq->updated_at ? $faq->updated_at->diffForHumans() : '' }}</td>
                                        <td>{{ $faq->deleted_at ? $faq->deleted_at->diffForHumans() : '' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @if ($faq->deleted_at)

                                                <button class="btn btn-warning btn-sm me-2"
                                                    onclick="confirmRestore({{ $faq->id }})">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmPermanentDelete({{ $faq->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                @else

                                                <a href="{{ route('edit-faqs', ['id' => $faq->id]) }}"
                                                    class="btn btn-secondary btn-sm me-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $faq->id }})">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>


                            </table>
                            {{$faqs->links()}}
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
        <!-- Soft Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this faq?
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
                        Are you sure you want to restore this faq?
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
                        Are you sure you want to permanently delete this faq? This action cannot be undone.
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
    </div>

    <script>
    function confirmDelete(faqId) {
        document.getElementById('deleteForm').action = `/delete-faq/${faqId}`;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    function confirmRestore(faqId) {
        document.getElementById('restoreForm').action = `/restore-faq/${faqId}`;
        const restoreModal = new bootstrap.Modal(document.getElementById('restoreModal'));
        restoreModal.show();
    }

    function confirmPermanentDelete(faqId) {
        document.getElementById('permanentDeleteForm').action = `/force-delete-faq/${faqId}`;
        const permanentDeleteModal = new bootstrap.Modal(document.getElementById('permanentDeleteModal'));
        permanentDeleteModal.show();
    }
    </script>
    </div>
</x-app-layout>
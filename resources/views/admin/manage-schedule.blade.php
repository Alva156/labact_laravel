<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <section class="bg-light py-5 flex-grow-1">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <main class="col-md-10 px-4">
                        <div class="bg-white rounded shadow-sm p-4 mb-4 text-center">
                            <h2>Manage Schedule</h2>
                            <p>Here you can create and manage the Yankees game schedule and also see the transactions as
                                well.</p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <a href="{{ route('add-schedule') }}" class="btn btn-success text-light">
                                    <i class="fas fa-plus"></i> Create Game
                                </a>


                            </div>
                            <div class="btn-group" role="group" aria-label="Toggle Tables">
                                <button type="button"
                                    class="btn {{ request('tab') === 'transactions' ? 'btn-secondary' : 'btn-primary' }}"
                                    id="matchesButton">Matches</button>
                                <button type="button"
                                    class="btn {{ request('tab') === 'transactions' ? 'btn-primary' : 'btn-secondary' }}"
                                    id="transactionsButton">Transactions</button>
                            </div>
                        </div>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Match added successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('updated'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Match updated successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successsoft'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Match deleted successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successrestore'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Match restored successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successdelete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Match permanently deleted</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successsoftbook'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Book deleted successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successrestorebook'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Book restored successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successdeletebook'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Book permanently deleted</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('updatedbook'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Ticket details updated successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Matches Table -->
                        <div id="matchesTable" class="table-responsive"
                            style="{{ request('tab') === 'transactions' ? 'display:none;' : '' }}">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Match</th>
                                        <th scope="col">Date</th>
                                        <th scope="col"></th>
                                        <th scope="col">Time</th>
                                        <th scope="col"></th>
                                        <th scope="col">Price</th>
                                        <th scope="col"></th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Updated</th>
                                        <th scope="col">Deleted</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                    <tr class="{{ $ticket->deleted_at ? 'table-secondary' : '' }}">

                                        <th scope="row">{{ $ticket->id }}</th>
                                        <td>{{ $ticket->first_team }} vs {{ $ticket->second_team }}</td>
                                        <td>{{ \Carbon\Carbon::parse($ticket->date)->format('F j, Y') }}</td>
                                        <td></td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i', $ticket->time)->format('g:i A') }}
                                        </td>
                                        <td></td>
                                        <td>${{ $ticket->price }}</td>
                                        <td></td>
                                        <td>{{ $ticket->created_at ? $ticket->created_at->diffForHumans() : '' }}
                                        </td>
                                        <td>{{ $ticket->updated_at ? $ticket->updated_at->diffForHumans() : '' }}</td>
                                        <td>{{ $ticket->deleted_at ? $ticket->deleted_at->diffForHumans() : '' }}</td>


                                        @if ($ticket->deleted_at)
                                        <td>
                                            <div class="d-flex">

                                                <button class="btn btn-warning btn-sm me-2"
                                                    onclick="confirmRestore({{ $ticket->id }})">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmPermanentDelete({{ $ticket->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="d-flex">

                                                <a href="{{ route('edit-schedule', $ticket->id) }}"
                                                    class="btn btn-secondary btn-sm me-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $ticket->id }})">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$tickets->appends(['tab' => 'matches'])->links()}}
                        </div>

                        <!-- Transactions Table -->
                        <div id="transactionsTable" class="table-responsive"
                            style="{{ request('tab') !== 'transactions' ? 'display:none;' : '' }}">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Match ID</th>
                                        <th scope="col">Match </th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Address</th>

                                        <th scope="col">Contact Number</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price per Item</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Created by</th>
                                        <th scope="col">Date of Reservation</th>
                                        <th scope="col">Updated</th>
                                        <th scope="col">Deleted</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                    <tr class="{{ $book->deleted_at ? 'table-secondary' : '' }}">
                                        <th scope="row">{{$book->id}}</th>
                                        <td>{{$book->ticketID}}</td>
                                        <td>{{ $book->tickets->first_team ?? '' }} vs
                                            {{ $book->tickets->second_team ?? '' }}</td>
                                        <td>{{$book->fullname}}</td>
                                        <td>{{$book->address}}</td>
                                        <td>{{$book->number}}</td>
                                        <td>{{$book->quantity}}</td>
                                        <td>${{ $book->tickets->price }}</td>
                                        <td>${{ $book->quantity * $book->tickets->price }}</td>
                                        <td>{{$book->user->name}}</td>
                                        <td>{{$book->created_at->diffForHumans()}}</td>
                                        <td>{{ $book->updated_at ? $book->updated_at->diffForHumans() : '' }}</td>
                                        <td>{{ $book->deleted_at ? $book->deleted_at->diffForHumans() : '' }}</td>

                                        <td>
                                            @if ($book->deleted_at)
                                            <div class="d-flex">
                                                <button class="btn btn-warning btn-sm me-2"
                                                    onclick="confirmRestoreBook({{ $book->id }})">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmPermanentDeleteBook({{ $book->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                            @else
                                            <div class="d-flex">
                                                <a href="{{ route('edit-book', $book->id) }}"
                                                    class="btn btn-secondary btn-sm me-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDeleteBook({{ $book->id }})">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$books->appends(['tab' => 'transactions'])->links()}}
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
        <!-- Soft Delete Confirmation Modal for Match -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this game?
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

        <!-- Restore Confirmation Modal for Match -->
        <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="restoreModalLabel">Confirm Restoration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to restore this game?
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

        <!-- Permanent Delete Confirmation Modal for Match -->
        <div class="modal fade" id="permanentDeleteModal" tabindex="-1" aria-labelledby="permanentDeleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permanentDeleteModalLabel">Confirm Permanent Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to permanently delete this game? This action cannot be undone.
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

        <!-- Soft Delete Confirmation Modal for Book -->
        <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="deleteBookModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteBookModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this book?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteBookForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Restore Confirmation Modal for Book -->
        <div class="modal fade" id="restoreBookModal" tabindex="-1" aria-labelledby="restoreBookModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="restoreBookModalLabel">Confirm Restoration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to restore this book?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="restoreBookForm" method="POST" action="">
                            @csrf
                            <button type="submit" class="btn btn-warning">Restore</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Permanent Delete Confirmation Modal for Book -->
        <div class="modal fade" id="permanentDeleteBookModal" tabindex="-1"
            aria-labelledby="permanentDeleteBookModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permanentDeleteBookModalLabel">Confirm Permanent Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to permanently delete this book? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="permanentDeleteBookForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Permanently Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const matchesButton = document.getElementById('matchesButton');
            const transactionsButton = document.getElementById('transactionsButton');

            matchesButton.addEventListener('click', function() {
                window.location.href = '?tab=matches';
            });

            transactionsButton.addEventListener('click', function() {
                window.location.href = '?tab=transactions';
            });
        });

        // Confirm deletion for match
        function confirmDelete(ticketId) {
            document.getElementById('deleteForm').action = `/delete-schedule/${ticketId}`;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        // Confirm restoration for match
        function confirmRestore(ticketId) {
            document.getElementById('restoreForm').action = `/restore-schedule/${ticketId}`;
            const restoreModal = new bootstrap.Modal(document.getElementById('restoreModal'));
            restoreModal.show();
        }

        // Confirm permanent deletion for match
        function confirmPermanentDelete(ticketId) {
            document.getElementById('permanentDeleteForm').action = `/force-delete-schedule/${ticketId}`;
            const permanentDeleteModal = new bootstrap.Modal(document.getElementById('permanentDeleteModal'));
            permanentDeleteModal.show();
        }

        // Confirm deletion for book
        function confirmDeleteBook(bookId) {
            document.getElementById('deleteBookForm').action = `/delete-book/${bookId}`;
            const deleteBookModal = new bootstrap.Modal(document.getElementById('deleteBookModal'));
            deleteBookModal.show();
        }

        // Confirm restoration for book
        function confirmRestoreBook(bookId) {
            document.getElementById('restoreBookForm').action = `/restore-book/${bookId}`;
            const restoreBookModal = new bootstrap.Modal(document.getElementById('restoreBookModal'));
            restoreBookModal.show();
        }

        // Confirm permanent deletion for book
        function confirmPermanentDeleteBook(bookId) {
            document.getElementById('permanentDeleteBookForm').action = `/force-delete-book/${bookId}`;
            const permanentDeleteBookModal = new bootstrap.Modal(document.getElementById('permanentDeleteBookModal'));
            permanentDeleteBookModal.show();
        }
        </script>
</x-app-layout>
<x-app-layout>
    <div class="d-flex flex-column min-vh-100">
        <section class="bg-light py-5 flex-grow-1">
            <div class="container">
                <div class="row justify-content-center">
                    <main class="col-md-10 col-lg-8 px-4">
                        <div class="bg-white rounded shadow-sm p-4 mb-4 text-center">
                            <h2>Manage Shop</h2>
                            <p>Here you can create and manage the products in the Yankees Fan Zone shop. You can also
                                see the transactions made by the customers</p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <a href="{{ route('add-product') }}" class="btn btn-success text-light">
                                    <i class="fas fa-plus"></i> Create Product
                                </a>
                            </div>
                            <div class="btn-group" role="group" aria-label="Toggle Tables">
                                <button type="button"
                                    class="btn {{ request('tab') === 'transactions' ? 'btn-secondary' : 'btn-primary' }}"
                                    id="productsButton">Products</button>
                                <button type="button"
                                    class="btn {{ request('tab') === 'transactions' ? 'btn-primary' : 'btn-secondary' }}"
                                    id="transactionsButton">Transactions</button>
                            </div>
                        </div>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Product added successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('updated'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Product updated successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successsoft'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Product deleted successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successrestore'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Product restored successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successdelete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Product permanently deleted</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('updatedbuy'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Purchase details updated successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successsoftbuy'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Transaction deleted successfully.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successrestorebuy'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Transaction restored successfully</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('successdeletebuy'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Transaction permanently deleted</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Products Table -->
                        <div id="productsTable" class="table-responsive"
                            style="{{ request('tab') === 'transactions' ? 'display:none;' : '' }}">
                            <ul class="list-group">
                                @foreach($products as $product)
                                <li
                                    class="list-group-item d-flex align-items-center {{ $product->deleted_at ? 'list-group-item-secondary' : '' }}">


                                    <div class="me-3 mt-2">
                                        <img src="{{ asset( $product->photo) }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="badge bg-primary rounded-pill">{{ $product->id }}</span>
                                        <h5 class="mb-1">{{ $product->name }}</h5>
                                        <p class="mb-0 text-muted">{{ $product->type }}</p>
                                        <p class="mb-0 text-muted">{{ $product->description }}</p>
                                        <p class="mb-0 text-muted">${{ $product->price }}</p>
                                        <p class="mb-0 text-muted">Created: {{ $product->created_at->diffForHumans() }}
                                        </p>
                                        <p class="mb-0 text-muted">Updated:
                                            {{ $product->updated_at ? $product->updated_at->diffForHumans() : '' }}</p>
                                        <p class="mb-0 text-muted">Deleted:
                                            {{ $product->deleted_at ? $product->deleted_at->diffForHumans() : '' }}</p>


                                        <div class="d-flex mt-2">
                                            @if ($product->deleted_at)

                                            <button class="btn btn-warning btn-sm me-2"
                                                onclick="confirmRestore({{ $product->id }})">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="confirmPermanentDelete({{ $product->id }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            @else

                                            <a href="{{ route('edit-product', $product->id) }}"
                                                class="btn btn-secondary btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $product->id }})">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>

                            {{ $products->appends(['tab' => 'products'])->links() }}
                        </div>



                        <!-- Transactions Table -->
                        <div id="transactionsTable" class="table-responsive"
                            style="{{ request('tab') !== 'transactions' ? 'display:none;' : '' }}">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product ID</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Contact Number</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Created by</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Updated</th>
                                        <th scope="col">Deleted</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($buys as $buy)
                                    <tr class="{{ $buy->deleted_at ? 'table-secondary' : '' }}">
                                        <th scope="row">{{$buy->id}}</th>
                                        <td>{{$buy->productID}}</td>
                                        <td>{{ $buy->product->name ?? '' }}</td>
                                        <td>{{$buy->fullname}}</td>
                                        <td>{{$buy->address}}</td>
                                        <td>{{$buy->number}}</td>
                                        <td>{{$buy->quantity}}</td>
                                        <td>{{$buy->user->name}}</td>
                                        <td>{{$buy->created_at->diffForHumans()}}</td>
                                        <td>{{ $buy->updated_at ? $buy->updated_at->diffForHumans() : '' }}</td>
                                        <td>{{ $buy->deleted_at ? $buy->deleted_at->diffForHumans() : '' }}</td>

                                        <td>
                                            @if ($buy->deleted_at)
                                            <div class="d-flex">
                                                <button class="btn btn-warning btn-sm me-2"
                                                    onclick="confirmRestorebuy({{ $buy->id }})">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmPermanentDeletebuy({{ $buy->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                            @else
                                            <div class="d-flex">
                                                <a href="{{ route('edit-buy', $buy->id) }}"
                                                    class="btn btn-secondary btn-sm me-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="confirmDeletebuy({{ $buy->id }})">
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
                            {{$buys->appends(['tab' => 'transactions'])->links()}}
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
        <!-- Soft Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this product?
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
                        Are you sure you want to restore this product?
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
                        Are you sure you want to permanently delete this product? This action cannot be undone.
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
    <!-- Soft Delete Confirmation Modal for Buy Transaction -->
    <div class="modal fade" id="deleteBuyModal" tabindex="-1" aria-labelledby="deleteBuyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBuyModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this transaction? This will move it to the deleted items.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteBuyForm" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Restore Confirmation Modal for Buy Transaction -->
    <div class="modal fade" id="restoreBuyModal" tabindex="-1" aria-labelledby="restoreBuyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restoreBuyModalLabel">Confirm Restore</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to restore this transaction?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="restoreBuyForm" method="POST" class="d-inline-block">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-success">Yes, Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Permanent Deletion Confirmation Modal for Buy Transaction -->
    <div class="modal fade" id="permanentDeleteBuyModal" tabindex="-1" aria-labelledby="permanentDeleteBuyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permanentDeleteBuyModalLabel">Confirm Permanent Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to permanently delete this transaction? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="permanentDeleteBuyForm" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete Permanently</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const productsButton = document.getElementById('productsButton');
        const transactionsButton = document.getElementById('transactionsButton');

        productsButton.addEventListener('click', function() {
            window.location.href = '?tab=products';
        });

        transactionsButton.addEventListener('click', function() {
            window.location.href = '?tab=transactions';
        });
    });

    function confirmDelete(productId) {
        document.getElementById('deleteForm').action = `/delete-product/${productId}`;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    function confirmRestore(productId) {
        document.getElementById('restoreForm').action = `/restore-product/${productId}`;
        const restoreModal = new bootstrap.Modal(document.getElementById('restoreModal'));
        restoreModal.show();
    }

    function confirmPermanentDelete(productId) {
        document.getElementById('permanentDeleteForm').action = `/force-delete-product/${productId}`;
        const permanentDeleteModal = new bootstrap.Modal(document.getElementById('permanentDeleteModal'));
        permanentDeleteModal.show();
    }

    function confirmDeletebuy(id) {
        const form = document.getElementById('deleteBuyForm');
        form.action = `/delete-buy/${id}`;
        new bootstrap.Modal(document.getElementById('deleteBuyModal')).show();
    }

    function confirmRestorebuy(id) {
        const form = document.getElementById('restoreBuyForm');
        form.action = `/restore-buy/${id}`;
        new bootstrap.Modal(document.getElementById('restoreBuyModal')).show();
    }

    function confirmPermanentDeletebuy(id) {
        const form = document.getElementById('permanentDeleteBuyForm');
        form.action = `/force-delete-buy/${id}`;
        new bootstrap.Modal(document.getElementById('permanentDeleteBuyModal')).show();
    }
    </script>
</x-app-layout>
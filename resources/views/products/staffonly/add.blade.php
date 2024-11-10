@if (Auth::check() && Auth::user()->isStaff())
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card text-center" style="border: 2px dashed #ccc;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height: 546px;">
                <a href="#" class="text-decoration-none text-muted" data-bs-toggle="modal"
                    data-bs-target="#addItemModal">
                    <h1 class="display-4">+</h1>
                    <p class="h5">Add Item</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addItemModalLabel">Add New Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Item Name -->
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <!-- Item Type -->
                        <div class="form-group mb-3">
                            <label for="type_id">Type</label>
                            <select name="type_id" class="form-control" required>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Item Price -->
                        <div class="form-group mb-3">
                            <label for="price">Price (RM)</label>
                            <input type="number" name="price" class="form-control" step="0.01" required>
                        </div>

                        <!-- Item Photo -->
                        <div class="form-group mb-3">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endif

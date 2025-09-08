@extends('layouts.app') {{-- or update if you're using a different layout --}}

@section('content')
<div class="container">
    <h2>Add New Product</h2>
    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (RM)</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Product Photo</label>
            <input type="file" name="photo" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
@endsection

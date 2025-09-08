<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <!-- Product Images -->
            <div class="col-md-6">
                <img src="{{ asset($item->photo) }}" alt="{{ $item->name }}" class="img-fluid rounded mb-3" style="max-height: 500px; object-fit: cover;">

                <!-- Example of additional images if you have them -->
                {{-- 
                <div class="d-flex gap-2">
                    <img src="{{ asset('images/Aluna_jubah/aluna_khimar (1).jpg') }}" class="img-thumbnail" style="width: 100px;">
                    <img src="{{ asset('images/Aluna_jubah/aluna_khimar (2).jpg') }}" class="img-thumbnail" style="width: 100px;">
                </div>
                --}}
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h2>{{ $item->name }}</h2>
                <h4 class="text-primary">RM {{ number_format($item->price, 2) }}</h4>

                <p><strong>Material:</strong> Cey Italian Crepe (ironless)</p>
                <p><strong>Kegunaan:</strong> Sesuai untuk daily dan umrah outfit</p>
                <p><strong>Ciri:</strong> Ada pocket belah kanan, ada zip untuk breastfeeding mum</p>
                <p><strong>Size:</strong> Free size hingga plus size</p>

                <form method="POST" action="{{ route('cart.add', $item->id) }}">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary btn-lg mt-3">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

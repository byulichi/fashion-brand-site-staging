<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                    style="width: 30px; height: 30px;">
                    1
                </div>
                <h2 class="fs-5 card-title mb-0">Contact Information</h2>
            </div>
        </div>
        <div>
            <p class="mb-1">{{ auth()->user()->name }}</p>
            <p class="mb-1">{{ auth()->user()->email }}</p>
            <p class="mb-0">{{ auth()->user()->phone }}</p>
        </div>
    </div>
</div>

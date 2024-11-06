<div class="modal fade" id="youAreLoggedInModal" tabindex="-1" aria-labelledby="youAreLoggedInModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="youAreLoggedInModalLabel">Welcome!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (session('message'))
                    {{ session('message') }} <!-- This will display the login message -->
                @else
                    You are now logged in! <!-- Default message if session is not set -->
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

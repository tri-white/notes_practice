
    {{ $notes }}
@if ($notes->hasPages())
    <div class="pagination-wrapper">
         {{ $notes->links() }}
    </div>
@endif

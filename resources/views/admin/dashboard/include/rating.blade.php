<div class="ratings">
    @php
        $rating = $ratings;
    @endphp

    @while ($rating > 0)
        @if ($rating > 0.8)
            <i class='bx bxs-star bx-md text-warning'></i>
        @else
            <i class='bx bxs-star-half bx-md text-warning'></i>
        @endif
        @php $rating--; @endphp
    @endwhile

</div>

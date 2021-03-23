@if ($paginator->lastPage() > 1)

<div class="row">
    <div class="d-flex align-items-center justify-content-center" style="width: 100%;">
        <div class="p-2 bd-highlight">
            @if ($paginator->currentPage() - 1 < 0) 
                <a href="{{ $paginator->url(1)}}&sortbydate={{$sortbydate ? 'true' : 'false'}}&sortbyprice={{$sortbyprice ? 'true' : 'false'}}"><i class="fas fa-backward"></i></a>
            @else
                <a href="{{ $paginator->url($paginator->currentPage() - 1)}}&sortbydate={{$sortbydate ? 'true' : 'false'}}&sortbyprice={{$sortbyprice ? 'true' : 'false'}}"><i class="fas fa-backward"></i></a>
            @endif
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <a class="background_{{$i == $page ? 'red': 'white'}}" href="{{ $paginator->url($i) }}&sortbydate={{$sortbydate ? 'true' : 'false'}}&sortbyprice={{$sortbyprice ? 'true' : 'false'}}">{{ $i }}</a>
            @endfor
            @if ($paginator->currentPage() + 1 > $paginator->lastPage()) 
                <a href="{{ $paginator->url($paginator->lastPage())}}&sortbydate={{$sortbydate ? 'true' : 'false'}}&sortbyprice={{$sortbyprice ? 'true' : 'false'}}"><i class="fas fa-forward"></i></a>
            @else
                <a href="{{ $paginator->url($paginator->currentPage() + 1)}}&sortbydate={{$sortbydate ? 'true' : 'false'}}&sortbyprice={{$sortbyprice ? 'true' : 'false'}}"><i class="fas fa-forward"></i></a>
            @endif
        </div>
    </div>
</div>
@endif
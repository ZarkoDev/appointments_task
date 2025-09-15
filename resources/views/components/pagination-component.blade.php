@if($resources->count() > 0)
    <div class="tbc-pagination-wrapper d-flex flex-row align-items-center justify-content-between mb-3 mt-6">
        <div class="text-start fs-4 ps-2">
            Showing {{($resources->currentpage()-1)*$resources->perpage()+1}}
            to {{$resources->currentpage()*$resources->perpage()}}
            of {{$resources->total()}} entries
        </div>
        {!! $resources->onEachSide(1)->links() !!}
    </div>
@endif

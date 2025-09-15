{{-- Create the alerts container div --}}
<div id="alerts-container" class="fixed bottom-4 right-4 z-50 flex flex-col-reverse gap-3 pointer-events-none">
    {{-- Success alerts from session --}}
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error alerts from session --}}
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
</div>

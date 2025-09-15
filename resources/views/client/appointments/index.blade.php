@extends('layouts.guest_layout')

@section('content-wrapper')
    <div class="card mb-3 mb-md-4">
        <div class="card-body">
            <form method="GET" id="filters">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="from">Date From</label>

                        <input
                            class="form-control"
                            type="date"
                            id="from"
                            name="from"
                            value="{{ request()->get('from') }}"
                        />

                        @error('from')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="to">Date To</label>

                        <input
                            class="form-control"
                            type="date"
                            id="to"
                            name="to"
                            value="{{ request()->get('to') }}"
                        />

                        @error('to')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="egn">EGN</label>

                        <input
                            class="form-control"
                            type="text"
                            id="egn"
                            name="egn"
                            value="{{ request()->get('egn') }}"
                        />

                        @error('egn')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Search</button>
                <button id="clear-filter" type="button" class="btn btn-info">Clear</button>
            </form>

            <div class="mt-3 mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">Appointments</div>
                <a href="{{ route('appointments.create') }}" class="btn btn-info">Create New</a>
            </div>

            <div class="table-responsive-xl">
                <x-appointments-table
                    :appointments="$appointments"
                    :pagination="true"
                />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('clear-filter').onclick=function(){
            document.getElementById("from").value = "";
            document.getElementById("to").value = "";
            document.getElementById("egn").value = "";
        }
    </script>
@endpush

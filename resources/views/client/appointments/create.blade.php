@extends('layouts.guest_layout')

@section('content-wrapper')
    <div class="card-body">
        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Create New Appointment</div>
        </div>

        <div>
            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12 col-md-6">
                        <label for="first_name">First Name</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ old('first_name') }}"
                            id="first_name"
                            name="first_name"
                            placeholder="First Name"
                            required>

                        @error('first_name')
                            <small class="mt-2 block text-danger" role="alert">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="last_name">Last Name</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ old('last_name') }}"
                            id="last_name"
                            name="last_name"
                            placeholder="Last Name"
                            required>

                        @error('last_name')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="egn">EGN</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ old('egn') }}"
                            id="egn"
                            name="egn"
                            placeholder="EGN (9008147903)"
                            required>

                        @error('egn')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <x-notification-methods />

                    <div class="form-group col-12 col-md-6">
                        <label for="time">Choose a time for your appointment:</label>

                        <input
                            class="form-control"
                            type="datetime-local"
                            id="time"
                            name="time"
                            value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                            max="{{ \Carbon\Carbon::now()->addWeeks(2)->format('Y-m-d\TH:i') }}"
                        />

                        @error('time')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            id="email"
                            name="email"
                            placeholder="User Email">

                        @error('email')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="phone">Phone</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ old('phone') }}"
                            id="phone"
                            name="phone"
                            placeholder="0894456183">

                        @error('phone')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-12">
                        <label for="description">Description</label>
                        <textarea
                            class="form-control"
                            id="description"
                            name="description"
                            placeholder="Tell us more about your appointment">
                            {{ old('description') }}
                        </textarea>

                        @error('description')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right">Create</button>
            </form>
        </div>


    </div>
@endsection

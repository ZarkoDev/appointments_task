@extends('layouts.guest_layout')

@section('content-wrapper')
    <div class="card-body">
        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Update Appointment #{{ $appointment->id }}</div>
        </div>

        <div>
            <form method="POST" action="{{ route('appointments.update', $appointment) }}">
                @method('PUT')
                @csrf
                <div class="form-row">
                    <div class="form-group col-12 col-md-6">
                        <label for="first_name">First Name</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ old('first_name', $appointment->user->first_name) }}"
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
                            value="{{ old('last_name', $appointment->user->last_name) }}"
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
                            value="{{ $appointment->user->egn }}"
                            id="egn"
                            placeholder="EGN (9008147903)"
                            disabled>

                        @error('egn')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <x-notification-methods :value="$appointment->notification_method->slug"/>

                    <div class="form-group col-12 col-md-6">
                        <label for="time">Choose a time for your appointment:</label>

                        <input
                            class="form-control"
                            type="datetime-local"
                            id="time"
                            name="time"
                            value="{{ $appointment->time->format('Y-m-d\TH:i') }}"
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
                            value="{{ old('email', $appointment->user->email) }}"
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
                            value="{{ old('phone', $appointment->user->phone) }}"
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
                            {{ old('description', $appointment->description) }}
                        </textarea>

                        @error('description')
                        <small class="mt-2 block text-danger" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right">Update</button>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Latest Appointments</div>
        </div>

        <div class="table-responsive-xl">
            <table class="table text-nowrap mb-0">
                <thead>
                <tr>
                    <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Name</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Time</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Notification Method</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Notified</th>
                    <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td class="py-3">{{ $appointment->id }}</td>
                        <td class="align-middle py-3">
                            {{ $appointment->user->full_name }}
                        </td>
                        <td class="py-3">{{ $appointment->time }}</td>
                        <td class="py-3">{{ $appointment->notification_method->name }}</td>
                        <td class="py-3">
                            @if ($appointment->notified_at)
                                <span class="badge badge-pill badge-success">Yes</span>
                            @else
                                <span class="badge badge-pill badge-danger">No</span>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="position-relative">
                                <a class="link-dark d-inline-block"
                                   href="{{ route('appointments.edit', $appointment) }}">
                                    <i class="gd-pencil icon-text"></i>
                                </a>
                                <a class="link-dark d-inline-block"
                                   href="{{ route('appointments.delete', $appointment) }}">
                                    <i class="gd-trash icon-text"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                @if ($appointments->isEmpty())
                    <tr>
                        <td colspan="10" class="text-center">There are no appointments</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

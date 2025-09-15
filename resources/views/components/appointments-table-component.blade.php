<table class="table text-nowrap mb-0">
    <thead>
    <tr>
        <th class="font-weight-semi-bold border-top-0 py-2">#</th>
        <th class="font-weight-semi-bold border-top-0 py-2">Name</th>
        <th class="font-weight-semi-bold border-top-0 py-2">EGN</th>
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
            <td class="py-3">{{ $appointment->user->egn }}</td>
            <td class="py-3">{{ $appointment->time->format('d-m-Y H:i') }}</td>
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
                    <a class="link-dark d-inline-block" href="#">
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

@if($pagination)
    <x-pagination :resources="$appointments" />
@endif

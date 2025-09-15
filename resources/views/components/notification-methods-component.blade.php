<div class="form-group col-12 col-md-6">
    <label for="notification_method">Notification Method {{ old('notification_method')}}</label>
    <select class="form-control" name="notification_method">
        <option>Choose</option>
        @foreach ($notificationMethods as $notificationMethod)
            <option value="{{$notificationMethod->slug}}"
                @selected(old('notification_method', $value) === $notificationMethod->slug)
            >{{$notificationMethod->name}}</option>
        @endforeach
    </select>

    @error('notification_method')
    <small class="mt-2 block text-danger" role="alert">
        {{ $message }}
    </small>
    @enderror
</div>

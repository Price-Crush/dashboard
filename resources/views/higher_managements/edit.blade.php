<form class="form form-vertical" action="/admin-panel/higher_management/{{ $user->id }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $user->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" placeholder="Name" value="{{ old('name',$user->name) }}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email-id-vertical">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" placeholder="Email" value="{{ old('email',$user->email) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email-id-vertical">Phone</label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                        name="phone" placeholder="Phone" value="{{ old('phone',$user->phone) }}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email-id-vertical">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="Password" value="{{ old('password') }}"
                        >
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email-id-vertical">Image</label>
                    <input type="file"
                        class="form-control @error('profile_pic') is-invalid @enderror"
                        name="profile_pic">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email-id-vertical">Account Status</label>
                    <select name="is_active" class="form-control" required>
                        <option value="">Choose</option>
                        <option value="1" @selected(old('is_active',$user->is_active) == 1)>Active</option>
                        <option value="0" @selected(old('is_active',$user->is_active) == 0)>Not Active</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mr-1 mb-1">Update</button>
            </div>
        </div>
    </div>
</form>

<form class="form form-vertical" action="/admin-panel/user_types/{{ $type->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $type->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">User Type Name</label>
                    <input type="text" class="form-control @error('user_type_desc') is-invalid @enderror"
                        name="user_type_desc" placeholder="User Type Name"
                        value="{{ old('user_type_desc', $type->user_type_desc) }}" required>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mr-1 mb-1">Update</button>
            </div>
        </div>
    </div>
</form>
<button class="btn btn-danger mr-2"
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $type->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $type->id }}" action="/admin-panel/user_types/{{ $type->id }}" method="POST"
    class="d-none">
    @csrf
    @method('DELETE')
</form>

<form class="form form-vertical" action="/admin-panel/roles/permissions/{{ $permission->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $permission->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name AR</label>
                    <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                        name="name_ar" placeholder="Name AR" value="{{ old('name_ar',$permission->name_ar) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name EN</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name_en" placeholder="Name EN" value="{{ old('name_en',$permission->name_en) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name TR</label>
                    <input type="text" class="form-control @error('name_tr') is-invalid @enderror"
                        name="name_tr" placeholder="Name TR" value="{{ old('name_tr',$permission->name_tr) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mr-1 mb-1">Update</button>
            </div>
        </div>
    </div>
</form>

<button class="btn btn-danger mr-2"
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $permission->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $permission->id }}" action="/admin-panel/roles/permissions/{{ $permission->id }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

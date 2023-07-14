<form class="form form-vertical" action="/admin-panel/categories/{{ $category->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $category->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name AR</label>
                    <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                        name="name_ar" placeholder="Name AR" value="{{ old('name_ar',$category->name_ar) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name EN</label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                        name="name_en" placeholder="Name EN" value="{{ old('name_en',$category->name_en) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name TR</label>
                    <input type="text" class="form-control @error('name_tr') is-invalid @enderror"
                        name="name_tr" placeholder="Name TR" value="{{ old('name_tr',$category->name_tr) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="email-id-vertical">Is Active</label>
                    <select name="is_active" class="form-control" required>
                        <option value="0" @selected(old('is_active',$category->is_active) == "0")>No</option>
                        <option value="1" @selected(old('is_active',$category->is_active) == "1")>Yes</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mr-1 mb-1">Update</button>
            </div>
        </div>
    </div>
</form>
<button class="btn btn-danger mr-2"
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $category->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $category->id }}" action="/admin-panel/categories/{{ $category->id }}" method="POST"
    class="d-none">
    @csrf
    @method('DELETE')
</form>

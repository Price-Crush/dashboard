<form class="form form-vertical" action="/admin-panel/languages/{{ $language->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $language->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Language Name AR</label>
                    <input type="text" class="form-control @error('language_name_ar') is-invalid @enderror"
                        name="language_name_ar" placeholder="Language Name AR" value="{{ old('language_name_ar',$language->language_name_ar) }}" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Language Name EN</label>
                    <input type="text" class="form-control @error('language_name_en') is-invalid @enderror"
                        name="language_name_en" placeholder="Language Name EN" value="{{ old('language_name_en',$language->language_name_en) }}" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Language Name TR</label>
                    <input type="text" class="form-control @error('language_name_tr') is-invalid @enderror"
                        name="language_name_tr" placeholder="Language Name TR" value="{{ old('language_name_tr',$language->language_name_tr) }}" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Language Code</label>
                    <input type="text" class="form-control @error('language_code') is-invalid @enderror"
                        name="language_code" placeholder="Language Code" value="{{ old('language_code',$language->language_code) }}" required>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mr-1 mb-1">Update</button>
            </div>
        </div>
    </div>
</form>
<button class="btn btn-danger mr-2"
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $language->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $language->id }}" action="/admin-panel/languages/{{ $language->id }}" method="POST"
    class="d-none">
    @csrf
    @method('DELETE')
</form>

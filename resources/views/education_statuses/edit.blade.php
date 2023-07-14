<form class="form form-vertical" action="/admin-panel/education_statuses/{{ $educationalStatus->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $educationalStatus->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Education Statuses Name AR</label>
                    <input type="text" class="form-control @error('educational_status_name_ar') is-invalid @enderror"
                        name="educational_status_name_ar" placeholder="Education Statuses Name AR" value="{{ old('educational_status_name_ar',$educationalStatus->educational_status_name_ar) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Education Statuses Name EN</label>
                    <input type="text" class="form-control @error('educational_status_name_en') is-invalid @enderror"
                        name="educational_status_name_en" placeholder="Education Statuses Name EN" value="{{ old('educational_status_name_en',$educationalStatus->educational_status_name_en) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Education Statuses Name TR</label>
                    <input type="text" class="form-control @error('educational_status_name_tr') is-invalid @enderror"
                        name="educational_status_name_tr" placeholder="Education Statuses Name TR" value="{{ old('educational_status_name_tr',$educationalStatus->educational_status_name_tr) }}"
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
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $educationalStatus->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $educationalStatus->id }}" action="/admin-panel/education_statuses/{{ $educationalStatus->id }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

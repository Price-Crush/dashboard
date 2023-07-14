<form class="form form-vertical" action="/admin-panel/business_sectors/{{ $businessSector->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $businessSector->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name AR</label>
                    <input type="text" class="form-control @error('sector_name_ar') is-invalid @enderror"
                        name="sector_name_ar" placeholder="Name AR" value="{{ old('sector_name_ar',$businessSector->sector_name_ar) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name EN</label>
                    <input type="text" class="form-control @error('sector_name_en') is-invalid @enderror"
                        name="sector_name_en" placeholder="Name EN" value="{{ old('sector_name_en',$businessSector->sector_name_en) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name TR</label>
                    <input type="text" class="form-control @error('sector_name_tr') is-invalid @enderror"
                        name="sector_name_tr" placeholder="Name TR" value="{{ old('sector_name_tr',$businessSector->sector_name_tr) }}"
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
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $businessSector->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $businessSector->id }}" action="/admin-panel/business_sectors/{{ $businessSector->id }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

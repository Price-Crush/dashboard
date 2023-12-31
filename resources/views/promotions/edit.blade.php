<form class="form form-vertical" action="/admin-panel/promotions/{{ $promotion->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $promotion->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Name AR</label>
                    <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                        name="name_ar" placeholder="Name AR" value="{{ old('name_ar',$promotion->name_ar) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Name EN</label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                        name="name_en" placeholder="Name EN" value="{{ old('name_en',$promotion->name_en) }}"
                        required>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Name TR</label>
                    <input type="text" class="form-control @error('name_tr') is-invalid @enderror"
                        name="name_tr" placeholder="Name TR" value="{{ old('name_tr',$promotion->name_tr) }}"
                        required>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Notification Number</label>
                    <input type="text" class="form-control @error('notification_no') is-invalid @enderror"
                        name="notification_no" placeholder="Nationality EN" value="{{ old('notification_no',$promotion->notification_no) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Discount Precentege</label>
                    <input type="text" class="form-control @error('discount') is-invalid @enderror"
                        name="discount" placeholder="Discount Precentege" value="{{ old('discount',$promotion->discount) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email-id-vertical">Icon</label>
                    <input type="file"
                        class="form-control @error('icon') is-invalid @enderror"
                        name="icon" >
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mr-1 mb-1">Update</button>
            </div>
        </div>
    </div>
</form>
<button class="btn btn-danger mr-2"
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $promotion->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $promotion->id }}" action="/admin-panel/countries/{{ $promotion->id }}" method="POST"
    class="d-none">
    @csrf
    @method('DELETE')
</form>

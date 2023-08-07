<form class="form form-vertical" action="/admin-panel/cities/{{ $city->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $city->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">State</label>
                     <select name="state_id" class="select2 form-control @error('state_id') is-invalid @enderror" id="state_id" required style="width: 100%">
                        <option value="">Choose</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->id }}"@if($state->id == old('state_id',$city->state_id)) selected @endif>{{ $state->name_en }}</option>
                        @endforeach
                     </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name AR</label>
                    <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                        name="name_ar" placeholder="Name AR" value="{{ old('name_ar',$city->name_ar) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name EN</label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                        name="name_en" placeholder="Name EN" value="{{ old('name_en',$city->name_en) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name TR</label>
                    <input type="text" class="form-control @error('name_tr') is-invalid @enderror"
                        name="name_tr" placeholder="Name TR" value="{{ old('name_tr',$city->name_tr) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">User Notification Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                        name="price" placeholder="User Notification Price" value="{{ old('price',$city->price) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">User Banner Price</label>
                    <input type="number" class="form-control @error('user_banner_price') is-invalid @enderror"
                        name="user_banner_price" placeholder="User Banner Price" value="{{ old('user_banner_price',$city->user_banner_price) }}"
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
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $city->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $city->id }}" action="/admin-panel/cities/{{ $city->id }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<script>
    $("#state_id").select2({
       dropdownParent: $('#edit_modal')
   });
</script>
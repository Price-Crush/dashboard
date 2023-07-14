<form class="form form-vertical" action="/admin-panel/states/{{ $state->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $state->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Country</label>
                    <select name="country_id" class="form-control" id="">
                        <option value="">Choose</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if ($country->id == old('country_id', $state->country_id)) selected @endif>
                                {{ $country->country_enName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name AR</label>
                    <input type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar"
                        placeholder="Name AR" value="{{ old('name_ar', $state->name_ar) }}" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name EN</label>
                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en"
                        placeholder="Name EN" value="{{ old('name_en', $state->name_en) }}" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name TR</label>
                    <input type="text" class="form-control @error('name_tr') is-invalid @enderror" name="name_tr"
                        placeholder="Name TR" value="{{ old('name_tr', $state->name_tr) }}" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Price</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                        name="price" placeholder="Price" value="{{ old('price', $state->price) }}"
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
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $state->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $state->id }}" action="/admin-panel/states/{{ $state->id }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

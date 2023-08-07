<form class="form form-vertical" action="/admin-panel/countries/{{ $country->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $country->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Country Code</label>
                    <input type="text" class="form-control @error('country_code') is-invalid @enderror"
                        name="country_code" placeholder="Country Code"
                        value="{{ old('country_code', $country->country_code) }}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Name EN</label>
                    <input type="text" class="form-control @error('country_enName') is-invalid @enderror"
                        name="country_enName" placeholder="Name EN"
                        value="{{ old('country_enName', $country->country_enName) }}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Name AR</label>
                    <input type="text" class="form-control @error('country_arName') is-invalid @enderror"
                        name="country_arName" placeholder="Name AR"
                        value="{{ old('country_arName', $country->country_arName) }}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Name TR</label>
                    <input type="text" class="form-control @error('country_trName') is-invalid @enderror"
                        name="country_trName" placeholder="Name TR"
                        value="{{ old('country_trName', $country->country_trName) }}" required>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Nationality EN</label>
                    <input type="text" class="form-control @error('country_enNationality') is-invalid @enderror"
                        name="country_enNationality" placeholder="Nationality EN"
                        value="{{ old('country_enNationality', $country->country_enNationality) }}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Nationality AR</label>
                    <input type="text" class="form-control @error('country_arNationality') is-invalid @enderror"
                        name="country_arNationality" placeholder="Nationality AR"
                        value="{{ old('country_arNationality', $country->country_arNationality) }}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Nationality TR</label>
                    <input type="text" class="form-control @error('country_trNationality') is-invalid @enderror"
                        name="country_trNationality" placeholder="Nationality TR"
                        value="{{ old('country_trNationality', $country->country_trNationality) }}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">User Notification Price</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                        name="price" placeholder="Price" value="{{ old('price', $country->price) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">User Banner Price</label>
                    <input type="text" class="form-control @error('user_banner_price') is-invalid @enderror"
                        name="user_banner_price" placeholder="User Banner Price" value="{{ old('user_banner_price',$country->user_banner_price) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Users Average</label>
                    <input type="text" class="form-control @error('users_average') is-invalid @enderror"
                        name="users_average" placeholder="Users Average" value="{{ old('users_average',$country->users_average) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email-id-vertical">Google Ads</label>
                    <select name="google_ads" class="form-control @error('google_ads') is-invalid @enderror" required>
                        <option value="">Choose</option>
                        <option value="1" @selected(old('google_ads', $country->google_ads) == 1)>On</option>
                        <option value="0" @selected(old('google_ads', $country->google_ads) == 0)>Off</option>
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
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $country->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $country->id }}" action="/admin-panel/countries/{{ $country->id }}" method="POST"
    class="d-none">
    @csrf
    @method('DELETE')
</form>

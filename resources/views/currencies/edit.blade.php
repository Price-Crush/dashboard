<form class="form form-vertical" action="/admin-panel/currencies/{{ $currency->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $currency->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" placeholder="U.S. Dollar" value="{{ old('name',$currency->name) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                        name="code" placeholder="USD" value="{{ old('code',$currency->code) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Symbol</label>
                    <input type="text" class="form-control @error('symbol') is-invalid @enderror"
                        name="symbol" placeholder="$" value="{{ old('symbol',$currency->symbol) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Format</label>
                    <input type="text" class="form-control @error('format') is-invalid @enderror"
                        name="format" placeholder="$1,0.00" value="{{ old('format',$currency->format) }}"
                        required>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="first-name-vertical">Exchange Rate</label>
                    <input type="text" class="form-control @error('exchange_rate') is-invalid @enderror"
                        name="exchange_rate" placeholder="1.00000000" value="{{ old('exchange_rate',$currency->exchange_rate) }}"
                        required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email-id-vertical">Is Active</label>
                    <select name="active" class="form-control" required>
                        <option value="1" @selected(old('active',$currency->active) == 1)>active</option>
                        <option value="0" @selected(old('active',$currency->active) == 0)>not active</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mr-1 mb-1">Update</button>
            </div>
        </div>
    </div>
</form>
@if($currency->id != 1)
<button class="btn btn-danger mr-2"
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $currency->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $currency->id }}" action="/admin-panel/currencies/{{ $currency->id }}" method="POST"
    class="d-none">
    @csrf
    @method('DELETE')
</form>
@endif

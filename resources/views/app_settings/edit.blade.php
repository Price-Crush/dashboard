<form class="form form-vertical" action="/admin-panel/app_settings/{{ $appSetting->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        placeholder="Name" value="{{ old('name',$appSetting->name) }}" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Value</label>
                    <input type="text" class="form-control @error('value') is-invalid @enderror" name="value"
                        placeholder="Value" value="{{ old('value',$appSetting->value) }}" required>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mr-1 mb-1">Update</button>
            </div>
        </div>
    </div>
</form>

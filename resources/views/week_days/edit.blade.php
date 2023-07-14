<form class="form form-vertical" action="/admin-panel/days-work/{{ $adminDay->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $adminDay->id }}" name="id">
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Days</label>
                     <select name="day_id" class="form-control @error('day_id') is-invalid @enderror" required>
                        <option value="">Choose</option>
                        @foreach ($days as $day)
                        <option value="{{ $day->id }}"@if($day->id == old('day_id',$adminDay->day_id)) selected @endif>{{ $day->day_en }}</option>
                        @endforeach
                     </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">From</label>
                    <input type="time" class="form-control @error('from') is-invalid @enderror"
                        name="from" value="{{ old('from',$adminDay->from) }}"
                        required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">To</label>
                    <input type="time" class="form-control @error('to') is-invalid @enderror"
                        name="to" value="{{ old('to',$adminDay->to) }}"
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
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $adminDay->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $adminDay->id }}" action="/admin-panel/days-work/{{ $adminDay->id }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

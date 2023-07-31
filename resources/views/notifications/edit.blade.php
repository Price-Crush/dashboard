<form class="form form-vertical" action="/admin-panel/notifications/{{ $notification->id }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" value="{{ $notification->id }}" name="id">
    <div class="form-body">
        <div class="row">
            
            <div class="col-12">
                <button type="submit" class="btn btn-success mr-1 mb-1">Update</button>
            </div>
        </div>
    </div>
</form>

<button class="btn btn-danger mr-2"
    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $notification->id }}').submit();}else{
event.preventDefault();}">Delete</button>
<form id="delete-users_{{ $notification->id }}" action="/admin-panel/notifications/{{ $notification->id }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

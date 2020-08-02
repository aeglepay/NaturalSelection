<a data-toggle="modal" href="#editModal{{ $record->id }}" class="pr-2">
<span data-feather="edit"></span>
</a>
<a data-toggle="modal" href="#deleteModal" class="text-danger">
<span data-feather="trash"></span>
</a>

<div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $record->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form class="modal-content" method="POST" action="{{ url("admin/$table/$record->id") }}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="modal-header">
                <h5 class="modal-title" id="editModal{{ $record->id }}Label">Edit {{ $record->name ?? $record->title ?? str_singular(__($table)) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @include('admin.partials.form.fields')
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn bg-dark">Update {{ str_singular(__($table)) }}</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="POST" action="{{ url("admin/$table/$record->id") }}">
            @csrf
            @method('delete')

            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="text-muted">The delete action cannot be undone</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn bg-dark">Delete {{ str_singular(__($table)) }}</button>
            </div>
        </form>
    </div>
</div>

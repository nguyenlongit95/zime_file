<div class="modal-content">
    <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel" style="color: blue">{{ trans("labels.admin.file.bread_crum") }}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <h5 class="modal-title" id="exampleModalLabel">{{ trans("labels.admin.file.name") }} {{ $file->name }} </h5><br>
        <h5 class="modal-title" id="exampleModalLabel">{{ trans("labels.admin.file.size") }} {{ $file->file_size }}</h5><br>
        <h5 class="modal-title" id="exampleModalLabel">{{ trans("labels.admin.file.time") }} {{ $file->created_at }}</h5><br>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("labels.admin.btn.btn_close") }}</button>
    </div>
</div>

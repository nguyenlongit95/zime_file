<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("admin/plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset("admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset("admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset("admin/plugins/jqvmap/jqvmap.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("admin/dist/css/adminlte.min.css") }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset("admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset("admin/plugins/daterangepicker/daterangepicker.css") }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset("admin/plugins/summernote/summernote-bs4.min.css") }}">
    <title>{{ trans('labels.user.title.t2') }}</title>
</head>
<style>
    body{
        background: linear-gradient(120deg,#2980b9, #8e44ad);
        height: 100vh;
        overflow: hidden;
    }
</style>
<body>
<div id="root" class="py-5">
    <div class="container">
        @if(session("failed"))
            <div class="alert alert-danger">
              {{ session("failed") }}
            </div>
        @elseif(session("success"))
            <div class="alert alert-success">
              {{ session("success") }}
            </div>
        @endif
        <div class="text-end py-2">
            <button type="button" onclick="showUploadFileModal()" class="btn btn-success">Upload</button>
            <a type="button" href="{{url("/logout")}}" class="btn btn-secondary">Log Out</a>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ trans('labels.user.title.t2') }}</h4>
                    </div>
                    @if(count($files) == 0)
                        <div class="card-body">
                            <p class="card-text" style="font-size: 20px; color: red">{{ trans('auth.admin.empty') }}</p>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="row">
                                @foreach($files as $file)
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text fs-4">{{$file->name}}</span>
                                                <span class="info-box-number fs-5">{{$file->file_size}}</span>
                                                <span class="info-box-text py-1">
                                                    <i class="fa-solid fa-circle-info" onclick="showFileDetail({{$file->id}})" style="margin-right: 10px"></i>
                                                    <a class="fa-solid fa-trash" href="{{ url("/file-manage/delete/" . $file->id) }}"></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="modal" id="show_modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="file_name"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Upload Date: <span id="file_upload"></span></p>
                        <p>File Size: <span id="file_size"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="upload_modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url("/file-manage/upload") }}" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="file" name="file" accept=".zip" class="form-control" id="file-name">
                            </div>
                            <button type="submit" onclick="processSaveFile()" class="btn btn-primary float-right">
                                <i class="fa fa-spinner fa-spin" id="loading" style="display: none"></i>
                                <span id="btn-save-file">Save File</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/1da19b0fb1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset("admin/plugins/jquery/jquery.min.js") }}"></script>
<script>
    /**
     * Show file detail
     *
     * @param id
     */
    function showFileDetail(id) {
        $("#show_modal").modal("show");
        $.ajax({
            url: '/file-manage/show/' + id,
            type: 'get',
            data: {},
            success: function (response) {
                console.log(response);
                if(response.code === 200) {
                    $("#file_name").text(response.data.name);
                    $("#file_size").text(response.data.file_size);
                    $("#file_upload").text(response.data.updated_at);
                }
            }
        })
    }

    /**
     * Show upload new file
     */
    function showUploadFileModal() {
        $("#upload_modal").modal("show");
    }

    /**
     * Display icon process upload file
     */
    function processSaveFile() {
        $("#loading").css("display", "block");
        $("#btn-save-file").text("");
    }
</script>
</body>
</html>

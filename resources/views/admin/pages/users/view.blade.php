@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ trans('labels.admin.users.bread_crum') }}: {{ $user->email }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @include('admin.pages.partials.errors')
            <div class="container-fluid" style="padding: 20px">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ url("/admin/users/".$user->id."/update") }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>{{ trans("labels.admin.index.thead_th9") }}</label><br>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                            </div>
                            @if ($errors->has('phone'))
                                <p style="height: 0; color: red; margin: 0">
                                    {{ $errors->first('phone') }}
                                </p>
                                <br>
                            @endif
                            <div class="form-group">
                                <label>{{ trans("labels.admin.index.thead_th11") }}</label><br>
                                <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                            </div>
                            @if ($errors->has('address'))
                                <p style="height: 0; color: red; margin: 0">
                                    {{ $errors->first('address') }}
                                </p>
                                <br>
                            @endif
                            <div class="form-group">
                                <label>{{ trans("labels.admin.index.thead_th13") }}</label><br>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <p class="card-text h5">{{ trans("labels.admin.packages.package_name") }} {{$package->name}}</p>
                            </div>
                            <div class="card-body">
                                <p class="card-text h5">{{ trans("labels.admin.packages.upload") }} {{ $totalFile }}/{{ $package->max_file_upload }} {{ trans("labels.admin.packages.file") }}</p>
                            </div>
                            <div class="card-body">
                                @if($totalFile != 0)
                                    <p class="card-text h5">{{ trans("labels.admin.packages.time_last_upload") }} {{ $lastTimeFile->created_at }}</p>
                                @else
                                    <p class="card-text h5">{{ trans("labels.admin.packages.time_last_upload") }} {{ trans("labels.admin.file.empty") }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 50px">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5> {{ trans('labels.admin.users.list_file') }}</h5>
                            </div>
                            @if(count($files) == 0)
                                <div class="card-body">
                                    <p class="card-text" style="font-size: 20px; color: red">{{ trans('auth.admin.empty') }}</p>
                                </div>
                            @else
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th> {{ trans("labels.admin.index.thead_th1") }} </th>
                                            <th> {{ trans("labels.admin.index.thead_th2") }} </th>
                                            <th> {{ trans("labels.admin.index.thead_th12") }} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($files as $file)
                                            <tr>
                                                <td> {{ $file->id }} </td>
                                                <td> {{ $file->name }} </td>
                                                <td>
                                                    <button type="button" onclick="viewFile({{ $file->id }})" class="btn btn-sm btn-success" data-toggle="modal" data-target="#viewFileInfo">{{ trans("labels.admin.btn.btn_view") }}</button>
                                                    <div class="modal fade" id="viewFileInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" id="viewFileContent" role="document">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {!! $files->appends($_GET)->links("pagination::bootstrap-4") !!}
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script>
        /**
         * View file detail
         * @param id
         */
        function viewFile(id) {
            $.ajax({
                url: '{{ url("/admin/file-detail") }}',
                method: 'get',
                data: {
                    id: id,
                },
                success: function (response) {
                    console.log(response);
                    if(response != null) {
                        $("#viewFileContent").html(response);
                    }
                }
            })
        }
    </script>
@endsection


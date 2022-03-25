@extends('admin.master')
@section('content')
    @include('admin.pages.partials.errors')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ trans('labels.admin.packages.package_edit') }} </h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col md 12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ url('/admin/packages') }}" class="btn btn-primary btn-sm float-right"> {{ trans('labels.admin.btn.btn_back') }} </a>
                            </div>
                            <div class="card-body">

                                <form action="/admin/packages/{{$package->id}}/update" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label> {{ trans("labels.admin.add.form_label1") }} </label>
                                        <input type="text" name="name" class="form-control" value="{{ $package->name }}">
                                        @if ($errors->has('name'))
                                            <p style="height: 0; color: red; margin: 0">
                                                {{ $errors->first('name') }}
                                            </p>
                                            <br>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label> {{ trans("labels.admin.add.form_label2") }} </label><br>
                                        <input type="radio" name="max_file_size" value="{{ trans("labels.admin.add.radio1") }}" @if($package->max_file_size == config("const.package.max_file_size")[0]) checked @endif>
                                        <label> {{ trans("labels.admin.add.radio1") }} </label><br>
                                        <input type="radio" name="max_file_size" value="{{ trans("labels.admin.add.radio2") }}" @if($package->max_file_size == config("const.package.max_file_size")[1]) checked @endif>
                                        <label> {{ trans("labels.admin.add.radio2") }} </label><br>
                                        <input type="radio" name="max_file_size" value="{{ trans("labels.admin.add.radio3") }}" @if($package->max_file_size == config("const.package.max_file_size")[2]) checked @endif>
                                        <label> {{ trans("labels.admin.add.radio3") }} </label><br>
                                        @if ($errors->has('max_file_size'))
                                            <p style="height: 0; color: red; margin: 0">
                                                {{ $errors->first('max_file_size') }}
                                            </p>
                                            <br>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label> {{ trans("labels.admin.add.form_label3") }} </label>
                                        <input type="number" name="max_file_upload" class="form-control" value="{{ $package->max_file_upload }}">
                                        @if ($errors->has('max_file_upload'))
                                            <p style="height: 0; color: red; margin: 0">
                                                {{ $errors->first('max_file_upload') }}
                                            </p>
                                            <br>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"> {{ trans("labels.admin.btn.btn_save") }} </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

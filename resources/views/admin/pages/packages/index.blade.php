@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ trans('labels.admin.packages.bread_crum') }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @include('admin.pages.partials.errors')
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ url("/admin/packages/add") }}" class="btn btn-primary btn-sm float-right"> {{ trans('labels.admin.btn.btn_create') }}</a>
                            </div>
                            @if(count($data) == 0)
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
                                        <th> {{ trans("labels.admin.index.thead_th3") }} </th>
                                        <th> {{ trans("labels.admin.index.thead_th4") }} </th>
                                        <th> {{ trans("labels.admin.index.thead_th5") }} </th>
                                        <th> {{ trans("labels.admin.index.thead_th6") }} </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $package)
                                        <tr>
                                            <td> {{ $package->id }} </td>
                                            <td> {{ $package->name }} </td>
                                            <td> {{ $package->max_file_size }} </td>
                                            <td> {{ $package->max_file_upload }} </td>
                                            <td>
                                                <a href="{{ url("/admin/packages/".$package->id."/edit") }}" class="btn btn-sm btn-success"> {{ trans("labels.admin.btn.btn_edit") }} </a>
                                            </td>
                                            <td>
                                                <form action="{{ url("/admin/packages/".$package->id."/delete") }}" method="POST">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"> {{ trans("labels.admin.btn.btn_delete") }} </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
{{--                                    {!! $editors->appends($_GET)->links() !!}--}}
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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
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
    <div class="container" style="width: 50%;">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Select Package</h4>
                    </div>
                    @if(count($package) == 0)
                        <div class="card-body">
                            <p class="card-text" style="font-size: 20px; color: red">{{ trans('auth.admin.empty') }}</p>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="row">
                                @foreach($package as $package)
                                    <div class="col-6">
                                        <div class="card mb-4 rounded-3 shadow-sm">
                                            <div class="card-header py-3">
                                                <h4 class="my-0 fw-normal">{{ $package->name }}</h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title pricing-card-title">$10<small class="text-muted fw-light">/mo</small></h1>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                    <li>Maximum File: {{ $package->max_file_upload }}</li>
                                                    <li>File Size: {{ $package->max_file_size }}</li>
                                                </ul>
                                                <button type="button" class="w-100 btn btn-lg btn-outline-primary">Select</button>
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
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

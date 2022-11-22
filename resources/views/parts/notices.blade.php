@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="uil uil-check me-2"></i>
        {{ session()->get('success') }}
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="uil uil-exclamation-octagon me-2"></i>
        {{ session()->get('error') }}
    </div>
@endif

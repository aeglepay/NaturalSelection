{{-- Updated for Bootstrap --}}
@extends('layouts.app')

@section('content')
<div class="container" style="height: 72vh">
    <div class="row mt-5">
        <h1 class="col-md-12 mt-5 font-weight-bold text-center mb-5">{{ $title }}</h1>
        
        <div class="col-md-12">
            <h5>Your order is being processed. Thank you for choosing us!</h5>
        </div>
    </div>
</div>
@endsection

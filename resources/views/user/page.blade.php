{{-- Updated for Bootstrap --}}
@extends('layouts.app')

@section('content')
<div class="container" style="min-height: 72vh">
    <div class="row mt-5">
        <h1 class="col-md-12 mt-5 font-weight-bold text-center mb-5">{{ $title }}</h1>
        @isset($page->image)

        <div class="col-md-4">
            <img src="{{ $page->image }}" width="100%">
        </div>
        <div class="col-md-8">
            <article>
                {{ $page->content }}
            </article>
        </div>

        @else

        <div class="col-md-12">
            <article>
                {{ $page->content }}
            </article>
        </div>

        @endisset
    </div>
</div>
@endsection

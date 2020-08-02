{{-- Updated for Bootstrap --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5 mb-5">
        <h1 class="col-md-12 mt-5 font-weight-bold text-center mb-5">Categories</h1>
        @foreach($records as $category)
        <a href="{{ url("categories/{$category->slug}")  }}" class="col-md-4 mb-4 text-center">
            <div class="feature" style="background: url('{{ asset( $category->image ) }}')">
                <h4 class="feature-text text-center text-white px-2">
                    {{ $category->title }}
                </h4>
            </div>
        </a>
        @endforeach
    </div>

    <ul class="uk-pagination uk-margin-large uk-flex-center m-5">
        {{ $records->links() }}
    </ul>
</div>
@endsection

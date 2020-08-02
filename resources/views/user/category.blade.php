{{-- Updated for Bootstrap --}}
@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('js/animation.imgcheckbox.min.css') }}" rel="stylesheet">
<style>
    .btn-group-toggle .btn {
        opacity: 0.5;
    }

    .btn-group-toggle .btn.active {
        opacity: 1;
    }

</style>
@endsection

@section('content')

<div class="container mb-5">
    <div class="row m-5">
        <h1 class="col-md-12 mt-5 font-weight-bold text-center mb-5">{{ $title }}</h1>

        <div class="col-md-4 mb-4">
            <div class="row mb-3">
                <a class="col mr-2 nav-link bg-warning active" id="option-tab" data-toggle="tab" href="#option" role="tab" aria-controls="option" aria-selected="true">
                    <div class="w-100 p-3 text-center">
                        <span data-feather="calendar"></span><br>
                        Frequency
                    </div>
                </a>
                <a class="col ml-2 nav-link bg-primary" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <div class="p-3 text-center">
                        <span data-feather="clock"></span><br>
                        Duration
                    </div>
                </a>
            </div>

            <div class="row">
                <a class="col mr-2 nav-link bg-success" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                    <div class="p-3 text-center">
                        <span data-feather="repeat"></span><br>
                        Cycle
                    </div>
                </a>
                <a class="col ml-2 nav-link bg-dark" id="brands-tab" data-toggle="tab" href="#brands" role="tab" aria-controls="brands" aria-selected="false">
                    <div class="p-3 text-center">
                        <span data-feather="briefcase"></span><br>
                        Brands
                    </div>
                </a>
            </div>
        </div>

        <form class="col-md-7 offset-md-1" action="{{ url('pay') }}" method="POST">
            @csrf
            <input type="hidden" name="order[amount]" value="{{ $record->amount }}">
            <input type="hidden" name="order[fee]" value="{{ $record->fee }}">
            <div class="w-100 pl-4 mb-3">
                <div class="n-chk">
                    <label class="new-control new-radio new-radio-text radio-classic-warning">
                        <input type="radio" class="new-control-input" name="order[option]" value="surprise">
                        <span class="new-control-indicator"></span>
                        <span class="new-radio-content font-weight-bold">Surprise Box</span>
                    </label>
                </div>

                <div class="n-chk">
                    <label class="new-control new-radio new-radio-text radio-classic-warning">
                        <input type="radio" class="new-control-input" name="order[option]" value="choice" checked>
                        <span class="new-control-indicator"></span>
                        <span class="new-radio-content font-weight-bold">Customer Choice</span>
                    </label>
                </div>
            </div>
            <div class="tab-content mb-5 p-2" id="myTabContent">
                <div class="tab-pane fade show active" id="option" role="tabpanel" aria-labelledby="option-tab">
                    <div class="form-group">
                        <label>Frequency of delivery( in a month)</label><br>
                        <div class="btn-group btn-group-toggle mt-2" data-toggle="buttons">
                            <label class="btn btn-warning active">
                                <input type="radio" name="order[frequency]" value="1" checked> Once

                            </label>
                            <label class="btn btn-warning">
                                <input type="radio" name="order[frequency]" value="2"> Twice

                            </label>
                            <label class="btn btn-warning">
                                <input type="radio" name="order[frequency]" value="3"> Thrice

                            </label>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="form-group">
                        <label>Duration of subscription(months)</label><br>
                        <div class="btn-group btn-group-toggle mt-2" data-toggle="buttons">
                            <label class="btn btn-warning active">
                                <input type="radio" name="order[duration]" value="1" checked> 1

                            </label>
                            <label class="btn btn-warning">
                                <input type="radio" name="order[duration]" value="3"> 3

                            </label>
                            <label class="btn btn-warning">
                                <input type="radio" name="order[duration]" value="6"> 6

                            </label>
                            <label class="btn btn-warning">
                                <input type="radio" name="order[duration]" value="12"> 12

                            </label>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="form-group">
                        <label>What is your preffered billing cycle?</label><br>
                        <div class="btn-group btn-group-toggle mt-2" data-toggle="buttons">
                            <label class="btn btn-warning active">
                                <input type="radio" name="order[cycle]" value="monthly" checked> Monthly

                            </label>
                            <label class="btn btn-warning">
                                <input type="radio" name="order[cycle]" value="annually"> Annually

                            </label>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="brands" role="tabpanel" aria-labelledby="brands-tab">
                    <label>Make your preffered selection(s)</label><br>
                    <small>Click on image(s) to select</small>
                    <div class="row mt-2">
                        @foreach($brands as $brand)
                        <div class="col-6 col-md-4">
                            <figure>
                                <div class="figure-content">
                                    <img src="{{ asset( $brand->image ) }}" width="100%">
                                </div>
                                <figcaption>
                                    <span data-feather="check" width="48px" height="48px"></span>
                                </figcaption>
                                <label>
                                    <input type="checkbox" name="order[brands][]" value="{{ $brand->id }}">
                                    {{ $brand->name }}
                                </label>
                            </figure>
                            <h5 class="text-dark text-center">{{ $brand->name }}</h5>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn bg-dark btn-lg btn-block">Proceed to payment</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container mb-5"></div>
<div class="container mb-5"></div>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js" integrity="sha256-ifihHN6L/pNU1ZQikrAb7CnyMBvisKG3SUAab0F3kVU=" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.imgcheckbox.min.js') }}"></script>
<script>
    jQuery(document).ready(function($) {
        $('a[data-toggle="tab"]').click(function(e) {
            var id = $(this).attr('aria-controls');

            $('#' + id).addClass('show active');
            $('div[id!=' + id + ']').removeClass('show active');
        });
    });

    jQuery(document).ready(function($) {
        Holder.run()

        $('figure').imgCheckbox({
            round: false
            , overlayOpacity: 0.1
            , animation: true
        });
    });

</script>
@endsection

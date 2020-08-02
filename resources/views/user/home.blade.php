@extends('layouts.app')

@section('content')
<!-- HERO -->
<div class="mb-2 home-hero" style="height: 81vh; background: url('{{ asset('img/theme/hero.png') }}')">
    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/ieRWbgtDTTc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
</div>

<div class="container-fluid">
    <h1 class="mt-5 font-weight-bold text-center mb-4">How it works</h1>

    <div class="row px-2">
        @foreach($features as $feature)
        <div class="col-md-3 mt-4 text-center">
            <div class="feature" style="background: url('{{ $feature->image }}')">
                <h4 class="feature-text text-center text-white px-2">{{ $feature->title }}</h4>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row px-4">
        <div class="col-md-4 offset-md-4 mt-4 text-center">
            <h1 class="mt-5 font-weight-bold text-center mt-4 mb-4">
                <a href="{{ url('start') }}" class="btn bg-dark btn-lg py-3 px-5 btn-block">
                    Get Started
                </a>
            </h1>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 pr-4">
            <div class="mr-5" uk-scrollspy-class="uk-animation-slide-right" style="">
                <img src="{{ asset('img/theme/dRNvVKQWWJIZhHP2ASps.png') }}" class="el-image" alt="" style="max-height:400px">
            </div>
        </div>

        <div class="col-md-6 mt-5">
            <h2 class="text-left font-weight-bold mb-3">Why become a member?</h2>
            <div class="bg-dark mb-4" style="height: 4px; width: 15%;"></div>
            <h5>
                <ol>
                    <li>Power to choose</li>
                    <li>Wholesale Pricing</li>
                    <li>Freedom from commitment.</li>
                    <li>Access to small businesses and products
                        you wouldn’t normally find</li>
                </ol>
            </h5>
        </div>
    </div>
</div>

<!-- PRICING -->


<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mt-5 pr-4">
            <h2 class="text-left font-weight-bold mb-3">About us</h2>
            <div class="bg-dark mb-4" style="height: 4px; width: 15%;"></div>
            <h5>Natural Selection was founded by Two frustrated guys overwhelmed with the hundreds if not thousands of subscription box choices. We knew there had to be a better way and thus the idea of an exclusive Marketplace that offers crazy discounts, while helping you find exactly what you want, was born.</h5>
        </div>

        <div class="col-md-6">
            <div class="uk-margin uk-text-center uk-scrollspy-inview uk-animation-slide-right" uk-scrollspy-class="uk-animation-slide-right" style="">
                <img src="{{ asset('img/theme/KmgqI08Zv7rkhAAumL31.png') }}" class="el-image" alt="" style="max-height:400px">
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mt-5 pr-4">
            <h2 class="text-left font-weight-bold mb-3">Letter from the founders</h2>
            <div class="bg-dark mb-4" style="height: 4px; width: 15%;"></div>
            <h5>
                <p>Who are We? - Natural Selection was founded by Two frustrated guys overwhelmed with the hundreds if not thousands of subscription box choices. Not to mention that unlesses we searched out smaller companies, the only 3 or 4 we were forced to see were simply the ones with deep enough pockets to keep showing up on our “recommended” page and feeds.</p>

                <p>We had to find a better way , a way to figure out exactly what our options were and then actually give them a chance to find what worked best for us. Thus the idea of an exclusive Marketplace that offers crazy discounts, while helping you find exactly what you want, was born.</p>

                <p>What Is Natural Selection - Put quite simply Natural Selection is Survival of the Fittest (Subscriptions). Like so many others, we got tired of looking for Subscription boxes online, only to find that there’s NO way of telling what’s good and what’s not! So We decided to create a revolutionary way of making sure you get the best of the best, at a lower price, by providing Everyone with the chance to be both informed and confident before committing to a subscription box.</p>

                <p>How We Do It - Natural Selections has created a marketplace which allows our members access to exclusive Pricing in order to test subscription box companies in categories that interest them every month until they find the best of the best. We do this by passing on wholesale subscription box pricing for an ultra low yearly membership.</p>
            </h5>
        </div>

        <div class="col-md-6 pt-5">
            <div class="uk-margin uk-text-center uk-scrollspy-inview uk-animation-slide-right mt-5 pt-5" uk-scrollspy-class="uk-animation-slide-right" style="">
                <img src="{{ asset('img/theme/fcHGQ23bfniO97QVr8Y1.png') }}" class="el-image mt-5 pt-5" alt="" style="max-height:400px">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-5 mb-4 bg-dark">
    <div class="row">
        <div class="col-10 offset-1 col-md-8 offset-md-2 bg-white mt-5 mb-5 text-center">
            <div class="w-100 mt-3 mb-3" style="min-height: 200px">
                <img src="{{ asset('img/theme/nhsSiakIgq9viMzJW1IC.png') }}" class="el-image" alt="" style="max-height: 150px">
                <h2 class="text-center font-weight-bold mt-2">SUBSCRIBE</h2>
            </div>
            <h5>Subscribe to our newsletter and join our community.</h5>
            <form class="p-3 row" method="POST">
                <div class="form-group col-md-6 offset-md-3 justify-content-center">
                    <div class="input-group input-group-lg mb-3">
                        <input type="text" class="form-control" placeholder="Email Address" aria-label="Email Address" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

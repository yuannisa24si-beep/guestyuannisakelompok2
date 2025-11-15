@extends('layout.app')

@section('title', 'About')

@section('content')
<section class="about_section layout_padding">
    <div class="container">

        <div class="row">

            <div class="col-md-6">
                <div class="img-box">
                    <img src="{{ asset('assets/images/about-img.png') }}" alt="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>We Are Feane</h2>
                    </div>

                    <p>
                        We are a modern food service dedicated to bringing delicious meals
                        with the best quality ingredients. Enjoy our menu and experience
                        the taste of fresh and authentic food.
                    </p>

                    <a href="#" class="btn btn-warning mt-3">Read More</a>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection

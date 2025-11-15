@extends('layout.app')

@section('title', 'Home')

{{-- ===================== SLIDER SECTION ===================== --}}
@section('slider')
<section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">

            <div class="carousel-item active">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-7 col-lg-6 ">
                            <div class="detail-box">
                                <h1>Fast Food Restaurant</h1>
                                <p>
                                    Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad
                                    mollitia laborum quam quisquam esse error unde. Tempora ex doloremque,
                                    labore, sunt repellat dolore.
                                </p>
                                <div class="btn-box">
                                    <a href="" class="btn1">Order Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item ">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-7 col-lg-6 ">
                            <div class="detail-box">
                                <h1>Fast Food Restaurant</h1>
                                <p>
                                    Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente
                                    ad mollitia laborum quam quisquam esse error unde.
                                </p>
                                <div class="btn-box">
                                    <a href="" class="btn1">Order Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item ">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-7 col-lg-6 ">
                            <div class="detail-box">
                                <h1>Fast Food Restaurant</h1>
                                <p>
                                    Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente
                                    ad mollitia laborum quam quisquam esse error unde.
                                </p>
                                <div class="btn-box">
                                    <a href="" class="btn1">Order Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container">
            <ol class="carousel-indicators">
                <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                <li data-target="#customCarousel1" data-slide-to="1"></li>
                <li data-target="#customCarousel1" data-slide-to="2"></li>
            </ol>
        </div>

    </div>
</section>
@endsection


{{-- ===================== CONTENT SECTION ===================== --}}
@section('content')

{{-- OFFER SECTION --}}
<section class="offer_section layout_padding-bottom">
    <div class="offer_container">
        <div class="container ">
            <div class="row">

                <div class="col-md-6">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('images/o1.jpg') }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>Tasty Thursdays</h5>
                            <h6><span>20%</span> Off</h6>
                            <a href="">
                                Order Now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('images/o2.jpg') }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>Pizza Days</h5>
                            <h6><span>15%</span> Off</h6>
                            <a href="">
                                Order Now
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


{{-- FOOD MENU SECTION --}}
<section class="food_section layout_padding-bottom">
    <div class="container">

        <div class="heading_container heading_center">
            <h2>Our Menu</h2>
        </div>

        <ul class="filters_menu">
            <li class="active" data-filter="*">All</li>
            <li data-filter=".burger">Burger</li>
            <li data-filter=".pizza">Pizza</li>
            <li data-filter=".pasta">Pasta</li>
            <li data-filter=".fries">Fries</li>
        </ul>

        <div class="filters-content">
            <div class="row grid">

                {{-- Kamu bisa ganti gambar & text sesuai kebutuhan --}}
                <div class="col-sm-6 col-lg-4 all pizza">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('images/f1.png') }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>Delicious Pizza</h5>
                            <p>Veniam debitis quaerat officiis modi velit.</p>
                            <div class="options">
                                <h6>$20</h6>
                                <a href=""><i class="fa fa-shopping-cart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Copy block ini untuk menu lainnya --}}
                {{-- ... dll ... --}}

            </div>
        </div>

        <div class="btn-box">
            <a href="">View More</a>
        </div>

    </div>
</section>


{{-- ABOUT SECTION --}}
<section class="about_section layout_padding">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="img-box">
                    <img src="{{ asset('images/about-img.png') }}" alt="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>We Are Feane</h2>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non ex suscipit, luctus elit vel,
                        placerat est.
                    </p>
                    <a href="">Read More</a>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- BOOK SECTION --}}
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>Book A Table</h2>
        </div>

        <div class="row">

            <div class="col-md-6">
                <form action="">
                    <input type="text" class="form-control mb-2" placeholder="Your Name">
                    <input type="text" class="form-control mb-2" placeholder="Phone Number">
                    <input type="email" class="form-control mb-2" placeholder="Your Email">
                    <select class="form-control nice-select wide mb-2">
                        <option disabled selected>How many persons?</option>
                        <option>2</option><option>3</option><option>4</option><option>5</option>
                    </select>
                    <input type="date" class="form-control mb-2">
                    <button class="btn btn-warning">Book Now</button>
                </form>
            </div>

            <div class="col-md-6">
                <div id="googleMap" style="width:100%; height:300px;"></div>
            </div>

        </div>
    </div>
</section>


{{-- CLIENT SECTION --}}
<section class="client_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>What Says Our Customers</h2>
        </div>

        <div class="carousel-wrap row">
            <div class="owl-carousel client_owl-carousel">

                <div class="item">
                    <div class="box">
                        <div class="detail-box">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                            <h6>Moana Michell</h6>
                        </div>
                        <div class="img-box">
                            <img src="{{ asset('images/client1.jpg') }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="box">
                        <div class="detail-box">
                            <p>
                                Ut enim ad minim veniam, quis nostrud exercitation.
                            </p>
                            <h6>Mike Hamell</h6>
                        </div>
                        <div class="img-box">
                            <img src="{{ asset('images/client2.jpg') }}" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

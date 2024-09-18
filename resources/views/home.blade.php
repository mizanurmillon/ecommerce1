@php 
 $category = DB::table('categories')->where('status',1)->orderBy('category_name','ASC')->get();
 @endphp
@extends('layouts.app')
@section('content')
<div class="page-header text-center" style="background-image: url('{{ asset('public/frontend') }}/assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">My Account<span>{{ Auth::user()->name }}</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('frontend') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Account</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="dashboard">
        <div class="container">
            <div class="row">
                <aside class="col-md-4 col-lg-3">
                    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false">Downloads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-password" role="tab" aria-controls="tab-address" aria-selected="false">Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" id="logout">Sign Out</a>
                        </li>
                    </ul>
                </aside><!-- End .col-lg-3 -->

                <div class="col-md-8 col-lg-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                            <p>Hello <span class="font-weight-normal text-dark">{{ Auth::user()->name }}</span> (<span class="font-weight-normal text-dark">{{ Auth::user()->name }}</span>? <a href="{{ route('logout') }}" id="logout">Log out</a>) 
                            <br>
                            From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your account details</a>.</p>
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                            <p>No order has been made yet.</p>
                            <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                            <p>No downloads available yet.</p>
                            <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                            <p>The following addresses will be used on the checkout page by default.</p>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card card-dashboard">
                                        <div class="card-body">
                                            <h3 class="card-title">Billing Address</h3><!-- End .card-title -->

                                            <p>User Name<br>
                                            User Company<br>
                                            John str<br>
                                            New York, NY 10001<br>
                                            1-234-987-6543<br>
                                            yourmail@mail.com<br>
                                            <a href="#">Edit <i class="icon-edit"></i></a></p>
                                        </div><!-- End .card-body -->
                                    </div><!-- End .card-dashboard -->
                                </div><!-- End .col-lg-6 -->

                                <div class="col-lg-6">
                                    <div class="card card-dashboard">
                                        <div class="card-body">
                                            <h3 class="card-title">Shipping Address</h3><!-- End .card-title -->

                                            <p>You have not set up this type of address yet.<br>
                                            <a href="#">Edit <i class="icon-edit"></i></a></p>
                                        </div><!-- End .card-body -->
                                    </div><!-- End .card-dashboard -->
                                </div><!-- End .col-lg-6 -->
                            </div><!-- End .row -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="tab-password" role="tabpanel" aria-labelledby="tab-address-link">
                            <div class="row">
                                <div class="col-lg-8">
                                    <p>{{ Auth::user()->name }} Change Your Password</p>
                                    <div class="card card-dashboard">
                                        <div class="card-body">
                                           <form action="{{ route('user.password.update') }}" method="post">
                                            @csrf
                                                <div class="form-group">
                                                    <label>Current password</label>
                                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Enter The Current Password">
                                                    @error('current_password')
                                                       <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>New password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Enter The New Password">
                                                    @error('password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm new password</label>
                                                    <input type="password" class="form-control mb-2 @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                                    @error('password_confirmation')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <button type="submit" class="btn btn-outline-primary-2">
                                                    <span>PASSWORD SAVE $ CHANGES</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
                                           </form>
                                        </div><!-- End .card-body -->
                                    </div><!-- End .card-dashboard -->
                                </div><!-- End .col-lg-6 -->
                            </div><!-- End .row -->
                        </div><!-- .End .tab-pane -->
                        @php 
                            $user = DB::table('users')->where('id',Auth::id())->first();
                        @endphp
                        <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <label>Name *</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Email Address*</label>
                                        <input type="email" class="form-control" name='email' value="{{ $user->email }}">
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Address*</label>
                                        <input type="text" class="form-control" name='address' value="{{ $user->address }}">
                                    </div><!-- End .col-sm-6 -->
                                    <label>Photo *</label>
                                    <input type="file" class="form-control" name='avatar' onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                    <input type="hidden" name="old_avatar" value="{{ $user->avatar }}">
                                    <div class="my-2">
                                        <img id="blah" src="{{ asset('public/files/user/'. $user->avatar) }}" width="90" />
                                    </div>
                                </div><!-- End .row -->
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>SAVE CHANGES</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </form>
                        </div><!-- .End .tab-pane -->
                    </div>
                </div><!-- End .col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .dashboard -->
</div><!-- End .page-content -->
@endsection

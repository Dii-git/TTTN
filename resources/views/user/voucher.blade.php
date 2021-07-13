@extends('layouts.post')

@section('content')
<section class="wrapper">
    <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Voucher Post
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img style="height: 200px" src="" alt="">
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="/">Go back</a><br>
                                        <h2>{{ Auth::user()->username }}</h2><br>
                                        <h3>Your Voucher: {{}}</h3><br>
                                        <br><br>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
            </div>
        </div>
        
    </div>
</section>
@endsection



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
                        User Profile
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal bucket-form" role="form" action="/update_profile" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="col-sm-3 control-label">User Name</label>
                                <div class="col-sm-6">
                                    <input class="form-control" value="{{ Auth::user()->username }}" name="username"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input class="form-control" value="{{ Auth::user()->email }}" name="useremail"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <center><button type="submit" name="updateUser" class="btn btn-info">Update your Profile</button></center>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>   
@endsection

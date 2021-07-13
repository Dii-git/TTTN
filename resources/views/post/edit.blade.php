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
                            Edit Post
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <div class="row">
                                    <form action="/update_post" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }} 
                                        <div class="col-sm-6">
                                            <img style="height: 200px" src="../images/{{$posts->image}}" alt="">
                                            <input type="file" name="img" id="img">
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="/">Go back</a><br>
                                            <h3>Description : </h3>
                                            <textarea type="text" style="resize: none" rows="5" value="{{$posts->description}}" name="desc_post" class="form-control">{{$posts->description}}</textarea>
                                            <br>
                                            <br><br>
                                            <button type="submit" name="updatePost" class='btn btn-warning'>Update Post</button><br><br>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </section>
            </div>
        </div>
        
    </div>
</section>
@endsection



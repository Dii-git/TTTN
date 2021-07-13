@extends('layouts.master')

@section('content')
<!--main content start-->
<section class="wrapper">
    <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit Category
                        </header>
                        <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                        ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="/save_edit_cate/{id}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" value="{{$categories['cate_name']}}">
                                    </div>
                                    
                                    <button type="submit" name="editcate" class="btn btn-info">Edit</button>
                                </form>
                            </div>

                        </div>
                    </section>
            </div>
        </div>
    </div>
</section>
@endsection
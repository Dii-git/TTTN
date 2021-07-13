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
                            Add Category
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
                                <form role="form" action="/save_cate" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Enter category name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Status</label>
                                        <select name="status" class="form-control m-bot15">
                                            <option value="0">Hide</option>
                                            <option value="1">Display</option>
                                        </select>
                                        
                                    </div>
                                    
                                    <button type="submit" name="addcate" class="btn btn-info">Add</button>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
</section>
@endsection

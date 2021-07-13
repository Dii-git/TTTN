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
                            Add Voucher
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
                                <form role="form" action="/save_voucher" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Voucher Name</label>
                                        <input type="text" name="vou_name" class="form-control" id="exampleInputEmail1" placeholder="Enter category name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Voucher Enabled</label>
                                        <select name="vou_en" id="exampleInputFile">
                                            <option value="0">Unenabled</option>
                                            <option value="1">Enabled</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Voucher Quantity</label>
                                        <input type="number" name="vou_qu" id="exampleInputFile" value="0">
                                    </div>
                                    <button type="submit" name="addvoucher" class="btn btn-info">Add</button>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
</section>
@endsection

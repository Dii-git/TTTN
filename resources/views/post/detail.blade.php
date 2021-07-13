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
                            Detail Post
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <div class="row">
                                    <form action="/create_voucher" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }} 
                                        @foreach($posts as $detail)
                                        <div class="col-sm-6">
                                            <img style="height: 200px" src="../images/{{$detail->image}}" alt="">
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="/">Go back</a><br>
                                            <h2>{{ $detail->user->username }}</h2><br>
                                            <h3>Description : {{$detail->description}}</h3><br>
                                            <h3>View : {{$detail->view}}</h3><br>
                                            <input type='hidden' name='post_id' value="{{$detail->id}}">
                                            <br><br>
                                            @if(Auth::user()->id == $detail->user->id)
                                                @if($detail->voucher_enabled == 1)
                                                    <select name="voucher" class="form-control m-bot15">
                                                        <option disabled selected>-- Voucher --</option>
                                                        <?php
                                                            $db = mysqli_connect("localhost","root","123456","training");

                                                            if(!$db)
                                                            {
                                                                die("Connection failed: " . mysqli_connect_error());
                                                            }
                                                            $records = mysqli_query($db, "SELECT id,voucher_name From vouchers");  // Use select query here 

                                                            while($data = mysqli_fetch_array($records))
                                                            {
                                                                echo "<option value='". $data['id'] ."'>" .$data['voucher_name'] ."</option>";  // displaying data in option menu
                                                            }	
                                                        ?>
                                                    </select> <br>
                                                    <button type="submit" name="getCode" class='btn btn-warning'>Get your voucher code</button><br><br>         
                                                @else
                                                    @foreach($detail->voucherissue as $voucherissue)
                                                        Voucher: {{ $voucherissue->voucher_code }}
                                                    @endforeach    
                                                @endif
                                            @endif
                                        </div>
                                        @endforeach
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



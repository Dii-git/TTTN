@extends('layouts.post')

@section('content')
<section class="wrapper">
    <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row new-post">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            What do you have to say?
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
                                <form role="form" action="/create_post" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}                                    
                                    <div class="form-group">
                                        <textarea type="text" style="resize: none" rows="5" name="desc_post" class="form-control" id="new-post" placeholder="Your Post"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="img" id="img" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="voucher_id" value="0"></input>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="view_post" value="0"></input>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="voucher_enabled" value="0"></input>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="voucher_quantity" value="0"></input>
                                    </div>
                                    <button type="submit" name="createPost" class="btn btn-info">Create Post</button>
                                    <input type="hidden" value="{{Session::token()}}" name="_token"></input>
                                </form>
                            </div>

                        </div>
                    </section>
            </div>
        </div>
        <div class="row post">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            What another people say...
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @foreach ($posts as $item)
                                    
                                        <div class="form-group">
                                            <p>{{ $item->user->username }}</p>
                                        </div>
                                        <!-- <div class="form-group">
                                            <p>Time</p>
                                        </div> -->
                                        <div class="form-group">
                                            <p>{{$item['description']}}</p>
                                        </div>
                                        <div class="form-group">
                                            <a href="/detail/{{$item['id']}}"><img src="images/{{$item['image']}}" style="height: 350px;"></a>
                                        </div>
                                        <div class="form-group interaction">
                                            <span style="font-size: 15px; color: blue;" class="fa-thumbs-style fa fa-eye"> {{$item['view']}} </span>
                                            @if(Auth::user()->id == $item->user->id)
                                               | <a href="/edit_post/{{$item['id']}}"><span style="font-size: 15px; color: yellow;" class="fa-thumbs-style fa fa-pencil-square-o"></span></a>
                                               | <a href="/delete_post/{{$item['id']}}" method="POST" enctype="multipart/form-data"><span style="font-size: 15px; color: red;" class="fa-thumbs-style fa fa-trash"></span></a>
                                            @endif
                                        </div> <br><br>
                                        
                                    @endforeach   
                                    
                                </form>
                                
                            </div>
                        </div>
                    </section>
            </div>
        </div>
    </div>
</section>
@endsection

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
                            My Post
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            <form role="form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                    @foreach ($posts as $item)
                                        @if(Auth::user()->id == $item->user->id)
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
                                            <span style="font-size: 15px; color: blue;" class="fa-thumbs-style fa fa-eye"> {{$item['view']}} </span> |
                                            <a href="#"><span style="font-size: 15px; color: yellow;" class="fa-thumbs-style fa fa-pencil-square-o"></span></a> 
                                            | <a href="/delete_post/{{$item['id']}}" method="POST" enctype="multipart/form-data"><span style="font-size: 15px; color: red;" class="fa-thumbs-style fa fa-trash"></span></a>
                            
                                            
                                            
                                        </div>
                                        @endif <br><br>
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
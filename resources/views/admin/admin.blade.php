@extends('layouts.master')

@section('content')
<section class="wrapper">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                List of users who did not log in a day ago
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-3 m-b-xs">
                    <form  role="form" action="/add-email-queue" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @foreach($users as $item)
                            @foreach($item->emails as $emails)
                                @if($emails->email_status == 0)
                                    <button type="submit" class="btn btn-warning">Add to Queue</button>   
                                @endif
                            @endforeach
                        @endforeach
                    </form>
                </div>
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-3 m-b-xs">
                    <!-- <label for="filter" class="col-sm-2 col-form-label">Filter</label>
                    <form action="/filter" method="GET" style="margin-top: 20px;">
                    
                    <button class="btn btn-sm btn-default">Apply</button> 
                    </form>                -->
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <!-- <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                    </div> -->
                </div>
            </div>
            <div class="table-responsive">
            <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th style="width:20px;">
                    <label class="i-checks m-b-none">
                        <input type="checkbox"><i></i>
                    </label>
                    </th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Last Login</th>
                    <th>Status</th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $item)
                    <tr>
                    @if($item['last_login'] < $nows | $item['last_login'] == $nows && $item['level'] == 0)
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$item['username']}}</td>
                        <td>{{$item['email']}}</td>
                        <td><span class="text-ellipsis">{{$item['last_login']}}</span></td>
                        <td>
                            @foreach($item->emails as $emails)
                                @if($emails->email_status == 1)
                                    DONE
                                @else
                                    SPENDING
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->emails as $emails)
                                @if($emails->email_status == 0)
                                    <form  role="form" action="/sendmail/{{$item['id']}}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-warning">Send Mail</button>   
                                    </form>
                                @else
                                    DONE
                                @endif
                            @endforeach
                            
                        </td>
                    @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">    
                List of posts with no views
            </div>
            <div class="table-responsive">
            <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th style="width:20px;">
                    <label class="i-checks m-b-none">
                        <input type="checkbox"><i></i>
                    </label>
                    </th>
                    <th>User Name</th>
                    <th>Image</th>
                    <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($posts as $item)
                    <tr>
                        @if($item['view'] == 0)
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$item->user->username}}</td>
                            <td><img src="images/{{$item['image']}}" style="height: 50px;"></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            
            </div>
        </div>
    </div>
</section>
@endsection

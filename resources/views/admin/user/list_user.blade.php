@extends('layouts.master')

@section('content')
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      User Table
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
            <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
            </div>
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
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            <!-- @if ($users->count() == 0)
            <tr>
                <td colspan="5">No users to display.</td>
            </tr>
            @endif -->
          @foreach ($users as $item)
            <tr>
            @if($item['level'] == 0)
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>{{$item['username']}}</td>
                <td>{{$item['email']}}</td>
                <td>{{$item['last_login']}}</span></td>
                <td>
                  <form  role="form" action="/delete_user/{{$item->id}}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger">Delete</button>   
                  </form>
                </td>
                @endif
            </tr>
          @endforeach
        </tbody>
      </table>
      
    </div>
    <!-- <footer class="panel-footer">
      <div class="row">
      {!! $users->appends(Request::except('page'))->render() !!}
        <p>
            Displaying {{$users->count()}} of {{ $users->total() }} users(s).
        </p>
      </div>
    </footer> -->
  </div>
</div>
</section>
@endsection

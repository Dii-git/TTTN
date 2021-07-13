@extends('layouts.master')

@section('content')
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Posts Table
    </div>
    <div class="row w3-res-tb">
        <div class="col-sm-3 m-b-xs">
            <label for="filter" class="col-sm-2 col-form-label">Filter</label>
            <form action="/filter" method="GET" style="margin-top: 20px;">
              <select name="category" class="form-control m-bot15">
                  <option disabled selected>-- Voucher --</option>
                  <?php
                      // $db = mysqli_connect("localhost","root","123456","training");

                      // if(!$db)
                      // {
                      //     die("Connection failed: " . mysqli_connect_error());
                      // }
                      // $records = mysqli_query($db, "SELECT cate_name From categories");  // Use select query here 

                      // while($data = mysqli_fetch_array($records))
                      // {
                      //     echo "<option value='". $data['cate_name'] ."'>" .$data['cate_name'] ."</option>";  // displaying data in option menu
                      // }	
                  ?> 
              </select> <br>
              <button class="btn btn-sm btn-default">Apply</button> 
            </form>               
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
            <th>Username</th>
            <th>Description</th>
            <th>Image</th>
            <th>Voucher</th>
            <th>Voucher code</th>
            <th>Voucher Enabled</th>
            <th>View</th>
            <!-- <th>Category</th> -->
            <th>Date</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @if ($posts->count() == 0)
            <tr>
                <td colspan="5">No posts to display.</td>
            </tr>
            @endif
          @foreach ($posts as $item)
            <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>{{$item->user->username}}</td>
                <td>{{$item['description']}}</td>
                <td><img src="images/{{$item['image']}}" style="height: 50px;"></td>
                <td>
                  @if($item->voucher_id == 0)
                    NULL
                  @else
                    {{$item->voucher->voucher_name}}
                  @endif
                </td>
                <td>
                  @foreach($item->voucherissue as $voucherissue)
                     {{ $voucherissue->voucher_code }}
                  @endforeach  
                </td>
                <td>
                  @if($item->voucher_enabled == 1)
                    <a href="/unenabled_post/{{$item['id']}}"><span style="font-size: 15px; color: blue;">Enabled</span></a>
                  @else
                    <a href="/enabled_post/{{$item['id']}}"><span style="font-size: 15px; color: red;">Unenabled</span></a>
                  @endif
                </td>
                <td><span class="text-ellipsis">{{$item['view']}}</span></td>
                <td><span class="text-ellipsis">{{$item['updated_at']}}</span></td>
                <td>
                  <form  role="form" action="/delete_post/{{$item->id}}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger">Delete</button>   
                  </form>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      
    </div>
    <footer class="panel-footer">
      <div class="row">
      {!! $posts->appends(Request::except('page'))->render() !!}
        <p>
            Displaying {{$posts->count()}} of {{ $posts->total() }} post(s).
        </p>
      </div>
    </footer>
  </div>
</div>
</section>
@endsection

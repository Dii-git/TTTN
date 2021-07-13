@extends('layouts.master')

@section('content')
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Voucher Table
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
            <th>Voucher Name</th>
            <th>Voucher Enabled</th>
            <th>Voucher Quantity</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @if ($vouchers->count() == 0)
            <tr>
                <td colspan="5">No vouchers to display.</td>
            </tr>
            @endif
          @foreach ($vouchers as $item)
            <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>{{$item['voucher_name']}}</td>
                <td>
                  @if($item->voucher_enabled == 1)
                    <a href="/unenabled_voucher/{{$item['id']}}"><span style="font-size: 15px; color: blue;">Enabled</span></a>
                  @else
                  <a href="/enabled_voucher/{{$item['id']}}"><span style="font-size: 15px; color: red;">Unenabled</span></a>
                  @endif
                </td>
                <td>{{$item['voucher_quantity']}}</td>
                
                <td>
                  <form  role="form" action="/delete_voucher/{{$item->id}}" method="POST" enctype="multipart/form-data">
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
      {!! $vouchers->appends(Request::except('page'))->render() !!}
        <p>
            Displaying {{$vouchers->count()}} of {{ $vouchers->total() }} voucher(s).
        </p>
      </div>
    </footer>
  </div>
</div>
</section>
@endsection

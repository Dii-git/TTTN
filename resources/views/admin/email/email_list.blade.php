@extends('layouts.master')

@section('content')
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Email Table
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-3 m-b-xs">
        @foreach($emails as $item)
          @if($item->email_status == 0)
            <form  role="form" action="/send-email-queue" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">SEND</button>   
            </form>
          @endif
        @endforeach
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
            <th>Email</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($emails as $item)
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>{{$item->user->username}}</td>
                    <td>{{$item->user->email}}</td>
                    <td>
                        @if($item->email_status == 0)
                            PENDING
                        @elseif($item->email_status == 1)
                            DONE
                        @endif
                    </td>
                </tr>
          @endforeach
        </tbody>
      </table>
      
    </div>
    <footer class="panel-footer">
      
    </footer>
  </div>
</div>
</section>
@endsection

@extends('layouts.master')

@section('content')
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Category Table
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
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
            <th>Category Name</th>
            <th>Status</th>
            <th>Date</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($category as $item)
            <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>{{$item['cate_name']}}</td>
                <td><span class="text-ellipsis">
                  <?php
                    if($item['cate_status'] == 0)
                    { ?>
                      <a href="/active_cate/{{$item['id']}}"><span style="font-size: 28px; color: red;" class="fa-thumbs-style fa fa-thumbs-down"></span></a>
                    <?php
                    }
                    else {
                    ?>
                      <a href="/unactive_cate/{{$item['id']}}"><span style="font-size: 28px; color: blue;" class="fa-thumbs-style fa fa-thumbs-up"></span></a>
                    <?php }
                  ?>
                </span></td>
                <td><span class="text-ellipsis">Date</span></td>
                <td>
                    <a href="/edit_cate/{{$item->id}}"><button type="button" class="btn btn-warning">Edit</button></a>
                </td>
                <td>
                  <form  role="form" action="/delete_cate/{{$item->id}}" method="POST" enctype="multipart/form-data">
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
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
</section>
@endsection

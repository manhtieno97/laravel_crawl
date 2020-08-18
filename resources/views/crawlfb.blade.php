<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="box-body">
            @if (Session::has('success'))
              <p class="alert alert-success">{{Session::get('success')}}</p>
            @endif
            @if (Session::has('error'))
              <p class="alert alert-danger">{{Session::get('error')}}</p>
            @endif
            @yield('content')
          </div>
          <div class="panel panel-info">
          	<div class="panel-heading">
          		<h3 class="panel-title">Crawl fb</h3>
          	</div>
          	<div class="panel-body">
          		<form action="{{route('postCrwal')}}" method="POST" class=" row" role="form">
				@csrf
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="">
						<label>  Fanpage</label>
						<input type="text" class="form-control" name="fanpage" value="{{ old('fanpage') }}" placeholder="Nhập địa chỉ fanpage">
					</div>
					<div class="">
						<label>Access Token</label>
						<input type="text" class="form-control" name="access_token" value="{{ old('access_token') }}" placeholder="Nhập access token">
					</div>
					 <div class="row">
					 	<div class="col-md-6 col-sm-6 col-xs-12">
					 		<label for="">Giới hạn</label>
				            <select name="limit"  class="form-control " >
				              <option value="">--Chọn giới hạn--</option>
				         
				              <option value="10">10</option>
				              <option value="20">20</option>
				              <option value="50">50</option>
				              <option value="100">100</option>
				             
				            </select>
					 	</div>
					 	<div class="col-md-6 col-sm-6 col-xs-12">
					 		<label for="">Time out</label>
				            <select name="timeout"  class="form-control " >
				              <option value="">--Chọn time out--</option>
				         
				              <option value="10">10</option>
				              <option value="15">15</option>
				              <option value="20">20</option>
				              <option value="25">25</option>
				             
				            </select>
					 	</div>
				        
				      </div>
				      <p></p>
					<button type="submit" class="btn btn-primary ">Submit</button>
				</div>
				

				</form>
          	</div>
          </div>
		
		<?php if (!empty($body)): ?>
			<?php dd($body);die(); ?>
		<?php endif ?>
		
	</div>
</body>
</html>
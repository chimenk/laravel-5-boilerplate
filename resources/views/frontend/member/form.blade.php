@extends('frontend.layouts.app')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-user"></i> Pendaftaran Member Baru
			</div>
			{{ Form::open(['route' => 'frontend.member.store']) }}
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>RFID Code</label>
							<input type="text" name="rfid" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="name" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" name="address" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Telepon / HP</label>
							<input type="text" name="phone" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Paket Member</label>
							<input type="text" name="member_type" class="form-control">
							<select class="form-control" name="member_type">
								@foreach($plans as $plan)
									<option value="{{ $plan->id }}">{{ $plan->name.' - Rp. '.number_format($plan->price) }}</option>
								@endforeach
							</select>
							
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-primary btn-lg">Daftar</button>
			</div>
		</div>
			{{ Form::close() }}
	</div>
</div>
@stop
@extends('frontend.layouts.app')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-user"></i> Pendaftaran Member Baru
			</div>
				{{ Form::model($member, ['route' => ['frontend.member.update', $member->id]]) }}
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>RFID Code</label>
							<input type="text" name="rfid" class="form-control" value="{{ $member->rfid }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="name" class="form-control" value="{{ $member->name }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" name="address" class="form-control" value="{{ $member->address }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Telepon / HP</label>
							<input type="text" name="phone" class="form-control" value="{{ $member->phone }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Paket Member</label>
							<input type="text" name="member_type" class="form-control" value="{{ $member->member_type }}">
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-primary btn-lg">Ubah Data</button>
			</div>
		</div>
			{{ Form::close() }}
	</div>
</div>
@stop
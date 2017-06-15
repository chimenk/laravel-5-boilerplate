@extends('backend.layouts.app')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-user"></i> Buat Jenis Tiket Baru
			</div>
			{{ Form::model($plan, ['route' => ['admin.ticket.update', $plan->id]]) }}
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama Tiket</label>
							<input type="text" name="name" class="form-control" value="{{ $plan->name }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Harga</label>
							<input type="text" name="price" class="form-control" value="{{ $plan->price }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Penggunaan Valid</label>
							<input type="text" name="valid_for" class="form-control" value="{{ $plan->valid_for }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Tanggal Kadaluarsa</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="expired_at" class="form-control pull-right" id="datepicker" value="{{ $plan->expired_at }}">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-primary btn-lg">Buat</button>
			</div>
		</div>
			{{ Form::close() }}
	</div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('#datepicker').datepicker({
			autoclose: true,
			format: 'yyyy/mm/dd'
		});
	});
</script>
@endpush
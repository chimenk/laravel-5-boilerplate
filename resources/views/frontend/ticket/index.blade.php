@extends('frontend.layouts.app')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-home"></i> Tiket Umum
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<label>Jumlah Tiket :</label>
							<input type="text" name="jml_tiket" class="form-control input-lg" id="jml" autofocus>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							<label>Total yang harus dibayar :</label>
							{{-- <input type="text" class="form-control input-lg" id="total" readonly=""> --}}
							<div id="total">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button class="btn btn-lg btn-primary" id="cetak">Cetak Tiket</button>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div style="width: 300px;height: 300px;" id="qrc">
					
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#jml').on('keyup', function() {
				var a = $(this).val() * 20000;
				$('#total').html('Rp. ' + a.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
				$('#total').css({
					'font-weight': 'bolder',
					'font-size': '34px'
				});
			})
			$('#cetak').on('click', function() {
				// var el = kjua({text: 'hello!'});
				// $('#qrc').html(el);
				var jml = $('#jml').val();
				$.ajax({
					url: '{{ url('ticket/print')}}',
					type: 'POST',
					data: {jml: jml},
				})
				.done(function(result) {
					console.log(result);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			});
		});
	</script>
@endpush
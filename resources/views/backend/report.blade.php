@extends ('backend.layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-book"></i> Laporan
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Cetak Laporan :</label>
							<select class="form-control" id="interval">
								<option>-- Pilih waktu --</option>
								<option value="1">Harian</option>
								<option value="2">Mingguan</option>
								<option value="3">Bulanan</option>
								<option value="4">Waktu Tertentu</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group dt-daily">
							<label>Tanggal:</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="daily" class="form-control pull-right" id="datepicker">
							</div>
						</div>
						<div class="form-group dt-int">
							<label>Tanggal Awal:</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="interval1" class="form-control pull-right" id="datepicker1">
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group dt-int">
							<label>Tanggal Akhir:</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="interval2" class="form-control pull-right" id="datepicker2">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<button class="btn btn-primary" id="cetak">Cetak</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.dt-daily, .dt-int').hide();
		$("#interval").on('change', function() {
			var a = $(this).val();
			if(a == 1){
				$('.dt-daily').show();
				$('.dt-int').hide();
			}else if(a == 4){
				$('.dt-daily').hide();
				$('.dt-int').show();
			}else{
				$('.dt-daily, .dt-int').hide();
			}
		});
		$('#datepicker, #datepicker1, #datepicker2').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd'
		});
		$('#cetak').on('click', function() {
			var pi = $('#interval').val();
			var tgl = $('#datepicker').val();
			var tgl1 = $('#datepicker1').val();
			var tgl2 = $('#datepicker2').val();
			if(pi ==1){
				$.ajax({
					url: '{{ url('admin/report/create')}}',
					type: 'POST',
					data: {tipe: pi, date: tgl},
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
				
			}else if(pi == 4){
				$.ajax({
					url: '{{ url('admin/report/create')}}',
					type: 'POST',
					data: {tipe: pi, date1: tgl1, date2: tgl2},
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
			}else if(pi == 2){

			}else if(pi == 3){

			}
		});
	});
</script>
@endpush
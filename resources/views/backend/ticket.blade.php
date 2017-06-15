@extends('backend.layouts.app')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-ticket"></i> Daftar Harga Tiket & Member
				<a class="btn btn-primary btn-sm pull-right" href="{{ url('admin/ticket/create') }}">Tambah Data</a>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
                <table id="tickets-table" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Jenis Tiket</th>
                        <th>Harga</th>
                        <th>Pemakaian Valid</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
			</div>
		</div>
	</div>
</div>
@stop

@push('scripts')
{{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}

    <script>
        $(function() {
            $('#tickets-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("frontend.ticket.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price', sortable: false},
                    {data: 'valid_for', name: 'valid_for', searchable: false, sortable: false},
                    {data: 'expired_at', name: 'expired_at'},
                    {data: null, searchable: false, orderable: false}
                ],
                'createdRow': function ( row, data, index ){
		            if(data.name == 'umum'){
		            	var a = '<a href="ticket/'+data.id+'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
		            }else{
		            	var a = '<a href="ticket/'+data.id+'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;<button type="submit" id="delete" ticket_id="'+data.id+'" ticket_name="'+data.name+'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>';
		            }
		            $('td', row).eq(4).html(a);
		        },
                order: [[3, "asc"]],
                searchDelay: 500
            });
        });
        $(document).on('click', '#delete', function() {
	        var ticket_id = $(this).attr('ticket_id');
	        var ticket_name = $(this).attr('ticket_name');
	        swal({
	            title: "Delete Ticket ? ",
	            text: "Delete Ticket : " + ticket_name + " ?",
	            type: "warning",
	            showCancelButton: true,
	            confirmButtonColor: "#DD6B55",
	            confirmButtonText: "Delete",
	            closeOnConfirm: true },
	            function (){
	                var value = {
	                    ticket_id: ticket_id,
	                    "_token": "{{ csrf_token() }}"
	                };
	                $.ajax(
	                {
	                    url: "{{ url('admin/ticket/delete') }}/" + ticket_id,
	                    type: "DELETE",
	                    data: value,
	                    success: function(data, textStatus, jqXHR)
	                    {
	                        swal("Success!", 'Sukses menghapus data ticket', "success");
	                        var table = $('#tickets-table').DataTable();
	                        table.ajax.reload( null, false );
	                    },
	                    error: function(jqXHR, textStatus, errorThrown)
	                    {
	                        swal("Error!", textStatus, "error");
	                    }
	                });
	        });
	    });
    </script>
@endpush
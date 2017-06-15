@extends('frontend.layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-home"></i> Daftar Member
				<a class="btn btn-sm btn-primary pull-right" href="{{ route('frontend.member.create') }}">Add</a>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
	                <table id="members-table" class="table table-condensed table-hover" style="width: 100%;">
	                    <thead>
	                        <tr>
	                            <th>RFID</th>
	                            <th>Nama</th>
	                            <th>Alamat</th>
	                            <th>Telepon</th>
	                            <th>Tipe Membership</th>
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
            $('#members-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("frontend.member.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'rfid', name: 'rfid'},
                    {data: 'name', name: 'name', sortable: false},
                    {data: 'address', name: 'address', searchable: false, sortable: false},
                    {data: 'phone', name: 'phone'},
                    {data: 'member_type', name: 'member_type'},
                    {data: null, searchable: false, orderable: false}
                ],
                'createdRow': function ( row, data, index ){
		            // Detail
		            $('td', row).eq(5).html('<a href="member/'+data.id+'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;<button type="submit" id="delete" member_id="'+data.id+'" member_name="'+data.name+'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>');
		        },
                order: [[3, "asc"]],
                searchDelay: 500
            });
        });
        $(document).on('click', '#delete', function() {
	        var member_id = $(this).attr('member_id');
	        var member_name = $(this).attr('member_name');
	        swal({
	            title: "Delete Member ? ",
	            text: "Delete Member : " + member_name + " ?",
	            type: "warning",
	            showCancelButton: true,
	            confirmButtonColor: "#DD6B55",
	            confirmButtonText: "Delete",
	            closeOnConfirm: true },
	            function (){
	                var value = {
	                    member_id: member_id,
	                    "_token": "{{ csrf_token() }}"
	                };
	                $.ajax(
	                {
	                    url: "{{ url('member/delete') }}/" + member_id,
	                    type: "DELETE",
	                    data: value,
	                    success: function(data, textStatus, jqXHR)
	                    {
	                        swal("Success!", 'Sukses menghapus data member', "success");
	                        var table = $('#members-table').DataTable();
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
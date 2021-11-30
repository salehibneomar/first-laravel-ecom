@extends('backend.layout')

@section('content')

<div class="col-12">

    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">All Brands</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            
                <table id="brand-table" class="table table-bordered table-striped dataTable " role="grid" >
                    
                    <thead>
                        <tr>
                            <th style="width: 5%">#ID</th>
                            <th>Name</th>
                            <th style="width: 15%">Image</th>
                            <th style="width: 15%">Created</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    
                </table>
            </div>    
        </div>
        <!-- /.box-body -->
    </div>

</div>

@endsection

@section('extraScripts')

    <script>
         
        $(document).ready(function(){
            var table = $('#brand-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('brand.all') }}",
              columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
              "order": [[ 0, "desc" ]],
              "lengthMenu": ["5", "10", "50", "100"]
          });

          $('tbody').on('click', '.brand-delete', function(e){
              e.preventDefault();
              let link = $(this).attr('href');
              Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete'
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });

          });

        });

    </script>

@endsection
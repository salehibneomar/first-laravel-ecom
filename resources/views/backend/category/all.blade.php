@extends('backend.layout')

@section('content')

<div class="col-12">

    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">All Categories</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            
                <table id="category-table" class="table table-bordered table-striped dataTable " role="grid" >
                    
                    <thead>
                        <tr>
                            <th style="width: 5%">#ID</th>
                            <th>Name</th>
                            <th style="width: 5%">Status</th>
                            <th>Branch of</th>
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
            var table = $('#category-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('category.all') }}",
              columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'status', name: 'status'},
                {data: 'parent', name: 'parent', orderable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
              "order": [[ 0, "asc" ]],
              "lengthMenu": ["5", "10", "50", "100"]
          });

          $('tbody').on('click', '.category-delete', function(e){
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
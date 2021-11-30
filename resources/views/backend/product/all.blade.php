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
            
                <table id="product-table" class="table table-bordered table-striped dataTable " role="grid" >
                    
                    <thead>
                        <tr>
                            <th style="width: 5%">#ID</th>
                            <th style="width: 10%">Image</th>
                            <th>Title</th>
                            <th style="width: 5%">Price</th>
                            <th style="width: 5%">Code</th>
                            <th style="width: 2%">Qty</th>
                            <th style="width: 5%">Brand</th>
                            <th style="width: 5%">Category</th>
                            <th style="width: 5%">Status</th>
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
            var table = $('#product-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('product.all') }}",
              columns: [
                {data: 'id', name: 'id'},
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'title', name: 'title'},
                {data: 'price', name: 'price'},
                {data: 'code', name: 'code'},
                {data: 'quantity', name: 'quantity'},
                {data: 'brand', name: 'brand'},
                {data: 'category', name: 'category'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
              "order": [[ 0, "desc" ]],
              "lengthMenu": ["5", "10", "50", "100"]
          });

          $('tbody').on('click', '.product-delete', function(e){
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
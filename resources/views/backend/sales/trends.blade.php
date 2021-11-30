@extends('backend.layout')

@section('content')

<div class="col-12">

    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Product Trends</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            
                <table id="trends-table" class="table table-bordered table-striped dataTable " role="grid" >
                    
                    <thead>
                        <tr>
                            <th style="width: 5%">#ID</th>
                            <th style="width: 10%">Image</th>
                            <th >Name</th>
                            
                            <th style="width: 10%">Code</th>
                            <th style="width: 10%">Qty (Present)</th>
                            <th style="width: 10%">Sold qty</th>
                            <th style="width: 10%">Action</th>
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
            var table = $('#trends-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('sales.trends') }}",
              columns: [
                {data: 'product_id', name: 'product_id'},
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'code', name: 'code'},
                {data: 'present_qty', name: 'present_qty'},
                {data: 'total_sold_qty', name: 'total_sold_qty'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
              "order": [[ 5, "desc" ]],
              "lengthMenu": ["5", "10", "50", "100"]
          });


        });

    </script>

@endsection
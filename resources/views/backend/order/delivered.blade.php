@extends('backend.layout')

@section('content')

<div class="col-12">

    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">All Delivered Orders</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            
                <table id="order-table" class="table table-bordered table-striped dataTable" role="grid" >
                    
                    <thead>
                        <tr>
                            <th style="width: 5%">#TrxID</th>
                            <th style="width: 5%">Phone</th>
                            <th style="width: 5%">Amount</th>
                            <th style="width: 5%">City</th>
                            <th style="width: 5%">Method</th>
                            <th style="width: 5%">DateTime</th>
                            <th style="width: 5%">User</th>
                            <th style="width: 5%">Action</th>
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
            var table = $('#order-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('orders.delivered') }}",
              columns: [
                {data: 'transaction_id', name: 'transaction_id'},
                {data: 'phone', name: 'phone'},
                {data: 'amount', name: 'amount'},
                {data: 'city', name: 'city'},
                {data: 'payment_method', name: 'payment_method'},
                {data: 'created_at', name: 'created_at'},
                {data: 'user', name: 'user'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
              "order": [[ 5, "desc" ]],
              "lengthMenu": ["5", "10", "50", "100"]
          });

        });
    </script>

@endsection
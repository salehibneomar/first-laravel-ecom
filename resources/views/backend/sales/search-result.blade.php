@extends('backend.layout')

@section('content')

<div class="col-12">

    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Search Result</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="mb-4 px-3">
                <h4 class="badge badge-info" style="font-size: 11pt !important;"><b>Total Earning: ৳{{ number_format($total_earning) }}</b> ( {{ $from_date.' <=> '.$to_date }} )
                </h4>
            </div>
            <div class="table-responsive">
            
                <table id="search-result-table" class="table table-bordered table-striped dataTable " role="grid" >

                    <thead>
                        <tr>
                            <th style="width: 10%">TrxID</th>
                            <th style="width: 5%">Method</th>
                            <th style="width: 5%">Order Date</th>
                            <th style="width: 5%">Amount</th>
                            <th style="width: 2%">Total Items</th>
                            <th style="width: 5%">Delivery Date</th>
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
            var table = $('#search-result-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                  type: 'GET',
                  data: {
                      'from' : '{{ $from_date }}',
                      'to' : '{{ $to_date }}'
                  },
                  url : "{{ route('sales.search') }}"
              },
              columns: [
                {data: 'transaction_id', name: 'transaction_id'},
                {data: 'payment_method', name: 'payment_method'},
                {data: 'created_at', name: 'created_at'},
                {data: 'amount', name: 'amount'},
                {data: 'total_items', name: 'total_items'},
                {data: 'delivered_at', name: 'delivered_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
              "order": [[ 5, "desc" ]],
              "lengthMenu": ["5", "10", "50", "100"]
        });


        });

    </script>

@endsection
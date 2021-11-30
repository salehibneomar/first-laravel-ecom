@extends('backend.layout')

@section('content')

<div class="col-12">

    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">All Users</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            
                <table id="user-table" class="table table-bordered table-striped dataTable " role="grid" >
                    
                    <thead>
                        <tr>
                            <th style="width: 5%">#ID</th>
                            <th style="width: 10%">Image</th>
                            <th>Name</th>
                            <th style="width: 30%"></th>
                            <th style="width: 10%">Joined</th>
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
            var table = $('#user-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('user.all') }}",
              columns: [
                {data: 'id', name: 'id'},
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
              ],
              "order": [[ 0, "desc" ]],
              "lengthMenu": ["5", "10", "50", "100"]
          });

        
        });

    </script>

@endsection
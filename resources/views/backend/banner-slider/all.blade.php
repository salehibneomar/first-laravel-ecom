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
            
                <table id="slider-table" class="table table-bordered table-striped dataTable " role="grid" >
                    
                    <thead>
                        <tr>
                            <th style="width: 5%">#SL</th>
                            <th style="width: 15%">Image</th>
                            <th>N.Title</th>
                            <th>C.Title</th>
                            <th>S.Note</th>
                            <th>Description</th>
                            <th style="width: 5%">Status</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $row = 1;
                        @endphp
                        @foreach ($bannerSliders as $bannerSlider)
                            <tr>
                                <td>#{{ $row++ }}</td>
                                <td>
                                    <img src="{{ asset($bannerSlider->image) }}" width="100" height="60">
                                </td>
                                <td>{{ $bannerSlider->normal_title }}</td>
                                <td>
                                    @if (is_null($bannerSlider->colored_title))
                                        {{ 'N/A' }}
                                    @else
                                        {{ $bannerSlider->colored_title }}    
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($bannerSlider->short_note))
                                        {{ 'N/A' }}
                                    @else
                                        {{ $bannerSlider->short_note }}  
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($bannerSlider->short_description))
                                        {{ 'N/A' }}
                                    @else
                                        {{ $bannerSlider->short_description }}
                                    @endif
                                </td>
                                <td>
                                    @if ($bannerSlider->status==1)
                                        <span class="badge bg-success">Live</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('banner.slider.edit', ['id'=>$bannerSlider->id]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('banner.slider.delete', ['id'=>$bannerSlider->id]) }}" class="btn btn-danger slider-delete"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
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
            var table = $('#slider-table').DataTable({
              "lengthMenu": ["5", "10", "50", "100"]
          });

          $('tbody').on('click', '.slider-delete', function(e){
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
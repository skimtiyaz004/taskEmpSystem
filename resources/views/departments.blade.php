@extends('layouts.admin')
@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <style>
        .bckgrnd {
            backgroundColor: "#fff",
                opacity: 0.8,
                cursor: "wait"
        }

    </style>
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Department List</h3>

                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">

                        <a href=" " class="btn btn-primary round btn-min-width mr-1 mb-1" data-toggle="modal" data-target="#myModal">Add
                            New</a>
                             <!-- The Modal -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Add Department</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{route('admin.addDepartment')}}" method="POST">
                                                @csrf
                                                <label>Department Name</label>
                                                <input type="text" name="name" class="form-control" required>
                                                <input type="submit" value="Add" class="btn btn-success">
                                            </form>
                                        </div>
                                        
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Row grouping -->
                <section id="row-grouping">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Department</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">

                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered row-grouping">
                                                <thead>
                                                    <tr>
                                                        <th>Departmen Name</th>
                                                         
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($departments as $dp)
                                                        <tr>
                                                            <td>{{ $dp->name }}</td> 
                                                            
                                                            <td>
                                                                {{-- {{ route('employee.edit',$dp->id) }} --}}
                                                                <a href="" 
                                                                    class="btn btn-outline-info btn-sm round "
                                                                    data-toggle="modal" data-target='#practice_modal{{ $dp->id }}'  data-id="{{ $dp->id }}"><i
                                                                        class="la la-pencil font-medium-5"></i></a>
                                                            </td>
                                                        </tr>
                                                         
                                                        <div class="modal fade"  id="practice_modal{{ $dp->id }}">
                                                            <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                <h4 class="modal-title">Add Department</h4>
                                                                <button type="button" class="close"   data-dismiss="modal">&times;</button>
                                                                </div>
                                                                
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <form action="{{route('admin.editDepartment',$dp->id)}}" method="POST">
                                                                        @csrf
                                                                        <label>Department Name</label>
                                                                        <input type="text" name="name" value="{{ $dp->name }}" class="form-control" required>
                                                                        <input type="submit" value="Update" class="btn btn-success">
                                                                    </form>
                                                                </div>
                                                                
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>
                                                                
                                                            </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Departmen Name</th>
                                                         
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



            </div>
        </div>
    </div>
@endsection
@section('script')

    <script src="{{ asset('app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        /********************************************
         *        js of Order by the grouping        *
         ********************************************/
         $('body').on('click', '#editCompany', function (event) {

event.preventDefault();
var id = $(this).data('id');
console.log(id)
$.get('color/' + id + '/edit', function (data) {
     $('#userCrudModal').html("Edit category");
     $('#submit').val("Edit category");
     $('#practice_modal').modal('show');
     $('#color_id').val(data.data.id);
     $('#name').val(data.data.name);
 })
});
        var table = $('.row-grouping').DataTable({
            autoWidth: true,

        });
        //  var groupingTable = $('.row-grouping').DataTable({
        //     "columnDefs": [{
        //         "visible": false,
        //         "targets": 1
        //     }],
        //     "order": [
        //         [1, 'asc']
        //     ],
        //     "displayLength": 25,
        //     "drawCallback": function(settings) {
        //         var api = this.api();
        //         var rows = api.rows({
        //             page: 'current'
        //         }).nodes();
        //         var last = null;

        //         api.column(2, {
        //             page: 'current'
        //         }).data().each(function(group, i) {
        //             if (last !== group) {
        //                 $(rows).eq(i).before(
        //                     '<tr class="group"><td colspan="5">' + group + '</td></tr>'
        //                 );

        //                 last = group;
        //             }
        //         });
        //     }
        // });

        // $('.row-grouping tbody').on('click', 'tr.group', function() {
        //     var currentOrder = groupingTable.order()[0];
        //     if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
        //         groupingTable.order([2, 'desc']).draw();
        //     }
        //     else {
        //         groupingTable.order([2, 'asc']).draw();
        //     }
        // });
       
         

    </script>
@endsection

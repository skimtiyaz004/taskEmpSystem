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
                    <h3 class="content-header-title">City List</h3>

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
                                        <h4 class="modal-title">Add City</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{route('admin.addcity')}}" method="POST">
                                                @csrf
                                                <label>Country Name</label>
                                                <select class="form-control" name="cname" id="cname" onchange="getState()">
                                                    <option>Select Country</option>
                                                    @foreach($countries as $county)
                                                    <option value="{{$county->id}}">{{$county->name}}</option>
                                                    @endforeach
                                                </select>
                                                <label>State Name</label>
                                                <select class="form-control" name="sname" id="historyarea">
                                                    <option>Select State</option>
                                                   
                                                </select>
                                                <label>City Name</label>
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
                                                        <th>City Name</th>
                                                        <th>State Name</th>
                                                          
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($cityList as $dp)
                                                        <tr>
                                                            <td>{{ $dp->name }}</td> 
                                                            <td>{{ $dp->sname }}</td> 
                                                            
                                                            {{-- <td>
                                                                
                                                                <a href="" 
                                                                    class="btn btn-outline-info btn-sm round "
                                                                    data-toggle="modal" data-target='#practice_modal{{ $dp->id }}'  data-id="{{ $dp->id }}"><i
                                                                        class="la la-pencil font-medium-5"></i></a>
                                                            </td> --}}
                                                        </tr>
                                                         
                                                         
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>City Name</th>
                                                        <th>State Name</th>
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
   
        var table = $('.row-grouping').DataTable({
            autoWidth: true,

        });
        
       
         
        function getState(){
            // console.log($("#cname").val());
            var cname= $("#cname").val()
            var Baseurl = '{{ route("admin.getStateByCountry", ":id") }}';
            Baseurl = Baseurl.replace(':id', cname);
           
               

            $.ajax({
            url: Baseurl,
           type:'GET',
           data:{"_token": "{{ csrf_token() }}",cname:cname },
           success:function(data){
            var appendElement="";
                         $("#tHistoryBox").show();
                        var jsonData = JSON.parse(data);
                        $("#historyarea li").remove();
                        var arr = $.map(jsonData, function(item){
                            
                            appendElement+="<option value='"+item.id+"'>"+item.name+"</option>"
                        });
                        $("#historyarea").append(appendElement);
           }
        });
            
        }
    </script>
@endsection

@extends('layouts.adminindex')

@section('content')

        <!-- Start Content Area  -->

        <div class="container-fluid">

            <div class="col-md-12">
                <a href="{{route('roles.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>
            </div>
        
            <hr/>

            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-6 mb-2">
                        <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
                    </div>

                    <div class="col-md-6">
                        <form action="{{route('roles.index')}}" method="GET">
                        
                            <div class="row justify-content-end">

                                <div class="col-md-4 col-sm-8 mb-2">
                                    <div class="form-group">
                                        <select name="statusfilter" id="statusfilter" class="form-select form-select-sm rounded-0">
                                            <option selected disabled>Choose Status</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-6 mb-2">
                                    <div class="input-group">
                                        <input type="text" name="namefilter" id="namefilter" class="form-control form-control-sm rounded-0" placeholder="Search..." />
                                        <a href="{{route('roles.index')}}" id="btn-clear" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i></a>
                                        <button type="submit" id="search-btn" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                                    </div>                                    
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <table class="table table-sm table-hover border">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                            </th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>By</th>
                            <th>Create at</th>
                            <th>Update at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $idx=>$role)
                            <tr id="delete_{{$role->id}}">
                                <td>
                                    <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$role->id}}" />
                                </td> 
                                <td>{{++$idx}}</td>
                                <td><img src="{{asset($role->image)}}" class="rounded-circle me-2" width="20" height="20" alt=""><a href="{{route('roles.show',$role->id)}}">{{$role->name}}</a></td>
                                <td>{{$role->status->name}}</td>
                                <td>{{$role['user']['name']}}</td>
                                <td>{{$role->created_at->format('d M Y')}}</td>
                                <td>{{$role->updated_at->format('d M Y')}}</td>
                                <td>
                                    <a href="{{route('roles.edit',$role->id)}}" class="text-info"><i class="fas fa-pen"></i></a>
                                    <a href="javascript:void(0);" class="text-danger ms-2 delete-btn" data-idx={{$idx}}><i class="fas fa-trash-alt"></i></a>
                                    <form id="formdelete-{{$idx}}" action="{{route('roles.destroy',$role->id)}}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- End Content Area  -->

@endsection

@section('css')
@endsection

@section('scripts')
<script type="text/javascript">


        $(document).ready(function(){

            // Single Delete 
            $('.delete-btn').click(function(){
                const getidx = $(this).data('idx');
                // console.log(getidx);

                if(confirm(`Are you sure! you want to delete ${getidx}`)){
                    $('#formdelete-'+getidx).submit();
                    return true;
                }else{
                    return false;
                }

            });
            // Single Delete 

            // Bulk Delete 
            $("#bulkdelete-btn").hide();
            $('#selectalls').click(function(){
                $('.singlechecks').prop('checked',$(this).prop('checked'))
            });

            $(document).on('change','.singlechecks',function(){
                togglebulkdeletebtn();
            });

            function togglebulkdeletebtn(){
                let selectedcount = $(".singlechecks:checked").length;
                console.log(selectedcount);

                if(selectedcount > 0){
                    $("#bulkdelete-btn").show();
                }else{
                    $("#bulkdelete-btn").hide();
                }
            }

            $("#bulkdelete-btn").click(function(){

                let getselectedids = [];

                $("input:checkbox[name='singlechecks']:checked").each(function(){
                    getselectedids.push($(this).val());
                });

                // console.log(getselectedids);

                $.ajax({
                    url:"{{route('roles.bulkdeletes')}}",
                    type:"DELETE",
                    dataType:"json",
                    data:{
                        selectedids:getselectedids,
                        _token:'{{csrf_token()}}'
                    },
                    success:function(response){
                        console.log(response);

                        if(response){
                            // ui remove 

                            $.each(getselectedids,function(key,val){
                                $(`#delete_${val}`).remove();
                            });
                        }

                    },
                    error:function(response){
                        console.log("Error : ",response);
                    }
                })

            });
            // Bulk Delete

        });

  

</script>
@endsection
        

        







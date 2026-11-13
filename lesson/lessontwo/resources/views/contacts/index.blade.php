@extends('layouts.adminindex')

@section('content')

        <!-- Start Content Area  -->

        <div class="container-fluid">

            <div class="col-md-12">
                <a href="#createmodal" class="btn btn-primary btn-sm rounded-0" data-bs-toggle="modal">Create</a>
            </div>
        
            <hr/>

            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-2 mb-2">
                        <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
                    </div>

                    <div class="col-md-10">
                        <form action="{{route('contacts.index')}}" method="GET">
                        
                            <div class="row justify-content-end">
                                
                                <div class="col-md-2 col-sm-6 mb-2">
                                    <div class="input-group">
                                        <input type="text" name="namefilter" id="namefilter" class="form-control form-control-sm rounded-0" placeholder="Search..." />
                                        <a href="{{route('contacts.index')}}" id="btn-clear" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i></a>
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
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                            <th>Relative</th>                            
                            <th>By</th>                                                      
                            <th>Create at</th>
                            <th>Update at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $idx=>$contact)
                            <tr>
                                <td>
                                    <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$contact->id}}" />
                                </td> 
                                <td>{{($contacts->currentPage() - 1) * $contacts->perPage() + $idx + 1}}</td>                                
                                <td>{{$contact->firstname}}</td>
                                <td>{{$contact->lastname}}</td>
                                <td>{{$contact->gender->name}}</td>
                                <td>{{$contact->birthday}}</td>
                                <td>{{$contact->relative->name}}</td>                                                           
                                <td>{{$contact['user']['name']}}</td>
                                <td>{{$contact->created_at->format('d M Y')}}</td>
                                <td>{{$contact->updated_at->format('d M Y')}}</td>
                                <td>
                                    <a href="javascript:void(0);" class="text-info editbtn" data-bs-toggle="modal" data-bs-target="#editmodal"
                                        data-id="{{$contact->id}}" 
                                        data-firstname="{{$contact->firstname}}" data-lastname="{{$contact->lastname}}"                                        
                                        data-gender_id="{{$contact->gender_id}}" data-birthday="{{$contact->birthday}}"                                        
                                        data-relative_id="{{$contact->relative_id}}"
                                    ><i class="fas fa-pen"></i></a>
                                    <a href="javascript:void(0);" class="text-danger ms-2 delete-btn" data-idx={{$idx}}><i class="fas fa-trash-alt"></i></a>
                                    <form id="formdelete-{{$idx}}" action="{{route('contacts.destroy',$contact->id)}}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
                {{-- {{$contacts->links()}} --}}
                {{$contacts->links('pagination::bootstrap-5')}}
            </div>
        </div>
        
        <!-- End Content Area  -->

        {{-- START MODAL AREA --}}

        {{-- start create modal --}}
        <div id="createmodal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">

                    <div class="modal-header">
                        <h6 class="modal-title">Create Form</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('contacts.store')}}" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label for="firstname">First Name <span class="text-danger">*</span></label>                                    
                                    <input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" placeholder="Enter First Name" value="{{old('firstname')}}" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="lastname">Last Name</label>                                    
                                    <input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" placeholder="Enter Last Name" value="{{old('lastname')}}" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="gender_id">Gender</label>                                   
                                    <select name="gender_id" id="gender_id" class="form-control form-control-sm rounded-0" >
                                        <option selected disabled>Choose Gender</option>
                                        @foreach($genders as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="birthday">Birthday</label>                                    
                                    <input type="date" name="birthday" id="birthday" class="form-control form-control-sm rounded-0" placeholder="Enter DOB" value="{{old('birthday')}}" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="relative_id">Relative</label>                                   
                                    <select name="relative_id" id="relative_id" class="form-control form-control-sm rounded-0" >
                                        @foreach($relatives as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col d-flex justify-content-end mt-2">                                    
                                    <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3" >Submit</button>
                                </div>

                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- end create modal --}}

        {{-- start edit modal --}}
        <div id="editmodal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">

                    <div class="modal-header">
                        <h6 class="modal-title">Edit Form</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form id="editformaction" action="" method="POST">
                            @csrf
                            {{-- @{{method_field('PUT')}} --}}
                            @method('PUT')

                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label for="editfirstname">First Name <span class="text-danger">*</span></label>                                    
                                    <input type="text" name="editfirstname" id="editfirstname" class="form-control form-control-sm rounded-0" placeholder="Enter First Name" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="editlastname">Last Name</label>                                    
                                    <input type="text" name="editlastname" id="editlastname" class="form-control form-control-sm rounded-0" placeholder="Enter Last Name" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="editgender_id">Gender</label>                                   
                                    <select name="editgender_id" id="editgender_id" class="form-control form-control-sm rounded-0" >
                                        <option selected disabled>Choose Gender</option>
                                        @foreach($genders as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="editbirthday">Birthday</label>                                    
                                    <input type="date" name="editbirthday" id="editbirthday" class="form-control form-control-sm rounded-0" placeholder="Enter DOB" value="{{old('birthday')}}" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="editrelative_id">Relative</label>                                   
                                    <select name="editrelative_id" id="editrelative_id" class="form-control form-control-sm rounded-0" >
                                        @foreach($relatives as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col d-flex justify-content-end mt-2">                                    
                                    <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3" >Update</button>
                                </div>

                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- end edit modal --}}

        {{-- END MODAL AREA --}}

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
            $('#selectalls').click(function(){
                $('.singlechecks').prop('checked',$(this).prop('checked'))
            })
            // Bulk Delete

            // Edit Form

            $(document).on('click','.editbtn',function(e){

                e.preventDefault();

                $('#editfirstname').val($(this).attr('data-firstname'));
                $('#editlastname').val($(this).attr('data-lastname'));
                $('#editgender_id').val($(this).attr('data-gender_id'));
                $('#editbirthday').val($(this).attr('data-birthday'));
                $('#editrelative_id').val($(this).attr('data-relative_id'));

                const getid = $(this).data('id'); 
                $("#editformaction").attr('action',`/contacts/${getid}`)

            });

            // Edit Form

        });

  

</script>
@endsection
        

        







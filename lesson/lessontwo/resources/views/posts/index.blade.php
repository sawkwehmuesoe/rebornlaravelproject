@extends('layouts.adminindex')

@section('content')

        <!-- Start Content Area  -->

        <div class="container-fluid">

            <div class="col-md-12">
                <a href="{{route('posts.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>
            </div>
        
            <hr/>

            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-2 mb-2">
                        <a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a>
                    </div>

                    <div class="col-md-10">
                        <form action="{{route('posts.store')}}" method="POST">
                        
                            <div class="row justify-content-end">
                                
                                <div class="col-md-2 col-sm-6 mb-2">
                                    <div class="input-group">
                                        <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search..." />
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Fee</th>
                            <th>Startdate</th>
                            <th>Enddate</th>
                            <th>Starttime</th>
                            <th>Endtime</th>
                            <th>Type ID</th>
                            <th>Tag ID</th>
                            <th>Attshow</th>
                            <th>Status ID</th>                            
                            <th>User ID</th>
                            <th>Create at</th>
                            <th>Update at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $idx=>$post)
                            <tr>
                                <td>
                                    <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$post->id}}" />
                                </td> 
                                <td>{{++$idx}}</td>
                                <td><img src="{{asset($post->image)}}" class="rounded-circle me-2" width="20" height="20" alt=""><a href="{{route('posts.show',$post->id)}}">{{$post->name}}</a></td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->content}}</td>
                                <td>{{$post->fee}}</td>
                                <td>{{$post->startdate}}</td>
                                <td>{{$post->enddate}}</td>
                                <td>{{$post->starttime}}</td>
                                <td>{{$post->endtime}}</td>
                                {{-- {{ dd($post->type->name) }} --}}
                                {{-- <td>{{$post->type_id}}</td> --}}
                                <td>{{$post->type->name}}</td>
                                <td>{{$post->tag->name}}</td>
                                <td>{{$post->attshow}}</td>
                                <td>{{$post->status->name}}</td>                                
                                <td>{{$post['user']['name']}}</td>
                                <td>{{$post->created_at->format('d M Y')}}</td>
                                <td>{{$post->updated_at->format('d M Y')}}</td>
                                <td>
                                    <a href="{{route('posts.edit',$post->id)}}" class="text-info"><i class="fas fa-pen"></i></a>
                                    <a href="javascript:void(0);" class="text-danger ms-2 delete-btn" data-idx={{$idx}}><i class="fas fa-trash-alt"></i></a>
                                    <form id="formdelete-{{$idx}}" action="{{route('posts.destroy',$post->id)}}" method="POST">
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
            $('#selectalls').click(function(){
                $('.singlechecks').prop('checked',$(this).prop('checked'))
            })
            // Bulk Delete

        });

  

</script>
@endsection
        

        







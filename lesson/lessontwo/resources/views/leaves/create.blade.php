@extends('layouts.adminindex')

@section('content')

        <!-- Start Content Area  -->

        <div class="container-fluid">
            <div class="col-md-12">
                <form action="{{route('leaves.store')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-md-4">
                            
                            <div class="row">

                                <div class="col-md-12 form-group">
                                    <label for="name">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="startdate">Start Date <span class="text-danger">*</span></label>
                                    @error('startdate')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <input type="date" name="startdate" id="startdate" class="form-control form-control-sm rounded-0" value="{{old('startdate',$gettoday)}}" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="enddate">End Date <span class="text-danger">*</span></label>
                                    @error('enddate')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <input type="date" name="enddate" id="enddate" class="form-control form-control-sm rounded-0" value="{{old('enddate',$gettoday)}}"/>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="row">

                                <div class="col-md-12 form-group mb-3">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Title" value="{{old('title')}}" />
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="post_id">Class</label>
                                    @error('post_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <select name="post_id[]" id="post_id" class="form-control form-control-sm rounded-0" value="{{old('post_id')}}" multiple>                                        
                                        @foreach($posts as $id=>$title)
                                            <option value="{{$id}}" {{old('post_id') == $id ? 'selected' : ''}}>{{$title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="tag">Tag</label>
                                    @error('tag')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <select name="tag[]" id="tag" class="form-control form-control-sm rounded-0" multiple >                                        
                                        @foreach($tags as $tag)
                                            <option value="{{$tag['id']}}" {{old('tag') == $tag->id ? 'selected' : ''}} >{{$tag['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 form-group mb-3">
                                    <label for="content">Content <span class="text-danger">*</span></label>                                
                                    @error('content')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <textarea name="content" id="content" rows="5" class="form-control form-control-sm rounded-0" placeholder="Say Something...">{{old('content')}}</textarea>
                                </div>

                                <div class="col-md-12 d-flex justify-content-end">                            
                                    <a href="{{route('leaves.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3" >Submit</button>
                                </div>

                            </div>

                        </div>

                    </div>

                </form>
            </div>

            <hr/>

        </div>
        
        <!-- End Content Area  -->

@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js" ></script>
<script type="text/javascript">


        $(document).ready(function(){
            $('#post_id').select2({
                placeholder:"Choose Class"
            });
            $('#tag').select2({
                placeholder:"Choose authorize person"
            });

            $("#content").summernote({
                placeholder:'Say Something...',
                height:120,
                toolbar:[                    
                    ['font',['bold','underline','clear']],
                    ['color',['color']],
                    ['para',['ul','ol','paragraph']],
                    ['insert',['link']]
                ]
            });
        });

  

</script>
@endsection
        

        







@extends('layouts.adminindex')

@section('content')

        <!-- Start Content Area  -->

        <div class="container-fluid">
            <div class="col-md-12">
                <form action="{{route('announcements.store')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-md-4">
                            
                            <div class="row">                        

                                <div class="col-md-12 form-group mb-3">                                

                                    <label for="image" class="gallery">
                                        <span>Choose Image</span>
                                    </label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" hidden />
                                </div>
                                
                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="row">

                                <div class="col-md-12 form-group mb-3">
                                    <label for="title">Title <span class="text-danger">*</span></label>                                   
                                    <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Title" value="{{old('title')}}" />
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="post_id">Class</label>                                    
                                    <select name="post_id[]" id="post_id" class="form-control form-control-sm rounded-0" value="{{old('post_id')}}" multiple>                                        
                                        @foreach($posts as $id=>$title)
                                            <option value="{{$id}}" {{old('post_id') == $id ? 'selected' : ''}}>{{$title}}</option>
                                        @endforeach
                                    </select>
                                </div>                      

                                <div class="col-md-12 form-group mb-3">
                                    <label for="content">Content <span class="text-danger">*</span></label>                                                                    
                                    <textarea name="content" id="content" rows="5" class="form-control form-control-sm rounded-0">{{old('content')}}</textarea>
                                </div>  

                                <div class="col-md-12 d-flex justify-content-end">                            
                                    <a href="{{route('announcements.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
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
    <link href="{{asset('assets/libs/select2/select2-develop/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/libs/summernote/summernote-lite.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" type="text/css" />

    <style type="text/css">
        /* Start Gallery */
        .gallery{
			width: 100%;
			background-color: #eee;
			color: #aaa;

			text-align: center;
			padding: 10px;

		}

		.removetxt span{
			display: none;
		}

		.gallery img{
			width: 100px;
			height: 100px;
			border: 2px dashed #000;
		}
        /* End Gallery */
    </style>
@endsection

@section('scripts')
<script src="{{asset('assets/libs/select2/select2-develop/dist/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/libs/summernote/summernote-lite.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.js')}}" type="text/javascript"></script>


<script type="text/javascript">


        $(document).ready(function(){
            $('#post_id').select2({
                placeholder:"Choose Class"
            });
            $('#tag').select2({
                placeholder:"Choose authorize person"
            });

            $("#content").summernote({
                placeholder:'Say Somethings...',
                height:120,
                toolbar:[                    
                    ['font',['bold','underline','clear']],
                    ['color',['color']],
                    ['para',['ul','ol','paragraph']],
                    ['insert',['link']]
                ]
            });

            $("#startdate,#enddate").flatpickr({
                dateFormat: "Y-m-d H:i",
                minDate:"today",
                maxDate:new Date().fp_incr(30)
            });

            // Start Multi Profile Preview

            var previewimage = function(input,output){

            if(input.files){

                var totalfiles = input.files.length;
                console.log(totalfiles);

                if(totalfiles > 0){
                    $(".gallery").addClass('removetxt');
                }else{
                    $(".gallery").removeClass('removetxt');
                }

                for(var i=0; i < totalfiles ; i++){
                    // console.log(i);

                    var filereader = new FileReader();

                    filereader.onload = function(e){
                        $($.parseHTML('<img>')).attr('src',e.target.result).appendTo(output);
                    }

                    filereader.readAsDataURL(input.files[i]);

                }

            }

            }

            $("#image").change(function(){
                previewimage(this,'label.gallery');
            })

            // End Multi Profile Preview

        });

  

</script>
@endsection
        

        







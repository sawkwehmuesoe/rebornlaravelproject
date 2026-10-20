 @extends('layouts.adminindex')

@section('content')

        <!-- Start Content Area  -->

        <div class="container-fluid">

            <div class="col-md-12">
                <a href="javascript:void(0);" id="btn-back" class="btn btn-secondary btn-sm rounded-0">Back</a>
                <a href="{{route('leaves.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>
            </div>
        
            <hr/>

            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-4 col-lg-3 mb-2">
                        <h6>Info</h6>
                        <div class="card border-0 rounded-0 shadow">

                            <div class="card-body">
                                
                                <div class="d-flex flex-column align-items-center mb-3">
                                    <div class="h6 mb-1">{{$leave->title}}</div>
                                    <div class="text-muted">
                                        <span>{{$leave["stage"]["name"]}}</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row g-0 mb-2">

                                        <div class="col-auto">
                                            <i class="fas fa-user"></i>
                                        </div>

                                        <div class="col ps-3">
                                            <div class="row">
                                                <div class="col">
                                                    <h6>Tag</h6>
                                                </div>
                                                <div class="col-auto">
                                                    {{-- <a href="javascript:void(0);">{{$leave->maptagtonames($users)}}</a> --}}
                                                    @foreach($leave->tagpersons($leave->tag) as $id=>$name)
                                                        <a href="javascript:void(0);">{{$name}}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>

                        </div>

                    </div>

                    <div class="col-md-8 col-lg-9">

                        <h6>Compose</h6>

                        <div class="card border-0 rounded-0 shadow mb-4">
                            <div class="card-body">

                                <div class="accordion">

                                    <h1 class="acctitle active">Email</h1>
                                    <div class="acccontent">
                                        <div class="col-md-12 py-3">
                                            <form action="" method="POST" class="px-3">
                                                @csrf 
                                                <div class="row">
                                                    <div class="col-md-6 form-group mb-3">
                                                        <input type="email" name="cmpemail" id="cmpemail" class="form-control form-control-sm border-0 rounded-0" placeholder="To:" value="" readonly />                                                        
                                                    </div>

                                                    <div class="col-md-6 form-group mb-3">
                                                        <input type="text" name="cmpsubject" id="cmpsubject" class="form-control form-control-sm border-0 rounded-0" placeholder="Subject:" />                                                        
                                                    </div>

                                                    <div class="col-md-12 form-group mb-3">
                                                        <textarea name="cmpcontent" id="cmpcontent" class="form-control form-control-sm border-0 rounded-0" rows="3" style="resize:none" placeholder="Your Message here..."></textarea>                                                        
                                                    </div>

                                                    <div class="col d-flex justify-content-end align-items-end">
                                                        <button type="submit" class="btn btn-secondary btn-sm rounded-0">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <h6>Class</h6>

                        <div class="card border-0 rounded-0 shadow mb-4">
                            <div class="card-body d-flex flex-wrap gap-3">
                                @foreach ($leave->tagposts($leave->post_id) as $id=>$title)
                                    <div class="border shadow p-3 enrollboxes">
                                        <a href="{{route('posts.show',$id)}}">{{$title}}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        
        <!-- End Content Area  -->

@endsection

@section('css')

    <style type="text/css">
        /* Start Accordion */
        .accordion{
            width: 100%;
        }

        .acctitle{
            background-color: #777;
            color: #fff;
            font-size: 14px;
            user-select: none;

            padding: 15px;
            margin: 0;

            cursor: pointer;
        }

        .acctitle:hover,.active{
            background-color: steelblue;
        }

        .acctitle::after{
            content: "\f067";
            font-family: "Font Awesome 5 Free";

            float: right;
        }

        .active::after{
            content: "\f068";
        }

        .acccontent{
            height: 0;
            background-color: #f4f4f4;
            text-indent: 50px;
            text-align: justify;
            font-size: 14px;

            overflow: hidden;
            transition: height .3s ease-in-out;
        }
        /* End Accordion */
    </style>

@endsection

@section('scripts')
    <script type="text/javascript">

        // Start Content Area

        var getacctitles = document.getElementsByClassName("acctitle");

        var getacccontent = document.getElementsByClassName("acccontent");
            for(var x = 0; x < getacctitles.length; x++){
                getacctitles[x].addEventListener('click',function(e){
                    this.classList.toggle("active");
                    var getcontent = this.nextElementSibling;
      
                    if(getcontent.style.height){
                        getcontent.style.height = null;
                    }else{                  
                        getcontent.style.height = getcontent.scrollHeight + "px"; 
                    }

                });

                if(getacctitles[x].classList.contains("active")){
                    getacccontent[x].style.height = getacccontent[x].scrollHeight + "px";
                }
            }


        // End Content Area

        $(document).ready(function(){

         

        });

  

    </script>
@endsection
        

        







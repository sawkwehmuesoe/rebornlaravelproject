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

                        <h6>Control Session</h6>
                        <div class="card border-0 rounded-0 shadow mb-4">
                            <ul class="nav">
                                <li class="nav-item">
                                    <button type="button" id="autoclick" class="tablinks" onclick="gettab(event,'contenttab')">Content</button>
                                </li>                                                   
                            </ul>

                            <div class="tab-content">

                                <div id="contenttab" class="tab-panel">        
                                    <p>{!! $leave->content !!}</p>

                                        @if(!empty($leavefiles) && $leavefiles->count() > 0)

                                            @foreach ($leavefiles as $leavefile)

                                                <a href="{{asset($leavefile->image)}}" data-lightbox="image" data-title="{{$leave->title}}" />
                                                    <img src="{{asset($leavefile->image)}}" alt="{{$leavefile->id}}" class="img-thumbnail" width="100" height="100">    
                                                </a>

                                            @endforeach                                            
                                        @else
                                            <span>No Files</span>
                                        @endif
                                </div>                              

                            </div>
                        </div>  

                        <h6>Additional Info</h6>
                        <div class="card border-0 rounded-0 shadow mb-4">
                            <ul class="nav">
                                <li class="nav-item">
                                    <button type="button" id="autoclick" class="tablinks" onclick="gettab(event,'authorizationtag')">Authorization</button>
                                </li>                                                   
                            </ul>

                            <div class="tab-content">

                                <div id="authorizationtag" class="tab-panel">

                                    <form action="{{route('leaves.updatestage',$leave->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">                                           

                                            <div class="col-md-6 form-group mb-3">                                               
                                                <select name="stage_id" id="stage_id" class="form-control form-control-sm rounded-0" value="{{old('stage_id')}}">                                        
                                                    @foreach($stages as $stage)
                                                        <option value="{{$stage->id}}" {{$leave->stage_id == $stage->id ? 'selected' : ''}}>{{$stage->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                           

                                            <div class="col-md-3">                                                                           
                                                <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3" >Update</button>
                                            </div>

                                        </div>

                                    </form>

                                </div>
            
                            </div>
                        </div>  

                    </div>

                </div>
            </div>
        </div>
        
        <!-- End Content Area  -->

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/libs/lightbox2-dev/dist/css/lightbox.min.css')}}" type="text/css">

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

        /* Start Tab */
        .nav{
            display: flex;

            padding: 0;
            margin: 0;
        }

        .nav .nav-item{
            list-style-type: none;
        }

        .nav .tablinks{
            font-size: 16px;
            border: none;
            padding: 15px 20px;
            cursor: pointer;

            transition: background-color .3s ease-in;
        }

        .nav .tablinks:hover,.active{
            background-color: #ddd;
        }

        .nav .tablinks.active{
            color: blue;
        }

        .nav .tablinks:active{
            background-color: #ccc;
        }

        .tab-panel{
            border: 1px solid #ccc;
            border-top: 0;

            padding: 5px 15px;

            display: none;
        }

        /* End Tab */
    </style>

@endsection

@section('scripts')

    <script src="{{asset('assets/libs/lightbox2-dev/dist/js/lightbox.min.js')}}" type="text/javascript"></script>
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

        // Start Tab 
        var gettablinks = document.getElementsByClassName("tablinks"); //HTML Collection
        var gettabpanels = document.getElementsByClassName("tab-panel");
        // var getbtnclose = document.querySelectorAll(".btn-close"); //Note list
        var tabpanels = Array.from(gettabpanels);

        function gettab(evn,linkid){

            tabpanels.forEach(function(tabpanel){
                tabpanel.style.display = "none";
            });

            for(var x=0; x < gettablinks.length; x++){
                gettablinks[x].className = gettablinks[x].className.replace(" active","");

                // getbtnclose[x].addEventListener('click',function(){

                //     this.parentElement.style.display = "none";

                // });
            }

            document.getElementById(linkid).style.display = "block";
            evn.currentTarget.className += " active";

        }

        document.getElementById("autoclick").click();
        // End Tab

        lightbox.option({
            'resizeDuration': 100,
            'wrapAround': true
        })

        $(document).ready(function(){

         

        });

  

    </script>
@endsection
        

        







@include('layouts.auth.authheader')

{{-- start reactjs or vue.js --}}

            
    <form id="stepform" class="mt-3" action="{{ route('register.storestep2') }}" method="POST" >
        @csrf
            
        <div class="form-group mb-3">                    
            <input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" placeholder="First Name" value="{{old('firstname')}}" autofocus  />                                  
        </div>

        <div class="form-group mb-3">                    
            <input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" placeholder="Last Name" value="{{old('lastname')}}" />                                  
        </div>

        <div class="form-group mb-3">                    
            <label for="gender_id">Gender <span>*</span></label>
            <select name="gender_id" id="gender_id" class="form-select form-select-sm rounded-0" >
                <option selected disabled>Choose a gender</option>
                {{-- 
                        
                    @foreach ($genders as $gender)
                            <option vlaue="{{$gender->id}}">{{$gender->name}}</option>
                    @endforeach

                --}}
            </select>                   
        </div>

        <div class="form-group mb-3">
            <label for="age">Age <span class="text-danger">*</span></label>
            <input type="number" name="age" id="age" class="form-control form-control-sm rounded-0" placeholder="Enter Age"/>
        </div>

        <div class="d-grid">
            <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Next</button>
        </div> 

                
    </form>



@include('layouts.auth.authfooter')
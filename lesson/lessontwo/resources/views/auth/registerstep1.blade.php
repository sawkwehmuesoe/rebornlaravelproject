@include('layouts.auth.authheader')

{{-- start reactjs or vue.js --}}

            
    <form id="stepform" action="{{ route('register.storestep1') }}" method="POST" >
        @csrf
                
       

        <!-- Email Address -->
        <div class="form-group mb-3">                    
            <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" placeholder="Email" value="{{old('email')}}"/>                                  
        </div>
        <!-- Password -->
        <div class="form-group mb-3">                    
            <input type="password" name="password" id="password" class="form-control form-control-sm rounded-0" value="{{old('password')}}" placeholder="password"  />                   
        </div>

        <div class="form-group mb-3">                    
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm rounded-0" value="{{old('password_confirmation')}}" placeholder="Confirm Password"  />                   
        </div>

        <div class="d-grid">
            <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Next</button>
        </div> 

                
    </form>



@include('layouts.auth.authfooter')



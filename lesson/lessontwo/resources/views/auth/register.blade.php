@include('layouts.auth.authheader')

{{-- start reactjs or vue.js --}}
<div id="app">

    {{-- Page Wrapper --}}
    <section class="vh-100 d-flex justify-content-center align-items-center">

        <div class="bg-white p-4">
            <h6 class="mb-3">Register</h6>
            
            <form action="{{ route('register') }}" method="POST" >
                @csrf
                
                <div class="form-group mb-3">                    
                    <input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" placeholder="First Name" value="{{old('firstname')}}" autofocus  />                                  
                </div>

                <div class="form-group mb-3">                    
                    <input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" placeholder="Last Name" value="{{old('lastname')}}" />                                  
                </div>

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

                <div class="form-group mb-3">                    
                    <label for="country_id">Country <span>*</span></label>
                    <select name="country_id" id="country_id" class="form-select form-select-sm rounded-0" >
                        <option selected disabled>Choose a country</option>
                        {{-- 
                            @foreach ($countries as $country)
                                    <option vlaue="{{$country['id']}}">{{$country->name}}</option>
                            @endforeach
                        --}}
                    </select>                   
                </div>

                <div class="form-group mb-3">                    
                    <label for="city_id">City <span>*</span></label>
                    <select name="city_id" id="city_id" class="form-select form-select-sm rounded-0" >
                        <option selected disabled>Choose a city</option>              
                    </select>                   
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info rounded-0">Sign Up</button>
                </div>  

                
            </form>

            {{-- bootstrap loader --}}
            <div>

            </div>

            {{-- social login --}}
            <div class="row">
                <small class="text-center text-muted mt-3">Sign in with</small>
                <div class="col-12 text-center mt-2">
                    <a href="javascript:void(0);" class="btn" title="Login with Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Google"><i class="fab fa-google"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Github"><i class="fab fa-github"></i></a>
                </div>
            </div>

            {{-- login link --}}
            <div class="row">
                <div class="col-12 text-center mt-2">
                    <small>Already have an account ? <a href="{{route('login')}}" class="text-primary ms-1">Sign In</a></small>
                </div>
            </div>

            {{-- data policy --}}
            <div class="row">
                <div class="col-12 text-center mt-2">
                    <small>By clicking Sign Up, you agree to our ? <a href="javascript:void(0);" class="fw-bold ms-1">Data Policy</a> and <a href="javascript:void(0);" class="fw-bold ms-1">Cookie Policy</a> You may receive SMS notificaiton from us </small>
                </div>
            </div>

        </div>

        

    </section>
    {{-- Page Wrapper --}}


</div>
{{-- end reactjs or vue.js --}}

@include('layouts.auth.authfooter')



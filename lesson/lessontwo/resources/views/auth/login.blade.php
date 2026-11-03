@include('layouts.auth.authheader')

{{-- start reactjs or vue.js --}}
<div id="app">

    {{-- Start Site Setting --}}
    <div id="sitesettings" class="sitesettings">
        <div class="sitesettings-item"><a href="javascript:void(0);" id="sitetoggle" class="sitetoggle"><i class="fas fa-cog ani-rotates"></i></a></div>
    </div>
    {{-- End Site Setting  --}}

    {{-- Page Wrapper --}}
    <section class="vh-100 d-flex justify-content-center align-items-center">

        <div class="bg-white p-4">
            <h5>Sign In</h5>
            
            <form action="{{ route('login') }}" method="POST" >
                @csrf

                <!-- Email Address -->
                <div class="form-group mb-3">                    
                    <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0 @error('email') is-valid @enderror" placeholder="Username" value="{{old('email')}}" autofocus  />                    
                    {{-- @error('email')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror --}}
                </div>

                <!-- Email Address -->
                <div class="form-group mb-3">                    
                    <input type="password" name="password" id="password" class="form-control form-control-sm rounded-0 @error('password') is-valid @enderror" value="{{old('password')}}" placeholder="password"  />
                    {{-- @error('email')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror --}}
                </div>

                <!-- Remember Me -->
                <div class="form-group mb-3"> 
                    <div class="d-flex">

                        <div>
                            <input type="checkbox" name="remember" id="remember_me" class="form-check-input" {{old('remember') ? 'checked' : ''}}  />
                            <label for="remember_me">Remember Me</label>
                        </div>

                        <div class="ms-auto">
                            <a href="{{route('password.request')}}"><i class="fas fa-lock me-1"></i>Forgot Passowrd ?</a>    
                        </div>

                    </div>                   
                                                      
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info rounded-0">Log In</button>
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
                    <small>Don't have an account ? <a href="{{route('register')}}" class="text-primary ms-1">Sign Up Here</a></small>
                </div>
            </div>

        </div>

        

    </section>
    {{-- Page Wrapper --}}


</div>
{{-- end reactjs or vue.js --}}

@include('layouts.auth.authfooter')



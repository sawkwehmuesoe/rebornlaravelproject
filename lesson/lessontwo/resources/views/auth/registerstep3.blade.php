@include('layouts.auth.authheader')

{{-- start reactjs or vue.js --}}

            
    <form id="stepform" class="mt-3" action="{{ route('register.storestep3') }}" method="POST" >
        @csrf
            
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
            <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Next</button>
        </div> 

                
    </form>



@include('layouts.auth.authfooter')
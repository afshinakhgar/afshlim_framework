@extends('admin.layout.main')

@section('content')
        <h2 class="lead">    
        </h2>
        <h2 class="lead">    
           
        </h2>
        <h2 class="lead">    
           
        </h2>
        
<div class="container">
        <div class="row">
         
            <div class="col-sm-12 col-md-12 col-lg-12 mt-12">
                <div class="card">
                    @include('helpers.userPhoto',['type'=>'user_photo','size'=>'l'])
                    <div class="card-block">
                        <h4 class="card-title"> {{$user->first_name}}  {{$user->last_name}}</h4>
                        <div class="meta">
                             @foreach($user->roles as $role)
                              <i class="badge badge-warning">{{$role->display_name}}</i>
                             @endforeach
                        </div>
                        <div class="card-text">
{{$user->created_at}}                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="float-right"><a href="{{route('admin.user.edit',['mobile'=>$user->mobile])}}" class="btn  btn-info">ویرایش</a></span>
                        <span class="badge badge-info"><i ></i>{{$user->mobile}}</span>
                    </div>
                </div>
            </div>
          
          
        </div>
</div>

<div> <br></div>
@endsection
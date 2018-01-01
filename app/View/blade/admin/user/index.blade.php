@extends('admin.layout.main')

@section('content')



    <div class="container">
            <div class="row">
                @if(isset($list))
                    @foreach($list as $user)

                    <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                        <div class="card">
                            @include('helpers.userPhoto',['type'=>'user_photo','size'=>'thumb'])
                            <div class="card-block">
                                <h4 class="card-title"> {{$user->first_name}}  {{$user->last_name}}</h4>
                                <div class="meta">
                                     @foreach($user->roles as $role)
                                      <i class="badge badge-warning">{{$role->display_name}}</i>
                                     @endforeach
                                </div>
                                <div class="card-text">
                                {{$user->created_at}}                       
                                 </div>

                                <span class="badge badge-info"><i ></i>{{$user->mobile}}</span>
                                <span class="badge badge-info"><i ></i>{{$user->username}}</span>
                            </div>
                            <?php
                            $userField = isset($user->username) && strlen($user->username)>0 ?  $user->username : $user->mobile;
                            ?>
                            <div class="card-footer">
                                  <a href="{{route('admin.user.info',['mobile'=>$userField])}}" class="btn badge-primary">{{$user->id}}</a>
                        <a href="{{route('admin.user.edit',['mobile'=>$userField ])}}" class="btn badge-primary">ویرایش</a>
                            </div>
                        </div>
                        </div>
                        @endforeach
                    @endif
            </div>
        </div>  
    </div>  

    <br>
    
@endsection
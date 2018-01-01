@extends('admin.layout.main')

@section('content')
  
        
    <div class="container">
            <div class="row">
             
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
                        </div>
                        <div class="card-footer">
                            <span class="badge badge-info"><i ></i>{{$user->mobile}}</span>
                        </div>
                    </div>
                </div>
              
                <div class="col-sm-6 col-md-8 col-lg-9 mt-8">

                    <div class="card update_frm">
                        <div class="container">
                            <div class="row">
                              <div class="col-md-12">
                                  <form method="post" enctype="multipart/form-data"  action="{{route('admin.user.update')}}" id="#" class="col-md-12 go-right">
    <!--                                   <input type="hidden" name="_method" value="put" />
     -->
                                    <h2>ویرایش کاربر</h2>
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input id="first_name" name="first_name" type="text" class="form-control"  value="{{$user->first_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">نام خانوادگی</label>
                                        <input id="last_name" name="last_name" type="text" class="form-control" value="{{$user->last_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">شماره تلفن</label>

                                        <input id="mobile" name="mobile" type="tel" class="form-control" required value="{{$user->mobile}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">نام کاربری *</label>

                                        <input id="mobile" name="username" type="text" class="form-control"  value="{{$user->username}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">ایمیل</label>

                                        <input id="email" name="email" type="email" class="form-control" required value="{{$user->email}}">
                                    </div>


                                     <div class="form-group">
                                        <label for="mobile">نقش</label>
                                         @foreach($user->roles as $role)
                                            <i class="badge badge-warning" id="role_{{$role->id}}">{{$role->display_name}}

    <b class="remove_role" data-id="{{$role->id}}" style="cursor: pointer;">[X]</b>
                                            </i>


                                         @endforeach
                                        <span id="current_demo_roles"></span>
                                        <select  id="roles"  class="form-control">
                                            @foreach($roles as $key=>$role)
                                                <option id="role_item_{{$key}}" value="{{$key}}">
                                                    {{$role}}
                                                </option>
                                            @endforeach
                                            <option value="0">
                                                -----------
                                            </option>

                                        </select>
                                     <a href="" id="add_role" class="btn btn-info" style="margin-top: 10px"> + </a>  
                                        <input type="hidden" name="roles" value="{{$current_roles_id}}" id="current_roles">
                                     </div>
                                   
                                      <div class="form-group files">
                                        <label>تصویر کاربر   </label>
                                        <input type="file" name="file" class="form-control" multiple="">
                                      </div>
                                      


                                       <div class="form-group ">
                                        <input type="submit" value="ارسال" class="form-control btn btn-success" >
                                      </div>
                                    </form>

                                  
                                  
                              </div>
                             
                            </div>
                        </div>
                    </div>

                </div>
              
            </div>
    </div>

    <div> <br><br><br></div>

@include('admin.includes.js.roles')



@endsection
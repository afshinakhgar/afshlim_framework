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

                <div class="card update_frm">
                    <div class="container">
                        <div class="row">
                          <div class="col-md-12">
                              <form method="post" enctype="multipart/form-data"  action="{{route('admin.user.store')}}" id="#" class="col-md-12 go-right">
<!--                                   <input type="hidden" name="_method" value="put" />
 -->
                                <h2>کاربر جدید </h2>
                                <div class="form-group">
                                    <label for="name">نام</label>
                                    <input id="first_name" name="first_name" type="text" class="form-control"  value="">
                                </div>
                                <div class="form-group">
                                    <label for="name">نام خانوادگی</label>
                                    <input id="last_name" name="last_name" type="text" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">شماره تلفن</label>

                                    <input id="mobile" name="mobile" type="tel" class="form-control" required value="">
                                </div>

                                 <div class="form-group">
                                    <label for="mobile">نام کاربری *</label>

                                    <input id="mobile" name="username" type="text" class="form-control" required value="{{$user->username}}">
                                </div>

                                
                                <div class="form-group">
                                    <label for="mobile">ایمیل</label>

                                    <input id="email" name="email" type="email" class="form-control" required value="">
                                </div> 

                                <div class="form-group">
                                    <label for="mobile">نقش</label>

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
                                    <input type="hidden" name="roles" value="" id="current_roles">
                                 </div>
                               
                                  <div class="form-group files">
                                    <label>تصویر کاربر</label>
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

<div> <br></div>

@include('admin.includes.js.roles')

@endsection
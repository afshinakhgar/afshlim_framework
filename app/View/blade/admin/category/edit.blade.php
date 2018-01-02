@extends('admin.layout.main')

@section('content')
        
<div class="container">
        <div class="row">

            <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card">
                    @include('helpers.photo',['photo'=>$category,'type'=>'category_photo','size'=>'thumb'])
                    <div class="card-block">
                        <h4 class="card-title"> {{$category->title}}  </h4>
                        <div class="meta">

                        </div>
                        <div class="card-text">
                            {{$category->created_at}}
                        </div>
                    </div>
                    <div class="card-footer">
                        {{--<span class="badge badge-info"><i ></i>{{$user->mobile}}</span>--}}
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-8 col-lg-9 mt-8">

                <div class="card update_frm">
                    <div class="container">
                        <div class="row">
                          <div class="col-md-12">
                              <form method="post" enctype="multipart/form-data"  action="{{route('admin.category.update',['id'=>$category->id])}}" id="#" class="col-md-12 go-right">

                                <h2> ویرایش دسته بندی  </h2>
                                <div class="form-group">
                                    <label for="title">عنوان</label>
                                    <input id="title" name="title" type="text" class="form-control"  value="{{$category->title}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="body">متن</label>
                                    <textarea name="body">{{$category->body}}</textarea>
                                </div>

                                <div class="form-group files">
                                    <label>تصویر </label>
                                    <input type="file" name="file" class="form-control" multiple="{{$category->title}}">
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
@extends('admin.layout.main')

@section('content')
        
<div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 mt-12">

                <div class="card update_frm">
                    <div class="container">
                        <div class="row">
                          <div class="col-md-12">
                              <form method="post" enctype="multipart/form-data"  action="{{route('admin.category.store')}}" id="#" class="col-md-12 go-right">

                                <h2>دسته بندی  جدید</h2>
                                <div class="form-group">
                                    <label for="title">عنوان</label>
                                    <input id="title" name="title" type="text" class="form-control"  value="">
                                </div>
                                
                                <div class="form-group">
                                    <label for="body">متن</label>
                                    <textarea name="body"></textarea>
                                </div>

                                <div class="form-group files">
                                    <label>تصویر </label>
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
@extends('admin.layout.main')

@section('content')

    <div class="container">
            <div class="row">
                @if(isset($list))
                    @foreach($list as $row)
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                        <div class="card">
                            @include('helpers.photo',['photo'=>$row,'type'=>'category_photo','size'=>'thumb'])
                            <div class="card-block">
                                <h4 class="card-title">{{$row->title}}</h4>
                                <div class="meta">
                                      <i class="badge badge-warning">{{$row->slug}}</i>
                                </div>
                                <div class="card-text">
                                {{$user->created_at}}                       
                                 </div>

                                <span class="badge badge-info"><i ></i>{{$row->created_at}}</span>
                            </div>
                            <?php
                            ?>
                            <div class="card-footer">
                              <a href="{{route('admin.category.delete',['id'=>$row->id])}}" class="btn badge-danger">حذف</a>
                                <a href="{{route('admin.category.edit',['id'=>$row->id ])}}" class="btn badge-primary">ویرایش</a>
                            </div>
                        </div>
                        </div>
                        @endforeach
                    @endif
            </div>
        </div>  
    </div>  

    <br>
    @if(isset($list))
        @include('helpers.paging2', ['paginator' => $list])
    @endif
@endsection
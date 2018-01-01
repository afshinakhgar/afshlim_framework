@if(isset($messages['error']))
<div>
    <ul class="alert alert-danger">
    @foreach($messages['error'] as $error)
        <ol>
            <strong>Error!</strong> {!! $error !!}
        </ol>
    @endforeach
    </ul>
</div>
@endif



@if(isset($messages['success']))
    <div>
        <ul class="alert alert-success">
            @foreach($messages['success'] as $error)
                <ol>
                    <strong></strong> {!! $error !!}
                </ol>
            @endforeach
        </ul>
    </div>
@endif
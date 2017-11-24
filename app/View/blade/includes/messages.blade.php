@if($messages['error'])
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

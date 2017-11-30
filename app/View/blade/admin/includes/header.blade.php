<div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1>Users list</h1>

    </div>


    <table class="table table-responsive">
        <thead>
            <tr>
                <th>id</th>
                <th>Mobile</th>
                <th>name</th>
                <th>last Name</th>
            </tr>
        </thead>

        @foreach($list as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->mobile}}</td>
                <td>{{$row->first_name}}</td>
                <td>{{$row->last_name}}</td>
            </tr>

        @endforeach

    </table>
</div> <!-- /container -->


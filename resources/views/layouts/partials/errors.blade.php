@if($errors->any())
    <div class="alert alert-danger">
        <ul style="list-style:none;">
            @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
@endif
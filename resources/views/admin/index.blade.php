<div>
    <table>
        <thead>

        </thead>
        <tbody>
        @foreach($allUser as $key => $value)
            <tr>
                <td>{{$key++}}</td>
                <td>{{$value['name']}}</td>
                <td>{{$value['email']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

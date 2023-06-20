<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Lots</th>
        <th>Industry</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stocks as $stock)
        <tr>
            <td>{{ $stock->name }}</td>
            <td>{{ $stock->price }}</td>
            <td>{{ $stock->lots }}</td>
            <td>{{ $stock->industry->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

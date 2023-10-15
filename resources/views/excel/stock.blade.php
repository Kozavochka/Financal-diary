<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Price, RUB</th>
        <th>Lots</th>
        <th>Total, RUB</th>
        <th>Industry</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stocks as $stock)
        <tr>
            <td>{{ $stock->name }}</td>
            <td>{{ $stock->price }}</td>
            <td>{{ $stock->lots }}</td>
            <td>{{ $stock->total_price }}</td>
            <td>{{ $stock->industry->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

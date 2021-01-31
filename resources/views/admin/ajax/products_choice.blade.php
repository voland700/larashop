<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px"> </th>
        <th>Наименование</th>
        <th style="width: 20px">ID</th>
    </tr>
    </thead>
    <tbody class="d_table">
    @foreach ($products as $product)
        <tr>
            <td>
                <span class="d_btn btn btn-block btn-default" data-id="{{ $product->id }}" data-name="{{ $product->name }}"><i class="far fa-check-square fa-sm"></i></span>
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->id }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

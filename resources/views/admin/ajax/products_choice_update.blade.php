<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">777</th>
        <th>Наименование</th>
        <th style="width: 20px">ID</th>
    </tr>
    </thead>
    <tbody class="d_table">
    @forelse ($products as $product)
        <tr>
            <td>
                <span class="d_btn btn btn-block  {{ (in_array($product->id, $items_id)) ? 'btn-success' : 'btn-default' }}" data-id="{{ $product->id }}" data-name="{{ $product->name }}"><i class="far fa-check-square fa-sm"></i></span>
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->id }}</td>
        </tr>
    @empty
        <tr>
            <td></td>
            <td style="text-align: center">В данном разделе товаров нет.</td>
            <td></td>
        </tr>
    @endforelse
    </tbody>
</table>
{{ $products->appends(['category' => $categoryId])->links('admin.ajax.ajax_paginate_update') }}

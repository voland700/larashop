<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul>
                <li>Пункт меню</li>
                <li>Пункт меню</li>
                <li>Пункт меню</li>
                <li>Пункт меню</li>
                <li>Пункт меню</li>
                <li>Пункт меню</li>
                <li>Пункт меню</li>
                <li>Пункт меню</li>
                <li>Пункт меню</li>
                <li>Пункт меню</li>
            </ul>
        </div>
        <div class="col-md-9">

            <ul>
                @foreach ($products as $product)
                    <li>{{ $product->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

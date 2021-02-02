<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px"> </th>
                    <th>Наименование</th>
                    <th style="width: 20px">ID</th>
                </tr>
                </thead>
                <tbody class="d_table">





                </tbody>
            </table>

            <ul>
                @foreach($categories as $category)
                    <li>{{$category->depth}} - {{$category->name}}</li>
                @endforeach
            </ul>



        </div>
    </div>
</div>

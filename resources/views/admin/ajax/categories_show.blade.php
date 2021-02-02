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
                @php
                    $traverse = function ($categories, $prefix = '-&ensp;') use (&$traverse) {
                            foreach ($categories as $category) {
                                $td =  '<tr><td><span class="d_btn btn btn-block btn-default" data-id="'.$category->id.'" data-name="'.$category->name.'"><i class="far fa-check-square fa-sm"></i></span></td><td>';
                                $td .= PHP_EOL.$prefix.' '.$category->name.'</td><td>'.$category->id.'</td></tr>';
                                echo $td;                             
                                $traverse($category->children, $prefix.'-&ensp;');
                            }
                    };
                    $traverse($categories);
                @endphp
                </tbody>
            </table>

        </div>
    </div>
</div>

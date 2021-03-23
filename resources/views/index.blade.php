
@php

$page = isset($_GET['page']) ? $_GET['page'] : '';
$sortbydate = isset($_GET['sortbydate']) ? ($_GET['sortbydate'] === 'true') : false;
$sortbyprice = isset($_GET['sortbyprice']) ? ($_GET['sortbyprice'] === 'true'): false;

@endphp

@include('header')

<container>

    <div class="d-flex flex-row-reverse bd-highlight">
        <div class="p-2 bd-highlight">
            <button type="button" class="btn btn-primary" id='add'><i class="fas fa-plus"></i>&nbsp;Добавить</button>
            <button type="button" class="btn btn-primary" id='delete'><i class="fas fa-minus"></i>&nbsp;Удалить</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12 table-border">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">&nbsp;</th>
                        <!-- <th scope="col">№</th> -->
                        <th scope="col">
                            <span id='sortByDate'>
                                Дата &nbsp; @if ($sortbydate) <i class="fas fa-sort-up"></i> @else <i class="fas fa-sort-down"></i> @endif
                            </span>
                        </th>
                        <th scope="col">Наименование</th>
                        <th scope="col">
                            <span id='sortByPrice'>
                                Цена &nbsp; @if ($sortbyprice) <i class="fas fa-sort-up"></i> @else <i class="fas fa-sort-down"></i> @endif
                            </span>
                        </th>
                        <th scope="col">Фото</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $value)
                    <tr>
                        <th data-id='-1' scope='row'><input data-id='{{$value->id}}' type="checkbox" class="form-check-input"></th>
                        <!-- <td data-id='{{$value->id}}'>{{$value->id}}</td> -->
                        <td data-id='{{$value->id}}'>{{date('d/m/Y', strtotime($value->created_by))}}</td>
                        <td data-id='{{$value->id}}'>{{$value->name}}</td>
                        <td data-id='{{$value->id}}'>{{$value->price}}</td>
                        @if ($value->url == null)
                            <td data-id='{{$value->id}}'><img src="https://image.shutterstock.com/image-vector/stop-sign-vector-illustration-isolated-260nw-1685661304.jpg" alt='Фото' /></td>
                        @else
                            <td data-id='{{$value->id}}'><img src="{{$value->url}}" alt='Фото' /></td>
                        @endif
                    </tr>
                    @endforeach
                    <br>
                </tbody>
            </table>
        </div>
    </div>

    @include('pagination.default', ['paginator' => $paginator])

</container>

@include('footer')
@if($model instanceof \Illuminate\Database\Eloquent\Model)
    @php
        if (isset($columns)) {
            $filters = array_filter(Request::only($columns));
        }

        if (!empty($filters)) {
            foreach ($filters as $field => $value) {
                $model = $model->where($field, 'LIKE',"%$value%");
            }
        }

        $items = $model->paginate(15);
    @endphp
    {!! Form::open(['route' => Route::current()->name, 'id' => 'filter-form', 'method' => 'GET']) !!}
    {!! Form::close() !!}
    <div class="row justify-content-between mb-2">
        <div class="col-4">
            {!! $items->links() !!}
        </div>
        <div class="col-4">
            <a href="/{{ Route::current()->uri() . "/create" }}" class="btn btn-primary float-end"
               style="width: fit-content"><i class="fa fa-plus"></i>{{__("New")}}</a>
            <button type="submit" form="filter-form" class="btn btn-primary float-end mx-1"
                    style="width: fit-content"><i class="fa fa-filter"></i>{{__("Filter")}}</button>
        </div>

    </div>
    <div class="table-responsive card">
        <table class="table table-striped table-hover mb-0">
            <thead>
            <tr>
                @foreach($columns as $column)
                    <th scope="col">{{ $column != "id" ? __(ucfirst($column)) : "#" }}</th>
                @endforeach
            </tr>
            <div>
                @foreach($columns as $column)
                    <th scope="col">
                        {{ Form::text($column, $filters[$column] ?? null, ['class' => 'form-control', 'form' => 'filter-form']) }}
                    </th>
                @endforeach
            </div>
            </thead>
            <tbody>
            @if($items->isEmpty())
                <tr>
                    <th scope="row" class="text-center" colspan="{{count($columns)}}">{{ __("Opss...Nothing found!") }}</th>
                </tr>
            @else
                @foreach ($items as $item)
                    <tr onclick="window.location = '/{{ Route::current()->uri() . "/$item->id/edit" }}'">
                        @foreach($columns as $column)
                            <th scope="row">{{ __($item[$column]) }}</th>
                        @endforeach
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endif

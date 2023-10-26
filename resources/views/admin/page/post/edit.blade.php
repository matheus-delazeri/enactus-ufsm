@extends('admin.layout.default', ['menu' => true])

@section('content')
    @isset($post)
        @can("update", $post)
            <h2 class="page-title"><i class="fa fa-pencil"></i>{{ ("Post #" . $post->id)}}</h2>
            <p class="text-comment"><i class="fa fa-chevron-right"></i>{{ ("Edit post") }}</p>
            {{ Form::model($post, ['route' => ['admin.post.update', $post->id], 'files' => true, 'method' => 'PUT']) }}
        @else
            @php abort(403) @endphp
        @endcan
    @else
        <h2 class="page-title"><i class="fa fa-pencil"></i>{{ ("Posts") }}</h2>
        <p class="text-comment"><i class="fa fa-chevron-right"></i>{{ ("New post") }}</p>
        {{ Form::open(['route' => 'admin.post.store', 'files' => true]) }}
    @endif
    <div class="d-flex w-100 px-4 gap-2 mb-4 align-items-center justify-content-end">
        <button type="submit" class="btn btn-primary float-end"><i class="fa fa-save"></i>{{__("Save")}}</button>
    </div>
    <div class="row w-100">
        <div class="col-md-10">
            {{ Form::label('title', __('Title'), ['class' => 'form-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control mb-3']) }}
            {{ Form::label('url_key', __('URL Key'), ['class' => 'form-label']) }}
            <p class="text-comment"><i class="fa fa-chevron-right"></i>{{__("If empty will use post's title")}}</p>
            {{ Form::text('url_key', null, ['class' => 'form-control mb-3']) }}
            {{ Form::label('short_content', __('Short Content'), ['class' => 'form-label']) }}
            {{ Form::text('short_content', null, ['class' => 'form-control mb-3']) }}
            {{ Form::label('content', __('Content'), ['class' => 'form-label']) }}
            {{ Form::textarea('content', null, ['class' => 'form-control'])}}
            <hr/>
            {{ Form::label('meta_description', __('Meta Description'), ['class' => 'form-label']) }}
            {{ Form::text('meta_description', null, ['class' => 'form-control mb-3']) }}
            {{ Form::label('meta_keywords', __('Meta Keywords'), ['class' => 'form-label']) }}
            <p class="text-comment"><i
                    class="fa fa-chevron-right"></i>{!!__("Type keywords that will be used for SEO. Each word delimited by <kbd>,</kbd>")!!}
            </p>
            {{ Form::text('meta_keywords', null, ['class' => 'form-control mb-3']) }}
        </div>
        <div class="col-md-2">
            {{ Form::label('file', __('Image'), ['class' => 'form-label']) }}
            @isset($post)
                @isset($post->image)
                    <div class="w-100 form-control p-2 mb-2">
                        <img class="w-100" src="{{ $post->image }}" style="aspect-ratio: 1 / 1; object-fit: cover"/>
                    </div>
                @endisset
            @endisset
            {{ Form::file('file', ['class' => 'form-control mb-3']) }}
            {{ Form::close() }}
        </div>
    </div>
    {{ Form::close() }}
@endsection

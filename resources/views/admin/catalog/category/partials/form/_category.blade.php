@if (count($categoryFhater->allChildrens))
    @foreach ($categoryFhater->allChildrens as $categoryChild)
        <option {{ isset($category) ? ($categoryChild->id == $category->id ? 'disabled' : '') : ''  }} value="{{ $categoryChild->id }}" style="padding-left: 15px;">{{ $categoryChild->name }}</option>
        @if (count($categoryChild->allChildrens))
            @include('admin.catalog.category.partials.form._category', ['categoryFhater' => $categoryChild, 'style' => 'padding-left: 30px;'])
        @endif
    @endforeach
@endif


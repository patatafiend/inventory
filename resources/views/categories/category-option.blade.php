<option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
    {!! str_repeat('&mdash;', $level) !!} {{ $category->name }}
</option>
@foreach($category->children as $child)
    @include('categories.category-option', ['category' => $child, 'level' => $level + 1])
@endforeach
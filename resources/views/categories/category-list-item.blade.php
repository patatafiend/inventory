<li id="category-{{ $category->id }}" class="category-item level-{{ $level }} mb-2" style="list-style-type: none;">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center" style="padding-left: {{ $level * 20 }}px;">
            @if ($category->children->count() > 0)
                <button class="toggle-btn btn btn-sm btn-outline-primary me-2" onclick="toggleSubcategories({{ $category->id }})">
                    ▸
                </button>
            @else
                <span class="me-2"></span>
            @endif
            <span class="category-name" style="text-decoration: underline;">{{ $category->name }}</span>
        </div>
        <div>
            <button class="btn btn-sm btn-outline-secondary me-2 edit-category" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-parent-id="{{ $category->parent_id }}">
                <i class="fas fa-edit"></i> Edit
            </button>
            <button type="button" class="btn btn-sm btn-outline-danger delete-category" data-id="{{$category->id}}">
                <i class="fas fa-trash"></i> Delete
            </button>
        </div>
    </div>

    @if ($category->children->count() > 0)
        <ul class="list-group collapse subcategories mt-2" id="subcategories-{{ $category->id }}" style="list-style-type: none;">
            @foreach ($category->children as $child)
                @include('categories.category-list-item', ['category' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>


<script>
    function toggleSubcategories(id) {
        let subcategories = document.getElementById('subcategories-' + id);
        let toggleBtn = document.querySelector(`button[onclick="toggleSubcategories(${id})"]`);

        if (subcategories.classList.contains('collapse')) {
            subcategories.classList.remove('collapse');
            subcategories.classList.add('show');
            toggleBtn.innerHTML = "▾"; 
        } else {
            subcategories.classList.add('collapse');
            subcategories.classList.remove('show');
            toggleBtn.innerHTML = "▸";
        }
    }

    function deleteCategory(id, name) {
        if (confirm(`Are you sure you want to delete the category "${name}"?`)) {
            document.getElementById('delete-category-form-' + id).submit();
        }
    }
</script>
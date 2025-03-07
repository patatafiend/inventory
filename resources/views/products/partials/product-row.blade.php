<tr id="product-{{ $product->id }}">
    <td>{{ $product->name }}</td>
    <td>{{ $product->description }}</td>
    <td>{{ $product->quantity }}</td>
    <td>{{ $product->price }}</td>
    <td>{{ $product->category->name ?? 'N/A' }}</td>
    <td>{{ $product->unit->name ?? 'N/A' }}</td>
    <td>
        <button class="btn btn-info view-product" data-id="{{ $product->id }}">View</button>
        <button class="btn btn-warning edit-product" data-id="{{ $product->id }}">Edit</button>
        <button class="btn btn-danger delete-product" data-id="{{ $product->id }}">Delete</button>
    </td>
</tr>
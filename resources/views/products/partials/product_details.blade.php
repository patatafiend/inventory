<div>
    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
    <p><strong>Price:</strong> {{ $product->price }}</p>
    <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
    <p><strong>Unit:</strong> {{ $product->unit->name ?? 'N/A' }}</p>
</div>

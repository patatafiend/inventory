<form id="editProductForm">
    @csrf
    @method('PUT')
    <div class="form-group">
        <input type="hidden" name="id" id="editProductId" value="{{ $product->id }}">

        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Product</button>
</form>
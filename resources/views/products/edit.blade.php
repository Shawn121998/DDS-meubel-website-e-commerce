<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

    <h2>Edit Produk</h2>

    <form action="{{ route('produk.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Produk:</label><br>
        <input type="text" name="name" value="{{ $product->name }}"><br><br>

        <label>Harga:</label><br>
        <input type="number" name="price" value="{{ $product->price }}"><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="description">{{ $product->description }}</textarea><br><br>

        <button type="submit">Update</button>
    </form>

</body>
</html>
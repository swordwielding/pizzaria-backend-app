@extends('layouts.app')

@section('content')
<h1>Редактирование товара</h1>

<form action="{{ route('products.update', $product->slug) }}" method="POST" enctype="multipart/form-data" class="product-form">
    @csrf
    @method('PUT')

    <label>Название:</label>
    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
    <x-form.error for="name"/>

    <label>Описание:</label>
    <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
    <x-form.error for="description"/>

    <label>Цена:</label>
    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" required>
    <x-form.error for="price"/>

    <label>Изображение:</label>
    <input type="file" name="image" id="image">
    <x-form.error for="image"/>

    <label>Категория:</label>
    <select name="category_id" id="category_id">
        <option value="">Выберите категорию</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <x-form.error for="category_id"/>

    <label>Теги:</label>
    <select name="tags[]" id="tags" multiple>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>
    <x-form.error for="tags"/>

    <label>
        <input type="hidden" name="is_available" value="0">
        Доступно для продажи
    <input type="checkbox" name="is_available" value="1" {{ $product->is_available ? 'checked' : '' }}>
    </label>

    <button type="submit">Обновить</button>
</form>
<form action="{{ route('products.destroy', $product) }}" method="POST" enctype="multipart/form-data" class="product-form">
    @method('DELETE')
    @csrf
    <button type="submit">Удалить</button>
</form>
@endsection


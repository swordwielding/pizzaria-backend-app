@extends('layouts.app')

@section('content')

    <nav class="categories-nav">
        @foreach ($categories as $category)
            <a href="#category-{{ $category->id }}">{{ $category->name }}</a>
        @endforeach
    </nav>

    @foreach ($categories as $category)
        <section id="category-{{ $category->id }}" class="category-section">
            <h2 class="category-title">{{ $category->name }}</h2>

            <div class="products-grid">
                @forelse ($products->where('category_id', $category->id) as $product)

                    <div class="product-card {{ $product->is_available ? '' : 'product-card--disabled' }}">
                        <a href="{{ route('products.show', $product) }}">
                            <div class="product-image">
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                            </div>
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-description">{{ Str::limit($product->description, 80) }}</p>
                            <div class="product-footer">
                                <span class="price">{{ number_format($product->price, 0, '', ' ') }} ₽</span>
                                <span class="btn-choose">Открыть</span>
                            </div>
                        </a>
                    </div>

                @empty
                    <p class="no-products">Нет товаров в этой категории</p>
                @endforelse
            </div>
        </section>
    @endforeach
@endsection

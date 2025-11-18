@extends('layouts.app');
@section('content')

    <div>
        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
    </div>
            <h3 class="product-title">{{ $product->name }}</h3>
            <p class="product-description">{{$product->description}}</p>
            @foreach ($product->tags as $tag)
            <p class="inline">{{ $tag->name }}</p>
            
            @endforeach
            <br>
            @if ($product->is_available)
                <span class="text-blue-600">Доступно для продажи</span>
            @else
                <span class="text-gray-500">Недостпуно для продажи</span>
            @endif
            <div class="product-footer">
                <span class="price">{{ number_format($product->price, 0, '', ' ') }} ₽</span>
                <a href="{{ route('products.edit', $product)}}" class="btn-choose">Редактировать</a>
            </div>
@endsection
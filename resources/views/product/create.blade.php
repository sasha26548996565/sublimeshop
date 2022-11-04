@extends('layouts.master')

@section('title', 'Create product')

@section('content')
    <div class="container">
        <h1>Create product</h1>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <input type="text" name="name" required placeholder="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <textarea name="description" placeholder="description" required class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <input type="number" name="price" placeholder="price" step="0.01" required class="form-control" value="{{ old('price') }}">
            </div>

            <div class="form-group">
                <input type="number" name="quantity" placeholder="quantity" required class="form-control" value="{{ old('quantity') }}" min="1">
            </div>

            <div class="form-group">
                <input type="file" name="image" placeholder="image" required class="form-control" value="{{ old('image') }}">
            </div>

            <div class="form-group">
                <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Create product">
            </div>
        </form>
    </div>
@endsection

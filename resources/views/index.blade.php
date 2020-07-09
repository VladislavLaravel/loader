@extends('layouts.app')

@section('content')
<!-- <iframe src="https://datahub.io/core/country-list/r/0.html" width="100%" height="100%" frameborder="1"></iframe> -->
<div class="container">
    <form method="get" class="vacancies-filter-js" action="{{ route('index')}}">
        <div class="form-group row">
            <div class="col-md-6">
                <h1>
                    Products ({{count($products)}})
                </h1>
            </div>
            <div class="col-md-3">
                <input type="text" name="name" value="{{$filter['name']}}" placeholder="Name or product" class="form-control form-control-lg">
            </div>
            <div class="col-md-3">
                <input type="submit" name="">
            </div>
            
        </div>
        <div class="form-group row">
            <div class="col-md-6">
            </div>
            <div class="col-md-1">
                <p>Sort by:</p>
            </div>
            <div class="col-md-1">
                <a href="#" class="sort-js" data-name = 'price'>Price</a>
            </div>
            <div class="col-md-1">
                <a href="#" class="sort-js" data-name = 'name'>Name</a>
            </div>
            <div class="col-md-1">
                <a href="#" class="sort-js" data-name = 'size'>Size</a>
            </div>
            <div class="col-md-1">
                <a href="#" class="sort-js" data-name = 'color'>Color</a>
            </div>
            <div class="col-md-1">
                <a href="#" class="sort-js" data-name = 'taste'>Taste</a>
            </div>
        </div>
        <input type="text" name="sort-type" class="name-js d-none" value="{{$filter['sort-type']}}">
        <input type="text" name="direction" class="direction-js d-none" value="{{$filter['direction']}}">

    </form>
    <table class="table table-striped vacancies-list-js">
        <thead><tr>
            <th>Name</th>
            <th>Price</th>
            <th>Size</th>
            <th>Color</th>
            <th>Taste</th>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    {{$product->name}}<br>
                </td>
                <td>
                    {{$product->price}}<br>
                </td>
                <td>
                    {{$product->size}}<br>
                </td>
                <td>
                    {{$product->color}}<br>
                </td>
                <td>
                    {{$product->taste}}<br>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">no products</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <form method="post" class="file-js" action="{{ route('product.load')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="list">
        <input type="submit" name="">
    </form>
</div>
@endsection
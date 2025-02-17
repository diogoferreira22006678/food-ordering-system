@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Menu Items</h2>
    <a href="{{ route('menu.create') }}" class="btn btn-primary">Add New Item</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Options</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menuItems as $item)
                <tr>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}" width="50" alt="Food Image">
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->options }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>
                        <form action="{{ route('menu.destroy', $item) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

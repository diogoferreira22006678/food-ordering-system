@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Table {{ $table->name }} - Order</h2>
    <form action="{{ route('order.place', $table->id) }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menu as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td><input type="number" name="items[{{ $item->id }}]" min="0" class="form-control"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection

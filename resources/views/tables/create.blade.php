@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('tables.index') }}" class="btn btn-secondary mb-3">← Back to Tables</a>
    <h2>{{ isset($table) ? 'Edit Table' : 'Add Table' }}</h2>

    <form action="{{ isset($table) ? route('tables.update', ['table' => $table->id]) : route('tables.store') }}" method="POST">
        @csrf
        @if(isset($table))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="table_name" class="form-label">Table Name</label>
            <input type="text" name="table_name" class="form-control" value="{{ $table->table_name ?? '' }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($table) ? 'Update' : 'Add' }}</button>
    </form>
</div>
@endsection


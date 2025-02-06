@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Back Button -->
    <a href="{{ route('tables.index') }}" class="btn btn-secondary mb-3 shadow-sm d-flex align-items-center" 
       style="font-size: 14px; padding: 8px 12px; border-radius: 6px;">
        <i class="fas fa-arrow-left me-2"></i> Back to Tables
    </a>

    <!-- Header -->
    <h2 class="text-center mb-4" style="font-weight: bold; font-size: 28px;">
        {{ isset($table) ? 'Edit Table' : 'Add Table' }}
    </h2>

    <!-- Form Card -->
    <div class="card shadow-sm p-4" style="max-width: 600px; margin: 0 auto; border-radius: 12px;">
        <form action="{{ isset($table) ? route('tables.update', ['table' => $table->table_id]) : route('tables.store') }}" method="POST">
            @csrf
            @if(isset($table))
                @method('PUT')
            @endif

            <!-- Table Name Input -->
            <div class="mb-4">
                <label for="table_name" class="form-label" style="font-weight: bold; font-size: 16px;">Table Name</label>
                <input type="text" name="table_name" class="form-control shadow-sm" 
                       value="{{ $table->table_name ?? '' }}" 
                       placeholder="Enter table name" 
                       style="font-size: 14px; padding: 12px; border-radius: 8px;" required>
            </div>

            <!-- Table seats Input -->
            <div class="mb-4">
                <label for="table_name" class="form-label" style="font-weight: bold; font-size: 16px;">Table seats</label>
                <input type="number" name="seats" class="form-control shadow-sm" 
                       value="{{ $table->seats ?? '' }}" 
                       placeholder="Enter table seats" 
                       style="font-size: 14px; padding: 12px; border-radius: 8px;" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success w-100 shadow-sm" 
                    style="font-size: 16px; padding: 10px 0; border-radius: 8px;">
                {{ isset($table) ? 'Update Table' : 'Add Table' }}
            </button>
        </form>
    </div>
</div>
@endsection

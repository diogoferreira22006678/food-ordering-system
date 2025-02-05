@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Table Layout</h2>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('tables.create') }}" class="btn btn-primary">Add Table</a>
        <p class="text-muted">Drag and drop the tables to reposition them</p>
    </div>

    <div id="table-layout" class="rounded shadow" 
         style="position: relative; border: 2px dashed #ccc; width: 100%; max-width: 900px; height: 500px; background-color: #f8f9fa; padding: 15px; margin: 0 auto;">
        @foreach($tables as $table)
            <div class="table-item" 
                 data-id="{{ $table->table_id }}"
                 style="position: absolute; 
                        top: {{ $table->y_position }}px; 
                        left: {{ $table->x_position }}px; 
                        width: 120px; 
                        height: 120px; 
                        display: flex; 
                        align-items: center; 
                        justify-content: center;
                        font-weight: bold;
                        border-radius: 50%; 
                        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                        background-color: {{ $table->status == 'free' ? '#28a745' : '#dc3545' }}; 
                        color: white;">
                <div class="table-content text-center">
                    <span style="font-size: 16px;">{{ $table->table_name }}</span>
                </div>
                <form action="{{ route('tables.destroy', ['table' => $table->table_id]) }}" method="POST" 
                      style="position: absolute; top: -10px; right: -10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger rounded-circle" 
                            style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                        &times;
                    </button>
                </form>
            </div>
            <div style="position: absolute; 
                        top: {{ $table->y_position + 120 }}px; 
                        left: {{ $table->x_position + 40 }}px; 
                        width: 40px; 
                        height: 10px; 
                        background-color: #6c757d; 
                        border-radius: 5px;">
            </div>
        @endforeach
    </div>
</div>

<!-- jQuery & jQuery UI for Drag and Drop -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function(){
        $(".table-item").draggable({
            containment: "#table-layout",
            stop: function(event, ui) {
                let tableId = $(this).data('id');
                let xPos = ui.position.left;
                let yPos = ui.position.top;

                // AJAX call to update table position in DB
                $.ajax({
                    url: "{{ route('tables.updatePosition') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: tableId,
                        x_position: xPos,
                        y_position: yPos
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(xhr) {
                        console.error("Error saving position: " + xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endsection

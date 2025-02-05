@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center" style="font-weight: bold; font-size: 28px;">Table Layout</h2>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('tables.create') }}" class="btn btn-primary shadow-sm" style="font-size: 16px;">
            <i class="fas fa-plus"></i> Add Table
        </a>
        <p class="text-muted" style="font-size: 14px;">Drag and drop the tables to reposition them.</p>
    </div>

    <div id="table-layout" class="rounded shadow-lg position-relative" 
         style="position: relative; border: 3px dashed #ccc; width: 100%; max-width: 1200px; height: 800px; 
                background: linear-gradient(135deg, #ffffff, #f9f9fa); margin: 0 auto 50px;">
        @foreach($tables as $table)
            <!-- Table Representation -->
            <div class="table-item shadow-lg text-center" 
                 data-id="{{ $table->table_id }}"
                 data-edit-url="{{ route('tables.edit', ['table' => $table->table_id]) }}"
                 style="position: absolute; 
                        top: {{ $table->y_position }}px; 
                        left: {{ $table->x_position }}px; 
                        display: flex; 
                        flex-direction: column; 
                        align-items: center; 
                        justify-content: center; 
                        text-align: center;
                        font-weight: bold; 
                        transition: transform 0.2s, box-shadow 0.2s;">
                
                <!-- Table Image -->
                <img src="{{ asset('assets/table.png') }}" alt="Table" 
                     style="width: 100px; height: 100px; object-fit: cover;
                            border: 2px solid {{ $table->status == 'free' ? '#28a745' : '#dc3545' }};">
                
                <!-- Table Info -->
                <div class="mt-2">
                    <div style="font-size: 14px; font-weight: bold;">{{ $table->table_name }}</div>
                    <div style="font-size: 12px; color: {{ $table->status == 'free' ? '#28a745' : '#dc3545' }};">
                        {{ $table->status == 'free' ? 'Available' : 'Occupied' }}
                    </div>
                </div>

                <!-- Remove Table Button -->
                <form action="{{ route('tables.destroy', ['table' => $table->table_id]) }}" method="POST" 
                      style="position: absolute; top: -10px; right: -10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger rounded-circle" 
                            style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-times"></i>
                    </button>
                </form>
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

        // Handle click event to redirect to the edit page
        $(".table-item").on("click", function() {
            //
            const editUrl = $(this).data("edit-url");
            window.location.href = editUrl;
        });

        // Add hover effect for table items
        $(".table-item").hover(
            function() {
                $(this).css("transform", "scale(1.05)").css("box-shadow", "0 8px 16px rgba(0,0,0,0.2)");
            },
            function() {
                $(this).css("transform", "scale(1)").css("box-shadow", "0 4px 6px rgba(0,0,0,0.1)");
            }
        );
    });
</script>
@endsection

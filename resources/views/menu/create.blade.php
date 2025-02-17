@extends('layouts.app')
<style>
    .custom-select-container {
        position: relative;
    }

    .custom-input {
        cursor: pointer;
        background-color: white;
        border-radius: 0.375rem;
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        width: 100%;
    }

    .selected-options {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 5px;
    }

    .selected-options .badge {
        background-color: #007bff;
        color: white;
        cursor: pointer;
        padding: 5px 8px;
        border-radius: 12px;
    }

    .custom-options {
        position: absolute;
        width: 100%;
        background: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        display: none;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
    }

    .custom-options .option {
        padding: 8px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .custom-options .option:hover {
        background: #007bff;
        color: white;
    }
</style>
@section('content')
<div class="container">
    <h2>Add New Menu Item</h2>
    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control">
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <!-- Select Único -->
            <div class="custom-select-container mb-4">
                <label for="customSingleSelect" class="form-label">Category:</label>
                <input type="text" class="form-control custom-input" name="category" id="customSingleSelect" placeholder="Digite ou selecione" required>
                <div class="custom-options" id="singleSelectOptions">
                @foreach($categories as $category)
                    <div class="option">{{ $category->name }}</div>
                @endforeach
                </div>
            </div>
        </div>
            <div class="form-group">
            <!-- Multi-Select -->
            <div class="custom-select-container">
                <label for="customMultiselectDisplay" class="form-label">Opções:</label>
                <input type="text" class="form-control custom-input" id="customMultiselectDisplay" placeholder="Digite ou selecione">
                <input type="hidden" id="customMultiselect" name="options">
                
                <div class="custom-options" id="multiSelectOptions">
                    
                </div>
                <div class="selected-options" id="selectedOptions"></div>
            </div>
        </div>
        <button class="btn btn-success mt-2">Save</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Select Único
        const singleSelect = document.getElementById("customSingleSelect");
        const singleOptionsBox = document.getElementById("singleSelectOptions");
        const singleOptions = singleOptionsBox.querySelectorAll(".option");

        // Multi-Select
        const multiSelectDisplay = document.getElementById("customMultiselectDisplay");
        const multiSelect = document.getElementById("customMultiselect");
        const multiOptionsBox = document.getElementById("multiSelectOptions");
        const multiOptions = multiOptionsBox.querySelectorAll(".option");
        const selectedOptionsContainer = document.getElementById("selectedOptions");

        let selectedOptions = [];

        // 🔹 Mostrar opções ao clicar no input
        singleSelect.addEventListener("focus", () => singleOptionsBox.style.display = "block");
        multiSelectDisplay.addEventListener("focus", () => multiOptionsBox.style.display = "block");

        // 🔹 Ocultar ao clicar fora
        document.addEventListener("click", (e) => {
            if (!singleSelect.contains(e.target) && !singleOptionsBox.contains(e.target)) {
                singleOptionsBox.style.display = "none";
            }
            if (!multiSelectDisplay.contains(e.target) && !multiOptionsBox.contains(e.target)) {
                multiOptionsBox.style.display = "none";
            }
        });

        // 🔹 Selecionar no Select Único
        singleOptions.forEach(option => {
            option.addEventListener("click", () => {
                singleSelect.value = option.textContent;
                singleOptionsBox.style.display = "none";
            });
        });

        // 🔹 Selecionar no Multi-Select
        multiOptions.forEach(option => {
            option.addEventListener("click", () => {
                const value = option.textContent;
                if (!selectedOptions.includes(value)) {
                    selectedOptions.push(value);
                    updateSelectedOptions();
                }
                multiOptionsBox.style.display = "none";
                multiSelectDisplay.value = ""; // Limpa input de digitação
            });
        });

        // 🔹 Permitir adição manual no Multi-Select
        multiSelectDisplay.addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                const value = multiSelectDisplay.value.trim();
                if (value && !selectedOptions.includes(value)) {
                    selectedOptions.push(value);
                    updateSelectedOptions();
                }
                e.preventDefault(); // 🔹 Evita comportamento padrão do Enter
                multiSelectDisplay.value = ""; // 🔹 Limpa o input
                filterOptions("", multiOptionsBox); // 🔹 Mantém a lista aberta
                multiSelectDisplay.blur()
                multiOptionsBox.style.display = "none"; // 🔹 Fecha a lista de opções
            }
        });

        // 🔹 Atualizar interface e input oculto do Multi-Select
        function updateSelectedOptions() {
            selectedOptionsContainer.innerHTML = '';
            selectedOptions.forEach(option => {
                const badge = document.createElement("span");
                badge.classList.add("badge", "badge-pill");
                badge.textContent = option;
                
                // Remover opção ao clicar
                badge.addEventListener("click", () => {
                    selectedOptions = selectedOptions.filter(item => item !== option);
                    updateSelectedOptions();
                });

                selectedOptionsContainer.appendChild(badge);
            });

            // Atualiza o input oculto com os valores selecionados (para o backend)
            multiSelect.value = selectedOptions.join(", ");
        }

        // 🔹 Filtrar opções conforme o usuário digita
        function filterOptions(input, optionsBox) {
            const filter = input.toLowerCase();
            const options = optionsBox.querySelectorAll(".option");

            options.forEach(option => {
                if (filter === "" || option.textContent.toLowerCase().includes(filter)) {
                    option.style.display = "block"; // 🔹 Exibe todas as opções se o input estiver vazio
                } else {
                    option.style.display = "none";
                }
            });

            optionsBox.style.display = "block"; // 🔹 Mantém a lista aberta ao digitar
        }


        singleSelect.addEventListener("input", () => filterOptions(singleSelect.value, singleOptionsBox));
        multiSelectDisplay.addEventListener("input", () => filterOptions(multiSelectDisplay.value, multiOptionsBox));
    });
</script>

@endsection

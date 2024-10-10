@extends('layouts.app')

@section('content')
    {{-- <div class="container-fluid">
        <h1 class="text-black-50">You are logged in!</h1>
    </div> --}}
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">PDF Annotation Tool</h1>

        <!-- File Input -->
        <input type="file" id="pdf-file-input" accept="application/pdf" class="mb-4 p-2 border border-gray-300 rounded">

        <!-- Canvas Wrapper with Relative Position -->
        <div class="canvas-container relative mb-4" style="border: 1px solid #ccc; position: relative;">
            <!-- PDF Canvas -->
            <canvas id="pdf-canvas" style="position: absolute; top: 0; left: 0;"></canvas>
            <!-- Fabric Canvas (Overlayed) -->
            <canvas id="fabric-canvas" style="position: absolute; top: 0; left: 0;"></canvas>
        </div>

        <!-- Annotation Buttons -->
        <div class="flex space-x-4 mb-4">
            <button id="draw-button" class="px-4 py-2 bg-blue-500 text-white rounded">Draw</button>
            <button id="erase-button" class="px-4 py-2 bg-red-500 text-white rounded">Erase</button>
        </div>

        <!-- Save Button -->
        <button id="save" class="px-4 py-2 bg-green-500 text-white rounded">Save PDF</button>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
    <script src="{{ asset('js/lib/fabric.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script> <!-- Your custom JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>
@endsection

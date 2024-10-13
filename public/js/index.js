// Load PDF.js library
const pdfjsLib = window['pdfjs-dist/build/pdf'];

// Canvas elements
const pdfCanvas = document.getElementById('pdf-canvas');
const fabricCanvasElement = document.getElementById('fabric-canvas');

// PDF.js rendering context
const ctx = pdfCanvas.getContext('2d');

// Initialize Fabric.js canvas
const fabricCanvas = new fabric.Canvas('fabric-canvas');

let currentPdfFile = null; // Holds the currently loaded PDF file

// Function to load and render PDF
function loadPDF(pdfFile) {
    const fileReader = new FileReader();
    fileReader.onload = function() {
        const typedArray = new Uint8Array(this.result);

        pdfjsLib.getDocument(typedArray).promise.then((pdf) => {
            pdf.getPage(1).then((page) => {
                const viewport = page.getViewport({ scale: 1.5 });
                pdfCanvas.width = viewport.width;
                pdfCanvas.height = viewport.height;
                fabricCanvasElement.width = viewport.width;
                fabricCanvasElement.height = viewport.height;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport,
                };
                page.render(renderContext).promise.then(() => {
                    // Match the size of the Fabric canvas after PDF rendering
                    fabricCanvas.setWidth(viewport.width);
                    fabricCanvas.setHeight(viewport.height);
                });
            });
        });
    };
    fileReader.readAsArrayBuffer(pdfFile);
}

// Handle file selection
document.getElementById('pdf-file-input').addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        currentPdfFile = file;
        loadPDF(file); // Load the selected PDF file
    }
});

// Set default to free drawing mode (drawing functionality)
fabricCanvas.isDrawingMode = true; // Enables free drawing mode by default
fabricCanvas.freeDrawingBrush.color = "blue"; // Set default brush color
fabricCanvas.freeDrawingBrush.width = 5; // Set default brush width

// Draw button functionality
document.getElementById('draw-button').addEventListener('click', () => {
    fabricCanvas.isDrawingMode = true; // Enable drawing mode
    document.getElementById('brush-settings').style.display = 'block'; // Show brush settings
});

// Erase button functionality
document.getElementById('erase-button').addEventListener('click', () => {
    fabricCanvas.isDrawingMode = false; // Disable drawing mode
    document.getElementById('brush-settings').style.display = 'none'; // Hide brush settings

    // Enable object selection and allow removing drawings
    fabricCanvas.on('mouse:down', function (event) {
        const activeObject = fabricCanvas.getActiveObject();
        if (activeObject) {
            fabricCanvas.remove(activeObject); // Erase selected object
        }
    });
});

// Handle brush width change
document.getElementById('brush-width-slider').addEventListener('input', (event) => {
    const newWidth = event.target.value;
    fabricCanvas.freeDrawingBrush.width = parseInt(newWidth); // Update brush width
});

// Handle brush color change
document.getElementById('color-picker').addEventListener('input', (event) => {
    const newColor = event.target.value;
    fabricCanvas.freeDrawingBrush.color = newColor; // Update brush color
});

// Save the annotated canvas as a PDF
document.getElementById('save').addEventListener('click', async () => {
    if (currentPdfFile) {
        // Convert Fabric.js canvas to an image
        const fabricImage = new Image();
        fabricImage.src = fabricCanvas.toDataURL('image/png');

        // Load pdf-lib and manipulate the PDF
        const existingPdfBytes = await currentPdfFile.arrayBuffer();

        // Load a PDFDocument from the existing PDF bytes
        const pdfDoc = await PDFLib.PDFDocument.load(existingPdfBytes);

        // Get the first page of the document
        const pages = pdfDoc.getPages();
        const firstPage = pages[0];

        // Embed the Fabric.js canvas as an image onto the first page of the PDF
        const pngImage = await pdfDoc.embedPng(fabricImage.src);
        const { width, height } = firstPage.getSize();

        firstPage.drawImage(pngImage, {
            x: 0,
            y: 0,
            width: width,
            height: height,
        });

        // Serialize the PDFDocument to bytes (a Uint8Array)
        const pdfBytes = await pdfDoc.save();

        // Automatically download the new PDF
        const blob = new Blob([pdfBytes], { type: 'application/pdf' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = currentPdfFile.name; // Use the original file name
        link.click();
    } else {
        alert('Please upload a PDF file first.');
    }
});

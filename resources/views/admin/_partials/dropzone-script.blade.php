{{-- Shared dropzone CSS + JS partial --}}
<style>
.dropzone {
    border: 2px dashed rgba(255,255,255,0.15);
    border-radius: 0.75rem;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.25s ease;
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.dropzone:hover, .dropzone.dragover {
    border-color: rgba(245,158,11,0.5);
    background: rgba(245,158,11,0.05);
}
.dropzone.dragover { transform: scale(1.01); }
</style>
<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const dz = document.getElementById('dz-content');
            const preview = document.getElementById('foto-preview');
            if (dz) dz.classList.add('hidden');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Drag & Drop for all dropzones on the page
document.querySelectorAll('.dropzone').forEach(zone => {
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('dragover'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('dragover');
        // Find the associated hidden input (next sibling)
        const input = zone.parentElement.querySelector('input[type="file"]');
        if (input && e.dataTransfer.files.length) {
            const dt = new DataTransfer();
            dt.items.add(e.dataTransfer.files[0]);
            input.files = dt.files;
            input.dispatchEvent(new Event('change'));
        }
    });
});
</script>

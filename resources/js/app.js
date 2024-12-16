import './bootstrap';
import Alpine from 'alpinejs';
import Quill from 'quill';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    // Initialize the Quill editor if the container exists
    const quillContainer = document.querySelector('#content-editor');
    const contentInput = document.querySelector('#content');
    const form = document.querySelector('#post-form');

    if (quillContainer) {
        const quill = new Quill(quillContainer, {
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, 4, false] }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block'],
                ],
            },
            placeholder: 'Compose an epic...',
            theme: 'snow',
        });

        // Pre-fill the Quill editor with existing content if available
        if (contentInput?.value) {
            quill.clipboard.dangerouslyPasteHTML(contentInput.value);
        }

        // Sync Quill content to the hidden input on form submission
        form?.addEventListener('submit', () => {
            if (contentInput) {
                contentInput.value = quill.root.innerHTML;
            }
        });
    }
});

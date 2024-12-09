import './bootstrap';
import Alpine from 'alpinejs';
import Quill from 'quill';


window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const quill = new Quill('#content-editor', {
        modules: {
            toolbar: [
              [{ header: [1, 2, 3, 4, false] }],
              ['bold', 'italic', 'underline'],
              ['image', 'code-block'],
            ],
          },
          placeholder: 'Compose an epic...',
          theme: 'snow'
    });

    // Pre-fill the Quill editor with the existing post content
    const existingContent = document.querySelector('#content').value;
    if (existingContent) {
        quill.clipboard.dangerouslyPasteHTML(existingContent);
    }

    // Sync the Quill content to the hidden input on form submission
    const form = document.querySelector('#post-form');
    form.addEventListener('submit', function () {
        const contentInput = document.querySelector('#content');
        contentInput.value = quill.root.innerHTML; // Sync Quill editor's content to hidden input
    });
});


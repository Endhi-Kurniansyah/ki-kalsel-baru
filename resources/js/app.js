import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Import CKEditor
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

// Cari semua <textarea> yang punya ID 'content'
const editorElement = document.querySelector('#content');

if (editorElement) {
    // Jika ada, ubah <textarea> itu menjadi ClassicEditor
    ClassicEditor
        .create(editorElement)
        .catch(error => {
            console.error(error);
        });
}

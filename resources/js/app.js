import './bootstrap';
import Alpine from 'alpinejs';
// Import CKEditor Standar (Tanpa plugin resize yang bikin crash)
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

window.Alpine = Alpine;
Alpine.start();

/**
 * ==========================================
 * 1. INJEKSI CSS GLOBAL (PERBAIKAN UTAMA)
 * ==========================================
 * Kode ini ditaruh di luar agar jalan di Admin DAN Frontend (Pengunjung).
 * Ini akan memaksa gambar menjadi lebih kecil & rapi.
 */
const style = document.createElement('style');
style.innerHTML = `
    /* Target gambar di dalam konten berita (Admin & Frontend) */
    .ck-content .image img,
    .prose figure.image img {
        max-width: 80% !important; /* Batasi lebar maksimal 80% */
        height: auto !important;
        display: block;
        margin: 20px auto !important; /* Posisi di tengah */
        border-radius: 8px; /* Sedikit lengkungan biar manis */
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); /* Bayangan halus */
    }

    /* Khusus gambar yang di-set 'Side' (Samping) */
    .ck-content .image.image-style-side,
    .prose figure.image.image-style-side {
        float: right;
        margin-left: 1.5em;
        max-width: 40% !important;
    }

    /* Hapus background abu-abu pada caption default CKEditor */
    .ck-content .image > figcaption,
    .prose figure.image > figcaption {
        background-color: transparent !important;
        text-align: center;
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }
`;
document.head.appendChild(style);


/**
 * ==========================================
 * 2. CUSTOM UPLOAD ADAPTER
 * ==========================================
 */
class MyUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                this._initRequest();
                this._initListeners(resolve, reject, file);
                this._sendRequest(file);
            }));
    }

    abort() {
        if (this.xhr) {
            this.xhr.abort();
        }
    }

    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();
        // PENTING: URL ini harus '/admin/upload-image' sesuai route di web.php
        xhr.open('POST', '/admin/upload-image', true);

        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        if (tokenMeta) {
            xhr.setRequestHeader('X-CSRF-TOKEN', tokenMeta.getAttribute('content'));
        }

        xhr.responseType = 'json';
    }

    _initListeners(resolve, reject, file) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Gagal upload: ${file.name}.`;

        xhr.addEventListener('error', () => reject(genericErrorText));
        xhr.addEventListener('abort', () => reject());
        xhr.addEventListener('load', () => {
            const response = xhr.response;
            if (!response || response.error) {
                return reject(response && response.error ? response.error.message : genericErrorText);
            }
            resolve({
                default: response.url
            });
        });

        if (xhr.upload) {
            xhr.upload.addEventListener('progress', evt => {
                if (evt.lengthComputable) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            });
        }
    }

    _sendRequest(file) {
        const data = new FormData();
        data.append('upload', file);
        this.xhr.send(data);
    }
}

function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        return new MyUploadAdapter(loader);
    };
}

/**
 * ==========================================
 * 3. INISIALISASI CKEDITOR
 * ==========================================
 */
document.addEventListener("DOMContentLoaded", () => {

    // Cari elemen <textarea id="content">
    const editorElement = document.querySelector('#content');

    if (editorElement) {
        ClassicEditor
            .create(editorElement, {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'
                    ]
                }
            })
            .then(editor => {
                console.log('✅ CKEditor Siap.');
            })
            .catch(error => {
                console.error('❌ Error CKEditor:', error);
            });
    }
});

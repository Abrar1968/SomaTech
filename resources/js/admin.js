/**
 * Somaticx Admin Panel JavaScript
 *
 * Handles admin-specific functionality including:
 * - Sidebar toggle
 * - Form interactions
 * - Data table handling
 * - Image preview
 * - Rich text editor initialization
 */

// Alpine.js for admin reactivity
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

// Register plugins
Alpine.plugin(focus);

// Admin-specific stores
Alpine.store('sidebar', {
    collapsed: localStorage.getItem('sidebar-collapsed') === 'true',
    toggle() {
        this.collapsed = !this.collapsed;
        localStorage.setItem('sidebar-collapsed', this.collapsed);
    },
});

// Start Alpine
window.Alpine = Alpine;
Alpine.start();

// Image preview for file inputs
document.querySelectorAll('input[type="file"][data-preview]').forEach((input) => {
    input.addEventListener('change', function () {
        const previewId = this.dataset.preview;
        const preview = document.getElementById(previewId);

        if (preview && this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
});

// Confirm delete dialogs
document.querySelectorAll('[data-confirm-delete]').forEach((button) => {
    button.addEventListener('click', function (e) {
        const message = this.dataset.confirmDelete || 'Are you sure you want to delete this item?';
        if (!confirm(message)) {
            e.preventDefault();
        }
    });
});

// Auto-resize textareas
document.querySelectorAll('textarea[data-auto-resize]').forEach((textarea) => {
    const resize = () => {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    };
    textarea.addEventListener('input', resize);
    resize(); // Initial resize
});

// Slug generation from title
const titleInput = document.querySelector('[data-slug-source]');
const slugInput = document.querySelector('[data-slug-target]');

if (titleInput && slugInput) {
    titleInput.addEventListener('input', function () {
        if (!slugInput.dataset.edited) {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
        }
    });

    slugInput.addEventListener('input', function () {
        this.dataset.edited = 'true';
    });
}

// Toast notifications
window.showToast = (message, type = 'success') => {
    const container = document.getElementById('toast-container') || createToastContainer();

    const toast = document.createElement('div');
    toast.className = `
        flex items-center gap-3 px-4 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300
        ${type === 'success' ? 'bg-green-500/90 text-white' : ''}
        ${type === 'error' ? 'bg-red-500/90 text-white' : ''}
        ${type === 'warning' ? 'bg-yellow-500/90 text-white' : ''}
        ${type === 'info' ? 'bg-blue-500/90 text-white' : ''}
    `;

    toast.innerHTML = `
        <span>${message}</span>
        <button class="ml-2 hover:opacity-75" onclick="this.parentElement.remove()">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;

    container.appendChild(toast);

    // Animate in
    requestAnimationFrame(() => {
        toast.classList.remove('translate-x-full');
    });

    // Auto-remove after 5 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }, 5000);
};

function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'fixed top-4 right-4 z-50 space-y-2';
    document.body.appendChild(container);
    return container;
}

// Export for module usage
export { Alpine };

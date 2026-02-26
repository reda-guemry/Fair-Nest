import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    if (!window.Livewire || !window.Livewire.components.count()) {
        Alpine.start();
    }
});
import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
<<<<<<< HEAD
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
=======


window.Pusher = Pusher;

// console.log('Reverb Key:', import.meta.env.VITE_REVERB_APP_KEY);

window.Echo = new Echo({
    broadcaster: 'reverb',  
>>>>>>> feature/Message
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
<<<<<<< HEAD
});
=======
});
>>>>>>> feature/Message

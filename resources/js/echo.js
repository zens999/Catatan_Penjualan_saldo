import Echo from 'laravel-echo';
 
 
window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.private('pesan')
    .listen('PendapatanDitTarik', (e) => {
        console.log(e);
        alert('penadapatan anda ' + e.nominal + ' baru saja ditarik');
    }) 

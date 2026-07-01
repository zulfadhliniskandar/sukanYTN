// A simple Service Worker to satisfy PWA install requirements
self.addEventListener('install', (event) => {
    console.log('Service worker installed');
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    console.log('Service worker activated');
});

// This fetch event is required for the PWA prompt to appear
self.addEventListener('fetch', (event) => {
    // For now, just let the browser handle all network requests normally
    event.respondWith(fetch(event.request));
});
importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-app-compat.js')
importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-messaging-compat.js')

firebase.initializeApp({
    apiKey: "AIzaSyBxy48WO_nASE2uVeopqElydRDzQJS58FI",
    authDomain: "guia-d25c6.firebaseapp.com",
    projectId: "guia-d25c6",
    storageBucket: "guia-d25c6.appspot.com",
    messagingSenderId: "20366400082",
    appId: "1:20366400082:web:32486f15acd26c2c711d8b",
    measurementId: "G-DZ671TQVVZ"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    const notificationTitle = payload.body.title
    const notificationOptions = {
        body: payload.data.body,
        icon: payload.data.image,
        data: { url: payload.data.clickUrl }
    };
  
    self.registration.showNotification(notificationTitle, notificationOptions);
});

self.addEventListener('notificationclick', function(event) {
    const url = event.notification.data.url;

    event.notification.close();
    event.waitUntil(
        clients.matchAll({type: 'window'}).then(windowClients => {
            // Check if there is already a window/tab open with the target URL
            for (var i = 0; i < windowClients.length; i++) {
                var client = windowClients[i];
                // If so, just focus it.
                if (client.url === url && 'focus' in client) {
                    return client.focus();
                }
            }

            // If not, then open the target URL in a new window/tab.
            if (clients.openWindow) {
                return clients.openWindow(url);
            }
        })
    );
});
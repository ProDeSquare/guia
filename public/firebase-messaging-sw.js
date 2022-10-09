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
        clickUrl: payload.data.clickUrl,
    };
  
    self.registration.showNotification(notificationTitle, notificationOptions);
});
/*
 * ==========================================================================
 * Firebase Cloud Messaging service worker (shows notifications when the
 * signin page / site is in the background)
 *
 * IMPORTANT: keep firebaseConfig identical to the one in /signin.php
 * ==========================================================================
 */
importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging-compat.js');

// TODO: fill apiKey / authDomain / projectId / appId from the Firebase console
// (Project settings -> Your apps -> Web app). Must match /signin.php
var firebaseConfig = {
  apiKey: 'TODO',
  authDomain: 'TODO.firebaseapp.com',
  projectId: 'TODO',
  appId: 'TODO',
  messagingSenderId: '205202417147'
};

try {
  firebase.initializeApp(firebaseConfig);

  var messaging = firebase.messaging();

  messaging.onBackgroundMessage(function (payload) {
    var notification = (payload && payload.notification) || {};
    var data = (payload && payload.data) || {};
    var title = notification.title || data.title || 'MaRRS';

    self.registration.showNotification(title, {
      body: notification.body || data.body || '',
      icon: 'https://marrs.in/newassets/MaRRS.png',
      badge: 'https://marrs.in/newassets/MaRRS.png',
      data: data
    });
  });
} catch (e) {
  console.error('FCM service worker init failed:', e);
}

// Open the site (or the link given in the payload) when a notification is clicked
self.addEventListener('notificationclick', function (event) {
  event.notification.close();
  var data = event.notification.data || {};
  var url = data.click_action || 'https://marrs.in/';
  event.waitUntil(
    clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function (windowClients) {
      for (var i = 0; i < windowClients.length; i++) {
        if (windowClients[i].url === url && 'focus' in windowClients[i]) {
          return windowClients[i].focus();
        }
      }
      return clients.openWindow(url);
    })
  );
});


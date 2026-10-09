/*
 * ==========================================================================
 * Firebase Cloud Messaging service worker (shows notifications when the
 * signin page / site is in the background)
 *
 * Firebase settings are loaded from the credentials-table endpoint.
 * ==========================================================================
 */
try {
  importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js');
  importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging-compat.js');
  importScripts('firebase-config.php');
} catch (e) {
  console.error('[MaRRS notifications] Could not load Firebase SDK/config in service worker:', e);
  throw e;
}

var firebaseConfig = self.MARRS_FIREBASE_CONFIG && self.MARRS_FIREBASE_CONFIG.firebase;

try {
  if (!firebaseConfig || !firebaseConfig.apiKey || !firebaseConfig.authDomain
      || !firebaseConfig.projectId || !firebaseConfig.appId
      || !firebaseConfig.messagingSenderId) {
    throw new Error('Firebase web app settings are missing from the active credentials table row.');
  }

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
  console.error('[MaRRS notifications] Service worker initialization failed:', e);
}

// Open the site (or the link given in the payload) when a notification is clicked
self.addEventListener('notificationclick', function (event) {
  event.notification.close();
  var data = event.notification.data || {};
  var url = data.click_action || self.location.origin + '/';
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

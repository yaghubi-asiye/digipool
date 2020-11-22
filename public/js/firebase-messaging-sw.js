importScripts('https://www.gstatic.com/firebasejs/7.6.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.6.1/firebase-messaging.js');

const firebaseConfig = {
    apiKey: "AIzaSyA77czJJKV_6uOk290NoxZnmgVnPzjqUNU",
    authDomain: "digipool-294ad.firebaseapp.com",
    databaseURL: "https://digipool-294ad.firebaseio.com",
    projectId: "digipool-294ad",
    storageBucket: "digipool-294ad.appspot.com",
    messagingSenderId: "1066512247445",
    appId: "1:1066512247445:web:628d40850b0630d5f8c99c",
    measurementId: "G-CFF82NWRZR"
};
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
  /*const title = payload.data.title;
  const link  = "http://127.0.0.1:8000";
  const options = {
      body: payload.data.message,
      icon: payload.data.icon,
      click_action: payload.data.click_action,

  };
  return self.registration.showNotification(title,options);*/
  //alert(payload.data.id_teacher);
});


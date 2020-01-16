<h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>

<button onclick="googleSignIn()">Google sign in</button>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.6.2/firebase-app.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/7.6.2/firebase-auth.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.6.2/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyAP2yeWQD6mhh7MIllfAwcuyAl-MbDsyME",
    authDomain: "sellit-ce36e.firebaseapp.com",
    databaseURL: "https://sellit-ce36e.firebaseio.com",
    projectId: "sellit-ce36e",
    storageBucket: "sellit-ce36e.appspot.com",
    messagingSenderId: "375131444314",
    appId: "1:375131444314:web:9c6d8b75e28d8041d2b463",
    measurementId: "G-1MY5BRWWHN"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>

<script>
    googleSignIn=()=>{
    base_provider = new firebase.auth.GoogleAuthProvider();
    firebase.auth().signInWithPopup(base_provider).then(function(result){
        connsole.log(result)
        console.log("Success.. Goolge Account linked")
    }).catch(function(err){
        console.log(err)
        console.log("Failed to do")
    })
    }

</script>
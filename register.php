<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="f497391a621174e8c6387b7f7f3ddda0e4f8c311" content="f497391a621174e8c6387b7f7f3ddda0e4f8c311" />
  <title>Register - AdWatch</title>
  <link rel="stylesheet" href="css/style.css"> 
  <link rel="shortcut icon" href="logo/logo1.png" type="image/x-icon"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="..." crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- navbar for mobile and larger screens -->
<div id="Navv"></div> 

<!-- app content/body -->
<div id="app-content"></div> 

<!-- app footer -->
<div id="app-footer"></div>
    
<script>

function navbar() {
    const navbarElement = document.querySelector("#Navv");
    return navbarElement.innerHTML = `
          <nav class="main-nav">
            <a href="index.php" class="nav-logo">
              <div class="navbar-logo">
                <img src="logo/logo1.png" alt="Logo">
              </div>  
            </a>
            <div class="nav-menu" id="nav-menu">
                <a href="dashboard/info.php" class="nav-button">Get Info</a>
            </div>
            <div class="nav-toggle" id="nav-toggle" onclick="toggleMenu()">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </div>
          </nav>
    `;
}
navbar();

function toggleMenu() {
  const menu = document.getElementById('nav-menu');
  const toggle = document.getElementById('nav-toggle');
  menu.classList.toggle('active');
  toggle.classList.toggle('active');
} 


function signupPage() {
  const appContent = document.getElementById('app-content');

  const signupHTML = `
      <section class="signup-section">
        <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-toggle">
            <button id="signupBtn">Sign Up</button>
            <button id="loginBtn" class="active">Login</button>
            </div>

            <!-- Signup Form -->
            <form id="signupForm" class="auth-form">
            <h2>Create Account</h2>
            <div class="input-group">
                <input type="text" name="name" required>
                <label>Full Name</label>
            </div>
            <div class="input-group">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="input-group">
                <input type="password" name="Cpassword" required>
                <label>Confirm Password</label>
            </div>
            
            <div class="input-group">
                <input type="text" name="coupon" required>
                <label>Coupon code</label>
            </div>

            <input type="hidden" name="ref_id" value="<?php echo $_GET['ref'] ?? 0; ?>">
            <button type="submit" class="auth-btn">Sign Up</button>
            </form>

            <!-- Login Form -->
            <form id="loginForm" class="auth-form active">
            <h2>Welcome Back</h2>
            <div class="input-group">
                <input type="email" name="loginEmail" required>
                <label>Email</label>
            </div>
            <div class="input-group">
                <input type="password" name="loginPassword" required>
                <label>Password</label>
            </div>

            <p class="forgot-password">
              <a href="#" id="forgotLink">Forgot Password?</a>
            </p>

            <button type="submit" class="auth-btn">Login</button>
            </form>

            <!-- Forgot Password Form -->
            <form id="forgotForm" class="auth-form">
              <h2>Reset Password</h2>
              <p>Enter the email linked to your account</p>
              <div class="input-group">
                <input type="email" name="forgotEmail" required>
                <label>Email</label>
              </div>
              <button type="submit" class="auth-btn">Send Reset Link</button>
            </form>

        </div>
        </div>
    </section>
`;

if (appContent) {
  appContent.innerHTML = signupHTML;
}

const signupBtn = document.getElementById("signupBtn");
const loginBtn = document.getElementById("loginBtn");
const signupForm = document.getElementById("signupForm");
const loginForm = document.getElementById("loginForm");
const forgotForm = document.getElementById("forgotForm");
const forgotLink = document.getElementById("forgotLink");
const backToLogin = document.getElementById("backToLogin");

function showForm(formToShow) {
    [signupForm, loginForm, forgotForm].forEach(f => {
        if (f === formToShow) f.classList.add("active");
        else f.classList.remove("active");
    });
}


signupBtn.addEventListener("click", () => {
    signupBtn.classList.add("active");
    loginBtn.classList.remove("active");
    showForm(signupForm);
});

loginBtn.addEventListener("click", () => {
    signupBtn.classList.remove("active");
    loginBtn.classList.add("active");
    showForm(loginForm);
});


forgotLink.addEventListener("click", (e) => {
    e.preventDefault();
    signupBtn.classList.remove("active");
    loginBtn.classList.remove("active");
    showForm(forgotForm);
});


document.addEventListener("DOMContentLoaded", () => {
  const backToLogin = document.getElementById("backToLogin");
  if (backToLogin) {
      backToLogin.addEventListener("click", (e) => {
          e.preventDefault();
          loginBtn.classList.add("active");
          showForm(loginForm);
      });
  }
});


function showCustomMessage(text, isError = false) {
  let messageBox = document.getElementById('customMessageBox');
  if (!messageBox) {
      messageBox = document.createElement('div');
      messageBox.id = 'customMessageBox';
      document.body.appendChild(messageBox);
  }

  messageBox.textContent = text;
  messageBox.style.cssText = `
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: ${isError ? '#dc3545' : '#28a745'};
      color: white;
      padding: 15px 25px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      opacity: 0;
      transition: opacity 0.5s, transform 0.5s;
      transform: translateY(20px);
      z-index: 1000;
      font-size: 16px;
      font-weight: 500;
  `;

  setTimeout(() => {
      messageBox.style.opacity = '1';
      messageBox.style.transform = 'translateY(0)';
  }, 50);

  setTimeout(() => {
      messageBox.style.opacity = '0';
      messageBox.style.transform = 'translateY(20px)';
      setTimeout(() => {
          messageBox.remove();
      }, 500);
  }, 3000);
}

function getIndexedDBFingerprint() {
    return new Promise(resolve => {
        const request = indexedDB.open("DeviceFingerprintDB", 1);

        request.onupgradeneeded = function(event) {
            const db = event.target.result;
            db.createObjectStore("fingerprintStore");
        };

        request.onsuccess = function(event) {
            const db = event.target.result;
            const transaction = db.transaction(["fingerprintStore"], "readwrite");
            const store = transaction.objectStore("fingerprintStore");

            const getRequest = store.get("fingerprint");

            getRequest.onsuccess = function() {
                if (getRequest.result) {
                    resolve(getRequest.result);
                } else {
                    const newID = crypto.randomUUID();
                    store.put(newID, "fingerprint");
                    resolve(newID);
                }
            };
        };
    });
}


function generateDeviceFingerprint() {
    let localID = localStorage.getItem("device_id");
    if (!localID) {
        localID = crypto.randomUUID();
        localStorage.setItem("device_id", localID);
    }

    const data = [
        navigator.userAgent,
        navigator.platform,
        screen.width,
        screen.height,
        screen.colorDepth,
        new Date().getTimezoneOffset(),
        navigator.language
    ];

    try {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
        if (ctx) {
            data.push(ctx.getParameter(ctx.VERSION) + ctx.getParameter(ctx.VENDOR));
        }
    } catch(e) {}

    try {
        const AudioContext = window.AudioContext || window.webkitAudioContext;
        const audioCtx = new AudioContext();
        const oscillator = audioCtx.createOscillator();
        const analyser = audioCtx.createAnalyser();
        oscillator.connect(analyser);
        analyser.connect(audioCtx.destination);
        data.push(analyser.frequencyBinCount);
    } catch(e) {}

    const rawString = localID + '|' + data.join('|');
    return crypto.subtle.digest("SHA-256", new TextEncoder().encode(rawString))
        .then(hashBuffer => {
            const hashArray = Array.from(new Uint8Array(hashBuffer));
            return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
        });
}


async function generateSuperFingerprint() {
    const f1 = await generateDeviceFingerprint();
    const f2 = await getIndexedDBFingerprint();
    const combined = f1 + "|" + f2;

    const hashBuffer = await crypto.subtle.digest("SHA-256", new TextEncoder().encode(combined));
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
}


$(document).ready(function () {
    $("#signupForm").on("submit", function (e) {
        e.preventDefault();

        const name = $("input[name='name']").val();
        const email = $("input[name='email']").val();
        const password = $("input[name='password']").val();
        const Cpassword = $("input[name='Cpassword']").val();
        const coupon = $("input[name='coupon']").val();
        const ref_id = $("input[name='ref_id']").val();

        generateSuperFingerprint().then(fingerprint => {

            $.ajax({
                url: "ajax/register.php",
                method: "POST",
                data: { name, email, password, Cpassword, coupon, ref_id, fingerprint },
                success: function(response) {
                    console.log("SERVER RESPONSE:", response);

                    if (response.includes("Exists")) {
                      showCustomMessage("Email already exists", true);
                    }
                    else if (response.includes("empty")) {
                      showCustomMessage("All fields are required", true);
                    }
                    else if (response.includes("wait")) {
                      showCustomMessage("This account already exists!", true);
                    }
                    else if(response.includes("Match")) {
                      showCustomMessage("Passwords Do Not Match!", true);
                    } 
                    else if(response.includes("device")) {
                      showCustomMessage("Device linked to another account!", true);
                    } 
                    else if(response.includes("non-existent_coupon")) {
                      showCustomMessage("Please enter a valid coupon code!", true);
                    } 
                    else if(response.includes("invalid_coupon")) {
                      showCustomMessage("This coupon has already been used!", true);
                    } 
                    else if (response.includes("Successful")) {
                      showCustomMessage("Account created successfully", false);
                      $("#signupForm")[0].reset();

                      setTimeout(function() {
                        window.location.href = "dashboard/dashboard.php";
                      }, 3000);
                    } 
                    else {
                      showCustomMessage("Error creating an account", true);
                    }
                },
                error: function () {
                  showCustomMessage("Something went wrong. Try again.", true);
                }
            });

        });
    });
});


// login query
$(document).ready(function () {
  $("#loginForm").on("submit", function (e) {
      e.preventDefault();

      const loginEmail = $("input[name='loginEmail']").val();
      const loginPassword = $("input[name='loginPassword']").val();

      $.ajax({
          url: "ajax/login.php",
          method: "POST",
          data: { loginEmail, loginPassword },
          success: function (response) {

              if (response.includes("Email")) {
                  showCustomMessage("Invalid email address", true);
              } 
              else if (response.includes("Incorrect")) {
                  showCustomMessage("Invalid user password", true);
              } 
              else if (response.includes("Successful")) {
                  showCustomMessage("You'd be redirected in a moment..", false);
                  $("#loginForm")[0].reset();

                  setTimeout(function() {
                      window.location.href = "dashboard/dashboard.php";
                  }, 3000);
              } 
              else {
                  showCustomMessage("Please ensure stable connection", true);
              }
          },
          error: function () {
              showCustomMessage("Something went wrong. Try again.", true);
          }
      });
  });
});


// forgot password query
$(document).ready(function () {
  $("#forgotForm").on("submit", function (e) {
      e.preventDefault();

      const forgotEmail = $("input[name='forgotEmail']").val();

      $.ajax({
          url: "ajax/forgot-password.php",
          method: "POST",
          data: { forgotEmail },
          success: function (response) {

              if (response.includes("wrong")) {
                showCustomMessage("This email is not linked to any account", true);
              } 
              else if (response.includes("not")) {
                showCustomMessage("Failed to send reset email, please try again.", true);
              } 
              else if (response.includes("success")) {
                showCustomMessage("We have sent instructions to this email on how to reset your password", false);
                $("#forgotForm")[0].reset();
              } 
              else {
                  showCustomMessage("Please ensure stable connection", true);
              }
          },
          error: function () {
              showCustomMessage("Something went wrong. Try again.", true);
          }
      });
  });
});

};
signupPage();



function appFooter() {
    const appFooter = document.querySelector("#app-footer"); 
    if (!appFooter) return;

    appFooter.innerHTML = `
        <footer id="footer" class="footer">
          <div class="footer-container">
          <div class="footer-logo">
            <img src="logo/logo1.png" alt="Logo">
            <p class="tagline">Watch smarter. Earn with Clickora.</p>
          </div>

          <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="index.php#about">About</a></li>
              <li><a href="index.php#features-section">Features</a></li>
              <li><a href="index.php#contact">Contact</a></li>
            </ul>
          </div>

          <div class="footer-contact">
            <h4>Contact</h4>
            <p>Email: support@getclickora.xyz</p>
            <p>Phone: +234 464 8333</p>
            <p>Address: 42 Williams Jumbo, Port Harcourt Rivers State</p>
          </div>

          <div class="footer-social">
            <h4>Follow Us</h4>
            <div class="social-icons">
              <a href="https://www.facebook.com/share/1EbPxo6tgU/?mibextid=wwXIfr"><i class="fab fa-facebook-f"></i></a>
              <a href="https://www.tiktok.com/@clickora_ads?_r=1&_t=ZS-923wkOMARs1"><i class="fab fa-tiktok"></i></a>
              <a href="https://t.me/clickora_ads"><i class="fab fa-telegram-plane"></i></a>
              <a href="https://www.instagram.com/clickora_ads?igsh=Y3ljdmh5MHpkazdx&utm_source=qr"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>

        <div class="footer-bottom">
          <p>&copy; 2025 Clickora. All rights reserved.</p>
        </div>
        </footer>
    `;

}
appFooter();


 
</script>




</body>
</html>
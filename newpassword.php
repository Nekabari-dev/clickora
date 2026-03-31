<?php 
  if(!isset($_GET['email'])){
    header("location: register.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="monetag" content="6430780d5dbc9f263e961134f437e914">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="f497391a621174e8c6387b7f7f3ddda0e4f8c311" content="f497391a621174e8c6387b7f7f3ddda0e4f8c311" />
  <title>Set password - AdWatch</title>
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


function newPassword() {
  const appContent = document.getElementById('app-content');

  const signupHTML = `
      <section class="signup-section">
        <div class="auth-wrapper">
        <div class="auth-card">

            <form id="resetForm" class="auth-form active">
            <h2>Enter your new password</h2>
            <div class="input-group">
                <input type="password" name="newPassword" required>
                <label>New Password</label>
            </div>
            <div class="input-group">
                <input type="password" name="confPassword" required>
                <label>Confirm Password</label>
            </div>

            <p class="forgot-password">
              <a href="register">Back to login?</a>
            </p>
            <input type="hidden" name="userEmail" value="<?php echo $_GET['email'] ?>">
            <button type="submit" class="auth-btn">continue</button>
            </form>

        </div>
        </div>
    </section>
`;

if (appContent) {
  appContent.innerHTML = signupHTML;
}


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


// reset password query
$(document).ready(function () {
  $("#resetForm").on("submit", function (e) {
      e.preventDefault();

      const newPassword = $("input[name='newPassword']").val();
      const confPassword = $("input[name='confPassword']").val();
      const userEmail = $("input[name='userEmail']").val();

      $.ajax({
          url: "ajax/new-password.php",
          method: "POST",
          data: { newPassword, confPassword, userEmail },
          success: function (response) {

              if (response.includes("empty")) {
                showCustomMessage("All fields are required", true);
              } 
              else if (response.includes("unmatched")) {
                showCustomMessage("Passwords must be the same", true);
              } 
              else if (response.includes("mail")) {
                showCustomMessage("Problem sending mail.", true);
              } 
              else if (response.includes("success")) {
                showCustomMessage("your password has been reset", false);
                $("#resetForm")[0].reset();

                setTimeout(function() {
                    window.location.href = "register.php";
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


};
newPassword();



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
              <a><i class="fab fa-facebook-f"></i></a>
              <a><i class="fab fa-twitter"></i></a>
              <a><i class="fab fa-linkedin-in"></i></a>
              <a><i class="fab fa-instagram"></i></a>
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="monetag" content="6430780d5dbc9f263e961134f437e914">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <meta name="f497391a621174e8c6387b7f7f3ddda0e4f8c311" content="f497391a621174e8c6387b7f7f3ddda0e4f8c311" />
  
  <title>AdWatch - Earn Points</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="logo/logo1.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="..." crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '09d2c5e33ce768951204f22f039efa16d3bac8fa';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>


<body>


<!-- for mobile and larger dev -->
<div id="Navv"></div>

<!-- app content -->
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
              <a href="#features-section" class="nav-link">Features</a>
              <a href="#how-to-earn" class="nav-link">Steps</a>
              <a href="#about" class="nav-link">About Us</a>
              <a href="#contact" class="nav-link">Contact</a>
              <a href="register.php" class="nav-button" >SignUp Here</a>
          </div>

          <div class="nav-toggle" id="nav-toggle" onclick="toggleMenu()">
              <span class="bar"></span>
              <span class="bar"></span>
              <span class="bar"></span>
          </div>
      </nav>
  `;
}
navbar();


function heroSection() {
  const appContent = document.querySelector("#app-content"); 

  const heroHTML = `
      <section class="hero">
          <div class="hero-overlay">
              <div class="hero-content">
                  <h1 class="hero-title">
                      Watch engaging ads, earn money instantly.
                  </h1>
                  <p class="hero-subtitle">
                      Join Clickora today and start turning your everyday ad views into effortless earnings online.
                  </p>
                  <a href="register.php" class="hero-cta-button">
                      Get Started Today
                  </a>
              </div>
          </div>
      </section>
  `;

  if (appContent) {
    appContent.innerHTML += heroHTML;
  }

}



function featuresSection() {
  const appContent = document.querySelector("#app-content"); 

  const featuresHTML = `
      <section class="features-section" id="features-section">
          <div class="container">
              <h2 class="features-heading">Why Choose Clickora?</h2>
              <p class="features-subheading">
                  Clickora turns your everyday ad views into instant rewards, making earning effortless anywhere.
              </p>

              <div class="features-grid">
                  
                  <div class="feature-card">
                      <i class="feature-icon fas fa-chart-line"></i>
                      <h3 class="card-title">Data-Driven Strategy</h3>
                      <p class="card-description">
                          Clickora uses a data-driven strategy to deliver smarter, personalized ads that boost engagement, maximize rewards, and enhance advertiser performance.
                      </p>
                  </div>

                  <div class="feature-card">
                      <i class="feature-icon fas fa-bullhorn"></i>
                      <h3 class="card-title">Multi-Channel Execution</h3>
                      <p class="card-description">
                          Boost your earnings effortlessly with multi-channel execution, letting users watch ads across platforms and get rewarded instantly.
                      </p>
                  </div>

                  <div class="feature-card">
                      <i class="feature-icon fas fa-desktop"></i>
                      <h3 class="card-title">Transparent Reporting</h3>
                      <p class="card-description">
                          Build trust with transparent reporting, giving users clear, accurate insights into ad performance and their earned rewards.
                      </p>
                  </div>

                  <div class="feature-card">
                      <i class="feature-icon fas fa-user-tie"></i>
                      <h3 class="card-title">Dedicated Experts</h3>
                      <p class="card-description">
                          Rely on our dedicated experts to guide you, ensuring maximum earnings and seamless ad experiences.
                      </p>
                  </div>
                  
              </div>
          </div>
      </section>
  `;

  if (appContent) {
      appContent.innerHTML += featuresHTML;
  }
}



function renderEarnFlowSection() {
    const appContent = document.querySelector("#app-content"); 
    if (!appContent) return;
    
    return appContent.innerHTML += `
        <section id="how-to-earn" class="earning-path-section">
            <div class="earn-container max-w-7xl mx-auto text-center">
                <h2 class="path-title">Your Simple Path to Earnings🚀</h2>
                <p class="path-subtitle">Follow these quick steps and start getting rewarded instantly.</p>

                <div class="steps-grid">

                    <div class="step-card step-1" data-step="1">
                        <div class="card-circle">1</div>
                        <div class="card-icon-box">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h3 class="card-title">Sign Up</h3>
                        <p class="card-description">Create your free and secure account. Quick setup, no commitment required.</p>
                        <div class="step-connector"></div>
                    </div>

                    <div class="step-card step-2" data-step="2">
                        <div class="card-circle">2</div>
                        <div class="card-icon-box">
                            <i class="fas fa-video"></i>
                        </div>
                        <h3 class="card-title">Watch Ads</h3>
                        <p class="card-description">View short, relevant video or banner ads. Flexible viewing on your schedule.</p>
                        <div class="step-connector"></div>
                    </div>

                    <div class="step-card step-3" data-step="3">
                        <div class="card-circle">3</div>
                        <div class="card-icon-box">
                            <i class="fas fa-coins"></i>
                        </div>
                        <h3 class="card-title">Earn Points</h3>
                        <p class="card-description">Get instant credit. Points are added to your balance right after every view.</p>
                        <div class="step-connector"></div>
                    </div>

                    <div class="step-card step-4" data-step="4">
                        <div class="card-circle">4</div>
                        <div class="card-icon-box">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h3 class="card-title">Withdraw</h3>
                        <p class="card-description">Convert your earned Points into real cash, mobile airtime, or vouchers.</p>
                    </div>

                </div>
                
                <div class="flex justify-center">
                    <a href="register.php" class="cta-button" >Start Earning Now <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
            </div>
        </section>
    `;
}

function aboutUsSection() {
    const appContent = document.querySelector("#app-content"); 
    const sectionHTML = `
        <section id="about" class="about-section">
            <div class="about-container">
              <div class="about-image">
                <img src="img/about-img.png" alt="About Us">
              </div>
              <div class="about-content">
                <h2>About Us</h2>
                <p>
                  We are committed to empowering users to earn effortlessly by watching ads, 
                  providing transparent reporting, dedicated support, and a seamless, 
                  rewarding experience across multiple platforms.
                </p>
                <a href="register.php" class="btn">Learn More</a>
              </div>
            </div>
        </section>
    `;
    if (appContent) { appContent.innerHTML += sectionHTML; }
}


function contactUsSection() {
    const appContent = document.querySelector("#app-content"); 
    if (!appContent) return;

    return appContent.innerHTML += `
        <section id="contact" class="contact-section">
            <div class="contact-wrapper">
            <div class="contact-info">
              <h2>Let’s Talk</h2>
              <p>We’re always ready to collaborate, answer questions, or just say hello.</p>
              <ul>
                <li><i class="fas fa-envelope"></i> support@getclickora.xyz</li>
                <li><i class="fas fa-phone-alt"></i> +234 446 473 334</li>
                <li><i class="fas fa-map-marker-alt"></i> 42 Williams Jumbo, Port Harcourt Rivers State</li>
              </ul>
            </div>

            <div class="contact-form">
              <form id="contact-us">
                <div class="form-group">
                  <input type="text" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                  <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                  <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                </div>
                <button type="submit" class="contact-btn">Send Message</button>
              </form>
            </div>
          </div>
        </section>
    `;
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


$(document).ready(function () {
  $("#contact-us").on("submit", function (e) {
    e.preventDefault();

    const name = $("input[name='name']").val();
    const email = $("input[name='email']").val();
    const message = $("textarea[name='message']").val();

    $.ajax({
        url: "ajax/contact.php",
        method: "POST",
        data: { name, email, message },
        success: function (response) {

            if (response.includes("error")) {
              showCustomMessage("Your message could not be delivered, please try again!", true);
            } 
            else if (response.includes("empty")) {
              showCustomMessage("All fields are required!", true);
            } 
            else if (response.includes("sent")) {
              showCustomMessage("Your message has been sent to our team, you'd be contacted shortly", false);
              $("#contact-us")[0].reset();
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
              <li><a href="/index.php" >Home</a></li>
              <li><a href="/index.php#about" >About</a></li>
              <li><a href="/index.php#features-section" >Features</a></li>
              <li><a href="/index.php#contact" >Contact</a></li>
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
              <a href="https://t.me/getclickora"><i class="fab fa-telegram-plane"></i></a>
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

function initializeAboutReveal() {

  const revealElements = document.querySelectorAll('.about-section .animate-reveal, .contact-section .animate-reveal');

  if (revealElements.length === 0) return;

  const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
          if (entry.isIntersecting) {
              const element = entry.target;
              const delay = parseInt(element.getAttribute('data-reveal-delay')) || 0;
              
              setTimeout(() => {
                  element.classList.add('is-revealed');
              }, delay);

              observer.unobserve(element); 
          }
      });
  }, {
      rootMargin: '0px',
      threshold: 0.1 
  });

  revealElements.forEach(element => observer.observe(element));
}


function initializeSleekScrollReveal() {

  const stepCards = document.querySelectorAll('.step-card');
  if (stepCards.length === 0) return;

  const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
          if (entry.isIntersecting) {
              const card = entry.target;
              const stepNumber = parseInt(card.getAttribute('data-step'));
              card.style.transitionDelay = `${(stepNumber - 1) * 0.15}s`;
              card.classList.add('is-revealed');
              observer.unobserve(card);
          }
      });
  }, {
      rootMargin: '0px',
      threshold: 0.2
  });

  stepCards.forEach(card => observer.observe(card));
}



const routes = {
  "#": () => {
    navbar();
    heroSection();
    featuresSection(); 
    renderEarnFlowSection(); 
    aboutUsSection(); 
    contactUsSection(); 
      
    setTimeout(() => {
      initializeSleekScrollReveal();
      initializeAboutReveal();
    }, 100);
  },
};


const handleLocation = async () => {
  const hash = window.location.hash;

  const path = window.location.pathname; 
  const routeFunction = routes[path] || routes["#"]; 
  const appContent = document.getElementById('app-content');
  
  if (appContent) {
    appContent.innerHTML = ''; 
  }
  routeFunction(); 

  if (hash) {
    setTimeout(() => {
        const element = document.querySelector(hash);
        if (element) {
          element.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }, 10); 
  }
};

window.onpopstate = handleLocation;

function toggleMenu() {
  const menu = document.getElementById('nav-menu');
  const toggle = document.getElementById('nav-toggle');
  menu.classList.toggle('active');
  toggle.classList.toggle('active');
} 

handleLocation();





</script>



</body>
</html>
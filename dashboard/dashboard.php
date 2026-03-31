<?php 
  include "../config.php";
  if(!isset($_SESSION['user_id']) || !isset($_SESSION['is_logged_in'])) {
    header("Location: ../register.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="monetag" content="6430780d5dbc9f263e961134f437e914">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="f497391a621174e8c6387b7f7f3ddda0e4f8c311" content="f497391a621174e8c6387b7f7f3ddda0e4f8c311" />
    <title>User Dashboard - AdWatch</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="shortcut icon" href="../logo/logo1.png" type="image/x-icon">
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
    
    /* Overlay background */
.withdraw-popup-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  visibility: hidden;
  opacity: 0;
  transition: all 0.3s ease-in-out;
  text-align: center;
}

/* Show overlay */
.withdraw-popup-overlay.withdraw-active {
  visibility: visible;
  opacity: 1;
}

/* Popup box */
.withdraw-popup-box {
  background: #111196;
  color: #fff;
  border-radius: 20px;
  padding: 35px 30px;
  width: 90%;
  text-align: center;
  max-width: 650px;      /* ← INCREASED WIDTH */
  text-align: left;      /* Better for long text */
  line-height: 1.6;      /* More readable */
  box-shadow: 0px 10px 25px rgba(0,0,0,0.25);
  animation: withdraw-scaleIn 0.3s ease;
}

.withdraw-popup-box h2 {
  color: #fff !important;
  font-size: 1.2rem;
  margin-bottom: 25px;
}

.withdraw-popup-box a {
  color: #ffea00;
  text-decoration: underline;
  font-weight: bold;
}

.withdraw-popup-btn {
  background: white;
  color: black;
  border: none;
  padding: 12px 20px;
  border-radius: 12px;
  font-size: 1rem;
  cursor: pointer;
  margin-top: 20px;
  width: 100%;
  transition: background 0.3s ease;
}

.withdraw-popup-btn:hover {
  background: #f2f2f2;
}


@media (max-width: 300px) {
  .withdraw-popup-box {
    max-width: 95%;
    padding: 20px 15px;
  }
  .withdraw-popup-box h2 {
    font-size: 1rem;
  }
  .withdraw-popup-btn {
    font-size: 0.9rem;
    padding: 10px;
  }
}
    
</style>

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
    
    
<?php 

  $status_id=$_SESSION['user_id'];
  $select_status = mysqli_query($conn, "SELECT * FROM users WHERE id = '$status_id' ");
  $fetch_status = mysqli_fetch_assoc($select_status);
  if($fetch_status['message_status'] == "false") {
      // return statement
  }else if($fetch_status['message_status'] == "true") {

    ?>

      <div class="withdraw-popup-overlay" id="withdrawPopup">
          <div class="withdraw-popup-box">

            <center>
                
              <h2>
                <h4><b><span class="message-box-username"></b></span></h4><br>
                ANNOUNCEMENT! <br><br>
    
                Join our telegram community for <br>
                Updates and Information. <br>
    
                <center><a href="https://t.me/getclickora">https://t.me/getclickora</a></cemter>
              </h2>
              
            </center>
        
          <button class="withdraw-popup-btn" onclick="closeWithdrawPopup()">Close</button>
          </div>
      </div>

    <?php

  }

?>
    

<!-- Navbar Placeholder -->
<div id="Navv"></div> 

<!-- App Content/Body -->
<div id="app-content" class="flex-grow"></div>
<script>

function userDashboard() {

  const appContent = document.querySelector("#app-content");

  appContent.innerHTML = `
    
    <div class="dashboard-ambient">
      <div class="blob b1"></div>
      <div class="blob b2"></div>
      <div class="blob b3"></div>
    </div>

    <section class="dashboard-shell">
      <div class="dashboard-header">
        <div class="brand-title">
          <span class="brand-dot"></span>
          <div>
            <div class="dashboard-title user_name">Clickora Dashboard</div>
            <div class="mini" style="color: var(--muted)">Earn by watching ads. Track your progress.</div>
          </div>
        </div>
        <div class="header-actions">
          <button class="pill" onclick="window.location.replace('ads');">Go To Ads</button>
          <button class="pill" onclick="window.location.replace('withdrawal');">Withdraw</button>
          <button class="pill" onclick="window.location.replace('info');" style="position:relative;">
            Info
            <span class="notify-badge" id="notify-badge"></span>
          </button>
        </div>
      </div>

      <div class="dashboard-grid">
        <article class="card balance-card">
          <header>
            <h3>Balance</h3>
            <span class="hint">Updated just now</span>
          </header>
          <div class="kpi">
            <div class="icon"><span class="dot"></span></div>
            <div class="content">
              <span class="label">Current earnings</span>
              <span class="value user-balance"></span>
              <span class="trend profit-today">₳ᗪ₵ 0</span>
            </div>
          </div>
          <div class="progress"><div class="bar"></div></div>
        </article>

        <article class="card checkin-card">

          <header>
            <h3>Watch progress</h3>
            <span class="hint">Ads today</span>
          </header>
          <div class="kpi">
            <div class="icon"><span class="dot"></span></div>
            <div class="content">
              <span class="label">Total ads watched today</span>
              <span class="value total-ads-today"></span>
              <span class="trend" style="color: var(--success)">Keep going</span>
            </div>
          </div>
        </article>

        <div class="stats-row">
          
          <article class="card">
            <header>
              <h3>Daily check-in</h3>
              <span class="hint">Streak tracking</span>
            </header>

            <div class="kpi">
              <div class="icon"><span class="dot"></span></div>
              <div class="content">
                <span class="label">streak&#128293;</span>
                <span class="value days-streak"></span>
                <span class="trend" style="color: var(--warning)">Don’t miss today</span>
              </div>
            </div>


            <?php
              $user_id = $_SESSION['user_id'];
              $lastRes = mysqli_query($conn, "SELECT * FROM user_checkins WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
              $lastRow = mysqli_fetch_assoc($lastRes);

              $checkedDays = [];
              $streak = 0;

              if ($lastRow) {
                  $cycleRes = mysqli_query($conn, "SELECT day_number, streak_count, checkin_date FROM user_checkins WHERE user_id='$user_id' ORDER BY id DESC LIMIT 30");
                  $latestCycle = [];
                  while ($r = mysqli_fetch_assoc($cycleRes)) {
                    $latestCycle[$r['day_number']] = $r;
                  }
                  foreach ($latestCycle as $dn => $data) {
                    if ($dn >= 1 && $dn <= 30) {
                        $checkedDays[$dn] = true;
                    }
                  }
                  $streak = $lastRow['streak_count'];
              } else {
                $streak = 0;
              }

              echo '<div class="days-grid">';
              for ($i = 1; $i <= 30; $i++) {
                  $checkedClass = isset($checkedDays[$i]) ? ' checked' : '';
                  echo '<div class="day-box' . $checkedClass . '">' . $i . '</div>';
              }
              echo '</div>';

            ?>
              

            <div style="margin-top: 12px;">
              <button class="btn" id="checkinBtn">check-in</button>
            </div>
          </article>

        </div>

        <article class="card checkin-card">

           <header>
              <h3>Redeem Code</h3>
              <span class="hint">Don’t miss today!</span>
            </header>
            <div class="ref-row">
              <form id="redeemForm">
                <input class="ref-input" type="text" name="redeem" placeholder="Input code.." />
                <button class="btn" id="redeemBtn" style="margin-top:10px;">redeem now</button>
              </form>
            </div>
            <div class="mini" style="margin-top: 10px; color: var(--muted)">Stay active and redeem.</div>

        </article>


        
        <article class="card referral-card">

          <header>
            <h3>Referral link</h3>
            <span class="hint">Share to earn more</span>
          </header>
          <div class="ref-row">
            <input id="refLink" class="ref-input" type="text" value="https://getclickora.xyz/register.php?ref=<?php echo base64_encode($_SESSION['user_id']); ?>" readonly />
            <button class="btn" id="copyRef">Copy</button>
          </div>

          <header id="totalRef">
              <h3>Total referrals</h3>
              <span class="hint">All time</span>
            </header>
            <div class="kpi">
              <div class="icon"><span class="dot"></span></div>
              <div class="content">
                <span class="label">Referral Bonus</span>
                <span class="value ref-bonus"></span>
                <span class="trend ref-count"></span>
              </div>
            </div>

            <div class="mini" style="margin-top: 10px; color: var(--muted)">Referral bonuses could be withdrawn weekly</div>

            <a href="ref-withdrawal.php">
              <div class="ref-row">
                <button class="btn">Withdraw</button>
              </div>
            </a>

        </article>

      </div>
    </section>
  `;


  document.addEventListener("DOMContentLoaded", function() {
    var streakValueEl = document.querySelector(".value");
    if (streakValueEl) {
      streakValueEl.textContent = "<?php echo intval($streak); ?> days";
    }
  });

  const refInput = document.getElementById("refLink");
  const copyBtn = document.getElementById("copyRef");
  const checkinBtn = document.getElementById("checkinBtn");
  const claimBtn = document.getElementById("claimReward");

  copyBtn.addEventListener("click", () => {
    refInput.select();
    refInput.setSelectionRange(0, 99999);
    try {
      document.execCommand("copy");
    } catch (_) {}
    copyBtn.textContent = "Copied!";
    copyBtn.style.filter = "brightness(1.15)";
    setTimeout(() => {
      copyBtn.textContent = "Copy";
      copyBtn.style.filter = "none";
    }, 1500);
  });

}
userDashboard();

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("withdrawPopup").classList.add("withdraw-active");
})
  
function closeWithdrawPopup() {
  $.ajax({
    url: "../ajax/close.php",
    method: "POST",
    data: { action: "close_message" },
    success: function(response) {
        document.getElementById('withdrawPopup')
        .classList.remove('withdraw-active');
    },
    error: function(xhr, status, error) {
      console.error("AJAX error:", error);
    }
  });
}



function loadPage(url) {
  fetch(url)
    .then(res => res.text())
    .then(html => {
      document.getElementById("app-content").innerHTML = html;
      window.history.pushState({}, "", url);
    });
}


$(document).ready(function () {

    function updateRefCount() {
      $.ajax({
          url: "../ajax/dashboard.php",
          method: "GET",
          dataType: "json",
          success: function (response) {
          if (response.notification_count > 0) {
            $(".notify-badge")
              .text(response.notification_count)
              .show(); 
          }else {
            $(".notify-badge").hide();
          }

          $(".user_name").text(response.full_name);
          $(".message-box-username").text(response.full_name);
          $(".ref-bonus").text(response.withdrawalBonus);
          $(".ref-count").text(response.ref_number);
          $(".user-balance").text(response.balance);
          $(".total-ads-today").text(response.total_ads_today);
          $(".profit-today").text(response.profit_today);
          $(".bar").css("width", response.progress_percent + "%");
        }
      });
    }
    updateRefCount();
    setInterval(updateRefCount, 2000);
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


$(document).ready(function(){
    function fetchStreak() {
        $.ajax({
            url: "../ajax/checkin.php",  
            method: "GET",
            data: { action: "streak" },  
            dataType: "json",
            success: function (res) {
                if (res && typeof res.streak !== "undefined") {
                    $(".days-streak").text(res.streak + " days");
                    if (Array.isArray(res.checked_days)) {
                        $(".day-box").removeClass("checked");
                        res.checked_days.forEach(function(dn){
                            $(".day-box").eq(dn - 1).addClass("checked");
                        });
                    }
                }
            },
            error: function(xhr, status, error){
                console.error("AJAX Error (GET streak):", status, error);
                console.error("Response Text:", xhr.responseText);
                showCustomMessage("Error fetching streak state: " + error, true);
            }
        });
    }
    fetchStreak();

    $("#checkinBtn").on("click", function(){
        var btn = $(this);
        btn.prop("disabled", true);

        $.ajax({
            url: "../ajax/checkin.php",
            type: "POST",
            data: { action: "checkin" },
            dataType: "json",
            success: function(response){
                if(response.success){
                    $(".days-streak").text(response.streak + " days");
                    $(".day-box").eq(response.day_number - 1).addClass("checked");

                    if(response.reset){
                        $(".day-box").removeClass("checked");
                        $(".days-streak").text("0 days");
                    }

                    fetchStreak();
                } else {
                    showCustomMessage(response.message || "Unable to check in", true);
                }
                btn.prop("disabled", false); 
            },
            error: function(xhr, status, error){
                console.error("AJAX Error (POST checkin):", status, error);
                console.error("Response Text:", xhr.responseText);
                showCustomMessage("Error connecting to server: " + error, true);
                btn.prop("disabled", false);
            }
        });
    });
});



$(document).ready(function () {
  $("#redeemForm").on("submit", function (e) {
      e.preventDefault();

      const redeem = $("input[name='redeem']").val();

      $.ajax({
          url: "../ajax/redeem.php",
          method: "POST",
          data: { redeem },
          success: function (response) {

              if (response.includes("invalid")) {
                showCustomMessage("Invalid code..!", true);
              } 
              else if (response.includes("used")) {
                showCustomMessage("This code has been used", true);
              } 
              else if (response.includes("empty")) {
                showCustomMessage("Please input a code..", true);
              } 
              else if (response.includes("earned")) {
                showCustomMessage("You have earned 500 points", false);
                $("#redeemForm")[0].reset();
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


</script>



</body>
</html>
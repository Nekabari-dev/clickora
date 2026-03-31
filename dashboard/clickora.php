<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Deposit</title>
    <link rel="stylesheet" href="../css/bank.css">
    <link rel="shortcut icon" href="../logo/logo1.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<?php 
    if(!isset($_SESSION['admin_rightsss!'])) {
        echo '
            <div class="modal-overlay" id="popup-modal">
            <div class="modal-content">
                <h2 style="margin-bottom: 10px;">Input Pin</h2>
                <p style="color: var(--text-dim); margin-bottom: 25px; font-size: 0.9rem;">Please Input Authorized Pin.</p>
                <form id="access-form">
                    <input type="password" placeholder="Pin" id="pin" name="pin">
                    <button type="submit" class="btn-primary" style="width: 100%;">Proceed</button>
                </form>
            </div>
            </div>
        ';
    }
?>

<div id="App"></div>

<div class="modal-overlay" id="modal">
<div class="modal-content">
    <h2 style="margin-bottom: 10px;">Deposit</h2>
    <p style="color: var(--text-dim); margin-bottom: 25px; font-size: 0.9rem;">Add money to your wallet instantly.</p>
    <form id="payForm">
        <input type="text" placeholder="Full Name" id="name">
        <input type="email" placeholder="Email Address" id="email">
        <input type="number" placeholder="Phone Number" id="contact">
        <input type="number" placeholder="Amount (₦)" id="amount">
        <button type="submit" class="btn-primary" style="width: 100%;">Secure Deposit</button>
    </form>
    <p onclick="closeModal()" style="text-align: center; margin-top: 15px; cursor: pointer; color: var(--text-dim); font-size: 0.8rem;">Go Back</p>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
    
  document.addEventListener("DOMContentLoaded", function() {
        const popupModal = document.getElementById("popup-modal");
        if (popupModal) {
            popupModal.classList.add("active");
        }
  });
  
  window.openModal = () => document.getElementById('modal').style.display = 'flex';
  window.closeModal = () => document.getElementById('modal').style.display = 'none';

  function renderApp(balance, transactions) {
    const app = document.querySelector("#App");
    app.innerHTML = `
      <div class="app-container">
        <nav class="sidebar">
          <div class="logo">
            <img src="../logo/logo1.png" alt="Logo">    
          </div>
          <div style="font-size: 1.2rem;">🔔</div>
        </nav>

        <main class="main-content">
          <div class="balance-card">
            <div>
              <p class="balance-label">Wallet Balance</p>
              <h1 class="balance-value">₦ ${Number(balance).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</h1>
            </div>
            <button class="btn-primary" onclick="openModal()">+ Add Funds</button>
          </div>

          <div class="history-section">
            <h3 class="history-header">Recent Transactions</h3>
            
            <table class="desktop-table">
              <thead>
                <tr>
                  <th>Ref ID</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="transactionsTable"></tbody>
            </table>

            <div id="transactionsMobile" class="mobile-list"></div>

            <div id="paginationControls" style="display:flex; justify-content:center; margin-top:15px;">
                <button id="loadMoreBtn" onclick="renderNextTransactions()" 
                    style="padding:8px 16px; border:none; background:#007bff; color:white; border-radius:4px; cursor:pointer;">
                    Load More
                </button>
            </div>

          </div>
        </main>
      </div>
    `;
  }

    let allTransactions = [];
    let currentIndex = 0;
    const pageSize = 4;

    function renderNextTransactions() {
        const slice = allTransactions.slice(currentIndex, currentIndex + pageSize);

        const tableBody = document.getElementById("transactionsTable");
        const mobileList = document.getElementById("transactionsMobile");

        tableBody.innerHTML += slice.map(t => `
            <tr>
            <td>${t.id}</td>
            <td>${t.date}</td>
            <td>₦${t.amount}</td>
            <td><span class="status-pill ${t.statusClass}">${t.statusText}</span></td>
            </tr>
        `).join('');

        mobileList.innerHTML += slice.map(t => `
            <div class="trx-card">
            <div>
                <div style="font-weight: 600;">₦${t.amount}</div>
                <div style="font-size: 0.8rem; color: var(--text-dim);">${t.id} • ${t.date}</div>
            </div>
            <span class="status-pill ${t.statusClass}">${t.statusText}</span>
            </div>
        `).join('');

        currentIndex += pageSize;

        const loadMoreBtn = document.getElementById("loadMoreBtn"); 
        if (currentIndex >= allTransactions.length) { 
            loadMoreBtn.style.display = "none"; 
        } else { 
            loadMoreBtn.style.display = "block";
        }

    }

    function loadTransactions(initial = false) {
    Promise.all([
        fetch("get_transactions.php").then(res => res.json()),
        fetch("get_balance.php").then(res => res.json())
    ])
    .then(([txData, balanceData]) => {
        const newTransactions = txData.data.map(tx => ({
            id: "#FLW-" + tx.id,
            date: new Date(tx.created_at).toLocaleDateString(),
            amount: tx.amount,
            statusText: tx.status,
            statusClass: tx.status === "successful" ? "success" : tx.status === "failed" ? "failed" : "pending"
        }));

        document.querySelector(".balance-value").textContent =
        "₦ " + Number(balanceData.data.available_balance)
            .toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        if (initial) {
            allTransactions = newTransactions;
            document.getElementById("transactionsTable").innerHTML = "";
            document.getElementById("transactionsMobile").innerHTML = "";
            currentIndex = 0;
            renderNextTransactions();
        } else {
            const latestId = allTransactions.length > 0 ? allTransactions[0].id : null;
            const freshOnes = [];

        for (let tx of newTransactions) {
            if (tx.id === latestId) break; 
            freshOnes.push(tx);
        }

        if (freshOnes.length > 0) {
            
            allTransactions = [...freshOnes, ...allTransactions];

            const tableBody = document.getElementById("transactionsTable");
            const mobileList = document.getElementById("transactionsMobile");

            tableBody.innerHTML = freshOnes.map(t => `
            <tr>
                <td>${t.id}</td>
                <td>${t.date}</td>
                <td>₦${t.amount}</td>
                <td><span class="status-pill ${t.statusClass}">${t.statusText}</span></td>
            </tr>
            `).join('') + tableBody.innerHTML;

            mobileList.innerHTML = freshOnes.map(t => `
            <div class="trx-card">
                <div>
                <div style="font-weight: 600;">₦${t.amount}</div>
                <div style="font-size: 0.8rem; color: var(--text-dim);">${t.id} • ${t.date}</div>
                </div>
                <span class="status-pill ${t.statusClass}">${t.statusText}</span>
            </div>
            `).join('') + mobileList.innerHTML;
        }
        }
    })
    .catch(error => console.error("Error loading data:", error));
    }
        document.addEventListener("DOMContentLoaded", function () {
        loadTransactions(true);
        setInterval(() => loadTransactions(false), 30000);
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
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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

  document.addEventListener("DOMContentLoaded", function () {
    renderApp(0, []);

    loadTransactions(true);
    setInterval(() => loadTransactions(false), 30000);

    const form = document.getElementById("payForm");
    if (form) {
      form.addEventListener("submit", function (e) {
        e.preventDefault();

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("contact").value.trim();
        const amount = document.getElementById("amount").value.trim();

        FlutterwaveCheckout({
          public_key: "FLWPUBK-2d78f8e2e774035afd5f45d2cdb383f8-X",
          tx_ref: "kbf_" + Math.floor((Math.random() * 1000000000) + 1),
          amount: amount,
          currency: "NGN",
          payment_options: "banktransfer",
          customer: { email, phonenumber: phone, name },
          callback: function (data) {
            if (data.status === "successful") {
              showCustomMessage("Payment successful! Transaction reference: " + data.tx_ref, false);
            } else {
              showCustomMessage("Payment was not successful. Please try again.", true);
            }
          },
          onclose: function () { console.log("Payment modal closed"); },
          customizations: {
            title: "Clickora Management",
            description: "Funding your Flutterwave account"
          }
        });
      });
    }
  });
  
  
  $(function () {
    $("#access-form").on("submit", function (e) {
        e.preventDefault();

        const pin = $("input[name='pin']").val();

        $.ajax({
        url: "../ajax/pin.php",
        method: "POST",
        data: { pin },
        success: function (response) {
            response = response.trim().toLowerCase();

            if (response.includes("invalid")) {
                showCustomMessage("Invalid Pin!", true);
            } else if (response.includes("required")) {
                showCustomMessage("Please input a pin!", true);
            } else if (response.includes("successful")) {
                showCustomMessage("Access Granted", false);
                $("#access-form")[0].reset();
                setTimeout(function() {
                    window.location.href = "clickora";
                }, 3000);
            } else {
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
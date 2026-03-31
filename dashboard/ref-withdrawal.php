<?php 
  session_start();
  if(!isset($_SESSION['user_id']) || !isset($_SESSION['is_logged_in'])) {
    header("Location: ../register.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Withdraw - AdWatch</title>
  <link rel="stylesheet" href="../css/withdrawal.css">
  <link rel="shortcut icon" href="../logo/logo1.png" type="image/x-icon">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div id="App"></div>
<script>

function withdrawalPageDark() {
    
    const withdrawalElement = document.querySelector("#App");

    return withdrawalElement.innerHTML = `

        <div class="dark-withdrawal-container">
            <div class="withdrawal-card-dark">
                
                <header class="card-header-dark">
                    <div class="header-info">
                        <a href="dashboard" class="dashboard-link-dark">← Back to Dashboard</a> 
                        <h3>Secure Transaction</h3>
                        <h2>Initiate Transfer</h2>
                    </div>
                    <div class="current-balance-dark">
                        <p>Available Balance</p>
                        <span class="balance-amount user-balance"></span>
                    </div>
                </header>

                <form id="withdrawalFormDark" class="withdrawal-form-dark">
                    
                    <div class="input-grid">
                        <div class="input-group-dark">
                            <label for="userNameDark">Account Holder Name</label>
                            <input type="text" id="userNameDark" name="accountName" required placeholder="Full name on bank account">
                        </div>

                        <div class="input-group-dark">
                            <label for="bankNameDark">Select Bank</label>
                            <select id="bankNameDark" name="bankName" required>
                                <option value="" disabled selected>Select Bank</option>
                                
                                <optgroup label="Major African Banks (Nigeria Focus)">
                                    <option value="access">Access Bank PLC</option>
                                    <option value="uba">United Bank for Africa (UBA)</option>
                                    <option value="zenith">Zenith Bank PLC</option>
                                    <option value="gtb">Guaranty Trust Holding Company (GTCO)</option>
                                    <option value="first">First Bank of Nigeria</option>
                                    <option value="stanbic">Stanbic IBTC Bank</option>
                                    <option value="fidelity">Fidelity Bank PLC</option>
                                    <option value="ecobank">Ecobank Nigeria</option>
                                    <option value="sterling">Sterling Bank</option>
                                    <option value="wema">Wema Bank</option>
                                    <option value="union">Union Bank of Nigeria</option>
                                    <option value="polaris">Polaris Bank</option>
                                    <option value="fcmb">First City Monument Bank (FCMB)</option>
                                    <option value="keystone">Keystone Bank</option>
                                </optgroup>
                                
                                <optgroup label="Major Microfinance/FinTechs">
                                    <option value="kuda">Kuda Bank (MFI)</option>
                                    <option value="palmpay">PalmPay (MFI)</option>
                                    <option value="opay">Opay (MFI)</option>
                                    <option value="carbon">Carbon (MFI)</option>
                                    <option value="alat">ALAT by Wema</option>
                                    <option value="fairmoney">FairMoney MFB</option>
                                    <option value="renmoney">Renmoney MFB</option>
                                </optgroup>
                                
                                <optgroup label="Pan-African / International">
                                    <option value="standardchartered">Standard Chartered Bank (Global)</option>
                                    <option value="citibank">Citibank (Global)</option>
                                    <option value="absa">ABSA Bank (South Africa)</option>
                                    <option value="equity">Equity Bank (Kenya)</option>
                                    <option value="nedbank">Nedbank (South Africa)</option>
                                    <option value="cbe">Commercial Bank of Ethiopia (CBE)</option>
                                    <option value="attijari">Attijariwafa Bank (Morocco)</option>
                                    <option value="crdb">CRDB Bank (Tanzania)</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="input-group-dark">
                        <label for="accountNumberDark">Recipient Account Number</label>
                        <input type="number" id="accountNumberDark" name="accountNumber" required placeholder="10 to 12 digits">
                    </div>

                    <div class="input-group-dark amount-group-dark">
                        <label for="amountDark">Amount to Withdraw</label>
                        <div class="amount-input-wrapper-dark">
                               <span class="currency-symbol-dark">₦</span>
                               <input type="number" id="amountDark" name="amount" required min="10.00" step="0.01" placeholder="Enter amount">
                        </div>
                        <p class="limit-info">Minimum Withdrawal: <span class="limit-value">₦6,000.00</span></p>
                    </div>
                    
                    <div class="input-group-dark">
                        <label for="withdrawalNoteDark">Description / Reference (Optional)</label>
                        <textarea id="withdrawalNoteDark" name="withdrawalNote" rows="2" placeholder="e.g., Investment return, Salary"></textarea>
                        <span class="hint" style="color: #ee9a4b;font-size:13px;">₦100 would be deducted for site maintenance</span>
                    </div>

                    <button type="submit" class="submit-button-dark">
                        Execute Withdrawal
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.707 9.293l-4-4a1 1 0 00-1.414 0l-4 4a1 1 0 001.414 1.414L11 9.414V17a1 1 0 002 0V9.414l2.293 2.293a1 1 0 001.414-1.414z" fill="currentColor"/></svg>
                    </button>
                    
                    <div class="security-footer">
                        <p>Powered by <span style="color: #0074f0;">SecurePay</span>. Two-Factor Authentication required.</p>
                    </div>

                </form>
            </div>
        </div>
    `;
}
withdrawalPageDark();



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
  }, 6000);
}


$(document).ready(function () {

    function updateRefCount() {
        $.ajax({
            url: "../ajax/dashboard.php",
            method: "GET",
            dataType: "json",
            success: function (response) {
              $(".user-balance").text(response.withdrawalBonus);
            }
        });
    }
    updateRefCount();
    setInterval(updateRefCount, 2000);
});


$(document).ready(function () {
    $("#withdrawalFormDark").on("submit", function (e) {
        e.preventDefault();

        const accountName = $("input[name='accountName']").val();
        const bankName = $("select[name='bankName']").val();
        const accountNumber = $("input[name='accountNumber']").val();
        const amount = $("input[name='amount']").val();
        const withdrawalNote = $("textarea[name='withdrawalNote']").val();

        const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
        const today = new Date();
        const currentDay = days[today.getDay()];

        $.ajax({
            url: "../ajax/ref-withdraw.php",
            method: "POST",
            data: { accountName, bankName, accountNumber, amount, withdrawalNote, currentDay },
            success: function (response) {

                if (response.includes("locked")) {
                    showCustomMessage("Withdrawals are allowed only on Fridays!", true);
                }
                else if (response.includes("min_withdraw")) {
                    showCustomMessage("Minimum withdrawal is ₦6,000", true);
                } 
                else if (response.includes("insufficient")) {
                    showCustomMessage("Oops! insufficient funds", true);
                } 
                else if (response.includes("empty")) {
                    showCustomMessage("All fields are required", true);
                }
                else if (response.includes("Failed")) {
                    showCustomMessage("System error, please try again later", true);
                }
                else if(response.includes("successful")) {
                    showCustomMessage("Your request has been submitted, you would be credited within 24 hours", false);
                    
                    $("#withdrawalFormDark")[0].reset();

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
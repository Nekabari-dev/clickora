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
    <title>Information Hub</title>
    <link rel="stylesheet" href="../css/info.css">
    <link rel="shortcut icon" href="../logo/logo1.png" type="image/x-icon">
</head>
<body>


<!-- Information body -->
<div id="InformationPageContainer"></div>

<script>

function timeAgo(dateValue) {
    const timestamp = Date.parse(dateValue);
    const now = Date.now();
    const diff = Math.floor((now - timestamp) / 1000);

    if (diff < 60) return `${diff} seconds ago`;
    if (diff < 3600) return `${Math.floor(diff / 60)} minutes ago`;
    if (diff < 86400) return `${Math.floor(diff / 3600)} hours ago`;
    if (diff < 604800) return `${Math.floor(diff / 86400)} days ago`;
    return `${Math.floor(diff / 604800)} weeks ago`;
}

function renderAnnouncements(data) {
    const infoElement = document.querySelector("#InformationPageContainer");
    if (!infoElement) return;

    const messageCardsHtml = data.map(msg => `
        <div class="message-card" data-id="${msg.id}">
            ${msg.is_read == 1 ? '' : '<span class="status-dot"></span>'}
            <div class="message-icon icon-${msg.type}">
                ${msg.type === 'system' ? 'S' : msg.type === 'reward' ? 'N' : msg.type === 'alert' ? '!' : 'N'}
            </div>
            <div class="message-content">
                <div class="message-title">${msg.title}</div>
                <div class="message-snippet">${msg.snippet}</div>
                <div class="message-meta">
                    <span>${msg.type.toUpperCase()} Notification</span>
                    <span class="message-date">${timeAgo(msg.date)}</span>
                </div>
            </div>
        </div>
    `).join('');

    infoElement.innerHTML = `
        <div class="info-container">
            <header class="info-header">
                <h1>Information Hub</h1>
                <p>Receive important announcements, security updates, and general news directly from the administration team.</p>
            </header>
            <div class="message-feed">${messageCardsHtml}</div>
        </div>
    `;

    const backBtn = document.createElement("button");
    backBtn.textContent = "↜ Back Home";
    backBtn.onclick = () => window.location.replace('dashboard');
    backBtn.style.cssText = `
        position: absolute;
        top: -3px;
        right: 10px;
        background: #1f2937;
        color: #f3f4f6;
        border: 1px solid #374151;
        padding: 6px 9px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    `;

    const header = document.querySelector(".info-header");
    if (header) {
        header.style.position = "relative";
        header.appendChild(backBtn);
    }

    document.querySelectorAll('.message-card').forEach(card => {
        card.addEventListener('click', function() {
            const id = this.dataset.id;
            const title = this.querySelector('.message-title').textContent;

            this.querySelector('.status-dot')?.remove();

            fetch('../ajax/markAsRead.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            });

            const messageBox = document.createElement('div');
            messageBox.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #333; color: white; padding: 15px; border-radius: 8px; z-index: 1000; box-shadow: 0 4px 10px rgba(0,0,0,0.5);';
            messageBox.textContent = 'Opened: ' + title + '.';
            document.body.appendChild(messageBox);
            setTimeout(() => messageBox.remove(), 3000);
        });
    });
}

function fetchAnnouncements() {
    fetch('../ajax/info.php')
        .then(res => res.json())
        .then(data => renderAnnouncements(data))
        .catch(err => console.error('Error fetching announcements:', err));
}

document.addEventListener('DOMContentLoaded', () => {
    fetchAnnouncements();
    setInterval(fetchAnnouncements, 20000);
});


</script>

    
</body>
</html>
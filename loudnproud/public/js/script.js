// Countdown to festival
const target = new Date("2027-05-28T00:00:00").getTime();

function updateCountdown() {
    const now = Date.now();
    const d   = target - now;
    const el  = document.getElementById("countdown");
    if (!el) return;

    if (d <= 0) {
        el.textContent = "Festival is LIVE right now!";
        return;
    }

    const days  = Math.floor(d / 86400000);
    const hours = Math.floor((d % 86400000) / 3600000);
    const mins  = Math.floor((d % 3600000)  / 60000);
    const secs  = Math.floor((d % 60000)    / 1000);

    el.innerHTML =
        `<span>${days}<em>d</em></span>` +
        `<span>${String(hours).padStart(2,'0')}<em>h</em></span>` +
        `<span>${String(mins).padStart(2,'0')}<em>m</em></span>` +
        `<span>${String(secs).padStart(2,'0')}<em>s</em></span>`;
}

updateCountdown();
setInterval(updateCountdown, 1000);

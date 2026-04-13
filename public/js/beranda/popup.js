let secret = "";
document.addEventListener("keydown", (e) => {
    secret += e.key.toLowerCase();
    if (secret.includes("osu")) {
        document.getElementById("loginModal").style.display = "flex";
        secret = "";
    }
});
function tutupModal() { document.getElementById("loginModal").style.display = "none"; }
window.addEventListener("unload", function () {
    navigator.sendBeacon("/lib/logout.php");
});
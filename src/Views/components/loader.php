<!-- Non-blocking top hairline progress indicator (Linear / Vercel style) -->
<div id="preload-bar" aria-hidden="true"></div>
<script>
(function() {
  var bar = document.getElementById("preload-bar");
  if (!bar) return;
  bar.style.width = "35%";
  function completeBar() {
    if (!bar) return;
    bar.style.width = "100%";
    setTimeout(function() {
      if (bar) {
        bar.classList.add("is-loaded");
        setTimeout(function() {
          if (bar && bar.parentNode) {
            bar.parentNode.removeChild(bar);
          }
        }, 300);
      }
    }, 150);
  }
  if (document.readyState === "complete") {
    completeBar();
  } else {
    window.addEventListener("load", completeBar, { once: true });
    // Safety timeout in case load event already fired
    setTimeout(completeBar, 400);
  }
})();
</script>

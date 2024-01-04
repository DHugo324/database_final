function toUrl(url) {
    localStorage.setItem('currentIframeSrc', url);
    location.reload(true);
}

document.addEventListener("DOMContentLoaded", function() {
    const mainIframe = document.getElementById("mainIframe");

    // 檢查是否有保存的 iframe 的 src
    const savedSrc = localStorage.getItem('currentIframeSrc');
    if (savedSrc) {
        mainIframe.src = savedSrc;
    }
});
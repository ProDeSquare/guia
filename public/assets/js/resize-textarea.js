// adding auto resize functionality to all textareas in the app
document.querySelectorAll("textarea").forEach(el => {
    const offset = el.offsetHeight - el.clientHeight
    el.addEventListener("input", e => {
        e.target.style.height = "auto"
        e.target.style.height = `${e.target.scrollHeight + offset}px`
    })
})

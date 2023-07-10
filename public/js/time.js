// time
const hari = new Date().toLocaleDateString("id-ID", {
    weekday: "long",
    day: "numeric",
    month: "long",
    year: "numeric",
});
const day = document.getElementById("jam");
day.innerHTML = `${hari}`;

// sidebar
const buttonSidebar = document.getElementById("buttonSidebar");
const sidebar = document.getElementById("sidebar");
const page = document.getElementById("page");

buttonSidebar.addEventListener("click", () => {
    sidebar.classList.toggle("d-none");
    sidebar.classList.toggle("d-sm-none");
    page.classList.toggle("page-margin");
});

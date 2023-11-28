var panels = document.getElementsByClassName("panel");

for (let i = 0; i < panels.length; i++) {
    panels[i].addEventListener("click", function (e) {
        let id = panels[i].id;
        window.location.href = "index.php?page=administrator&panel=" + id;
    });
}

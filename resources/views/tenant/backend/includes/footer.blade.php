<footer class="app-footer">
    <div class="block">Tenant -- Copyright 2023 by <a href="#">Hoa Ngo</a></div>
</footer>
<script>
    let menuToggle = document.getElementById('menuToggle');
    let sidebar = document.getElementById('sidebar');
    let appContainer = document.getElementById('appContainer');

    menuToggle.onclick = function() {
        sidebar.classList.toggle('show');
    }

    if(sidebar.classList.contains('show')) {
        try {
            appContainer.addEventListener("click", (e) => {
                sidebar.classList.remove('show');
            });
        } catch ($ex) {}
    }

</script>
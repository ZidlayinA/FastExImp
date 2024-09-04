<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>

<script>
    function btn_salir(){
        localStorage.clear();
        location = '<?php echo site_url("app/logout")?>'
    }
</script>

</body>
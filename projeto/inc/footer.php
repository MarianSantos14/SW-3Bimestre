		

	<hr>
	</main> <!-- /container -->
	<footer class="container d-flex align-items-center justify-content-center">
        <?php $dt = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));?>
		<p>&copy;2026 à <?php echo $dt->format("Y");?> - Haléxya e Mariana</p>
	</footer>


    <script src="<?php echo BASEURL; ?>js/jquery-4.0.0.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/all.min.js"></script>

    <script src="<?php echo BASEURL; ?>js/main.js"></script>
</body>
</html>
	<hr>

	</main> <!-- /container -->
    
	<footer>
        <?php $dt = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));?>
		<p>&copy;2026 à <?= $dt->format("Y");?> - Haléxya e Mariana</p>
	</footer>

    <script src="<?= BASEURL; ?>js/jquery-4.0.0.min.js"></script>
    <script src="<?= BASEURL; ?>js/bootstrap.bundle.min.js"></script>
	<script src="<?= BASEURL; ?>js/style.js"></script>
	<script src="<?= BASEURL; ?>js/main.js"></script>
    <script src="<?= BASEURL; ?>js/all.min.js"></script>
</body>
</html>
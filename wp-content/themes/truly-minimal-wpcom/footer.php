<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Truly_Minimal
 */
?>

	</div><!-- #main -->

<div id="footer">
    Copyright &copy; <?php echo date("Y"); ?> <a href="<?php echo home_url(); ?>" title="<?php bloginfo("name"); ?>" rel="home"><?php bloginfo("name"); ?></a>. All rights Reserved.<br/> Powered by <a href="http://kapasoft.com" title="KapaSoft Web Solutions Website" target="_blank">KapaSoft</a>.
</div><!-- END #footer -->

	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

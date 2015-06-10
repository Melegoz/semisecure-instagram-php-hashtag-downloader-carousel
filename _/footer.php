<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package encor
 */
?>
<div class="clr"></div>

<div id="footerwrap">
	<div class="row container" id="footer"><?php dynamic_sidebar( 'footer' ); ?></div>
</div><!-- END FOOTER -->
<div class="clr"></div>


<?php wp_footer(); ?>

</body>
</html>

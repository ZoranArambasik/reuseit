<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
		</div><!-- .container -->
	</div><!-- #content -->

    <?php get_template_part( 'footer', 'index' ); ?>

<?php endif; ?>
</div><!-- #page -->
<?php if(is_home() or is_front_page()) { ?>
<!-- Modal -->
<!-- div class="modal fade" id="reuseitjul" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" style="background-image: url('/wp-content/uploads/2020/12/bg-reuseit.jpg');padding-bottom:50px;">
			<div class="modal-body">
				<h2>Öppettider under Jul och nyårhelgen</h2>
				<p>Under jul- och nyårshelgen samt trettondedaghelgen håller vår växel stängd.<br> Vår e-kundservice finns på plats och besvarar frågor som vanligt.
				Vi ber om överseende med något längre ledtider på leveranser och supportärenden under denna period.
				 <br><br>
				<strong>Vi är åter på plats igen på kontoret 7 januari.</strong>
				</p>
				<p>	<strong>God Jul & Gott Nytt År</strong><br>
				ReuseIT </p>
				<button type="button" class="btn btn-default" data-dismiss="modal" style="width:120px;background-color:#51bb3e;padding:4px;float:right;color:#fff;">Stäng</button>
			</div>
		</div>

	</div>
</div -->

<script type="text/javascript">
     jQuery(window).load(function(){
        // jQuery('#reuseitjul').modal('show');
      });
</script>
<style>
#reuseitjul .modal-content {
    width: 650px;
		height: 400px;
    z-index: 99999;
}
#reuseitjul .modal-body{
	display: table;
}
#reuseitjul .modal-dialog{
	margin: 0 auto;
	margin-top:10% !important;
}
#reuseitjul .modal-header{
	border-bottom: none !important;
}

@media only screen and (max-width: 768px){

#reuseitjul .modal-content {
	width: 100%;
height: auto !important;
}

}
</style>

<?php }?>
<?php wp_footer(); ?>
<script src="//code.tidio.co/24ogonkkigcywyxyirskzwps39czxzsc.js" async></script>
</body>
</html>

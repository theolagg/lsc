<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package FlipNewMedia
 */

get_header();
 
?>
<style>
/*404*/

main#primary.not_found_page {
    padding-top: 0;
}
 
section.error-404.not-found {
    background-image: url();
    background-repeat: no-repeat;
    background-size: cover;
    height: calc(100vh - 0px);
    display: flex;
    align-items: center;
    justify-content: center;
    background-position: left;
    padding: 0 10px;
}
section.error-404.not-found h1 {
    margin: 0;
    font-weight: 500;
    font-size: 152px;
    line-height: 1.2;
    text-align: center;
    color: var(--m1);
}
section.error-404.not-found header.page-header {
    text-align: center;
    max-width: 1024px;
    margin: 0 auto;
    
    padding: 0;
    width: 100%;
}
section.error-404.not-found header.page-header a.button.yellow.general-btn {
    margin: 0 auto;
    margin-top: 49px;
}
section.error-404.not-found p {
    margin: 0;
    font-weight: normal;
    font-size: 22px;
    line-height: 28px;
    text-align: center;
    color: #000;
    margin-bottom: -25px;
    margin-bottom: 25px;
}
.error404  .breadcrumbs-wrapper {
    display: none;
}
a.return_home {
    width: 100%;
    line-height: 54px;
 
    text-align: center;
    margin: 0 auto;
    margin-top: 20px;
	max-width: 365px;
	display: block;
	color: #fff;
	font-weight: 500;
}
.error_text {
    max-width: var(--sitew);
    margin-right: auto;
    margin-left: auto;
    width: var(--mw);
}
section.error-404.not-found p.e_text {
    margin-bottom: 0;
    line-height: 22px;
    font-size: 18px;
}
.red_btn.error_cta {
    margin-top: 25px;
}
@media screen and (max-width: 1140px) {   
section.error-404.not-found {background-size: contain !important;}
section.error-404.not-found header.page-header {padding-right: 20px;}   
}
/*END OF 1140*/

@media screen and (max-width: 991px) {
section.error-404.not-found {background: none;height: auto;}
section.error-404.not-found header.page-header {padding-right: 0;padding-top: 87px;padding-bottom: 43px;}
.error_text {margin: 0 auto;max-width: 100%;}
.mobile_404 {display: block !IMPORTANT;}
}
/*END OF 991*/
@media screen and (max-width: 480px) {
section.error-404.not-found p {padding: 0 27px;line-height: 25px;margin-bottom: -17px;}
section.error-404.not-found h1 {line-height: 161px;}    
}
/*END OF 480*/

@media screen and (max-width: 360px) {
.red_btn.error_cta * {font-size: 16px !important;line-height: 52px;}
}
/*END OF 360*/


/*END OF 404*//*404*/

main#primary.not_found_page {
    padding-top: 0;
}
 
section.error-404.not-found {
    background-image: url();
    background-repeat: no-repeat;
    background-size: cover;
    height: calc(100vh - 0px);
    display: flex;
    align-items: center;
    justify-content: center;
    background-position: left;
    padding: 0 10px;
}
section.error-404.not-found h1 {
    margin: 0;
    font-weight: 500;
    font-size: 152px;
    line-height: 1.2;
    text-align: center;
    color: var(--m1);
}
section.error-404.not-found header.page-header {
    text-align: center;
    max-width: 1024px;
    margin: 0 auto;
    
    padding: 0;
    width: 100%;
}
section.error-404.not-found header.page-header a.button.yellow.general-btn {
    margin: 0 auto;
    margin-top: 49px;
}
section.error-404.not-found p {
    margin: 0;
    font-weight: normal;
    font-size: 22px;
    line-height: 28px;
    text-align: center;
    color: #000;
    margin-bottom: -25px;
    margin-bottom: 25px;
}
.error404  .breadcrumbs-wrapper {
    display: none;
}
a.return_home {
    width: 100%;
    line-height: 54px;
 
    text-align: center;
    margin: 0 auto;
    margin-top: 20px;
	max-width: 365px;
	display: block;
	color: #fff;
	font-weight: 500;
}
.error_text {
    max-width: var(--sitew);
    margin-right: auto;
    margin-left: auto;
    width: var(--mw);
}
section.error-404.not-found p.e_text {
    margin-bottom: 0;
    line-height: 22px;
    font-size: 18px;
}
.red_btn.error_cta {
    margin-top: 25px;
}
a.btn.blue_btn {
    background-color: var(--m1);
    border-radius: 26px;
}
@media screen and (max-width: 1140px) {   
section.error-404.not-found {background-size: contain !important;}
section.error-404.not-found header.page-header {padding-right: 20px;}   
}
/*END OF 1140*/

@media screen and (max-width: 991px) {
section.error-404.not-found {background: none;height: auto;padding-top: var(--header);}
section.error-404.not-found header.page-header {padding-right: 0;padding-top: 87px;padding-bottom: 43px;}
.error_text {margin: 0 auto;max-width: 100%;}
.mobile_404 {display: block !IMPORTANT;}
}
/*END OF 991*/
@media screen and (max-width: 480px) {
section.error-404.not-found p {padding: 0 27px;line-height: 25px;margin-bottom: 20px;}
section.error-404.not-found h1 {line-height: 161px;}    
}
/*END OF 480*/

@media screen and (max-width: 360px) {
.red_btn.error_cta * {font-size: 16px !important;line-height: 52px;background-color: var(--m1);border-radius: 26px;}
}
/*END OF 360*/


/*END OF 404*/


</style>

	<main id="primary" class="site-main not_found_page">

		<section class="error-404 not-found">
			<header class="page-header">
				<div class="error_text">	
					<p>Ουπς! Κάτι πήγε λάθος!</p>
					<h1>404</h1>
					<p class="e_text">Η σελίδα που ζητήσατε δεν βρέθηκε</p>					
					<div class='red_btn error_cta'>					 
						<a class='btn blue_btn' href='<?php echo get_home_url();?>'>Επιστροφή στην αρχική </a>
					</div>
					
					
				</div>
			</header><!-- .page-header -->

		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();

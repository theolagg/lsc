<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package FlipNewMedia
 */

get_header();


	$tab_txt_1 = 'ΠΡΟΪΟΝΤΑ';
	$tab_txt_2 = 'BLOG';
	$tab_txt_3 = 'ΥΠΟΛΟΙΠΑ ΑΠΟΤΕΛΕΣΜΑΤΑ';
	$res_for   = 'αποτελέσματα για';
	$no_res    = 'Δυστυχώς δεν βρήκαμε αυτό που ζητήσατε!<br>Δοκιμάστε μια νέα αναζήτηση';

?>
<style>
/*SEARCH PAGE*/
body.search main#primary {
    padding-top: var(--header);
    background-size: contain;
    background-position: center;
    background-repeat: repeat;
}
body.search .breadcrumbs-wrapper {
    display: none;
}
body.search .general_banner {
    margin-top: -1px;
    height: 46.8vh;
    height: 23vw;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    position: relative;
    padding: 0 var(--pad);
    display: flex;
    justify-content: center;
    min-height: 315px;
}
body.search .general_banner.blue_banner {
    background-color: var(--m1);
    height: 315px;
}
body.search .general_banner.blue_banner .gbanner_content {
    padding-top: 112px;
    position: static;
}
body.search .general_banner.blue_banner.search_banner h1 {
    font-weight: 500;
    font-size: 44px;
    line-height: 1.3;
    text-align: center;
	color:#fff;
}
.products_search_wrapper ul.products.columns-4 {
    justify-content: center;
    width: 100%;
}
.general_banner.blue_banner.search_banner .search_pg_form {
    position: absolute;
    bottom: -28px;
    left: 0;
    right: 0;
    width: 100%;
    max-width: 488px;
    margin: 0 auto;
}
.search_pg_form input.search-field {
    padding: 0 19px;
    font-weight: 500;
    font-size: 15px;
    text-align: left;
    color: var(--m1);
    -webkit-appearance: none !important;
    background: transparent !important;
    padding-right: 10px;
    outline: none !important;
    width: 100%;
    padding-left: 40px;
    border: solid 1.5px var(--m1);
    border-radius: 22px;
    background-color: #fff !IMPORTANT;
    height: 50px;
}
/* clears the ÃƒÂ¢Ã¢â€šÂ¬Ã‹Å“XÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ from Internet Explorer */
input[type=search]::-ms-clear {
    display: none;
    width : 0;
    height: 0;
}
input[type=search]::-ms-reveal {
    display: none;
    width : 0;
    height: 0;
}
/* clears the ÃƒÂ¢Ã¢â€šÂ¬Ã‹Å“XÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ from Chrome */
input[type="search"]::-webkit-search-decoration, input[type="search"]::-webkit-search-cancel-button, input[type="search"]::-webkit-search-results-button, input[type="search"]::-webkit-search-results-decoration {
    display: none;
}
.search_pg_form form.search-form {
    position: relative;
}
.search_pg_form form.search-form label {
    display: block;
}
.search_pg_form form.search-form input.search-submit {
    all: unset;
    position: absolute;
    right: 0;
    top: 0;
    height: 50px;
    width: 53px;
    font-size: 0;
    color: transparent;
    background-repeat: no-repeat;
    background-position: center;
    z-index: 4;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='23.933' height='23.933' viewBox='0 0 23.933 23.933'%3E%3Cg id='Group_1' data-name='Group 1' transform='matrix(0.966, -0.259, 0.259, 0.966, -2.19, 3.793)'%3E%3Cg id='Ellipse_14' data-name='Ellipse 14' transform='translate(0 8.462) rotate(-30)' fill='none' stroke='%23f4f6fa' stroke-width='1.5'%3E%3Cellipse cx='8.462' cy='8.462' rx='8.462' ry='8.462' stroke='none'%3E%3C/ellipse%3E%3Cellipse cx='8.462' cy='8.462' rx='7.712' ry='7.712' fill='none'%3E%3C/ellipse%3E%3C/g%3E%3Cline id='Line_11' data-name='Line 11' x2='2.672' y2='4.895' transform='translate(15.567 18.501)' fill='none' stroke='%23f4f6fa' stroke-linecap='round' stroke-width='1.5'%3E%3C/line%3E%3C/g%3E%3C/svg%3E");
    background-color: var(--m2);
    border-top-right-radius: 27px;
    border-bottom-right-radius: 27px;
}
div#section_search_1 {
    padding-top: 70px;
}
div#search_row_1 {
    border-bottom: solid 1px #DADADA;
    padding-left: var(--padfw);
    padding-right: var(--padfw);
}
#search_row_1 .search_content {
    /* width: var(--mw); */
    max-width: var(--sitew);
}
.search_tab li:last-child {
    margin-right: 0;
}
.search_tab li.tab_search_active_main:after {
    content: '';
    position: absolute;
    width: 100%;
    background-color: var(--m1);
    height: 2px;
    bottom: -1px;
    left: 0;
}
.products_search_wrapper {
    padding-top: 70px;
    padding-bottom: 88px;
}
.search-tabs-content {
    padding-left: var(--pad);
    padding-right: var(--pad);
}
.products_search_wrapper .products_template {
    padding-left: 0;
    padding-right: 0;
    width: 100%;
}
.products_search_wrapper .products_template .product_col {
    width: 25%;
}
div#search_row_2 {
    position: relative;
    overflow: hidden;
}
.products_search_wrapper .products_template .product_col:nth-child(3n) {
    border-right: solid 1px #E9E9E9;
}
.products_search_wrapper .products_template .product_col:nth-child(4n) {
    border: none;
}
.articles_wrapper {
    padding-top: 70px;
    padding-bottom: 113px;
}
.articles_wrapper div#b2 {
    width: 100%;
}
.products_search_wrapper .products_template .product_col .action.fav.product {
    top: 10px;
    right: 25px;
}
.rest_wrapper {
    padding: 0 20px;
    padding-top: 67px;
    padding-bottom: 88px;
}
.rest_results {
    max-width: 1024px;
    margin: 0 auto;
    border-bottom: solid 1px #D2D2D2;
}
.rest_results a {
    font-weight: 500;
    font-size: 20px;
    line-height: 1;
    text-align: left;
    color: var(--m1);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-left: 14px;
    padding-right: 15px;
    padding-bottom: 29px;
    padding-top: 25px;
    transition: all 300ms;
}
.rest_results a:hover {
    background-color: var(--m2);
    color: #fff !important;
}
.rest_results a svg * {
    transition: all 300ms;
    stroke: var(--m1);
}
.rest_results a:hover svg * {
    stroke: #fff;
}
.search_tab {
    margin: 0px;
    padding: 0px;
    list-style: none;
    position: relative;
    z-index: 1;
}
.search_tab li {
    background: none;
    color: #222;
    display: inline-block;
    padding: 0;
    cursor: pointer;
    font-weight: 500;
    font-size: 16px;
    line-height: 25px;
    text-align: left;
    color: var(--m1);
    position: relative;
    margin-right: 45px;
    padding-bottom: 12px;
}
.tab_main_search {
    position: absolute;
    top: 0;
    left: 0;
    visibility: hidden;
    background: transparent;
    padding: 0;
    opacity: 0;
    height: 0;
    transition: opacity 500ms;
    /* max-width: 1146px; */
    margin: 0 auto;
    left: 0;
    right: 0;
}
.tab_main_search.tab_search_active_main {
    position: static;
    visibility: visible;
    height: auto;
    opacity: 1;
    transition: opacity 500ms;
}

.products_search_wrapper .product-item{
	width:33%;
	max-height: 26%;
}


.no_results {
    font-weight: 500;
    font-size: 25px;
    color: var(--m1);
    text-align: center;
    padding-bottom: 50px;
}
.products_search_wrapper .products_template li {
    margin-bottom: 30px !IMPORTANT;
}
div#bc2 {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.search_pg_form input::-webkit-input-placeholder {
    color: var(--m1);
}

.products_search_wrapper ul.products li.product {
    width: calc((100%/4) - (60px/4));
}
	.products_search_wrapper .products_template .woocommerce {
    width: 100%;
}
.columns-4{
	--bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
}

@media screen and (max-width:767px){
	.products_search_wrapper .product-item{
width:100%;	
    max-height: 12%;
	}
	.tab_main_search.tab_search_active_main {
		width: 90%;
	}
	.products_search_wrapper .products_template .woocommerce {
    width: 100%;
    height: 100%;
}
	
}


/*END OF SEARCH PAGE*/
</style>
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			

			<?php
			
		
			$arrow_html = '<svg xmlns="http://www.w3.org/2000/svg" width="28.053" height="28.053" viewBox="0 0 28.053 28.053"><g transform="translate(2.121 2.121)"><path d="M0,0H16.842V16.831" transform="translate(11.901 0) rotate(45)" fill="none" stroke="var(--grey-font)" stroke-linecap="round" stroke-width="3"></path></g></svg>';
			/* Start the Loop */
			$articlesHTML = '';			
			$productsHTML = '';
			$restHTML  = '';
			$tabs = array();
		
			$ids = array();
		
			
            $blog = isset($GLOBALS['BLOG']) ? $GLOBALS['BLOG'] : null;
			$articles_ids = array($blog,40,41,42);
			
			$total_results = 0;
			$prods_counter = 0;
			while ( have_posts() ) :
				the_post();
				global $post;
				//echo '<pre>';print_r($post);echo '</pre>';
				$type = $post->post_type;
				
				
				$current_cats = wp_get_post_categories($post->ID);										

				//$diff_cats = array_intersect($articles_ids, $current_cats);
				if($type == 'post' && !empty($diff_cats) ) {
					ob_start();
					get_template_part( 'template-parts/content', 'blogs' );
					$articlesHTML .= ob_get_clean();
					$total_results++;
				}				
				else if($type == 'product') {
					if($prods_counter<200) {
						$ids[] = $post->ID;
						$total_results++;
					}
					
					$prods_counter++;
				}
				else if($type == 'post' || $type == 'page' || $type == 'vrefika-domatia') {
					ob_start();					 
 					$page_title = get_the_title($post->ID);
					$page_link  = get_permalink($post->ID);	
					?>
					 <div class="col-md-4 rest_results">
                <a href="<?php echo $page_link; ?>">
                    <span><?php echo $page_title; ?></span><?php echo $arrow_html; ?>
                </a>
            </div>
					<?php
					$restHTML .= ob_get_clean();
					$total_results++;
				}
				
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				//get_template_part( 'template-parts/content', 'search');
				//$total_results++;
			endwhile;
			
			//$tabs = array_unique($tabs);


			$tabs_html = '';
			$tab_content_html = '';
			
			$prods_ids = implode(', ', $ids);
			//echo $prods_ids;
			if(!empty($ids)) {
				$productsHTML = do_shortcode('[products ids="'.$prods_ids.'"   limit="200"]');
			}
			
		
			if(!empty($articlesHTML) || !empty($productsHTML) || !empty($restHTML)) {		
				$class = 'tab_search_active_main';
				if(!empty($productsHTML)) {	
					$tabs_html        .= "<li class=' serach_tab_main_search $class' data-tab='products_tab'>$tab_txt_1</li>";
					 
					
					$tab_content_html .= "<div id='products_tab' class=' tab_main_search $class'>
											<div class='products_search_wrapper'>
												<div class='custom-boxed-cont '>
													<div class='products_template products row columns-4'>
														$productsHTML
													</div>
												</div>								 
											</div>
										 </div>";	
					$class = '';
				}
				
				if(!empty($articlesHTML)) {					
					$tabs_html        .= "<li class='serach_tab_main_search $class' data-tab='articles_tab'>$tab_txt_2</li>";
					$tab_content_html .= "<div id='articles_tab' class='tab_main_search $class'>
											<div class='articles_wrapper'>
												<div id='b2' class='blog_row custom-boxed-cont'>						
													<div id='bc2' class='blog_content blog_col_wrapper '>
														$articlesHTML
													</div>
												</div>
											</div>
										 </div>";	
					$class = '';
				}
				
				
				if(!empty($restHTML)) {
					$tabs_html        .= "<li class='serach_tab_main_search $class' data-tab='rest_tab'>$tab_txt_3</li>";
					$tab_content_html .= "<div id='rest_tab' class='tab_main_search $class'>
											<div class='rest_wrapper'>$restHTML</div>
										 </div>";
					$class = '';
				}
				?>
				<div class="container-row m-auto px-lg-5 px-4 general_banner blue_banner search_banner">
					<div class="gbanner_content">
						<h1> 
							<?php echo $total_results>1 ? "<span>$total_results $res_for</span>" : "<span>$total_results $res_for</span>";?><br>
							<?php printf( esc_html__( '"%s"', 'flipnewmedia' ), '<span>' . get_search_query() . '</span>' ); ?>
						</h1>						
						<div class="search_pg_form"><?php get_search_form();?></div>
					</div>
				</div>
	
				<div id="section_search_1" class="search_pg container-row m-auto px-lg-5 px-4">
					<div id="search_row_1" class="search_row">			
						<div class="search_content m-auto">
							<div class="search-tabs-wrapper">
								<ul class="search_tab">
								  <?php echo $tabs_html;?>
								</ul>
							</div>
						</div>
					</div>
					<div id="search_row_2" class="search_row">			
						<div class="search_content m-auto">
							<div class="search-tabs-content">
								<?php echo $tab_content_html;?>
							</div>
						</div>
					</div>
				</div>
		
					
				
				<?php
				
			}
			else {
				?>
				<div class="general_banner container-row m-auto px-lg-5 px-4 blue_banner search_banner">
					<div class="gbanner_content">
						<h1> 							
							<span>0 <?=$res_for;?></span><br>
							<?php printf( esc_html__( '"%s"', 'flipnewmedia' ), '<span>' . get_search_query() . '</span>' ); ?>
						</h1>
						<div class="search_pg_form"><?php get_search_form();?></div>
					</div>
				</div>
				<div id="section_search_1" class="search_pg container-row m-auto px-lg-5 px-4">
					<div id="search_row_1" class="search_row">			
						<div class="search_content m-auto">
							<div class="no_results">
								<?=$no_res;?>
							</div>
						</div>
					</div>
				</div>
				<?php				
			}

			//the_posts_navigation();

		else :
			?>
				<div class="general_banner blue_banner search_banner container-row m-auto px-lg-5 px-4">
					<div class="gbanner_content">
						<h1> 							
							<span>0 <?=$res_for;?></span><br>
							<?php printf( esc_html__( '"%s"', 'flipnewmedia' ), '<span>' . get_search_query() . '</span>' ); ?>
						</h1>
						<div class="search_pg_form"><?php get_search_form();?></div>
					</div>
				</div>
				<div id="section_search_1" class="search_pg container-row m-auto px-lg-5 px-4">
					<div id="search_row_1" class="search_row">			
						<div class="search_content m-auto">
							<div class="no_results">
								<?=$no_res;?>
							</div>
						</div>
					</div>
				</div>
			<?php
			//get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
<script>
	jQuery(".search_tab li").click(function () {
		var tab_id = jQuery(this).attr("data-tab");
		jQuery(".search_tab li").removeClass("tab_search_active_main");
		jQuery(".tab_main_search").removeClass("tab_search_active_main");
		jQuery(this).addClass("tab_search_active_main");
		jQuery("#" + tab_id).addClass("tab_search_active_main");
		jQuery("div[data-id='" + tab_id + "']").addClass("tab_search_active_main");
	  });		
</script>
	</main><!-- #main -->

<?php

get_footer();
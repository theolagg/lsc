<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



function newsletter_footer() {
	ob_start();
	$nl_title         = 'Newsletter';
$mail_placeholder = 'Ονοματεπώνυμο';
$terms_label      = 'Όροι Χρήσης';
$terms            = 'Αποδέχομαι τους <a style="text-decoration:underline;" target="_blank" href=" ">όρους χρήσης</a>';
$submit           = 'Αποστολή';
?>
	<div class="newsletter_form_wrapper">
	  <form name="newsletter_form" id="newsletter_form" class="newsletter_form">
		<div class="nl_icon_title">
			<div class="nl_icon_wrap">
		
				<span><?=$nl_title;?></span>
			</div>	
		</div>
		<div class="email_submit">
			<div class="nl_wrap">
				<div class="nl_input">
					<label for="newsletter_email" style="display:none"><?=$nl_title;?></label>
					<input type="email" id="newsletter_email" class="email" placeholder="<?=$mail_placeholder;?>" name="email">
				</div>
				<div class="newsletter_error"></div>	
			</div>
			
		</div>
		<div class="ch-bt">
			<div class="nl_check">
					<label class="chk_container">
						<label for="newsletter_oroi" style="display:none"><?=$terms_label;?></label>
						<input id="newsletter_oroi" type="checkbox" name="oroi" value="1">
						<span class="checkmark"></span>
						<span class="chk_text" style="display: block;text-align: left;"> <?=$terms;?> </span>
					</label>
					
					
			</div>  
			<div class="nl_submit"><button class='submit_nl submit_newsletter button-hover' type="submit"  value="ΥΠΟΒΟΛΗ">ΥΠΟΒΟΛΗ</button> </div>
	  </div>
<div class="newsletter_success"></div>

	  </form>
	</div>

<?php
		$output = ob_get_clean();
		return $output;
}
add_shortcode('display_newsletter_footer','newsletter_footer');

function social() {
	ob_start();
	$fb = '<svg xmlns="http://www.w3.org/2000/svg" width="10.608" height="21.215" viewBox="0 0 10.608 21.215">
  <path id="facebook" d="M14.858,3.523H16.8V.149A25.007,25.007,0,0,0,13.974,0C11.181,0,9.268,1.756,9.268,4.985V7.956H6.187v3.771H9.268v9.489h3.778V11.728H16l.469-3.771H13.045v-2.6c0-1.09.294-1.836,1.813-1.836Z" transform="translate(-6.187)" fill="#fff"/>
</svg>';
	$ig = '<svg xmlns="http://www.w3.org/2000/svg" width="20.854" height="20.856" viewBox="0 0 20.854 20.856">
  <path id="instagram" d="M10.633,20.857h-.208c-1.635,0-3.145-.038-4.614-.127a6.168,6.168,0,0,1-3.555-1.346,5.707,5.707,0,0,1-1.918-3.1,13.72,13.72,0,0,1-.315-3.276C.013,12.251,0,11.349,0,10.431S.013,8.608.024,7.846A13.721,13.721,0,0,1,.339,4.57a5.707,5.707,0,0,1,1.918-3.1A6.168,6.168,0,0,1,5.811.129C7.28.039,8.791,0,10.429,0s3.145.038,4.614.127A6.168,6.168,0,0,1,18.6,1.474a5.706,5.706,0,0,1,1.918,3.1,13.72,13.72,0,0,1,.315,3.276c.011.761.021,1.664.024,2.581v0c0,.917-.013,1.82-.024,2.581a13.713,13.713,0,0,1-.315,3.276,5.706,5.706,0,0,1-1.918,3.1,6.168,6.168,0,0,1-3.555,1.346c-1.407.086-2.852.127-4.41.127Zm-.208-1.63c1.608,0,3.085-.037,4.519-.124a4.488,4.488,0,0,0,2.625-.982,4.114,4.114,0,0,0,1.369-2.236,12.482,12.482,0,0,0,.264-2.9c.01-.756.021-1.652.023-2.561s-.013-1.8-.023-2.561a12.484,12.484,0,0,0-.264-2.9,4.114,4.114,0,0,0-1.369-2.236,4.489,4.489,0,0,0-2.625-.982c-1.434-.087-2.911-.128-4.515-.124s-3.085.037-4.519.124a4.489,4.489,0,0,0-2.625.982A4.114,4.114,0,0,0,1.917,4.973a12.483,12.483,0,0,0-.264,2.9c-.01.757-.021,1.653-.023,2.563s.013,1.8.023,2.559a12.482,12.482,0,0,0,.264,2.9,4.114,4.114,0,0,0,1.369,2.236A4.489,4.489,0,0,0,5.91,19.1C7.345,19.191,8.822,19.232,10.425,19.228Zm-.039-3.707a5.092,5.092,0,1,1,5.092-5.092A5.1,5.1,0,0,1,10.387,15.521Zm0-8.554a3.462,3.462,0,1,0,3.462,3.462A3.466,3.466,0,0,0,10.387,6.967Zm5.662-3.259A1.222,1.222,0,1,0,17.27,4.93,1.222,1.222,0,0,0,16.048,3.708Zm0,0" transform="translate(0 -0.001)" fill="#fff"/>
</svg>';
$tw = '<svg xmlns="http://www.w3.org/2000/svg" width="21.197" height="21.215" viewBox="0 0 21.197 21.215">
  <path id="X_logo_2023_original" d="M12.617,8.984,20.51,0H18.64L11.784,7.8,6.313,0H0L8.276,11.795,0,21.215H1.87L9.1,12.977l5.78,8.238H21.2M2.544,1.381H5.417L18.639,19.9H15.766" fill="#fff"/>
</svg>';
$yt = '<svg xmlns="http://www.w3.org/2000/svg" width="25.432" height="17.805" viewBox="0 0 25.432 17.805">
  <path id="youtube_1_2" data-name="youtube(1)2" d="M24.906-3.3a3.186,3.186,0,0,0-2.241-2.241c-1.99-.544-9.95-.544-9.95-.544s-7.96,0-9.95.524A3.248,3.248,0,0,0,.524-3.3,33.57,33.57,0,0,0,0,2.821,33.446,33.446,0,0,0,.524,8.937a3.187,3.187,0,0,0,2.241,2.241c2.01.544,9.95.544,9.95.544s7.96,0,9.95-.524a3.186,3.186,0,0,0,2.241-2.241,33.58,33.58,0,0,0,.523-6.117A31.866,31.866,0,0,0,24.9-3.3ZM10.181,6.633V-.992L16.8,2.821Zm0,0" transform="translate(0.001 6.082)" fill="#fff"/>
</svg>';
$tt = '<svg xmlns="http://www.w3.org/2000/svg" width="19.132" height="23.254" viewBox="0 0 19.132 23.254">
  <path id="Path_15422" data-name="Path 15422" d="M1824.97,84.52c0,2.7.014,5.3,0,7.9a7.252,7.252,0,0,1-6.114,7.334,6.971,6.971,0,0,1-7.181-2.93,6.863,6.863,0,0,1-.4-7.956,6.957,6.957,0,0,1,6.833-3.648c.363.02.546.1.537.509-.022,1.042-.024,2.086,0,3.128.011.451-.152.445-.534.392a3.3,3.3,0,0,0-1.25,6.482,3.293,3.293,0,0,0,3.937-2.366,3.575,3.575,0,0,0,.094-1.058c0-4.939.012-9.878-.011-14.818,0-.616.117-.817.792-.847,1.33-.059,2.267.007,2.839,1.624a4.708,4.708,0,0,0,4.266,2.992c.428.041.553.158.546.577-.022,1.262-.017,2.524,0,3.787,0,.412-.048.558-.544.471a10.768,10.768,0,0,1-3.81-1.569" transform="translate(-1810.195 -76.625)" fill="#fefefe"/>
</svg>';
 
	?>

	<div class="social_wrapper">
		<div class="social_inner">
			<a href="https://www.instagram.com/lambertsgreece/" target="_blank"><?=$ig;?></a>
			<a href="https://www.facebook.com/LambertsGreece/" target="_blank"><?=$fb;?></a>
			<a href="https://x.com/LambertsGreece" target="_blank"><?=$tw;?></a>
			<a href="https://www.youtube.com/user/greenimportgr" target="_blank"><?=$yt;?></a>
			<a href="https://www.tiktok.com/@lambertsgreece?lang=en" target="_blank"><?=$tt;?></a>
		</div>
	</div>
	<?php
	$output = ob_get_clean();
	return $output;	
}
add_shortcode('display_social','social');





function hardcopy_password()
{
    ob_start();
    echo
     "<div class='status-display'></div>
	 <div class='pdf-link' style='display:none;'>Διαβάστε την τελευταία εκδοση του βιβλίου μας πατώντας <a href='https://lamberts.gr/book-neutraceuticals-online-edition.pdf' target='_blank'>εδώ</a> </div>
	 <form method='post' action='' id='unique_code_form' novalidate>
     <div id='password-field' class='password-field'>
        <label for='number'>ΕΙΣΑΓΕΤΕ ΤΟΝ ΚΩΔΙΚΟ ΓΙΑ ΤΗΝ ΗΛΕΚΤΡΟΝΙΚΗ ΕΚΔΟΣΗ ΤΟΥ ΒΙΒΛΙΟΥ</label>
        <input type='number' placeholder='Κωδικός Βιβλίου' name='number' id='number' />
        <div class='err-dspl'></div>
        <div class='psd-submit'>
            <input type='submit' value='ΥΠΟΒΟΛΗ' id='submit'/>
        </div>
    </div>
   </form>
   <div class='success-msg'></div>
    <form method='post' action='' id='additional-fields' style='display:none;' accept-charset='UTF-8'  novalidate>
    <div class='additional-fields'>
	   <input type='number' name='hidden-psd' id='hidden-psd' style='visibility:hidden;' />
	   <div class='pair-block-one'>
	   <div class='name-block'>
        <label for='name'>Όνομα</label>
        <input type='text' name='name' id='name'/>
		 <div class='nameError'></div>
		</div>
		<div class='lname-block'>
        <label for='last-name'>Επίθετο</label>
        <input type='text' name='last-name' id='last-name'/>
		<div class='lastNameError'></div>
		</div>
	   </div>
	   <div class='pair-block-two'>
	   <div class='prof-block'>
        <label for='profession'>Ιδιότητα</label>
        <input type='text' name='profession' id='profession'/>
		  <div class='professionError'></div>
		</div>
		<div class='mail-block'>
        <label for='mail'>Email</label>
        <input type='email' name='mail' id='mail'/>
		<div class='emailError'></div>
		</div>
		</div>
    </div>
    <div class='additional-submit'>
        <input type='submit' value='Καταχώρηση' id='additional-submit'/>
    </div>
    </form>";
    $output = ob_get_clean();
    return $output;
	
}
add_shortcode('password_shortcode', 'hardcopy_password');




function reset_password_page(){
	ob_start();
?>

<div id="reset-password-page">
    <h2>Reset Password</h2>
    <form id="reset-password-form">
        <input type="email" name="user_login" placeholder="Enter your email" required>
        <input type="submit" value="Reset Password">
    </form>
    <div class="reset-password-message"></div>
</div>

<script>
jQuery(document).ready(function($) {
    $('#reset-password-form').on('submit', function(e) {
        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                'action': 'custom_reset_password',
                'data': data
            },
            success: function(response) {
                $('.reset-password-message').html(response.message);
            }
        });
    });
});
</script>

<style>

</style>



<?php
	$output = ob_get_clean();
	return $output;
}

add_shortcode('display_reset_password','reset_password_page');




function reset_password_confirm(){
	ob_start();
?>

<div id="reset-password-confirm-page">
    <h2>Set New Password</h2>
    <form id="reset-password-confirm-form">
        <input type="hidden" name="rp_key" value="<?php echo isset($_GET['key']) ? esc_attr($_GET['key']) : ''; ?>">
        <input type="hidden" name="rp_login" value="<?php echo isset($_GET['login']) ? esc_attr($_GET['login']) : ''; ?>">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" value="Reset Password">
    </form>
    <div class="reset-password-confirm-message"></div>
</div>

<script>
jQuery(document).ready(function($) {
    $('#reset-password-confirm-form').on('submit', function(e) {
        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                'action': 'custom_reset_password_confirm',
                'data': data
            },
            success: function(response) {
                $('.reset-password-confirm-message').html(response.message);
                if (response.success) {
                    $('#reset-password-confirm-form')[0].reset();
                }
            }
        });
    });
});
</script>

<style>

</style>

<?php
	$output = ob_get_clean();
	return $output;
}

add_shortcode('display_reset_password_confirm','reset_password_confirm');

 

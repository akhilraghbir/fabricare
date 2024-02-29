<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	//header of template
	$this->load->view('layout/front_header');
?>
<?php
//sidebar of the template
$this->load->view('layout/sidebar');
?>
<!-- Content Wrapper. Contains page content -->
	<?php
		echo $content;
	?>
<?php
	//footer of template
	$this->load->view('layout/front_footer')
?>

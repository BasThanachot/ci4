<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/64.png'); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link href="<?php echo base_url('assets/css/output.css'); ?>" rel="stylesheet">
	<!-- <link href="<?php //echo base_url('assets/css/main.css'); ?>" rel="stylesheet"> -->

	<script src="<?php echo base_url('assets/js/jquery-3.3.1.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/jquery.cookie.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/masonry.pkgd.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>" type="text/javascript"></script>

	<style> .material-symbols-outlined {  font-variation-settings:  'FILL' 0, 'wght' 200, 'GRAD' 0,  'opsz' 24} </style>
	<title>Project 2 | CI-3</title>

<script>
function modisplay(){$('#container').masonry({itemSelector: '.msr',columnWidth: 10,isAnimated: true,isFitWidth: true});}
function closealltopupdiv(){$("div#fixdiv1, div#fixdiv2, div#xfixdiv3, div#top_bar_right_menu").hide();}
function clearpage(){ modisplay();closealltopupdiv(); }
</script>
</head>
<body class="bg-stone-100">
	<div class="width-full position-relative">
		<div class="position-absolute" style="top:5px;left: 35px; z-index: 10000px;"><!----logo---------------------------------->
            <a href="#">
                <img id="main_top_icon" src="<?php echo base_url('assets/images/64.png'); ?>" class="w-[80px]" alt="" title=" Prepare to 2026 / Hope to see you again..."/>
            </a>
        </div>
		<div id="logo_load" class="text-purple-900 hidden position-absolute" style="top:19px;left: 49px; z-index: 10000px;"><!----logo---------------------------------->
            <i class="fas fa-spinner fa-pulse fa-2x"></i><span class="text-[20px] pad10 text-white"> loading... </span>
        </div> <!----logo---------------------------------->
	</div>
</body>
</html>
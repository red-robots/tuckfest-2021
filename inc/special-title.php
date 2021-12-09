<header class="special-title">
	<div class="wrapper">
    <?php 
    $id = get_the_ID(); 
    $arrpage[3251] = 'Tuck Fest Insiders Guide';
    $arrpage[1017] = 'Race and Comp Registration';
    $arrpage[19] = 'Schedule';
    $page_title = ( isset($arrpage[$id]) && $arrpage[$id] ) ? $arrpage[$id] : get_the_title();
    ?>
    <h1 class="pageTitle"><span class="tan"><?php echo $page_title; ?></span></h1>
	</div>
</header>
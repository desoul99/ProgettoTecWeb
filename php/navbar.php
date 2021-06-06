<?php
function navbar($currentPage){
    require_once('utils.php');
    $pageList = array(
        'Home' => '',
        'Contatti' => '',
        'Chi siamo' => '',
        'Recensioni' => '',
        'Calendario uscite' => '',
        'HomeURL' => '<a xml:lang="en" href="home.php">Home</a>',
        'RecensioniURL' => '<a href="recensioni.php">Recensioni</a>',
        'Calendario usciteURL' => '<a href="uscite.php">Calendario uscite</a>',
        'Chi siamoURL' => '<a href="chi_siamo.php">Chi siamo</a>',
        'ContattiURL' => '<a href="contatti.php">Contatti</a>'
    );
    $navbar = file_get_contents('../html/navbar.html');
    if($currentPage === 'Home'){
        $pageList[$currentPage] = ' xml:lang="en" class="pagCorrente"';
    }else{
        $pageList[$currentPage] = '  class="pagCorrente"';
    }
    $pageList[$currentPage.'URL'] = $currentPage;
    return Utils::bind_to_template($pageList, $navbar);
}
?>
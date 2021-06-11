<?php
function navbar($currentPage, $clickable = false, $recensore = false){
    require_once('utils.php');
    $pageList = array(
        'Home' => '',
        'Contatti' => '',
        'Chi siamo' => '',
        'Recensioni' => '',
        'Calendario uscite' => '',
        'recensore' => '',
        'HomeURL' => '<a xml:lang="en" href="home.php">Home</a>',
        'RecensioniURL' => '<a href="lista_recensioni.php">Recensioni</a>',
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
    if(!$clickable){
        $pageList[$currentPage.'URL'] = $currentPage;
    }
    if($recensore){
        $pageList['recensore'] = '<li><a xml:lang="en" href="dashboard.php">Dashboard</a></li>';
        $pageList['recensore'] .= '<li><a xml:lang="en" href="logout.php">Logout</a></li>';
    }
    return Utils::bind_to_template($pageList, $navbar);
}
?>
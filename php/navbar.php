<?php
function navbar($currentPage, $clickable = false, $recensore = false){
    require_once('utils.php');
    $pageList = array(
        'Home' => ' class="nav_link"',
        'Contatti' => ' class="nav_link"',
        'Chi siamo' => ' class="nav_link"',
        'Recensioni' => ' class="nav_link"',
        'Calendario uscite' => ' class="nav_link"',
        'recensore' => '',
        'HomeURL' => '<a class="nav_link" xml:lang="en" href="home.php">Home</a>',
        'RecensioniURL' => '<a class="nav_link" href="lista_recensioni.php">Recensioni</a>',
        'Calendario usciteURL' => '<a class="nav_link" href="uscite.php">Calendario uscite</a>',
        'Chi siamoURL' => '<a class="nav_link" href="chi_siamo.php">Chi siamo</a>',
        'ContattiURL' => '<a class="nav_link" href="contatti.php">Contatti</a>'
    );
    $navbar = file_get_contents('../html/navbar.html');
    if($currentPage === 'Home'){
        $pageList[$currentPage] = ' xml:lang="en" class="pagCorrente nav_list"';
    }else{
        $pageList[$currentPage] = '  class="pagCorrente nav_list"';
    }
    if(!$clickable){
        $pageList[$currentPage.'URL'] = $currentPage;
    }
    if($recensore){
        $pageList['recensore'] = '<li class="nav_list"><a class="nav_link" xml:lang="en" href="dashboard.php">Dashboard</a></li>';
        $pageList['recensore'] .= '<li class="nav_list"><a class="nav_link" xml:lang="en" href="logout.php">Logout</a></li>';
    }
    return Utils::template($pageList, $navbar);
}
?>
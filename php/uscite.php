<?php
require_once('utils.php');
require_once('navbar.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/uscite.html');
$navBar = navbar('Calendario uscite');


$replacements = array(
    'pageTitle' => 'Calendario uscite - Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => 'Calendario uscite',
    'navBar' => $navBar,
    'pageContent' => $pageContent
);


echo Utils::bind_to_template($replacements, $template);
?>
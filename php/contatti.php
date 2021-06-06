<?php
require_once('utils.php');
require_once('navbar.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/contatti.html');
$navBar = navbar('Contatti');


$replacements = array(
    'pageTitle' => 'Contatti - Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => 'Contatti',
    'navBar' => $navBar,
    'pageContent' => $pageContent
);


echo Utils::bind_to_template($replacements, $template);
?>
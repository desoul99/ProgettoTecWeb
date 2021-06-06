<?php
require_once('utils.php');
require_once('navbar.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/recensioni.html');
$navBar = navbar('Recensioni');


$replacements = array(
    'pageTitle' => 'Recensioni - Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => 'Recensioni',
    'navBar' => $navBar,
    'pageContent' => $pageContent
);


echo Utils::bind_to_template($replacements, $template);
?>
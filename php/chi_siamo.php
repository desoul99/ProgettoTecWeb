<?php
require_once('utils.php');
require_once('navbar.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/chi_siamo.html');
$navBar = navbar('Chi siamo');


$replacements = array(
    'pageTitle' => 'Chi siamo - Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => 'Chi siamo',
    'navBar' => $navBar,
    'pageContent' => $pageContent
);


echo Utils::bind_to_template($replacements, $template);
?>
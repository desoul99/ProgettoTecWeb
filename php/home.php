<?php
require_once('utils.php');
require_once('navbar.php');

$template = file_get_contents('../html/template.html');
$pageContent = file_get_contents('../html/home.html');
$navBar = navbar('Home');


$replacements = array(
    'pageTitle' => 'Orient Review',
    'metaTitle' => 'Placeholder',
    'metaDescription' => 'Placeholder',
    'metaKeywords' => 'Placeholder',
    'metaAuthors' => 'Placeholder',
    'breadcrumb' => '<span xml:lang="en">Home</span>',
    'navBar' => $navBar,
    'pageContent' => $pageContent
);


echo Utils::bind_to_template($replacements, $template);
?>
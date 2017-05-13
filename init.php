<?php

define('ROOT', __DIR__);
$recompile = true;

// Composer Autoloader
require_once 'vendor/autoload.php';

for ($i = 1; $i <= 70000; $i++) {
    $data[$i] = new stdClass();
    $data[$i]->title = $i;
    $data[$i]->description = $i;
    $data[$i]->date_created = new \DateTime;
}

// Set up twig
$twig = new \Twig_Environment(new \Twig_Loader_Filesystem('twig_t'), ['cache' => 'twig_c', 'auto_reload' => $recompile]);

// Set up smarty
$smarty = new \Smarty();
$smarty->setTemplateDir(ROOT.'/smarty_t');
$smarty->setCompileDir(ROOT.'/smarty_c');
$smarty->force_compile = $recompile;

// TEST
$ttime = microtime(true);
$twig->render('blog.html.twig', ['data' => $data]);
$ttime = microtime(true) - $ttime;

$stime = microtime(true);
$smarty->assign('data', $data);
$smarty->fetch('blog.tpl');
$stime = microtime(true) - $stime;

echo "Twig:   ".number_format($ttime,4)."ms \n";
echo "Smarty: ".number_format($stime,4)."ms \n";

<?php /* Smarty version Smarty-3.0.6, created on 2012-05-07 20:05:42
         compiled from "/home/hron/Projects/s3browser/public_html/share/views/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6755701104fa70eb3739c37-90944053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c63589e83059d6c5819257ccaadb47b8ddf4a1a5' => 
    array (
      0 => '/home/hron/Projects/s3browser/public_html/share/views/index.tpl',
      1 => 1336348193,
      2 => 'file',
    ),
    '7a605a7c56c0bddf25a6e55adc47aae5ec18f6ad' => 
    array (
      0 => '/home/hron/Projects/s3browser/public_html/share/views/layout.tpl',
      1 => 1336413941,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6755701104fa70eb3739c37-90944053',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_javascript_include_tag')) include '/home/hron/Projects/s3browser/public_html/share/helpers/function.javascript_include_tag.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Kezdőlap &mdash; <?php echo $_smarty_tpl->getVariable('app_title')->value;?>
</title>
        <!--link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('request')->value->webroot;?>
assets/stylesheets/blueprint/reset.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('request')->value->webroot;?>
assets/stylesheets/blueprint/typography.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('request')->value->webroot;?>
assets/stylesheets/blueprint/forms.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('request')->value->webroot;?>
assets/stylesheets/blueprint/grid.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('request')->value->webroot;?>
assets/stylesheets/blueprint/print.css" media="print" /-->
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('request')->value->webroot;?>
assets/scripts/libs/extjs/resources/css/ext-all.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('request')->value->webroot;?>
assets/stylesheets/application.css" />
        <?php echo smarty_function_javascript_include_tag(array('src'=>"assets/scripts/libs/extjs/ext-all-debug.js"),$_smarty_tpl);?>

        <?php echo smarty_function_javascript_include_tag(array('src'=>"assets/scripts/app.js"),$_smarty_tpl);?>

    
    </head>
  <!--body class="two-col"-->
  <body>
    <script type="text/javascript">
    </script>
  </body>
</html>
<!--
vim: ts=2 sw=2 et
-->

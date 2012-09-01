<?php /* Smarty version Smarty-3.0.6, created on 2012-05-07 01:52:19
         compiled from "/home/hron/Projects/s3browser/public_html/share/views/widgets/topnav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15946274574fa70eb3b1d456-45358233%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d1515acde03852b6c29f2407d2ca6a3552f8b26' => 
    array (
      0 => '/home/hron/Projects/s3browser/public_html/share/views/widgets/topnav.tpl',
      1 => 1336348193,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15946274574fa70eb3b1d456-45358233',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_menu')) include '/home/hron/Projects/s3browser/public_html/share/helpers/block.menu.php';
if (!is_callable('smarty_block_menuitem')) include '/home/hron/Projects/s3browser/public_html/share/helpers/block.menuitem.php';
if (!is_callable('smarty_function_link')) include '/home/hron/Projects/s3browser/public_html/share/helpers/function.link.php';
?><div>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('menu', array('id'=>'nav')); $_block_repeat=true; smarty_block_menu(array('id'=>'nav'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('menuitem', array()); $_block_repeat=true; smarty_block_menuitem(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php echo smarty_function_link(array('target'=>"#",'title'=>"English"),$_smarty_tpl);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_menuitem(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('menuitem', array()); $_block_repeat=true; smarty_block_menuitem(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php echo smarty_function_link(array('target'=>"#",'title'=>"Kapcsolat"),$_smarty_tpl);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_menuitem(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('menuitem', array()); $_block_repeat=true; smarty_block_menuitem(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php echo smarty_function_link(array('target'=>"/",'title'=>"Cimoldal"),$_smarty_tpl);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_menuitem(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_menu(array('id'=>'nav'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</div>

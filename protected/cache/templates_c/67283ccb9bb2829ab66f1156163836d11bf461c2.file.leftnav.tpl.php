<?php /* Smarty version Smarty-3.0.6, created on 2012-05-07 01:52:19
         compiled from "/home/hron/Projects/s3browser/public_html/share/views/widgets/leftnav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13561628804fa70eb3c36a47-52718088%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67283ccb9bb2829ab66f1156163836d11bf461c2' => 
    array (
      0 => '/home/hron/Projects/s3browser/public_html/share/views/widgets/leftnav.tpl',
      1 => 1336348193,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13561628804fa70eb3c36a47-52718088',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_menu')) include '/home/hron/Projects/s3browser/public_html/share/helpers/block.menu.php';
if (!is_callable('smarty_block_menuitem')) include '/home/hron/Projects/s3browser/public_html/share/helpers/block.menuitem.php';
if (!is_callable('smarty_function_link')) include '/home/hron/Projects/s3browser/public_html/share/helpers/function.link.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('menu', array('class'=>'menu')); $_block_repeat=true; smarty_block_menu(array('class'=>'menu'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('menuitem', array()); $_block_repeat=true; smarty_block_menuitem(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php echo smarty_function_link(array('target'=>"#",'title'=>"Menu item 1"),$_smarty_tpl);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_menuitem(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('menuitem', array()); $_block_repeat=true; smarty_block_menuitem(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php echo smarty_function_link(array('target'=>"#",'title'=>"Menu item 2"),$_smarty_tpl);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_menuitem(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_menu(array('class'=>'menu'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


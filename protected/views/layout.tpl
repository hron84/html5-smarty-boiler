<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{block name=title}Kezdőlap{/block} &mdash; {$app_title}</title>
        <!--link rel="stylesheet" type="text/css" href="{$request->webroot}assets/stylesheets/blueprint/reset.css" / -->
        <!--link rel="stylesheet" type="text/css" href="{$request->webroot}assets/stylesheets/blueprint/typography.css" / -->
        <!--link rel="stylesheet" type="text/css" href="{$request->webroot}assets/stylesheets/blueprint/forms.css" / -->
        <!--link rel="stylesheet" type="text/css" href="{$request->webroot}assets/stylesheets/blueprint/grid.css" / -->
        <!--link rel="stylesheet" type="text/css" href="{$request->webroot}assets/stylesheets/blueprint/print.css" media="print" /-->
        <link rel="stylesheet" type="text/css" href="http://cdn.sencha.io/ext-4.1.0-gpl/resources/css/ext-all.css" />
        <link rel="stylesheet" type="text/css" href="{$request->webroot}assets/stylesheets/application.css" />
        {block name=stylesheets}{/block}
        {javascript_include_tag src="assets/scripts/libs/extjs/ext-all-debug.js"}
        {javascript_include_tag src="assets/scripts/app.js"}
        {block name=scripts}{/block}
    
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

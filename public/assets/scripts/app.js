Ext.Loader.setConfig({
    enabled: true
});

Ext.QuickTips.init();

Ext.application({
    name: 'UserManager',
    appFolder: '/assets/scripts/app',

    controllers: ['Users'],

    launch: function () {
        Ext.create('Ext.container.Viewport', {
            layout: 'fit',
            items: [
                {
                    xtype: 'userlist'
                }
            ]
        });
    }
});


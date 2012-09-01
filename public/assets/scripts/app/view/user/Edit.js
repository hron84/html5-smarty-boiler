Ext.define('UserManager.view.user.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.useredit',
    
    title: 'Edit user',
    
    layout: 'fit',
    autoShow: true,

    initComponent: function () {
        this.items = [
            {
                xtype: 'form',
                items: [
                    {
                        xtype: 'textfield',
                        name: 'name',
                        fieldLabel: 'Name'
                    },
                    {
                        xtype: 'textfield',
                        name: 'login',
                        fieldLabel: 'Nick'
                    },
                    {
                        xtype: 'textfield',
                        name: 'password',
                        fieldLabel: 'Password',
                        inputType: 'password'
                    },
                    {
                        xtype: 'textfield',
                        name: 'password_confirmation',
                        fieldLabel: 'Password confirmation',
                        inputType: 'password'
                    }
                ]
            }
        ];

        this.buttons = [
            {
                text: 'Save',
                action: 'save'
            },
            {
                text: 'Cancel',
                scope: this,
                handler: this.close
            }
        ];

        this.callParent(arguments);
    }
});

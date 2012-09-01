Ext.define('UserManager.controller.Users', {
    extend: 'Ext.app.Controller',
    stores: ['Users'],
    //models: ['User'],
    
    views: ['user.List', 'user.Edit'],
    init: function () {
        this.control({
            'userlist': {
                itemdblclick: this.editUser
            },
            'useredit button[action=save]': {
                click: this.updateUser
            }
        });
    },

    onPanelRendered: function () {
        console.log('Panel is here!');
    },

    editUser: function (grid, record) {
        var view = Ext.widget('useredit'),
            form = view.down('form');
        form.loadRecord(record);

        form.getForm().findField('password').setValue('');
        form.getForm().findField('password_confirmation').setValue('');

        //console.log('Double clicked on ' + record.get('name'));
    },

    updateUser: function (button) {
        var win     = button.up('window'),
            form    = win.down('form'),
            record  = form.getRecord(),
            values  = form.getValues();

        //console.log('Save button was clicked');
        //console.log({record: record, values: values});

        record.set(values);
        win.close();
        this.getUsersStore().sync();
    }
});

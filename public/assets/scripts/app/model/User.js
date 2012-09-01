Ext.define('UserManager.model.User', {
    extend: 'Ext.data.Model',
    fields: ['id', 'name', 'login', 'password', 'password_confirmation']
});

Ext.define('UserManager.store.Users', {
    extend: 'Ext.data.Store',
    model: 'UserManager.model.User',
    autoLoad: true,

    proxy: {
        type: 'ajax',
        api: {
            read: '/index.php/users/listAll',
            update: '/index.php/users/update',
            create: '/index.php/users/debug',
            destroy: '/index.php/users/debug'
        },
        reader: {
            type: 'json',
            root: 'users',
            successProperty: 'success',
            idProperty: 'id'
            
        }
    }
});

Ext.define('UserManager.view.user.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.userlist',
    
    title: 'All users',
    store: 'Users',

    initComponent: function () {
        //this.store = {
        //    fields: ['id', 'name', 'login'],
        //    data: [
        //        {id: 1, name: 'Gabor Garami', login: 'hron84'},
        //        {id: 2, name: 'Katalin Nemes', login: 'cathlen'}
        //    ]
        //};

        this.columns = [
            {header: 'ID', dataIndex: 'id', flex: 1},
            {header: 'Name', dataIndex: 'name', flex: 1},
            {header: 'Nick', dataIndex: 'login', flex: 1}
        ];
        
        this.callParent(arguments);
    }
});

const Welcome = () => import('./components/Welcome.vue')

const JobInvoiceList = () => import('./components/jobinvoice/list.vue')
const GroupList = () => import('./components/group/list.vue')
const GroupCreate = () => import('./components/group/add.vue')
const GroupEdit = () => import('./components/group/edit.vue')
const GroupNotification =() => import('./components/groupnotification/list.vue')
const GroupNotificationEdit =() => import('./components/groupnotification/edit.vue')


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'groupList',
        path: '/group',
        component: GroupList
    },
    {
        name: 'groupEdit',
        path: '/group/:id/edit',
        component: GroupEdit
    },
    {
        name: 'groupAdd',
        path: '/group/add',
        component: GroupCreate
    },
      {
        name: 'jobInvoiceList',
        path: '/jobinvoice',
        component: JobInvoiceList
    },
    {
        name: 'groupNotification',
        path: '/groupnotification',
        component: GroupNotification
    },
    {
        name: 'groupnotificationEdit',
        path: '/groupnotification/:id/edit',
        component: GroupNotificationEdit
    },
]
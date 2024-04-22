import guest from './middleware/guest';
import auth from './middleware/auth';

export default [
    // -------- Guest user ---------- //
    {
        path: '/',
        component: () => import('@/src/layouts/Guest.vue'),
        meta: {
            middleware: [
                guest
            ]
        },
        children: [
            {
                path: '/login',
                name: 'Login',
                component: () => import('@pages/auth/Login.vue'),
                meta: {
                    middleware: [
                        guest
                    ]
                }
            },
            // {
            //     path: 'register',
            //     name: 'Register',
            //     component: ,
            // },
            // {
            //     path: 'forgot-password',
            //     name: 'ForgotPassword',
            //     component: ,
            // },
            // {
            //     path: 'reset-password',
            //     name: 'ResetPassword',
            //     component: ,
            // },
        ]
    },

    // --------  Admin user --------- //
    {
        path: '/',
        component: () => import('@/src/layouts/Authenticated.vue'),
        children: [
            {
                path: '/dashboard',
                name: 'Dashboard',
                component: () => import('@pages/admin/Dashboard.vue'),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
            {
                path: '/utilisateurs',
                name: 'Users',
                component: () => import('@/src/pages/admin/users/UsersList.vue'),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
            {
                path: '/roles',
                name: 'Roles',
                component: () => import('@/src/pages/admin/roles/RoleList.vue'),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
            {
                path: '/banques',
                name: 'Banques',
                component: () => import('@/src/pages/admin/bankAccount/BankAccountList.vue'),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
            {
                path: '/company',
                name: 'Company',
                component: () => import('@/src/pages/admin/company/CompanyProfile.vue'),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
        ]
    },

    // --------  404 page --------- //
    {
        path: "/:pathMatch(.*)*",
        name: 'NotFound',
        component: () => import('@pages/errors/404.vue'),
    },
];

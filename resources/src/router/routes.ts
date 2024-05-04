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
                path: '/administrations',
                name: 'Administration',
                component: () => import('@/src/pages/admin/administration/Index.vue'),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
            {
                path: '/traçabilité',
                name: 'traçabilité',
                component: () => import('@/src/pages/admin/tracability/ListLogs.vue'),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
            {
                path: '/fournisseurs',
                name: 'fournisseurs',
                component: () => import('@/src/pages/supplier/ListSupplier.vue'),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
            {
                path: 'articles/categorie',
                name: 'articleCategories',
                component: () => import('@/src/pages/articles/category/ListCategory.vue'),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
            {
                path: 'articles/depots',
                name: 'depots',
                component: () => import('@/src/pages/articles/depot/ListDepot.vue'),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
            {
                path: 'articles/marques',
                name: 'marque',
                component: () => import('@/src/pages/articles/brand/ListBrand.vue'),
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

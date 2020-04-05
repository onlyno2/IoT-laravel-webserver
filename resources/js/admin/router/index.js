import Vue from 'vue'
import Router from 'vue-router'

// Containers
const TheContainer = () => import('@/admin/containers/TheContainer')

// Views
const Dashboard = () => import('@/admin/views/Dashboard')

const Colors = () => import('@/admin/views/theme/Colors')
const Typography = () => import('@/admin/views/theme/Typography')

const Charts = () => import('@/admin/views/charts/Charts')
const Widgets = () => import('@/admin/views/widgets/Widgets')

// Views - Components
const Cards = () => import('@/admin/views/base/Cards')
const Forms = () => import('@/admin/views/base/Forms')
const Switches = () => import('@/admin/views/base/Switches')
const Tables = () => import('@/admin/views/base/Tables')
const Tabs = () => import('@/admin/views/base/Tabs')
const Breadcrumbs = () => import('@/admin/views/base/Breadcrumbs')
const Carousels = () => import('@/admin/views/base/Carousels')
const Collapses = () => import('@/admin/views/base/Collapses')
const Jumbotrons = () => import('@/admin/views/base/Jumbotrons')
const ListGroups = () => import('@/admin/views/base/ListGroups')
const Navs = () => import('@/admin/views/base/Navs')
const Navbars = () => import('@/admin/views/base/Navbars')
const Paginations = () => import('@/admin/views/base/Paginations')
const Popovers = () => import('@/admin/views/base/Popovers')
const ProgressBars = () => import('@/admin/views/base/ProgressBars')
const Tooltips = () => import('@/admin/views/base/Tooltips')

// Views - Buttons
const StandardButtons = () => import('@/admin/views/buttons/StandardButtons')
const ButtonGroups = () => import('@/admin/views/buttons/ButtonGroups')
const Dropdowns = () => import('@/admin/views/buttons/Dropdowns')
const BrandButtons = () => import('@/admin/views/buttons/BrandButtons')

// Views - Icons
const CoreUIIcons = () => import('@/admin/views/icons/CoreUIIcons')
const Brands = () => import('@/admin/views/icons/Brands')
const Flags = () => import('@/admin/views/icons/Flags')

// Views - Notifications
const Alerts = () => import('@/admin/views/notifications/Alerts')
const Badges = () => import('@/admin/views/notifications/Badges')
const Modals = () => import('@/admin/views/notifications/Modals')

// Views - Pages
const Page404 = () => import('@/admin/views/pages/Page404')
const Page500 = () => import('@/admin/views/pages/Page500')
const Login = () => import('@/admin/views/pages/Login')
const Register = () => import('@/admin/views/pages/Register')

// Users
const Users = () => import('@/admin/views/users/Users')
const User = () => import('@/admin/views/users/User')

Vue.use(Router)

export default new Router({
  mode: 'hash', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})

function configRoutes () {
  return [
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: TheContainer,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'theme',
          redirect: '/theme/colors',
          name: 'Theme',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'colors',
              name: 'Colors',
              component: Colors
            },
            {
              path: 'typography',
              name: 'Typography',
              component: Typography
            }
          ]
        },
        {
          path: 'charts',
          name: 'Charts',
          component: Charts
        },
        {
          path: 'widgets',
          name: 'Widgets',
          component: Widgets
        },
        {
          path: 'users',
          meta: {
            label: 'Users'
          },
          component: {
            render(c) {
              return c('router-view')
            }
          },
          children: [
            {
              path: '',
              name: 'Users',
              component: Users
            },
            {
              path: ':id',
              meta: {
                label: 'User Details'
              },
              name: 'User',
              component: User
            }
          ]
        },
        {
          path: 'base',
          redirect: '/base/cards',
          name: 'Base',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'cards',
              name: 'Cards',
              component: Cards
            },
            {
              path: 'forms',
              name: 'Forms',
              component: Forms
            },
            {
              path: 'switches',
              name: 'Switches',
              component: Switches
            },
            {
              path: 'tables',
              name: 'Tables',
              component: Tables
            },
            {
              path: 'tabs',
              name: 'Tabs',
              component: Tabs
            },
            {
              path: 'breadcrumbs',
              name: 'Breadcrumbs',
              component: Breadcrumbs
            },
            {
              path: 'carousels',
              name: 'Carousels',
              component: Carousels
            },
            {
              path: 'collapses',
              name: 'Collapses',
              component: Collapses
            },
            {
              path: 'jumbotrons',
              name: 'Jumbotrons',
              component: Jumbotrons
            },
            {
              path: 'list-groups',
              name: 'List Groups',
              component: ListGroups
            },
            {
              path: 'navs',
              name: 'Navs',
              component: Navs
            },
            {
              path: 'navbars',
              name: 'Navbars',
              component: Navbars
            },
            {
              path: 'paginations',
              name: 'Paginations',
              component: Paginations
            },
            {
              path: 'popovers',
              name: 'Popovers',
              component: Popovers
            },
            {
              path: 'progress-bars',
              name: 'Progress Bars',
              component: ProgressBars
            },
            {
              path: 'tooltips',
              name: 'Tooltips',
              component: Tooltips
            }
          ]
        },
        {
          path: 'buttons',
          redirect: '/buttons/standard-buttons',
          name: 'Buttons',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'standard-buttons',
              name: 'Standard Buttons',
              component: StandardButtons
            },
            {
              path: 'button-groups',
              name: 'Button Groups',
              component: ButtonGroups
            },
            {
              path: 'dropdowns',
              name: 'Dropdowns',
              component: Dropdowns
            },
            {
              path: 'brand-buttons',
              name: 'Brand Buttons',
              component: BrandButtons
            }
          ]
        },
        {
          path: 'icons',
          redirect: '/icons/coreui-icons',
          name: 'CoreUI Icons',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'coreui-icons',
              name: 'Icons library',
              component: CoreUIIcons
            },
            {
              path: 'brands',
              name: 'Brands',
              component: Brands
            },
            {
              path: 'flags',
              name: 'Flags',
              component: Flags
            }
          ]
        },
        {
          path: 'notifications',
          redirect: '/notifications/alerts',
          name: 'Notifications',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'alerts',
              name: 'Alerts',
              component: Alerts
            },
            {
              path: 'badges',
              name: 'Badges',
              component: Badges
            },
            {
              path: 'modals',
              name: 'Modals',
              component: Modals
            }
          ]
        }
      ]
    },
    {
      path: '/pages',
      redirect: '/pages/404',
      name: 'Pages',
      component: {
        render (c) { return c('router-view') }
      },
      children: [
        {
          path: '404',
          name: 'Page404',
          component: Page404
        },
        {
          path: '500',
          name: 'Page500',
          component: Page500
        },
        {
          path: 'login',
          name: 'Login',
          component: Login
        },
        {
          path: 'register',
          name: 'Register',
          component: Register
        }
      ]
    }
  ]
}


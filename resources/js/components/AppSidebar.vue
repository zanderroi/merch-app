<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import type { PageProps as InertiaPageProps } from '@inertiajs/core'
import { BookOpen, Folder, LayoutGrid, User2, Store, FileArchive, UserCog } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

interface CustomPageProps extends InertiaPageProps {
  auth: {
    user: any
    roles: string[]
    permissions: string[]
  }
}


const page = usePage<CustomPageProps>()
const userRoles = page.props.auth?.roles || []
const userPermissions = page.props.auth?.permissions || []

console.log('Auth roles:', page.props.auth?.roles)
console.log('Permissions:', page.props.auth?.permissions)
const adminNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'User Management',
        href: '/user-management',
        icon: UserCog,
    },
    {
        title: 'Employees',
        href: '/employees',
        icon: User2,
    },
    {
        title: 'Stores',
        href: '/stores',
        icon: Store,
    },
    {
        title: 'Attendance Log',
        href: '/attendance-log',
        icon: FileArchive,
    }
];
const footerNavItems: NavItem[] = [
    {
        title: 'Documentation',
        href: 'https://merch-app.com/docs',
        icon: BookOpen,
    },
    {
        title: 'Support',
        href: 'https://merch-app.com/support',
        icon: Folder,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <p v-if="userRoles.includes('admin')">
                You are admin
              </p>
                    <SidebarMenuButton size="lg" as-child>             
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>

                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain v-if="userRoles.includes('admin')" :items="adminNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>

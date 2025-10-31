<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { 
    dashboard,
    Activos,

} from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import {
    BookMarked, 
    LayoutGrid,
    CircuitBoard,
    ClipboardList,
    Atom,
    Armchair,
    Server,
} from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Activos',
        href: Activos(),
        icon: ClipboardList,
    },
    {
        title: 'Componentes',
        href: '',
        icon: Atom,
    },
    {
        title: 'Equipos de red',
        href: '',
        icon: CircuitBoard,
    },
    {
        title: 'Inmuebles',
        href: '',
        icon: Armchair,
    },
    {
        title: 'Servidores',
        href: '',
        icon: Server,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'UPETEC-MS',
        href: 'https://www.instagram.com/uptecms_dgc/?hl=es',
        icon: BookMarked,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>

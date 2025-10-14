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

} from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { 
    BookOpen, 
    BookMarked, 
    LayoutGrid, 
    TextCursorInput,
    ClipboardList,
    ScanLine,
    ChartNoAxesCombined,
} from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Ejemplo',
        href: '',
        icon: TextCursorInput,
    },
    {
        title: 'Ejemplo',
        href: '',
        icon: ClipboardList,
    },
    {
        title: 'Ejemplo',
        href: '',
        icon: ChartNoAxesCombined,
    },
    {
        title: 'Ejemplo',
        href: '',
        icon: ScanLine,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'UPETEC-MS',
        href: 'https://www.instagram.com/uptecms_dgc/?hl=es',
        icon: BookMarked,
    },
    {
        title: 'Documentacion',
        href: '',
        icon: BookOpen,
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

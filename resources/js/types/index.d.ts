import { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface Activo {
    id: number;
    codigo: string | null;
    name: string;
    serial?: string | null;
    marca: string;
    modelo: string;
    color?: string | null;
    estado: string;
    empleado: number;
    ubicacion: string;
    categoria_id: number;
    subcategoria_id: number;
    sub_subcategoria_id: number;
}

export interface Empleado {
    id: number;
    cedula?: string;
    name: string;
    surname?: string | null;
    email?: string | null;
    phone?: string | null;
}

export interface Ubicacion {
    id: number;
    name: string;
}
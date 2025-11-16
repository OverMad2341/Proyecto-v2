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
    serial?: string | null;
    marca: string;
    modelo: string;
    color?: string | null;
    estado: string;
    empleado: Empleado | null;
    ubicacion: Ubicacion;
    categoria: Categoria;
    subcategoria_id: SubCategoria;
    subsubcategoria_id: SubSubCategoria;
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

export interface Categoria {
    id: number;
    name: string;
}

export interface SubCategoria {
    id: number;
    name: string;
    categoria_id: number;
}

export interface SubSubCategoria {
    id: number;
    name: string;
    subcategoria_id: number;
}
import { Routes } from '@angular/router';
import { EmpresasComponent } from './empresas/empresas.component';
import { SociosComponent } from './socios/socios.component';

export const routes: Routes = [
    { path: '', redirectTo: 'empresas', pathMatch: 'full' },
    { path: 'empresas', component: EmpresasComponent },
    { path: 'socios', component: SociosComponent },
];

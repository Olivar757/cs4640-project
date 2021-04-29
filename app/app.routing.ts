import { Routes, RouterModule } from '@angular/router';

import { XyzComponent } from './xyz/xyz.component';

const routes: Routes = [
    { path: '', component: XyzComponent },

    // otherwise redirect to home
    { path: '**', redirectTo: '' }
];

export const appRoutingModule = RouterModule.forRoot(routes);
import { Routes, RouterModule } from '@angular/router';
import { AppComponent } from './app.component';


const routes: Routes = [
    {path: '', component: AppComponent},

    // otherwise redirect to home
    { path: '**', redirectTo: '' }
];

export const appRoutingModule = RouterModule.forRoot(routes);
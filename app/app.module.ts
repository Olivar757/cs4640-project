import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { HttpClientModule } from '@angular/common/http'; 

import { FormsModule } from '@angular/forms';

import { appRoutingModule } from './app.routing';
import { AppComponent } from './app.component';



@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule, 
    FormsModule,
    HttpClientModule,
    appRoutingModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

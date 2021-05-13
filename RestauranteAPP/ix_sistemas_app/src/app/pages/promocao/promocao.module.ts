import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { PromocaoPageRoutingModule } from './promocao-routing.module';

import { PromocaoPage } from './promocao.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    PromocaoPageRoutingModule
  ],
  declarations: [PromocaoPage]
})
export class PromocaoPageModule {}

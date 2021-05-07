import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { PromocaoPage } from './promocao.page';

const routes: Routes = [
  {
    path: '',
    component: PromocaoPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PromocaoPageRoutingModule {}

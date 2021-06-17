import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
 
export interface Product {
  id: number;
  name: string;
  price: number;
  amount: number;
}
@Injectable({
  providedIn: 'root'
})
export class CartService {
  data: Product[] = [
    { id: 0, name: 'X Tudo', price: 25, amount: 0 },
    { id: 1, name: 'X Salada', price: 15, amount: 0 },
    { id: 2, name: 'X Bacon', price: 20, amount: 0 },
    { id: 3, name: 'X Burguer', price: 12, amount: 0 },
    { id: 4, name: 'Porção de Fritas', price: 12, amount: 0 },
    { id: 5, name: 'Coca 2L', price: 10, amount: 0 },
    { id: 6, name: 'Coca 350mL', price: 6, amount: 0 },
    { id: 7, name: 'Coca 600mL', price: 8, amount: 0 },
    { id: 8, name: 'Suco de Laranja 500mL', price: 6, amount: 0 },
    { id: 9, name: 'Agua sem gás 500mL', price: 4, amount: 0 },
    { id: 10, name: 'Agua com gás 500mL', price: 5, amount: 0 }
    
    
  ];
 
  private cart = [];
  private cartItemCount = new BehaviorSubject(0);
 
  constructor() {}
 
  getProducts() {
    return this.data;
  }
 
  getCart() {
    return this.cart;
  }
 
  getCartItemCount() {
    return this.cartItemCount;
  }
 
  addProduct(product) {
    let added = false;
    for (let p of this.cart) {
      if (p.id === product.id) {
        p.amount += 1;
        added = true;
        break;
      }
    }
    if (!added) {
      product.amount = 1;
      this.cart.push(product);
    }
    this.cartItemCount.next(this.cartItemCount.value + 1);
  }
 
  decreaseProduct(product) {
    for (let [index, p] of this.cart.entries()) {
      if (p.id === product.id) {
        p.amount -= 1;
        if (p.amount == 0) {
          this.cart.splice(index, 1);
        }
      }
    }
    this.cartItemCount.next(this.cartItemCount.value - 1);
  }
 
  removeProduct(product) {
    for (let [index, p] of this.cart.entries()) {
      if (p.id === product.id) {
        this.cartItemCount.next(this.cartItemCount.value - p.amount);
        this.cart.splice(index, 1);
      }
    }
  }
}

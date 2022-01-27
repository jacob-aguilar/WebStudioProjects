import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { LoginService } from '../services/login.service';

@Injectable({
  providedIn: 'root'
})
export class AuthAdministradorGuard implements CanActivate {

  constructor(private router: Router) { }


  canActivate() {

    if(localStorage.getItem("rol") == "Administrador" || localStorage.getItem("rol") == "Medico"){

      return true

    }else {

      this.router.navigate(['/']);
      return false

    }



  }



}



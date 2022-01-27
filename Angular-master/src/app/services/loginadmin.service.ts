import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Administrador } from '../interfaces/administrador';

@Injectable({
  providedIn: 'root'
})
export class LoginadminService {
  datosAdministrador: any;
  idActualizar: number;
  //API_ENDPOINT = 'http://64.225.37.202:8081/api';
  API_ENDPOINT = 'http://127.0.0.1:8000/api'

  headers = new HttpHeaders({ 'Content-Type': 'application/json' });


  constructor(private httpClient: HttpClient, LoginAdminService: LoginadminService) { }

  obtenerAdministradores() {

    return this.httpClient.get(this.API_ENDPOINT + '/administradores');

  }


  guardarAdministrador(administrador: Administrador) {
    return this.httpClient.post(this.API_ENDPOINT + '/administradores', administrador, { headers: this.headers });
  }

  actualizarAdministrador(administrador: Administrador) {
    
    return this.httpClient.put(this.API_ENDPOINT + '/administradores/' + administrador.id_administrador, administrador, { headers: this.headers });
  }
  
  delete(id) {
    return this.httpClient.delete(this.API_ENDPOINT + '/administradores/' + id);
  }

  obtenerColumnaUsuarioAdmin(usuario) {
    return this.httpClient.get(this.API_ENDPOINT + '/obtenerColumnaUsuarioAdmin/' + usuario);
  }

  obtenerAdministrador(id){

    return this.httpClient.get(this.API_ENDPOINT + '/obtenerAdministrador/' + id);
    
  }

}

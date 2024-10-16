import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class EmpresaService {

  private apiUrl = `${environment.apiUrl}/empresa`;

  constructor(private http: HttpClient) { }

  getEmpresas(): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/`);
  }

  getEmpresa(id: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/${id}`);
  }

  createEmpresa(empresa: any): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/new`, empresa);
  }

  updateEmpresa(id: number, empresa: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}/edit`, empresa);
  }

  deleteEmpresa(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }
}

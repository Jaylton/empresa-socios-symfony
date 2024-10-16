import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class SocioService {

  private apiUrl = `${environment.apiUrl}/socio`;

  constructor(private http: HttpClient) { }

  getSocios(): Observable<any> {
    return this.http.get<any>(this.apiUrl);
  }

  getSocio(id: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/${id}`);
  }

  createSocio(socio: any): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/new`, socio);
  }

  updateSocio(id: number, socio: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}/edit`, socio);
  }

  deleteSocio(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }
}

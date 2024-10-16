import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { SocioService } from '../../services/socio.service';
import { CommonModule } from '@angular/common';
import { EmpresaService } from '../../services/empresa.service';

@Component({
  selector: 'app-socios',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './socios.component.html',
  styleUrl: './socios.component.scss'
})
export class SociosComponent implements OnInit {
  socios: any[] = [];
  empresas: any[] = [];
  socio: any = { nome: '', cpf: '', empresa: null };
  isEditing = false;

  constructor(private socioService: SocioService, private empresaService: EmpresaService) { }

  ngOnInit(): void {
    this.loadSocios();
    this.loadEmpresas();
  }

  loadSocios(): void {
    this.socioService.getSocios().subscribe((data: any) => {
      this.socios = data;
    });
  }

  loadEmpresas(): void {
    this.empresaService.getEmpresas().subscribe((data: any) => {
      this.empresas = data;
    });
  }

  createSocio(): void {
    this.socioService.createSocio(this.socio).subscribe(() => {
      this.loadSocios();
      this.resetForm();
    });
  }

  editSocio(socio: any): void {
    this.socio = { ...socio, empresa: socio.empresa.id };
    this.isEditing = true;
  }

  updateSocio(): void {
    this.socioService.updateSocio(this.socio.id, this.socio).subscribe(() => {
      this.loadSocios();
      this.resetForm();
      this.isEditing = false;
    });
  }

  deleteSocio(id: number): void {
    this.socioService.deleteSocio(id).subscribe(() => {
      this.loadSocios();
    });
  }

  resetForm(): void {
    this.socio = { nome: '', cpf: '', empresa: null };
    this.isEditing = false;
  }
}


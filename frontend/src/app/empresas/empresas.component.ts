import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { EmpresaService } from '../../services/empresa.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-empresas',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './empresas.component.html',
  styleUrls: ['./empresas.component.scss']
})
export class EmpresasComponent implements OnInit {
  empresas: any[] = [];
  empresa: any = { nome: '', cnpj: '' };
  isEditing = false;

  constructor(private empresaService: EmpresaService) { }

  ngOnInit(): void {
    this.loadEmpresas();
  }

  loadEmpresas(): void {
    this.empresaService.getEmpresas().subscribe((data: any) => {
      this.empresas = data;
    });
  }

  createEmpresa(): void {
    this.empresaService.createEmpresa(this.empresa).subscribe(() => {
      this.loadEmpresas();
      this.resetForm();
    });
  }

  editEmpresa(empresa: any): void {
    this.empresa = { ...empresa };
    this.isEditing = true;
  }

  updateEmpresa(): void {
    this.empresaService.updateEmpresa(this.empresa.id, this.empresa).subscribe(() => {
      this.loadEmpresas();
      this.resetForm();
      this.isEditing = false;
    });
  }

  deleteEmpresa(id: number): void {
    this.empresaService.deleteEmpresa(id).subscribe(() => {
      this.loadEmpresas();
    });
  }

  resetForm(): void {
    this.empresa = { nome: '', cnpj: '' };
    this.isEditing = false;
  }
}


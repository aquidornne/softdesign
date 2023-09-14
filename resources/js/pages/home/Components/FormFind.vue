<template>
  <div>
    <div class="row mb-4">
      <div class="col">
        <div class="card">
          <div class="card-header">
              <div class="row">
                  <div class="col-12">
                      <h4 class="h4">Filtrar</h4>
                  </div>
              </div>
          </div>
          <div class="card-body py-4">
              <div class="row">
                  <div class="col-12 col-md-3 mb-3">
                      <div class="form-group">
                          <label>Título</label>
                          <b-form-input
                              type="text" 
                              class="form-control" 
                              placeholder="Título" 
                              maxlength="255"
                              v-model.trim="dataFormFind.titulo">
                          </b-form-input>
                      </div>
                  </div>
                  <div class="col-12 col-md-3 mb-3">
                      <div class="form-group">
                          <label>Descrição</label>
                          <b-form-input
                              type="text" 
                              class="form-control" 
                              placeholder="Descrição" 
                              maxlength="255"
                              v-model.trim="dataFormFind.descricao">
                          </b-form-input>
                      </div>
                  </div>
                  <div class="col-12 col-md-3 mb-3">
                      <div class="form-group">
                          <label>Autor</label>
                          <b-form-input
                              type="text" 
                              class="form-control" 
                              placeholder="Autor" 
                              maxlength="255"
                              v-model.trim="dataFormFind.autor">
                          </b-form-input>
                      </div>
                  </div>
                  <div class="col-12 col-md-3 mb-3">
                      <div class="form-group">
                          <label>Número de Páginas</label>
                          <b-form-input
                              type="text" 
                              class="form-control" 
                              placeholder="Número de Páginas" 
                              v-mask="'####'"
                              v-model.trim="dataFormFind.numero_de_paginas">
                          </b-form-input>
                      </div>
                  </div>
              </div>
          </div>
          <div class="card-footer text-right">
              <b-button size="sm" variant="info" @click="submit()">
                Buscar
              </b-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
      dataFormFind: {
          type: Object,
          required: true
      }
  },
  methods: {
    submit() {
      this.$emit('refreshIndex', this.dataFormFind)
    }
  }
};
</script>
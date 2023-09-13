<template>
    <div>
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <b-button v-b-tooltip.hover title="Novo" class="btn btn-info mr-1 mb-1"
                                        @click="">
                                        <i class="fa fa-plus"></i> Novo
                                    </b-button>
                                    <b-button v-b-tooltip.hover title="Alterar" class="btn btn-alert mr-1 mb-1"
                                        @click="">
                                        <i class="fa fa-pencil"></i> Alterar
                                    </b-button>
                                    <b-button v-b-tooltip.hover title="Excluir" class="btn btn-danger mr-1 mb-1"
                                        @click="">
                                        <i class="fa fa-trash"></i> Excluir
                                    </b-button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div v-if="list.length" class="table-responsive">
                                        <b-table
                                            id="livros"
                                            :fields="colunas" 
                                            :items="list" 
                                            :per-page="perPage"
                                            sticky-header 
                                            head-variant="dark" 
                                            striped 
                                            hover 
                                            :select-mode="selectMode" 
                                            @sort-changed="defineOrder" 
                                            :sort-by="order" 
                                            :sort-desc="typeOrder"
                                            style="max-height: 600px"
                                        >
                                        </b-table>
                                    </div>
                                    <div v-else>
                                        <p>Nenhum registro encontrado.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div v-if="list.length" class="row">
                                <div class="col-12">
                                    <b-pagination
                                        v-model="currentPage" 
                                        :total-rows="total" 
                                        :per-page="perPage" 
                                        aria-controls="livros"
                                        @change="index">
                                    </b-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex';

import api from '@/api/livro.api.js';

import Filter from './Components/Filter.vue';

import Util from '@/util.js';

export default {
    components: {
        Filter
    },
    data() {
        return {
            showFilter: false,
            filtro: {
                titulo: '',
                descricao: '',
                autor: '',
                numero_de_paginas: ''
            },
            colunas: [
                {
                    key: 'titulo',
                    label: 'Título',
                    sortable: true,
                },
                {
                    key: 'descricao',
                    label: 'Descrição',
                    sortable: true,
                },
                {
                    key: 'autor',
                    label: 'Autor',
                    sortable: true,
                },
                {
                    key: 'numero_de_paginas',
                    label: 'Número de Páginas',
                    sortable: true,
                },
                {
                    key: 'created_at',
                    label: 'Data de Criação',
                    sortable: true,
                    formatter: this.formateDateToUS
                }
            ],
            list: [],
            selectMode: 'single',
            currentPage: 0,
            total: 1,
            perPage: 10,
            order: 'created_at',
            typeOrder: false,
        };
    },
    mounted() {
        this.index(0)
    },
    methods: {
        ...mapActions('msgError', { showErrorMsg: 'showErrorMsg' }),
        ...mapActions('msgSuccess', { showSuccessMsg: 'showSuccessMsg' }),
        formateDateToUS(valor) {
            return Util.formateDateToUS(valor)
        },
        defineOrder(e) {
            this.order = e.sortBy
            this.typeOrder = e.sortDesc
            this.index(0)
            this.currentPage = 0
        },
        index(currentPage) {
            const pag = ((currentPage !== undefined ? currentPage : this.currentPage) - 1)

            const data = {
                offset: pag < 0 ? 0 : pag,
                limit: this.perPage,
                order: this.order,
                typeOrder: this.typeOrder ? 'DESC' : 'ASC',
                titulo: this.filtro.titulo,
                descricao: this.filtro.descricao,
                autor: this.filtro.autor,
                numero_de_paginas: this.filtro.numero_de_paginas
            }

            api.index(data).then(res => {
                this.list = res.data.data
                this.total = res.data.total
            })
        },
    }
};
</script>
<template>
    <div class="mb-5">
        <FormFind
            :dataFormFind="dataFormFind" 
            @refreshIndex="refreshIndex" 
        />

        <div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="h4">Livros</h4>
                                </div>
                                <div class="col-12 text-right">
                                    <b-button 
                                        v-b-tooltip.hover 
                                        title="Novo" 
                                        class="btn btn-info mr-1 mb-1"
                                        @click="openNew()"
                                    >
                                        <b-icon-plus-lg></b-icon-plus-lg> Novo
                                    </b-button>
                                    <b-button 
                                        v-b-tooltip.hover 
                                        title="Alterar" 
                                        class="btn btn-alert mr-1 mb-1"
                                        :disabled="selectedData.length === 0"
                                        @click="openUpdate()"
                                    >
                                        <b-icon-pencil></b-icon-pencil> Alterar
                                    </b-button>
                                    <b-button 
                                        v-b-tooltip.hover 
                                        title="Excluir" 
                                        class="btn btn-danger mr-1 mb-1"
                                        :disabled="selectedData.length === 0"
                                        @click="destroy()"
                                    >
                                        <b-icon-trash></b-icon-trash> Excluir
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
                                            striped 
                                            hover 
                                            selectable 
                                            :select-mode="selectMode" 
                                            @row-selected="setActiveItem" 
                                            @sort-changed="defineOrder" 
                                            :sort-by="order" 
                                            :sort-desc="typeOrder" 
                                            style="max-height: 600px"
                                        >
                                            <template #cell(selecionado)="{ rowSelected }">
                                                <template v-if="rowSelected">
                                                    <b-icon-check-lg class="text-success"></b-icon-check-lg>
                                                    <span class="sr-only">Selecionado</span>
                                                </template>
                                                <template v-else>
                                                    <span class="sr-only">Não selecionado</span>
                                                </template>
                                            </template>
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

        <Form 
            :modalShow="modalShow"
            :dataUpdate="dataUpdate"
            @update:modalShow="modalShow = $event"
            @refresh="refresh"
            :key="this.keyRefresh">
        </Form>
    </div>
</template>
<script>
import { mapActions } from 'vuex';

import api from '@/api/livro.api.js';

import FormFind from './Components/FormFind.vue';

import Form from './Components/Form.vue';

export default {
    components: {
        FormFind,
        Form
    },
    data() {
        return {
            showFilter: false,
            dataFormFind: {
                titulo: '',
                descricao: '',
                autor: '',
                numero_de_paginas: ''
            },
            colunas: [
                {
                    key: 'selecionado',
                    label: 'Selecionado'
                },
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
                    label: 'Num. de Páginas',
                    sortable: true,
                },
                {
                    key: 'created_at',
                    label: 'Data de Criação',
                    sortable: true
                }
            ],
            list: [],
            selectMode: 'single',
            currentPage: 0,
            total: 1,
            perPage: 10,
            order: 'created_at',
            typeOrder: true,
            selectedData: [],
            successMessage: 'Operação realizada com sucesso!',
            modalShow: false,
            dataUpdate: null,
            keyRefresh: 0
        };
    },
    mounted() {
        this.index(0)
    },
    methods: {
        ...mapActions('msgError', { showErrorMsg: 'showErrorMsg' }),
        ...mapActions('msgSuccess', { showSuccessMsg: 'showSuccessMsg' }),
        setActiveItem(item) {
            this.selectedData = item
        },
        defineOrder(e) {
            this.order = e.sortBy
            this.typeOrder = e.sortDesc
            this.index(0)
            this.currentPage = 0
        },
        refreshIndex(data) {
            this.dataFormFind = data
            this.index(0)
        },
        index(currentPage) {
            const pag = ((currentPage !== undefined ? currentPage : this.currentPage) - 1)

            const data = {
                offset: pag < 0 ? 0 : pag,
                limit: this.perPage,
                order: this.order,
                typeOrder: this.typeOrder ? 'DESC' : 'ASC',
                titulo: this.dataFormFind.titulo,
                descricao: this.dataFormFind.descricao,
                autor: this.dataFormFind.autor,
                numero_de_paginas: this.dataFormFind.numero_de_paginas
            }

            api.index(data)
                .then(res => {
                    this.list = res.data.data
                    this.total = res.data.total
                })
                .catch(() => {
                    this.showErrorMsg('Erro ao obter a lista de livros.')
                })
        },
        destroy() {
            const data = Object.assign({}, this.selectedData[0]);

            this.$bvModal.msgBoxConfirm(this.successMessage, {
                title: 'Por favor, confirme!',
                size: 'sm',
                buttonSize: 'sm',
                okVariant: 'danger',
                okTitle: 'Confirmar',
                cancelTitle: 'Cancelar',
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
            })
                .then(value => {
                    if (value) {
                        api.destroy(data.id)
                            .then(() => {
                                this.showSuccessMsg()
                                this.index(0)
                                this.selectedData = []
                            })
                            .catch(() => {
                                this.showErrorMsg('Erro ao excluir o livro.')
                            })
                    }
                });
        },
        openNew() {
            this.modalShow = true
            this.keyRefresh++
            this.dataUpdate = null
        },
        openUpdate() {
            this.dataUpdate = this.selectedData[0]
            this.keyRefresh++
            this.modalShow = true
        },
        refresh() {
            this.index(0)
        }
    }
};
</script>
<template>
    <div>
        <b-modal v-model="modalShow" @hidden="refresh()" size="xl">
            <template #modal-title>
                <div class="row">
                    <div class="col-12">
                        <h3>Livro</h3>
                    </div>
                </div>
            </template>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body py-4">
                            <div class="row">
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="form-group" :class="{ 'form-group--error': $v.livro.titulo.$error }">
                                        <label>Título</label>
                                        <b-form-input
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Título" 
                                            maxlength="255"
                                            v-model.trim="$v.livro.titulo.$model">
                                        </b-form-input>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="form-group" :class="{ 'form-group--error': $v.livro.descricao.$error }">
                                        <label>Descrição</label>
                                        <b-form-input
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Descrição" 
                                            maxlength="255"
                                            v-model.trim="$v.livro.descricao.$model">
                                        </b-form-input>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="form-group" :class="{ 'form-group--error': $v.livro.autor.$error }">
                                        <label>Autor</label>
                                        <b-form-input
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Autor" 
                                            maxlength="255"
                                            v-model.trim="$v.livro.autor.$model">
                                        </b-form-input>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="form-group" :class="{ 'form-group--error': $v.livro.numero_de_paginas.$error }">
                                        <label>Número de Páginas</label>
                                        <b-form-input
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Número de Páginas" 
                                            v-mask="'####'"
                                            v-model.trim="$v.livro.numero_de_paginas.$model">
                                        </b-form-input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <template #modal-footer>
                <b-button size="sm" variant="default" @click="refresh()">
                    Cancelar
                </b-button>
                <b-button size="sm" variant="success" @click="save()">
                    Salvar
                </b-button>
            </template>
        </b-modal>
    </div>
</template>
<script>
import { mapActions } from 'vuex';

import { required } from 'vuelidate/lib/validators';

import api from '@/api/livro.api.js';

export default {
    props: {
        modalShow: {
            type: Boolean,
            required: false
        },
        dataUpdate: {
            type: Object,
            required: false
        }
    },
    data() {
        return {
            livro: {
                id: null,
                titulo: '',
                descricao: '',
                autor: '',
                numero_de_paginas: null,
            },
            validatorError: "Erros no preenchimento do formulário."
        };
    },
    validations: {
        livro: {
            titulo: { required },
            descricao: { required },
            autor: { required },
            numero_de_paginas: { required },
        }
    },
    mounted() {
        if (this.dataUpdate)
            this.livro = this.dataUpdate
    },
    methods: {
        ...mapActions('msgError', { showErrorMsg: 'showErrorMsg' }),
        ...mapActions('msgSuccess', { showSuccessMsg: 'showSuccessMsg' }),
        refresh() {
            this.$emit('update:modalShow', false)
            this.$emit('refresh')
            this.$v.$reset()
        },
        save () {
            if (this.livro.id) {
                this.update()
            } else {
                this.store()
            }
        },
        store() {
            this.$v.$touch();
            if(this.$v.$invalid) {
                this.showErrorMsg(this.validatorError)
                return
            }

            api.store(this.livro)
                .then(() => {
                    this.showSuccessMsg("Livro cadastrado com sucesso.")
                    this.refresh()
                })
                .catch(() => {
                    this.showErrorMsg("Erro ao cadastrar livro.")
                });

            this.$v.$reset()
        },
        update() {
            this.$v.$touch();
            if(this.$v.$invalid) {
                this.showErrorMsg(this.validatorError);
                return
            }

            api.update(this.livro.id, this.livro)
                .then(() => {
                    this.showSuccessMsg("Livro atualizado com sucesso.")
                    this.refresh()
                })
                .catch(() => {
                    this.showErrorMsg("Erro ao cadastrar livro.")
                });

            this.$v.$reset()
        },
    }
};
</script>

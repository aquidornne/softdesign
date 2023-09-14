<template>
    <div>
        <div v-if="this.tempo.condition_slug !== ''">
            <div>
                <img :src="img" :alt="tempo.description" style="max-height: 50px">
            </div>
            <p>Tempo {{ tempo.city_name }}: <b>{{ tempo.description }}</b></p>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';

    import api from '@/api/weather.api.js';

    export default {
        data() {
            return {
                tempo: {
                    description: '',
                    city: '',
                    city_name: '',
                    condition_slug: ''
                }
            }
        },
        mounted() {
            this.getWeather()
        },
        methods: {
            ...mapActions('msgError', { showErrorMsg: 'showErrorMsg' }),
            getWeather() {
                api.weather()
                    .then(res => {
                        this.tempo = res.data
                        this.setImage(this.tempo.condition_slug)
                    })
                    .catch(() => {
                        this.showErrorMsg('Erro ao obter a previsão do tempo.')
                    })
            },
            setImage(slug) {
                this.img = `https://assets.hgbrasil.com/weather/icons/conditions/${slug}.svg`
            },
        }
    };
</script>